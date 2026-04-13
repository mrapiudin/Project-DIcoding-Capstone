@extends('template.sidebar')
@section('title', 'Tracking Tidur - VitaTrack')
@section('page_title', 'Tracking Tidur')
@section('page_subtitle', 'Monitor dan catat kualitas tidur Anda setiap malam')

@push('styles')
<style>
.sleep-hero {
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
    border-radius: var(--radius-xl);
    padding: 28px 32px;
    margin-bottom: 24px;
    color: white;
    display: flex; align-items: center; justify-content: space-between; gap: 20px;
    position: relative; overflow: hidden;
}
.sleep-hero::before {
    content: '🌙';
    position: absolute;
    right: 32px; font-size: 100px;
    opacity: .12; line-height: 1;
}
.sleep-hero-title { font-size: 22px; font-weight: 800; margin-bottom: 6px; }
.sleep-hero-sub   { font-size: 14px; opacity: .8; }
.sleep-stats-row  {
    display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 24px;
}
@media(max-width:900px){ .sleep-stats-row { grid-template-columns: repeat(2,1fr); } }
@media(max-width:480px){ .sleep-stats-row { grid-template-columns: 1fr; } }
.sleep-stat-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius-lg); padding: 18px 20px;
    text-align: center;
}
.ss-val { font-size: 28px; font-weight: 800; font-family:'Space Grotesk',sans-serif; }
.ss-lbl { font-size: 12px; color: var(--text-3); margin-top: 3px; }

.sleep-card {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: var(--radius-lg); padding: 16px 20px;
    display: flex; align-items: center; gap: 16px;
    margin-bottom: 10px; transition: var(--transition);
}
.sleep-card:hover { box-shadow: var(--shadow); }
.sleep-moon {
    width: 50px; height: 50px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; flex-shrink: 0;
}
.sleep-info { flex: 1; min-width: 0; }
.sleep-title { font-size: 15px; font-weight: 700; color: var(--text-1); }
.sleep-subtitle { font-size: 12px; color: var(--text-3); margin-top: 2px; }
.sleep-right { text-align: right; }
.sleep-total { font-size: 22px; font-weight: 800; font-family:'Space Grotesk',sans-serif; }
.sleep-quality { font-size: 12px; font-weight: 600; margin-top: 3px; }
</style>
@endpush

@section('content')

<div class="sleep-hero">
    <div>
        <div class="sleep-hero-title">Tidur yang Baik = Tubuh yang Sehat 🌙</div>
        <div class="sleep-hero-sub">Dewasa direkomendasikan tidur 7–9 jam per malam</div>
    </div>
    <button class="btn" style="background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.3);color:#fff;" onclick="openModal('modalTambah')">
        + Catat Tidur
    </button>
</div>

