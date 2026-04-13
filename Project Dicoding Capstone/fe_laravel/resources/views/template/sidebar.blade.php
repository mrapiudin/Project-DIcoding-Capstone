<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VitaTrack')</title>
    <meta name="description" content="@yield('meta_description', 'VitaTrack - Platform kesehatan digital untuk aktivitas olahraga, tracking tidur, dan artikel kesehatan.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('sidebar.css') }}">
    @stack('styles')
</head>
<body>

{{-- Mobile Overlay --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="app-container">

    {{-- ===================== SIDEBAR ===================== --}}
    <aside class="sidebar" id="sidebar">

        {{-- Logo --}}
        <div class="sidebar-header">
            <div class="logo">
                <div class="logo-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 12H18L15 21L9 3L6 12H2" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="logo-text">VitaTrack</span>
            </div>
        </div>

        {{-- User Info --}}
        <div class="sidebar-user">
            @php
                $role = session('role', request()->get('role', 'user'));
                $userName = session('user_name', 'Pengguna');
                $userInitial = strtoupper(substr($userName, 0, 1));
            @endphp
            <div class="sidebar-user-avatar" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9);">
                {{ $userInitial }}
            </div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ $userName }}</div>
                <span class="sidebar-user-role {{ $role === 'admin' ? 'role-admin' : 'role-user' }}">
                    {{ $role === 'admin' ? '👑 Admin' : '👤 User' }}
                </span>
            </div>
        </div>

        {{-- Navigation: Common --}}
        <div class="nav-group">
            <div class="nav-group-label">Menu Utama</div>
            <ul class="nav-list">
                @if($role === 'admin')
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="2"/>
                            <rect x="14" y="3" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="2"/>
                            <rect x="3" y="14" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="2"/>
                            <rect x="14" y="14" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span class="nav-text">Dashboard Admin</span>
                    </a>
                </li>
                @else
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="2"/>
                            <rect x="14" y="3" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="2"/>
                            <rect x="3" y="14" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="2"/>
                            <rect x="14" y="14" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>

        @if($role !== 'admin')
        {{-- Navigation: User Section --}}
        <div class="nav-group">
            <div class="nav-group-label">Kesehatan Saya</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->routeIs('aktivitas-olahraga') ? 'active' : '' }}">
                    <a href="{{ route('aktivitas-olahraga') }}" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 12H18L15 21L9 3L6 12H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav-text">Aktivitas Olahraga</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('tracking-tidur') ? 'active' : '' }}">
                    <a href="{{ route('tracking-tidur') }}" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav-text">Tracking Tidur</span>
                    </a>
                </li>
            </ul>
        </div>
        @endif

        @if($role !== 'admin')
        {{-- Navigation: Konten (User) --}}
        <div class="nav-group">
            <div class="nav-group-label">Konten</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->routeIs('artikel-kesehatan') ? 'active' : '' }}">
                    <a href="{{ route('artikel-kesehatan') }}" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav-text">Artikel Kesehatan</span>
                    </a>
                </li>
            </ul>
        </div>
        @else
        {{-- Navigation: Admin Data --}}
        <div class="nav-group">
            <div class="nav-group-label">Manajemen</div>
            <ul class="nav-list">
                <li class="nav-item {{ request()->routeIs('admin.artikel*') ? 'active' : '' }}">
                    <a href="{{ route('admin.artikel.index') }}" class="nav-link">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <span class="nav-text">Kelola Artikel</span>
                    </a>
                </li>
            </ul>
        </div>
        @endif

        {{-- Sidebar Footer --}}
        <div class="sidebar-footer">
            <div class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}" style="margin-bottom:4px;">
                <a href="{{ route('profile') }}" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <span class="nav-text">Profil Saya</span>
                </a>
            </div>
            <a href="{{ route('logout') }}" class="logout-btn">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Keluar</span>
            </a>
        </div>

    </aside>

    {{-- ===================== MAIN CONTENT ===================== --}}
    <main class="main-content">

        {{-- Top Bar --}}
        <div class="topbar">
            <div class="topbar-left">
                <button class="sidebar-toggle" onclick="toggleSidebar()" aria-label="Toggle sidebar">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
                <div>
                    <div class="topbar-title">@yield('page_title', 'VitaTrack')</div>
                    <div class="topbar-subtitle">@yield('page_subtitle', 'Platform kesehatan digital')</div>
                </div>
            </div>
            <div class="topbar-right">
                <button class="topbar-icon-btn" title="Notifikasi">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <a href="{{ route('profile') }}" class="topbar-profile">
                    <div class="topbar-avatar avatar-green">{{ $userInitial }}</div>
                    <div>
                        <div class="topbar-user-name">{{ $userName }}</div>
                        <div class="topbar-user-role">{{ $role === 'admin' ? 'Administrator' : 'User' }}</div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Page Content --}}
        <div class="page-content">
            @yield('content')
        </div>

    </main>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('open');
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('open');
}

// Auto-dismiss flash messages
document.addEventListener('DOMContentLoaded', function(){
    const flash = document.querySelector('.flash-msg');
    if (flash) {
        setTimeout(function(){ flash.style.opacity = '0'; flash.style.transform = 'translateX(120%)'; }, 3500);
        setTimeout(function(){ flash.remove(); }, 4000);
    }
});
</script>

@stack('scripts')
</body>
</html>
