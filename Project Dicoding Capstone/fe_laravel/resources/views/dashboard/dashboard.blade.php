@extends('template.sidebar')
@section('title', 'Dashboard - VitaTrack')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Selamat datang kembali, pantau perkembangan kesehatanmu 🌿')

@push('styles')
<style>
.hero-banner {
    background: linear-gradient(135deg, #064e3b 0%, #065f46 40%, #047857 100%);
    border-radius: var(--radius-xl);
    padding: 32px;
    margin-bottom: 28px;
    position: relative;
    overflow: hidden;
    color: white;
}
.hero-banner::before {
    content: '';
    position: absolute;
    width: 300px; height: 300px;
    right: -80px; top: -80px;
    background: radial-gradient(circle, rgba(255,255,255,.08) 0%, transparent 70%);
    border-radius: 50%;
}
.hero-banner::after {
    content: '';
    position: absolute;
    width: 200px; height: 200px;
    right: 120px; bottom: -60px;
    background: radial-gradient(circle, rgba(255,255,255,.05) 0%, transparent 70%);
    border-radius: 50%;
}
.hero-greeting {
    font-size: 13px; font-weight: 600; text-transform: uppercase;
    letter-spacing: .1em; opacity: .7; margin-bottom: 6px;
}
.hero-title {
    font-size: 28px; font-weight: 800;
    color: #fff; margin-bottom: 8px;
}
.hero-desc {
    font-size: 14px; opacity: .8; max-width: 460px;
}
.hero-date {
    font-size: 13px; opacity: .65; margin-top: 18px;
}
.hero-cta {
    display: inline-flex; align-items: center; gap: 8px;
    margin-top: 20px;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.25);
    color: #fff;
    padding: 10px 20px;
    border-radius: var(--radius);
    font-size: 14px; font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
    backdrop-filter: blur(8px);
}
.hero-cta:hover { background: rgba(255,255,255,.25); }

/* Quick action cards */
.quick-action-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}
@media(max-width:900px){ .quick-action-grid { grid-template-columns: repeat(2,1fr); } }
@media(max-width:560px){ .quick-action-grid { grid-template-columns: 1fr; } }

.quick-action-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    text-decoration: none;
    color: inherit;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}
