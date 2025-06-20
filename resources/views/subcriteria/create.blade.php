@extends('layouts.admin-app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center justify-content-center bg-success bg-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-plus text-white fs-4"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">Tambah Subkriteria</h2>
                <p class="text-muted mb-1">Untuk Kriteria: <span class="fw-semibold text-primary">{{ $criteria->name }}</span></p>
                <small class="text-muted">Lengkapi informasi subkriteria baru dengan detail yang akurat</small>
            </div>

            <!-- Main Form Card -->
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <div class="card-body p-5">
                    <form action="{{ route('subcriterias.store', $criteria->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <!-- Kriteria Info Card -->
                        <div class="alert alert-info border-0 rounded-3 mb-4" style="background: linear-gradient(135deg, rgba(13, 202, 240, 0.1) 0%, rgba(13, 110, 253, 0.1) 100%);">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-info fs-5 me-3"></i>
                                <div>
                                    <h6 class="fw-semibold text-info mb-1">Kriteria Induk</h6>
                                    <p class="mb-0 text-dark">{{ $criteria->name }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Nama Subkriteria Field -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-tag text-primary me-2"></i>Nama Subkriteria
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-font text-muted"></i>
                                </span>
                                <input type="text" name="name" id="name" 
                                       class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" 
                                       placeholder="Masukkan nama subkriteria yang deskriptif"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">
                                <i class="fas fa-lightbulb me-1"></i>
                                Gunakan nama yang jelas dan mudah dipahami
                            </div>
                        </div>

                        <!-- Rentang Nilai Field -->
                        <div class="mb-4">
                            <label for="range" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-ruler text-success me-2"></i>Rentang Nilai
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-arrows-alt-h text-muted"></i>
                                </span>
                                <input type="text" name="range" id="range" 
                                       class="form-control border-start-0 ps-0 @error('range') is-invalid @enderror" 
                                       value="{{ old('range') }}" 
                                       placeholder="Contoh: 0.70 - 1.00, A-E, 1-10"
                                       required>
                                @error('range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">
                                <i class="fas fa-chart-line me-1"></i>
                                Tentukan rentang penilaian yang sesuai untuk subkriteria ini
                            </div>
                        </div>

                        <!-- Nilai Skor Field -->
                        <div class="mb-4">
                            <label for="score" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-star text-warning me-2"></i>Nilai Skor
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-calculator text-muted"></i>
                                </span>
                                <input type="number" name="score" id="score" 
                                       class="form-control border-start-0 ps-0 @error('score') is-invalid @enderror" 
                                       value="{{ old('score') }}" 
                                       placeholder="Masukkan nilai skor numerik"
                                       min="0" step="0.01"
                                       required>
                                @error('score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">
                                <i class="fas fa-balance-scale me-1"></i>
                                Skor ini akan mempengaruhi bobot dalam perhitungan evaluasi
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mt-5">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <a href="{{ route('subcriterias.index', $criteria->id) }}" 
                                   class="btn btn-light btn-lg w-100 border-2 border-secondary text-dark fw-semibold">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success btn-lg w-100 fw-semibold shadow-sm">
                                    <i class="fas fa-save me-2"></i>Simpan Subkriteria
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help & Tips Card -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-question-circle text-info fs-4"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-semibold text-dark mb-2">Panduan Pengisian</h6>
                                    <ul class="list-unstyled text-muted mb-0 small">
                                        <li class="mb-1">• Nama harus unik dan deskriptif</li>
                                        <li class="mb-1">• Rentang nilai konsisten dengan metode evaluasi</li>
                                        <li class="mb-1">• Skor berpengaruh pada hasil akhir</li>
                                        <li>• Semua field wajib diisi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 bg-gradient h-100" style="background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-rocket text-success fs-4"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-semibold text-dark mb-2">Tips Terbaik</h6>
                                    <ul class="list-unstyled text-muted mb-0 small">
                                        <li class="mb-1">• Gunakan penamaan yang intuitif</li>
                                        <li class="mb-1">• Pertimbangkan skala yang mudah dipahami</li>
                                        <li class="mb-1">• Skor sebaiknya proporsional</li>
                                        <li>• Review sebelum menyimpan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    
    .input-group-text {
        transition: all 0.3s ease;
    }
    
    .form-control:focus + .input-group-text,
    .input-group-text:has(+ .form-control:focus) {
        border-color: #28a745;
        background-color: rgba(40, 167, 69, 0.1);
    }
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .form-control, .input-group-text {
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        transform: translateY(-1px);
    }
    
    .btn-light:hover {
        background-color: #f8f9fa;
        border-color: #6c757d;
        transform: translateY(-1px);
    }
    
    .alert {
        border-left: 4px solid #0dcaf0;
    }
    
    .input-group:hover .input-group-text {
        background-color: rgba(40, 167, 69, 0.05);
    }
    
    .card-header {
        position: relative;
        overflow: hidden;
    }
    
    .card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        transition: left 0.5s;
    }
    
    .card:hover .card-header::before {
        left: 100%;
    }
</style>
@endpush

@push('scripts')
<script>
    // Form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        
                        // Show toast notification for validation errors
                        showToast('Periksa kembali form Anda', 'error');
                    } else {
                        // Show loading state
                        event.target.querySelector('button[type="submit"]').innerHTML = 
                            '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Auto-focus first input
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('name').focus();
        
        // Real-time validation feedback
        const inputs = document.querySelectorAll('input[required]');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                }
            });
        });
    });

    // Toast notification function
    function showToast(message, type = 'success') {
        // Create toast if it doesn't exist
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }
        
        const toastId = 'toast-' + Date.now();
        const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
        
        const toastHTML = `
            <div id="${toastId}" class="toast align-items-center text-white ${bgClass} border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `;
        
        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        const toast = new bootstrap.Toast(document.getElementById(toastId));
        toast.show();
    }

    // Input formatting helpers
    document.getElementById('range').addEventListener('input', function(e) {
        // Auto-format range input
        let value = e.target.value;
        // Add helpful formatting suggestions
        if (value && !value.includes('-') && !value.includes('to') && value.length > 1) {
            // This is just a placeholder for potential auto-formatting logic
        }
    });

    document.getElementById('score').addEventListener('input', function(e) {
        // Ensure positive numbers only
        if (parseFloat(e.target.value) < 0) {
            e.target.value = 0;
        }
    });
</script>
@endpush
@endsection