@extends('layouts.user-app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">
                <i class="fas fa-map-marker-alt me-2"></i>
                Lokasi Alternatif Anda
            </h2>
            <p class="text-muted mb-0">Kelola dan pantau lokasi alternatif yang telah Anda tambahkan</p>
        </div>

        <a href="{{ route('user.alternatives.create') }}" 
        class="btn btn-primary btn-lg w-1 rounded-pill shadow-sm">
        <i class="bi bi-plus-lg me-2"></i>Tambah Alternatif
        </a>
        <form action="{{ route('user.calculate.aras') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-warning btn-lg px-3 py-2 rounded-pill shadow-sm fw-semibold">
                    <i class="bi bi-play-fill me-2"></i>Mulai Perhitungan ARAS
                </button>
        </form>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle text-success me-2 fs-5"></i>
                <div>
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-map-marker-alt text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold fs-4 text-primary">{{ count($alternatives) }}</div>
                            <div class="text-muted small">Total Lokasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-leaf text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold fs-4 text-success">{{ $alternatives->where('vegetation', '!=', '')->count() }}</div>
                            <div class="text-muted small">Dengan Vegetasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-water text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold fs-4 text-info">{{ $alternatives->where('water', '!=', '')->count() }}</div>
                            <div class="text-muted small">Sumber Air</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                <i class="fas fa-mountain text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold fs-4 text-warning">{{ $alternatives->where('topography', '!=', '')->count() }}</div>
                            <div class="text-muted small">Variasi Topografi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Cari lokasi..." id="searchInput">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Locations Grid/Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Daftar Lokasi</h5>
            </div>
        </div>
        <div class="card-body p-0">

            <!-- Table View -->
            <div id="tableContainer" class="d-block">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 fw-semibold">Nama Lokasi</th>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-leaf text-success me-1"></i>Vegetasi
                                </th>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-water text-info me-1"></i>Air
                                </th>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-mountain text-warning me-1"></i>Topografi
                                </th>
                                <th class="border-0 fw-semibold">
                                    <i class="fas fa-cloud-sun text-primary me-1"></i>Iklim
                                </th>
                                <th class="border-0 fw-semibold">Koordinat</th>
                                <th class="border-0 fw-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="locationsTable">
                            @foreach ($alternatives as $alt)
                            <tr class="location-row" 
                                data-name="{{ strtolower($alt->name) }}"
                                data-vegetation="{{ strtolower($alt->vegetation) }}"
                                data-water="{{ strtolower($alt->water) }}"
                                data-climate="{{ strtolower($alt->climate) }}">
                                <td class="fw-semibold text-primary">{{ $alt->name }}</td>
                                <td>
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                        {{ $alt->vegetation ?: 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">
                                        {{ $alt->water ?: 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                        {{ $alt->topography ?: 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                                        {{ $alt->climate ?: 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">{{ number_format($alt->latitude, 4) }}, {{ number_format($alt->longitude, 4) }}</span>
                                        <button class="btn btn-sm btn-light" onclick="copyCoordinates('{{ $alt->latitude }}, {{ $alt->longitude }}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('user.alternatives.edit', $alt) }}" class="btn btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit">Edit</i>
                                        </a>
                                        <button class="btn btn-outline-info" onclick="viewOnMap('{{ $alt->latitude }}', '{{ $alt->longitude }}')" title="Lihat di Peta">
                                            <i class="fas fa-map">Map</i>
                                        </button>
                                        <form action="{{ route('user.alternatives.destroy', $alt) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-outline-danger" onclick="return confirm('Hapus lokasi {{ $alt->name }}?')" title="Hapus">
                                                <i class="fas fa-trash">Hapus</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if(count($alternatives) == 0)
    <!-- Empty State -->
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-map-marker-alt text-muted" style="font-size: 4rem;"></i>
        </div>
        <h4 class="text-muted mb-2">Belum Ada Lokasi Alternatif</h4>
        <p class="text-muted mb-4">Mulai tambahkan lokasi alternatif pertama Anda untuk memulai.</p>
        <a href="{{ route('user.alternatives.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2">Tambah Lokasi Pertama</i>
        </a>
    </div>
    @endif
</div>

<!-- Custom Styles -->
<style>
.location-item {
    transition: all 0.3s ease;
    border-radius: 12px !important;
}

.location-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
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

.table-responsive {
    border-radius: 0 0 12px 12px;
}

.alert {
    border-radius: 12px;
}

.badge {
    font-size: 0.75em;
    padding: 0.4em 0.8em;
    border-radius: 6px;
}

.dropdown-menu {
    border-radius: 8px;
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,6);
    color: aqua;
}

.btn-group-sm > .btn {
    padding: 0.25rem 0.5rem;
}
</style>

<!-- Custom JavaScript -->
<script>
// View Mode Toggle
document.addEventListener('DOMContentLoaded', function() {
    const gridView = document.getElementById('gridView');
    const tableView = document.getElementById('tableView');
    const gridContainer = document.getElementById('gridContainer');
    const tableContainer = document.getElementById('tableContainer');

    gridView.addEventListener('change', function() {
        if (this.checked) {
            gridContainer.classList.remove('d-none');
            tableContainer.classList.add('d-none');
        }
    });

    tableView.addEventListener('change', function() {
        if (this.checked) {
            tableContainer.classList.remove('d-none');
            gridContainer.classList.add('d-none');
        }
    });
});

// Search and Filter Functionality
document.getElementById('searchInput').addEventListener('input', function() {
    filterLocations();
});

document.getElementById('vegetationFilter').addEventListener('change', function() {
    filterLocations();
});

document.getElementById('waterFilter').addEventListener('change', function() {
    filterLocations();
});

document.getElementById('climateFilter').addEventListener('change', function() {
    filterLocations();
});

function filterLocations() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const vegetationFilter = document.getElementById('vegetationFilter').value.toLowerCase();
    const waterFilter = document.getElementById('waterFilter').value.toLowerCase();
    const climateFilter = document.getElementById('climateFilter').value.toLowerCase();

    // Filter grid cards
    const gridCards = document.querySelectorAll('.location-card');
    gridCards.forEach(card => {
        const name = card.dataset.name;
        const vegetation = card.dataset.vegetation;
        const water = card.dataset.water;
        const climate = card.dataset.climate;

        const matchesSearch = name.includes(searchTerm);
        const matchesVegetation = !vegetationFilter || vegetation.includes(vegetationFilter);
        const matchesWater = !waterFilter || water.includes(waterFilter);
        const matchesClimate = !climateFilter || climate.includes(climateFilter);

        if (matchesSearch && matchesVegetation && matchesWater && matchesClimate) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });

    // Filter table rows
    const tableRows = document.querySelectorAll('.location-row');
    tableRows.forEach(row => {
        const name = row.dataset.name;
        const vegetation = row.dataset.vegetation;
        const water = row.dataset.water;
        const climate = row.dataset.climate;

        const matchesSearch = name.includes(searchTerm);
        const matchesVegetation = !vegetationFilter || vegetation.includes(vegetationFilter);
        const matchesWater = !waterFilter || water.includes(waterFilter);
        const matchesClimate = !climateFilter || climate.includes(climateFilter);

        if (matchesSearch && matchesVegetation && matchesWater && matchesClimate) {
            row.style.display = 'table-row';
        } else {
            row.style.display = 'none';
        }
    });
}

function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('vegetationFilter').value = '';
    document.getElementById('waterFilter').value = '';
    document.getElementById('climateFilter').value = '';
    filterLocations();
}

function copyCoordinates(coordinates) {
    navigator.clipboard.writeText(coordinates).then(function() {
        // Show toast notification
        showToast('Koordinat berhasil disalin!', 'success');
    });
}

function viewOnMap(lat, lng) {
    // Open Google Maps with coordinates
    const url = `https://www.google.com/maps?q=${lat},${lng}`;
    window.open(url, '_blank');
}

function showToast(message, type = 'info') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2"></i>
            ${message}
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Remove toast after 3 seconds
    setTimeout(() => {
        toast.remove();
    }, 3000);
}
</script>
@endsection