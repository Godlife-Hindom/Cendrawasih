@extends('layouts.user-app')
@section('content')
<div class="min-vh-100 bg-gradient-light">
    <div class="container-fluid py-4">
        

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">

                <!-- Main Form Card -->
                <div class="main-card">
                    <div class="card-glow"></div>
                    
                    <!-- Card Header -->
                    <div class="main-card-header">
                        <div class="header-content">
                            <div class="header-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div>
                                <h3 class="header-title">Edit Informasi Lokasi</h3>
                                <p class="header-subtitle">{{ $alternative->name ?? 'Lokasi Alternatif' }}</p>
                            </div>
                        </div>
                        <div class="header-badge">
                            <span class="badge-text">Edit Mode</span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="main-card-body">
                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="error-alert">
                                <div class="error-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="error-content">
                                    <h6 class="error-title">Terjadi Kesalahan!</h6>
                                    <ul class="error-list">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="error-close" onclick="this.parentElement.style.display='none'">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('user.alternatives.update', $alternative) }}" method="POST" id="editAlternativeForm" class="modern-form">
                            @csrf
                            @method('PUT')
                            
                            <!-- Section 1: Basic Information -->
                            <div class="form-section" data-section="1">
                                <div class="section-header">
                                    <div class="section-icon bg-primary">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="section-content">
                                        <h4 class="section-title">Informasi Dasar</h4>
                                        <p class="section-description">Masukkan nama dan identitas utama lokasi</p>
                                    </div>
                                </div>

                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt label-icon"></i>
                                            Nama Lokasi
                                            <span class="required">*</span>
                                        </label>
                                        <div class="input-wrapper">
                                            <input type="text" 
                                                   name="name" 
                                                   id="name"
                                                   value="{{ old('name', $alternative->name) }}" 
                                                   class="form-input @error('name') error @enderror" 
                                                   placeholder="Masukkan nama lokasi alternatif"
                                                   required>
                                            <div class="input-icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                        </div>
                                        @error('name')
                                            <div class="field-error">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Criteria Assessment -->
                            <div class="form-section" data-section="2">

                                <div class="criteria-grid">
                                    <!-- Vegetation Criterion -->
                                    <div class="criterion-card">
                                        <div class="criterion-header">
                                            <div class="criterion-icon bg-success">
                                                <i class="fas fa-leaf"></i>
                                            </div>
                                            <div class="criterion-info">
                                                <h6 class="criterion-title">Vegetasi</h6>
                                                <p class="criterion-desc">Kualitas dan kepadatan vegetasi</p>
                                            </div>
                                        </div>
                                        <div class="criterion-input">
                                            <div class="input-wrapper">
                                                <input type="number" 
                                                       step="any" 
                                                       name="vegetation" 
                                                       id="vegetation"
                                                       value="{{ old('vegetation', $alternative->vegetation) }}" 
                                                       class="form-input criterion-value @error('vegetation') error @enderror" 
                                                       placeholder="0.00"
                                                       required>
                                                <div class="input-suffix"></div>
                                            </div>
                                        </div>
                                        @error('vegetation')
                                            <div class="field-error">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Water Availability Criterion -->
                                    <div class="criterion-card">
                                        <div class="criterion-header">
                                            <div class="criterion-icon bg-info">
                                                <i class="fas fa-tint"></i>
                                            </div>
                                            <div class="criterion-info">
                                                <h6 class="criterion-title">Ketersediaan Air</h6>
                                                <p class="criterion-desc">Akses dan kualitas sumber air</p>
                                            </div>
                                        </div>
                                        <div class="criterion-input">
                                            <div class="input-wrapper">
                                                <input type="number" 
                                                       step="any"
                                                       name="water" 
                                                       id="water"
                                                       value="{{ old('water', $alternative->water) }}" 
                                                       class="form-input criterion-value @error('water') error @enderror" 
                                                       placeholder="0.00"
                                                       required>
                                                <div class="input-suffix"></div>
                                            </div>
                                        </div>
                                        @error('water')
                                            <div class="field-error">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Topography Criterion -->
                                    <div class="criterion-card">
                                        <div class="criterion-header">
                                            <div class="criterion-icon bg-warning">
                                                <i class="fas fa-mountain"></i>
                                            </div>
                                            <div class="criterion-info">
                                                <h6 class="criterion-title">Topografi</h6>
                                                <p class="criterion-desc">Kondisi medan dan elevasi</p>
                                            </div>
                                        </div>
                                        <div class="criterion-input">
                                            <class="input-wrapper">
                                                <input type="number" 
                                                       step="0.01" 
                                                       name="topography" 
                                                       id="topography"
                                                       value="{{ old('topography', $alternative->topography) }}" 
                                                       class="form-input criterion-value @error('topography') error @enderror" 
                                                       placeholder="0.00"
                                                       required>
                                                <div class="input-suffix"></div>
                                            </div>
                                        </div>
                                        @error('topography')
                                            <div class="field-error">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Climate Criterion -->
                                    <div class="criterion-card">
                                        <div class="criterion-header">
                                            <div class="criterion-icon bg-orange">
                                                <i class="fas fa-sun"></i>
                                            </div>
                                            <div class="criterion-info">
                                                <h6 class="criterion-title">Iklim</h6>
                                                <p class="criterion-desc">Kondisi curah hujan</p>
                                            </div>
                                        </div>
                                        <div class="criterion-input">
                                            <div class="input-wrapper">
                                                <input type="number" 
                                                       step="0.01" 
                                                       name="climate" 
                                                       id="climate"
                                                       value="{{ old('climate', $alternative->climate) }}" 
                                                       class="form-input criterion-value @error('climate') error @enderror" 
                                                       placeholder="0.00"
                                                       required>
                                                <div class="input-suffix"></div>
                                            </div>
                                        @error('climate')
                                            <div class="field-error">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Section 3: Location Coordinates -->
                            <div class="form-section" data-section="3">

                                <div class="coordinates-wrapper">
                                    <div class="coordinates-grid">
                                        <div class="coordinate-field">
                                            <label class="form-label">
                                                <i class="fas fa-compass label-icon text-danger"></i>
                                                Latitude
                                                <span class="required">*</span>
                                            </label>
                                            <div class="input-wrapper">
                                                <input type="text" 
                                                       name="latitude" 
                                                       id="latitude"
                                                       value="{{ old('latitude', $alternative->latitude) }}" 
                                                       class="form-input @error('latitude') error @enderror" 
                                                       placeholder="Contoh: -6.2088"
                                                       required>
                                                <div class="input-icon">
                                                    <i class="fas fa-compass"></i>
                                                </div>
                                            </div>
                                            @error('latitude')
                                                <div class="field-error">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="coordinate-field">
                                            <label class="form-label">
                                                <i class="fas fa-compass label-icon text-primary"></i>
                                                Longitude
                                                <span class="required">*</span>
                                            </label>
                                            <div class="input-wrapper">
                                                <input type="text" 
                                                       name="longitude" 
                                                       id="longitude"
                                                       value="{{ old('longitude', $alternative->longitude) }}" 
                                                       class="form-input @error('longitude') error @enderror" 
                                                       placeholder="Contoh: 106.8456"
                                                       required>
                                                <div class="input-icon">
                                                    <i class="fas fa-compass"></i>
                                                </div>
                                            </div>
                                            @error('longitude')
                                                <div class="field-error">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Location Preview -->
                                    <div class="location-preview">
                                        <div class="preview-header">
                                            <i class="fas fa-map-marked-alt me-2"></i>
                                            Preview Lokasi
                                        </div>
                                        <div class="preview-content">
                                            <div class="coordinate-display">
                                                <span class="coord-label">Lat:</span>
                                                <span class="coord-value" id="latDisplay">{{ $alternative->latitude ?? '-' }}</span>
                                            </div>
                                            <div class="coordinate-display">
                                                <span class="coord-label">Lng:</span>
                                                <span class="coord-value" id="lngDisplay">{{ $alternative->longitude ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
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
                            </div> -->

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <div class="actions-left">
                                    <a href="{{ route('user.alternatives.index') }}" class="btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Kembali
                                    </a>
                                </div>
                                <div class="actions-right">
                                    <button type="button" class="btn-outline" onclick="resetForm()">
                                        <i class="fas fa-undo me-2"></i>
                                        Reset
                                    </button>
                                    <button type="submit" class="btn-primary" id="submitBtn">
                                        <i class="fas fa-save me-2"></i>
                                        Update Lokasi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast -->
@if(session('success'))
<div class="toast-container">
    <div class="success-toast show">
        <div class="toast-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="toast-content">
            <h6 class="toast-title">Berhasil!</h6>
            <p class="toast-message">{{ session('success') }}</p>
        </div>
        <button type="button" class="toast-close" onclick="this.parentElement.classList.remove('show')">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
/* ===============================================
   ENHANCED MODERN ALTERNATIVE LOCATION FORM STYLES
   =============================================== */

:root {
    --primary: #667eea;
    --primary-dark: #5a6fd8;
    --primary-light: #8fa4f3;
    --secondary: #6c757d;
    --success: #10b981;
    --danger: #ef4444;
    --warning: #f59e0b;
    --info: #3b82f6;
    --orange: #f97316;
    --light: #f8fafc;
    --dark: #1e293b;
    --white: #ffffff;
    
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
    --gradient-danger: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    --gradient-info: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    --gradient-light: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    --shadow-glow: 0 0 0 1px rgb(255 255 255 / 0.05), 0 1px 0 0 rgb(255 255 255 / 0.05);
    
    --border-radius: 0.75rem;
    --border-radius-lg: 1rem;
    --border-radius-xl: 1.5rem;
    
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    --transition-slow: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Global Styles */
body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    font-weight: 400;
    line-height: 1.6;
    color: var(--dark);
    background: var(--gradient-light);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.bg-gradient-light {
    background: var(--gradient-light);
    min-height: 100vh;
}

/* Hero Header */
.hero-header {
    background: var(--gradient-primary);
    border-radius: var(--border-radius-xl);
    padding: 3rem 2.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-xl);
}

.hero-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='m36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-icon {
    width: 4rem;
    height: 4rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: var(--border-radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.hero-icon i {
    font-size: 1.5rem;
    color: white;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin: 0;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.125rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 400;
}

.hero-breadcrumb {
    margin-top: 1.5rem;
}

.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: var(--transition);
    font-weight: 500;
}

.breadcrumb-item a:hover {
    color: white;
}

.breadcrumb-item.active {
    color: rgba(255, 255, 255, 0.6);
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: rgba(255, 255, 255, 0.6);
    font-weight: 600;
}

.hero-decoration {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.decoration-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 6s ease-in-out infinite;
}

.circle-1 {
    width: 120px;
    height: 120px;
    top: 20%;
    right: 10%;
    animation-delay: 0s;
}

.circle-2 {
    width: 80px;
    height: 80px;
    top: 60%;
    right: 20%;
    animation-delay: 2s;
}

.circle-3 {
    width: 60px;
    height: 60px;
    top: 80%;
    right: 5%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

/* Progress Indicator */
.progress-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 0;
}

.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.progress-step.active .step-number {
    background: var(--gradient-primary);
    transform: scale(1.1);
}

.step-number {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    background: var(--secondary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1.125rem;
    box-shadow: var(--shadow-md);
    transition: var(--transition);
}

.step-label {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--dark);
}

.progress-line {
    width: 6rem;
    height: 2px;
    background: var(--gradient-primary);
    margin: 0 1rem;
    border-radius: 1px;
}

/* Main Card */
.main-card {
    background: white;
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-xl);
    overflow: hidden;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.card-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--gradient-primary);
    opacity: 0.8;
}

