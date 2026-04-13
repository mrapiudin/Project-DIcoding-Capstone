@extends('template.sidebar')
@section('title', 'Kelola Artikel - VitaTrack Admin')
@section('page_title', 'Kelola Artikel')
@section('page_subtitle', 'Buat, edit, dan kelola semua artikel kesehatan')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">📰 Daftar Artikel</div>
        <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary btn-sm">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
            Buat Artikel Baru
        </a>
    </div>

    <div id="artikelList">
        <div class="empty-state">
            <div style="font-size:48px;">📰</div>
            <div class="empty-state-title">Memuat data artikel...</div>
        </div>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal" style="max-width:420px;">
        <div class="modal-header">
            <h3 class="modal-title">🗑️ Hapus Artikel</h3>
            <button class="modal-close" onclick="closeModal('modalHapus')">✕</button>
        </div>
        <p style="color:var(--text-2);font-size:14px;">Apakah Anda yakin ingin menghapus artikel <strong id="hapusJudul"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modalHapus')">Batal</button>
            <button class="btn btn-danger" onclick="confirmHapus()">Ya, Hapus</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
const API = '/api';
let deleteId = null;

function openModal(id){ document.getElementById(id).classList.add('open'); }
function closeModal(id){ document.getElementById(id).classList.remove('open'); }

function formatDate(d) {
    if(!d) return '—';
    return new Date(d).toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'});
}

async function loadArtikel() {
    try {
        const res = await fetch(`${API}/articles`);
        const json = await res.json();
        const data = json.data||[];
        const el = document.getElementById('artikelList');
        if(!data.length) {
            el.innerHTML = `<div class="empty-state">
                <div style="font-size:48px;">📰</div>
                <div class="empty-state-title">Belum ada artikel</div>
                <div class="empty-state-desc">Mulai tulis artikel kesehatan pertama Anda</div>
                <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary">Buat Artikel</a>
            </div>`;
            return;
        }
        el.innerHTML = `<div class="table-wrapper">
            <table class="data-table">
                <thead><tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Sub Judul</th>
                    <th>Tanggal</th>
                    <th>Tautan</th>
                    <th>Aksi</th>
                </tr></thead>
                <tbody>
                ${data.map((a,i) => `<tr>
                    <td style="width:40px;">${i+1}</td>
                    <td><div class="td-primary" style="max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${a.judul}</div></td>
                    <td><div style="max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:var(--text-2);">${a.sub_judul||'—'}</div></td>
                    <td style="white-space:nowrap;">${formatDate(a.date)}</td>
                    <td>${a.tautan?`<a href="${a.tautan}" target="_blank" class="badge badge-blue">Lihat</a>`:'—'}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ url('admin/artikel') }}/${a.id}/edit" class="btn btn-secondary btn-sm">✏️ Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="openHapus(${a.id},'${a.judul.replace("'","&apos;")}')">🗑️</button>
                        </div>
                    </td>
                </tr>`).join('')}
                </tbody>
            </table>
        </div>`;
    } catch {
        document.getElementById('artikelList').innerHTML = `<div class="alert alert-danger">Gagal memuat data. Pastikan API server berjalan.</div>`;
    }
}

function openHapus(id, judul) { deleteId=id; document.getElementById('hapusJudul').textContent=judul; openModal('modalHapus'); }

async function confirmHapus() {
    if(!deleteId) return;
    try {
        const res = await fetch(`${API}/articles/${deleteId}`, {method:'DELETE'});
        const json = await res.json();
        if(json.status==='success') {
            closeModal('modalHapus');
            showFlash('Artikel berhasil dihapus.','success');
            loadArtikel();
        }
    } catch { alert('Gagal menghapus.'); }
}

function showFlash(msg,type='success'){
    const colors={success:'background:#d1fae5;color:#065f46',danger:'background:#fee2e2;color:#991b1b'};
    const div=document.createElement('div'); div.className='flash-msg';
    div.style.cssText=colors[type]||colors.success; div.textContent=msg; document.body.appendChild(div);
}

loadArtikel();
</script>
@endpush
@endsection
