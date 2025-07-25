<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SPK Cenderawasih</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('images/pp.png') }}" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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

    #map {
            height: 600px;
            width: 100%;
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
    /* Enhanced Map Styles */
    .map-container {
      position: relative;
      background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(34,197,94,0.1));
      border-radius: 24px;
      padding: 2rem;
      margin: 3rem 0;
      box-shadow: 0 20px 50px rgba(0,0,0,0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255,255,255,0.3);
    }

    .map-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .map-title {
      background: linear-gradient(135deg, #1e40af, #059669);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }

    .map-subtitle {
      color: #6b7280;
      font-size: 1rem;
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    #map {
      height: 600px;
      width: 100%;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      overflow: hidden;
      position: relative;
      z-index: 1;
    }

    /* Map Loading Overlay */
    .map-loading-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(255, 255, 255, 0.9);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
      border-radius: 16px;
      backdrop-filter: blur(5px);
    }

    .map-loading-overlay.active {
      display: flex;
    }

    .map-spinner {
      width: 60px;
      height: 60px;
      border: 6px solid #f3f4f6;
      border-top: 6px solid #3b82f6;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    .map-instructions {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      justify-content: center;
      margin-top: 1.5rem;
    }

    .instruction-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255,255,255,0.7);
      padding: 0.75rem 1rem;
      border-radius: 12px;
      font-size: 0.875rem;
      font-weight: 500;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.4);
      transition: all 0.3s ease;
    }

    .instruction-item:hover {
      background: rgba(255,255,255,0.9);
      transform: translateY(-2px);
    }

    .instruction-icon {
      font-size: 1.2rem;
    }

    #info {
      margin-top: 1.5rem;
      background: rgba(255,255,255,0.8);
      border-radius: 16px;
      padding: 1.5rem;
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255,255,255,0.4);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      min-height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    #info:empty::before {
      content: "🗺️ Klik pada peta untuk melihat nilai kriteria lokasi";
      color: #6b7280;
      font-style: italic;
      text-align: center;
    }

    /* Landscape layout for criteria */
    .criteria-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
      margin-top: 1rem;
      width: 100%;
    }

    @media (max-width: 768px) {
      .criteria-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
      }
    }

    @media (max-width: 480px) {
      .criteria-grid {
        grid-template-columns: 1fr;
        gap: 0.5rem;
      }
    }

    .criteria-item {
      background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(34,197,94,0.1));
      padding: 1rem;
      border-radius: 12px;
      text-align: center;
      border: 1px solid rgba(255,255,255,0.3);
      transition: all 0.3s ease;
    }

    .criteria-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .criteria-label {
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.5rem;
      font-size: 0.875rem;
    }

    .criteria-value {
      font-size: 1.25rem;
      font-weight: bold;
      background: linear-gradient(135deg, #1e40af, #059669);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .loading-spinner {
      display: none;
      width: 40px;
      height: 40px;
      border: 4px solid #f3f4f6;
      border-top: 4px solid #3b82f6;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .error-message {
      color: #ef4444;
      background: rgba(254, 226, 226, 0.8);
      padding: 1rem;
      border-radius: 8px;
      border-left: 4px solid #ef4444;
      margin-top: 1rem;
    }

    .success-message {
      color: #059669;
      background: rgba(220, 252, 231, 0.8);
      padding: 1rem;
      border-radius: 8px;
      border-left: 4px solid #059669;
      margin-top: 1rem;
      width: 100%;
    }
    
    @media (max-width: 768px) {
      .parallax {
        background-size: 200px;
      }
      
      .map-container {
        padding: 1rem;
        margin: 2rem 0;
      }
      
      .map-title {
        font-size: 1.5rem;
      }
      
      #map {
        height: 400px;
      }
      
      .instruction-item {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
      }
    }
    
    @media (max-width: 640px) {
      .parallax {
        background-size: 150px;
      }
      
      .map-container {
        padding: 0.75rem;
      }
      
      #map {
        height: 350px;
      }
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
        <div class="text-xl font-bold text-gradient">SPK Cenderawasih</div>
        <div class="hidden md:flex space-x-8">
          <a href="#home" class="hover:text-blue-600 transition-colors">Beranda</a>
          <a href="#fitur" class="hover:text-blue-600 transition-colors">Fitur</a>
          <a href="#about" class="hover:text-blue-600 transition-colors">Tentang</a>
          <a href="#map-1" class="btn-hover bg-green-200 hover:bg-blue-300 text-black px-8 py-3 rounded-full font-semibold transition-all shadow-lg">
          Cek Peta
          </a>
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
          <button id="mobileClose" class="text-2xl focus:outline-none">✕</button>
        </div>
        <div class="flex flex-col space-y-4 p-6">
          <a href="#home" class="mobile-link hover:text-blue-600 transition-colors py-2 border-b border-white/10">Beranda</a>
          <a href="#fitur" class="mobile-link hover:text-blue-600 transition-colors py-2 border-b border-white/10">Fitur</a>
          <a href="#about" class="mobile-link hover:text-blue-600 transition-colors py-2 border-b border-white/10">Tentang</a>
          <a href="#map" class="mobile-link hover:text-blue-600 transition-colors py-2 border-b border-white/10">Peta</a>
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
          SPK CENDERAWASIH
        </h1>
      </div>
      <p class="text-gray-700 text-base sm:text-lg md:text-xl mt-4 max-w-2xl mx-auto leading-relaxed">
        Sistem Pendukung Keputusan Penangkaran Burung Cenderawasih berbasis Metode ARAS dan GIS
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
        <div class="text-2xl sm:text-3xl font-bold text-gradient">Keakuratan</div>
        <div class="text-sm text-gray-600">Optimal</div>
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
          Memastikan konservasi spesies cenderawasih dengan pendekatan berbasis data lingkungan.
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

    
    <!-- Enhanced Interactive Map Section -->
    <div id="map-1" class="map-container w-full" data-aos="fade-up" data-aos-delay="400">
      <div class="map-header">
        <h2 class="map-title">🗺️ Peta Interaktif Penilaian Kriteria</h2>
        <p class="map-subtitle">
          Jelajahi wilayah Kabupaten Fakfak dan klik pada lokasi mana pun untuk mendapatkan analisis nilai kriteria secara real-time
        </p>
      </div>

      <div class="map-instructions">
        <div class="instruction-item">
          <span class="instruction-icon">🖱️</span>
          <span>Klik pada peta untuk Ektraksi Data Kriteria</span>
        </div>
        <div class="instruction-item">
          <span class="instruction-icon">🔍</span>
          <span>Zoom untuk detail lebih akurat</span>
        </div>
        <div class="instruction-item">
          <span class="instruction-icon">🌍</span>
          <span>Ubah layer peta sesuai kebutuhan</span>
        </div>
        <div class="instruction-item">
          <span class="instruction-icon">📊</span>
          <span>Lihat nilai kriteria secara langsung</span>
        </div>
      </div>

      <div style="position: relative;">
        <div id="map"></div>
        <div id="mapLoadingOverlay" class="map-loading-overlay">
          <div class="map-spinner"></div>
        </div>
      </div>
      
      <div id="info">
        <div class="loading-spinner" id="loadingSpinner"></div>
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
        &copy; 2025 SPK Penangkaran Cenderawasih - Made by GNAH
      </p>
    </footer>
  </div>

  <!-- AOS Script -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>

   // Initialize map
   const map = L.map('map', {
        zoomControl: false,
        attributionControl: false
    }).setView([-2.9, 132.3], 9);

    // Add custom zoom control
    L.control.zoom({
        position: 'topleft'
    }).addTo(map);

 // Basemap: OpenStreetMap
 var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 18,
  attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Basemap: Esri World Imagery (Satelit)
