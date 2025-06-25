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
      /* Improved mobile smooth scrolling */
      -webkit-overflow-scrolling: touch;
      scroll-behavior: smooth;
    }

    /* Enhanced smooth scrolling for all devices */
    html {
      scroll-behavior: smooth;
      scroll-padding-top: 80px;
    }

    /* Prevent horizontal scroll on mobile */
    * {
      box-sizing: border-box;
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
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
    }
    
    .card-hover {
      transition: all 0.3s ease;
    }
    
    .card-hover:hover {
      transform: translateY(-10px) scale(1.05);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .btn-hover {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
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
    }
    
    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    
    .pulse-ring {
      animation: pulse-ring 2s infinite;
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
    
    /* Enhanced Mobile Menu Styles */
    .mobile-menu {
      transform: translateX(100%);
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      will-change: transform;
      backface-visibility: hidden;
      -webkit-transform: translate3d(100%, 0, 0);
      transform: translate3d(100%, 0, 0);
    }
    
    .mobile-menu.active {
      transform: translateX(0);
      -webkit-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
    }
    
    .mobile-overlay {
      background-color: rgba(0, 0, 0, 0.5);
      opacity: 0;
      visibility: hidden;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: fixed;
      inset: 0;
      z-index: 998;
      backdrop-filter: blur(2px);
    }

    .mobile-overlay.active {
      opacity: 1;
      visibility: visible;
    }
    
    /* Enhanced Hamburger Animation */
    .hamburger {
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      padding: 4px;
      border-radius: 4px;
      position: relative;
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .hamburger:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    
    .hamburger-icon {
      position: relative;
      width: 20px;
      height: 2px;
      background-color: currentColor;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .hamburger-icon::before,
    .hamburger-icon::after {
      content: '';
      position: absolute;
      width: 20px;
      height: 2px;
      background-color: currentColor;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      left: 0;
    }
    
    .hamburger-icon::before {
      top: -6px;
    }
    
    .hamburger-icon::after {
      top: 6px;
    }
    
    .hamburger.active .hamburger-icon {
      background-color: transparent;
    }
    
    .hamburger.active .hamburger-icon::before {
      transform: rotate(45deg);
      top: 0;
    }
    
    .hamburger.active .hamburger-icon::after {
      transform: rotate(-45deg);
      top: 0;
    }

    /* Mobile Menu Links Animation */
    .mobile-link {
      transition: all 0.3s ease;
      border-radius: 8px;
      padding: 12px 16px;
      margin: 4px 0;
      position: relative;
      overflow: hidden;
    }

    .mobile-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(59,130,246,0.1), transparent);
      transition: left 0.3s ease;
    }

    .mobile-link:hover::before {
      left: 100%;
    }

    .mobile-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transform: translateX(5px);
    }

    /* Enhanced responsiveness */
    @media (max-width: 768px) {
      .parallax {
        background-size: 200px;
        background-attachment: scroll; /* Better performance on mobile */
      }
      
      /* Improved mobile touch targets */
      .btn-hover {
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      
      /* Better mobile card spacing */
      .card-hover:hover {
        transform: translateY(-5px) scale(1.02);
      }

      /* Mobile menu improvements */
      .mobile-menu {
        width: 280px;
        max-width: 80vw;
      }
    }
    
    @media (max-width: 640px) {
      .parallax {
        background-size: 150px;
      }
      
      /* Smaller screens adjustments */
      .mobile-menu {
        width: 100vw;
        max-width: 100vw;
      }
    }

    /* Prevent body scroll when menu is open */
    body.menu-open {
      overflow: hidden;
      position: fixed;
      width: 100%;
      height: 100%;
    }

    /* Smooth transitions for all interactive elements */
    button, a, .card-hover, .btn-hover {
      -webkit-tap-highlight-color: transparent;
      touch-action: manipulation;
    }

    /* Improved navbar glassmorphism */
    nav {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    nav.scrolled {
      backdrop-filter: blur(20px);
      background: rgba(255, 255, 255, 0.2);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="bg-pattern">
  <!-- Background Parallax -->
  <div class="parallax"></div>

  <!-- Mobile Overlay -->
  <div id="mobileOverlay" class="mobile-overlay"></div>

  <!-- Navigation Bar -->
  <nav class="fixed top-0 w-full z-50 glass" data-aos="fade-down">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center py-4">
        <div class="text-xl font-bold text-gradient">SPK Cendrawasih</div>
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
        <div class="md:hidden">
          <button id="mobileToggle" class="hamburger focus:outline-none">
            <span class="hamburger-icon"></span>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu fixed top-0 right-0 h-full glass backdrop-blur-xl z-50 md:hidden">
      <div class="flex flex-col h-full">
        <div class="flex justify-between items-center p-4 border-b border-white/20">
          <div class="text-lg font-bold text-gradient">Menu</div>
          <button id="mobileClose" class="text-2xl focus:outline-none p-2 hover:bg-white/10 rounded-lg transition-colors">✕</button>
        </div>
        <div class="flex flex-col space-y-2 p-6 flex-1">
          <a href="#home" class="mobile-link hover:text-blue-600 transition-colors">Beranda</a>
          <a href="#fitur" class="mobile-link hover:text-blue-600 transition-colors">Fitur</a>
          <a href="#about" class="mobile-link hover:text-blue-600 transition-colors">Tentang</a>
          <div class="pt-6 space-y-3 mt-auto">
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

    // Enhanced Mobile Menu Toggle Functionality
    document.addEventListener('DOMContentLoaded', function() {
      const mobileToggle = document.getElementById('mobileToggle');
      const mobileClose = document.getElementById('mobileClose');
      const mobileMenu = document.getElementById('mobileMenu');
      const mobileOverlay = document.getElementById('mobileOverlay');
      const mobileLinks = document.querySelectorAll('.mobile-link');
      const navbar = document.querySelector('nav');
      const body = document.body;

      // Improved smooth scrolling with offset for fixed navbar
      function smoothScrollTo(target) {
        const element = document.querySelector(target);
        if (element) {
          const offsetTop = element.offsetTop - 80; // Account for fixed navbar
          window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
          });
        }
      }

      function openMobileMenu() {
        mobileMenu.classList.add('active');
        mobileOverlay.classList.add('active');
        mobileToggle.classList.add('active');
        body.classList.add('menu-open');
        
        // Add stagger animation to menu items
        mobileLinks.forEach((link, index) => {
          link.style.transitionDelay = `${index * 0.1}s`;
          link.style.transform = 'translateX(0)';
          link.style.opacity = '1';
        });
      }

      function closeMobileMenu() {
        mobileMenu.classList.remove('active');
        mobileOverlay.classList.remove('active');
        mobileToggle.classList.remove('active');
        body.classList.remove('menu-open');
        
        // Reset menu items animation
        mobileLinks.forEach((link) => {
          link.style.transitionDelay = '0s';
          link.style.transform = 'translateX(20px)';
          link.style.opacity = '0';
        });
        
        // Reset after animation completes
        setTimeout(() => {
          mobileLinks.forEach((link) => {
            link.style.transform = '';
            link.style.opacity = '';
          });
        }, 400);
      }

      // Enhanced event listeners
      if (mobileToggle) {
        mobileToggle.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          if (mobileMenu.classList.contains('active')) {
            closeMobileMenu();
          } else {
            openMobileMenu();
          }
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

      // Enhanced mobile link handling
      mobileLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          const href = this.getAttribute('href');
          
          if (href.startsWith('#')) {
            e.preventDefault();
            closeMobileMenu();
            
            // Wait for menu to close before scrolling
            setTimeout(() => {
              smoothScrollTo(href);
            }, 400);
          } else {
            closeMobileMenu();
          }
        });
      });

      // Enhanced keyboard navigation
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          closeMobileMenu();
        }
        
        // Tab navigation within menu
        if (mobileMenu.classList.contains('active') && e.key === 'Tab') {
          const focusableElements = mobileMenu.querySelectorAll('a, button');
          const firstElement = focusableElements[0];
          const lastElement = focusableElements[focusableElements.length - 1];
          
          if (e.shiftKey) {
            if (document.activeElement === firstElement) {
              e.preventDefault();
              lastElement.focus();
            }
          } else {
            if (document.activeElement === lastElement) {
              e.preventDefault();
              firstElement.focus();
            }
          }
        }
      });

      // Enhanced window resize handling
      let resizeTimer;
      window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
          if (window.innerWidth >= 768) {
            closeMobileMenu();
          }
        }, 250);
      });

      // Enhanced smooth scrolling for all anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const target = this.getAttribute('href');
          smoothScrollTo(target);
        });
      });

      // Enhanced navbar background change on scroll with throttling
      let isScrolling = false;
      function updateNavbar() {
        if (!isScrolling) {
          window.requestAnimationFrame(() => {
            if (navbar) {
              if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
              } else {
                navbar.classList.remove('scrolled');
              }
            }
            isScrolling = false;
          });
          isScrolling = true;
        }
      }

      window.addEventListener('scroll', updateNavbar, { passive: true });

      // Prevent default touch behaviors on mobile menu
      mobileMenu.addEventListener('touchmove', function(e) {
        e.preventDefault();
      }, { passive: false });

      // Enhanced focus management
      mobileToggle.addEventListener('focus', function() {
        this.style.outline = '2px solid rgba(59, 130, 246, 0.5)';
      });

      mobileToggle.addEventListener('blur', function() {
        this.style.outline = 'none';
      });

      // Initialize menu items with proper initial state
      mobileLinks.forEach((link) => {
        link.style.transform = 'translateX(20px)';
        link.style.opacity = '0';
        link.style.transition = 'all 0.3s ease';
      });
    });

    // Enhanced performance optimizations
    window.addEventListener('load', function() {
      // Remove loading states and optimize animations
      document.body.classList.add('loaded');
      
      // Optimize scroll performance
      let ticking = false;
      function updateScrollEffects() {
        // Add any scroll-based effects here
        ticking = false;
      }
      
      window.addEventListener('scroll', function() {
        if (!ticking) {
          requestAnimationFrame(updateScrollEffects);
          ticking = true;
        }
      }, { passive: true });
    });
  </script>
</body>
</html>