@extends('layouts.admin-app')

@section('content')
<div class="container-fluid py-4">
    {{-- Toast Notification - Perbaikan --}}
@if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;" id="toast-container">
        <div class="toast align-items-center text-white bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
            <div class="d-flex">
                <div class="toast-body fw-semibold">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
    {{-- Header Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-primary text-white overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #a7f3d0 100%)">
                <div class="card-body p-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="bi bi-graph-up-arrow me-3"></i>Selamat Datang, {{ Auth::user()->name }}
                            </h1>
                            <p class="welcome-subtitle">
                                <i class="fas fa-calendar-alt me-2"></i>
                                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} | Dashboard Admin
                            </p>
                            <h4 class="fw-light mb-3 opacity-90">Penangkaran Cendrawasih Kabupaten Fakfak</h4>
                            <p class="mb-0 opacity-75">Sistem Pendukung Keputusan berbasis Metode ARAS & Visualisasi GIS</p>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block">
                            <i class="bi bi-geo-alt display-1 opacity-25"></i>
                        </div>
                    </div>
                    <div class="position-absolute top-0 end-0 p-3">
                        <div class="bg-white bg-opacity-20 rounded-circle p-2">
                            <i class="bi bi-award display-6"></i>
                        </div>
                    </div>
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
                                <i class="bi bi-funnel fs-4 text-success"></i>
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
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-sliders2-vertical fs-4 text-danger"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted mb-1 fw-semibold">Total Subkriteria</h6>
                                    <h3 class="mb-0 fw-bold text-danger">{{ $subcriteriaCount }}</h3>
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
                            <div class="bg-black bg-opacity-10 rounded-circle p-3">
                                <i class="bi bi-receipt fs-4 text-purple"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted mb-1 fw-semibold">Total Laporan</h6>
                                    <h3 class="mb-0 fw-bold text-purple-light">{{ $laporanCount }}</h3>
                                    <small class="text-muted">Laporan User</small>
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
                                <i class="bi bi-send-fill fs-4 text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted mb-1 fw-semibold">Total Report</h6>
                                    <h3 class="mb-0 fw-bold text-warning">{{ $reportCount }}</h3>
                                    <small class="text-muted">Kirim Laporan User</small>
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

    

    {{-- Quick Access Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-lightning-charge-fill text-warning"></i>
                        </div>
                        <h5 class="mb-0 fw-semibold">Akses Cepat</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('criteria.index') }}" class="btn btn-outline-primary w-100 py-3 rounded-3 btn-hover">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="bi bi-sliders2-vertical fs-4 me-3"></i>
                                    <div class="text-start">
                                        <div class="fw-semibold">Kelola Kriteria</div>
                                        <small class="text-muted">Atur parameter penilaian</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('alternatives.index') }}" class="btn btn-outline-success w-100 py-3 rounded-3 btn-hover">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="bi bi-geo-alt-fill fs-4 me-3"></i>
                                    <div class="text-start">
                                        <div class="fw-semibold">Lihat Alternatif</div>
                                        <small class="text-muted">Data lokasi penangkaran</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-funnel-fill text-info"></i>
                        </div>
                        <h5 class="mb-0 fw-semibold">Filter Data</h5>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Form GET untuk filter user -->
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-6">
                                <label for="user_id" class="form-label fw-semibold">
                                    <i class="bi bi-person-fill me-1"></i>Pilih Pengguna
                                </label>
                                <select name="user_id" id="user_id" class="form-select form-select-lg" onchange="this.form.submit()">
                                    <option value="">🔍 Semua Pengguna</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                                            👤 {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>

                    <!-- Form POST untuk kirim laporan -->
                    @if ($selectedUserId)
                        <div class="row mt-3">
                            <div class="col-md-6 offset-md-6 d-flex gap-2">
                                <a href="{{ route('map.show', ['user_id' => $selectedUserId]) }}" class="btn btn-success btn-lg flex-fill">
                                    <i class="bi bi-map me-2"></i>Lihat Peta
                                </a>

                                <button onclick="confirmSendReport({{ $selectedUserId }})" class="btn btn-primary btn-lg flex-fill">
                                    <i class="bi bi-send-check-fill me-2"></i>Kirim Laporan
                                </button>

                                @php
                                    $hasFilled = \App\Models\Feedback::where('user_id', Auth::id())->exists();
                                @endphp

                                @if (!$hasFilled)
                                    <a href="{{ route('feedback.form') }}" 
                                    class="btn btn-danger btn-lg rounded-pill px-4">
                                        <i class="bi bi-chat-left-dots-fill me-2"></i>Feedback SUS
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="row">
        {{-- Top 5 Locations --}}
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header border-0 py-3" style="background: linear-gradient(135deg, #667eea 0%, #a7f3d0 100%);">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-50 rounded-circle p-2 me-3">
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <h5 class="mb-0 fw-semibold text-dark">Top 5 Lokasi Terbaik</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if (count($topAlternatives) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 py-3 ps-4">
                                            <i class="bi bi-hash text-muted me-2"></i>Ranking
                                        </th>
                                        <th class="border-0 py-3">
                                            <i class="bi bi-geo-alt-fill text-muted me-2"></i>Lokasi
                                        </th>
                                        <th class="border-0 py-3">
                                            <i class="bi bi-graph-up text-muted me-2"></i>Skor
                                        </th>
                                        <th class="border-0 py-3">
                                            <i class="bi bi-award text-muted me-2"></i>Kategori
                                        </th>
                                        <th class="border-0 py-3" style="width: 35%">
                                            <i class="bi bi-bar-chart-fill text-muted me-2"></i>Visualisasi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topAlternatives as $index => $alt)
                                        @php
                                            if ($alt['score'] >= 0.8) {
                                                $cat = 'Sangat Baik';
                                                $badge = 'success';
                                            } elseif ($alt['score'] >= 0.6) {
                                                $cat = 'Baik';
                                                $badge = 'primary';
                                            } elseif ($alt['score'] >= 0.4) {
                                                $cat = 'Cukup';
                                                $badge = 'warning';
                                            } elseif ($alt['score'] >= 0.2) {
                                                $cat = 'Kurang';
                                                $badge = 'danger';
                                            } else {
                                                $cat = 'Buruk';
                                                $badge = 'dark';
                                            }

                                            $percent = round($alt['score'] * 100, 1);

                                            $icon = $index == 0 ? 'trophy-fill' : ($index == 1 ? 'award-fill' : 'star-fill');
                                            $iconColor = $index == 0 ? 'text-warning' : ($index == 1 ? 'text-secondary' : 'text-info');

                                        @endphp
                                        <tr class="table-row-hover">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-{{ $icon }} {{ $iconColor }} me-2"></i>
                                                    <span class="fw-bold fs-5">#{{ $index + 1 }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark">{{ $alt['name'] }}</div>
                                                <small class="text-muted">Alternatif lokasi</small>
                                            </td>
                                            <td>
                                                <div class="fw-bold fs-6 text-primary">{{ number_format($alt['score'], 4) }}</div>
                                                <small class="text-muted">Nilai ARAS</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $badge }} bg-opacity-10 text-{{ $badge }} px-3 py-2 rounded-pill">
                                                    <i class="bi bi-check-circle-fill me-1"></i>{{ $cat }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1 me-3" style="height: 8px;">
                                                        <div class="progress-bar bg-{{ $badge }} progress-bar-animated" 
                                                             role="progressbar" style="width: {{ $percent }}%" 
                                                             aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <small class="fw-semibold text-{{ $badge }}">{{ $percent }}%</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-inbox display-1 text-muted opacity-50"></i>
                            <h5 class="text-muted mt-3">Tidak ada data tersedia</h5>
                            <p class="text-muted">Silakan pilih pengguna untuk melihat hasil analisis</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Chart Section --}}
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header border-0 py-3 bg-light">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">  
                            <i class="bi bi-bar-chart-fill text-primary"></i>
                        </div>
                        <h5 class="mb-0 fw-semibold">Grafik Skor</h5>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($topAlternatives) > 0)
                        <canvas id="scoreChart" height="300"></canvas>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-graph-up display-4 text-muted opacity-50"></i>
                            <p class="text-muted mt-3 mb-0">Grafik akan muncul setelah data tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- System Info --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #a7f3d0 100%);">
                <div class="card-body p-4 text-white">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3">
                                    <i class="bi bi-info-circle-fill fs-4"></i>
                                </div>
                                <h5 class="mb-0 fw-semibold">Tentang Sistem</h5>
                            </div>
                            <p class="mb-0 opacity-90 fs-6">
                                Sistem Pendukung Keputusan ini dirancang khusus untuk membantu dalam menentukan lokasi optimal 
                                penangkaran burung Cendrawasih di Kabupaten Fakfak. Menggunakan <strong>Metode ARAS (Additive Ratio Assessment)</strong> 
                                yang terintegrasi dengan teknologi <strong>Geographic Information System (GIS)</strong> untuk memberikan 
                                rekomendasi lokasi terbaik berdasarkan analisis multi-kriteria yang komprehensif.
                            </p>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block">
                            <i class="bi bi-gear-wide-connected display-1 opacity-20"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom Styles --}}
