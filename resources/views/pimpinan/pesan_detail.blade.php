@extends('layouts.pimpinan')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4 py-md-5">
    <!-- Header Section -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex align-items-center mb-3 mb-md-4">
                <div class="me-2 me-md-3">
                    <i class="fas fa-file-alt text-primary" style="font-size: 1.5rem;"></i>
                </div>
                <div>
                    <h2 class="text-dark fw-bold mb-1 fs-4 fs-md-3 fs-lg-2">Detail Laporan</h2>
                    <p class="text-muted mb-0 small">Informasi lengkap laporan dan evaluasi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12 col-xl-8 mb-4">
            <!-- Report Information Card -->
            <div class="card shadow-sm border-0 mb-3 mb-md-4">
                <div class="card-header bg-white border-0 py-2 py-md-3">
                    <h5 class="card-title text-dark fw-semibold mb-0 fs-6 fs-md-5">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informasi Laporan
                    </h5>
                </div>
                <div class="card-body p-3 p-md-4">
                    <div class="row g-3 g-md-4">
                        <div class="col-12">
                            <div class="border-start border-primary border-4 ps-3">
                                <label class="form-label text-muted small fw-semibold text-uppercase">Judul Laporan</label>
                                <h6 class="text-dark fw-semibold mb-0 fs-6">{{ $report->title }}</h6>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border-start border-info border-4 ps-3">
                                <label class="form-label text-muted small fw-semibold text-uppercase">Isi Laporan</label>
                                <p class="text-dark mb-0 lh-lg small">{{ $report->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alternatives Card -->
            <div class="card shadow-sm border-0 mb-3 mb-md-4">
                <div class="card-header bg-white border-0 py-2 py-md-3">
                    <h5 class="card-title text-dark fw-semibold mb-0 fs-6 fs-md-5">
                        <i class="fas fa-list-alt text-success me-2"></i>
                        Alternatif Terkait
                    </h5>
                </div>
                <div class="card-body p-3 p-md-4">
                    @if($report->alternatives->count() > 0)
                        <div class="row g-2 g-md-3">
                            @foreach ($report->alternatives as $index => $alt)
                                <div class="col-12 col-sm-6 col-lg-12 col-xl-6">
                                    <div class="d-flex align-items-center p-2 p-md-3 rounded-3 border border-light bg-light">
                                        <div class="me-2 me-md-3">
                                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                                <span class="fw-bold small">{{ $index + 1 }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 min-w-0">
                                            <h6 class="mb-1 text-dark fw-semibold fs-6 text-truncate">{{ $alt->name }}</h6>
                                            <span class="badge bg-success-subtle text-success fw-semibold small">Skor: {{ $alt->score }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3 py-md-4">
                            <i class="fas fa-inbox text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2 mb-0">Tidak ada alternatif terkait</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <!-- Status Card -->
            <div class="card shadow-sm border-0 mb-3 mb-md-4">
                <div class="card-header bg-white border-0 py-2 py-md-3">
                    <h5 class="card-title text-dark fw-semibold mb-0 fs-6 fs-md-5">
                        <i class="fas fa-flag text-warning me-2"></i>
                        Status & Evaluasi
                    </h5>
                </div>
                <div class="card-body p-3 p-md-4">
                    <div class="text-center mb-3 mb-md-4">
                        @if ($report->status === 'approved')
                            <div class="bg-success-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-2 mb-md-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-check text-success" style="font-size: 1.5rem;"></i>
                            </div>
                            <h6 class="text-success fw-bold mb-2 fs-6">DISETUJUI</h6>
                            <span class="badge bg-success px-2 px-md-3 py-2">Approved</span>
                        @elseif ($report->status === 'rejected')
                            <div class="bg-danger-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-2 mb-md-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-times text-danger" style="font-size: 1.5rem;"></i>
                            </div>
                            <h6 class="text-danger fw-bold mb-2 fs-6">DITOLAK</h6>
                            <span class="badge bg-danger px-2 px-md-3 py-2">Rejected</span>
                        @elseif ($report->status === 'review')
                            <div class="bg-warning-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-2 mb-md-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-hourglass-half text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                            <h6 class="text-warning fw-bold mb-2 fs-6">REVIEW</h6>
                            <span class="badge bg-warning px-2 px-md-3 py-2">Review</span>
                        @else
                            <div class="bg-secondary-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-2 mb-md-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-clock text-secondary" style="font-size: 1.5rem;"></i>
                            </div>
                            <h6 class="text-secondary fw-bold mb-2 fs-6">MENUNGGU</h6>
                            <span class="badge bg-secondary px-2 px-md-3 py-2">Pending</span>
                        @endif
                    </div>
                    
                    <hr class="my-3 my-md-4">
                    
                    <div>
                        <label class="form-label text-muted small fw-semibold text-uppercase">Catatan Evaluasi</label>
                        @if($report->evaluation)
                            <div class="bg-light rounded-3 p-2 p-md-3 mt-2">
                                <p class="text-dark mb-0 lh-base small">{{ $report->evaluation }}</p>
                            </div>
                        @else
                            <div class="text-center py-2 py-md-3">
                                <i class="fas fa-sticky-note text-muted opacity-50" style="font-size: 1.5rem;"></i>
                                <p class="text-muted mt-2 mb-0 small">Belum ada catatan evaluasi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Criteria Section with Modern Design -->
    <div class="row">
        @forelse($criteria as $index => $item)
            <div class="col-12 mb-3 mb-md-4">
                <div class="criteria-card shadow-lg border-0 rounded-4 overflow-hidden">
                    <!-- Card Header -->
                    <div class="card-header position-relative">
                        <div class="header-gradient"></div>
                        <div class="header-content position-relative">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-8 mb-3 mb-lg-0">
                                    <div class="d-flex align-items-center flex-column flex-sm-row text-center text-sm-start">
                                        <div class="criteria-number me-0 me-sm-3 mb-2 mb-sm-0">
                                            <span class="number-badge">{{ $index + 1 }}</span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h4 class="criteria-title mb-1">{{ $item->name }}</h4>
                                            <div class="criteria-meta justify-content-center justify-content-sm-start">
                                                <span class="meta-item">
                                                    <i class="fas fa-code me-1"></i>
                                                    {{ $item->code }}
                                                </span>
                                                <span class="meta-item">
                                                    <i class="fas fa-tag me-1"></i>
                                                    {{ ucfirst($item->type) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 text-center text-lg-end">
                                    <div class="weight-display d-inline-block">
                                        <div class="weight-label">Bobot</div>
                                        <div class="weight-value">{{ $item->weight }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body for Subcriteria -->
                    <div class="card-body p-0">
                        @php
                            $itemSubcriteria = $subcriteria->where('criteria_id', $item->id);
                        @endphp
                        @if($itemSubcriteria->count() > 0)
                            <div class="subcriteria-section">
                                <div class="subcriteria-header">
                                    <h6 class="mb-0 text-muted fs-6">
                                        <i class="fas fa-list-ul me-2"></i>
                                        Subkriteria ({{ $itemSubcriteria->count() }} item)
                                    </h6>
                                </div>
                                
                                <!-- Mobile Cards View -->
                                <div class="d-block d-md-none">
                                    @foreach($itemSubcriteria as $subIndex => $sub)
                                        <div class="subcriteria-mobile-card">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div class="d-flex align-items-center">
                                                    <span class="row-number me-2">{{ $subIndex + 1 }}</span>
                                                    <div class="subcriteria-name">
                                                        <i class="fas fa-arrow-right text-primary me-1"></i>
                                                        {{ $sub->name }}
                                                    </div>
                                                </div>
                                                <span class="score-badge ms-2">{{ $sub->score }}</span>
                                            </div>
                                            <div class="mt-2">
                                                <span class="range-badge">{{ $sub->range }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Desktop Table View -->
                                <div class="table-responsive d-none d-md-block">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-header">
                                            <tr>
                                                <th class="text-center" width="8%">No</th>
                                                <th width="40%">Nama Subkriteria</th>
                                                <th width="30%">Range</th>
                                                <th class="text-center" width="22%">Skor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($itemSubcriteria as $subIndex => $sub)
                                                <tr class="subcriteria-row">
                                                    <td class="text-center">
                                                        <span class="row-number">{{ $subIndex + 1 }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="subcriteria-name">
                                                            <i class="fas fa-arrow-right text-primary me-2"></i>
                                                            {{ $sub->name }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="range-badge">{{ $sub->range }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="score-badge">{{ $sub->score }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <h6 class="empty-title">Belum Ada Subkriteria</h6>
                                <p class="empty-subtitle">Subkriteria untuk kriteria ini belum ditambahkan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state-main">
                    <div class="empty-icon-main">
                        <i class="fas fa-list"></i>
                    </div>
                    <h4 class="empty-title-main">Belum Ada Kriteria</h4>
                    <p class="empty-subtitle-main">Kriteria untuk sistem penilaian belum tersedia.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Action Button -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                <a href="{{ route('pimpinan.laporan') }}" class="btn btn-outline-secondary px-3 px-md-4 py-2 order-2 order-sm-1">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Daftar Laporan
                </a>
                <div class="text-muted small order-1 order-sm-2">
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
.bg-warning-subtle {
    background-color: rgba(255, 193, 7, 0.1) !important;
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
.text-warning {
    color: #ffc107 !important;
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
.min-w-0 {
    min-width: 0;
}

/* Modern Criteria Card Styles */
.criteria-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.criteria-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
}

.card-header {
    border: none;
    padding: 0;
    background: transparent;
}

.header-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #a7f3d0 100%);
}

.header-content {
    padding: 1.5rem;
    color: black;
}

.criteria-number {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    flex-shrink: 0;
}

.number-badge {
    font-size: 1rem;
    font-weight: 700;
    color: white;
}

.criteria-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.criteria-meta {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.meta-item {
    font-size: 0.8rem;
    opacity: 0.9;
    background: rgba(255, 255, 255, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    white-space: nowrap;
}

.weight-display {
    text-align: center;
    background: rgba(255, 255, 255, 0.15);
    padding: 0.75rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    min-width: 80px;
}

.weight-label {
    font-size: 0.75rem;
    opacity: 0.8;
    margin-bottom: 0.25rem;
}

.weight-value {
    font-size: 1.5rem;
    font-weight: 700;
}

.subcriteria-section {
    padding: 0;
}

.subcriteria-header {
    padding: 1rem 1.5rem;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}

/* Mobile Cards for Subcriteria */
.subcriteria-mobile-card {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e9ecef;
    background: white;
}

.subcriteria-mobile-card:last-child {
    border-bottom: none;
}

.subcriteria-mobile-card:hover {
    background: #f8f9fa;
}

/* Desktop Table Styles */
.table-header th {
    background: #f8f9fa;
    border: none;
    font-weight: 600;
    color: #495057;
    padding: 1rem;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.subcriteria-row {
    transition: all 0.2s ease;
}

.subcriteria-row:hover {
    background: #f8f9fa;
}

.subcriteria-row td {
    padding: 1rem;
    border: none;
    border-bottom: 1px solid #e9ecef;
}

.row-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 25px;
    height: 25px;
    background: #e9ecef;
    border-radius: 50%;
    font-weight: 600;
    font-size: 0.8rem;
    color: #495057;
    flex-shrink: 0;
}

.subcriteria-name {
    font-weight: 500;
    color: #495057;
    font-size: 0.9rem;
    line-height: 1.3;
}

.range-badge {
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.4rem 0.8rem;
    border-radius: 15px;
    font-weight: 500;
    font-size: 0.8rem;
    display: inline-block;
}

.score-badge {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 15px;
    font-weight: 600;
    font-size: 0.8rem;
    display: inline-block;
    min-width: 50px;
    text-align: center;
}

.empty-state {
    text-align: center;
    padding: 2rem 1.5rem;
    color: #6c757d;
}

.empty-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.empty-subtitle {
    font-size: 0.9rem;
    opacity: 0.8;
}

.empty-state-main {
    text-align: center;
    padding: 3rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.empty-icon-main {
    font-size: 3rem;
    color: #dee2e6;
    margin-bottom: 1.5rem;
}

.empty-title-main {
    color: #495057;
    margin-bottom: 1rem;
}

.empty-subtitle-main {
    color: #6c757d;
    font-size: 1rem;
}

/* Responsive Design Improvements */
@media (max-width: 1399.98px) {
    .header-content {
        padding: 1.25rem;
    }
    
    .criteria-title {
        font-size: 1.2rem;
    }
    
    .weight-value {
        font-size: 1.4rem;
    }
}

@media (max-width: 991.98px) {
    .header-content .row > .col-12:first-child {
        margin-bottom: 1rem;
    }
    
    .criteria-title {
        font-size: 1.1rem;
    }
    
    .weight-display {
        margin-top: 0;
    }
}

@media (max-width: 767.98px) {
    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .header-content {
        padding: 1rem;
    }
    
    .criteria-number {
        width: 35px;
        height: 35px;
        margin-bottom: 1rem;
    }
    
    .number-badge {
        font-size: 0.9rem;
    }
    
    .criteria-title {
        font-size: 1rem;
        text-align: center;
        margin-bottom: 0.75rem;
    }
    
    .criteria-meta {
        justify-content: center;
        gap: 0.4rem;
    }
    
    .meta-item {
        font-size: 0.75rem;
        padding: 0.2rem 0.4rem;
    }
    
    .weight-display {
        padding: 0.6rem;
        min-width: 70px;
    }
    
    .weight-label {
        font-size: 0.7rem;
    }
    
    .weight-value {
        font-size: 1.2rem;
    }
    
    .subcriteria-header {
        padding: 0.75rem 1rem;
        text-align: center;
    }
    
    .subcriteria-mobile-card {
        padding: 0.75rem 1rem;
    }
    
    .subcriteria-name {
        font-size: 0.85rem;
    }
    
    .row-number {
        width: 22px;
        height: 22px;
        font-size: 0.75rem;
    }
    
    .range-badge,
    .score-badge {
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
        border-radius: 12px;
    }
    
    .score-badge {
        min-width: 45px;
    }
    
    .empty-state {
        padding: 1.5rem 1rem;
    }
    
    .empty-icon {
        font-size: 2rem;
    }
    
    .empty-title {
        font-size: 1rem;
    }
    
    .empty-subtitle {
        font-size: 0.85rem;
    }
}

@media (max-width: 575.98px) {
    .criteria-title {
        font-size: 0.95rem;
        line-height: 1.3;
    }
    
    .criteria-meta {
        gap: 0.3rem;
    }
    
    .meta-item {
        font-size: 0.7rem;
        padding: 0.15rem 0.35rem;
    }
    
    .weight-display {
        padding: 0.5rem;
        border-radius: 10px;
    }
    
    .weight-value {
        font-size: 1.1rem;
    }
    
    .subcriteria-mobile-card {
        padding: 0.6rem 0.8rem;
    }
    
    .subcriteria-name {
        font-size: 0.8rem;
        line-height: 1.2;
    }
    
    .subcriteria-name i {
        font-size: 0.7rem;
    }
    
    .row-number {
        width: 20px;
        height: 20px;
        font-size: 0.7rem;
    }
    
    .range-badge,
    .score-badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
        border-radius: 10px;
    }
    
    .score-badge {
        min-width: 40px;
    }
}

/* Small mobile devices */
@media (max-width: 399.98px) {
    .criteria-title {
        font-size: 0.9rem;
    }
    
    .meta-item {
        font-size: 0.65rem;
        padding: 0.1rem 0.3rem;
    }
    
    .subcriteria-name {
        font-size: 0.75rem;
    }
    
    .range-badge,
    .score-badge {
        font-size: 0.65rem;
        padding: 0.2rem 0.4rem;
    }
}
</style>
@endsection