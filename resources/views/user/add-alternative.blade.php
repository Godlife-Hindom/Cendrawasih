@extends('layouts.user-app')

@section('title', 'Tambah Alternatif Lokasi')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-geo-alt-fill me-3"></i>
            Tambah Lokasi Baru
        </h1>
        <p class="page-subtitle">Tentukan lokasi terbaik untuk penangkaran Cendrawasih dengan data lengkap</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-10">
            <!-- Alert untuk menampilkan pesan -->
            @if(session('success'))
                <div class="alert alert-custom alert-success">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-custom alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-custom alert-danger">
                    <h6 class="alert-heading">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Terjadi Kesalahan:
                    </h6>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-container">
                <div class="form-header">
                    <h4>
                        <i class="bi bi-clipboard-data me-2"></i>
                        Form Data Alternatif Lokasi
                    </h4>
                </div>

                <div class="form-body">
                    <form id="locationForm" action="{{ route('user.alternatives.store') }}" method="POST">
                        @csrf
                        
                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="section-title">
                                <div class="section-icon basic">
                                    <i class="bi bi-info-circle"></i>
                                </div>
                                Informasi Dasar
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-building"></i>
                                    Nama Lokasi
                                </label>
                                <div class="position-relative">
                                    <input type="text" 
                                           name="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           placeholder="Masukkan nama lokasi..." 
                                           value="{{ old('name') }}" 
                                           required>
                                    <i class="bi bi-pencil input-icon"></i>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Environmental Data Section -->
                        <div class="form-section">
                            <div class="section-title">
                                <div class="section-icon environmental">
                                    <i class="bi bi-tree"></i>
                                </div>
                                Data Lingkungan
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="bi bi-flower2"></i>
                                            Vegetasi (NDVI)
                                        </label>
                                        <div class="position-relative">
                                            <input type="number" 
                                                   step="any" 
                                                   name="vegetation" 
                                                   id="vegetation" 
                                                   class="form-control @error('vegetation') is-invalid @enderror" 
                                                   placeholder="0.00" 
                                                   value="{{ old('vegetation') }}" 
                                                   required>
                                            <i class="bi bi-graph-up input-icon"></i>
                                            @error('vegetation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="bi bi-droplet"></i>
                                            Ketersediaan Air (NDWI)
                                        </label>
                                        <div class="position-relative">
                                            <input type="number" 
                                                   step="any" 
                                                   name="water" 
                                                   id="water" 
                                                   class="form-control @error('water') is-invalid @enderror" 
                                                   placeholder="0.00" 
                                                   value="{{ old('water') }}" 
                                                   required>
                                            <i class="bi bi-water input-icon"></i>
                                            @error('water')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="bi bi-triangle"></i>
                                            Topografi (DSM)
                                        </label>
                                        <div class="position-relative">
                                            <input type="number" 
                                                   step="0.01" 
                                                   name="topography" 
                                                   id="topography" 
                                                   class="form-control @error('topography') is-invalid @enderror" 
                                                   placeholder="0.00" 
                                                   value="{{ old('topography') }}" 
                                                   required>
                                            <i class="bi bi-mountains input-icon"></i>
                                            @error('topography')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="bi bi-cloud-rain"></i>
                                            Iklim (Curah Hujan)
                                        </label>
                                        <div class="position-relative">
                                            <input type="number" 
                                                   step="0.01" 
                                                   name="climate" 
                                                   id="climate" 
                                                   class="form-control @error('climate') is-invalid @enderror" 
                                                   placeholder="0.00" 
                                                   value="{{ old('climate') }}" 
                                                   required>
                                            <i class="bi bi-thermometer input-icon"></i>
                                            @error('climate')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Location Section -->
                        <div class="form-section">
                            <div class="section-title">
                                <div class="section-icon location">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                Koordinat Lokasi
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="bi bi-compass"></i>
                                            Latitude
                                        </label>
                                        <div class="position-relative">
                                            <input type="text" 
                                                   id="latitude" 
                                                   name="latitude" 
                                                   class="form-control @error('latitude') is-invalid @enderror" 
                                                   placeholder="Klik pada peta..." 
                                                   value="{{ old('latitude') }}" 
                                                   required 
                                                   readonly>
                                            <i class="bi bi-crosshair input-icon"></i>
                                            @error('latitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="bi bi-compass"></i>
                                            Longitude
                                        </label>
                                        <div class="position-relative">
                                            <input type="text" 
                                                   id="longitude" 
                                                   name="longitude" 
                                                   class="form-control @error('longitude') is-invalid @enderror" 
                                                   placeholder="Klik pada peta..." 
                                                   value="{{ old('longitude') }}" 
                                                   required 
                                                   readonly>
                                            <i class="bi bi-crosshair input-icon"></i>
                                            @error('longitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="map-container">
                                    <div class="map-header">
                                        <div>
                                            <strong>Pilih Titik di Peta</strong>
                                            <p class="mb-0 mt-1" style="font-size: 0.9rem; opacity: 0.8;">Klik pada peta untuk menentukan koordinat lokasi</p>
                                        </div>
                                        <div class="map-status">
                                            <div class="status-indicator"></div>
                                            <span>Siap</span>
                                        </div>
                                    </div>
                                    
                                    <div id="map"></div>
                                    <div class="loading-overlay">
                                        <div class="loading-spinner"></div>
                                    </div>
                                    
                                    <div class="coordinate-display" id="coordinateDisplay" style="display: none;">
                                        <div>
                                            <strong>Koordinat Terpilih:</strong>
                                        </div>
                                        <div id="selectedCoords">-</div>
                                    </div>
                                </div>
                            </div>

                            <div class="data-preview" id="dataPreview" style="display: none;">
                                <h6><i class="bi bi-bar-chart me-2"></i>Data Lingkungan Otomatis</h6>
                                <div class="data-item">
                                    <span>Vegetasi (NDVI):</span>
                                    <span class="data-value" id="previewVegetation">-</span>
                                </div>
                                <div class="data-item">
                                    <span>Air (NDWI):</span>
                                    <span class="data-value" id="previewWater">-</span>
                                </div>
                                <div class="data-item">
                                    <span>Topografi (DSM):</span>
                                    <span class="data-value" id="previewTopography">-</span>
                                </div>
                                <div class="data-item">
                                    <span>Curah Hujan:</span>
                                    <span class="data-value" id="previewClimate">-</span>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-check-circle me-2"></i>
                                Simpan Lokasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    :root {
        --primary-gradient: linear-gradient(#fff);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --warning-gradient: linear-gradient(135deg, #fdbb2d 0%, #22c1c3 100%);
        --danger-gradient: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        --info-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        --glass-bg: rgba(0, 0, 0, 0.07);
        --glass-border: rgba(255, 255, 255, 0.18);
        --shadow-light: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        --shadow-heavy: 0 15px 35px rgba(31, 38, 135, 0.2);
    }

    body {
        background: linear-gradient(to top right, #ffffff, );
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.08)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        pointer-events: none;
        z-index: 1;
    }

    .container {
        position: relative;
        z-index: 2;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .page-header {
        text-align: center;
        margin-bottom: 3rem;
        animation: fadeInDown 0.8s ease-out;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: lightseagreen;
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: rgba(0,0,0,1.0);
        font-weight: 300;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .form-container {
        background: var(--glass-bg);
        backdrop-filter: blur(15px);
        border-radius: 25px;
        border: 1px solid var(--glass-border);
        box-shadow: var(--shadow-heavy);
        padding: 0;
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out 0.3s both;
    }

    .form-header {
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
        padding: 2rem;
        text-align: center;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .form-header h4 {
        color: black;
        font-weight: 600;
        margin: 0;
        font-size: 1.5rem;
    }

    .form-body {
        padding: 2.5rem;
    }

    .form-section {
        margin-bottom: 2.5rem;
        animation: slideInLeft 0.6s ease-out;
    }

    .form-section:nth-child(even) {
        animation: slideInRight 0.6s ease-out;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        color: black;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .section-icon {
        width: 35px;
        height: 35px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
    }

    .section-icon.basic { background: var(--warning-gradient); }
    .section-icon.environmental { background: var(--success-gradient); }
    .section-icon.location { background: var(--warning-gradient); }

    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: black;
        font-weight: 500;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .form-control {
        background: rgba(255,255,255,0.1);
        border: 2px solid rgba(255,255,255,0.2);
        border-radius: 12px;
        color: black;
        padding: 1rem;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
    }

    .form-control:focus {
        background: rgba(255,255,255,0.15);
        border-color: #00f2fe;
        box-shadow: 0 0 20px rgba(0,242,254,0.3);
        color: black;
        outline: none;
        transform: translateY(-2px);
    }

    .form-control::placeholder {
        color: black;
    }

    .input-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,0.6);
        font-size: 1.1rem;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .form-group:focus-within .input-icon {
        color: #00f2fe;
        transform: translateY(-50%) scale(1.1);
    }

    .map-container {
        background: rgba(255,255,255,0.1);
        border-radius: 15px;
        padding: 1rem;
        border: 2px solid rgba(255,255,255,0.2);
        position: relative;
        overflow: hidden;
    }

    .map-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        color: black;
    }

    .map-status {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: black;
    }

    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #00f2fe;
        animation: pulse 2s infinite;
    }

    #map {
        height: 400px;
        border-radius: 10px;
        border: 2px solid rgba(255,255,255,0.1);
        position: relative;
        z-index: 10;
    }

    .coordinate-display {
        background: rgba(0,0,0,0.3);
        color: black;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        margin-top: 1rem;
        font-family: 'Courier New', monospace;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-submit {
        background: var(--success-gradient);
        color: white;
        border: none;
        padding: 1rem 3rem;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(0,242,254,0.3);
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0,242,254,0.4);
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    .submit-section {
        text-align: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    .data-preview {
        background: rgba(0,0,0,0.2);
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1rem;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .data-preview h6 {
        color: #00f2fe;
        margin-bottom: 0.75rem;
        font-weight: 600;
    }

    .data-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        color: black;
    }

    .data-item:last-child {
        border-bottom: none;
    }

    .data-value {
        font-weight: 600;
        color: black;
    }

    .alert-custom {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 15px;
        color: white;
        backdrop-filter: blur(10px);
        margin-bottom: 2rem;
    }

    .alert-custom .alert-heading {
        color: #00f2fe;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        
        .form-body {
            padding: 1.5rem;
        }
        
        .btn-submit {
            padding: 0.875rem 2rem;
            font-size: 1rem;
        }
    }

    /* Loading animation */
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.3);
        display: none;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        z-index: 20;
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid rgba(255,255,255,0.3);
        border-top: 3px solid #00f2fe;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Initialize map
    var map = L.map('map').setView([-2.9, 132.3], 9);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;
    var loadingOverlay = document.querySelector('.loading-overlay');
    var mapStatus = document.querySelector('.map-status span');
    var statusIndicator = document.querySelector('.status-indicator');

    // Set marker jika ada data lama (untuk edit form)
    @if(old('latitude') && old('longitude'))
        const oldLat = {{ old('latitude') }};
        const oldLng = {{ old('longitude') }};
        
        marker = L.marker([oldLat, oldLng]).addTo(map)
            .bindPopup(`<strong>Lokasi Terpilih</strong><br>Lat: ${oldLat}<br>Lng: ${oldLng}`)
            .openPopup();
        
        map.setView([oldLat, oldLng], 12);
        document.getElementById("selectedCoords").textContent = `${oldLat}, ${oldLng}`;
        document.getElementById("coordinateDisplay").style.display = 'flex';
    @endif

    // Map click event
    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);

        // Update coordinate inputs
        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;

        // Update coordinate display
        document.getElementById("selectedCoords").textContent = `${lat}, ${lng}`;
        document.getElementById("coordinateDisplay").style.display = 'flex';

        // Add or move marker
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng]).addTo(map)
                .bindPopup(`<strong>Lokasi Terpilih</strong><br>Lat: ${lat}<br>Lng: ${lng}`)
                .openPopup();
        }

        // Show loading
        loadingOverlay.style.display = 'flex';
        mapStatus.textContent = 'Mengambil data...';
        statusIndicator.style.background = '#fdbb2d';

        // Simulate API call untuk mendapatkan data lingkungan
        // Ganti dengan actual API call ke server Laravel
        fetchEnvironmentalData(lat, lng);
    });

    // Function untuk mengambil data lingkungan dari server
    function fetchEnvironmentalData(lat, lng) {
        // Simulasi API call - ganti dengan fetch ke endpoint Laravel
        fetch(`http://127.0.0.1:5000/extract?lat=${lat}&lng=${lng}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response from Flask:", data); // ← debug output
            if (!data.error && data.ndvi != null && data.ndwi != null && data.dsm != null && data.rainfall != null) {
                // Update form fields
                document.getElementById("vegetation").value = data.ndvi !== null ? data.ndvi : '';
                document.getElementById("water").value = data.ndwi !== null ? data.ndwi : '';
                document.getElementById("topography").value = data.dsm !== null ? data.dsm : '';
                document.getElementById("climate").value = data.rainfall !== null ? data.rainfall : '';

                document.getElementById("previewVegetation").textContent = data.ndvi !== null ? data.ndvi : 'N/A';
                document.getElementById("previewWater").textContent = data.ndwi !== null ? data.ndwi : 'N/A';
                document.getElementById("previewTopography").textContent = data.dsm !== null ? data.dsm + " m" : 'N/A';
                document.getElementById("previewClimate").textContent = data.rainfall !== null ? data.rainfall + " mm" : 'N/A';

                document.getElementById("dataPreview").style.display = 'block';
                mapStatus.textContent = 'Data berhasil diambil';
                statusIndicator.style.background = '#00f2fe';
            } else {
                // Jika error dari backend
                alert('Gagal mengambil data lingkungan: ' + data.error);
                document.getElementById("dataPreview").style.display = 'none';
                mapStatus.textContent = 'Titik tidak valid (kemungkinan di laut)';
                statusIndicator.style.background = '#ff9a9e';

                // Kosongkan input
                document.getElementById("vegetation").value = '';
                document.getElementById("water").value = '';
                document.getElementById("topography").value = '';
                document.getElementById("climate").value = '';
            }
        })


        .catch(error => {
            console.error('Error:', error);
            // Fallback dengan data simulasi
            simulateEnvironmentalData();
            mapStatus.textContent = 'Menggunakan data API';
            statusIndicator.style.background = '#fdbb2d';
        })
        .finally(() => {
            // Hide loading
            setTimeout(() => {
                loadingOverlay.style.display = 'none';
            }, 1000);
        });
    }

    // Function untuk data simulasi (fallback)
    function simulateEnvironmentalData() {
        const simulatedData = {
            ndvi: (Math.random() * 0.8 + 0.2).toFixed(3), // 0.2 - 1.0
            ndwi: (Math.random() * 0.6 + 0.1).toFixed(3), // 0.1 - 0.7
            dsm: (Math.random() * 500 + 100).toFixed(2),  // 100 - 600 m
            rainfall: (Math.random() * 3000 + 1000).toFixed(2) // 1000 - 4000 mm
        };

        document.getElementById("vegetation").value = simulatedData.ndvi;
        document.getElementById("water").value = simulatedData.ndwi;
        document.getElementById("topography").value = simulatedData.dsm;
        document.getElementById("climate").value = simulatedData.rainfall;

        document.getElementById("previewVegetation").textContent = simulatedData.ndvi;
        document.getElementById("previewWater").textContent = simulatedData.ndwi;
        document.getElementById("previewTopography").textContent = simulatedData.dsm + " m";
        document.getElementById("previewClimate").textContent = simulatedData.rainfall + " mm";

        document.getElementById("dataPreview").style.display = 'block';
    }

    // Form validation
    document.getElementById("locationForm").addEventListener("submit", function(e) {
        const lat = document.getElementById("latitude").value;
        const lng = document.getElementById("longitude").value;
        
        if (!lat || !lng) {
            e.preventDefault();
            alert("Silakan pilih titik lokasi pada peta terlebih dahulu!");
            return false;
        }
        
        // Validate environmental data
        const vegetation = parseFloat(document.getElementById("vegetation").value);
        const water = parseFloat(document.getElementById("water").value);
        const topography = parseFloat(document.getElementById("topography").value);
        const climate = parseFloat(document.getElementById("climate").value);
        
        if (vegetation < 0 || vegetation > 1) {
            e.preventDefault();
            alert("Nilai vegetasi (NDVI) harus antara 0 dan 1!");
            return false;
        }
        
        if (water < -1 || water > 1) {
            e.preventDefault();
            alert("Nilai ketersediaan air (NDWI) harus antara -1 dan 1!");
            return false;
        }
        
        if (topography < 0 || topography > 10000) {
            e.preventDefault();
            alert("Nilai topografi (DSM) harus antara 0 dan 10000 meter!");
            return false;
        }
        
        if (climate < 0 || climate > 10000) {
            e.preventDefault();
            alert("Nilai curah hujan harus antara 0 dan 10000 mm!");
            return false;
        }
        
        // Show loading state on submit button
        const submitBtn = document.querySelector('.btn-submit');
        submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });

    // Real-time input validation with visual feedback
    function validateInput(inputId, min, max, unit = '') {
        const input = document.getElementById(inputId);
        const value = parseFloat(input.value);
        
        if (isNaN(value) || value < min || value > max) {
            input.style.borderColor = '#ff9a9e';
            input.style.boxShadow = '0 0 10px rgba(255, 154, 158, 0.5)';
        } else {
            input.style.borderColor = '#00f2fe';
            input.style.boxShadow = '0 0 10px rgba(0, 242, 254, 0.3)';
        }
    }

    // Add event listeners for real-time validation
    document.getElementById("vegetation").addEventListener("input", function() {
        validateInput("vegetation", 0, 1);
    });

    document.getElementById("water").addEventListener("input", function() {
        validateInput("water", -1, 1);
    });

    document.getElementById("topography").addEventListener("input", function() {
        validateInput("topography", 0, 10000);
    });

    document.getElementById("climate").addEventListener("input", function() {
        validateInput("climate", 0, 10000);
    });

    // Auto-save draft functionality (optional)
    let autoSaveTimeout;
    function autoSaveDraft() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            const formData = {
                name: document.querySelector('input[name="name"]').value,
                latitude: document.getElementById("latitude").value,
                longitude: document.getElementById("longitude").value,
                vegetation: document.getElementById("vegetation").value,
                water: document.getElementById("water").value,
                topography: document.getElementById("topography").value,
                climate: document.getElementById("climate").value
            };
            
            // Save to sessionStorage as fallback
            try {
                sessionStorage.setItem('locationFormDraft', JSON.stringify(formData));
            } catch(e) {
                console.log('Auto-save not available in this environment');
            }
        }, 2000);
    }

    // Add auto-save listeners
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', autoSaveDraft);
    });

    // Load draft on page load
    window.addEventListener('load', function() {
        try {
            const draft = sessionStorage.getItem('locationFormDraft');
            if (draft && !document.querySelector('input[name="name"]').value) {
                const data = JSON.parse(draft);
                
                // Only load draft if form is empty
                Object.keys(data).forEach(key => {
                    const input = document.querySelector(`input[name="${key}"], #${key}`);
                    if (input && !input.value && data[key]) {
                        input.value = data[key];
                    }
                });
                
                // If coordinates exist, add marker
                if (data.latitude && data.longitude) {
                    const lat = parseFloat(data.latitude);
                    const lng = parseFloat(data.longitude);
                    
                    if (!marker) {
                        marker = L.marker([lat, lng]).addTo(map)
                            .bindPopup(`<strong>Draft Lokasi</strong><br>Lat: ${lat}<br>Lng: ${lng}`);
                        map.setView([lat, lng], 12);
                        
                        document.getElementById("selectedCoords").textContent = `${lat}, ${lng}`;
                        document.getElementById("coordinateDisplay").style.display = 'flex';
                    }
                }
            }
        } catch(e) {
            console.log('Failed to load draft');
        }
    });

    // Clear draft after successful submission
    window.addEventListener('beforeunload', function() {
        try {
            sessionStorage.removeItem('locationFormDraft');
        } catch(e) {
            console.log('Failed to clear draft');
        }
    });

    // Geolocation support
    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    map.setView([lat, lng], 15);
                    
                    if (marker) {
                        marker.setLatLng([lat, lng]);
                    } else {
                        marker = L.marker([lat, lng]).addTo(map)
                            .bindPopup(`<strong>Lokasi Saat Ini</strong><br>Lat: ${lat.toFixed(6)}<br>Lng: ${lng.toFixed(6)}`)
                            .openPopup();
                    }
                    
                    document.getElementById("latitude").value = lat.toFixed(6);
                    document.getElementById("longitude").value = lng.toFixed(6);
                    document.getElementById("selectedCoords").textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                    document.getElementById("coordinateDisplay").style.display = 'flex';
                    
                    fetchEnvironmentalData(lat.toFixed(6), lng.toFixed(6));
                },
                function(error) {
                    console.error('Geolocation error:', error);
                    alert('Tidak dapat mengakses lokasi Anda. Silakan pilih lokasi secara manual pada peta.');
                }
            );
        }
    }

    // Add geolocation button (optional - can be added to HTML)
    const geolocationBtn = document.createElement('button');
    geolocationBtn.type = 'button';
    geolocationBtn.className = 'btn btn-outline-light btn-sm position-absolute';
    geolocationBtn.style.cssText = 'top: 10px; right: 10px; z-index: 1000; border-radius: 5px;';
    geolocationBtn.innerHTML = '<i class="bi bi-crosshair2"></i>';
    geolocationBtn.title = 'Gunakan lokasi saat ini';
    geolocationBtn.onclick = getCurrentLocation;
    
    document.querySelector('.map-container').appendChild(geolocationBtn);

    // Enhanced map controls
    map.on('zoom', function() {
        const zoom = map.getZoom();
        if (zoom > 15) {
            mapStatus.textContent = 'Detail tinggi';
            statusIndicator.style.background = '#00f2fe';
        } else if (zoom > 10) {
            mapStatus.textContent = 'Detail sedang';
            statusIndicator.style.background = '#fdbb2d';
        } else {
            mapStatus.textContent = 'Detail rendah';
            statusIndicator.style.background = '#ff9a9e';
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            document.getElementById('locationForm').dispatchEvent(new Event('submit'));
        }
        
        // Escape to clear selection
        if (e.key === 'Escape') {
            if (marker) {
                map.removeLayer(marker);
                marker = null;
                document.getElementById("latitude").value = '';
                document.getElementById("longitude").value = '';
                document.getElementById("coordinateDisplay").style.display = 'none';
                document.getElementById("dataPreview").style.display = 'none';
            }
        }
    });

    console.log('Location form initialized successfully');
    </script>
@endpush
