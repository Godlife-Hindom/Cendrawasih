@extends('layouts.admin-app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="header-section">
        <div class="header-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
        <h1 class="header-title">Manajemen Criteria</h1>
        <p class="header-subtitle">Tentukan dan konfigurasikan kriteria evaluasi Anda dengan presisi</p>
    </div>

    <!-- Main Form Card -->
    <div class="form-card">
        <!-- Card Header -->
        <div class="card-header">
            <h3>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Tambah Criteria Baru
            </h3>
        </div>

        <!-- Form Body -->
        <div class="form-body">
            <!-- Success Message -->
            @if(session('success'))
            <div class="success-message">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
            <div class="error-message">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Silakan periksa formulir untuk mengetahui kesalahannya, lalu coba lagi.</span>
            </div>
            @endif

            <form action="{{ route('criteria.store') }}" method="POST" id="criteriaForm" novalidate>
                @csrf
                
                <!-- Form Row 1: Basic Information -->
                <div class="form-row">
                    <!-- Criteria Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <svg class="text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Nama Criteria
                        </label>
                        <div class="form-input-wrapper">
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="form-input @error('name') error @enderror" 
                                placeholder="Input Nama criteria"
                                value="{{ old('name') }}"
                                required
                                aria-describedby="name-help"
                            >
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div id="name-help" class="help-text @error('name') error @enderror">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @error('name')
                                {{ $message }}
                            @else
                             Masukan kriteria Anda 
                            @enderror
                        </div>
                    </div>

                    <!-- Criteria Code -->
                    <div class="form-group">
                        <label for="code" class="form-label">
                            <svg class="text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                            Kode Criteria
                        </label>
                        <div class="form-input-wrapper">
                            <input 
                                type="text" 
                                id="code" 
                                name="code" 
                                class="form-input purple-focus @error('code') error @enderror" 
                                placeholder="Contoh : C001, QUAL_01"
                                value="{{ old('code') }}"
                                required
                                aria-describedby="code-help"
                            >
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                        <div id="code-help" class="help-text @error('code') error @enderror">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @error('code')
                                {{ $message }}
                            @else
                                Pengidentifikasi unik untuk kriteria ini (alfanumerik)
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Row 2: Weight and Type -->
                <div class="form-row">
                    <!-- Weight -->
                    <div class="form-group">
                        <label for="weight" class="form-label">
                            <svg class="text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l3-1m-3 1l-3-1"></path>
                            </svg>
                            Bobot (%)
                        </label>
                        <div class="form-input-wrapper">
                            <input 
                                type="number" 
                                id="weight" 
                                name="weight" 
                                class="form-input green-focus @error('weight') error @enderror" 
                                placeholder="0-100"
                                value="{{ old('weight') }}"
                                min="0"
                                max="100"
                                step="0.1"
                                required
                                aria-describedby="weight-help"
                            >
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l3-1m-3 1l-3-1"></path>
                            </svg>
                        </div>
                        <div id="weight-help" class="help-text @error('weight') error @enderror">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @error('weight')
                                {{ $message }}
                            @else
                             Persentase bobot kriteria ini (0-100%)
                            @enderror
                        </div>
                    </div>

                    <!-- Criteria Type -->
                    <div class="form-group">
                        <label for="type" class="form-label">
                            <svg class="text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Type Criteria 
                        </label>
                        <div class="form-input-wrapper">
                            <select 
                                id="type" 
                                name="type" 
                                class="form-select orange-focus @error('type') error @enderror" 
                                required
                                aria-describedby="type-help"
                            >
                                <option value="">Pilih Type Criteria</option>
                                <option value="benefit" {{ old('type') == 'benefit' ? 'selected' : '' }}>Benefit (Nilai Tertinggi Lebih Baik)</option>
                                <option value="cost" {{ old('type') == 'cost' ? 'selected' : '' }}>Cost (Nilai Terendah Lebih Baik)</option>
                            </select>
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div id="type-help" class="help-text @error('type') error @enderror">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @error('type')
                                {{ $message }}
                            @else
                            Tentukan apakah nilai yang lebih tinggi atau lebih rendah lebih baik.
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('criteria.index') }}" class="btn btn-secondary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke List
                    </a>
                    
                    <div style="display: flex; gap: 1rem;">
                        <button type="reset" class="btn btn-secondary" onclick="resetForm()">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset Form
                        </button>
                        
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span id="submitText">Simpan Criteria</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="loading-overlay" style="display: none;">
    <div class="loading-content">
        <div class="loading-spinner"></div>
        <div class="loading-text">Menyimpan criteria...</div>
    </div>
