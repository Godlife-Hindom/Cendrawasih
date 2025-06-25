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
    
    /* Mobile Menu Styles */
    .mobile-menu {
      transform: translateX(100%);
      transition: transform 0.3s ease-in-out;
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
    }
    
    .hamburger.active {
      transform: rotate(45deg);
    }
    
    @media (max-width: 768px) {
      .parallax {
        background-size: 200px;
      }
    }
    
    @media (max-width: 640px) {
      .parallax {
        background-size: 150px;
      }
    }
    
    /* CSS untuk menghilangkan semua animasi */
    *, *::before, *::after {
      animation-duration: 0s !important;
      animation-delay: 0s !important;
      animation-fill-mode: none !important;
      transition-duration: 0s !important;
      transition-delay: 0s !important;
    }
    
    /* Khusus untuk menghilangkan hover effects */
    .card-hover:hover {
      transform: none !important;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1) !important;
    }
    
    .btn-hover::before {
      display: none !important;
    }
    
    .pulse-ring {
      opacity: 0.2 !important;
      transform: scale(1) !important;
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
          <button id="mobileToggle" class="hamburger text-2xl focus:outline-none">☰</button>
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
        }
      });

      // Close menu on window resize if opened
      window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
          closeMobileMenu();
        }
      });

      // Smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        });
      });

      // Navbar background change on scroll
      window.addEventListener('scroll', function() {
        const nav = document.querySelector('nav');
        if (nav) {
          if (window.scrollY > 50) {
            nav.style.background = 'rgba(255, 255, 255, 0.15)';
          } else {
            nav.style.background = 'rgba(255, 255, 255, 0.05)';
          }
        }
      });
    });
  </script>
</body>
</html>