{{-- Stats row --}}
<div class="sleep-stats-row">
    <div class="sleep-stat-card">
        <div class="ss-val" id="statTotal" style="color:#6366f1">—</div>
        <div class="ss-lbl">Total Catatan</div>
    </div>
    <div class="sleep-stat-card">
        <div class="ss-val" id="statAvg" style="color:#10b981">—</div>
        <div class="ss-lbl">Rata-rata (jam)</div>
    </div>
    <div class="sleep-stat-card">
        <div class="ss-val" id="statMax" style="color:#3b82f6">—</div>
        <div class="ss-lbl">Tidur Terlama (j)</div>
    </div>
    <div class="sleep-stat-card">
        <div class="ss-val" id="statMin" style="color:#f59e0b">—</div>
        <div class="ss-lbl">Tidur Terpendek (j)</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">Riwayat Tidur</div>
        <button class="btn btn-primary btn-sm" onclick="openModal('modalTambah')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
            Catat Tidur
        </button>
    </div>
    <div id="sleepList">
        <div class="empty-state">
            <div style="font-size:48px;">😴</div>
            <div class="empty-state-title">Memuat data...</div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal-overlay" id="modalTambah">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">🌙 Catat Tidur</h3>
            <button class="modal-close" onclick="closeModal('modalTambah')">✕</button>
        </div>
        <form id="formTambah" onsubmit="submitTambah(event)">
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Jam Tidur <span class="required">*</span></label>
                    <input type="time" id="inp_tidur" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jam Bangun <span class="required">*</span></label>
                    <input type="time" id="inp_bangun" class="form-control" required>
                </div>
            </div>
            <div id="sleepPreview" class="alert alert-info" style="display:none;"></div>
            <div id="alertTambah"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambah')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal-overlay" id="modalEdit">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">✏️ Edit Catatan Tidur</h3>
            <button class="modal-close" onclick="closeModal('modalEdit')">✕</button>
        </div>
        <form id="formEdit" onsubmit="submitEdit(event)">
            <input type="hidden" id="edit_id">
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Jam Tidur <span class="required">*</span></label>
                    <input type="time" id="edit_tidur" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jam Bangun <span class="required">*</span></label>
                    <input type="time" id="edit_bangun" class="form-control" required>
                </div>
            </div>
            <div id="alertEdit"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal" style="max-width:420px;">
        <div class="modal-header">
            <h3 class="modal-title">🗑️ Hapus Catatan</h3>
            <button class="modal-close" onclick="closeModal('modalHapus')">✕</button>
        </div>
        <p style="color:var(--text-2);font-size:14px;">Apakah Anda yakin ingin menghapus catatan tidur ini? Tindakan ini tidak dapat dibatalkan.</p>
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

function minsToStr(min) {
    const h = Math.floor(min/60), m = min%60;
    return `${h}j ${m}m`;
}

function getQuality(total) {
    const h = total/60;
    if(h >= 7) return {label:'😊 Tidur Baik', color:'#059669'};
    if(h >= 5) return {label:'😐 Cukup', color:'#d97706'};
    return {label:'😴 Kurang', color:'#dc2626'};
}

function renderSleep(data) {
    const el = document.getElementById('sleepList');
    if(!data.length) {
        el.innerHTML = `<div class="empty-state">
            <div style="font-size:48px;">😴</div>
            <div class="empty-state-title">Belum ada catatan tidur</div>
            <div class="empty-state-desc">Mulai catat pola tidur Anda malam ini</div>
            <button class="btn btn-primary" onclick="openModal('modalTambah')">Catat Sekarang</button>
        </div>`;
        return;
    }
    el.innerHTML = data.map(s => {
        const q = getQuality(s.total||0);
        const jam = Math.floor((s.total||0)/60), mnt = (s.total||0)%60;
        const bgColor = (s.total/60) >= 7 ? '#d1fae5' : (s.total/60) >= 5 ? '#fef3c7' : '#fee2e2';
        return `<div class="sleep-card">
            <div class="sleep-moon" style="background:${bgColor}">🌙</div>
            <div class="sleep-info">
                <div class="sleep-title">${s.day||'—'}</div>
                <div class="sleep-subtitle">🛏️ Tidur ${s.jam_tidur} · ⏰ Bangun ${s.jam_bangun}</div>
            </div>
            <div class="sleep-right">
                <div class="sleep-total">${jam}j ${mnt}m</div>
                <div class="sleep-quality" style="color:${q.color}">${q.label}</div>
                <div class="action-btns" style="justify-content:flex-end;margin-top:8px;">
                    <button class="btn btn-ghost btn-sm" onclick='openEdit(${JSON.stringify(s)})'>✏️</button>
                    <button class="btn btn-ghost btn-sm" style="color:var(--danger)" onclick="openHapus(${s.id})">🗑️</button>
                </div>
            </div>
        </div>`;
    }).join('');
}

function updateStats(data) {
    document.getElementById('statTotal').textContent = data.length;
    if(!data.length) return;
    const totals = data.map(s => parseInt(s.total)||0);
    const avg = (totals.reduce((a,b)=>a+b,0)/data.length/60).toFixed(1);
    const max = (Math.max(...totals)/60).toFixed(1);
    const min = (Math.min(...totals)/60).toFixed(1);
    document.getElementById('statAvg').textContent = avg;
    document.getElementById('statMax').textContent = max;
    document.getElementById('statMin').textContent = min;
}