</div>

<style>
/* ==============================================
   CRITERIA FORM - COMPLETE CSS STYLING
   ============================================== */

/* Reset and Base Styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: #374151;
    background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 50%, #faf5ff 100%);
    min-height: 100vh;
}

/* Container and Layout */
.container {
    max-width: none !important;
    width: 100%;
    margin: 0 auto;
    padding: 2rem 1rem;
}

/* Header Section Styles */
.header-section {
    text-align: center;
    margin-bottom: 3rem;
}

.header-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 5rem;
    height: 5rem;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    border-radius: 50%;
    margin-bottom: 1.5rem;
    box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
    animation: pulse-glow 3s infinite;
    transition: transform 0.3s ease;
}

.header-icon:hover {
    transform: scale(1.1) rotate(5deg);
}

.header-icon svg {
    width: 2.5rem;
    height: 2.5rem;
    color: white;
}

.header-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 0.75rem;
    background: linear-gradient(135deg, #1f2937, #4f46e5, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: fadeInUp 0.8s ease-out;
}

.header-subtitle {
    color: #6b7280;
    font-size: 1.125rem;
    font-weight: 400;
    animation: fadeInUp 1s ease-out;
}

/* Main Form Card Styles */
.form-card {
    max-width: 48rem;
    margin: 0 auto;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 1.5rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(255, 255, 255, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.2);
    overflow: hidden;
    animation: slideInUp 0.8s ease-out;
    position: relative;
}

.form-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899, #f59e0b);
    background-size: 200% 100%;
    animation: gradientShift 3s ease-in-out infinite;
}

/* Card Header */
.card-header {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    padding: 2.5rem;
    position: relative;
    overflow: hidden;
}

.card-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
}

.card-header h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
    display: flex;
    align-items: center;
    position: relative;
    z-index: 1;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.card-header svg {
    width: 1.75rem;
    height: 1.75rem;
    margin-right: 1rem;
}

/* Form Body */
.form-body {
    padding: 2.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 2rem;
    position: relative;
}

/* Label Styles */
.form-label {
    display: flex;
    align-items: center;
    font-size: 0.95rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    transition: color 0.3s ease;
}

.form-label svg {
    width: 1.25rem;
    height: 1.25rem;
    margin-right: 0.75rem;
    transition: transform 0.3s ease;
}

.form-label .text-blue-500 {
    color: #3b82f6;
}

.form-label .text-purple-500 {
    color: #8b5cf6;
}

.form-label .text-green-500 {
    color: #10b981;
}

.form-label .text-orange-500 {
    color: #f59e0b;
}

/* Input Styles */
.form-input-wrapper {
    position: relative;
}

.form-input {
    width: 100%;
    padding: 1rem 1.25rem 1rem 3.5rem;
    border: 2px solid #e5e7eb;
    border-radius: 0.75rem;
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.form-input:focus {
    border-color: #3b82f6;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), 0 8px 25px rgba(59, 130, 246, 0.15);
    transform: translateY(-3px);
}

.form-input.purple-focus:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1), 0 8px 25px rgba(139, 92, 246, 0.15);
}

.form-input.green-focus:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1), 0 8px 25px rgba(16, 185, 129, 0.15);
}

.form-input.orange-focus:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1), 0 8px 25px rgba(245, 158, 11, 0.15);
}

