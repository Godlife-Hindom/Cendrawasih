<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SPK Penangkaran Cendrawasih</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('images/pp.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-gradient: linear-gradient(#ffffff);
      --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      --dark-bg: #1a1a2e;
      --dark-secondary: #16213e;
      --light-bg: #f8f9fa;
      --accent-color: #00f2fe;
      --accent-color1: #fff;
      --text-muted: #a0a0a0;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      background: linear-gradient(#ffffff);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body.dark-mode {
      background-color: var(--dark-bg);
      color: #fff;
    }

    .sidebar {
      width: 280px;
      background: var(--primary-gradient);
      color: #000000;
      padding: 0;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(10px);
    }

    /* Perbaikan untuk screenshot full page */
    @media print {
      .sidebar {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        height: 100% !important;
        min-height: 100vh !important;
      }
      
      .main-content {
        position: relative !important;
      }
    }

    /* Tambahan untuk browser yang mendukung CSS untuk screenshot */
    .sidebar {
      position: -webkit-sticky;
      position: sticky;
      position: fixed;
    }

    

    /* Perbaikan khusus untuk screenshot tools */
    html.screenshot-mode .sidebar,
    body.screenshot-mode .sidebar {
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      height: auto !important;
      min-height: 100vh !important;
    }

    html.screenshot-mode .main-content,
    body.screenshot-mode .main-content {
      position: relative !important;
    }

    .sidebar::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
      pointer-events: none;
    }

    .sidebar.collapsed {
      width: 80px;
    }

    /* Header Section */
    .sidebar-header {
      padding: 25px 20px;
      text-align: center;
      border-bottom: 1px solid rgba(0,0,0,0.1);
      position: relative;
      background: rgba(255,255,255,0.05);
    }

    .sidebar-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 2px;
      background: var(--accent-color);
      border-radius: 2px;
    }

    .sidebar .profile {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
    }

    .sidebar .profile .avatar-container {
      position: relative;
      transition: all 0.3s ease;
    }

    .sidebar .profile .avatar-container::before {
      content: '';
      position: absolute;
      top: -3px;
      left: -3px;
      right: -3px;
      bottom: -3px;
      background: var(--success-gradient);
      border-radius: 50%;
      opacity: 0;
      transition: all 0.3s ease;
    }

    .sidebar .profile .avatar-container:hover::before {
      opacity: 1;
      animation: pulse 2s infinite;
    }

    .sidebar .profile img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid rgba(0,0,0,0.3);
      position: relative;
      z-index: 2;
      transition: all 0.3s ease;
    }

    .sidebar .profile img:hover {
      transform: scale(1.05);
      border-color: var(--accent-color);
    }

    .sidebar .profile-info {
      text-align: center;
      transition: all 0.3s ease;
    }

    .sidebar .profile h5 {
      margin: 0;
      font-size: 18px;
      font-weight: 600;
      color: #000000;
      text-shadow: 0 2px 4px rgba(255,255,255,0.3);
    }

    .sidebar .profile .status {
      font-size: 12px;
      color: #333333;
      font-weight: 500;
      margin-top: 3px;
      opacity: 0.9;
    }

    .sidebar.collapsed .profile-info {
      opacity: 0;
      transform: scale(0.8);
    }

    /* Navigation Section */
    .sidebar-nav {
      padding: 20px 0;
      flex: 1;
    }

    .nav-section {
      margin-bottom: 30px;
    }

    .nav-section-title {
      color: rgba(0,0,0,0.6);
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 0 25px 10px;
      margin-bottom: 10px;
      position: relative;
    }

    .sidebar.collapsed .nav-section-title {
      opacity: 0;
    }

    .sidebar a, .sidebar button {
      display: flex;
      align-items: center;
      padding: 15px 25px;
      color: rgba(0,0,0,0.85);
      text-decoration: none;
      border: none;
      background: none;
      width: 100%;
      font-size: 15px;
      font-weight: 500;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .sidebar a::before, .sidebar button::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 4px;
      background: var(--accent-color);
      transform: scaleY(0);
      transition: transform 0.3s ease;
    }

    .sidebar a:hover::before, .sidebar button:hover::before {
      transform: scaleY(1);
    }

    .sidebar a:hover, .sidebar button:hover {
      background: rgba(0,0,0,0.15);
      color: #000000;
      transform: translateX(8px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .sidebar a.active {
      background: rgba(0,0,0,0.2);
      color: #000000;
      font-weight: 600;
    }

    .sidebar a.active::before {
      transform: scaleY(1);
    }

    .sidebar i {
      font-size: 1.4rem;
      margin-right: 15px;
      min-width: 24px;
      transition: all 0.3s ease;
      color: #000000;
    }

    .sidebar a:hover i, .sidebar button:hover i {
      transform: scale(1.1);
      color: var(--accent-color);
    }

    .sidebar.collapsed i {
      margin: auto;
      font-size: 1.6rem;
    }

    .sidebar.collapsed a span,
    .sidebar.collapsed button span {
      opacity: 0;
      transform: translateX(-10px);
    }

    /* Toggle Button */
    .toggle-sidebar {
      position: absolute;
      top: 25px;
      right: -15px;
      background: black;
      color: whitesmoke;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      cursor: pointer;
      transition: all 0.3s ease;
      z-index: 1001;
    }

    .toggle-sidebar:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }

    .toggle-sidebar i {
      font-size: 16px;
      margin: 0;
      transition: transform 0.3s ease;
    }

    /* Mobile Toggle Button */
    .mobile-toggle {
      position: fixed;
      top: 15px;
      right: 15px;
      left: auto;
      z-index: 1100;
      background: var(--accent-color1) !important;
      border: none;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: none;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
    }

    .mobile-toggle:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
    }

    .mobile-toggle i {
      font-size: 20px;
      color: black !important;
      margin: 0;
    }

    /* Dark Mode Toggle */
    .dark-toggle {
      position: absolute;
      bottom: 20px;
      left: 0;
      right: 0;
      padding: 15px 25px;
      cursor: pointer;
      font-size: 14px;
      display: flex;
      align-items: center;
      color: rgba(0,0,0,0.8);
      transition: all 0.3s ease;
      border-top: 1px solid rgba(0,0,0,0.1);
      background: rgba(255,255,255,0.05);
    }

    .dark-toggle:hover {
      background: rgba(0,0,0,0.1);
      color: #000000;
    }

    .dark-toggle i {
      margin-right: 12px;
      font-size: 1.2rem;
      transition: all 0.3s ease;
      color: #000000;
    }

    .dark-toggle:hover i {
      color: var(--accent-color);
      transform: rotate(20deg);
    }

    .sidebar.collapsed .dark-toggle span {
      opacity: 0;
    }

    .sidebar.collapsed .dark-toggle {
      justify-content: center;
    }

    .sidebar.collapsed .dark-toggle i {
      margin: 0;
    }

    /* === Main Content Layout === */
    .main-content {
      margin-left: 280px;
      padding: 20px;
      width: calc(100% - 280px);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      min-height: 100vh;
    }

    .sidebar.collapsed ~ .main-content {
      margin-left: 80px;
      width: calc(100% - 80px);
    }

    /* === Content Styling (Box, Shadow, Blur) === */
    .content {
      flex: 1;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      margin: 1rem;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    /* === Content Header (Gradient) === */
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

    /* === Content Body (White Panel Inside) === */
    .content-body {
      padding: 2.5rem;
      background: white;
    }

    /* === Custom Navbar === */
    .navbar-custom {
      background: white;
      color: #333;
      font-weight: 600;
      font-size: 20px;
      border-bottom: 1px solid #e9ecef;
      padding: 20px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    body.dark-mode .navbar-custom {
      background-color: var(--dark-secondary);
      color: white;
      border-color: #444;
    }

    /* Animations */
    @keyframes pulse {
      0% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.05); opacity: 0.7; }
      100% { transform: scale(1); opacity: 1; }
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(-20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .sidebar a, .sidebar button {
      animation: slideIn 0.3s ease forwards;
    }

    .sidebar a:nth-child(1) { animation-delay: 0.1s; }
    .sidebar a:nth-child(2) { animation-delay: 0.2s; }
    .sidebar a:nth-child(3) { animation-delay: 0.3s; }
    .sidebar a:nth-child(4) { animation-delay: 0.4s; }

    /* Overlay untuk mobile */
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }

    .overlay.show {
      opacity: 1;
      visibility: visible;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        left: -280px;
        position: fixed;
        top: 0;
        height: 100vh;
      }

      .sidebar.show {
        left: 0;
      }

      .main-content {
        margin-left: 0 !important;
        width: 100% !important;
      }

      .mobile-toggle {
        display: flex;
      }

      .toggle-sidebar {
        display: none;
      }

      /* Adjust content header untuk mobile */
      .content-header {
        margin-top: 0;
        border-radius: 0 0 20px 20px;
      }

      .welcome-title {
        font-size: 1.5rem;
      }

      .welcome-subtitle {
        font-size: 1rem;
      }
    }

    @media (max-width: 576px) {
      .content-header {
        padding: 1.5rem;
      }

      .content-body {
        padding: 1.5rem;
      }

      .welcome-title {
        font-size: 1.3rem;
      }

      .mobile-toggle {
        width: 45px;
        height: 45px;
        top: 12px;
        right: 12px;
      }

      .mobile-toggle i {
        font-size: 25px;
      }
    }

    .toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }

    /* Scrollbar Styling */
    .sidebar::-webkit-scrollbar {
      width: 4px;
    }

    .sidebar::-webkit-scrollbar-track {
      background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
      background: rgba(255,255,255,0.3);
      border-radius: 2px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
      background: rgba(255,255,255,0.5);
    }
  </style>
  @stack('styles')
