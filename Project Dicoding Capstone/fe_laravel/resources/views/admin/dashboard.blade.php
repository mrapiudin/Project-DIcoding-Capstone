@extends('template.sidebar')
@section('title', 'Dashboard Admin - VitaTrack')
@section('page_title', 'Dashboard Admin')
@section('page_subtitle', 'Kelola dan pantau seluruh data platform VitaTrack')

@push('styles')
<style>
.admin-welcome {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0f172a 100%);
    border-radius: var(--radius-xl);
    padding: 32px;
    margin-bottom: 28px;
    color: white;
    display: flex; align-items: center; justify-content: space-between;
    position: relative; overflow: hidden;
}
.admin-welcome::before {
    content: '⚙️';
    position: absolute; right: 32px; font-size: 120px; opacity: .07;
}
.aw-title { font-size: 26px; font-weight: 800; margin-bottom: 6px; }
.aw-sub   { font-size: 14px; opacity: .7; }
.aw-date  { margin-top: 12px; font-size: 13px; opacity: .6; }

.admin-stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 20px;
    display: flex; align-items: center; gap: 16px;
    position: relative; overflow: hidden;
    transition: var(--transition);
}
.admin-stat-card:hover { box-shadow: var(--shadow); transform: translateY(-2px); }
.admin-stat-card .accent-line {
    position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
}

.quick-links-grid {
    display: grid;
    grid-template-columns: repeat(4,1fr);
    gap: 16px;
    margin-bottom: 28px;
}
@media(max-width:1000px){ .quick-links-grid { grid-template-columns: repeat(2,1fr); } }
@media(max-width:480px)  { .quick-links-grid { grid-template-columns: 1fr; } }

.ql-card {
    background: var(--surface);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 18px;
    display: flex; flex-direction: column; align-items: center;
    gap: 10px; text-align: center;
    text-decoration: none; color: inherit;
    transition: var(--transition);
}
.ql-card:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-green);
    transform: translateY(-2px);
    color: var(--primary);
}
.ql-icon {
    width: 52px; height: 52px;
    border-radius: var(--radius-lg);
    display: flex; align-items: center; justify-content: center;
    font-size: 24px;
}
.ql-title { font-size: 13px; font-weight: 700; }
.ql-desc  { font-size: 12px; color: var(--text-3); }

/* Timeline */
.tl-item {
    display: flex; gap: 14px; padding-bottom: 20px; position: relative;
}
.tl-item::after {
    content:''; position:absolute; left:19px; top:42px; bottom:0;
    width:2px; background:var(--border);
}
.tl-item:last-child::after { display:none; }
.tl-dot {
    width:40px; height:40px; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    flex-shrink:0; font-size:18px;
    position:relative; z-index:1;
}
.tl-body { flex:1; }
.tl-title { font-size:14px; font-weight:600; color:var(--text-1); }
.tl-desc  { font-size:13px; color:var(--text-2); margin-top:1px; }
.tl-time  { font-size:11px; color:var(--text-3); margin-top:4px; }
</style>
@endpush

@section('content')

{{-- Welcome --}}
<div class="admin-welcome">
    <div>
        <div class="aw-title">👑 Panel Admin</div>
        <div class="aw-sub">Selamat datang di dashboard administrator VitaTrack</div>
        <div class="aw-date">📅 {{ now()->translatedFormat('l, d F Y') }}</div>
    </div>
    <a href="{{ route('admin.artikel.create') }}" class="btn" style="background:rgba(16,185,129,.2);border:1.5px solid rgba(16,185,129,.4);color:#6ee7b7;">
        ✍️ Buat Artikel
    </a>
</div>

{{-- Stats --}}
<div class="stats-grid mb-6">
    <div class="admin-stat-card">
        <div class="accent-line" style="background:#10b981;"></div>
        <div class="stat-icon stat-icon-green">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="#059669" stroke-width="2"/>
                <circle cx="9" cy="7" r="4" stroke="#059669" stroke-width="2"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="#059669" stroke-width="2"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Total Pengguna</div>
            <div class="stat-value" id="statUsers">—</div>
            <div class="stat-change">👥 Terdaftar</div>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="accent-line" style="background:#6366f1;"></div>
        <div class="stat-icon stat-icon-purple">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" stroke="#6366f1" stroke-width="2"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" stroke="#6366f1" stroke-width="2"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Total Artikel</div>
            <div class="stat-value" id="statArtikel">—</div>
            <div class="stat-change">📰 Dipublikasi</div>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="accent-line" style="background:#3b82f6;"></div>
        <div class="stat-icon stat-icon-blue">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M22 12H18L15 21L9 3L6 12H2" stroke="#2563eb" stroke-width="2"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Total Aktivitas</div>
            <div class="stat-value" id="statActivities">—</div>
            <div class="stat-change">💪 Tercatat</div>
        </div>
    </div>
    <div class="admin-stat-card">
        <div class="accent-line" style="background:#8b5cf6;"></div>
        <div class="stat-icon stat-icon-purple">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" stroke="#7c3aed" stroke-width="2"/>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Data Tidur</div>
            <div class="stat-value" id="statSleep">—</div>
            <div class="stat-change">😴 Terekam</div>
        </div>
    </div>