.form-input.error {
    border-color: #ef4444;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    animation: shake 0.5s ease-in-out;
}

/* Input Icons */
.input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    width: 1.5rem;
    height: 1.5rem;
    color: #9ca3af;
    pointer-events: none;
    transition: all 0.3s ease;
}

.form-input:focus + .input-icon {
    color: #3b82f6;
    transform: translateY(-50%) scale(1.1);
}

/* Select Styles */
.form-select {
    width: 100%;
    padding: 1rem 1.25rem 1rem 3.5rem;
    border: 2px solid #e5e7eb;
    border-radius: 0.75rem;
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

.form-select:focus {
    border-color: #3b82f6;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), 0 8px 25px rgba(59, 130, 246, 0.15);
    transform: translateY(-3px);
}

/* Help Text */
.help-text {
    display: flex;
    align-items: center;
    font-size: 0.8rem;
    color: #6b7280;
    margin-top: 0.5rem;
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease;
}

.form-group:hover .help-text,
.form-input:focus ~ .help-text {
    opacity: 1;
    transform: translateY(0);
}

.help-text svg {
    width: 0.875rem;
    height: 0.875rem;
    margin-right: 0.375rem;
}

.help-text.error {
    color: #ef4444;
    opacity: 1;
    transform: translateY(0);
}

/* Tips Section */
.tips-section {
    background: linear-gradient(135deg, #f0fdf4, #eff6ff);
    border-radius: 1rem;
    padding: 1.5rem;
    border-left: 4px solid #3b82f6;
    margin: 2rem 0;
    position: relative;
    overflow: hidden;
}

.tips-section::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(30px, -30px);
}

.tips-header {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.tips-header svg {
    width: 1.5rem;
    height: 1.5rem;
    color: #3b82f6;
    margin-right: 0.75rem;
}

.tips-title {
    font-size: 1rem;
    font-weight: 600;
    color: #374151;
}

.tips-list {
    font-size: 0.9rem;
    color: #6b7280;
    margin-left: 2.25rem;
    line-height: 1.7;
}

.tips-list li {
    margin-bottom: 0.5rem;
    position: relative;
    padding-left: 1rem;
}

.tips-list li::before {
    content: '✨';
    position: absolute;
    left: 0;
    color: #3b82f6;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
    gap: 1.5rem;
}

.btn {
    display: inline-flex;
    align-items: center;
    padding: 1rem 2rem;
    font-weight: 600;
    border-radius: 0.75rem;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 0.95rem;
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn:hover::before {
    left: 100%;
}

.btn svg {
    width: 1.125rem;
    height: 1.125rem;
    margin-right: 0.75rem;
    transition: transform 0.3s ease;
}

.btn:hover svg {
    transform: scale(1.1);
}

.btn-secondary {
    color: #6b7280;
    background: linear-gradient(145deg, #f9fafb, #e5e7eb);
    border: 1px solid #d1d5db;
}

.btn-secondary:hover {
    background: linear-gradient(145deg, #e5e7eb, #d1d5db);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    color: white;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    box-shadow: 0 12px 35px rgba(59, 130, 246, 0.5);
    transform: translateY(-3px);
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Success Message */
.success-message {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border: 1px solid #10b981;
    border-radius: 0.75rem;
    padding: 1rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    animation: slideInDown 0.5s ease-out;
}

.success-message svg {
    width: 1.5rem;
    height: 1.5rem;
    color: #059669;
    margin-right: 0.75rem;
}

.success-message span {
    color: #065f46;
    font-weight: 500;
}

/* Error Message */
.error-message {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    border: 1px solid #ef4444;
    border-radius: 0.75rem;
    padding: 1rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    animation: slideInDown 0.5s ease-out;
}

.error-message svg {
    width: 1.5rem;
    height: 1.5rem;
    color: #dc2626;
    margin-right: 0.75rem;
}

.error-message span {
    color: #991b1b;
    font-weight: 500;
}

/* Loading States */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    animation: fadeIn 0.3s ease-out;
}

.loading-content {
    background: white;
    border-radius: 1rem;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
}

.loading-spinner {
    width: 3rem;
    height: 3rem;
    border: 4px solid #f3f4f6;
    border-top: 4px solid #3b82f6;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-bottom: 1rem;
}

.loading-text {
    color: #374151;
    font-weight: 500;
}

/* Animations */
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

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
    }
    50% {
        box-shadow: 0 20px 45px rgba(59, 130, 246, 0.6);
    }
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 1rem 0.5rem;
    }
    
    .form-card {
        margin: 0 0.5rem;
        border-radius: 1rem;
    }
    
    .card-header, .form-body {
        padding: 2rem 1.5rem;
    }
    
    .header-title {
        font-size: 2rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .form-card {
        margin: 0.25rem;
    }
    
    .card-header, .form-body {
        padding: 1.5rem 1rem;
    }
    
    .header-icon {
        width: 4rem;
        height: 4rem;
    }
    
    .header-title {
        font-size: 1.75rem;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    body {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        color: #e2e8f0;
    }
    
    .form-card {
        background: rgba(15, 23, 42, 0.95);
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    .form-input, .form-select {
        background: linear-gradient(145deg, #1e293b, #334155);
        border-color: #475569;
        color: #e2e8f0;
    }
    
    .form-input:focus, .form-select:focus {
        background: #1e293b;
    }
}

/* Accessibility improvements */
.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

/* Focus management */
.form-input:focus-visible,
.form-select:focus-visible,
.btn:focus-visible {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('criteriaForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingOverlay = document.getElementById('loadingOverlay');
    
    // Form validation
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    
    // Real-time validation
    inputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', clearError);
    });
    
    function validateField(e) {
        const field = e.target;
        const value = field.value.trim();
        
        // Clear previous error state
        field.classList.remove('error');
        const helpText = document.getElementById(field.name + '-help') || 
                        field.parentNode.parentNode.querySelector('.help-text');
        
        if (helpText) {
            helpText.classList.remove('error');
        }
        
        // Validate based on field type
        let isValid = true;
        let errorMessage = '';
        
        if (!value) {
            isValid = false;
            errorMessage = 'This field is required';
        } else {
            switch(field.name) {
                case 'name':
                    if (value.length < 3) {
                        isValid = false;
                        errorMessage = 'Name must be at least 3 characters long';
                    }
                    break;
                    
                case 'code':
                    if (!/^[A-Za-z0-9_-]+$/.test(value)) {
                        isValid = false;
                        errorMessage = 'Code can only contain letters, numbers, underscores, and hyphens';
                    }
                    break;
                    
                case 'weight':
                    const weight = parseFloat(value);
                    if (isNaN(weight) || weight < 0 || weight > 100) {
                        isValid = false;
                        errorMessage = 'Weight must be between 0 and 100';
                    }
                    break;
            }
        }
        
        if (!isValid) {
            field.classList.add('error');
            if (helpText) {
                helpText.classList.add('error');
                const errorSpan = helpText.querySelector('span') || helpText;
                if (errorSpan.tagName !== 'SVG') {
                    errorSpan.textContent = errorMessage;
                }
            }
        }
        
        return isValid;
    }
    
    function clearError(e) {
        const field = e.target;
        if (field.classList.contains('error') && field.value.trim()) {
            field.classList.remove('error');
            const helpText = document.getElementById(field.name + '-help') || 
                            field.parentNode.parentNode.querySelector('.help-text');
            if (helpText) {
                helpText.classList.remove('error');
            }
        }
    }
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate all fields
        let isFormValid = true;
        inputs.forEach(input => {
            if (!validateField({ target: input })) {
                isFormValid = false;
            }
        });
        
        if (!isFormValid) {
            // Focus on first error field
            const firstError = form.querySelector('.error');
            if (firstError) {
                firstError.focus();
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return;
        }
        
        // Show loading state
        showLoading();
        
        // Submit form (in real app, this would be an AJAX request)
        setTimeout(() => {
            form.submit();
        }, 500);
    });
    
    function showLoading() {
        loadingOverlay.style.display = 'flex';
        submitBtn.disabled = true;
        submitText.textContent = 'Saving...';
        
        // Add spinning icon
        const icon = submitBtn.querySelector('svg');
        if (icon) {
            icon.style.animation = 'spin 1s linear infinite';
        }
    }
    
    // Reset form function
    window.resetForm = function() {
        // Clear all errors
        form.querySelectorAll('.error').forEach(el => {
            el.classList.remove('error');
        });
        
        // Reset form
        form.reset();
        
        // Focus on first input
        const firstInput = form.querySelector('input');
        if (firstInput) {
            firstInput.focus();
        }
        
        // Show success message
        showNotification('Form has been reset successfully!', 'success');
    };
    
    // Auto-generate code from name
    const nameInput = document.getElementById('name');
    const codeInput = document.getElementById('code');
    
    nameInput.addEventListener('input', function() {
        if (!codeInput.value || codeInput.dataset.autoGenerated) {
            const code = this.value
                .toUpperCase()
                .replace(/[^A-Z0-9\s]/g, '')
                .replace(/\s+/g, '_')
                .substring(0, 10);
            
            if (code) {
                codeInput.value = code;
                codeInput.dataset.autoGenerated = 'true';
            }
        }
    });
    
    codeInput.addEventListener('input', function() {
        if (this.value) {
            delete this.dataset.autoGenerated;
        }
    });
    
    // Notification system
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? 'linear-gradient(135deg, #d1fae5, #a7f3d0)' : 
                          type === 'error' ? 'linear-gradient(135deg, #fee2e2, #fecaca)' : 
                          'linear-gradient(135deg, #dbeafe, #bfdbfe)'};
            border: 1px solid ${type === 'success' ? '#10b981' : 
                               type === 'error' ? '#ef4444' : '#3b82f6'};
            color: ${type === 'success' ? '#065f46' : 
                    type === 'error' ? '#991b1b' : '#1e40af'};
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            z-index: 10000;
            animation: slideInRight 0.3s ease-out;
            max-width: 300px;
            font-weight: 500;
        `;
        
        notification.innerHTML = `
            <div style="display: flex; align-items: center;">
                <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${type === 'success' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' :
                      type === 'error' ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
                      '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'}
                </svg>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
    
    // Add slideIn/slideOut animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            submitBtn.click();
        }
        
        // Ctrl/Cmd + R to reset
        if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
            e.preventDefault();
            resetForm();
        }
        
        // Escape to go back
        if (e.key === 'Escape') {
            const backButton = document.querySelector('.btn-secondary');
            if (backButton) {
                backButton.click();
            }
        }
    });
    
    // Form auto-save to localStorage (optional)
    const autoSaveKey = 'criteria_form_autosave';
    
    // Load auto-saved data
    try {
        const savedData = localStorage.getItem(autoSaveKey);
        if (savedData) {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(key => {
                const field = form.querySelector(`[name="${key}"]`);
                if (field && !field.value) {
                    field.value = data[key];
                }
            });
        }
    } catch (e) {
        console.log('Auto-save data could not be loaded');
    }
    
    // Auto-save form data
    let autoSaveTimeout;
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                const formData = {};
                inputs.forEach(field => {
                    if (field.value) {
                        formData[field.name] = field.value;
                    }
                });
                
                try {
                    localStorage.setItem(autoSaveKey, JSON.stringify(formData));
                } catch (e) {
                    console.log('Auto-save failed');
                }
            }, 1000);
        });
    });
    
    // Clear auto-save on successful submit
    form.addEventListener('submit', function() {
        try {
            localStorage.removeItem(autoSaveKey);
        } catch (e) {
            console.log('Auto-save cleanup failed');
        }
    });
});
</script>
@endpush