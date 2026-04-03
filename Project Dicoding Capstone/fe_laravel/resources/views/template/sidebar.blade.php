<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HealthSpace')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('sidebar.css') }}">
    @stack('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Logo -->
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 9L15 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15 9L9 15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="logo-text">HealthSpace</span>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="sidebar-nav">
                <ul class="nav-list">
                    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('activity.activity') ? 'active' : '' }}">
                        <a href="{{ route('activity.activity') }}" class="nav-link">
                            <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 12H18L15 21L9 3L6 12H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="nav-text">Aktivitas Olahraga</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('tracking-tidur') ? 'active' : '' }}">
                        <a href="{{ route('tracking-tidur') }}" class="nav-link">
                            <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 12.79C20.8427 14.4922 20.2039 16.1144 19.1583 17.4668C18.1127 18.8192 16.7035 19.8458 15.0957 20.4265C13.4879 21.0073 11.748 21.1181 10.0795 20.7461C8.41104 20.3741 6.88302 19.5345 5.67425 18.3258C4.46548 17.117 3.62596 15.589 3.25393 13.9205C2.8819 12.252 2.99274 10.5121 3.57348 8.9043C4.15423 7.29651 5.18085 5.88737 6.53324 4.84175C7.88562 3.79614 9.50782 3.15731 11.21 3C10.2134 4.34827 9.73387 6.00945 9.85856 7.68141C9.98324 9.35338 10.7039 10.9251 11.8894 12.1106C13.0749 13.2961 14.6466 14.0168 16.3186 14.1414C17.9906 14.2661 19.6517 13.7866 21 12.79Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="nav-text">Tracking Tidur</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('artikel-kesehatan') ? 'active' : '' }}">
                        <a href="{{ route('artikel-kesehatan') }}" class="nav-link">
                            <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 19.5C4 18.837 4.26339 18.2011 4.73223 17.7322C5.20107 17.2634 5.83696 17 6.5 17H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.5 2H20V22H6.5C5.83696 22 5.20107 21.7366 4.73223 21.2678C4.26339 20.7989 4 20.163 4 19.5V4.5C4 3.83696 4.26339 3.20107 4.73223 2.73223C5.20107 2.26339 5.83696 2 6.5 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="nav-text">Artikel Kesehatan</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Profile Section (Bottom) -->
            <div class="sidebar-footer">
                <div class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}" class="nav-link">
                        <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav-text">Profile</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 17L21 12L16 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="nav-text">Logout</span>
                    </a>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            

            <div class="page-content">
                @yield('content')
            </div>
        </main>
    </div>
    
    @stack('scripts')
</body>
</html>