.main-card-header {
    background: var(--gradient-primary);
    padding: 2rem 2.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
}

.main-card-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transition: var(--transition-slow);
}

.header-content {
    display: flex;
    align-items: center;
    position: relative;
    z-index: 2;
}

.header-icon {
    width: 3.5rem;
    height: 3.5rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin-right: 1rem;
}

.header-icon i {
    font-size: 1.25rem;
    color: white;
}

.header-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: white;
    margin: 0;
    line-height: 1.2;
}

.header-subtitle {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
    font-weight: 400;
}

.header-badge {
    position: relative;
    z-index: 2;
}

.badge-text {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

/* Card Body */
.main-card-body {
    padding: 2.5rem;
}

/* Error Alert */
.error-alert {
    background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
    border: 1px solid #fecaca;
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: flex-start;
    position: relative;
}

.error-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: var(--gradient-danger);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.error-icon i {
    color: white;
    font-size: 1rem;
}

.error-content {
    flex: 1;
}

.error-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--danger);
    margin: 0 0 0.5rem 0;
}

.error-list {
    margin: 0;
    padding-left: 1.25rem;
    color: #991b1b;
}

.error-list li {
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.error-close {
    background: none;
    border: none;
    color: var(--danger);
    cursor: pointer;
    padding: 0.25rem;
    margin-left: 1rem;
    border-radius: 50%;
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.error-close:hover {
    background: rgba(239, 68, 68, 0.1);
}

/* Form Sections */
.form-section {
    margin-bottom: 3rem;
    background: linear-gradient(135deg, #fafbff 0%, #f1f5f9 100%);
    border-radius: var(--border-radius-lg);
    padding: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.8);
    box-shadow: var(--shadow-sm);
}

.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid rgba(255, 255, 255, 0.5);
}

.section-icon {
    width: 3rem;
    height: 3rem;
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    box-shadow: var(--shadow-md);
}

.section-icon.bg-primary {
    background: var(--gradient-primary);
}

.section-icon.bg-success {
    background: var(--gradient-success);
}

.section-icon.bg-danger {
    background: var(--gradient-danger);
}

.section-icon i {
    color: white;
    font-size: 1.125rem;
}

.section-content {
    flex: 1;
}

.section-title {
    font-size: 1.375rem;
    font-weight: 600;
    color: var(--dark);
    margin: 0 0 0.25rem 0;
    line-height: 1.2;
}

.section-description {
    font-size: 0.875rem;
    color: var(--secondary);
    margin: 0;
    line-height: 1.4;
}

/* Form Elements */
.form-grid {
    display: grid;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    display: flex;
    align-items: center;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.5rem;
    line-height: 1.4;
}

.label-icon {
    margin-right: 0.5rem;
    font-size: 0.875rem;
    opacity: 0.7;
}

.required {
    color: var(--danger);
    margin-left: 0.25rem;
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.form-input {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    font-weight: 400;
    color: var(--dark);
    background: white;
    transition: var(--transition);
    outline: none;
}

.form-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: #fafbff;
}

.form-input.error {
    border-color: var(--danger);
    background: #fef2f2;
}

.form-input.error:focus {
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.input-icon {
    position: absolute;
    right: 1rem;
    color: var(--secondary);
    pointer-events: none;
    opacity: 0.6;
}

.input-suffix {
    position: absolute;
    right: 1rem;
    color: var(--secondary);
    font-size: 0.875rem;
    font-weight: 500;
    pointer-events: none;
}

.field-error {
    display: flex;
    align-items: center;
    margin-top: 0.5rem;
    color: var(--danger);
    font-size: 0.75rem;
    font-weight: 500;
}

.field-error i {
    margin-right: 0.375rem;
}

/* Criteria Grid */
.criteria-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.criterion-card {
    background: white;
    border-radius: var(--border-radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(255, 255, 255, 0.8);
    transition: var(--transition);
}

.criterion-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.criterion-header {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.criterion-icon {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    box-shadow: var(--shadow-sm);
}

.criterion-icon.bg-success {
    background: var(--gradient-success);
}

.criterion-icon.bg-info {
    background: var(--gradient-info);
}

.criterion-icon.bg-warning {
    background: var(--gradient-warning);
}

.criterion-icon.bg-orange {
    background: linear-gradient(135deg, var(--orange) 0%, #ea580c 100%);
}

.criterion-icon i {
    color: white;
    font-size: 1rem;
}

.criterion-info {
    flex: 1;
}

.criterion-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--dark);
    margin: 0 0 0.25rem 0;
    line-height: 1.2;
}

.criterion-desc {
    font-size: 0.75rem;
    color: var(--secondary);
    margin: 0;
    line-height: 1.3;
}

.criterion-input {
    margin-top: 1rem;
}

.criterion-value {
    text-align: center;
    font-weight: 600;
    padding-right: 2.5rem;
}

.value-indicator {
    margin-top: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.indicator-bar {
    flex: 1;
    height: 0.5rem;
    background: #e2e8f0;
    border-radius: 0.25rem;
    overflow: hidden;
}

.indicator-fill {
    height: 100%;
    background: var(--gradient-primary);
    transition: var(--transition-slow);
    border-radius: 0.25rem;
}

.indicator-text {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--primary);
    min-width: 3rem;
    text-align: right;
}

/* Coordinates */
.coordinates-wrapper {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.coordinates-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.coordinate-field {
    display: flex;
    flex-direction: column;
}

.location-preview {
    background: white;
    border-radius: var(--border-radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.preview-header {
    font-size: 1rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

.preview-content {
    display: flex;
    gap: 2rem;
}

.coordinate-display {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.coord-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--secondary);
}

.coord-value {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--primary);
    font-family: 'Fira Code', monospace;
}

/* Form Actions */
.form-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid rgba(255, 255, 255, 0.5);
}

.actions-left,
.actions-right {
    display: flex;
    align-items: center;
    gap: 1rem;
}

/* Buttons */
.btn-primary,
.btn-secondary,
.btn-outline {
    display: inline-flex;
    align-items: center;
    padding: 0.875rem 1.5rem;
    border-radius: var(--border-radius);
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    outline: none;
    position: relative;
    overflow: hidden;
}

.btn-primary {
    background: var(--gradient-primary);
    color: white;
    box-shadow: var(--shadow-md);
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-lg);
}

.btn-primary:active {
    transform: translateY(0);
}

.btn-secondary {
    background: var(--secondary);
    color: white;
    box-shadow: var(--shadow-md);
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-1px);
    box-shadow: var(--shadow-lg);
}

.btn-outline {
    background: white;
    color: var(--secondary);
    border: 2px solid #e2e8f0;
    box-shadow: var(--shadow-sm);
}

.btn-outline:hover {
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

/* Toast */
.toast-container {
    position: fixed;
    top: 2rem;
    right: 2rem;
    z-index: 9999;
}

.success-toast {
    background: white;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-xl);
    border: 1px solid rgba(16, 185, 129, 0.2);
    padding: 1.5rem;
    display: flex;
    align-items: center;
    max-width: 400px;
    transform: translateX(100%);
    opacity: 0;
    transition: var(--transition-slow);
}

.success-toast.show {
    transform: translateX(0);
    opacity: 1;
}

.toast-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: var(--gradient-success);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.toast-icon i {
    color: white;
    font-size: 1rem;
}

.toast-content {
    flex: 1;
}

.toast-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--success);
    margin: 0 0 0.25rem 0;
}

