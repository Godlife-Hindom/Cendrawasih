@extends('layouts.admin-app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800 mb-0">
                <i class="fas fa-map-marker-alt text-primary me-2"></i>Data Alternatif Lokasi
            </h1>
            <p class="text-muted mb-0">Kelola dan pantau data lokasi alternatif</p>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('alternatives.index') }}" id="filterForm">
                <div class="row g-3">
                    <!-- Filter User -->
                    <div class="col-lg-4 col-md-6">
                        <label for="user_id" class="form-label fw-semibold">
                            <i class="fas fa-user text-muted me-1"></i>Filter Pengguna
                        </label>
                        <select name="user_id" id="user_id" class="form-select form-select-lg shadow-sm" onchange="this.form.submit()">
                            <option value="">🌍 Semua Pengguna</option>
                            @foreach ($users as $user)
                                @if ($user->role === 'user')
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        👤 {{ $user->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Search Nama Lokasi -->
                    <div class="col-lg-4 col-md-6">
                        <label for="search" class="form-label fw-semibold">
                            <i class="fas fa-search text-muted me-1"></i>Cari Nama Lokasi
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-map-marker-alt text-muted"></i>
                            </span>
                            <input type="text" name="search" id="search" class="form-control form-control-lg border-start-0 shadow-sm" 
                                   placeholder="Masukkan nama lokasi..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-lg-4 col-md-12 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary btn-lg flex-fill shadow-sm">
                            <i class="fas fa-search me-2"></i>Cari
                        </button>
                        <a href="{{ route('alternatives.index') }}" class="btn btn-outline-secondary btn-lg shadow-sm">
                            <i class="fas fa-redo me-2"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Lokasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alternatives->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Halaman Saat Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alternatives->currentPage() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Per Halaman</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alternatives->perPage() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Halaman</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alternatives->lastPage() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-layers fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-white py-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-gray-800">
                    <i class="fas fa-table me-2 text-primary"></i>Daftar Lokasi Alternatif
                </h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-info btn-sm" onclick="toggleView()">
                        <i class="fas fa-th me-1"></i>Card View
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($alternatives->count() > 0)
                <!-- Table View -->
                <div class="table-responsive" id="tableView">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-map-marker-alt text-primary me-1"></i>Nama Lokasi
                                </th>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-leaf text-success me-1"></i>Vegetasi
                                </th>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-tint text-info me-1"></i>Air
                                </th>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-mountain text-warning me-1"></i>Topografi
                                </th>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-cloud-sun text-secondary me-1"></i>Iklim
                                </th>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-map-pin text-danger me-1"></i>Koordinat
                                </th>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-user text-muted me-1"></i>Dibuat oleh
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatives as $alt)
                            <tr class="border-bottom">
                                <td class="py-3">
                                    <div class="fw-semibold text-primary">{{ $alt->name }}</div>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-success-subtle text-success px-3 py-2">
                                        <i class="fas fa-leaf me-1"></i>{{ $alt->vegetation }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-info-subtle text-info px-3 py-2">
                                        <i class="fas fa-tint me-1"></i>{{ $alt->water }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-warning-subtle text-warning px-3 py-2">
                                        <i class="fas fa-mountain me-1"></i>{{ $alt->topography }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                                        <i class="fas fa-cloud-sun me-1"></i>{{ $alt->climate }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <small class="text-muted">
                                        <i class="fas fa-map-pin me-1"></i>
                                        {{ number_format($alt->latitude, 6) }}, {{ number_format($alt->longitude, 6) }}
                                    </small>
                                    <br>
                                    <a href="https://maps.google.com/?q={{ $alt->latitude }},{{ $alt->longitude }}" 
                                       target="_blank" class="btn btn-outline-primary btn-xs mt-1">
                                        <i class="fas fa-external-link-alt me-1"></i>Lihat Map
                                    </a>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center me-2">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">{{ $alt->user->name ?? 'Tidak diketahui' }}</div>
                                            <small class="text-muted">Kontributor</small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Card View (Hidden by default) -->
                <div class="row p-3 d-none" id="cardView">
                    @foreach ($alternatives as $alt)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-header bg-gradient-primary text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $alt->name }}
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Vegetasi</small>
                                        <span class="badge bg-success">{{ $alt->vegetation }}</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Air</small>
                                        <span class="badge bg-info">{{ $alt->water }}</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Topografi</small>
                                        <span class="badge bg-warning">{{ $alt->topography }}</span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Iklim</small>
                                        <span class="badge bg-secondary">{{ $alt->climate }}</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block">Koordinat</small>
                                    <small>{{ number_format($alt->latitude, 6) }}, {{ number_format($alt->longitude, 6) }}</small>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block">Dibuat oleh</small>
                                    <strong>{{ $alt->user->name ?? 'Tidak diketahui' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-map-marker-alt fa-4x text-muted opacity-50"></i>
                    </div>
                    <h5 class="text-muted mb-3">Tidak ada data lokasi ditemukan</h5>
                    <p class="text-muted mb-4">Belum ada inputan alternatif lokasi dari user.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Enhanced Pagination -->
    @if ($alternatives->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <p class="text-muted mb-0">
                    Menampilkan {{ $alternatives->firstItem() }} sampai {{ $alternatives->lastItem() }} 
                    dari {{ $alternatives->total() }} hasil
                </p>
            </div>
            <nav>
                <ul class="pagination pagination-lg mb-0">
                    {{-- Tombol Sebelumnya --}}
                    @if ($alternatives->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $alternatives->previousPageUrl() }}" rel="prev">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Nomor Halaman --}}
                    @foreach ($alternatives->links()->elements[0] as $page => $url)
                        @if ($page == $alternatives->currentPage())
                            <li class="page-item active">
                                <span class="page-link bg-primary border-primary">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Tombol Selanjutnya --}}
                    @if ($alternatives->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $alternatives->nextPageUrl() }}" rel="next">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.avatar-sm {
    width: 32px;
    height: 32px;
}
.btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}
.card {
    transition: transform 0.2s ease-in-out;
}
.card:hover {
    transform: translateY(-2px);
}
.table th {
    background-color: #f8f9fc;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}
</style>

<script>
function toggleView() {
    const tableView = document.getElementById('tableView');
    const cardView = document.getElementById('cardView');
    
    if (tableView.classList.contains('d-none')) {
        tableView.classList.remove('d-none');
        cardView.classList.add('d-none');
        event.target.innerHTML = '<i class="fas fa-th me-1"></i>Card View';
    } else {
        tableView.classList.add('d-none');
        cardView.classList.remove('d-none');
        event.target.innerHTML = '<i class="fas fa-table me-1"></i>Table View';
    }
}

function exportData() {
    // Implementasi export data
    alert('Fitur export akan segera tersedia!');
}

function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data lokasi ini?')) {
        // Implementasi delete
        alert('Data akan dihapus. ID: ' + id);
    }
}

// Auto-submit form when typing stops
let searchTimeout;
document.getElementById('search').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        this.form.submit();
    }, 1000);
});
</script>
@endsection