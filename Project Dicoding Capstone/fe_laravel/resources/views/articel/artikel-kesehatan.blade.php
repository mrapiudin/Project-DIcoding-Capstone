@extends('template.sidebar')
@section('title', 'Artikel Kesehatan - VitaTrack')
@section('page_title', 'Artikel Kesehatan')
@section('page_subtitle', 'Informasi dan tips kesehatan terpercaya untuk gaya hidup sehat')

@push('styles')
<style>
.article-search {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 20px 24px;
    margin-bottom: 24px;
    display: flex; align-items: center; gap: 12px;
}
.article-search input {
    flex: 1; border: 1.5px solid var(--border); border-radius: var(--radius-sm);
    padding: 10px 16px; font-size: 14px; transition: var(--transition);
    background: var(--surface2); color: var(--text-1);
}
.article-search input:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(16,185,129,.1); }

.article-grid {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 20px;
}
@media(max-width:1100px){ .article-grid { grid-template-columns: repeat(2,1fr); } }
@media(max-width:640px)  { .article-grid { grid-template-columns: 1fr; } }

.article-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    display: flex; flex-direction: column;
    transition: var(--transition);
}
.article-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-3px); }

.article-thumb {
    height: 170px;
    display: flex; align-items: center; justify-content: center;
    font-size: 52px;
    position: relative; overflow: hidden;
}
.article-thumb img { width:100%; height:100%; object-fit:cover; position:absolute; inset:0; }

.article-body { padding: 18px; flex: 1; display: flex; flex-direction: column; }
.article-date { font-size: 11px; color: var(--text-3); margin-bottom: 8px; }
.article-title { font-size: 15px; font-weight: 700; color: var(--text-1); margin-bottom: 6px; line-height: 1.4; }
.article-sub   { font-size: 13px; color: var(--text-2); flex: 1; line-height: 1.5; }
.article-footer { padding: 12px 18px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }

