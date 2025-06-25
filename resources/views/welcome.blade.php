<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SPK Cendrawasih</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Nunito', sans-serif;
      color: black;
      background: linear-gradient(135deg, #d1fae5 0%, #ffffff 50%, #a7f3d0 100%);
      min-height: 100vh;
      overflow-x: hidden;
    }
    
    /* Tambahan untuk smooth scrolling mobile */
    * {
      -webkit-overflow-scrolling: touch;
    }
    
    html {
      scroll-behavior: smooth;
      -webkit-text-size-adjust: 100%;
    }
    
    body {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }
    
    /* Optimasi untuk mobile scrolling */
    @media (max-width: 768px) {
      * {
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
      }
      
      body {
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
      }
    }
    
    .glow {
      text-shadow: 0 0 20px rgba(255, 255, 255, 0.8), 0 0 40px rgba(255, 255, 255, 0.4);
    }
    
    .glass {
      backdrop-filter: blur(15px);
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    
    .parallax {
      background-image: url('{{ asset('images/pp.png') }}');
      background-attachment: fixed;
      background-position: center;
      background-size: 500px;
      opacity: 0.1;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -5;
      animation: float 20s ease-in-out infinite;
      /* Optimasi mobile */
      will-change: transform;
      transform: translateZ(0);
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
    }
    
    .card-hover {
      transition: all 0.3s ease;
      /* Optimasi mobile */
      will-change: transform;
      transform: translateZ(0);
    }
    
    .card-hover:hover {
      transform: translateY(-10px) scale(1.05);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .btn-hover {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      /* Optimasi mobile */
      will-change: transform;
      transform: translateZ(0);
    }
    
    .btn-hover::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: left 0.5s;
    }
    
    .btn-hover:hover::before {
      left: 100%;
    }
    
    .text-gradient {
      background: linear-gradient(135deg, #1e40af, #059669);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .floating-icons {
      animation: bounce 2s ease-in-out infinite;
      /* Optimasi mobile */
      will-change: transform;
      transform: translateZ(0);
    }
    
    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    
    .pulse-ring {
      animation: pulse-ring 2s infinite;
      /* Optimasi mobile */
      will-change: transform, opacity;
      transform: translateZ(0);
    }
    
    @keyframes pulse-ring {
      0% { transform: scale(1); opacity: 1; }
      100% { transform: scale(1.2); opacity: 0; }
    }
    
    .bg-pattern {
      background-image: 
        radial-gradient(circle at 25% 25%, rgba(59,130,246,0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(34,197,94,0.1) 0%, transparent 50%);
    }
    
    /* Mobile Menu Styles */
    .mobile-menu {
      transform: translateX(100%);
      transition: transform 0.3s ease-in-out;
      /* Optimasi mobile */
      will-change: transform;
      -webkit-transform: translateZ(0);
    }
    
    .mobile-menu.active {
      transform: translateX(0);
    }
    
    .mobile-overlay {
    background-color: #fff; /* putih */
    opacity: 1;
    visibility: hidden;
    transition: all 0.3s ease-in-out;
    position: fixed;
    inset: 0;
    z-index: 998;
}

  .mobile-overlay.active {
    opacity: 1;
    visibility: visible;
  }
    
    .hamburger {
      cursor: pointer;
      transition: all 0.3s ease;
      /* Optimasi mobile */
      will-change: transform;
      transform: translateZ(0);
    }
    
    .hamburger.active {
      transform: rotate(45deg);
    }

    /* Tambahan untuk toggle navbar yang responsif */
    .navbar-collapse {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-in-out;
    }
    
    .navbar-collapse.show {
      max-height: 500px;
    }
    
    .navbar-toggler {
      border: none;
      background: transparent;
      padding: 4px;
      border-radius: 4px;
      transition: all 0.3s ease;
    }
    
    .navbar-toggler:focus {
      outline: none;
      box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }
    
    .navbar-toggler span {
      display: block;
      width: 25px;
      height: 3px;
      background-color: #374151;
      margin: 5px 0;
      transition: 0.3s;
      border-radius: 2px;
    }
    
    .navbar-toggler.active span:nth-child(1) {
      transform: rotate(-45deg) translate(-5px, 6px);
    }
    
    .navbar-toggler.active span:nth-child(2) {
      opacity: 0;
    }
    
    .navbar-toggler.active span:nth-child(3) {
      transform: rotate(45deg) translate(-5px, -6px);
    }
    
    /* Smooth scrolling optimization untuk mobile */
    @media (max-width: 768px) {
      .parallax {
        background-size: 200px;
        background-attachment: scroll; /* Ubah ke scroll untuk mobile */
      }
      
      /* Disable animasi berat pada mobile untuk performa */
      .floating-icons {
        animation-duration: 3s;
      }
      
      .pulse-ring {
        animation-duration: 3s;
      }
      
      /* Optimasi touch untuk mobile */
      .card-hover:active,
      .btn-hover:active {
        transform: scale(0.98);
      }
      
      /* Smooth transition untuk mobile menu */
      .mobile-menu {
        -webkit-overflow-scrolling: touch;
      }

      /* Navbar collapse untuk mobile */
      .navbar-collapse {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        margin-top: 10px;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      }
    }
    
    @media (max-width: 640px) {
      .parallax {
        background-size: 150px;
        background-attachment: scroll; /* Ubah ke scroll untuk mobile */
      }
    }
    
    /* Additional mobile optimizations */
    @media (max-width: 480px) {
      /* Reduce motion untuk device dengan layar kecil */
      * {
        animation-duration: 0.5s !important;
        transition-duration: 0.3s !important;
      }
      
      .card-hover:hover {
        transform: translateY(-5px) scale(1.02);
      }
    }
    
    /* Smooth scroll behavior enhancement */
      html {
        scroll-behavior: smooth;
      }
    
    /* Touch action optimization */
    .card-hover,
    .btn-hover,
    .mobile-menu {
      touch-action: manipulation;
    }
  </style>
</head>

<body class="bg-pattern">
  <!-- Background Parallax -->
  <div class="parallax"></div>

  <!-- Mobile Overlay -->
  <div id="mobileOverlay" class="mobile-overlay fixed inset-0 bg-wihte bg-opacity-50 z-20 md:hidden"></div>

  <!-- Navigation Bar -->
  <nav class="fixed top-0 w-full z-50 glass" data-aos="fade-down">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center py-4">
        <div class="text-xl font-bold text-gradient">SPK Cendrawasih</div>
        
        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-8">
          <a href="#home" class="hover:text-blue-600 transition-colors">Beranda</a>
          <a href="#fitur" class="hover:text-blue-600 transition-colors">Fitur</a>
          <a href="#about" class="hover:text-blue-600 transition-colors">Tentang</a>
          <a href="/login" class="btn-hover bg-green-200 hover:bg-blue-300 text-black px-8 py-3 rounded-full font-semibold transition-all shadow-lg">
          Login
        </a>
        <a href="/register" class="btn-hover bg-green-200 hover:bg-blue-300 text-black px-8 py-3 rounded-full font-semibold transition-all shadow-lg">
          Daftar
        </a>
        </div>
        
        <!-- Mobile Toggle Button -->
        <div class="md:hidden flex items-center space-x-2">
          <button id="navbarToggler" class="navbar-toggler" type="button">
            <span></span>
            <span></span>
            <span></span>
          </button>
          <button id="mobileToggle" class="hamburger text-2xl focus:outline-none">☰</button>
        </div>
      </div>

      <!-- Mobile Navbar Collapse -->
      <div id="navbarCollapse" class="navbar-collapse md:hidden">
        <div class="flex flex-col space-y-3 py-2">
          <a href="#home" class="navbar-link hover:text-blue-600 transition-colors py-2 px-3 rounded">Beranda</a>
          <a href="#fitur" class="navbar-link hover:text-blue-600 transition-colors py-2 px-3 rounded">Fitur</a>
          <a href="#about" class="navbar-link hover:text-blue-600 transition-colors py-2 px-3 rounded">Tentang</a>
          <div class="flex flex-col space-y-2 pt-2">
            <a href="/login" class="btn-hover bg-green-200 hover:bg-blue-300 text-black px-6 py-2 rounded-full font-semibold transition-all shadow-lg text-center">
              Login
            </a>
            <a href="/register" class="btn-hover bg-green-200 hover:bg-blue-300 text-black px-6 py-2 rounded-full font-semibold transition-all shadow-lg text-center">
              Daftar
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu fixed top-0 right-0 h-full w-64 glass backdrop-blur-xl z-50 md:hidden">
      <div class="flex flex-col h-full">
        <div class="flex justify-between items-center p-4 border-b border-white/20">
          <div class="text-lg font-bold text-gradient">Menu</div>
          <button id="mobileClose" class="text-2xl focus:outline-none">✕</button>
        </div>
        <div class="flex flex-col space-y-4 p-6">
          <a href="#home" class="mobile-link hover:text-blue-600 transition-colors py-2 border-b border-white/10">Beranda</a>
          <a href="#fitur" class="mobile-link hover:text-blue-600 transition-colors py-2 border-b border-white/10">Fitur</a>
          <a href="#about" class="mobile-link hover:text-blue-600 transition-colors py-2 border-b border-white/10">Tentang</a>
          <div class="pt-4 space-y-3">
            <a href="/login" class="block btn-hover bg-green-200 hover:bg-blue-300 text-black px-6 py-3 rounded-full font-semibold transition-all shadow-lg text-center">
              Login
            </a>
            <a href="/register" class="block btn-hover bg-green-200 hover:bg-blue-300 text-black px-6 py-3 rounded-full font-semibold transition-all shadow-lg text-center">
              Daftar
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Container -->
  <div id="home" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-20 flex flex-col items-center justify-center text-center space-y-16 relative z-10">

    <!-- Header -->
    <div class="space-y-6" data-aos="fade-down" data-aos-duration="1200">
      <div class="relative">
        <div class="absolute inset-0 pulse-ring bg-blue-200 rounded-full opacity-20"></div>
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold glow tracking-wide relative z-10">
          SPK CENDRAWASIH
        </h1>
      </div>
      <p class="text-gray-700 text-base sm:text-lg md:text-xl mt-4 max-w-2xl mx-auto leading-relaxed">
        Sistem Pendukung Keputusan Penangkaran Burung Cendrawasih berbasis Metode ARAS dan GIS
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
        <a href="/login" class="btn-hover bg-green-200 hover:bg-blue-300 text-black px-8 py-3 rounded-full font-semibold transition-all shadow-lg">
          Masuk Ke Sistem
        </a>
      </div>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 w-full max-w-4xl" data-aos="fade-up" data-aos-delay="100">
      <div class="glass rounded-xl p-4 text-center card-hover">
        <div class="text-2xl sm:text-3xl font-bold text-gradient">100%</div>
        <div class="text-sm text-gray-600">Akurasi</div>
      </div>
      <div class="glass rounded-xl p-4 text-center card-hover">
        <div class="text-2xl sm:text-3xl font-bold text-gradient">4</div>
        <div class="text-sm text-gray-600">Kriteria</div>
      </div>
      <div class="glass rounded-xl p-4 text-center card-hover">
        <div class="text-2xl sm:text-3xl font-bold text-gradient">GIS</div>
        <div class="text-sm text-gray-600">Teknologi</div>
      </div>
      <div class="glass rounded-xl p-4 text-center card-hover">
        <div class="text-2xl sm:text-3xl font-bold text-gradient">ARAS</div>
        <div class="text-sm text-gray-600">Metode</div>
      </div>
    </div>

    <!-- Fitur Cards -->
    <div id="fitur" class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 w-full" data-aos="fade-up" data-aos-delay="200">
      <div class="bg-blue-200 glass rounded-2xl p-6 lg:p-8 text-center card-hover group">
        <div class="text-4xl sm:text-5xl mb-4 floating-icons">📊</div>
        <h3 class="text-lg sm:text-xl font-semibold mb-3 group-hover:text-blue-700 transition-colors">Analisis Multi-Kriteria</h3>
        <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
          Menggunakan metode ARAS untuk mengevaluasi lokasi penangkaran berdasarkan vegetasi, iklim, air, dan topografi.
        </p>
        <div class="mt-4 h-1 bg-gradient-to-r from-blue-400 to-green-400 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform"></div>
      </div>
      
      <div class="bg-blue-200 glass rounded-2xl p-6 lg:p-8 text-center card-hover group">
        <div class="text-4xl sm:text-5xl mb-4 floating-icons" style="animation-delay: 0.5s;">🗺️</div>
        <h3 class="text-lg sm:text-xl font-semibold mb-3 group-hover:text-blue-700 transition-colors">Peta Interaktif</h3>
        <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
          Terintegrasi dengan GIS untuk menampilkan lokasi terbaik secara visual dan real-time.
        </p>
        <div class="mt-4 h-1 bg-gradient-to-r from-blue-400 to-green-400 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform"></div>
      </div>
      
      <div class="bg-blue-200 glass rounded-2xl p-6 lg:p-8 text-center card-hover group">
        <div class="text-4xl sm:text-5xl mb-4 floating-icons" style="animation-delay: 1s;">🌿</div>
        <h3 class="text-lg sm:text-xl font-semibold mb-3 group-hover:text-blue-700 transition-colors">Pendekatan Berkelanjutan</h3>
        <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
          Memastikan konservasi spesies cendrawasih dengan pendekatan berbasis data lingkungan.
        </p>
        <div class="mt-4 h-1 bg-gradient-to-r from-blue-400 to-green-400 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform"></div>
      </div>
    </div>

    <!-- How It Works Section -->
    <div id="about" class="max-w-4xl text-center space-y-6" data-aos="fade-up" data-aos-delay="300">
      <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gradient">Bagaimana Sistem Ini Bekerja?</h2>
      <div class="glass rounded-2xl p-6 lg:p-8">
        <p class="text-gray-700 text-sm sm:text-base lg:text-lg leading-relaxed">
          Pengguna dapat memilih titik lokasi pada peta Kabupaten Fakfak, lalu sistem akan mengambil nilai vegetasi (NDVI), ketersediaan air (NDWI), topografi (DSM), dan iklim (curah hujan). Skor ARAS dihitung secara otomatis dan menghasilkan rekomendasi lokasi terbaik untuk penangkaran.
        </p>
      </div>
      
      <!-- Process Steps -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
        <div class="text-center">
          <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mx-auto mb-2">
            <span class="font-bold">1</span>
          </div>
          <p class="text-sm font-medium">Pilih Lokasi</p>
        </div>
        <div class="text-center">
          <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mx-auto mb-2">
            <span class="font-bold">2</span>
          </div>
          <p class="text-sm font-medium">Analisis Data</p>
        </div>
        <div class="text-center">
          <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mx-auto mb-2">
            <span class="font-bold">3</span>
          </div>
          <p class="text-sm font-medium">Hitung ARAS</p>
        </div>
        <div class="text-center">
          <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center mx-auto mb-2">
            <span class="font-bold">4</span>
          </div>
          <p class="text-sm font-medium">Rekomendasi</p>
        </div>
      </div>
    </div>

    <!-- CTA Section -->

    <!-- Footer -->
    <footer class="text-center space-y-4 mt-16" data-aos="fade-up" data-aos-delay="500">
      <div class="flex justify-center space-x-6 text-2xl">
        <div class="floating-icons"></div>
        <div class="floating-icons" style="animation-delay: 0.3s;"></div>
        <div class="floating-icons" style="animation-delay: 0.6s;"></div>
      </div>
      <p class="text-sm text-gray-500">
        &copy; 2025 SPK Penangkaran Cendrawasih - Made by GNAH
      </p>
    </footer>
  </div>

  <!-- AOS Script -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    // Initialize AOS
    AOS.init({
      once: true,
      duration: 1000,
      easing: 'ease-out-cubic'
    });

    // Mobile Menu Toggle Functionality
    document.addEventListener('DOMContentLoaded', function() {
      const mobileToggle = document.getElementById('mobileToggle');
      const mobileClose = document.getElementById('mobileClose');
      const mobileMenu = document.getElementById('mobileMenu');
      const mobileOverlay = document.getElementById('mobileOverlay');
      const mobileLinks = document.querySelectorAll('.mobile-link');

      // Tambahan untuk navbar toggle
      const navbarToggler = document.getElementById('navbarToggler');
      const navbarCollapse = document.getElementById('navbarCollapse');
      const navbarLinks = document.querySelectorAll('.navbar-link');

      function openMobileMenu() {
        mobileMenu.classList.add('active');
        mobileOverlay.classList.add('active');
        mobileToggle.classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      function closeMobileMenu() {
        mobileMenu.classList.remove('active');
        mobileOverlay.classList.remove('active');
        mobileToggle.classList.remove('active');
        document.body.style.overflow = '';
      }

      // Fungsi toggle untuk navbar collapse
      function toggleNavbar() {
        navbarCollapse.classList.toggle('show');
        navbarToggler.classList.toggle('active');
      }

      function closeNavbar() {
        navbarCollapse.classList.remove('show');
        navbarToggler.classList.remove('active');
      }

      // Event listeners untuk navbar toggle
      if (navbarToggler) {
        navbarToggler.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          toggleNavbar();
        });
      }

      // Close navbar ketika link diklik
      navbarLinks.forEach(link => {
        link.addEventListener('click', function() {
          closeNavbar();
        });
      });

      // Event listeners for mobile menu
      if (mobileToggle) {
        mobileToggle.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          openMobileMenu();
        });
      }

      if (mobileClose) {
        mobileClose.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          closeMobileMenu();
        });
      }

      if (mobileOverlay) {
        mobileOverlay.addEventListener('click', function(e) {
          e.preventDefault();
          closeMobileMenu();
        });
      }

      // Close menu when clicking on mobile links
      mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
          closeMobileMenu();
        });
      });

      // Close menu on escape key
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          closeMobileMenu();
          closeNavbar();
        }
      });

      // Close menu on window resize if opened
      window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
          closeMobileMenu();
          closeNavbar();
        }
      });

      // Close navbar ketika klik di luar
      document.addEventListener('click', function(e) {
        if (!navbarToggler.contains(e.target) && !navbarCollapse.contains(e.target)) {
          closeNavbar();
        }
      });

      // Enhanced smooth scrolling for anchor links with mobile optimization
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            // Mobile-optimized smooth scrolling
            const isMobile = window.innerWidth <= 768;
            const scrollOptions = {
              behavior: 'smooth',
              block: 'start',
              inline: 'nearest'
            };
            
            if (isMobile) {
              // Additional mobile scrolling enhancement
              target.scrollIntoView(scrollOptions);
              // Force smooth scroll for mobile
              setTimeout(() => {
                window.scrollTo({
                  top: target.offsetTop - 80,
                  behavior: 'smooth'
                });
              }, 100);
            } else {
              target.scrollIntoView(scrollOptions);
            }
          }
        });
      });

      // Enhanced navbar background change on scroll with mobile optimization
      let ticking = false;
      
      function updateNavbar() {
        const nav = document.querySelector('nav');
        if (nav) {
          if (window.scrollY > 50) {
            nav.style.background = 'rgba(255, 255, 255, 0.15)';
            nav.style.backdropFilter = 'blur(20px)';
          } else {
            nav.style.background = 'rgba(255, 255, 255, 0.05)';
            nav.style.backdropFilter = 'blur(15px)';
          }
        }
        ticking = false;
      }
      
      window.addEventListener('scroll', function() {
        if (!ticking) {
          requestAnimationFrame(updateNavbar);
          ticking = true;
        }
      }, { passive: true });

      // Mobile performance optimization
      const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
      
      if (isMobile) {
        // Reduce animation complexity on mobile
        const styleSheet = document.createElement('style');
        styleSheet.textContent = `
          @media (max-width: 768px) {
            .parallax {
              background-attachment: scroll !important;
              animation: none !important;
            }
            
            .floating-icons {
              animation-duration: 4s !important;
            }
            
            .pulse-ring {
              animation-duration: 4s !important;
            }
          }
        `;
        document.head.appendChild(styleSheet);
        
        // Enhanced touch scrolling
        document.body.style.webkitOverflowScrolling = 'touch';
        document.body.style.overflowScrolling = 'touch';
      }

      // Intersection Observer for mobile scroll performance
      if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.classList.add('animate');
            }
          });
        }, {
          threshold: 0.1,
          rootMargin: '0px 0px -50px 0px'
        });

        // Observe elements for mobile optimization
        document.querySelectorAll('.card-hover, .floating-icons').forEach(el => {
          observer.observe(el);
        });
      }
    });
  </script>
</body>
</html>