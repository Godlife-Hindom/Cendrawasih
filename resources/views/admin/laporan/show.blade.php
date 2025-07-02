@extends('layouts.admin-app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body py-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar-lg me-3">
                            <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-person-fill fs-2 text-white"></i>
                            </div>
                        </div>
                        <div>
                            <h2 class="mb-1 fw-bold">Laporan Pengguna</h2>
                            <p class="mb-0 fs-5 opacity-90">
                                <i class="bi bi-person-circle me-2"></i>
                                <strong>{{ $user->name }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Alert for Auto-Update Feature -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                    <div>
                        <h6 class="mb-1 fw-semibold">Sistem Auto-Update Laporan</h6>
                        <p class="mb-0 small">
                            Ketika user ini mengirimkan laporan baru, laporan sebelumnya akan otomatis terhapus dan digantikan dengan yang terbaru.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($laporan->isEmpty())
        <!-- Empty State -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-file-earmark-text display-1 text-muted opacity-50"></i>
                        </div>
                        <h4 class="text-muted mb-3">Belum Ada Laporan</h4>
                        <p class="text-muted mb-4">
                            User ini belum mengirimkan laporan apapun.
                            <br>Laporan akan muncul di sini setelah user mengirimkan data.
                        </p>
                        <div class="d-flex justify-content-center gap-2">
                            <span class="badge bg-light text-dark px-3 py-2">
                                <i class="bi bi-clock me-1"></i> Menunggu Laporan
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Reports Table -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-bottom-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-list-ul text-primary me-2"></i>
                                Laporan Terbaru ({{ $laporan->count() }} laporan)
                            </h5>
                            <div class="d-flex gap-2">
                                <span class="badge bg-success-subtle text-success px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Laporan Aktif
                                </span>
                                <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                    <i class="bi bi-arrow-repeat me-1"></i>
                                    Auto-Update
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4 py-3 fw-semibold text-muted">#</th>
                                        <th class="px-4 py-3 fw-semibold text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>Nama Lokasi
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-muted text-center">
                                            <i class="bi bi-star me-1"></i>Skor
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-muted text-center">
                                            <i class="bi bi-trophy me-1"></i>Peringkat
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-muted">
                                            <i class="bi bi-calendar3 me-1"></i>Tanggal Update
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-muted text-center">Status</th>
                                        <!-- <th class="px-4 py-3 fw-semibold text-muted text-center">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $i => $lap)
                                        <tr class="border-bottom">
                                            <td class="px-4 py-3">
                                                <span class="badge bg-light text-dark rounded-pill">{{ $i + 1 }}</span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        <i class="bi bi-building text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">{{ $lap->name }}</h6>
                                                        <small class="text-muted">Lokasi Penilaian</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                @php
                                                    $scoreClass = 'bg-secondary';
                                                    if($lap->score >= 0.80) $scoreClass = 'bg-success';
                                                    elseif($lap->score >= 0.60) $scoreClass = 'bg-info';
                                                    elseif($lap->score >= 0.40) $scoreClass = 'bg-warning';
                                                    elseif($lap->score >= 0.20) $scoreClass = 'bg-danger';
                                                    else $scoreClass = 'bg-black';
                                                @endphp
                                                <span class="badge {{ $scoreClass }} px-3 py-2 fs-6">
                                                    {{ $lap->score }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                @php
                                                    $rankClass = 'text-muted';
                                                    $rankIcon = 'bi-hash';
                                                    if($lap->peringkat <= 3) {
                                                        $rankClass = 'text-warning';
                                                        $rankIcon = 'bi-trophy-fill';
                                                    } elseif($lap->peringkat <= 5) {
                                                        $rankClass = 'text-info';
                                                        $rankIcon = 'bi-award';
                                                    }
                                                @endphp
                                                <span class="fw-bold {{ $rankClass }}">
                                                    <i class="{{ $rankIcon }} me-1"></i>{{ $lap->peringkat }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div>
                                                    <div class="fw-semibold">{{ $lap->created_at->format('d M Y') }}</div>
                                                    <small class="text-muted">
                                                        <i class="bi bi-clock me-1"></i>{{ $lap->created_at->format('H:i') }}
                                                    </small>
                                                    @if($lap->updated_at->gt($lap->created_at))
                                                        <br>
                                                        <small class="text-info">
                                                            <i class="bi bi-arrow-repeat me-1"></i>
                                                            Diperbarui: {{ $lap->updated_at->format('d M Y H:i') }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="badge bg-success-subtle text-success px-3 py-2">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Terbaru
                                                </span>
                                            </td>
                                            <!-- <td class="px-4 py-3 text-center">
                                                <form action="{{ route('admin.laporan.destroy', $lap->id) }}" method="POST" 
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.')" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- <button type="submit" 
                                                            class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                                            data-bs-toggle="tooltip" 
                                                            data-bs-placement="top" 
                                                            title="Hapus Laporan">
                                                        <i class="bi bi-trash3 me-1"></i>
                                                        Hapus
                                                    </button> -->
                                                </form>
                                            </td> -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Table Footer -->
                    <div class="card-footer bg-transparent border-top-0 py-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Menampilkan {{ $laporan->count() }} laporan terbaru dari {{ $user->name }}
                                </small>
                            </div>
                            <div class="col-md-6 text-end">
                                <small class="text-muted">
                                    <i class="bi bi-clock-history me-1"></i>
                                    Terakhir diperbarui: {{ now()->format('d M Y H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.laporan.index') }}" 
                   class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>
                    Kembali ke Daftar User
                </a>
                
                @if (!$laporan->isEmpty())
                    <div class="d-flex gap-2">
                        
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #a7f3d0 100%) !important;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,123,255,0.05);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.card {
    transition: all 0.3s ease;
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.badge {
    font-weight: 500;
}

.avatar-lg {
    flex-shrink: 0;
}

.alert {
    border-left: 4px solid #17a2b8;
}

@media print {
    .btn, .card-footer, .bg-gradient-primary, .alert {
        display: none !important;
    }
    
    .card {
        border: 1px solid #dee2e6 !important;
        box-shadow: none !important;
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
    }
    
    .text-end {
        text-align: start !important;
    }
}
</style>

<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Add loading state to delete buttons
document.querySelectorAll('form[method="POST"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        const button = this.querySelector('button[type="submit"]');
        if (button) {
            button.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Menghapus...';
            button.disabled = true;
        }
    });
});
</script>
@endsection