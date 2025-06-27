<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Cenderawasih</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/pp.png') }}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(#fff);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: linear-gradient(#fff);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            z-index: 1000;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(145deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            backdrop-filter: blur(10px);
            z-index: -1;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            position: relative;
        }

        .sidebar-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 2px;
        }

        .sidebar-title {
            color: black;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 0.5px;
        }

        .sidebar-subtitle {
            color: black;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            font-weight: 300;
        }

        .sidebar-nav {
            padding: 1.5rem 0;
        }

        .nav-item {
            margin: 0.5rem 1rem;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: black;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            font-weight: 500;
            border-radius: 12px;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 12px;
        }

        .nav-link:hover::before {
            opacity: 1;
        }

        .nav-link:hover {
            color: black;
            transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .nav-link.active {
            
            color: black;
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);
            transform: translateX(4px);
        }

        .nav-link.active::before {
            opacity: 0;
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            margin-right: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .nav-link:hover .nav-icon {
            transform: scale(1.1);
        }

        .nav-text {
            font-size: 1rem;
            font-weight: 500;
        }

        /* Logout Section */
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
        }

        .logout-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: black;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.05);
        }

        .logout-link:hover {
            color: black;
            background: rgba(255, 107, 107, 0.1);
            border-color: rgba(255, 107, 107, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.2);
        }

        /* Main Content */
        .content {
            flex: 1;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            margin: 1rem;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .content-header {
            background: linear-gradient(135deg, #667eea 0%, #a7f3d0 100%);
            color: white;
            padding: 2rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .content-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        .content-body {
            padding: 2.5rem;
            background: whitesmoke;
        }

        /* Mobile Toggle Button - Always visible */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            right: 12px;
            z-index: 10001;
            background: #fff;
            color: black;
            border: none;
            padding: 0.75rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            font-size: 1.2rem;
            width: 50px;
            height: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-toggle:hover {
            background: #fff;
            transform: scale(1.05);
        }

        .mobile-toggle:active {
            transform: scale(0.55);
        }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .mobile-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
                
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                height: 40vh;
                z-index: 10000;
                transition: left 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
                box-shadow: 4px 0 30px rgba(0, 0, 0, 0.3);
            }

            .sidebar.show {
                left: 0;
            }

            .main-container {
                flex-direction: column;
            }

            .content {
                margin: 0;
                border-radius: 0;
                margin-top: 0;
            }

            .content-header {
                padding-top: 4rem;
            }

            .welcome-title {
                font-size: 1.5rem;
            }

            .welcome-subtitle {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 100%;
            }

            .content-header {
                padding: 3rem 1.5rem 2rem;
            }

            .content-body {
                padding: 1.5rem;
            }

            .sidebar-header {
                padding: 1.5rem 1rem;
            }

            .sidebar-title {
                font-size: 1.3rem;
            }
        }

        /* Decorative Elements */
        .decorative-circles {
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            opacity: 0.1;
        }

        .decorative-circles::before,
        .decorative-circles::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: white;
        }

        .decorative-circles::before {
            width: 60px;
            height: 60px;
            top: 20px;
            right: 20px;
            animation: pulse 4s infinite;
        }

        .decorative-circles::after {
            width: 30px;
            height: 30px;
            top: 50px;
            right: 60px;
            animation: pulse 4s infinite 2s;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.1; }
            50% { transform: scale(1.2); opacity: 0.2; }
        }
    </style>
</head>
<body>
    <!-- Mobile Toggle Button -->
    <button class="mobile-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <div class="main-container">
        <!-- Enhanced Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4 class="sidebar-title">
                    <i class="fas fa-chart-line me-2"></i>
                    SPK Pimpinan
                </h4>
                <p class="sidebar-subtitle">Sistem Pendukung Keputusan</p>
                <div class="decorative-circles"></div>
            </div>

            <div class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ route('pimpinan.dashboard') }}"
                       class="nav-link {{ request()->is('pimpinan/dashboard*') ? 'active' : '' }}">
                        <div class="nav-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>

                <div class="nav-item">
                    <a href="{{ route('pimpinan.laporan') }}"
                       class="nav-link {{ request()->is('pimpinan/laporan*') ? 'active' : '' }}">
                        <div class="nav-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <span class="nav-text">Laporan</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="logout-link">
                        <div class="nav-icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span class="nav-text">Keluar</span>
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="content">
            <header class="content-header">
                <h1 class="welcome-title">
                    <i class="fas fa-user-tie me-3"></i>
                    Selamat Datang, {{ Auth::user()->name }}
                </h1>
                <p class="welcome-subtitle">
                    <i class="fas fa-calendar-alt me-2"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} | Dashboard Pimpinan
                </p>
            </header>
            
            <div class="content-body">
                <!-- Dashboard Content -->
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar for mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar.classList.contains('show')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        }

        function openSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.add('show');
            overlay.classList.add('show');
            
            // Prevent body scroll when sidebar is open
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            
            // Restore body scroll
            document.body.style.overflow = '';
        }

        // Handle logout
        function handleLogout(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                document.getElementById('logout-form').submit();
            }
        }

        // Add smooth animations for nav links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                // On mobile, close sidebar when nav link is clicked
                if (window.innerWidth <= 768) {
                    setTimeout(() => {
                        closeSidebar();
                    }, 200);
                }
                
                // Remove active class from all links
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                // Add active class to clicked link
                this.classList.add('active');
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });

        // Handle escape key to close sidebar
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && window.innerWidth <= 768) {
                closeSidebar();
            }
        });

        // Prevent clicks inside sidebar from closing it
        document.getElementById('sidebar').addEventListener('click', function(event) {
            event.stopPropagation();
        });
    </script>
    @stack('scripts')
</body>
</html>