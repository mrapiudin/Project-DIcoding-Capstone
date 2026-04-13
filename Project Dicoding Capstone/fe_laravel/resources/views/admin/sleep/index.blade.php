@extends('template.sidebar')
@section('title', 'Data Tidur - VitaTrack Admin')
@section('page_title', 'Data Tidur')
@section('page_subtitle', 'Pantau semua catatan tidur pengguna')

@section('content')

<div class="stats-grid mb-6">
    <div class="stat-card">
        <div class="stat-icon" style="background:#ede9fe;">😴</div>
        <div class="stat-info">
            <div class="stat-label">Total Catatan</div>
            <div class="stat-value" id="sTotal">—</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon-green">🌙</div>
        <div class="stat-info">
            <div class="stat-label">Rata-rata Tidur</div>
            <div class="stat-value" id="sAvg">—</div>
            <div class="stat-change">jam/malam</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon-blue">⭐</div>
        <div class="stat-info">
            <div class="stat-label">Tidur ≥7 Jam</div>
            <div class="stat-value" id="sGood">—</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">😴 Riwayat Tidur Semua Pengguna</div>
        <button class="btn btn-primary btn-sm" onclick="openModal('modalTambah')">+ Tambah</button>
    </div>
    <div id="sleepTable">
        <div class="empty-state"><div style="font-size:48px;">😴</div><div class="empty-state-title">Memuat data...</div></div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal-overlay" id="modalTambah">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">🌙 Tambah Catatan Tidur</h3>
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
            <div id="alertTambah"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambah')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
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
                    <label class="form-label">Jam Tidur</label>
                    <input type="time" id="edit_tidur" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jam Bangun</label>
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

{{-- Modal Hapus --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal" style="max-width:420px;">
        <div class="modal-header"><h3 class="modal-title">🗑️ Hapus Catatan</h3><button class="modal-close" onclick="closeModal('modalHapus')">✕</button></div>
        <p style="color:var(--text-2);font-size:14px;">Yakin ingin menghapus catatan tidur ini?</p>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modalHapus')">Batal</button>
            <button class="btn btn-danger" onclick="confirmHapus()">Hapus</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
const API = '/api';
let deleteId = null;
function openModal(id){ document.getElementById(id).classList.add('open'); }
function closeModal(id){ document.getElementById(id).classList.remove('open'); }

async function loadSleep() {
    try {
        const res = await fetch(`${API}/sleep`);
        const json = await res.json();
        const data = json.data||[];
        const totals = data.map(s=>parseInt(s.total)||0);
        document.getElementById('sTotal').textContent = data.length;
        document.getElementById('sAvg').textContent = data.length ? (totals.reduce((a,b)=>a+b,0)/data.length/60).toFixed(1) : '—';
        document.getElementById('sGood').textContent = totals.filter(t=>t>=420).length;

        const el = document.getElementById('sleepTable');
        if(!data.length) { el.innerHTML=`<div class="empty-state"><div style="font-size:48px;">😴</div><div class="empty-state-title">Belum ada data</div></div>`; return; }
        el.innerHTML = `<div class="table-wrapper"><table class="data-table">
            <thead><tr><th>#</th><th>Jam Tidur</th><th>Jam Bangun</th><th>Total</th><th>Kualitas</th><th>Tanggal</th><th>Aksi</th></tr></thead>
            <tbody>${data.map((s,i)=>{
                const jam=Math.floor((parseInt(s.total)||0)/60),mnt=(parseInt(s.total)||0)%60;
                const q=jam>=7?{label:'Baik',cls:'badge-green'}:jam>=5?{label:'Cukup',cls:'badge-amber'}:{label:'Kurang',cls:'badge-red'};
                return `<tr>
                    <td>${i+1}</td>
                    <td class="td-primary">${s.jam_tidur}</td>
                    <td class="td-primary">${s.jam_bangun}</td>
                    <td><strong>${jam}j ${mnt}m</strong></td>
                    <td><span class="badge ${q.cls}">${q.label}</span></td>
                    <td>${s.day||'—'}</td>
                    <td><div class="action-btns">
                        <button class="btn btn-secondary btn-sm" onclick='openEdit(${JSON.stringify(s)})'>✏️</button>
                        <button class="btn btn-danger btn-sm" onclick="openHapus(${s.id})">🗑️</button>
                    </div></td>
                </tr>`;
            }).join('')}</tbody>
        </table></div>`;
    } catch { document.getElementById('sleepTable').innerHTML=`<div class="alert alert-danger">Gagal memuat.</div>`; }
}

async function submitTambah(e){e.preventDefault();const payload={jam_tidur:document.getElementById('inp_tidur').value,jam_bangun:document.getElementById('inp_bangun').value};try{const res=await fetch(`${API}/sleep`,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});const json=await res.json();if(json.status==='success'){closeModal('modalTambah');document.getElementById('formTambah').reset();showFlash('Catatan tidur ditambahkan!','success');loadSleep();}else document.getElementById('alertTambah').innerHTML=`<div class="alert alert-danger">Gagal: ${JSON.stringify(json)}</div>`;}catch{document.getElementById('alertTambah').innerHTML=`<div class="alert alert-danger">Error.</div>`;}}
function openEdit(s){document.getElementById('edit_id').value=s.id;document.getElementById('edit_tidur').value=s.jam_tidur;document.getElementById('edit_bangun').value=s.jam_bangun;openModal('modalEdit');}
async function submitEdit(e){e.preventDefault();const id=document.getElementById('edit_id').value;const payload={jam_tidur:document.getElementById('edit_tidur').value,jam_bangun:document.getElementById('edit_bangun').value};try{const res=await fetch(`${API}/sleep/${id}`,{method:'PUT',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});const json=await res.json();if(json.status==='success'){closeModal('modalEdit');showFlash('Diperbarui!','success');loadSleep();}else document.getElementById('alertEdit').innerHTML=`<div class="alert alert-danger">Gagal.</div>`;}catch{document.getElementById('alertEdit').innerHTML=`<div class="alert alert-danger">Error.</div>`;}}
function openHapus(id){deleteId=id;openModal('modalHapus');}
async function confirmHapus(){if(!deleteId)return;try{const res=await fetch(`${API}/sleep/${deleteId}`,{method:'DELETE'});const json=await res.json();if(json.status==='success'){closeModal('modalHapus');showFlash('Dihapus!','success');loadSleep();}}catch{alert('Gagal.');}}
function showFlash(msg,type='success'){const colors={success:'background:#d1fae5;color:#065f46',danger:'background:#fee2e2;color:#991b1b'};const div=document.createElement('div');div.className='flash-msg';div.style.cssText=colors[type];div.textContent=msg;document.body.appendChild(div);}
loadSleep();
</script>
@endpush
@endsection