/* Featured big card */
.article-featured {
    background: linear-gradient(135deg, #064e3b, #065f46);
    border-radius: var(--radius-xl);
    padding: 36px 40px;
    color: white;
    margin-bottom: 28px;
    position: relative; overflow: hidden;
}
.article-featured::after {
    content: '📰';
    position: absolute; right: 32px; top: 50%; transform: translateY(-50%);
    font-size: 100px; opacity: .1;
}
.af-tag { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; opacity: .7; margin-bottom: 8px; }
.af-title { font-size: 24px; font-weight: 800; margin-bottom: 10px; max-width: 500px; }
.af-desc  { font-size: 14px; opacity: .8; max-width: 420px; }
</style>
@endpush

@section('content')

{{-- Featured Banner --}}
<div class="article-featured">
    <div class="af-tag">📌 Tips Kesehatan</div>
    <div class="af-title">Hidup Sehat Dimulai dari Kebiasaan Kecil</div>
    <div class="af-desc">Tidur cukup, makan bergizi, dan olahraga rutin adalah kunci tubuh dan pikiran yang sehat setiap hari.</div>
</div>

{{-- Search --}}
<div class="article-search">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="color:var(--text-3);flex-shrink:0;">
        <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
        <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2"/>
    </svg>
    <input type="text" id="searchInput" placeholder="Cari artikel kesehatan..." oninput="filterArtikel()">
</div>

{{-- Articles Grid --}}
<div class="article-grid" id="artikelGrid">
    <div class="empty-state" style="grid-column:1/-1;">
        <div style="font-size:48px;">📰</div>
        <div class="empty-state-title">Memuat artikel...</div>
    </div>
</div>

@push('scripts')
<script>
const API = '/api';
const GRADIENTS = [
    'linear-gradient(135deg,#10b981,#059669)',
    'linear-gradient(135deg,#3b82f6,#2563eb)',
    'linear-gradient(135deg,#8b5cf6,#6d28d9)',
    'linear-gradient(135deg,#f59e0b,#d97706)',
    'linear-gradient(135deg,#ec4899,#db2777)',
    'linear-gradient(135deg,#06b6d4,#0891b2)',
];
const EMOJI = ['🏃','😴','🥗','🧘','💪','❤️','🌿','💊'];
let allArtikel = [];

function formatDate(d) {
    if(!d) return '—';
    return new Date(d).toLocaleDateString('id-ID',{day:'numeric',month:'long',year:'numeric'});
}

function renderArtikel(data) {
    const el = document.getElementById('artikelGrid');
    if(!data.length) {
        el.innerHTML = `<div class="empty-state" style="grid-column:1/-1;">
            <div style="font-size:48px;">📰</div>
            <div class="empty-state-title">Tidak ada artikel ditemukan</div>
        </div>`;
        return;
    }
    el.innerHTML = data.map((a,i) => {
        const grad = GRADIENTS[i%GRADIENTS.length];
        const emoji = EMOJI[i%EMOJI.length];
        return `<div class="article-card" style="cursor:pointer;" onclick="showDetail(${JSON.stringify(a).replace(/"/g,'&quot;')})">
            <div class="article-thumb" style="background:${grad};">
                ${a.image ? `<img src="${a.image}" alt="${a.judul}">` : `<span>${emoji}</span>`}
            </div>
            <div class="article-body">
                <div class="article-date">📅 ${formatDate(a.date)}</div>
                <div class="article-title">${a.judul}</div>
                ${a.sub_judul?`<div class="article-sub">${a.sub_judul}</div>`:''}
                ${a.isi?`<div class="article-sub" style="margin-top:4px;">${a.isi.substring(0,100)}${a.isi.length>100?'...':''}</div>`:''}
            </div>
            <div class="article-footer">
                <span class="badge badge-green">Kesehatan</span>
                ${a.tautan?`<a href="${a.tautan}" target="_blank" class="btn btn-ghost btn-sm" style="color:var(--primary);padding:0;">Baca →</a>`:`<span class="btn btn-ghost btn-sm" onclick="event.stopPropagation();showDetail(${JSON.stringify(a).replace(/"/g,'&quot;')})" style="color:var(--primary);padding:0;">Lihat →</span>`}
            </div>
        </div>`;
    }).join('');
}

function filterArtikel() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    const filtered = allArtikel.filter(a => a.judul.toLowerCase().includes(q) || (a.sub_judul||'').toLowerCase().includes(q) || (a.isi||'').toLowerCase().includes(q));
    renderArtikel(filtered);
}

async function loadArtikel() {
    try {
        const res = await fetch(`${API}/articles`);
        const json = await res.json();
        allArtikel = json.data||[];
        renderArtikel(allArtikel);
    } catch {
        document.getElementById('artikelGrid').innerHTML = `<div class="alert alert-danger" style="grid-column:1/-1">Gagal memuat artikel. Pastikan API server berjalan.</div>`;
    }
}

function showDetail(a) {
    const overlay = document.createElement('div');
    overlay.className = 'modal-overlay open';
    overlay.innerHTML = `<div class="modal" style="max-width:640px;max-height:80vh;overflow-y:auto;">
        <div class="modal-header">
            <h3 class="modal-title" style="font-size:18px;">${a.judul}</h3>
            <button class="modal-close" onclick="this.closest('.modal-overlay').remove()">✕</button>
        </div>
        ${a.sub_judul?`<div style="font-size:14px;color:var(--text-2);font-weight:600;margin-bottom:12px;">${a.sub_judul}</div>`:''}
        <div style="font-size:12px;color:var(--text-3);margin-bottom:16px;">📅 ${formatDate(a.date)}</div>
        <div style="font-size:14px;color:var(--text-2);line-height:1.8;white-space:pre-wrap;">${a.isi||''}</div>
        ${a.tautan?`<div class="modal-footer"><a href="${a.tautan}" target="_blank" class="btn btn-primary">Buka Tautan Asli 🔗</a></div>`:''}
    </div>`;
    overlay.addEventListener('click', e => { if(e.target===overlay) overlay.remove(); });
    document.body.appendChild(overlay);
}

loadArtikel();
</script>
@endpush
@endsection