.toast-message {
    font-size: 0.875rem;
    color: var(--dark);
    margin: 0;
    line-height: 1.4;
}

.toast-close {
    background: none;
    border: none;
    color: var(--secondary);
    cursor: pointer;
    padding: 0.25rem;
    margin-left: 1rem;
    border-radius: 50%;
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.toast-close:hover {
    background: rgba(107, 114, 128, 0.1);
    color: var(--dark);
}

.map-container {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 1rem;
    border: 2px solid rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

/* Ubah warna teks jadi hitam */
.map-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    color: black; /* ubah dari white ke black */
}

.map-status {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: black; /* ubah dari rgba ke black */
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
        color: white;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        margin-top: 1rem;
        font-family: 'Courier New', monospace;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

/* Responsive Design */
@media (max-width: 768px) {
    .hero-header {
        padding: 2rem 1.5rem;
    }
    
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .main-card-body {
        padding: 1.5rem;
    }
    
    .form-section {
        padding: 1.5rem;
    }
    
    .criteria-grid {
        grid-template-columns: 1fr;
    }
    
    .coordinates-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    
    .actions-left,
    .actions-right {
        justify-content: center;
    }
    
    .toast-container {
        top: 1rem;
        right: 1rem;
        left: 1rem;
    }
    
    .success-toast {
        max-width: none;
    }
}

@media (max-width: 480px) {
    .hero-icon {
        width: 3rem;
        height: 3rem;
    }
    
    .hero-title {
        font-size: 1.75rem;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
    
    .section-icon {
        margin-bottom: 1rem;
        margin-right: 0;
    }
}
</style>

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
    fetch(`https://api.spkcendrawasih.site/extract?lat=${lat}&lng=${lng}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update form fields dengan data dari server
            document.getElementById("vegetation").value = data.data.ndvi;
            document.getElementById("water").value = data.data.ndwi;
            document.getElementById("topography").value = data.data.dsm;
            document.getElementById("climate").value = data.data.rainfall;

            // Update preview data
            document.getElementById("previewVegetation").textContent = data.data.ndvi;
            document.getElementById("previewWater").textContent = data.data.ndwi;
            document.getElementById("previewTopography").textContent = data.data.dsm;
            document.getElementById("previewClimate").textContent = data.data.rainfall + " mm";

            // Show data preview
            document.getElementById("dataPreview").style.display = 'block';

            // Update status
            mapStatus.textContent = 'Data berhasil diambil';
            statusIndicator.style.background = '#00f2fe';
        } else {
            // Handle error
            alert('Gagal mengambil data lingkungan: ' + data.message);
            mapStatus.textContent = 'Gagal mengambil data';
            statusIndicator.style.background = '#ff9a9e';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Fallback dengan data simulasi
        simulateEnvironmentalData();
        mapStatus.textContent = 'Menggunakan data simulasi';
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
document.addEventListener('DOMContentLoaded', function() {
    // Update indicator bars and text on input change
    const criterionInputs = document.querySelectorAll('.criterion-value');
    
    criterionInputs.forEach(input => {
        updateIndicator(input);
        
        input.addEventListener('input', function() {
            updateIndicator(this);
        });
    });
    
    function updateIndicator(input) {
        const value = parseFloat(input.value) || 0;
        const card = input.closest('.criterion-card');
        const fill = card.querySelector('.indicator-fill');
        const text = card.querySelector('.indicator-text');
        
        fill.style.width = Math.max(0, Math.min(100, value)) + '%';
        text.textContent = value.toFixed(2) + '%';
    }
    
    // Update coordinate display
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const latDisplay = document.getElementById('latDisplay');
    const lngDisplay = document.getElementById('lngDisplay');
    
    function updateCoordinateDisplay() {
        latDisplay.textContent = latInput.value || '-';
        lngDisplay.textContent = lngInput.value || '-';
    }
    
    latInput.addEventListener('input', updateCoordinateDisplay);
    lngInput.addEventListener('input', updateCoordinateDisplay);
    
    // Form validation
    const form = document.getElementById('editAlternativeForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function(e) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });
    
    // Auto-hide success toast
    const successToast = document.querySelector('.success-toast.show');
    if (successToast) {
        setTimeout(() => {
            successToast.classList.remove('show');
        }, 5000);
    }
});

// Reset form function
function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset form? Semua perubahan akan hilang.')) {
        document.getElementById('editAlternativeForm').reset();
        
        // Reset indicators
        const indicators = document.querySelectorAll('.indicator-fill');
        const texts = document.querySelectorAll('.indicator-text');
        
        indicators.forEach(indicator => {
            indicator.style.width = '0%';
        });
        
        texts.forEach(text => {
            text.textContent = '0.00%';
        });
        
        // Reset coordinate display
        document.getElementById('latDisplay').textContent = '{{ $alternative->latitude ?? "-" }}';
        document.getElementById('lngDisplay').textContent = '{{ $alternative->longitude ?? "-" }}';
        
        // Reload original values
        location.reload();
    }
}
</script>
@endpush
@endsection