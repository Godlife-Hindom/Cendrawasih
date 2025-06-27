@extends('layouts.user-app')

@section('content')
{{-- Toast Notification --}}
@if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3" id="toast-container">
        <div class="toast align-items-center text-white bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
            <div class="d-flex">
                <div class="toast-body fw-semibold">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

{{-- Hero Section --}}
<div class="hero-section position-relative overflow-hidden mb-5">
    <div class="hero-bg position-absolute w-100 h-100" 
         style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                opacity: 0.1; 
                border-radius: 20px;"></div>
    
    <div class="container position-relative py-5">
        <div class="text-center text-white">
            <div class="hero-icon mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-15 rounded-circle p-4 backdrop-blur">
                    <i class="bi bi-geo-alt-fill fs-1 text-primary"></i>
                </div>
            </div>
            
            <h1 class="display-5 fw-bold text-primary mb-3 animate__animated animate__fadeInUp">
                Sistem Pendukung Keputusan
            </h1>
            <h3 class="text-secondary fw-semibold mb-3 animate__animated animate__fadeInUp animate__delay-1s">
                Penentuan Lokasi Penangkaran Burung Cenderawasih
            </h3>
            <div class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill fs-6 animate__animated animate__fadeInUp animate__delay-2s">
                <i class="bi bi-cpu-fill me-2"></i>Metode ARAS & GIS
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions Cards --}}
<div class="container">
    <div class="row mb-5 g-4">
        <div class="col-lg-4 col-md-6" >
            <div class="card action-card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center p-4">
                    <div class="action-icon mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-plus-circle-fill fs-2 text-success"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Tambah Lokasi</h5>
                    <p class="text-muted mb-4">Input data alternatif lokasi penangkaran baru</p>
                    <a href="{{ route('user.alternatives.create') }}" 
                       class="btn btn-success btn-lg w-100 rounded-pill shadow-sm">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Alternatif
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="card action-card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center p-4">
                    <div class="action-icon mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-list-ul fs-2 text-primary"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Kelola Lokasi</h5>
                    <p class="text-muted mb-4">Lihat dan edit data lokasi yang telah diinput</p>
                    <a href="{{ route('user.alternatives.index') }}" 
                       class="btn btn-outline-primary btn-lg w-100 rounded-pill">
                        <i class="bi bi-eye me-2"></i>Lihat Data
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="card action-card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center p-4">
                    <div class="action-icon mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="bi bi-map-fill fs-2 text-info"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Visualisasi Peta</h5>
                    <p class="text-muted mb-4">Lihat peta rekomendasi lokasi terbaik</p>
                    <a href="{{ route('user.view-map') }}" 
                       class="btn btn-outline-info btn-lg w-100 rounded-pill">
                        <i class="bi bi-geo-alt me-2"></i>Buka Peta
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row mb-5 g-4">
        <div class="col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-4">
                            <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-geo-alt-fill fs-3 text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-secondary text-uppercase fw-semibold mb-1 small">Total Alternatif</h6>
                            <h2 class="text-primary fw-bold mb-1">{{ $alternativesCount }}</h2>
                            <p class="text-muted mb-0 small">Lokasi yang dianalisis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-4">
                            <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-list-check fs-3 text-success"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-secondary text-uppercase fw-semibold mb-1 small">Total Kriteria</h6>
                            <h2 class="text-success fw-bold mb-1">{{ $criteriaCount }}</h2>
                            <p class="text-muted mb-0 small">Vegetasi, Air, Topografi, Iklim</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 offset-md-4">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon me-4">
                            <div class="d-flex align-items-center justify-content-center bg-danger bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-list-check fs-3 text-danger"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-secondary text-uppercase fw-semibold mb-1 small">Total Subkriteria</h6>
                            <h2 class="text-danger fw-bold mb-1">{{ $subcriteriaCount }}</h2>
                            <p class="text-muted mb-0 small">Subkriteria Pada Sistem</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Calculation Section --}}
    <div class="card calculation-card border-0 shadow-lg mb-5">
        <div class="card-body p-5 text-center">
            <div class="calculation-icon mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-circle p-4">
                    <i class="bi bi-cpu-fill fs-1 text-warning"></i>
                </div>
            </div>
            
            <h4 class="fw-bold text-dark mb-3">
                <i class="bi bi-lightbulb-fill text-warning me-2"></i>
                Siap Melakukan Analisis?
            </h4>
            <p class="text-muted mb-4 fs-6">
                Pastikan semua data alternatif lokasi sudah lengkap, kemudian klik tombol di bawah untuk memulai perhitungan menggunakan metode ARAS
            </p>
            
            <form action="{{ route('user.calculate.aras') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-warning btn-lg px-5 py-3 rounded-pill shadow-sm fw-semibold">
                    <i class="bi bi-play-fill me-2"></i>Hasil ARAS
                </button>
            </form>
        </div>
    </div>

    {{-- Results Section --}}
    @if (!empty($result))
    <div class="card results-card border-0 shadow-lg">
        <div class="card-header bg-gradient-success text-black p-4 border-0">
            <div class="d-flex align-items-center">
                <div class="result-icon me-3">
                    <i class="bi bi-trophy-fill fs-4"></i>
                </div>
                <div>
                    <h5 class="mb-1 fw-bold">Hasil Analisis ARAS</h5>
                    <small class="opacity-75">Rekomendasi lokasi terbaik untuk penangkaran</small>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 fw-semibold">
                                <i class="bi bi-geo-alt-fill text-primary me-2"></i>Nama Lokasi
                            </th>
                            <th class="border-0 fw-semibold text-center">
                                <i class="bi bi-graph-up text-success me-2"></i>Skor
                            </th>
                            <th class="border-0 fw-semibold text-center">
                                <i class="bi bi-award text-warning me-2"></i>Peringkat
                            </th>
                            <th class="border-0 fw-semibold text-center">
                                <i class="bi bi-bookmark-star-fill text-info me-2"></i>Kategori
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $index => $row)
                            <tr class="result-row">
                                <td class="fw-semibold">
                                    <div class="d-flex align-items-center">
                                        <div class="location-icon me-3">
                                            <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 40px; height: 40px;">
                                                <i class="bi bi-geo-alt-fill text-primary"></i>
                                            </div>
                                        </div>
                                        {{ $row['name'] }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark fs-6 px-3 py-2">
                                        {{ number_format($row['Ki'], 4) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @php $rank = $row['peringkat'] ?? $index + 1; @endphp
                                    <span class="badge {{ $rank == 1 ? 'bg-warning' : ($rank == 2 ? 'bg-light text-dark' : 'bg-secondary') }} fs-6 px-3 py-2">
                                        #{{ $rank }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @php
                                        if ($row['Ki'] >= 0.8) {
                                            $category = 'Sangat Baik';
                                            $badge = 'success';
                                            $icon = 'star-fill';
                                        } elseif ($row['Ki'] >= 0.6) {
                                            $category = 'Baik';
                                            $badge = 'primary';
                                            $icon = 'star-half';
                                        } elseif ($row['Ki'] >= 0.4) {
                                            $category = 'Cukup';
                                            $badge = 'warning';
                                            $icon = 'star';
                                        } elseif ($row['Ki'] >= 0.2) {
                                            $category = 'Kurang';
                                            $badge = 'danger';
                                            $icon = 'x-circle';
                                        } else {
                                            $category = 'Buruk';
                                            $badge = 'dark';
                                            $icon = 'x-octagon';
                                        }

                                    @endphp
                                    <span class="badge bg-{{ $badge }} fs-6 px-3 py-2">
                                        <i class="bi bi-{{ $icon }} me-1"></i>{{ $category }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex flex-wrap gap-3 justify-content-center mt-4 pt-4 border-top">
                <a href="{{ route('user.view-map') }}" 
                   class="btn btn-outline-success btn-lg rounded-pill px-4">
                    <i class="bi bi-map me-2"></i>Lihat di Peta
                </a>

                <form action="{{ route('user.laporan.kirim') }}" method="POST" class="d-inline">
                    @csrf
                    @foreach ($result as $index => $hasil)
                        <input type="hidden" name="name[]" value="{{ $hasil['name'] }}">
                        <input type="hidden" name="score[]" value="{{ $hasil['Ki'] }}">
                        <input type="hidden" name="peringkat[]" value="{{ $hasil['peringkat'] ?? $index + 1 }}">
                    @endforeach
                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-4">
                        <i class="bi bi-send-fill me-2"></i>Kirim Laporan
                    </button>
                </form>
                {{-- Tombol Feedback SUS --}}
                @php
                    $hasFilled = \App\Models\Feedback::where('user_id', Auth::id())->exists();
                @endphp

                @if (!$hasFilled)
                    <a href="{{ route('user.feedback.form') }}" 
                    class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="bi bi-chat-left-dots-fill me-2"></i>Feedback SUS
                    </a>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
@if(session('success'))
    <div class="toast-container">
        <div class="toast align-items-center text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #f8f9fa 0%, rgba(0, 0, 0, 0.075) 100%);;
        border-radius: 20px;
        margin-bottom: 2rem;
    }

    .backdrop-blur {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }

    .action-card {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    .stat-card {
        border-radius: 15px;
        border-left: 4px solid var(--bs-primary);
    }

    .calculation-card {
        border-radius: 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .results-card {
        border-radius: 20px;
        overflow: hidden;
    }

    .result-row {
        transition: all 0.2s ease;
    }

    .result-row:hover {
        background-color: rgba(0,123,255,0.05);
        transform: scale(1.01);
    }

    .bg-gradient-success {
        background: linear-gradient(45deg, #28a745, #20c997);
    }

    .animate__animated {
        animation-duration: 1s;
        animation-fill-mode: both;
    }

    .animate__fadeInUp {
        animation-name: fadeInUp;
    }

    .animate__delay-1s {
        animation-delay: 0.5s;
    }

    .animate__delay-2s {
        animation-delay: 1s;
    }

    /* Custom Toast Style */
.toast-container {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 1080;
}

.toast {
    opacity: 0;
    transform: translateX(100%);
    transition: transform 0.5s ease, opacity 0.3s ease;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
}
.toast.showing, .toast.show {
    opacity: 1;
    transform: translateX(0);
}

    

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 40px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            margin: 0 15px 2rem 15px;
        }
        
        .display-5 {
            font-size: 2rem;
        }
        
        .btn-lg {
            padding: 0.75rem 2rem;
        }
    }
</style>
@endpush

@push('scripts')
    <script>
        // Enhanced Toast Animation
        @if(session('success'))
        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.querySelector('.toast');
            if (toastElement) {
                const toast = new bootstrap.Toast(toastElement, {
                    autohide: true,
                    delay: 4000
                });

                // Mulai dalam posisi tersembunyi di kanan
                toastElement.style.transform = 'translateX(100%)';
                toastElement.style.opacity = '0';
                toastElement.style.transition = 'transform 0.5s ease-out, opacity 0.3s ease-in';

                // Tampilkan toast
                toast.show();

                // Jalankan animasi masuk setelah sedikit delay
                setTimeout(() => {
                    toastElement.style.transform = 'translateX(0)';
                    toastElement.style.opacity = '1';
                }, 100);
            }
        });
        @endif


        // Add smooth scrolling for anchor links
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

        // Add loading state for calculation button
        document.querySelector('form[action*="calculate.aras"] button').addEventListener('click', function() {
            this.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';
            this.disabled = true;
        });
    </script>
@endpush
