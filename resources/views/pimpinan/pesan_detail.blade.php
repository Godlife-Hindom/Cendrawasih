@extends('layouts.pimpinan')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <div class="me-3">
                    <i class="fas fa-file-alt text-primary" style="font-size: 2rem;"></i>
                </div>
                <div>
                    <h2 class="text-dark fw-bold mb-1">Detail Laporan</h2>
                    <p class="text-muted mb-0">Informasi lengkap laporan dan evaluasi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Report Information Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-dark fw-semibold mb-0">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informasi Laporan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="border-start border-primary border-4 ps-3">
                                <label class="form-label text-muted small fw-semibold text-uppercase">Judul Laporan</label>
                                <h6 class="text-dark fw-semibold mb-0">{{ $report->title }}</h6>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border-start border-info border-4 ps-3">
                                <label class="form-label text-muted small fw-semibold text-uppercase">Isi Laporan</label>
                                <p class="text-dark mb-0 lh-lg">{{ $report->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alternatives Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-dark fw-semibold mb-0">
                        <i class="fas fa-list-alt text-success me-2"></i>
                        Alternatif Terkait
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($report->alternatives->count() > 0)
                        <div class="row g-3">
                            @foreach ($report->alternatives as $index => $alt)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-3 rounded-3 border border-light bg-light">
                                        <div class="me-3">
                                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <span class="fw-bold">{{ $index + 1 }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 text-dark fw-semibold">{{ $alt->name }}</h6>
                                            <span class="badge bg-success-subtle text-success fw-semibold">Skor: {{ $alt->score }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-0">Tidak ada alternatif terkait</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Status Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-dark fw-semibold mb-0">
                        <i class="fas fa-flag text-warning me-2"></i>
                        Status & Evaluasi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        @if ($report->status === 'approved')
                            <div class="bg-success-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-check text-success" style="font-size: 2rem;"></i>
                            </div>
                            <h6 class="text-success fw-bold mb-2">DISETUJUI</h6>
                            <span class="badge bg-success px-3 py-2">Approved</span>
                        @elseif ($report->status === 'rejected')
                            <div class="bg-danger-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-times text-danger" style="font-size: 2rem;"></i>
                            </div>
                            <h6 class="text-danger fw-bold mb-2">DITOLAK</h6>
                            <span class="badge bg-danger px-3 py-2">Rejected</span>
                        @else
                            <div class="bg-secondary-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-clock text-secondary" style="font-size: 2rem;"></i>
                            </div>
                            <h6 class="text-secondary fw-bold mb-2">MENUNGGU</h6>
                            <span class="badge bg-secondary px-3 py-2">Pending</span>
                        @endif
                    </div>
                    
                    <hr class="my-4">
                    
                    <div>
                        <label class="form-label text-muted small fw-semibold text-uppercase">Catatan Evaluasi</label>
                        @if($report->evaluation)
                            <div class="bg-light rounded-3 p-3 mt-2">
                                <p class="text-dark mb-0 lh-base">{{ $report->evaluation }}</p>
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-sticky-note text-muted opacity-50" style="font-size: 2rem;"></i>
                                <p class="text-muted mt-2 mb-0 small">Belum ada catatan evaluasi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Criteria Section -->
    <div class="row">
        <div class="col-lg-6">
            <!-- Criteria Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-dark fw-semibold mb-0">
                        <i class="fas fa-tasks text-primary me-2"></i>
                        Daftar Kriteria
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($criteria->count() > 0)
                        <div class="row g-3">
                            @foreach ($criteria as $c)
                                <div class="col-12">
                                    <div class="border border-light rounded-3 p-3 bg-light">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="text-dark fw-semibold mb-0">{{ $c->name }}</h6>
                                            <span class="badge bg-primary-subtle text-primary">{{ $c->code }}</span>
                                        </div>
                                        <div class="row g-2 mt-2">
                                            <div class="col-6">
                                                <small class="text-muted">Bobot:</small>
                                                <div class="fw-semibold text-dark">{{ $c->weight }}</div>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Tipe:</small>
                                                <div class="fw-semibold text-dark">{{ ucfirst($c->type) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-list text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-0">Tidak ada kriteria tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Subcriteria Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title text-dark fw-semibold mb-0">
                        <i class="fas fa-sitemap text-info me-2"></i>
                        Daftar Subkriteria
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($subcriteria->count() > 0)
                        <div class="row g-3">
                            @foreach ($subcriteria as $s)
                                <div class="col-12">
                                    <div class="border border-light rounded-3 p-3 bg-light">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="text-dark fw-semibold mb-0">{{ $s->name }}</h6>
                                            @if ($s->kriteria)
                                                <span class="badge bg-info-subtle text-info small">{{ $s->kriteria->name }}</span>
                                            @endif
                                        </div>
                                        <div class="row g-2 mt-2">
                                            <div class="col-6">
                                                <small class="text-muted">Rentang:</small>
                                                <div class="fw-semibold text-dark">{{ $s->range }}</div>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Skor:</small>
                                                <div class="fw-semibold text-dark">{{ $s->score }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-project-diagram text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-0">Tidak ada subkriteria tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Button -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('pimpinan.laporan') }}" class="btn btn-outline-secondary px-4 py-2">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Daftar Laporan
                </a>
                <div class="text-muted small">
                    <i class="fas fa-info-circle me-1"></i>
                    Halaman detail laporan
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1) !important;
}
.bg-danger-subtle {
    background-color: rgba(220, 53, 69, 0.1) !important;
}
.bg-secondary-subtle {
    background-color: rgba(108, 117, 125, 0.1) !important;
}
.bg-primary-subtle {
    background-color: rgba(13, 110, 253, 0.1) !important;
}
.bg-info-subtle {
    background-color: rgba(13, 202, 240, 0.1) !important;
}
.text-success {
    color: #198754 !important;
}
.text-danger {
    color: #dc3545 !important;
}
.text-primary {
    color: #0d6efd !important;
}
.text-info {
    color: #0dcaf0 !important;
}
.card {
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
}
.btn {
    transition: all 0.3s ease;
}
.btn:hover {
    transform: translateY(-1px);
}
</style>
@endsection