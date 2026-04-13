@extends('template.sidebar')
@section('title', 'Kelola Pengguna - VitaTrack Admin')
@section('page_title', 'Kelola Pengguna')
@section('page_subtitle', 'Manajemen akun pengguna platform VitaTrack')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">👥 Daftar Pengguna</div>
        <button class="btn btn-primary btn-sm" onclick="openModal('modalTambah')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
            Tambah Pengguna
        </button>
    </div>

    <div id="userList">
        <div class="empty-state">
            <div style="font-size:48px;">👥</div>
            <div class="empty-state-title">Memuat data pengguna...</div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal-overlay" id="modalTambah">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">➕ Tambah Pengguna</h3>
            <button class="modal-close" onclick="closeModal('modalTambah')">✕</button>
        </div>
        <form id="formTambah" onsubmit="submitTambah(event)">
            <div class="form-group">
                <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="inp_name" class="form-control" placeholder="Nama lengkap pengguna" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email <span class="required">*</span></label>
                <input type="email" id="inp_email" class="form-control" placeholder="email@example.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password <span class="required">*</span></label>
                <input type="password" id="inp_password" class="form-control" placeholder="Min. 6 karakter" minlength="6" required>
            </div>
            <div id="alertTambah"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalTambah')">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal-overlay" id="modalEdit">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title">✏️ Edit Pengguna</h3>
            <button class="modal-close" onclick="closeModal('modalEdit')">✕</button>
        </div>
        <form id="formEdit" onsubmit="submitEdit(event)">
            <input type="hidden" id="edit_id">
            <div class="form-group">
                <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="edit_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email <span class="required">*</span></label>
                <input type="email" id="edit_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password Baru <span style="color:var(--text-3);font-weight:400;">(kosongkan jika tidak diubah)</span></label>
                <input type="password" id="edit_password" class="form-control" placeholder="Min. 6 karakter" minlength="6">
            </div>
            <div id="alertEdit"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('modalEdit')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal" style="max-width:420px;">
        <div class="modal-header">
            <h3 class="modal-title">🗑️ Hapus Pengguna</h3>
            <button class="modal-close" onclick="closeModal('modalHapus')">✕</button>
        </div>
        <p style="color:var(--text-2);font-size:14px;">Apakah Anda yakin ingin menghapus pengguna <strong id="hapusName"></strong>? Semua data terkait akan ikut terhapus.</p>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modalHapus')">Batal</button>
            <button class="btn btn-danger" onclick="confirmHapus()">Ya, Hapus</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
const API = '/api';
const COLORS = ['#10b981','#6366f1','#3b82f6','#f59e0b','#ec4899','#06b6d4'];
let deleteId = null;

function openModal(id){ document.getElementById(id).classList.add('open'); }
function closeModal(id){ document.getElementById(id).classList.remove('open'); }

function iniAva(name='') { return name.split(' ').map(w=>w[0]||'').join('').toUpperCase().substring(0,2)||'?'; }

async function loadUsers() {
    try {
        const res = await fetch(`${API}/users`);
        const json = await res.json();
        const data = json.data||[];
        const el = document.getElementById('userList');
        if(!data.length) {
            el.innerHTML = `<div class="empty-state">
                <div style="font-size:48px;">👥</div>
                <div class="empty-state-title">Belum ada pengguna</div>
                <button class="btn btn-primary" onclick="openModal('modalTambah')">Tambah Pengguna</button>
            </div>`;
            return;
        }
        el.innerHTML = `<div class="table-wrapper">
            <table class="data-table">
                <thead><tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr></thead>
                <tbody>
                ${data.map((u,i) => {
                    const colorIdx = i % COLORS.length;
                    const date = u.created_at ? new Date(u.created_at).toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'}) : '—';
                    return `<tr>
                        <td style="width:40px;">${i+1}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="avatar avatar-sm" style="background:${COLORS[colorIdx]};">${iniAva(u.name)}</div>
                                <div class="td-primary">${u.name}</div>
                            </div>
                        </td>
                        <td>${u.email}</td>
                        <td>${date}</td>
                        <td>
                            <div class="action-btns">
                                <button class="btn btn-secondary btn-sm" onclick='openEdit(${JSON.stringify(u)})'>✏️ Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="openHapus(${u.id},'${(u.name||'').replace("'","&apos;")}')">🗑️</button>
                            </div>
                        </td>
                    </tr>`;
                }).join('')}
                </tbody>
            </table>
        </div>`;
    } catch {
        document.getElementById('userList').innerHTML = `<div class="alert alert-danger">Gagal memuat data. Pastikan API server berjalan.</div>`;
    }
}

async function submitTambah(e) {
    e.preventDefault();
    const payload = {
        name: document.getElementById('inp_name').value,
        email: document.getElementById('inp_email').value,
        password: document.getElementById('inp_password').value
    };
    try {
        const res = await fetch(`${API}/users`, {method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
        const json = await res.json();
        if(json.status==='success') {
            closeModal('modalTambah'); document.getElementById('formTambah').reset();
            showFlash('Pengguna berhasil ditambahkan! 🎉','success'); loadUsers();
        } else {
            document.getElementById('alertTambah').innerHTML = `<div class="alert alert-danger">Gagal: ${JSON.stringify(json.message||json)}</div>`;
        }
    } catch { document.getElementById('alertTambah').innerHTML = `<div class="alert alert-danger">Error koneksi API.</div>`; }
}

function openEdit(u) {
    document.getElementById('edit_id').value = u.id;
    document.getElementById('edit_name').value = u.name;
    document.getElementById('edit_email').value = u.email;
    document.getElementById('edit_password').value = '';
    openModal('modalEdit');
}

async function submitEdit(e) {
    e.preventDefault();
    const id = document.getElementById('edit_id').value;
    const payload = { name: document.getElementById('edit_name').value, email: document.getElementById('edit_email').value };
    const pwd = document.getElementById('edit_password').value;
    if(pwd) payload.password = pwd;

    try {
        const res = await fetch(`${API}/users/${id}`, {method:'PUT',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
        const json = await res.json();
        if(json.status==='success') {
            closeModal('modalEdit');
            showFlash('Data pengguna diperbarui! ✅','success'); loadUsers();
        } else {
            document.getElementById('alertEdit').innerHTML = `<div class="alert alert-danger">Gagal memperbarui.</div>`;
        }
    } catch { document.getElementById('alertEdit').innerHTML = `<div class="alert alert-danger">Error koneksi.</div>`; }
}

function openHapus(id, name) { deleteId=id; document.getElementById('hapusName').textContent=name; openModal('modalHapus'); }

async function confirmHapus() {
    if(!deleteId) return;
    try {
        const res = await fetch(`${API}/users/${deleteId}`, {method:'DELETE'});
        const json = await res.json();
        if(json.status==='success') {
            closeModal('modalHapus');
            showFlash('Pengguna berhasil dihapus.','success'); loadUsers();
        }
    } catch { alert('Gagal menghapus.'); }
}

function showFlash(msg,type='success'){
    const colors={success:'background:#d1fae5;color:#065f46',danger:'background:#fee2e2;color:#991b1b'};
    const div=document.createElement('div'); div.className='flash-msg';
    div.style.cssText=colors[type]; div.textContent=msg; document.body.appendChild(div);
}

loadUsers();
</script>
@endpush
@endsection
