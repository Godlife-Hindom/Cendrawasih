@extends('layouts.pimpinan')

@section('content')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .card-hover {
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .stats-card {
        background: rgba(255,255,255,0.05);
        border: none;
        color: black;
    }
    
    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background: rgba(0,0,0,0.11);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    .progress-modern {
        height: 8px;
        border-radius: 10px;
        background: linear-gradient(90deg, #e3f2fd 0%, #f3e5f5 100%);
        overflow: hidden;
        position: relative;
    }
    
    .progress-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .table-modern {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        background: white;
    }
    
    .table-modern thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .table-modern tbody tr {
        transition: all 0.3s ease;
        border: none;
    }
    
    .table-modern tbody tr:hover {
        background: linear-gradient(90deg, #f8f9ff 0%, #fff5f8 100%);
        transform: scale(1.01);
    }
    
    .badge-modern {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.75rem;
    }
    
    .btn-floating {
        border-radius: 50px;
        padding: 12px 24px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .btn-floating:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }
    
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #a7f3d0 100%);
        color: white;
        border-radius: 20px;
        padding: 3rem 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .filter-card {
        background: rgba(255,255,255,0.05);
        border: none;
        border-radius: 20px;
        color: black;
    }
    
    .select-modern {
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 15px;
        background: rgba(0,0,0,0.11);
        backdrop-filter: blur(10px);
        color: black;
        padding: 12px 20px;
    }
    
    .select-modern:focus {
        border-color: rgba(255,255,255,0.8);
        background: rgba(255,255,255,0.2);
        box-shadow: 0 0 20px rgba(255,255,255,0.3);
    }
    
    .select-modern option {
        background: #333;
        color: black;
    }
    
    .ranking-badge {
        position: absolute;
        top: -10px;
        left: -10px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
        font-size: 1.2rem;
    }
    
    .rank-1 { background: linear-gradient(45deg, #FFD700, #FFA500); }
    .rank-2 { background: linear-gradient(45deg, #C0C0C0, #A9A9A9); }
    .rank-3 { background: linear-gradient(45deg, #CD7F32, #8B4513); }
    .rank-4, .rank-5 { background: linear-gradient(45deg, #4facfe, #00f2fe); }
    
    .location-card {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        margin-bottom: 1rem;
    }
    
    .floating-elements {
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        animation: float 6s ease-in-out infinite;
    }
    
    .floating-elements:nth-child(1) {
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .floating-elements:nth-child(2) {
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }
    
    .floating-elements:nth-child(3) {
        bottom: 20%;
        left: 50%;
        animation-delay: 4s;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
</style>

<div class="container-fluid py-4">
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
    <div class="hero-section position-relative">
        <div class="floating-elements"></div>
        <div class="floating-elements"></div>
        <div class="floating-elements"></div>
        
        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="bi bi-speedometer2 me-3"></i>
                    Dashboard <span class="text-warning">Pimpinan</span>
                </h1>
                <p class="lead mb-0 opacity-90">
                    Sistem Pendukung Keputusan Penangkaran Cendrawasih - Monitoring & Evaluasi Real-time
                </p>
            </div>
            <div class="col-lg-4 text-end">
                <div class="icon-circle mx-auto pulse-animation">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row mb-4 g-3">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-geo-alt-fill fs-4 text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted mb-1 fw-semibold">Total Alternatif</h6>
                                    <h3 class="mb-0 fw-bold text-primary">{{ $alternativesCount }}</h3>
                                    <small class="text-muted">Lokasi tersedia</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-sliders2-vertical fs-4 text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted mb-1 fw-semibold">Total Kriteria</h6>
                                    <h3 class="mb-0 fw-bold text-success">{{ $criteriaCount }}</h3>
                                    <small class="text-muted">Parameter analisis</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-trophy-fill fs-4 text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted mb-1 fw-semibold">Top Ranking</h6>
                                    <h3 class="mb-0 fw-bold text-warning">{{ count($topAlternatives) }}</h3>
                                    <small class="text-muted">Lokasi terbaik</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 card-hover">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-people-fill fs-4 text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted mb-1 fw-semibold">Total Pengguna</h6>
                                    <h3 class="mb-0 fw-bold text-info">{{ count($users) }}</h3>
                                    <small class="text-muted">Pengguna aktif</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="card filter-card card-hover mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('pimpinan.filter', 0) }}" onsubmit="this.action = this.action.replace(0, this.user_id.value)">
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <label for="user_id" class="form-label fw-semibold mb-3">
                            <i class="bi bi-funnel-fill me-2"></i>
                            Filter Berdasarkan Pengguna BKSDA
                        </label>
                        <select name="user_id" id="user_id" class="form-select select-modern" onchange="this.form.submit()">
                            <option value="">🌟 Tampilkan Semua Pengguna</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                                    👤 {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="icon-circle">
                            <i class="bi bi-search"></i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Top 5 Locations --}}
    <div class="card table-modern card-hover mb-5">
        <div class="card-header text-center py-4">
            <h3 class="mb-0 fw-bold">
                <i class="bi bi-trophy-fill me-2 text-warning"></i>
                Top 5 Lokasi Terbaik Penangkaran Cendrawasih
            </h3>
            <small class="opacity-75">Berdasarkan Metode ARAS (Additive Ratio Assessment)</small>
        </div>
        <div class="card-body p-0">
                 @if (count($topAlternatives) > 0)
                        @foreach ($topAlternatives as $index => $alt)
                        @php
                        $rank = $index + 1; // Mulai dari 1, bukan 0
                        $rankClass = 'rank-' . min($rank, 5); // Misalnya: rank-1, rank-2, ..., rank-5

                        $score = $alt->score;
                        $percent = round($score * 100, 1);

                        // Kategori & Badge
                        if ($score >= 0.8) {
                            $cat = 'Sangat Baik';
                            $badge = 'success';
                        } elseif ($score >= 0.6) {
                            $cat = 'Baik';
                            $badge = 'primary';
                        } elseif ($score >= 0.4) {
                            $cat = 'Cukup';
                            $badge = 'warning';
                        } elseif ($score >= 0.2) {
                            $cat = 'Kurang';
                            $badge = 'danger';
                        } else {
                            $cat = 'Buruk';
                            $badge = 'dark';
                        }

                        // Icon & Warna berdasarkan peringkat
                        $icon = match($index) {
                            0 => 'trophy-fill',
                            1 => 'award-fill',
                            default => 'star-fill',
                        };

                        $iconColor = match($index) {
                            0 => 'text-warning',
                            1 => 'text-secondary',
                            default => 'text-info',
                        };
                    @endphp

                    <div class="location-card card-hover m-3 p-4 border rounded-3 position-relative">
                        <div class="ranking-badge {{ $rankClass }}">{{ $rank }}</div>
                        
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h5 class="fw-bold text-primary mb-1">
                                    <i class="bi bi-geo-alt-fill me-2"></i>
                                    {{ $alt->name }}
                                </h5>
                                <small class="text-muted">
                                    <i class="bi bi-person-badge-fill me-1"></i>
                                    {{ $alt->user->name ?? 'Unknown User' }}
                                </small>
                            </div>
                            
                            <div class="col-md-2 text-center">
                                <div class="badge-modern bg-{{ $badge }} text-white">
                                    {{ $cat }}
                                </div>
                            </div>
                            
                            <div class="col-md-2 text-center">
                                <h4 class="fw-bold text-dark mb-0">{{ number_format($alt->score, 4) }}</h4>
                                <small class="text-muted">Skor ARAS</small>
                            </div>
                            
                            <div class="col-md-5">
                                <div class="d-flex align-items-center">
                                    <div class="progress progress-modern flex-grow-1 me-3" style="height: 12px;">
                                        <div class="progress-bar bg-{{ $badge }}" role="progressbar"
                                            style="width: {{$percent }}%" aria-valuenow="{{ $percent }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <span class="fw-bold text-{{ $badge }}">{{ $percent }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <div class="icon-circle mx-auto mb-3 bg-light text-muted">
                        <i class="bi bi-inbox"></i>
                    </div>
                    <h5 class="text-muted">Tidak Ada Data Tersedia</h5>
                    <p class="text-muted">Silakan pilih pengguna atau tambahkan data alternatif baru.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Action Buttons --}}
    @if ($selectedUserId)
        <div class="row mt-3">
            <div class="col-md-6 offset-md-6 d-flex gap-2">
                <a href="{{ route('pimpinan.peta', ['user_id' => $selectedUserId]) }}" class="btn btn-success btn-lg flex-fill">
                    <i class="bi bi-map me-2"></i>Lihat Peta
                </a>
            </div>

             {{-- Tombol Feedback SUS --}}
             @php
                    $hasFilled = \App\Models\Feedback::where('user_id', Auth::id())->exists();
                @endphp

                @if (!$hasFilled)
                    <a href="{{ route('pimpinan.feedback') }}" 
                    class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="bi bi-chat-left-dots-fill me-2"></i>Feedback SUS
                    </a>
                @endif
        </div>
    @endif


    {{-- Stats Footer --}}
    <div class="row mt-5 pt-4 border-top">
        <div class="col-md-4 text-center">
            <h3 class="text-primary fw-bold">{{ count($topAlternatives) }}</h3>
            <p class="text-muted mb-0">Lokasi Dianalisis</p>
        </div>
        <div class="col-md-4 text-center">
            <h3 class="text-success fw-bold">{{ count($users) }}</h3>
            <p class="text-muted mb-0">User BKSDA</p>
        </div>
        <div class="col-md-4 text-center">
            <h3 class="text-warning fw-bold">ARAS</h3>
            <p class="text-muted mb-0">Metode Perhitungan</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Add loading animation for form submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('select');
            if (submitBtn) {
                submitBtn.style.opacity = '0.7';
                submitBtn.style.pointerEvents = 'none';
            }
        });
    }
    
    // Add intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all cards
    document.querySelectorAll('.card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });
});
</script>
@endsection