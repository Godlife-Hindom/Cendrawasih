@extends('layouts.pimpinan')

@section('content')
<div class="map-container">
    <!-- Header Section -->
    <div class="map-header">
        <div class="container">
            <div class="header-content">
                <div class="title-section">
                    <div class="icon-wrapper">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="map-title">Peta Lokasi Rekomendasi</h1>
                        <p class="map-subtitle">Jelajahi lokasi terbaik berdasarkan analisis mendalam</p>
                    </div>
                </div>
                <div class="stats-wrapper">
                    <div class="stat-item">
                        <span class="stat-number" id="totalLocations">0</span>
                        <span class="stat-label">Total Lokasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Controls -->
    <div class="map-controls">
        <div class="container">
            <div class="controls-wrapper">
                <div class="control-group">
                    <button class="control-btn active" id="showAll" data-category="all">
                        <span class="btn-icon">🌍</span>
                        Semua Lokasi
                    </button>
                    <button class="control-btn" id="showSangatBaik" data-category="Sangat Baik">
                        <span class="btn-icon">🟢</span>
                        Sangat Baik
                    </button>
                    <button class="control-btn" id="showBaik" data-category="Baik">
                        <span class="btn-icon">🔵</span>
                        Baik
                    </button>
                    <button class="control-btn" id="showCukup" data-category="Cukup">
                        <span class="btn-icon">🟡</span>
                        Cukup
                    </button>
                    <button class="control-btn" id="showKurang" data-category="Kurang">
                        <span class="btn-icon">🟠</span>
                        Kurang
                    </button>
                    <button class="control-btn" id="showBuruk" data-category="Buruk">
                        <span class="btn-icon">🔴</span>
                        Buruk
                    </button>
                </div>
                <div class="view-controls">
                    <button class="control-btn" id="centerMap">
                        <span class="btn-icon">🎯</span>
                        Pusatkan
                    </button>
                    <button class="control-btn" id="fullscreen">
                        <span class="btn-icon">⛶</span>
                        Fullscreen
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Container -->
    <div class="map-wrapper">
        <div id="map"></div>
        
        <!-- Loading Overlay -->
        <div class="loading-overlay" id="loadingOverlay">
            <div class="loading-content">
                <div class="loading-spinner"></div>
                <p>Memuat peta lokasi...</p>
            </div>
        </div>

        <!-- Legend -->
        <div class="legend-container">
            <div class="legend-header">
                <h4>Kategori Skor</h4>
                <button class="legend-toggle" id="legendToggle">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="18,15 12,9 6,15"></polyline>
                    </svg>
                </button>
            </div>
            <div class="legend-content">
                <div class="legend-item" data-category="Sangat Baik">
                    <div class="legend-marker sangat-baik"></div>
                    <span class="legend-label">Sangat Baik</span>
                    <span class="legend-count" id="countSangatBaik">0</span>
                </div>
                <div class="legend-item" data-category="Baik">
                    <div class="legend-marker baik"></div>
                    <span class="legend-label">Baik</span>
                    <span class="legend-count" id="countBaik">0</span>
                </div>
                <div class="legend-item" data-category="Cukup">
                    <div class="legend-marker cukup"></div>
                    <span class="legend-label">Cukup</span>
                    <span class="legend-count" id="countCukup">0</span>
                </div>
                <div class="legend-item" data-category="Kurang">
                    <div class="legend-marker kurang"></div>
                    <span class="legend-label">Kurang</span>
                    <span class="legend-count" id="countKurang">0</span>
                </div>
                <div class="legend-item" data-category="Buruk">
                    <div class="legend-marker buruk"></div>
                    <span class="legend-label">Buruk</span>
                    <span class="legend-count" id="countBuruk">0</span>
                </div>
            </div>
        </div>

        <!-- Info Panel -->
        <div class="info-panel" id="infoPanel">
            <div class="info-header">
                <h4>Informasi Lokasi</h4>
                <button class="info-close" id="infoPanelClose">×</button>
            </div>
            <div class="info-content" id="infoContent">
                <p>Klik pada marker untuk melihat informasi detail lokasi</p>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #667eea;
    --primary-dark: #5a67d8;
    --success-color: #48bb78;
    --warning-color: #ed8936;
    --danger-color: #f56565;
    --info-color: #4299e1;
    --text-primary: #2d3748;
    --text-secondary: #718096;
    --bg-light: #f7fafc;
    --border-color: #e2e8f0;
    --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.map-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
}

.map-header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--border-color);
    padding: 2rem 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.title-section {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.icon-wrapper {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: var(--shadow-md);
}

.map-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.map-subtitle {
    color: var(--text-secondary);
    font-size: 1.1rem;
}

.stats-wrapper {
    display: flex;
    gap: 2rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.map-controls {
    background: white;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-color);
    position: sticky;
    top: 120px;
    z-index: 999;
}

.controls-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.control-group {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.view-controls {
    display: flex;
    gap: 0.5rem;
}

.control-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: white;
    border: 2px solid var(--border-color);
    border-radius: 12px;
    color: var(--text-primary);
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.control-btn:hover {
    border-color: var(--primary-color);
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.control-btn.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    box-shadow: var(--shadow-md);
}

.btn-icon {
    font-size: 1.1rem;
}

.map-wrapper {
    position: relative;
    height: calc(100vh - 200px);
    margin: 0;
}

#map {
    height: 100%;
    width: 100%;
    border-radius: 0;
    position: relative;
    z-index: 1;
}

.loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000;
    transition: opacity 0.3s ease;
}