async function loadSleep() {
    try {
        const res = await fetch(`${API}/sleep`);
        const json = await res.json();
        const data = json.data||[];
        renderSleep(data);
        updateStats(data);
    } catch {
        document.getElementById('sleepList').innerHTML = `<div class="alert alert-danger">Gagal memuat data. Pastikan API server berjalan.</div>`;
    }
}

// Auto-preview sleep duration
['inp_tidur','inp_bangun'].forEach(id => {
    document.getElementById(id).addEventListener('change', () => {
        const t = document.getElementById('inp_tidur').value;
        const b = document.getElementById('inp_bangun').value;
        if(t && b) {
            let [th,tm] = t.split(':').map(Number);
            let [bh,bm] = b.split(':').map(Number);
            let diff = (bh*60+bm) - (th*60+tm);
            if(diff < 0) diff += 24*60;
            const h= Math.floor(diff/60), m=diff%60;
            const preview = document.getElementById('sleepPreview');
            preview.style.display = 'flex';
            preview.textContent = `💡 Durasi tidur: ${h} jam ${m} menit`;
        }
    });
});

async function submitTambah(e) {
    e.preventDefault();
    const payload = { jam_tidur: document.getElementById('inp_tidur').value, jam_bangun: document.getElementById('inp_bangun').value };
    try {
        const res = await fetch(`${API}/sleep`, {method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
        const json = await res.json();
        if(json.status==='success') {
            closeModal('modalTambah');
            document.getElementById('formTambah').reset();
            document.getElementById('sleepPreview').style.display='none';
            showFlash('Catatan tidur berhasil disimpan! 🌙','success');
            loadSleep();
        } else {
            document.getElementById('alertTambah').innerHTML = `<div class="alert alert-danger">Gagal menyimpan: ${JSON.stringify(json.message||json)}</div>`;
        }
    } catch { document.getElementById('alertTambah').innerHTML = `<div class="alert alert-danger">Error koneksi API.</div>`; }
}

function openEdit(s) {
    document.getElementById('edit_id').value = s.id;
    document.getElementById('edit_tidur').value = s.jam_tidur;
    document.getElementById('edit_bangun').value = s.jam_bangun;
    openModal('modalEdit');
}

async function submitEdit(e) {
    e.preventDefault();
    const id = document.getElementById('edit_id').value;
    const payload = { jam_tidur: document.getElementById('edit_tidur').value, jam_bangun: document.getElementById('edit_bangun').value };
    try {
        const res = await fetch(`${API}/sleep/${id}`, {method:'PUT',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
        const json = await res.json();
        if(json.status==='success') {
            closeModal('modalEdit');
            showFlash('Catatan tidur diperbarui! ✅','success');
            loadSleep();
        }
    } catch { document.getElementById('alertEdit').innerHTML = `<div class="alert alert-danger">Error koneksi.</div>`; }
}

function openHapus(id) { deleteId=id; openModal('modalHapus'); }

async function confirmHapus() {
    if(!deleteId) return;
    try {
        const res = await fetch(`${API}/sleep/${deleteId}`, {method:'DELETE'});
        const json = await res.json();
        if(json.status==='success') {
            closeModal('modalHapus');
            showFlash('Catatan tidur dihapus.','success');
            loadSleep();
        }
    } catch { alert('Gagal menghapus.'); }
}

function showFlash(msg,type='success'){
    const colors={success:'background:#d1fae5;color:#065f46',danger:'background:#fee2e2;color:#991b1b'};
    const div=document.createElement('div');
    div.className='flash-msg'; div.style.cssText=colors[type]||colors.success; div.textContent=msg;
    document.body.appendChild(div);
}

loadSleep();
</script>
@endpush
@endsection
