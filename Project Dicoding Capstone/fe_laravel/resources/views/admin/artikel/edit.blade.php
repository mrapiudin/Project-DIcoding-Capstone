@extends('template.sidebar')
@section('title', 'Edit Artikel - VitaTrack Admin')
@section('page_title', 'Edit Artikel')
@section('page_subtitle', 'Perbarui konten artikel kesehatan')

@push('styles')
<style>
.form-section {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    margin-bottom: 20px;
}
.form-section-title {
    font-size: 14px; font-weight: 700; color: var(--text-1);
    margin-bottom: 18px; padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 8px;
}
</style>
@endpush

@section('content')

<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
    <div>
        <div style="font-size:13px;color:var(--text-3);">Admin → Artikel →</div>
        <div style="font-size:16px;font-weight:700;">Edit Artikel #<span id="artikelId"></span></div>
    </div>
</div>

<div id="loadingState" class="empty-state">
    <div style="font-size:40px;">⏳</div>
    <div class="empty-state-title">Memuat data artikel...</div>
</div>

<form id="formEdit" onsubmit="submitEdit(event)" style="display:none;">
    <input type="hidden" id="f_id">

    <div class="form-section">
        <div class="form-section-title">📝 Informasi Artikel</div>
        <div class="form-group">
            <label class="form-label">Judul Artikel <span class="required">*</span></label>
            <input type="text" id="f_judul" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Sub Judul</label>
            <input type="text" id="f_sub_judul" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Isi Artikel <span class="required">*</span></label>
            <textarea id="f_isi" class="form-control" style="min-height:200px;" required></textarea>
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-title">🔗 Media & Tautan</div>
        <div class="form-grid-2">
            <div class="form-group">
                <label class="form-label">URL Gambar</label>
                <input type="url" id="f_image" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Tautan Artikel Asli</label>
                <input type="url" id="f_tautan" class="form-control">
            </div>
        </div>
        <div id="imagePreview" style="display:none;margin-top:12px;">
            <div style="font-size:12px;color:var(--text-3);margin-bottom:8px;">Preview Gambar:</div>
            <img id="imgTag" src="" alt="Preview" style="max-height:200px;border-radius:var(--radius);border:1px solid var(--border);">
        </div>
    </div>

    <div class="form-section">
        <div class="form-section-title">📅 Tanggal</div>
        <div class="form-group" style="max-width:300px;">
            <label class="form-label">Tanggal Publikasi <span class="required">*</span></label>
            <input type="date" id="f_date" class="form-control" required>
        </div>
    </div>

    <div id="alertForm"></div>

    <div style="display:flex;align-items:center;justify-content:flex-end;gap:12px;margin-top:8px;">
        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary" id="btnSubmit">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Simpan Perubahan
        </button>
    </div>
</form>

@push('scripts')
<script>
const API = '/api';
const artikelId = {{ $id ?? 'null' }};

document.getElementById('f_image').addEventListener('input', function(){
    const url = this.value;
    const preview = document.getElementById('imagePreview');
    if(url){ document.getElementById('imgTag').src=url; preview.style.display='block'; }
    else { preview.style.display='none'; }
});

async function loadArtikel() {
    if(!artikelId) { window.location.href='{{ route("admin.artikel.index") }}'; return; }
    try {
        const res = await fetch(`${API}/articles/${artikelId}`);
        const json = await res.json();
        const a = json.data;
        if(!a) throw new Error('Not found');

        document.getElementById('artikelId').textContent = artikelId;
        document.getElementById('f_id').value = a.id;
        document.getElementById('f_judul').value = a.judul||'';
        document.getElementById('f_sub_judul').value = a.sub_judul||'';
        document.getElementById('f_isi').value = a.isi||'';
        document.getElementById('f_image').value = a.image||'';
        document.getElementById('f_tautan').value = a.tautan||'';
        document.getElementById('f_date').value = a.date ? a.date.split('T')[0] : '';

        if(a.image) {
            document.getElementById('imgTag').src = a.image;
            document.getElementById('imagePreview').style.display = 'block';
        }

        document.getElementById('loadingState').style.display = 'none';
        document.getElementById('formEdit').style.display = 'block';
    } catch(e) {
        document.getElementById('loadingState').innerHTML = `<div class="empty-state"><div style="font-size:40px">❌</div><div class="empty-state-title">Artikel tidak ditemukan</div><a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary mt-4">Kembali</a></div>`;
    }
}

async function submitEdit(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSubmit');
    btn.disabled = true; btn.textContent = 'Menyimpan...';

    const payload = {
        judul: document.getElementById('f_judul').value,
        sub_judul: document.getElementById('f_sub_judul').value || null,
        isi: document.getElementById('f_isi').value,
        image: document.getElementById('f_image').value || null,
        tautan: document.getElementById('f_tautan').value || null,
        date: document.getElementById('f_date').value,
    };

    try {
        const res = await fetch(`${API}/articles/${artikelId}`, {
            method:'PUT', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload)
        });
        const json = await res.json();
        if(json.status==='success') {
            window.location.href = '{{ route("admin.artikel.index") }}?updated=1';
        } else {
            document.getElementById('alertForm').innerHTML = `<div class="alert alert-danger">Gagal menyimpan: ${JSON.stringify(json)}</div>`;
        }
    } catch {
        document.getElementById('alertForm').innerHTML = `<div class="alert alert-danger">Error koneksi API.</div>`;
    }
    btn.disabled = false; btn.textContent = 'Simpan Perubahan';
}

loadArtikel();
</script>
@endpush
@endsection