var esriSat = L.tileLayer(
  'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 18,
    attribution: 'Tiles © Esri'
  }
);

// Overlay: Label Nama Wilayah & Kota
var labelBoundariesPlaces = L.tileLayer(
  'https://services.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 18,
    attribution: '© Esri - Boundaries & Places'
  }
);

// Overlay: Label Tempat Penting
var labelReference = L.tileLayer(
  'https://services.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places_Reference/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 18,
    attribution: '© Esri - Reference Labels'
  }
);

// Gabungan Satelit + Label Kota/Wilayah/Tempat Penting
var esriSatWithLabelsCombined = L.layerGroup([
  esriSat,
  labelBoundariesPlaces,
  labelReference
]);

// Basemap: Google Hybrid (Satelit + Labels)
var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
  maxZoom: 20,
  subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
  attribution: '&copy; <a href="https://maps.google.com/">Google Maps</a>'
});

// Layer Control
var baseMaps = {
  "OpenStreetMap": osm,
  "SatelitEsriii": esriSatWithLabelsCombined,
  "GoogleMapss": googleHybrid
};

L.control.layers(baseMaps).addTo(map);

// Enhanced click handler with better UI feedback and multiple checks support
map.on('click', function(e) {
    const lat = e.latlng.lat;
    const lng = e.latlng.lng;

    const infoDiv = document.getElementById('info');
    const mapLoadingOverlay = document.getElementById('mapLoadingOverlay');

    // ✅ Reset isi infoDiv & buat spinner baru setiap kali
    infoDiv.innerHTML = `
        <div class="loading-spinner" style="display: block; width: 40px; height: 40px; border: 4px solid #f3f4f6; border-top: 4px solid #3b82f6; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto;"></div>
    `;

    // ✅ Tampilkan overlay map
    mapLoadingOverlay.classList.add('active');

    fetch(`https://api.spkcendrawasih.site/extract?lat=${lat}&lng=${lng}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // ✅ Sembunyikan loading
            mapLoadingOverlay.classList.remove('active');

            const html = `
                <div class="success-message">
                    <h4 style="margin-bottom: 1rem; font-size: 1.2rem; font-weight: bold; text-align: center;">
                        📍 Hasil Ekstraksi Data Kriteria
                    </h4>
                    <p style="margin-bottom: 1rem; font-size: 0.9rem; text-align: center;">
                        Koordinat: ${lat.toFixed(6)}°, ${lng.toFixed(6)}°
                    </p>
                    <div class="criteria-grid">
                        <div class="criteria-item"><div class="criteria-label">🌱 NDVI</div><div class="criteria-value">${data.ndvi || 'N/A'}</div></div>
                        <div class="criteria-item"><div class="criteria-label">💧 NDWI</div><div class="criteria-value">${data.ndwi || 'N/A'}</div></div>
                        <div class="criteria-item"><div class="criteria-label">🏔️ DSM</div><div class="criteria-value">${data.dsm || 'N/A'}</div></div>
                        <div class="criteria-item"><div class="criteria-label">🌧️ Hujan</div><div class="criteria-value">${data.rainfall || 'N/A'}</div></div>
                    </div>
                    <p style="margin-top: 1rem; font-size: 0.85rem; text-align: center; color: #6b7280;">
                        💡 Klik lokasi lain pada peta untuk analisis perbandingan
                    </p>
                </div>
            `;

            infoDiv.innerHTML = html;

            const popupContent = `
                <div style="text-align: center; min-width: 200px;">
                    <h4 style="margin: 0 0 10px 0; color: #1e40af; font-weight: bold;">
                        📍 Hasil Ektraksi Data Kriteria
                    </h4>
                    <div style="background: #f8fafc; padding: 10px; border-radius: 8px; margin-bottom: 10px;">
                        <small style="color: #64748b;">
                            ${lat.toFixed(4)}°, ${lng.toFixed(4)}°
                        </small>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 12px;">
                        <div style="background: #ecfdf5; padding: 6px; border-radius: 6px;">
                            <strong>🌱 NDVI:</strong><br>${data.ndvi || 'N/A'}
                        </div>
                        <div style="background: #eff6ff; padding: 6px; border-radius: 6px;">
                            <strong>💧 NDWI:</strong><br>${data.ndwi || 'N/A'}
                        </div>
                        <div style="background: #fef3c7; padding: 6px; border-radius: 6px;">
                            <strong>🏔️ DSM:</strong><br>${data.dsm || 'N/A'}
                        </div>
                        <div style="background: #e0e7ff; padding: 6px; border-radius: 6px;">
                            <strong>🌧️ Hujan:</strong><br>${data.rainfall || 'N/A'}
                        </div>
                    </div>
                </div>
            `;

            L.popup({
                maxWidth: 300,
                className: 'custom-popup'
            })
            .setLatLng([lat, lng])
            .setContent(popupContent)
            .openOn(map);
        })
        .catch(error => {
            mapLoadingOverlay.classList.remove('active');

            infoDiv.innerHTML = `
                <div class="error-message">
                    <h4 style="margin-bottom: 0.5rem; text-align: center;">❌ Gagal Mengambil Data</h4>
                    <p style="margin: 0; font-size: 0.9rem; text-align: center;">
                        Terjadi kesalahan saat mengambil data. Silakan coba lagi.
                    </p>
                    <details style="margin-top: 0.5rem;">
                        <summary style="cursor: pointer; font-size: 0.8rem;">Detail Error</summary>
                        <p style="font-size: 0.8rem;">${error.message}</p>
                    </details>
                    <p style="margin-top: 1rem; font-size: 0.85rem; text-align: center; color: #6b7280;">
                        🔄 Silakan coba klik lokasi lain pada peta
                    </p>
                </div>
            `;
        });
});

// Add custom popup styling
const style = document.createElement('style');
style.textContent = `
    .custom-popup .leaflet-popup-content-wrapper {
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.2);
    }
    .custom-popup .leaflet-popup-content {
        margin: 12px;
    }
    .custom-popup .leaflet-popup-tip {
        background: white;
    }
`;
document.head.appendChild(style);

    // Pastikan variabel locations tersedia
    const resultLocations = @json($locations);

    resultLocations.forEach(loc => {
        const color = getColorByCategory(loc.kategori);

        const marker = L.marker([loc.latitude, loc.longitude], {
            icon: createEnhancedIcon(color)
        }).addTo(map);

        const popupContent = `
            <div style="text-align: center;">
                <strong>${loc.name}</strong><br>
                Skor: ${parseFloat(loc.score).toFixed(4)}<br>
                Kategori: <span style="color:${color}; font-weight:bold;">${loc.kategori}</span>
            </div>
        `;
        marker.bindPopup(popupContent);
    });

    function getColorByCategory(category) {
        switch ((category || '').trim()) {
            case 'Sangat Baik': return '#48bb78';
            case 'Baik': return '#4299e1';
            case 'Cukup': return '#ecc94b';
            case 'Kurang': return '#ed8936';
            case 'Buruk': return '#f56565';
            default: return '#999999'; // fallback
        }
    }

    function createEnhancedIcon(color) {
        return L.divIcon({
            className: "custom-enhanced-icon",
            html: `
                <div class="marker-wrapper">
                    <div class="marker-pulse" style="background: ${color}33;"></div>
                    <div class="marker-dot" style="background: ${color};"></div>
                </div>
            `,
            iconSize: [24, 24],
            iconAnchor: [12, 12]
        });
    }

    const markerStyles = document.createElement('style');
    markerStyles.textContent = `
        .custom-enhanced-icon {
            background: none !important;
            border: none !important;
        }
        .marker-wrapper {
            position: relative;
            width: 24px;
            height: 24px;
        }
        .marker-pulse {
            position: absolute;
            top: 0;
            left: 0;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            animation: markerPulse 2s infinite;
        }
        .marker-dot {
            position: absolute;
            top: 4px;
            left: 4px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        @keyframes markerPulse {
            0% { transform: scale(0.8); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.3; }
            100% { transform: scale(0.8); opacity: 1; }
        }
    `;
    document.head.appendChild(markerStyles);

    
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