<style>
.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}

.btn-hover {
    transition: all 0.3s ease;
}

.btn-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 .25rem .5rem rgba(0,0,0,.1);
}

.table-row-hover:hover {
    background-color: rgba(13,110,253,.05);
}

.progress-bar-animated {
    animation: progress-bar-stripes 1s linear infinite;
}

@keyframes progress-bar-stripes {
    0% { background-position: 0 0; }
    100% { background-position: 40px 0; }
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #a7f3d0 100%);
}
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Enhanced Toast Animation
    @if(session('success'))
        const toastElement = document.getElementById('successToast');
        if (toastElement) {
            // Inisialisasi Bootstrap Toast
            const toast = new bootstrap.Toast(toastElement, {
                autohide: true,
                delay: 4000
            });

            // Set initial state
            toastElement.style.transform = 'translateX(100%)';
            toastElement.style.opacity = '0';
            toastElement.style.transition = 'transform 0.5s ease-out, opacity 0.3s ease-in';

            // Show toast immediately
            toast.show();

            // Animate in after short delay
            setTimeout(() => {
                toastElement.style.transform = 'translateX(0)';
                toastElement.style.opacity = '1';
            }, 100);

            // Optional: Add slide out animation when hiding
            toastElement.addEventListener('hidden.bs.toast', function () {
                toastElement.style.transform = 'translateX(100%)';
                toastElement.style.opacity = '0';
            });
        }
    @endif
    // Chart Configuration
    @if (count($topAlternatives) > 0)
    const ctx = document.getElementById('scoreChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(54, 162, 235, 0.5)');
    gradient.addColorStop(1, 'rgba(54, 162, 235, 0.2)');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json(array_column($topAlternatives, 'name')),
            datasets: [{
                label: 'Skor Alternatif',
                data: @json(array_column($topAlternatives, 'score')),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 2,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed.toFixed(4);
                        }
                    }
                }
            },
            cutout: '60%'
        }
    });
    @endif

    // Confirm Send Report Function
    function confirmSendReport(userId) {
    Swal.fire({
        title: 'Kirim Laporan Hasil?',
        text: "Laporan hasil analisis akan dikirim kepada pimpinan. Pastikan data sudah benar!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="bi bi-send-check-fill me-2"></i>Ya, Kirim Laporan!',
        cancelButtonText: '<i class="bi bi-x-circle me-2"></i>Batal',
        reverseButtons: true,
        customClass: {
            confirmButton: 'btn btn-primary btn-lg',
            cancelButton: 'btn btn-secondary btn-lg'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form dinamis
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("dashboard.sendReport") }}';

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            const userInput = document.createElement('input');
            userInput.type = 'hidden';
            userInput.name = 'user_id';
            userInput.value = userId;
            form.appendChild(userInput);

            document.body.appendChild(form);
            form.submit();
        }
    });
}

    // Page Loading Animation
    document.addEventListener('DOMContentLoaded', function() {
        // Animate cards entrance
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endpush