</head>
<body class="dark-mode-enabled">
  <!-- Mobile Toggle Button -->
  <button class="btn btn-success mobile-toggle" onclick="toggleResponsiveSidebar()">
    <i class="bi bi-list"></i>
  </button>

  <!-- Overlay untuk mobile -->
  <div class="overlay" id="overlay" onclick="toggleResponsiveSidebar()"></div>

  <div class="sidebar" id="sidebar">
    <div class="profile">
      <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('images/pp.png') }}" alt="Profil">
      <h5>{{ Auth::user()->name }}</h5>
    </div>

    <a href="{{ url('/user/dashboard') }}"><i class="bi bi-house-door"></i> <span>Dashboard</span></a>
    <a href="{{ url('/user/alternatives/create') }}"><i class="bi bi-plus-circle"></i> <span>Tambah Lokasi</span></a>
    <!-- Menu Baru: Lihat Kriteria -->
    <a href="{{ route('user.criteria.index') }}"><i class="bi bi-sliders"></i> <span>Data Kriteria dan Subkriteria</span></a>
    <a href="{{ url('/user/alternatives') }}"><i class="bi bi-list-task"></i> <span>Data Alternatif</span></a>
    <a href="{{ url('/user/view-map') }}"><i class="bi bi-geo-alt-fill"></i> <span>Peta Rekomendasi</span></a>
    

    <form action="{{ url('/logout') }}" method="POST">
      @csrf
      <button type="submit"><i class="bi bi-box-arrow-right"></i> <span>Keluar</span></button>
    </form>
  </div>

  <div class="main-content" id="mainContent">
    <header class="content-header">
    <h1 class="welcome-title">
    <i class="fas fa-user-tie me-3"></i>Selamat Datang, {{ Auth::user()->name }}
    </h1>
    <p class="welcome-subtitle">
    <i class="fas fa-calendar-alt me-2"></i>
    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} | Dashboard User
    </p>
    </header>

    <div class="content-body">
    @yield('content')

    @if(session('warning'))
      <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    </div>
  </div>

  <div class="toast-container"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const icon = document.getElementById('toggleIcon');
      sidebar.classList.toggle('collapsed');
      if (icon) {
        icon.classList.toggle('bi-chevron-left');
        icon.classList.toggle('bi-chevron-right');
      }
    }

    function toggleDarkMode() {
      const body = document.body;
      body.classList.toggle('dark-mode');
      const darkMode = body.classList.contains('dark-mode') ? 'enabled' : 'disabled';

      // Simpan ke localStorage dan juga update session via fetch atau AJAX jika perlu
      localStorage.setItem('darkMode', darkMode);
    }

    function toggleResponsiveSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('overlay');
      const isShowing = sidebar.classList.contains('show');
      
      if (isShowing) {
        // Tutup sidebar
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        document.body.style.overflow = 'auto';
      } else {
        // Buka sidebar
        sidebar.classList.add('show');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
      }
    }

    // Tutup sidebar ketika klik di luar (pada overlay)
    document.addEventListener('click', function(e) {
      const sidebar = document.getElementById('sidebar');
      const mobileToggle = document.querySelector('.mobile-toggle');
      const overlay = document.getElementById('overlay');
      
      // Jika sidebar sedang terbuka dan klik bukan pada sidebar atau toggle button
      if (sidebar.classList.contains('show') && 
          !sidebar.contains(e.target) && 
          !mobileToggle.contains(e.target)) {
        toggleResponsiveSidebar();
      }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('overlay');
      
      if (window.innerWidth > 768) {
        // Desktop mode - tutup mobile sidebar jika terbuka
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        document.body.style.overflow = 'auto';
      }
    });

    // Load dark mode from localStorage
    if (localStorage.getItem('darkMode') === 'enabled') {
      document.body.classList.add('dark-mode');
    }

    // Prevent body scroll when sidebar is open on mobile
    function preventBodyScroll() {
      const sidebar = document.getElementById('sidebar');
      if (sidebar.classList.contains('show') && window.innerWidth <= 768) {
        document.body.style.overflow = 'hidden';
      } else {
        document.body.style.overflow = 'auto';
      }
    }

    // Call prevent body scroll on page load
    document.addEventListener('DOMContentLoaded', preventBodyScroll);

    // Fungsi untuk screenshot mode (opsional - jika dibutuhkan)
    function enableScreenshotMode() {
      document.documentElement.classList.add('screenshot-mode');
      document.body.classList.add('screenshot-mode');
    }

    function disableScreenshotMode() {
      document.documentElement.classList.remove('screenshot-mode');
      document.body.classList.remove('screenshot-mode');
    }
  </script>
  @stack('scripts')
</body>
</html>