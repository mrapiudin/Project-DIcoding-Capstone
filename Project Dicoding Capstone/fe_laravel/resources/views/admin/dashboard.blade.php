@extends('template.sidebar')

@section('title', 'Dashboard Admin - HealthSpace')

@push('styles')
<style>
/* Admin Dashboard Styles */
.admin-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 24px;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
}

.admin-header h1 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 8px;
}

.admin-header p {
    opacity: 0.9;
    font-size: 16px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-left: 4px solid #10b981;
}

.stat-card h3 {
    font-size: 14px;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 12px;
    font-weight: 600;
}

.stat-number {
    font-size: 36px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 8px;
}

.stat-change {
    font-size: 14px;
    color: #10b981;
    font-weight: 500;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 32px;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px;
    background: white;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    text-decoration: none;
    color: #374151;
    transition: all 0.2s ease;
}

.action-btn:hover {
    border-color: #10b981;
    background: #f0fdf4;
    color: #059669;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
}

.action-icon {
    width: 40px;
    height: 40px;
    background: #f3f4f6;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.action-btn:hover .action-icon {
    background: #d1fae5;
}

.recent-activity {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.activity-item {
    display: flex;
    align-items: start;
    gap: 16px;
    padding: 16px 0;
    border-bottom: 1px solid #f3f4f6;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-avatar {
    width: 48px;
    height: 48px;
    background: #d1fae5;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.activity-content h4 {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 4px;
}

.activity-content p {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 4px;
}

.activity-time {
    font-size: 12px;
    color: #9ca3af;
}
</style>
@endpush

@section('content')
<div class="admin-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1>Dashboard Admin</h1>
            <p>Kelola dan pantau aktivitas pengguna HealthSpace</p>
        </div>
        <div style="display: flex; align-items: center; gap: 12px;">
            <span style="opacity: 0.9; font-size: 14px;">📅 {{ date('d M Y') }}</span>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Pengguna</h3>
        <div class="stat-number">1,247</div>
        <div class="stat-change">+12% dari bulan lalu</div>
    </div>
    
    <div class="stat-card">
        <h3>Artikel Dipublikasi</h3>
        <div class="stat-number">89</div>
        <div class="stat-change">+5 artikel minggu ini</div>
    </div>
    
    <div class="stat-card">
        <h3>Aktivitas Hari Ini</h3>
        <div class="stat-number">342</div>
        <div class="stat-change">+23% dari kemarin</div>
    </div>
    
    <div class="stat-card">
        <h3>Engagement Rate</h3>
        <div class="stat-number">87%</div>
        <div class="stat-change">+3% bulan ini</div>
    </div>
</div>

<!-- Quick Actions -->
<div style="margin-bottom: 24px;">
    <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 16px; color: #111827;">Aksi Cepat</h2>
    <div class="quick-actions">
        <a href="{{ route('admin.create-artikel') }}" class="action-btn">
            <div class="action-icon">
                ✍️
            </div>
            <div>
                <div style="font-weight: 600;">Buat Artikel Baru</div>
                <div style="font-size: 14px; color: #6b7280;">Tulis artikel kesehatan</div>
            </div>
        </a>
        
        <a href="#" class="action-btn">
            <div class="action-icon">
                👥
            </div>
            <div>
                <div style="font-weight: 600;">Kelola Pengguna</div>
                <div style="font-size: 14px; color: #6b7280;">Lihat & kelola user</div>
            </div>
        </a>
        
        <a href="#" class="action-btn">
            <div class="action-icon">
                📊
            </div>
            <div>
                <div style="font-weight: 600;">Lihat Analitik</div>
                <div style="font-size: 14px; color: #6b7280;">Report & statistik</div>
            </div>
        </a>
        
        <a href="#" class="action-btn">
            <div class="action-icon">
                ⚙️
            </div>
            <div>
                <div style="font-weight: 600;">Pengaturan</div>
                <div style="font-size: 14px; color: #6b7280;">Konfigurasi sistem</div>
            </div>
        </a>
    </div>
</div>

<!-- Recent Activity -->
<div class="recent-activity">
    <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 20px; color: #111827;">Aktivitas Terbaru</h2>
    
    <div class="activity-item">
        <div class="activity-avatar">👤</div>
        <div class="activity-content">
            <h4>Pengguna Baru Terdaftar</h4>
            <p>Ahmad Rizki bergabung dengan HealthSpace</p>
            <div class="activity-time">2 menit yang lalu</div>
        </div>
    </div>
    
    <div class="activity-item">
        <div class="activity-avatar">📝</div>
        <div class="activity-content">
            <h4>Artikel Baru Dipublikasi</h4>
            <p>"Tips Olahraga di Rumah untuk Pemula" telah dipublikasi</p>
            <div class="activity-time">15 menit yang lalu</div>
        </div>
    </div>
    
    <div class="activity-item">
        <div class="activity-avatar">🏃</div>
        <div class="activity-content">
            <h4>Target Aktivitas Tercapai</h4>
            <p>Sarah Putri menyelesaikan target lari harian 5km</p>
            <div class="activity-time">32 menit yang lalu</div>
        </div>
    </div>
    
    <div class="activity-item">
        <div class="activity-avatar">💬</div>
        <div class="activity-content">
            <h4>Komentar Baru</h4>
            <p>3 komentar baru pada artikel "Pentingnya Hidrasi"</p>
            <div class="activity-time">1 jam yang lalu</div>
        </div>
    </div>
    
    <div class="activity-item">
        <div class="activity-avatar">⭐</div>
        <div class="activity-content">
            <h4>Rating Artikel</h4>
            <p>Artikel "Diet Sehat untuk Remaja" mendapat rating 4.8/5</p>
            <div class="activity-time">2 jam yang lalu</div>
        </div>
    </div>
</div>
@endsection