.loading-content {
    text-align: center;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid var(--border-color);
    border-top: 3px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 1rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.legend-container {
    position: absolute;
    bottom: 2rem;
    right: 2rem;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    min-width: 200px;
    z-index: 1000;
    overflow: hidden;
    transition: all 0.3s ease;
}

.legend-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid var(--border-color);
    background: var(--bg-light);
}

.legend-header h4 {
    margin: 0;
    font-size: 1rem;
    color: var(--text-primary);
}

.legend-toggle {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 6px;
    transition: background 0.2s ease;
}

.legend-toggle:hover {
    background: var(--border-color);
}

.legend-content {
    padding: 1rem;
    transition: all 0.3s ease;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0;
    cursor: pointer;
    border-radius: 8px;
    transition: background 0.2s ease;
}

.legend-item:hover {
    background: var(--bg-light);
}

.legend-marker {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: var(--shadow-sm);
    flex-shrink: 0;
}

.legend-marker.sangat-baik { background: var(--success-color); }
.legend-marker.baik { background: #4299e1; }
.legend-marker.cukup-baik { background: #ecc94b; }
.legend-marker.kurang { background: var(--warning-color); }
.legend-marker.buruk { background: var(--danger-color); }

.legend-label {
    flex: 1;
    font-weight: 500;
    color: var(--text-primary);
}

.legend-count {
    background: var(--bg-light);
    color: var(--text-secondary);
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.info-panel {
    position: absolute;
    top: 2rem;
    left: 2rem;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    max-width: 350px;
    z-index: 1000;
    overflow: hidden;
    transform: translateX(-120%);
    transition: transform 0.3s ease;
}

.info-panel.show {
    transform: translateX(0);
}

.info-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid var(--border-color);
    background: var(--bg-light);
}

.info-header h4 {
    margin: 0;
    font-size: 1rem;
    color: var(--text-primary);
}

.info-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    width: 30px;
    height: 30px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease;
}

.info-close:hover {
    background: var(--border-color);
}

.info-content {
    padding: 1rem;
}

/* Custom Leaflet Popup Styles */
.leaflet-popup-content-wrapper {
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    border: none;
}

.leaflet-popup-content {
    margin: 1rem;
    font-family: inherit;
}

.popup-title {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.popup-score {
    display: inline-block;
    background: var(--primary-color);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.popup-category {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .map-title {
        font-size: 1.5rem;
    }
    
    .header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .controls-wrapper {
        flex-direction: column;
        align-items: stretch;
    }
    
    .control-group {
        justify-content: center;
    }
    
    .legend-container {
        bottom: 1rem;
        right: 1rem;
        left: 1rem;
        right: 1rem;
    }
    
    .info-panel {
        top: 1rem;
        left: 1rem;
        right: 1rem;
        max-width: none;
    }

    .map-wrapper {
        height: calc(100vh - 250px);
    }
}

/* Animation Classes */
.fade-in {
    animation: fadeIn 0.5s ease-in;
}

.slide-up {
    animation: slideUp 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { 
        opacity: 0;
        transform: translateY(20px);
    }
    to { 
        opacity: 1;
        transform: translateY(0);
    }
}

.marker-pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.7;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}
</style>
@endsection

@push('scripts')
<!-- Leaflet CSS dan JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const locations = @json($locations);
    
    // Initialize map
    const map = L.map('map', {
        zoomControl: false,
        attributionControl: false
    }).setView([-2.9, 132.3], 9);

    // Add custom zoom control
    L.control.zoom({
        position: 'topleft'
    }).addTo(map);

    // Add tile layer with better styling
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 18,
        tileSize: 256,
        zoomOffset: 0
    }).addTo(map);

    // Store markers for filtering
    const markers = {};
    const categoryCounts = {
        'Sangat Baik': 0,
        'Baik': 0,
        'Cukup': 0,
        'Kurang': 0,
        'Buruk': 0
    };

    function getColorByCategory(category) {
        switch (category) {
            case 'Sangat Baik': return '#48bb78';
            case 'Baik': return '#4299e1';
            case 'Cukup': return '#ecc94b';
            case 'Kurang': return '#ed8936';
            case 'Buruk': return '#f56565';
            default: return '#000000';
        }
    }

    function createEnhancedIcon(color, category) {
        return L.divIcon({
            className: "custom-enhanced-icon",
            html: `
                <div class="marker-wrapper">
                    <div class="marker-pulse" style="background: ${color}20;"></div>
                    <div class="marker-dot" style="background: ${color};"></div>
                </div>
            `,
            iconSize: [24, 24],
            iconAnchor: [12, 12]
        });
    }

    // Add custom marker styles
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
            0% {
                transform: scale(0.8);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.3;
            }
            100% {
                transform: scale(0.8);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(markerStyles);

    // Create markers
    locations.forEach(loc => {
        const color = getColorByCategory(loc.kategori);
        const marker = L.marker([loc.latitude, loc.longitude], {
            icon: createEnhancedIcon(color, loc.kategori)
        }).addTo(map);

        // Enhanced popup content
        const popupContent = `
            <div class="popup-content">
                <div class="popup-title">${loc.name}</div>
                <div class="popup-score">Skor: ${loc.score.toFixed(4)}</div>
                <div class="popup-category">Kategori: ${loc.kategori}</div>
            </div>
        `;

        marker.bindPopup(popupContent, {
            maxWidth: 250,
            className: 'custom-popup'
        });

        // Store marker for filtering
        if (!markers[loc.kategori]) {
            markers[loc.kategori] = [];
        }
        markers[loc.kategori].push(marker);
        categoryCounts[loc.kategori]++;

        // Add click event for info panel
        marker.on('click', function() {
            updateInfoPanel(loc);
        });
    });

    // Update statistics
    document.getElementById('totalLocations').textContent = locations.length;
    Object.keys(categoryCounts).forEach(category => {
        const countElement = document.getElementById(`count${category.replace(' ', '')}`);
        if (countElement) {
            countElement.textContent = categoryCounts[category];
        }
    });

    // Filter functionality
    const filterButtons = document.querySelectorAll('.control-btn[data-category]');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter markers
            filterMarkers(category);
        });
    });

    function filterMarkers(category) {
        // Hide all markers first
        Object.values(markers).forEach(categoryMarkers => {
            categoryMarkers.forEach(marker => {
                map.removeLayer(marker);
            });
        });

        // Show selected category markers
        if (category === 'all') {
            Object.values(markers).forEach(categoryMarkers => {
                categoryMarkers.forEach(marker => {
                    map.addLayer(marker);
                });
            });
        } else if (markers[category]) {
            markers[category].forEach(marker => {
                map.addLayer(marker);
            });
        }
    }

    // Center map button
    document.getElementById('centerMap').addEventListener('click', function() {
        map.setView([-2.9, 132.3], 9);
    });

    // Fullscreen functionality
    document.getElementById('fullscreen').addEventListener('click', function() {
        const mapWrapper = document.querySelector('.map-wrapper');
        if (!document.fullscreenElement) {
            mapWrapper.requestFullscreen().then(() => {
                setTimeout(() => map.invalidateSize(), 100);
            });
        } else {
            document.exitFullscreen().then(() => {
                setTimeout(() => map.invalidateSize(), 100);
            });
        }
    });

    // Legend toggle
    const legendToggle = document.getElementById('legendToggle');
    const legendContent = document.querySelector('.legend-content');
    let legendCollapsed = false;

    legendToggle.addEventListener('click', function() {
        legendCollapsed = !legendCollapsed;
        legendContent.style.display = legendCollapsed ? 'none' : 'block';
        this.style.transform = legendCollapsed ? 'rotate(180deg)' : 'rotate(0deg)';
    });

    // Legend item interactions
    document.querySelectorAll('.legend-item').forEach(item => {
        item.addEventListener('click', function() {
            const category = this.dataset.category;
            const button = document.querySelector(`[data-category="${category}"]`);
            if (button) {
                button.click();
            }
        });
    });

    // Info panel functionality
    function updateInfoPanel(location) {
        const infoContent = document.getElementById('infoContent');
        const infoPanel = document.getElementById('infoPanel');
        
        infoContent.innerHTML = `
            <div class="location-info">
                <h5 style="margin-bottom: 1rem; color: var(--text-primary);">${location.name}</h5>
                <div style="margin-bottom: 0.5rem;">
                    <strong>Skor:</strong> 
                    <span style="color: ${getColorByCategory(location.kategori)}; font-weight: 600;">
                        ${location.score.toFixed(4)}
                    </span>
                </div>
                <div style="margin-bottom: 0.5rem;">
                    <strong>Kategori:</strong> ${location.kategori}
                </div>
                <div style="margin-bottom: 0.5rem;">
                    <strong>Koordinat:</strong><br>
                    Lat: ${location.latitude.toFixed(6)}<br>
                    Lng: ${location.longitude.toFixed(6)}
                </div>
            </div>
        `;
        
        infoPanel.classList.add('show');
    }

    // Close info panel
    document.getElementById('infoPanelClose').addEventListener('click', function() {
        document.getElementById('infoPanel').classList.remove('show');
    });

    // Hide loading overlay
    setTimeout(() => {
        const loadingOverlay = document.getElementById('loadingOverlay');
        loadingOverlay.style.opacity = '0';
        setTimeout(() => {
            loadingOverlay.style.display = 'none';
        }, 300);
    }, 1500);

    // Add animation classes
    document.querySelector('.map-container').classList.add('fade-in');
    
    // Responsive handling
    function handleResize() {
        setTimeout(() => {
            map.invalidateSize();
        }, 100);
    }

    window.addEventListener('resize', handleResize);
    
    // Initialize map size
    setTimeout(() => {
        map.invalidateSize();
    }, 100);
});
</script>
@endpush