</div>

{{-- Quick Links --}}
<h2 style="font-size:18px;font-weight:700;margin-bottom:16px;">⚡ Aksi Cepat</h2>
<div class="quick-links-grid mb-8">
    <a href="{{ route('admin.artikel.create') }}" class="ql-card">
        <div class="ql-icon" style="background:#d1fae5;">✍️</div>
        <div class="ql-title">Buat Artikel</div>
        <div class="ql-desc">Tulis konten baru</div>
    </a>
    <a href="{{ route('admin.artikel.index') }}" class="ql-card">
        <div class="ql-icon" style="background:#ede9fe;">📚</div>
        <div class="ql-title">Kelola Artikel</div>
        <div class="ql-desc">Edit & hapus artikel</div>
    </a>
    <a href="{{ route('admin.users.index') }}" class="ql-card">
        <div class="ql-icon" style="background:#dbeafe;">👥</div>
        <div class="ql-title">Kelola User</div>
        <div class="ql-desc">Manage pengguna</div>
    </a>
    <a href="{{ route('admin.activities.index') }}" class="ql-card">
        <div class="ql-icon" style="background:#fef3c7;">📊</div>
        <div class="ql-title">Data Aktivitas</div>
        <div class="ql-desc">Pantau semua data</div>
    </a>
</div>

{{-- Recent Data Grid --}}
<div class="grid grid-2">
    {{-- Recent Users --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">👥 Pengguna Terbaru</div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm" style="color:var(--primary);">Lihat Semua →</a>
        </div>
        <div id="recentUsers">
            <div class="empty-state"><div style="font-size:32px;">👥</div><div class="empty-state-title">Memuat...</div></div>
        </div>
    </div>

    {{-- Recent Articles --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">📰 Artikel Terbaru</div>
            <a href="{{ route('admin.artikel.index') }}" class="btn btn-ghost btn-sm" style="color:var(--primary);">Lihat Semua →</a>
        </div>
        <div id="recentArtikel">
            <div class="empty-state"><div style="font-size:32px;">📰</div><div class="empty-state-title">Memuat...</div></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const API = '/api';
const COLORS = ['#10b981','#6366f1','#3b82f6','#f59e0b','#ec4899'];

function iniAva(name='') {
    return name.split(' ').map(w=>w[0]||'').join('').toUpperCase().substring(0,2)||'?';
}

async function loadStats() {
    const endpoints = ['users','articles','activities','sleep'];
    const ids = ['statUsers','statArtikel','statActivities','statSleep'];
    await Promise.allSettled(endpoints.map(async (ep,i) => {
        try {
            const res = await fetch(`${API}/${ep}`);
            const j = await res.json();
            document.getElementById(ids[i]).textContent = (j.data||[]).length;
        } catch { document.getElementById(ids[i]).textContent = '—'; }
    }));
}

async function loadRecentUsers() {
    try {
        const res = await fetch(`${API}/users`);
        const j = await res.json();
        const data = (j.data||[]).slice(0,5);
        const el = document.getElementById('recentUsers');
        if(!data.length) { el.innerHTML=`<div class="empty-state"><div class="empty-state-title">Belum ada pengguna</div></div>`; return; }
        el.innerHTML = data.map((u,i) => `<div style="display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid var(--border);">
            <div class="avatar avatar-sm" style="background:${COLORS[i%COLORS.length]};width:36px;height:36px;font-size:12px;">${iniAva(u.name)}</div>
            <div style="flex:1;min-width:0;">
                <div style="font-size:14px;font-weight:600;color:var(--text-1);">${u.name}</div>
                <div style="font-size:12px;color:var(--text-3);">${u.email}</div>
            </div>
        </div>`).join('');
    } catch { document.getElementById('recentUsers').innerHTML=`<div class="alert alert-danger">Gagal memuat.</div>`; }
}

async function loadRecentArtikel() {
    try {
        const res = await fetch(`${API}/articles`);
        const j = await res.json();
        const data = (j.data||[]).slice(0,5);
        const el = document.getElementById('recentArtikel');
        if(!data.length) { el.innerHTML=`<div class="empty-state"><div class="empty-state-title">Belum ada artikel</div></div>`; return; }
        el.innerHTML = data.map(a => {
            const date = a.date ? new Date(a.date).toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'}) : '—';
            return `<div style="padding:12px 0;border-bottom:1px solid var(--border);">
                <div style="font-size:14px;font-weight:600;color:var(--text-1);margin-bottom:3px;">${a.judul}</div>
                <div style="display:flex;align-items:center;gap:8px;">
                    <span style="font-size:11px;color:var(--text-3);">📅 ${date}</span>
                    ${a.sub_judul?`<span class="badge badge-green" style="font-size:10px;">${a.sub_judul.substring(0,20)}...</span>`:''}
                </div>
            </div>`;
        }).join('');
    } catch { document.getElementById('recentArtikel').innerHTML=`<div class="alert alert-danger">Gagal memuat.</div>`; }
}

loadStats();
loadRecentUsers();
loadRecentArtikel();
</script>
@endpush
@endsection