.quick-action-card:hover {
    border-color: var(--primary);
    box-shadow: var(--shadow-green);
    transform: translateY(-2px);
}
.qa-icon {
    width: 46px; height: 46px;
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.qa-info { min-width: 0; }
.qa-title { font-size: 14px; font-weight: 700; color: var(--text-1); margin-bottom: 2px; }
.qa-value { font-size: 20px; font-weight: 800; font-family: 'Space Grotesk',sans-serif; }
.qa-unit  { font-size: 12px; color: var(--text-3); }

/* Activity row */
.activity-row {
    display: flex; align-items: center; gap: 14px;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
}
.activity-row:last-child { border-bottom: none; }
.activity-emoji {
    width: 42px; height: 42px;
    border-radius: var(--radius);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}
.activity-name { font-size: 14px; font-weight: 600; color: var(--text-1); }
.activity-meta { font-size: 12px; color: var(--text-3); margin-top: 1px; }
.activity-right { margin-left: auto; text-align: right; }
.activity-dur  { font-size: 15px; font-weight: 700; color: var(--text-1); }
.activity-kal  { font-size: 12px; color: var(--text-3); }

/* Sleep card */
.sleep-row {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
}
.sleep-row:last-child { border-bottom: none; }
.sleep-info { flex: 1; }
.sleep-day  { font-size: 13px; font-weight: 600; color: var(--text-1); }
.sleep-time { font-size: 12px; color: var(--text-3); }
.sleep-duration { font-size: 16px; font-weight: 800; font-family: 'Space Grotesk',sans-serif; }
.sleep-sub { font-size: 11px; color: var(--text-3); }
</style>
@endpush

@section('content')

{{-- Hero Banner --}}
<div class="hero-banner">
    <div class="hero-greeting">📅 {{ now()->translatedFormat('l, d F Y') }}</div>
    <h1 class="hero-title">Selamat datang! 👋</h1>
    <p class="hero-desc">Pantau perkembangan kesehatanmu hari ini. Tetap aktif, istirahat yang cukup, dan jaga pola hidup sehat.</p>
    <a href="{{ route('aktivitas-olahraga') }}" class="hero-cta">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
        </svg>
        Tambah Aktivitas
    </a>
</div>

{{-- Quick Stats --}}
<div class="quick-action-grid">
    <a href="{{ route('aktivitas-olahraga') }}" class="quick-action-card">
        <div class="qa-icon" style="background:#d1fae5;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M22 12H18L15 21L9 3L6 12H2" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="qa-info">
            <div class="qa-title">Total Olahraga</div>
            <div style="display:flex;align-items:baseline;gap:4px;">
                <span class="qa-value" style="color:#059669;" id="totalOlahraga">—</span>
                <span class="qa-unit">menit</span>
            </div>
        </div>
    </a>
    <a href="{{ route('tracking-tidur') }}" class="quick-action-card">
        <div class="qa-icon" style="background:#dbeafe;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" stroke="#2563eb" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="qa-info">
            <div class="qa-title">Rata-rata Tidur</div>
            <div style="display:flex;align-items:baseline;gap:4px;">
                <span class="qa-value" style="color:#2563eb;" id="avgSleep">—</span>
                <span class="qa-unit">jam</span>
            </div>
        </div>
    </a>
    <a href="{{ route('artikel-kesehatan') }}" class="quick-action-card">
        <div class="qa-icon" style="background:#ede9fe;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" stroke="#7c3aed" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" stroke="#7c3aed" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="qa-info">
            <div class="qa-title">Artikel Tersedia</div>
            <div style="display:flex;align-items:baseline;gap:4px;">
                <span class="qa-value" style="color:#7c3aed;" id="totalArtikel">—</span>
                <span class="qa-unit">artikel</span>
            </div>
        </div>
    </a>
</div>

{{-- Main Grid --}}
<div class="grid grid-2">

    {{-- Aktivitas Terbaru --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Aktivitas Terbaru</div>
            <a href="{{ route('aktivitas-olahraga') }}" class="btn btn-ghost btn-sm" style="color:var(--primary);">Lihat Semua →</a>
        </div>
        <div id="activityList">
            <div class="empty-state">
                <div style="font-size:40px;margin-bottom:8px;">🏃</div>
                <div class="empty-state-title">Memuat data...</div>
            </div>
        </div>
    </div>

    {{-- Riwayat Tidur --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Riwayat Tidur</div>
            <a href="{{ route('tracking-tidur') }}" class="btn btn-ghost btn-sm" style="color:var(--info);">Lihat Semua →</a>
        </div>
        <div id="sleepList">
            <div class="empty-state">
                <div style="font-size:40px;margin-bottom:8px;">😴</div>
                <div class="empty-state-title">Memuat data...</div>
            </div>
        </div>
    </div>

</div>

{{-- Artikel Terbaru --}}
<div class="card mb-6" style="margin-top:24px;">
    <div class="card-header">
        <div class="card-title">Artikel Kesehatan Terbaru</div>
        <a href="{{ route('artikel-kesehatan') }}" class="btn btn-ghost btn-sm" style="color:var(--accent);">Lihat Semua →</a>
    </div>
    <div id="artikelList" class="grid grid-3" style="gap:16px;">
        <div class="empty-state" style="grid-column:1/-1;">
            <div style="font-size:40px;margin-bottom:8px;">📰</div>
            <div class="empty-state-title">Memuat artikel...</div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const API_BASE = '/api';

const CATEGORIES = {
    'lari': {icon:'🏃', bg:'#d1fae5'},
    'bersepeda': {icon:'🚴', bg:'#dbeafe'},
    'gym': {icon:'🏋️', bg:'#fef3c7'},
    'yoga': {icon:'🧘', bg:'#cffafe'},
    'renang': {icon:'🏊', bg:'#fce7f3'},
    'default': {icon:'💪', bg:'#f3f4f6'},
};
function getCategory(name='') {
    const k = name.toLowerCase();
    for (const key of Object.keys(CATEGORIES)) {
        if (k.includes(key)) return CATEGORIES[key];
    }
    return CATEGORIES.default;
}

async function loadActivities() {
    try {
        const res = await fetch(`${API_BASE}/activities`);
        const json = await res.json();
        const data = (json.data || []).slice(0,5);
        const el = document.getElementById('activityList');
        if (!data.length) {
            el.innerHTML = `<div class="empty-state"><div style="font-size:42px;">🏃</div><div class="empty-state-title">Belum ada aktivitas</div><a href="{{ route('aktivitas-olahraga') }}" class="btn btn-primary btn-sm mt-4">Tambah Sekarang</a></div>`;
            document.getElementById('totalOlahraga').textContent = '0';
            return;
        }
        let total = 0;
        let html = '';
        data.forEach(a => {
            total += parseInt(a.durasi)||0;
            const cat = getCategory(a.nama_aktivitas);
            html += `<div class="activity-row">
                <div class="activity-emoji" style="background:${cat.bg}">${cat.icon}</div>
                <div><div class="activity-name">${a.nama_aktivitas}</div><div class="activity-meta">${a.kategori} • ${a.day||''}</div></div>
                <div class="activity-right"><div class="activity-dur">${a.durasi} min</div></div>
            </div>`;
        });
        el.innerHTML = html;
        document.getElementById('totalOlahraga').textContent = total;
    } catch(e) {
        document.getElementById('activityList').innerHTML = `<div class="empty-state"><div class="empty-state-title">Tidak dapat memuat data</div></div>`;
    }
}

async function loadSleep() {
    try {
        const res = await fetch(`${API_BASE}/sleep`);
        const json = await res.json();
        const data = (json.data || []).slice(0,5);
        const el = document.getElementById('sleepList');
        if (!data.length) {
            el.innerHTML = `<div class="empty-state"><div style="font-size:42px;">😴</div><div class="empty-state-title">Belum ada data tidur</div><a href="{{ route('tracking-tidur') }}" class="btn btn-primary btn-sm mt-4">Catat Tidur</a></div>`;
            document.getElementById('avgSleep').textContent = '0';
            return;
        }
        let totalMin = 0;
        let html = '';
        data.forEach(s => {
            totalMin += parseInt(s.total)||0;
            const jam = Math.floor((parseInt(s.total)||0)/60);
            const mnt = (parseInt(s.total)||0)%60;
            const quality = jam >= 7 ? {label:'Baik', color:'#059669'} : jam >= 5 ? {label:'Cukup', color:'#d97706'} : {label:'Kurang', color:'#dc2626'};
            html += `<div class="sleep-row">
                <div class="avatar avatar-md" style="background:linear-gradient(135deg,#818cf8,#6366f1)">😴</div>
                <div class="sleep-info">
                    <div class="sleep-day">${s.day||'—'}</div>
                    <div class="sleep-time">${s.jam_tidur} – ${s.jam_bangun}</div>
                </div>
                <div style="text-align:right">
                    <div class="sleep-duration">${jam}j ${mnt}m</div>
                    <div style="font-size:11px;font-weight:600;color:${quality.color}">${quality.label}</div>
                </div>
            </div>`;
        });
        el.innerHTML = html;
        const avg = data.length ? (totalMin/data.length/60).toFixed(1) : '0';
        document.getElementById('avgSleep').textContent = avg;
    } catch(e) {
        document.getElementById('sleepList').innerHTML = `<div class="empty-state"><div class="empty-state-title">Tidak dapat memuat data</div></div>`;
    }
}

async function loadArtikel() {
    try {
        const res = await fetch(`${API_BASE}/articles`);
        const json = await res.json();
        const data = (json.data || []).slice(0,3);
        const el = document.getElementById('artikelList');
        document.getElementById('totalArtikel').textContent = json.data?.length || 0;
        if (!data.length) {
            el.innerHTML = `<div class="empty-state" style="grid-column:1/-1"><div class="empty-state-title">Belum ada artikel</div></div>`;
            return;
        }
        const gradients = ['linear-gradient(135deg,#10b981,#059669)','linear-gradient(135deg,#3b82f6,#2563eb)','linear-gradient(135deg,#8b5cf6,#6d28d9)'];
        let html = '';
        data.forEach((a,i) => {
            const dateStr = a.date ? new Date(a.date).toLocaleDateString('id-ID',{day:'numeric',month:'short',year:'numeric'}) : '—';
            html += `<div class="card" style="padding:0;overflow:hidden;border:1px solid var(--border);">
                <div style="height:120px;background:${gradients[i%gradients.length]};position:relative;">
                    ${a.image?`<img src="${a.image}" style="width:100%;height:100%;object-fit:cover;" alt="">`:''}
                </div>
                <div style="padding:16px;">
                    <div style="font-size:11px;color:var(--text-3);margin-bottom:6px;">${dateStr}</div>
                    <div style="font-size:14px;font-weight:700;color:var(--text-1);margin-bottom:6px;line-height:1.4;">${a.judul}</div>
                    ${a.sub_judul?`<div style="font-size:12px;color:var(--text-2);">${a.sub_judul}</div>`:''}
                    ${a.tautan?`<a href="${a.tautan}" target="_blank" class="btn btn-ghost btn-sm" style="margin-top:10px;color:var(--primary);padding-left:0;">Baca →</a>`:''}
                </div>
            </div>`;
        });
        el.innerHTML = html;
    } catch(e) {
        document.getElementById('artikelList').innerHTML = `<div class="empty-state" style="grid-column:1/-1"><div class="empty-state-title">Tidak dapat memuat artikel</div></div>`;
    }
}

loadActivities();
loadSleep();
loadArtikel();
</script>
@endpush
@endsection