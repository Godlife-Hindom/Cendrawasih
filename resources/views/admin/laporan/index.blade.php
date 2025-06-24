@extends('layouts.admin-app')

@section('content')
<div class="container-fluid py-4">
    {{-- Header Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #a7f3d0 100%);">
                <div class="card-body p-3 p-md-4 text-white position-relative">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-8">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-white bg-opacity-20 rounded-circle p-2 p-md-3 me-3">
                                    <i class="bi bi-people-fill fs-5 fs-md-4"></i>
                                </div>
                                <div>
                                    <h1 class="h4 h-md-3 fw-bold mb-1">
                                        <i class="bi bi-file-earmark-text me-2"></i>
                                        <span class="d-block d-sm-inline">Kelola Laporan Pengguna</span>
                                    </h1>
                                    <p class="mb-0 opacity-90 small">Daftar pengguna dan laporan analisis SPK mereka</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block">
                            <div class="bg-white bg-opacity-10 rounded-3 p-3 d-inline-block">
                                <i class="bi bi-graph-up-arrow display-5 opacity-75"></i>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute top-0 end-0 p-3 p-md-4">
                        <div class="bg-warning bg-opacity-20 rounded-circle p-1 p-md-2">
                            <i class="bi bi-award fs-4 fs-md-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    {{-- Search & Filter Bar --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 p-md-4">
                    <form method="GET" action="{{ route('admin.laporan.index') }}" class="row g-3 align-items-end">
                        <div class="col-12 col-md-8">
                            <label class="form-label fw-semibold">Cari Pengguna</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       class="form-control border-start-0 ps-0" 
                                       placeholder="Cari berdasarkan nama pengguna...">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="bi bi-funnel me-2"></i>Filter
                                </button>
                                <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="row mb-4 g-3">
        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 p-md-3">
                                <i class="bi bi-people-fill fs-5 fs-md-4 text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-2 ms-md-3">
                            <h6 class="text-muted mb-1 fw-semibold small d-none d-sm-block">Total Pengguna</h6>
                            <h6 class="text-muted mb-1 fw-semibold small d-sm-none">Total</h6>
                            <h3 class="mb-0 fw-bold text-primary fs-4 fs-md-3">{{ $allUsers->count() }}</h3>
                            <small class="text-muted d-none d-lg-block">Pengguna terdaftar</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2 p-md-3">
                                <i class="bi bi-file-earmark-check-fill fs-5 fs-md-4 text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-2 ms-md-3">
                            <h6 class="text-muted mb-1 fw-semibold small d-none d-sm-block">Dengan Laporan</h6>
                            <h6 class="text-muted mb-1 fw-semibold small d-sm-none">Ada</h6>
                            <h3 class="mb-0 fw-bold text-success fs-4 fs-md-3">{{ $allUsers->filter(function($user) {return optional($user->laporans)->count() > 0; })->count() }}</h3>
                            <small class="text-muted d-none d-lg-block">Sudah ada laporan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 p-md-3">
                                <i class="bi bi-clock-fill fs-5 fs-md-4 text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-2 ms-md-3">
                            <h6 class="text-muted mb-1 fw-semibold small d-none d-sm-block">Belum Laporan</h6>
                            <h6 class="text-muted mb-1 fw-semibold small d-sm-none">Belum</h6>
                            <h3 class="mb-0 fw-bold text-warning fs-4 fs-md-3">{{ $allUsers->filter(function($user) { return optional($user->laporans)->count() == 0; })->count() }}</h3>
                            <small class="text-muted d-none d-lg-block">Belum ada laporan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-circle p-2 p-md-3">
                                <i class="bi bi-calendar-event fs-5 fs-md-4 text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-2 ms-md-3">
                            <h6 class="text-muted mb-1 fw-semibold small d-none d-sm-block">Update Terakhir</h6>
                            <h6 class="text-muted mb-1 fw-semibold small d-sm-none">Update</h6>
                            <h3 class="mb-0 fw-bold text-info fs-4 fs-md-3">{{ now()->format('d/m') }}</h3>
                            <small class="text-muted d-none d-lg-block">{{ now()->format('Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- User List --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                @if (isset($allUsers) && $allUsers->count() > 0)
                    {{-- Desktop View --}}
                    <div class="table-responsive d-none d-lg-block">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 py-3 ps-4" style="width: 80px;">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-hash text-muted me-2"></i>
                                            <span class="fw-semibold">No</span>
                                        </div>
                                    </th>
                                    <th class="border-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-fill text-muted me-2"></i>
                                            <span class="fw-semibold">Nama Pengguna</span>
                                        </div>
                                    </th>
                                    <th class="border-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-envelope-fill text-muted me-2"></i>
                                            <span class="fw-semibold">Email</span>
                                        </div>
                                    </th>
                                    <th class="border-0 py-3 text-center" style="width: 150px;">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="bi bi-file-earmark-text text-muted me-2"></i>
                                            <span class="fw-semibold">Jumlah Laporan</span>
                                        </div>
                                    </th>
                                    <th class="border-0 py-3" style="width: 120px;">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar3 text-muted me-2"></i>
                                            <span class="fw-semibold">Bergabung</span>
                                        </div>
                                    </th>
                                    <th class="border-0 py-3 text-center" style="width: 150px;">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="bi bi-gear text-muted me-2"></i>
                                            <span class="fw-semibold">Aksi</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allUsers as $index => $user)
                                    <tr class="table-row-animate" style="animation-delay: {{ $index * 0.1 }}s;">
                                        <td class="ps-4">
                                            <div class="fw-bold text-primary fs-6">#{{ $index + 1 }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <span class="fw-bold text-primary">{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                                    <small class="text-muted">ID: {{ $user->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted">{{ $user->email }}</div>
                                        </td>
                                        <td class="text-center">
                                            @if($user->laporans->count() > 0)
                                                <span class="badge bg-success bg-opacity-15 text-black px-3 py-2 rounded-pill">
                                                    <i class="bi bi-check-circle-fill me-1"></i>
                                                    {{ $user->laporans->count() }} Laporan
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-15 text-black px-3 py-2 rounded-pill">
                                                    <i class="bi bi-dash-circle me-1"></i>
                                                    Belum Ada
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-muted small">{{ $user->created_at->format('d M Y') }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                @if($user->laporans->count() > 0)
                                                    <a href="{{ route('admin.laporan.semua', $user->id) }}" 
                                                       class="btn btn-sm btn-outline-primary" title="Lihat Laporan">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-outline-secondary" disabled title="Belum Ada Laporan">
                                                        <i class="bi bi-eye-slash"></i>
                                                    </button>
                                                @endif
                                                
                                                <button onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" 
                                                        class="btn btn-sm btn-outline-danger" title="Hapus Pengguna">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                            
                                            {{-- Hidden delete form --}}
                                            <form id="delete-form-{{ $user->id }}" 
                                                  action="{{ route('admin.users.destroy', $user->id) }}" 
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Tablet View --}}
                    <div class="table-responsive d-none d-md-block d-lg-none">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 py-3 ps-4">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-fill text-muted me-2"></i>
                                            <span class="fw-semibold">Pengguna</span>
                                        </div>
                                    </th>
                                    <th class="border-0 py-3 text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="bi bi-file-earmark-text text-muted me-2"></i>
                                            <span class="fw-semibold">Laporan</span>
                                        </div>
                                    </th>
                                    <th class="border-0 py-3 text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="bi bi-gear text-muted me-2"></i>
                                            <span class="fw-semibold">Aksi</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allUsers as $index => $user)
                                    <tr class="table-row-animate" style="animation-delay: {{ $index * 0.1 }}s;">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                    <span class="fw-bold text-primary">{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold text-dark">{{ $user->name }}</div>
                                                    <small class="text-muted">{{ $user->email }}</small>
                                                    <br><small class="text-muted">{{ $user->created_at->format('d M Y') }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($user->laporans->count() > 0)
                                                <span class="badge bg-success bg-opacity-15 text-black px-3 py-2 rounded-pill">
                                                    <i class="bi bi-check-circle-fill me-1"></i>
                                                    {{ $user->laporans->count() }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-15 text-black px-3 py-2 rounded-pill">
                                                    <i class="bi bi-dash-circle me-1"></i>
                                                    0
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                @if($user->laporans->count() > 0)
                                                    <a href="{{ route('admin.laporan.semua', $user->id) }}" 
                                                       class="btn btn-sm btn-outline-primary" title="Lihat Laporan">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-outline-secondary" disabled title="Belum Ada Laporan">
                                                        <i class="bi bi-eye-slash"></i>
                                                    </button>
                                                @endif
                                                
                                                <button onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" 
                                                        class="btn btn-sm btn-outline-danger" title="Hapus Pengguna">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                            
                                            {{-- Hidden delete form --}}
                                            <form id="delete-form-{{ $user->id }}" 
                                                  action="{{ route('admin.users.destroy', $user->id) }}" 
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile View --}}
                    <div class="d-md-none p-3">
                        <div class="row g-3">
                            @foreach ($allUsers as $user)
                                <div class="col-12">
                                    <div class="card border shadow-sm">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex align-items-center flex-grow-1 me-2">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                                        <span class="fw-bold text-primary small">{{ substr($user->name, 0, 1) }}</span>
                                                    </div>
                                                    <div class="min-w-0 flex-grow-1">
                                                        <div class="fw-semibold text-dark text-truncate">{{ $user->name }}</div>
                                                        <small class="text-muted text-truncate d-block">{{ $user->email }}</small>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    @if($user->laporans->count() > 0)
                                                        <span class="badge bg-success bg-opacity-15 text-success">
                                                            {{ $user->laporans->count() }}
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary bg-opacity-15 text-secondary">
                                                            0
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="bg-light p-2 rounded mb-3">
                                                <div class="row text-center">
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">ID</small>
                                                        <span class="fw-semibold small">{{ $user->id }}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">Bergabung</small>
                                                        <span class="fw-semibold small">{{ $user->created_at->format('d/m/y') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2">
                                                @if($user->laporans->count() > 0)
                                                    <a href="{{ route('admin.laporan.semua', $user->id) }}" 
                                                       class="btn btn-sm btn-primary flex-grow-1 text-truncate">
                                                        <i class="bi bi-eye me-1"></i>Lihat
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-secondary flex-grow-1 text-truncate" disabled>
                                                        <i class="bi bi-eye-slash me-1"></i>Belum Ada
                                                    </button>
                                                @endif
                                                
                                                <button onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" 
                                                        class="btn btn-sm btn-outline-danger flex-shrink-0">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>

                                            {{-- Hidden delete form --}}
                                            <form id="delete-form-{{ $user->id }}" 
                                                  action="{{ route('admin.users.destroy', $user->id) }}" 
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Pagination --}}
                    @if (method_exists($allUsers, 'links'))
                        <div class="card-footer bg-light border-0 py-3">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <div class="text-muted small text-center text-md-start">
                                        Menampilkan {{ $allUsers->firstItem() ?? '0' }}-{{ $allUsers->lastItem() ?? '0' }} 
                                        dari {{ $allUsers->total() }} pengguna
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex justify-content-center justify-content-md-end">
                                        {{ $allUsers->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    {{-- Empty State --}}
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-people display-1 text-muted opacity-50"></i>
                        </div>
                        <h4 class="text-muted mb-3">Tidak Ada Pengguna</h4>
                        <p class="text-muted">Belum ada pengguna yang terdaftar dalam sistem.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Custom Styles --}}
<style>
.stats-card {
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.stats-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    border-left-color: var(--bs-primary);
}

.table-row-animate {
    opacity: 0;
    transform: translateX(-20px);
    animation: slideInLeft 0.6s ease forwards;
}

@keyframes slideInLeft {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.table-hover tbody tr:hover {
    background-color: rgba(13,110,253,.05);
    transform: scale(1.005);
    transition: all 0.2s ease;
}

.card {
    border-radius: 12px;
}

.btn {
    border-radius: 8px;
}

.form-control, .form-select {
    border-radius: 8px;
}

.badge {
    font-size: 0.75rem;
    font-weight: 600;
}

.input-group-text {
    border-radius: 8px 0 0 8px;
}

.input-group .form-control {
    border-radius: 0 8px 8px 0;
}

/* Responsive Improvements */
@media (max-width: 575.98px) {
    .stats-card {
        margin-bottom: 1rem;
    }
    
    .card-body {
        padding: 1rem !important;
    }
    
    .btn-sm {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
    
    .text-truncate {
        max-width: 120px;
    }
}

@media (min-width: 576px) and (max-width: 767.98px) {
    .col-6:nth-child(odd) {
        padding-right: 0.75rem;
    }
    
    .col-6:nth-child(even) {
        padding-left: 0.75rem;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .table-responsive table {
        font-size: 0.9rem;
    }
    
    .btn-sm {
        font-size: 0.8rem;
    }
}

@media (min-width: 992px) {
    .stats-card:hover {
        transform: translateY(-5px);
    }
}

/* Text overflow handling */
.min-w-0 {
    min-width: 0;
}

.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Better spacing for mobile */
@media (max-width: 767.98px) {
    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .py-4 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }
    
    .mb-4 {
        margin-bottom: 2rem !important;
    }
    
    .g-3 > * {
        padding: 0.75rem;
    }
}

/* Fix for very small screens */
@media (max-width: 350px) {
    .flex-grow-1 {
        min-width: 0;
    }
    
    .me-2, .me-3 {
        margin-right: 0.5rem !important;
    }
    
    .p-3 {
        padding: 0.75rem !important;
    }
    
    .btn-sm {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
    }
}
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Page Loading Animation
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stats cards
        const statsCards = document.querySelectorAll('.stats-card');
        statsCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 150);
        });
    });

    // Delete User Function
    function deleteUser(userId, userName) {
        Swal.fire({
            title: "Yakin ingin menghapus pengguna?",
            html: `Pengguna <strong>${userName}</strong> dan semua data laporan mereka akan terhapus permanen!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            confirmButtonText: '<i class="bi bi-trash me-2"></i>Ya, Hapus!',
            cancelButtonText: '<i class="bi bi-x-circle me-2"></i>Batal',
            reverseButtons: true,
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Sedang memproses penghapusan pengguna',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit the form
                document.getElementById(`delete-form-${userId}`).submit();
            }
        });
    }

    // Enhanced search functionality
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length >= 3 || this.value.length === 0) {
                    this.form.submit();
                }
            }, 500);
        });
    }

    // Add loading state to filter button
    const filterForm = document.querySelector('form');
    if (filterForm) {
        filterForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-2"></i>Mencari...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });
    }

    // Tooltip initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush