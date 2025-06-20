@extends('layouts.admin-app')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-edit text-white fs-4"></i>
                </div>
                <h2 class="fw-bold text-dark mb-2">Edit Subkriteria</h2>
                <p class="text-muted mb-0">Perbarui informasi subkriteria dengan mudah</p>
            </div>

            <!-- Main Form Card -->
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-body p-5">
                    <form action="{{ route('subcriterias.update', ['criteria' => $criteria->id, 'subcriteria' => $subcriteria->id]) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

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
                                       value="{{ old('name', $subcriteria->name) }}" 
                                       placeholder="Masukkan nama subkriteria"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                                       value="{{ old('range', $subcriteria->range) }}" 
                                       placeholder="Contoh: 1-10, A-E, dll"
                                       required>
                                @error('range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Masukkan rentang nilai yang sesuai untuk subkriteria ini
                            </div>
                        </div>

                        <!-- Skor Field -->
                        <div class="mb-4">
                            <label for="score" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-star text-warning me-2"></i>Skor
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-calculator text-muted"></i>
                                </span>
                                <input type="number" name="score" id="score" 
                                       class="form-control border-start-0 ps-0 @error('score') is-invalid @enderror" 
                                       value="{{ old('score', $subcriteria->score) }}" 
                                       placeholder="Masukkan skor numerik"
                                       min="0" step="0.01"
                                       required>
                                @error('score')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">
                                <i class="fas fa-lightbulb me-1"></i>
                                Skor akan digunakan dalam perhitungan evaluasi
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
                                <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold shadow-sm">
                                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card border-0 bg-light mt-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-info fs-4"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-semibold text-dark mb-2">Tips Pengisian</h6>
                            <ul class="list-unstyled text-muted mb-0 small">
                                <li class="mb-1">• Pastikan nama subkriteria jelas dan deskriptif</li>
                                <li class="mb-1">• Rentang nilai harus konsisten dengan kriteria utama</li>
                                <li class="mb-1">• Skor akan mempengaruhi bobot dalam perhitungan akhir</li>
                                <li>• Semua field wajib diisi untuk melanjutkan</li>
                            </ul>
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
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .input-group-text {
        transition: all 0.3s ease;
    }
    
    .form-control:focus + .input-group-text,
    .input-group-text:has(+ .form-control:focus) {
        border-color: #667eea;
        background-color: rgba(102, 126, 234, 0.1);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
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
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Auto-focus first input
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('name').focus();
    });
</script>
@endpush
@endsection