@extends('layouts.pimpinan')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="text-dark fw-bold mb-1">
                        <i class="fas fa-file-alt text-primary me-2"></i>
                        Daftar Laporan
                    </h2>
                    <p class="text-muted mb-0">Kelola dan review laporan yang masuk</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm" onclick="refreshPage()">
                        <i class="fas fa-sync-alt me-1"></i>
                        Refresh
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-filter me-1"></i>
                            Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="filterStatus('all')">Semua Status</a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterStatus('approved')">Disetujui</a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterStatus('rejected')">Ditolak</a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterStatus('pending')">Menunggu</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="fas fa-file-alt fa-lg text-primary"></i>
                        </div>
                    </div>
                    <h6 class="text-muted mb-1">Total Laporan</h6>
                    <h4 class="fw-bold text-dark mb-0">{{ $laporan->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="fas fa-check-circle fa-lg text-success"></i>
                        </div>
                    </div>
                    <h6 class="text-muted mb-1">Disetujui</h6>
                    <h4 class="fw-bold text-dark mb-0">{{ $laporan->where('status', 'approved')->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3">
                            <i class="fas fa-times-circle fa-lg text-danger"></i>
                        </div>
                    </div>
                    <h6 class="text-muted mb-1">Ditolak</h6>
                    <h4 class="fw-bold text-dark mb-0">{{ $laporan->where('status', 'rejected')->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="fas fa-clock fa-lg text-warning"></i>
                        </div>
                    </div>
                    <h6 class="text-muted mb-1">Menunggu</h6>
                    <h4 class="fw-bold text-dark mb-0">{{ $laporan->where('status', 'pending')->count() }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-semibold text-dark">
                            <i class="fas fa-list me-2 text-primary"></i>
                            Data Laporan
                        </h6>
                        <div class="d-flex gap-2">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <span class="input-group-text border-end-0 bg-light">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 bg-light" 
                                       placeholder="Cari laporan..." id="searchInput">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="laporanTable">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 fw-semibold text-dark border-0">
                                        <i class="fas fa-user me-2 text-primary"></i>
                                        Nama User
                                    </th>
                                    <th class="px-4 py-3 fw-semibold text-dark border-0">
                                        <i class="fas fa-calendar me-2 text-primary"></i>
                                        Waktu
                                    </th>
                                    <th class="px-4 py-3 fw-semibold text-dark border-0">
                                        <i class="fas fa-flag me-2 text-primary"></i>
                                        Status
                                    </th>
                                    <th class="px-4 py-3 fw-semibold text-dark border-0 text-center">
                                        <i class="fas fa-cogs me-2 text-primary"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($laporan as $lap)
                                <tr class="laporan-row" data-status="{{ $lap->status }}">
                                    <td class="px-4 py-3 align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-semibold text-dark">{{ $lap->user->name }}</h6>
                                                <small class="text-muted">{{ $lap->user->email ?? 'Email tidak tersedia' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $lap->created_at->format('d M Y') }}</div>
                                            <small class="text-muted">{{ $lap->created_at->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        @if ($lap->status === 'approved')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Sudah Layak
                                            </span>
                                        @elseif ($lap->status === 'rejected')
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i>
                                                Belum Layak 
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-3 py-2">
                                                <i class="fas fa-clock me-1"></i>
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 align-middle text-center">
                                        <div class="btn-group" role="group">
                                            <!-- Show laporan -->
                                            <a href="{{ route('pimpinan.viewMessage', $lap->id) }}" 
                                               class="btn btn-sm btn-outline-info rounded-start" 
                                               title="Lihat Laporan"
                                               data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <!-- Evaluasi laporan -->
                                            <a href="{{ route('pimpinan.evaluasi', $lap->id) }}" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="Evaluasi"
                                               data-bs-toggle="tooltip" data-bs-placement="top">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <!-- Hapus laporan -->
                                            <form action="{{ route('pimpinan.deleteLaporan', $lap->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirmDelete('{{ $lap->user->name }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger rounded-end" 
                                                        title="Hapus"
                                                        data-bs-toggle="tooltip" data-bs-placement="top">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3 text-muted opacity-50"></i>
                                            <h5 class="text-muted">Tidak ada laporan</h5>
                                            <p class="mb-0">Belum ada laporan yang tersedia saat ini.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .table tbody tr {
        transition: all 0.2s ease;
        border: none;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9ff !important;
        transform: scale(1.01);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .btn-group .btn {
        border-color: transparent;
        margin: 0 1px;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .badge {
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    
    .input-group-text {
        border-color: #e9ecef;
    }
    
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .table th {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .rounded-circle {
        transition: all 0.3s ease;
    }
    
    .laporan-row:hover .rounded-circle {
        transform: scale(1.1);
    }
</style>

<!-- Custom Scripts -->
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#laporanTable tbody tr.laporan-row');
        
        rows.forEach(row => {
            const userName = row.cells[0].textContent.toLowerCase();
            const date = row.cells[1].textContent.toLowerCase();
            const status = row.cells[2].textContent.toLowerCase();
            
            if (userName.includes(searchTerm) || date.includes(searchTerm) || status.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Filter by status
    function filterStatus(status) {
        const rows = document.querySelectorAll('#laporanTable tbody tr.laporan-row');
        
        rows.forEach(row => {
            if (status === 'all') {
                row.style.display = '';
            } else {
                const rowStatus = row.getAttribute('data-status');
                if (status === 'pending' && (!rowStatus || rowStatus === 'pending')) {
                    row.style.display = '';
                } else if (rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    }

    // Refresh page
    function refreshPage() {
        location.reload();
    }

    // Confirm delete with user name
    function confirmDelete(userName) {
        return confirm(`Yakin ingin menghapus laporan dari ${userName}?\n\nTindakan ini tidak dapat dibatalkan.`);
    }

    // Add loading animation for buttons
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.type === 'submit' || this.tagName === 'A') {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                }, 2000);
            }
        });
    });
</script>
@endsection