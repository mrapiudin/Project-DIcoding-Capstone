@extends('template.sidebar')
@section('title', 'Data Aktivitas - VitaTrack Admin')
@section('page_title', 'Data Aktivitas')
@section('page_subtitle', 'Pantau semua data aktivitas olahraga pengguna')

@section('content')

<div class="stats-grid mb-6">
    <div class="stat-card">
        <div class="stat-icon stat-icon-green">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M22 12H18L15 21L9 3L6 12H2" stroke="#059669" stroke-width="2"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Total Aktivitas</div>
            <div class="stat-value" id="sTotal">—</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon-blue">💪</div>
        <div class="stat-info">
            <div class="stat-label">Total Menit</div>
            <div class="stat-value" id="sMenit">—</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon-amber">📊</div>
        <div class="stat-info">
            <div class="stat-label">Rata-rata Durasi</div>
            <div class="stat-value" id="sAvg">—</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">💪 Semua Data Aktivitas</div>
        <button class="btn btn-primary btn-sm" onclick="openModal('modalTambah')">+ Tambah</button>
    </div>

    <div id="activityTable">
        <div class="empty-state">
            <div style="font-size:48px;">💪</div>
            <div class="empty-state-title">Memuat data...</div>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal-overlay" id="modalTambah">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">➕ Tambah Aktivitas</h3>
            <button class="modal-close" onclick="closeModal('modalTambah')">✕</button>
        </div>
        <form id="formTambah" onsubmit="submitTambah(event)">
            <div class="form-group">
                <label class="form-label">Nama Aktivitas <span class="required">*</span></label>
                <input type="text" id="inp_nama" class="form-control" required>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Kategori <span class="required">*</span></label>
                    <select id="inp_kategori" class="form-control" required>
                        <option value="">Pilih</option>
                        <option>Cardio</option><option>Strength</option>
                        <option>Flexibility</option><option>Sport</option><option>Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Durasi (menit) <span class="required">*</span></label>
                    <input type="number" id="inp_durasi" class="form-control" min="1" required>
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
            <h3 class="modal-title">✏️ Edit Aktivitas</h3>
            <button class="modal-close" onclick="closeModal('modalEdit')">✕</button>
        </div>
        <form id="formEdit" onsubmit="submitEdit(event)">
            <input type="hidden" id="edit_id">
            <div class="form-group">
                <label class="form-label">Nama Aktivitas</label>
                <input type="text" id="edit_nama" class="form-control" required>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select id="edit_kategori" class="form-control">
                        <option>Cardio</option><option>Strength</option>
                        <option>Flexibility</option><option>Sport</option><option>Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Durasi (menit)</label>
                    <input type="number" id="edit_durasi" class="form-control" min="1" required>
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
        <div class="modal-header">
            <h3 class="modal-title">🗑️ Hapus Aktivitas</h3>
            <button class="modal-close" onclick="closeModal('modalHapus')">✕</button>
        </div>
        <p style="color:var(--text-2);font-size:14px;">Yakin hapus aktivitas <strong id="hapusNama"></strong>?</p>
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

async function loadActivities() {
    try {
        const res = await fetch(`${API}/activities`);
        const json = await res.json();
        const data = json.data||[];
        const total = data.reduce((s,a)=>s+(parseInt(a.durasi)||0),0);
        document.getElementById('sTotal').textContent = data.length;
        document.getElementById('sMenit').textContent = total;
        document.getElementById('sAvg').textContent = data.length ? Math.round(total/data.length)+'m' : '—';

        const el = document.getElementById('activityTable');
        if(!data.length) {
            el.innerHTML = `<div class="empty-state"><div style="font-size:48px;">💪</div><div class="empty-state-title">Belum ada data aktivitas</div></div>`;
            return;
        }
        el.innerHTML = `<div class="table-wrapper"><table class="data-table">
            <thead><tr><th>#</th><th>Nama Aktivitas</th><th>Kategori</th><th>Durasi</th><th>Tanggal</th><th>Aksi</th></tr></thead>
            <tbody>${data.map((a,i)=>`<tr>
                <td>${i+1}</td>
                <td class="td-primary">${a.nama_aktivitas}</td>
                <td><span class="badge badge-green">${a.kategori}</span></td>
                <td><strong>${a.durasi}</strong> menit</td>
                <td>${a.day||'—'}</td>
                <td><div class="action-btns">
                    <button class="btn btn-secondary btn-sm" onclick='openEdit(${JSON.stringify(a)})'>✏️</button>
                    <button class="btn btn-danger btn-sm" onclick="openHapus(${a.id},'${a.nama_aktivitas}')">🗑️</button>
                </div></td>
            </tr>`).join('')}</tbody>
        </table></div>`;
    } catch {
        document.getElementById('activityTable').innerHTML = `<div class="alert alert-danger">Gagal memuat data.</div>`;
    }
}

async function submitTambah(e) {
    e.preventDefault();
    const payload = {nama_aktivitas:document.getElementById('inp_nama').value, kategori:document.getElementById('inp_kategori').value, durasi:parseInt(document.getElementById('inp_durasi').value)};
    try {
        const res = await fetch(`${API}/activities`,{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
        const json = await res.json();
        if(json.status==='success'){closeModal('modalTambah');document.getElementById('formTambah').reset();showFlash('Aktivitas ditambahkan!','success');loadActivities();}
        else document.getElementById('alertTambah').innerHTML=`<div class="alert alert-danger">Gagal: ${JSON.stringify(json)}</div>`;
    } catch { document.getElementById('alertTambah').innerHTML=`<div class="alert alert-danger">Error koneksi.</div>`; }
}
function openEdit(a){document.getElementById('edit_id').value=a.id;document.getElementById('edit_nama').value=a.nama_aktivitas;document.getElementById('edit_kategori').value=a.kategori;document.getElementById('edit_durasi').value=a.durasi;openModal('modalEdit');}
async function submitEdit(e){e.preventDefault();const id=document.getElementById('edit_id').value;const payload={nama_aktivitas:document.getElementById('edit_nama').value,kategori:document.getElementById('edit_kategori').value,durasi:parseInt(document.getElementById('edit_durasi').value)};try{const res=await fetch(`${API}/activities/${id}`,{method:'PUT',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});const json=await res.json();if(json.status==='success'){closeModal('modalEdit');showFlash('Diperbarui!','success');loadActivities();}else document.getElementById('alertEdit').innerHTML=`<div class="alert alert-danger">Gagal.</div>`;}catch{document.getElementById('alertEdit').innerHTML=`<div class="alert alert-danger">Error.</div>`;}}
function openHapus(id,nama){deleteId=id;document.getElementById('hapusNama').textContent=nama;openModal('modalHapus');}
async function confirmHapus(){if(!deleteId)return;try{const res=await fetch(`${API}/activities/${deleteId}`,{method:'DELETE'});const json=await res.json();if(json.status==='success'){closeModal('modalHapus');showFlash('Dihapus!','success');loadActivities();}}catch{alert('Gagal.');}}
function showFlash(msg,type='success'){const colors={success:'background:#d1fae5;color:#065f46',danger:'background:#fee2e2;color:#991b1b'};const div=document.createElement('div');div.className='flash-msg';div.style.cssText=colors[type];div.textContent=msg;document.body.appendChild(div);}
loadActivities();
</script>
@endpush
@endsection
