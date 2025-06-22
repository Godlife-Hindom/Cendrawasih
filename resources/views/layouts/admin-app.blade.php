<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SPK Penangkaran Cendrawasih</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --bg-light: #ffffff;
            --bg-dark: #212529;
            --text-light: #212529;
            --text-dark: #f8f9fa;
            --primary: #0d6efd;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: all 0.3s ease;
        }

        body.dark-mode {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        .wrapper {
            display: flex;
            flex-wrap: nowrap;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            border-right: 1px solid #dee2e6;
            padding: 1.5rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar .logo img {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            object-fit: cover;
            margin: auto;
            display: block;
        }

        .sidebar h6 {
            text-align: center;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            color: inherit;
            border-radius: 10px;
            text-decoration: none;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .sidebar a i {
            font-size: 1.2rem;
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #e9f2ff;
            color: var(--primary);
        }

        .sidebar a.active {
            background-color: #d0e4ff;
            color: var(--primary);
            font-weight: bold;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: 0;
        }

        .navbar-profile {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .navbar-profile img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            margin-right: 1rem;
            color: inherit;
            display: none; /* Hidden by default on desktop */
        }

        .dark-toggle {
            position: absolute;
            bottom: 60px;
            left: 20px;
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 6px;
            background-color: #f8f9fa;
            color: #212529;
            border: 1px solid #ced4da;
        }

        .dark-toggle i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .dark-toggle:hover {
            background-color: #e2e6ea;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            border-radius: 8px;
            padding: 8px 12px;
        }

        .btn-logout:hover {
            background-color: #bb2d3b;
        }

        /* DARK MODE */
        body.dark-mode .sidebar {
            background-color: rgba(33, 37, 41, 0.9);
        }

        body.dark-mode .main-content {
            background-color: #2e2e42;
        }

        body.dark-mode .dark-toggle {
            background-color: #343a40;
            color: #f8f9fa;
            border-color: #495057;
        }

        body.dark-mode .dark-toggle:hover {
            background-color: #495057;
        }

        /* Responsive for Mobile */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: 60vh;
                position: fixed;
                top: 0;
                left: 0;
                transform: translateX(-100%);
                z-index: 1050;
            }

            .sidebar.mobile-visible {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .toggle-btn {
                display: block; /* Show toggle button on mobile */
            }

            .navbar-profile {
                flex-direction: row;
                align-items: center;
                gap: 1rem;
            }

            .dark-toggle {
                position: static;
                margin-top: 1rem;
            }
        }

        /* Overlay for mobile when sidebar is open */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
        }

        @media (max-width: 768px) {
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>

</head>
<body>

<div class="wrapper">

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="text-center mb-4 logo">
            <img src="{{ asset('images/pp.png') }}" alt="Logo">
            <h5 class="text-primary">{{ Auth::user()->name }}</h5>
            <h6 class="text-black">Dashboard Admin</h6>
        </div>


        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i><span>Dashboard</span>
        </a>
        <a href="{{ route('criteria.index') }}" class="{{ request()->routeIs('criteria.index') ? 'active' : '' }}">
            <i class="bi bi-funnel"></i><span>Kriteria dan Subkriteria</span>
        </a>
        <a href="{{ route('alternatives.index') }}" class="{{ request()->routeIs('alternatives.index') ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i><span>Alternatif Lokasi</span>
        </a>

        <a href="{{ route('admin.laporan.index') }}" class="{{ request()->routeIs('admin.laporan.index') ? 'active' : '' }}">
            <i class="bi bi-bell"></i><span>Pemberitahuan Laporan</span>
        </a>

        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i><span>Logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <button type="submit" class="btn btn-logout w-100">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Mobile Toggle Button -->
        <div class="navbar-profile">
            <button class="toggle-btn" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            <div class="d-flex align-items-center">
                <!-- Profile content can go here -->
            </div>
        </div>

        @yield('content')
    </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Dark Mode
    if(localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
    }

    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('darkMode', document.body.classList.contains('dark-mode') ? 'enabled' : 'disabled');
    }

    // Sidebar Toggle (Mobile)
    document.getElementById('toggleSidebar').addEventListener('click', () => {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.toggle('mobile-visible');
        overlay.classList.toggle('show');
    });

    // Close sidebar when clicking overlay
    document.getElementById('sidebarOverlay').addEventListener('click', () => {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.remove('mobile-visible');
        overlay.classList.remove('show');
    });

    // Close sidebar when clicking on menu items (mobile)
    if (window.innerWidth <= 768) {
        document.querySelectorAll('.sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                
                sidebar.classList.remove('mobile-visible');
                overlay.classList.remove('show');
            });
        });
    }
</script>
@stack('scripts')
</body>
</html>
