@extends('layouts.user-app')

@section('title', 'Lihat Kriteria dan Subkriteria')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="page-header mb-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-wrapper me-3">
                        <i class="bi bi-sliders fs-1 text-primary"></i>
                    </div>
                    <div>
                        <h1 class="page-title mb-1 fw-bold">Daftar Kriteria & Subkriteria</h1>
                        <p class="page-subtitle text-muted mb-0">Kelola dan lihat semua kriteria beserta subkriteria yang digunakan dalam sistem penilaian</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="stats-badge">
                    <span class="badge bg-gradient-primary fs-6 py-2 px-3">
                        <i class="bi bi-collection me-1"></i>
                        {{ count($criteria) }} Kriteria
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Criteria Cards -->
    <div class="row">
        @forelse($criteria as $index => $item)
            <div class="col-12 mb-4">
                <div class="criteria-card shadow-lg border-0 rounded-4 overflow-hidden">
                    <!-- Card Header -->
                    <div class="card-header position-relative">
                        <div class="header-gradient"></div>
                        <div class="header-content position-relative">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center">
                                        <div class="criteria-number me-3">
                                            <span class="number-badge">{{ $index + 1 }}</span>
                                        </div>
                                        <div>
                                            <h4 class="criteria-title mb-1">{{ $item->name }}</h4>
                                            <div class="criteria-meta">
                                                <span class="meta-item">
                                                    <i class="bi bi-code-square me-1"></i>
                                                    {{ $item->code }}
                                                </span>
                                                <span class="meta-item">
                                                    <i class="bi bi-tag me-1"></i>
                                                    {{ $item->type }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="weight-display">
                                        <div class="weight-label">Bobot</div>
                                        <div class="weight-value">{{ $item->weight }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-0">
                        @if($item->subcriteria->count() > 0)
                            <div class="subcriteria-section">
                                <div class="subcriteria-header">
                                    <h6 class="mb-0 text-muted">
                                        <i class="bi bi-list-ul me-2"></i>
                                        Subkriteria ({{ $item->subcriteria->count() }} item)
                                    </h6>
                                </div>
                                
                                <div class="table-responsive">
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
                                            @foreach($item->subcriteria as $subIndex => $sub)
                                                <tr class="subcriteria-row">
                                                    <td class="text-center">
                                                        <span class="row-number">{{ $subIndex + 1 }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="subcriteria-name">
                                                            <i class="bi bi-arrow-right-short text-primary me-2"></i>
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
                                    <i class="bi bi-inbox"></i>
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
                        <i class="bi bi-collection"></i>
                    </div>
                    <h4 class="empty-title-main">Belum Ada Kriteria</h4>
                    <p class="empty-subtitle-main">Silakan tambahkan kriteria terlebih dahulu untuk mulai menggunakan sistem.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
/* Custom Styles */
.page-header {
    background: linear-gradient(135deg, #f8f9fa 0%, rgba(0, 0, 0, 0.075) 100%);
    border-radius: 20px;
    padding: 2rem;
    color: black;
    margin-bottom: 2rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.icon-wrapper {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stats-badge .badge {
    font-size: 1rem;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
}

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
    padding: 2rem;
    color: black;
}

.criteria-number {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.number-badge {
    font-size: 1.2rem;
    font-weight: 700;
    color: white;
}

.criteria-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.criteria-meta {
    display: flex;
    gap: 1rem;
}

.meta-item {
    font-size: 0.9rem;
    opacity: 0.9;
    background: rgba(255, 255, 255, 0.1);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    backdrop-filter: blur(10px);
}

.weight-display {
    text-align: center;
    background: rgba(255, 255, 255, 0.15);
    padding: 1rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.weight-label {
    font-size: 0.85rem;
    opacity: 0.8;
    margin-bottom: 0.25rem;
}

.weight-value {
    font-size: 1.8rem;
    font-weight: 700;
}

.subcriteria-section {
    padding: 0;
}

.subcriteria-header {
    padding: 1.5rem 2rem 1rem;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}

.table-header th {
    background: #f8f9fa;
    border: none;
    font-weight: 600;
    color: #495057;
    padding: 1rem;
    font-size: 0.9rem;
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
    width: 30px;
    height: 30px;
    background: #e9ecef;
    border-radius: 50%;
    font-weight: 600;
    font-size: 0.9rem;
    color: #495057;
}

.subcriteria-name {
    font-weight: 500;
    color: #495057;
}

.range-badge {
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.9rem;
}

.score-badge {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
    display: inline-block;
    min-width: 60px;
}

.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: #6c757d;
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.empty-subtitle {
    font-size: 0.95rem;
    opacity: 0.8;
}

.empty-state-main {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.empty-icon-main {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 1.5rem;
}

.empty-title-main {
    color: #495057;
    margin-bottom: 1rem;
}

.empty-subtitle-main {
    color: #6c757d;
    font-size: 1.1rem;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .page-title {
        font-size: 2.2rem;
    }
    
    .criteria-title {
        font-size: 1.4rem;
    }
    
    .weight-value {
        font-size: 1.6rem;
    }
}

@media (max-width: 992px) {
    .page-header {
        padding: 1.75rem;
        text-align: center;
    }
    
    .page-header .d-flex {
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    
    .icon-wrapper {
        margin: 0 auto;
    }
    
    .stats-badge {
        margin-top: 1rem;
    }
    
    .header-content .row {
        text-align: center;
    }
    
    .header-content .col-md-8,
    .header-content .col-md-4 {
        width: 100%;
        max-width: 100%;
        flex: 0 0 100%;
    }
    
    .header-content .col-md-4 {
        margin-top: 1.5rem;
    }
    
    .weight-display {
        display: inline-block;
        min-width: 140px;
    }
    
    .criteria-meta {
        justify-content: center;
        flex-wrap: wrap;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem;
    }
    
    .page-header {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-radius: 15px;
    }
    
    .page-title {
        font-size: 1.8rem;
        line-height: 1.2;
        margin-bottom: 0.75rem;
    }
    
    .page-subtitle {
        font-size: 1rem;
        line-height: 1.4;
    }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
    }
    
    .icon-wrapper i {
        font-size: 1.8rem !important;
    }
    
    .stats-badge .badge {
        font-size: 0.9rem;
        padding: 0.6rem 1.2rem;
    }
    
    .header-content {
        padding: 1.5rem 1rem;
    }
    
    .criteria-number {
        width: 40px;
        height: 40px;
    }
    
    .number-badge {
        font-size: 1rem;
    }
    
    .criteria-title {
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }
    
    .criteria-meta {
        gap: 0.5rem;
    }
    
    .meta-item {
        font-size: 0.8rem;
        padding: 0.3rem 0.6rem;
    }
    
    .weight-display {
        margin-top: 1.5rem;
        padding: 0.8rem;
        min-width: 120px;
    }
    
    .weight-value {
        font-size: 1.5rem;
    }
    
    .subcriteria-header {
        padding: 1rem;
        text-align: center;
    }
    
    .table-responsive {
        font-size: 0.85rem;
    }
    
    .table-header th {
        padding: 0.75rem 0.5rem;
        font-size: 0.8rem;
    }
    
    .subcriteria-row td {
        padding: 0.75rem 0.5rem;
    }
    
    .row-number {
        width: 25px;
        height: 25px;
        font-size: 0.8rem;
    }
    
    .subcriteria-name {
        font-size: 0.9rem;
        line-height: 1.3;
    }
    
    .range-badge,
    .score-badge {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }
}

@media (max-width: 576px) {
    .container-fluid {
        padding: 0.75rem;
    }
    
    .page-header {
        padding: 1.25rem;
        border-radius: 12px;
    }
    
    .page-title {
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
    }
    
    .page-subtitle {
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    .icon-wrapper {
        width: 50px;
        height: 50px;
    }
    
    .icon-wrapper i {
        font-size: 1.5rem !important;
    }
    
    .stats-badge .badge {
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
    }
    
    .criteria-card {
        border-radius: 12px;
        margin-bottom: 1rem;
    }
    
    .header-content {
        padding: 1.25rem 0.75rem;
    }
    
    .criteria-number {
        width: 35px;
        height: 35px;
    }
    
    .number-badge {
        font-size: 0.9rem;
    }
    
    .criteria-title {
        font-size: 1.1rem;
        margin-bottom: 0.75rem;
    }
    
    .criteria-meta {
        gap: 0.4rem;
    }
    
    .meta-item {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
    
    .weight-display {
        padding: 0.75rem;
        border-radius: 10px;
        min-width: 100px;
    }
    
    .weight-label {
        font-size: 0.75rem;
    }
    
    .weight-value {
        font-size: 1.3rem;
    }
    
    .subcriteria-header {
        padding: 0.75rem;
    }
    
    .subcriteria-header h6 {
        font-size: 0.9rem;
    }
    
    .table-responsive {
        font-size: 0.8rem;
    }
    
    .table-header th {
        padding: 0.6rem 0.3rem;
        font-size: 0.7rem;
    }
    
    .subcriteria-row td {
        padding: 0.6rem 0.3rem;
        vertical-align: middle;
    }
    
    .row-number {
        width: 22px;
        height: 22px;
        font-size: 0.7rem;
    }
    
    .subcriteria-name {
        font-size: 0.8rem;
        line-height: 1.2;
    }
    
    .subcriteria-name i {
        display: none;
    }
    
    .range-badge,
    .score-badge {
        font-size: 0.7rem;
        padding: 0.3rem 0.6rem;
        border-radius: 8px;
        word-break: break-word;
    }
    
    .score-badge {
        min-width: auto;
    }
    
    .empty-state {
        padding: 1.5rem 0.75rem;
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

@media (max-width: 480px) {
    .page-title {
        font-size: 1.3rem;
    }
    
    .criteria-title {
        font-size: 1rem;
    }
    
    .table-responsive {
        font-size: 0.75rem;
    }
    
    .table-header th {
        padding: 0.5rem 0.2rem;
        font-size: 0.65rem;
    }
    
    .subcriteria-row td {
        padding: 0.5rem 0.2rem;
    }
    
    .subcriteria-name {
        font-size: 0.75rem;
    }
    
    .range-badge,
    .score-badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
    }
    
    .row-number {
        width: 20px;
        height: 20px;
        font-size: 0.65rem;
    }
}

@media (max-width: 400px) {
    .container-fluid {
        padding: 0.5rem;
    }
    
    .page-header {
        padding: 1rem;
    }
    
    .page-title {
        font-size: 1.2rem;
    }
    
    .page-subtitle {
        font-size: 0.8rem;
    }
    
    .header-content {
        padding: 1rem 0.5rem;
    }
    
    .criteria-title {
        font-size: 0.95rem;
    }
    
    .weight-display {
        padding: 0.5rem;
        min-width: 80px;
    }
    
    .weight-value {
        font-size: 1.1rem;
    }
    
    .table-header th,
    .subcriteria-row td {
        padding: 0.4rem 0.15rem;
    }
    
    .subcriteria-name {
        font-size: 0.7rem;
    }
    
    .range-badge,
    .score-badge {
        font-size: 0.6rem;
        padding: 0.2rem 0.4rem;
    }
    
    .row-number {
        width: 18px;
        height: 18px;
        font-size: 0.6rem;
    }
}

@media (max-width: 360px) {
    .page-title {
        font-size: 1.1rem;
    }
    
    .criteria-title {
        font-size: 0.9rem;
    }
    
    .meta-item {
        font-size: 0.7rem;
        padding: 0.2rem 0.4rem;
    }
    
    .subcriteria-name {
        font-size: 0.65rem;
    }
    
    .range-badge,
    .score-badge {
        font-size: 0.55rem;
        padding: 0.15rem 0.3rem;
    }
}
</style>
@endsection