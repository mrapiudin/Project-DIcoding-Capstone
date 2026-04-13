@extends('template.sidebar')
@section('title', 'Aktivitas Olahraga - VitaTrack')
@section('page_title', 'Aktivitas Olahraga')
@section('page_subtitle', 'Lacak dan kelola aktivitas olahraga harian Anda')

@push('styles')
<style>
.kategori-chips {
    display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px;
}
.chip {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px; font-weight: 600;
    border: 1.5px solid var(--border);
    background: var(--surface);
    color: var(--text-2);
    cursor: pointer;
    transition: var(--transition);
}
.chip:hover, .chip.active {
    background: var(--primary); color: #fff; border-color: var(--primary);
}
.activity-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 18px 20px;
    display: flex; align-items: center; gap: 14px;
    transition: var(--transition);
    margin-bottom: 10px;
}
.activity-card:hover { box-shadow: var(--shadow); }
.activity-icon-box {
    width: 50px; height: 50px;
    border-radius: var(--radius); font-size: 22px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.activity-details { flex: 1; min-width: 0; }
.activity-name    { font-size: 15px; font-weight: 700; color: var(--text-1); }
.activity-cats    { font-size: 12px; color: var(--text-3); margin-top: 3px; }
.activity-right   { display: flex; flex-direction: column; align-items: flex-end; gap: 8px; }
.activity-dur-big { font-size: 20px; font-weight: 800; font-family:'Space Grotesk',sans-serif; color: var(--primary); }

/* Summary bar */
.summary-bar {
    background: linear-gradient(135deg, #064e3b, #065f46);
    border-radius: var(--radius-lg);
    padding: 20px 24px;
    color: white;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
.sum-item { text-align: center; }
.sum-val  { font-size: 28px; font-weight: 800; font-family:'Space Grotesk',sans-serif; }
.sum-lbl  { font-size: 12px; opacity: .7; margin-top: 2px; }
@media(max-width:560px){ .summary-bar { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')

{{-- Summary Bar --}}
<div class="summary-bar" id="summaryBar">
    <div class="sum-item">
        <div class="sum-val" id="sumTotal">—</div>
        <div class="sum-lbl">Total Aktivitas</div>
    </div>
    <div class="sum-item">
        <div class="sum-val" id="sumMenit">—</div>
        <div class="sum-lbl">Total Menit</div>
    </div>
    <div class="sum-item">
        <div class="sum-val" id="sumHari">—</div>
        <div class="sum-lbl">Hari Aktif</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Daftar Aktivitas</div>
        <button class="btn btn-primary btn-sm" onclick="openModal('modalTambah')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
            Tambah Aktivitas
        </button>
    </div>

    {{-- Filter chips --}}
    <div class="kategori-chips">
        <div class="chip active" onclick="filterKategori('semua', this)">Semua</div>
        <div class="chip" onclick="filterKategori('Cardio', this)">Cardio</div>
        <div class="chip" onclick="filterKategori('Strength', this)">Strength</div>
        <div class="chip" onclick="filterKategori('Flexibility', this)">Flexibility</div>
        <div class="chip" onclick="filterKategori('Sport', this)">Sport</div>
    </div>

    {{-- List --}}
    <div id="activityListContainer">
        <div class="empty-state">
            <div style="font-size:48px;margin-bottom:12px;">🏃</div>
            <div class="empty-state-title">Memuat data aktivitas...</div>
        </div>
    </div>
</div>

{{-- ============== MODAL TAMBAH ============== --}}
<div class="modal-overlay" id="modalTambah">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">➕ Tambah Aktivitas</h3>
            <button class="modal-close" onclick="closeModal('modalTambah')">✕</button>
        </div>
        <form id="formTambah" onsubmit="submitTambah(event)">
            <div class="form-group">
                <label class="form-label">Nama Aktivitas <span class="required">*</span></label>
                <input type="text" id="inp_nama" class="form-control" placeholder="cth. Lari Pagi, Gym..." required>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Kategori <span class="required">*</span></label>
                    <select id="inp_kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Cardio">Cardio</option>
                        <option value="Strength">Strength Training</option>
                        <option value="Flexibility">Flexibility</option>
                        <option value="Sport">Sport</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Durasi (menit) <span class="required">*</span></label>
                    <input type="number" id="inp_durasi" class="form-control" placeholder="e.g. 45" min="1" required>
                </div>
            </div>
            <div id="alertTambah"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambah')">Batal</button>
                <button type="submit" class="btn btn-primary" id="btnSubmit">Simpan Aktivitas</button>
            </div>
        </form>
    </div>
</div>

{{-- ============== MODAL EDIT ============== --}}
<div class="modal-overlay" id="modalEdit">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">✏️ Edit Aktivitas</h3>
            <button class="modal-close" onclick="closeModal('modalEdit')">✕</button>
        </div>
        <form id="formEdit" onsubmit="submitEdit(event)">
            <input type="hidden" id="edit_id">
            <div class="form-group">
                <label class="form-label">Nama Aktivitas <span class="required">*</span></label>
                <input type="text" id="edit_nama" class="form-control" required>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Kategori <span class="required">*</span></label>
                    <select id="edit_kategori" class="form-control" required>
                        <option value="Cardio">Cardio</option>
                        <option value="Strength">Strength Training</option>
                        <option value="Flexibility">Flexibility</option>
                        <option value="Sport">Sport</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Durasi (menit) <span class="required">*</span></label>
                    <input type="number" id="edit_durasi" class="form-control" min="1" required>
                </div>
            </div>
            <div id="alertEdit"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- ============== MODAL HAPUS ============== --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal" style="max-width:420px;">
        <div class="modal-header">
            <h3 class="modal-title">🗑️ Hapus Aktivitas</h3>
            <button class="modal-close" onclick="closeModal('modalHapus')">✕</button>
        </div>
        <p style="color:var(--text-2);font-size:14px;">Apakah Anda yakin ingin menghapus aktivitas <strong id="hapusNama"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modalHapus')">Batal</button>
            <button class="btn btn-danger" onclick="confirmHapus()">Ya, Hapus</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
const API = '/api';
let allActivities = [];
let deleteId = null;
const CATS = {
    'lari':{'icon':'🏃','bg':'#d1fae5'},
    'gym':{'icon':'🏋️','bg':'#fef3c7'},
    'bersepeda':{'icon':'🚴','bg':'#dbeafe'},
    'yoga':{'icon':'🧘','bg':'#cffafe'},
    'renang':{'icon':'🏊','bg':'#fce7f3'},
    'cardio':{'icon':'❤️','bg':'#fee2e2'},
    'default':{'icon':'💪','bg':'#f3f4f6'},
};
function getCat(name='') {
    const k = name.toLowerCase();
    for(const [key,val] of Object.entries(CATS)) if(k.includes(key)) return val;
    return CATS.default;
}

function openModal(id){ document.getElementById(id).classList.add('open'); }
function closeModal(id){ document.getElementById(id).classList.remove('open'); }

function renderActivities(data) {
    const el = document.getElementById('activityListContainer');
    if (!data.length) {
        el.innerHTML = `<div class="empty-state">
            <div style="font-size:48px;">🏃</div>
            <div class="empty-state-title">Belum ada aktivitas</div>
            <div class="empty-state-desc">Mulai lacak aktivitas olahraga pertama Anda</div>
            <button class="btn btn-primary" onclick="openModal('modalTambah')">+ Tambah Aktivitas</button>
        </div>`;
        return;
    }
    el.innerHTML = data.map(a => {
        const cat = getCat(a.nama_aktivitas);
        return `<div class="activity-card">
            <div class="activity-icon-box" style="background:${cat.bg}">${cat.icon}</div>
            <div class="activity-details">
                <div class="activity-name">${a.nama_aktivitas}</div>
                <div class="activity-cats">📂 ${a.kategori} &nbsp;•&nbsp; 📅 ${a.day||'—'}</div>
            </div>
            <div class="activity-right">
                <div class="activity-dur-big">${a.durasi}<span style="font-size:12px;color:var(--text-3);font-weight:500"> min</span></div>
                <div class="action-btns">
                    <button class="btn btn-ghost btn-sm" onclick='openEdit(${JSON.stringify(a)})' title="Edit">✏️</button>
                    <button class="btn btn-ghost btn-sm" style="color:var(--danger)" onclick='openHapus(${a.id},"${a.nama_aktivitas}")' title="Hapus">🗑️</button>
                </div>
            </div>
        </div>`;
    }).join('');
}

function updateSummary(data) {
    document.getElementById('sumTotal').textContent = data.length;
    const total = data.reduce((s,a) => s + (parseInt(a.durasi)||0), 0);
    document.getElementById('sumMenit').textContent = total;
    const days = new Set(data.map(a => a.day||a.created_at?.split('T')[0]||'')).size;
    document.getElementById('sumHari').textContent = days;
}

async function loadActivities() {
    try {
        const res = await fetch(`${API}/activities`);
        const json = await res.json();
        allActivities = json.data || [];
        renderActivities(allActivities);
        updateSummary(allActivities);
    } catch(e) {
        document.getElementById('activityListContainer').innerHTML = `<div class="alert alert-danger">Gagal memuat data. Pastikan API server berjalan.</div>`;
    }
}

function filterKategori(kat, el) {
    document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    const filtered = kat === 'semua' ? allActivities : allActivities.filter(a => a.kategori?.toLowerCase().includes(kat.toLowerCase()));
    renderActivities(filtered);
}

async function submitTambah(e) {
    e.preventDefault();
    const btn = document.getElementById('btnSubmit');
    btn.disabled = true; btn.textContent = 'Menyimpan...';
    const payload = {
        nama_aktivitas: document.getElementById('inp_nama').value,
        kategori: document.getElementById('inp_kategori').value,
        durasi: parseInt(document.getElementById('inp_durasi').value)
    };
    try {
        const res = await fetch(`${API}/activities`, {
            method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload)
        });
        const json = await res.json();
        if (json.status === 'success') {
            closeModal('modalTambah');
            document.getElementById('formTambah').reset();
            showFlash('Aktivitas berhasil ditambahkan! 🎉', 'success');
            loadActivities();
        } else {
            document.getElementById('alertTambah').innerHTML = `<div class="alert alert-danger">Gagal: ${JSON.stringify(json.message||json)}</div>`;
        }
    } catch(err) {
        document.getElementById('alertTambah').innerHTML = `<div class="alert alert-danger">Error koneksi ke API.</div>`;
    }
    btn.disabled = false; btn.textContent = 'Simpan Aktivitas';
}

function openEdit(a) {
    document.getElementById('edit_id').value = a.id;
    document.getElementById('edit_nama').value = a.nama_aktivitas;
    document.getElementById('edit_kategori').value = a.kategori;
    document.getElementById('edit_durasi').value = a.durasi;
    openModal('modalEdit');
}

async function submitEdit(e) {
    e.preventDefault();
    const id = document.getElementById('edit_id').value;
    const payload = {
        nama_aktivitas: document.getElementById('edit_nama').value,
        kategori: document.getElementById('edit_kategori').value,
        durasi: parseInt(document.getElementById('edit_durasi').value)
    };
    try {
        const res = await fetch(`${API}/activities/${id}`, {
            method:'PUT', headers:{'Content-Type':'application/json'}, body:JSON.stringify(payload)
        });
        const json = await res.json();
        if (json.status === 'success') {
            closeModal('modalEdit');
            showFlash('Aktivitas berhasil diperbarui! ✅', 'success');
            loadActivities();
        } else {
            document.getElementById('alertEdit').innerHTML = `<div class="alert alert-danger">Gagal memperbarui.</div>`;
        }
    } catch { document.getElementById('alertEdit').innerHTML = `<div class="alert alert-danger">Error koneksi.</div>`; }
}

function openHapus(id, nama) {
    deleteId = id;
    document.getElementById('hapusNama').textContent = nama;
    openModal('modalHapus');
}

async function confirmHapus() {
    if (!deleteId) return;
    try {
        const res = await fetch(`${API}/activities/${deleteId}`, {method:'DELETE'});
        const json = await res.json();
        if (json.status === 'success') {
            closeModal('modalHapus');
            showFlash('Aktivitas berhasil dihapus.', 'success');
            loadActivities();
        }
    } catch { alert('Gagal menghapus.'); }
}

function showFlash(msg, type='success') {
    const colors = { success:'#d1fae5;color:#065f46', danger:'#fee2e2;color:#991b1b' };
    const div = document.createElement('div');
    div.className = 'flash-msg';
    div.style.cssText = `background:${colors[type]||colors.success}`;
    div.textContent = msg;
    document.body.appendChild(div);
}

loadActivities();
</script>
@endpush
@endsection
