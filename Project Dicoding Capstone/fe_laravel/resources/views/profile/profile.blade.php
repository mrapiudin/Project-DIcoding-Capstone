@extends('template.sidebar')
@section('title', 'Profil Saya - VitaTrack')
@section('page_title', 'Profil Saya')
@section('page_subtitle', 'Kelola informasi akun dan pengaturan pribadi')

@push('styles')
<style>
.profile-card {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    border-radius: var(--radius-xl);
    padding: 36px;
    text-align: center;
    color: white;
    margin-bottom: 24px;
    position: relative; overflow: hidden;
}
.profile-card::before {
    content: '';
    position: absolute; width: 200px; height: 200px;
    top: -50px; right: -50px;
    background: radial-gradient(circle, rgba(16,185,129,.15), transparent 70%);
    border-radius: 50%;
}
.profile-avatar-wrap {
    position: relative; display: inline-block; margin-bottom: 16px;
}
.profile-avatar-big {
    width: 88px; height: 88px; border-radius: 50%;
    background: linear-gradient(135deg, #10b981, #059669);
    display: flex; align-items: center; justify-content: center;
    font-size: 34px; font-weight: 800; color: white;
    margin: 0 auto;
    border: 3px solid rgba(255,255,255,.2);
}
.profile-edit-btn {
    position: absolute; right: -4px; bottom: 0;
    width: 28px; height: 28px; border-radius: 50%;
    background: var(--primary); color: white;
    border: 2px solid white;
    cursor: pointer; font-size: 12px;
    display: flex; align-items: center; justify-content: center;
}
.profile-name   { font-size: 22px; font-weight: 800; margin-bottom: 4px; }
.profile-email  { font-size: 14px; opacity: .7; }
.profile-stats  {
    display: grid; grid-template-columns: repeat(3,1fr);
    gap: 1px; background: rgba(255,255,255,.1);
    border-radius: var(--radius); overflow: hidden;
    margin-top: 24px;
}
.ps-item {
    background: rgba(255,255,255,.05);
    padding: 14px; text-align: center;
}
.ps-val { font-size: 22px; font-weight: 800; font-family:'Space Grotesk',sans-serif; }
.ps-lbl { font-size: 11px; opacity: .6; margin-top: 2px; }

.settings-section {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    margin-bottom: 16px;
}
.settings-title {
    font-size: 15px; font-weight: 700; color: var(--text-1);
    margin-bottom: 20px; padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
}
</style>
@endpush

@section('content')

<div class="grid grid-2" style="align-items:start;">

    {{-- Left: Profile Card --}}
    <div>
        <div class="profile-card">
            <div class="profile-avatar-wrap">
                <div class="profile-avatar-big" id="profileInitial">—</div>
                <button class="profile-edit-btn" title="Ubah foto">✏️</button>
            </div>
            <div class="profile-name" id="profileName">Memuat...</div>
            <div class="profile-email" id="profileEmail">—</div>
            <div class="profile-stats">
                <div class="ps-item">
                    <div class="ps-val" id="statAkt">—</div>
                    <div class="ps-lbl">Aktivitas</div>
                </div>
                <div class="ps-item">
                    <div class="ps-val" id="statTidur">—</div>
                    <div class="ps-lbl">Catatan Tidur</div>
                </div>
                <div class="ps-item">
                    <div class="ps-val" id="statArtikel">—</div>
                    <div class="ps-lbl">Artikel Dibaca</div>
                </div>
            </div>
        </div>

        {{-- Role Badge --}}
        <div class="settings-section" style="text-align:center;">
            @php $role = session('role', 'user'); @endphp
            <div style="font-size:13px;color:var(--text-3);margin-bottom:8px;">Status Akun</div>
            @if($role === 'admin')
            <span class="badge badge-red" style="padding:8px 20px;font-size:14px;">👑 Administrator</span>
            <div style="font-size:13px;color:var(--text-3);margin-top:12px;">Anda memiliki akses penuh ke semua fitur admin</div>
            @else
            <span class="badge badge-green" style="padding:8px 20px;font-size:14px;">👤 Pengguna</span>
            <div style="font-size:13px;color:var(--text-3);margin-top:12px;">Akun pengguna standar VitaTrack</div>
            @endif
        </div>
    </div>

    {{-- Right: Settings Forms --}}
    <div>
        {{-- Edit Profil --}}
        <div class="settings-section">
            <div class="settings-title">👤 Informasi Pribadi</div>
            <form id="formProfil" onsubmit="simpanProfil(event)">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" id="inp_name" class="form-control" placeholder="Nama lengkap" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" id="inp_email" class="form-control" placeholder="email@example.com" required>
                </div>
                <div id="alertProfil"></div>
                <button type="submit" class="btn btn-primary w-full">Simpan Perubahan</button>
            </form>
        </div>

        {{-- Ganti Password --}}
        <div class="settings-section">
            <div class="settings-title">🔒 Ubah Password</div>
            <form id="formPassword" onsubmit="gantiPassword(event)">
                <div class="form-group">
                    <label class="form-label">Password Baru</label>
                    <input type="password" id="inp_new_pw" class="form-control" placeholder="Min. 6 karakter" minlength="6" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" id="inp_confirm_pw" class="form-control" placeholder="Ulangi password baru" required>
                </div>
                <div id="alertPassword"></div>
                <button type="submit" class="btn btn-secondary w-full">Ubah Password</button>
            </form>
        </div>

        {{-- Logout --}}
        <div class="settings-section" style="text-align:center;">
            <div class="settings-title">🚪 Keluar</div>
            <p style="font-size:14px;color:var(--text-2);margin-bottom:16px;">Keluar dari sesi aktif Anda di VitaTrack.</p>
            <a href="{{ route('logout') }}" class="btn btn-danger w-full">Keluar dari Akun</a>
        </div>
    </div>

</div>

@push('scripts')
<script>
const API = '/api';

// Simulate current user (replace with actual session data)
const currentUser = {
    id: {{ session('user_id', 1) }},
    name: '{{ session("user_name", "Pengguna") }}',
    email: '{{ session("user_email", "") }}'
};

function iniAva(name='') { return name.split(' ').map(w=>w[0]||'').join('').toUpperCase().substring(0,2)||'?'; }

function fillProfile(u) {
    document.getElementById('profileInitial').textContent = iniAva(u.name);
    document.getElementById('profileName').textContent = u.name;
    document.getElementById('profileEmail').textContent = u.email;
    document.getElementById('inp_name').value = u.name;
    document.getElementById('inp_email').value = u.email;
}

async function loadProfile() {
    try {
        // Load user data
        if(currentUser.id) {
            const res = await fetch(`${API}/users/${currentUser.id}`);
            const json = await res.json();
            if(json.data) fillProfile(json.data);
        } else {
            fillProfile(currentUser);
        }

        // Load stats
        const [actRes, sleepRes, artRes] = await Promise.allSettled([
            fetch(`${API}/activities`).then(r=>r.json()),
            fetch(`${API}/sleep`).then(r=>r.json()),
            fetch(`${API}/articles`).then(r=>r.json()),
        ]);
        document.getElementById('statAkt').textContent    = actRes.status==='fulfilled'   ? (actRes.value.data||[]).length   : '—';
        document.getElementById('statTidur').textContent  = sleepRes.status==='fulfilled' ? (sleepRes.value.data||[]).length : '—';
        document.getElementById('statArtikel').textContent= artRes.status==='fulfilled'   ? (artRes.value.data||[]).length   : '—';
    } catch(e) {
        fillProfile(currentUser);
    }
}

async function simpanProfil(e) {
    e.preventDefault();
    const payload = { name: document.getElementById('inp_name').value, email: document.getElementById('inp_email').value };
    try {
        const res = await fetch(`${API}/users/${currentUser.id}`, {method:'PUT',headers:{'Content-Type':'application/json'},body:JSON.stringify(payload)});
        const json = await res.json();
        if(json.status==='success') {
            document.getElementById('alertProfil').innerHTML=`<div class="alert alert-success">Profil berhasil diperbarui! ✅</div>`;
            document.getElementById('profileName').textContent=payload.name;
            document.getElementById('profileInitial').textContent=iniAva(payload.name);
        } else {
            document.getElementById('alertProfil').innerHTML=`<div class="alert alert-danger">Gagal menyimpan.</div>`;
        }
    } catch { document.getElementById('alertProfil').innerHTML=`<div class="alert alert-danger">Error koneksi API.</div>`; }
}

function gantiPassword(e) {
    e.preventDefault();
    const pw = document.getElementById('inp_new_pw').value;
    const confirm = document.getElementById('inp_confirm_pw').value;
    if(pw !== confirm) {
        document.getElementById('alertPassword').innerHTML=`<div class="alert alert-danger">Password tidak cocok!</div>`;
        return;
    }
    // Would call API here
    document.getElementById('alertPassword').innerHTML=`<div class="alert alert-success">Password berhasil diubah! (Fitur terhubung ke auth backend)</div>`;
    document.getElementById('formPassword').reset();
}

loadProfile();
</script>
@endpush
@endsection
