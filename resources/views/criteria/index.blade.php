@extends('layouts.admin-app')

@section('content')
<div class="criteria-container">
    <div class="main-container">
        <!-- Header Section -->
        <div class="page-header">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-chart-line"></i>
                    Data Kriteria Penilaian
                </h1>
                <p class="page-subtitle">Kelola kriteria penilaian untuk sistem evaluasi Anda</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('criteria.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Kriteria Baru
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
        <div class="alert-success">
            <div class="alert-content">
                <i class="fas fa-check-circle alert-icon"></i>
                <p class="alert-message">{{ session('success') }}</p>
                <button type="button" class="alert-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-icon indigo">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Kriteria</h4>
                        <p>{{ count($criteria) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-icon green">
                        <i class="fas fa-weight-hanging"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Bobot</h4>
                        <p>{{ number_format($criteria->sum('weight'), 2) }}%</p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-icon purple">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Status</h4>
                        <p class="{{ $criteria->sum('weight') == 100 ? 'green' : 'orange' }}">
                            {{ $criteria->sum('weight') == 100 ? 'Lengkap' : 'Perlu Review' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-section">
            <div class="search-controls">
                <div class="search-input-wrapper">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Cari kriteria..."
                           class="search-input">
                    <i class="fas fa-search search-icon"></i>
                </div>
                <div class="filter-controls">
                    <select class="filter-select" id="weightFilter">
                        <option value="">Semua Bobot</option>
                        <option value="0-25">0-25%</option>
                        <option value="26-50">26-50%</option>
                        <option value="51-75">51-75%</option>
                        <option value="76-100">76-100%</option>
                    </select>
                    <button class="filter-btn" onclick="resetFilters()">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="content-card">
            <div class="content-header">
                <h3 class="content-title">
                    <i class="fas fa-table"></i>
                    Daftar Kriteria Penilaian
                </h3>
            </div>

            @if(count($criteria) > 0)
                <!-- Desktop Table View -->
                <div class="desktop-table">
                    <table class="criteria-table" id="criteriaTable">
                        <thead class="table-header">
                            <tr>
                            <th>
                                    <div class="sort-header" onclick="sortTable(0)">
                                        <span>Kode Kriteria</span>
                                        <i class="fas fa-sort sort-icon"></i>
                                    </div>
                                </th>
                                <th>
                                    <div class="sort-header" onclick="sortTable(2)">
                                        <span>Nama Kriteria</span>
                                        <i class="fas fa-sort sort-icon"></i>
                                    </div>
                                </th>
                                <th>
                                    <div class="sort-header" onclick="sortTable(3)">
                                        <span>Bobot</span>
                                        <i class="fas fa-sort sort-icon"></i>
                                    </div>
                                </th>
                                <th>
                                    <div class="sort-header" onclick="sortTable(4)">
                                        <span>Type Kriteria</span>
                                        <i class="fas fa-sort sort-icon"></i>
                                    </div>
                                </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @foreach ($criteria as $index => $c)
                            <tr class="criteria-row">
                            <td>
                                    <div class="criteria-item">
                                        <div class="criteria-info">
                                            <h5 class="criteria-name">{{ $c->code }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="criteria-item">
                                        <div class="criteria-avatar">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="criteria-info">
                                            <h5 class="criteria-name">{{ $c->name }}</h5>
                                            <p>Kriteria Penilaian #{{ $c->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="weight-display">
                                        <div class="weight-info">
                                            <div class="weight-value">{{ $c->weight }}%</div>
                                            <div class="weight-bar">
                                                <div class="weight-progress" style="width: {{ $c->weight }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="weight-display">
                                        <div class="weight-info">
                                            <div class="weight-value">{{ $c->type }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('criteria.edit', $c) }}" class="btn-edit">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="{{ route('subcriterias.index', $c->id) }}" class="btn-subcriteria">
                                            <i class="fas fa-sitemap"></i>
                                            Sub
                                        </a>
                                        <form action="{{ route('criteria.destroy', $c) }}" method="POST" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="button" 
                                                    onclick="confirmDelete(this)"
                                                    class="btn-delete">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="mobile-cards">
                    @foreach ($criteria as $index => $c)
                    <div class="criteria-card">
                        <div class="card-header">
                            <div style="display: flex; align-items: center;">
                                <div class="card-avatar">
                                    {{ $index + 1 }}
                                </div>
                                <div class="card-info">
                                    <h4>{{ $c->name }}</h4>
                                    <p>Kriteria Penilaian #{{ $c->id }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-weight">
                            <div class="weight-header">
                                <span class="weight-label">Bobot Kriteria</span>
                                <span class="weight-value-large">{{ number_format($c->weight * 100, 2) }}%</span> {{-- Menampilkan 0.75 sebagai 0.75 --}}
                            </div>
                            <div class="weight-bar-large">
                            <div class="weight-progress" style="width: {{ $c->weight * 100 }}%"></div> {{-- Dikonversi jadi persen di CSS --}}
                            </div>
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('criteria.edit', $c) }}" class="btn-edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <a href="{{ route('subcriterias.index', $c->id) }}" class="btn-subcriteria">
                                <i class="fas fa-sitemap"></i>
                                Sub Kriteria
                            </a>
                            <form action="{{ route('criteria.destroy', $c) }}" method="POST" style="flex: 1;">
                                @csrf @method('DELETE')
                                <button type="button" 
                                        onclick="confirmDelete(this)"
                                        class="btn-delete"
                                        style="width: 100%;">
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="empty-title">Belum Ada Kriteria</h3>
                    <p class="empty-description">
                        Mulai dengan menambahkan kriteria penilaian pertama Anda untuk sistem evaluasi.
                    </p>
                    <a href="{{ route('criteria.create') }}" class="btn-primary">
                        <i class="fas fa-plus"></i>
                        Tambah Kriteria Pertama
                    </a>
                </div>
            @endif
        </div>

        <!-- Progress Section -->
        @if(count($criteria) > 0)
    <div class="progress-section">
        <div class="progress-header">
            <h3 class="progress-title">Progress Bobot Kriteria</h3>
            @php
                $totalWeight = $criteria->sum('weight'); // Sudah dalam format desimal (0.75, 1.00)
                $percentage = $totalWeight * 100;
            @endphp
            <div class="progress-value {{ $totalWeight == 1 ? 'complete' : ($totalWeight > 1 ? 'over' : 'incomplete') }}">
                {{ number_format($totalWeight, 2) }}
            </div>
        </div>
        
        <div class="total-progress-bar">
            <div class="total-progress-fill {{ $totalWeight == 1 ? 'complete' : ($totalWeight > 1 ? 'over' : 'incomplete') }}" 
                 style="width: {{ min($percentage, 100) }}%">
            </div>
        </div>
        
        <p class="progress-description">
            @if($totalWeight == 1)
                Sempurna! Total bobot kriteria sudah mencapai 1.00.
            @elseif($totalWeight > 1)
                Perhatian! Total bobot melebihi 1.00. Silakan sesuaikan bobot kriteria.
            @else
                Masih tersisa {{ number_format(1 - $totalWeight, 2) }} untuk mencapai total bobot 1.00.
            @endif
        </p>
    </div>
@endif

    </div>
</div>

<style>
/* ===== MODERN CRITERIA MANAGEMENT STYLES ===== */

/* Base Styles & Reset */
* {
    box-sizing: border-box;
}

body {
    font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #374151;
}

/* Container & Layout */
.criteria-container {
    min-height: 100vh;
    padding: 2rem 0;
}

.main-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Header Section */
.page-header {
    margin-bottom: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.page-title i {
    color: #4f46e5;
    font-size: 2rem;
}

.page-subtitle {
    color: #6b7280;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
}

.header-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

/* Buttons */
.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    color: white;
    text-decoration: none;
    border-radius: 0.75rem;
    font-weight: 600;
    font-size: 0.95rem;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
    text-decoration: none;
    color: white;
}

.btn-primary i {
    transition: transform 0.3s ease;
}

.btn-primary:hover i {
    transform: rotate(90deg);
}

/* Action Buttons */
.btn-edit {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.5rem 0.875rem;
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fbbf24;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-edit:hover {
    background: #fde68a;
    transform: scale(1.05);
    text-decoration: none;
    color: #92400e;
}

.btn-subcriteria {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.5rem 0.875rem;
    background: #dbeafe;
    color: #1e40af;
    border: 1px solid #60a5fa;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-subcriteria:hover {
    background: #bfdbfe;
    transform: scale(1.05);
    text-decoration: none;
    color: #1e40af;
}

.btn-delete {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.5rem 0.875rem;
    background: #fee2e2;
    color: #dc2626;
    border: 1px solid #f87171;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-delete:hover {
    background: #fecaca;
    transform: scale(1.05);
}

/* Success Alert */
.alert-success {
    padding: 1rem 1.5rem;
    background: #ecfdf5;
    border: 1px solid #86efac;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 10px rgba(34, 197, 94, 0.1);
    animation: slideIn 0.5s ease-out;
}

.alert-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.alert-icon {
    color: #16a34a;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.alert-message {
    color: #15803d;
    font-weight: 500;
    flex: 1;
}

.alert-close {
    color: #16a34a;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    padding: 0.25rem;
    border-radius: 0.25rem;
    transition: all 0.2s ease;
}

.alert-close:hover {
    background: #dcfce7;
    color: #15803d;
}

/* Statistics Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: inset 0 4px 20px 10px rgba(0, 0, 0, 0.08);
    border: 1px solid #f3f4f6;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.stat-content {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    padding: 1rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.stat-icon.indigo {
    background: #eef2ff;
    color: #4f46e5;
}

.stat-icon.green {
    background: #f0fdf4;
    color: #16a34a;
}

.stat-icon.purple {
    background: #f3e8ff;
    color: #7c2d12;
}

.stat-info h4 {
    color: #6b7280;
    font-size: 0.875rem;
    font-weight: 500;
    margin: 0 0 0.25rem 0;
}

.stat-info p {
    color: #1f2937;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
}

.stat-info p.green {
    color: #16a34a;
}

.stat-info p.orange {
    color: #ea580c;
}

/* Search and Filter Section */
.search-section {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f3f4f6;
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.search-controls {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.search-input-wrapper {
    flex: 1;
    min-width: 280px;
    position: relative;
}

.search-input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 3rem;
    border: 1px solid #d1d5db;
    border-radius: 0.75rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
}

.search-input:focus {
    outline: none;
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    background: white;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 1rem;
}

.filter-controls {
    display: flex;
    gap: 0.5rem;
}

.filter-select {
    padding: 0.875rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.75rem;
    font-size: 1rem;
    background: #fafafa;
    transition: all 0.3s ease;
    min-width: 140px;
}

.filter-select:focus {
    outline: none;
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    background: white;
}

.filter-btn {
    padding: 0.875rem 1rem;
    background: #f3f4f6;
    border: 1px solid #d1d5db;
    border-radius: 0.75rem;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #6b7280;
}

.filter-btn:hover {
    background: #e5e7eb;
    color: #374151;
}

/* Main Content Card */
.content-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f3f4f6;
    overflow: hidden;
    margin-bottom: 2rem;
}

.content-header {
    padding: 1.5rem;
    background: linear-gradient(135deg, #eef2ff 0%, #f3e8ff 100%);
    border-bottom: 1px solid #f3f4f6;
}

.content-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1f2937;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
}

.content-title i {
    color: #4f46e5;
}

/* Table Styles */
.criteria-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.table-header {
    background: #f9fafb;
}

.table-header th {
    padding: 1rem 1.5rem;
    text-align: left;
    font-size: 0.75rem;
    font-weight: 500;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #e5e7eb;
}

.table-header th:last-child {
    text-align: center;
}

.sort-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: color 0.2s ease;
}

.sort-header:hover {
    color: #374151;
}

.sort-icon {
    color: #9ca3af;
    transition: all 0.2s ease;
}

.sort-header:hover .sort-icon {
    color: #6b7280;
    transform: scale(1.1);
}

/* Table Body */
.table-body {
    background: white;
}

.criteria-row {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f3f4f6;
}

.criteria-row:hover {
    background: #f9fafb;
    transform: translateX(4px);
}

.criteria-row:last-child {
    border-bottom: none;
}

.criteria-row td {
    padding: 1.5rem;
    vertical-align: middle;
}

/* Criteria Item */
.criteria-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.criteria-avatar {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.criteria-info h5 {
    font-size: 1rem;
    font-weight: 500;
    color: #1f2937;
    margin: 0 0 0.25rem 0;
}

.criteria-info p {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 0;
}

/* Weight Display */
.weight-display {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.weight-info {
    flex: 1;
}

.weight-value {
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.weight-bar {
    width: 100%;
    height: 0.5rem;
    background: #e5e7eb;
    border-radius: 0.25rem;
    overflow: hidden;
}

.weight-progress {
    height: 100%;
    min-width: 1%;
    background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 100%);
    border-radius: 0.25rem;
    transition: width 0.8s ease;
}

/* Action Buttons Container */
.action-buttons {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

/* Mobile Card View */
.mobile-cards {
    display: none;
}

.criteria-card {
    padding: 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    transition: all 0.3s ease;
}

.criteria-card:last-child {
    border-bottom: none;
}

.criteria-card:hover {
    background: #f9fafb;
}

.card-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.card-avatar {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    margin-right: 1rem;
    flex-shrink: 0;
}

.card-info h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 0.25rem 0;
}

.card-info p {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 0;
}

.card-weight {
    margin-bottom: 1rem;
}

.weight-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.5rem;
}

.weight-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6b7280;
}

.weight-value-large {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1f2937;
}

.weight-bar-large {
    width: 100%;
    height: 0.75rem;
    background: #e5e7eb;
    border-radius: 0.375rem;
    overflow: hidden;
}

.card-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.card-actions .btn-edit,
.card-actions .btn-subcriteria,
.card-actions .btn-delete {
    flex: 1;
    min-width: 0;
    justify-content: center;
    white-space: nowrap;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon {
    margin: 0 auto 1rem auto;
    width: 6rem;
    height: 6rem;
    color: #d1d5db;
    font-size: 4rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-title {
    font-size: 1.25rem;
    font-weight: 500;
    color: #1f2937;
    margin-bottom: 0.5rem;
}

.empty-description {
    color: #6b7280;
    margin-bottom: 1.5rem;
}

/* Progress Section */
.progress-section {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #f3f4f6;
    padding: 1.5rem;
    margin-top: 2rem;
}

.progress-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.progress-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
}

.progress-value {
    font-size: 1.5rem;
    font-weight: 700;
}

.progress-value.complete {
    color: #16a34a;
}

.progress-value.over {
    color: #dc2626;
}

.progress-value.incomplete {
    color: #ea580c;
}

.total-progress-bar {
    width: 100%;
    height: 1rem;
    background: #e5e7eb;
    border-radius: 0.5rem;
    overflow: hidden;
    margin-bottom: 0.75rem;
}

.total-progress-fill {
    height: 100%;
    border-radius: 0.5rem;
    transition: width 0.8s ease;
}

.total-progress-fill.complete {
    background: #16a34a;
}

.total-progress-fill.over {
    background: #dc2626;
}

.total-progress-fill.incomplete {
    background: #ea580c;
}

.progress-description {
    font-size: 0.875rem;
    color: #6b7280;
}

/* Animations */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-1rem);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(1rem);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in {
    animation: fadeIn 0.6s ease-out;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .desktop-table {
        display: none;
    }
    
    .mobile-cards {
        display: block;
    }
    
    .page-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .header-actions {
        justify-content: stretch;
    }
    
    .btn-primary {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .main-container {
        padding: 0 0.75rem;
    }
    
    .page-title {
        font-size: 2rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .search-controls {
        flex-direction: column;
    }
    
    .search-input-wrapper {
        min-width: unset;
    }
    
    .filter-controls {
        justify-content: stretch;
    }
    
    .filter-select,
    .filter-btn {
        flex: 1;
    }
    
    .card-actions {
        grid-template-columns: 1fr;
    }
    
    .card-actions > * {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .criteria-container {
        padding: 1rem 0;
    }
    
    .page-title {
        font-size: 1.75rem;
    }
    
    .stat-card {
        padding: 1rem;
    }
    
    .stat-content {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    
    .criteria-card {
        padding: 1rem;
    }
    
    .card-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .card-actions {
        gap: 0.25rem;
    }
}
</style>
@endsection
<!-- JavaScript for Enhanced Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const weightFilter = document.getElementById('weightFilter');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            filterTable();
        });
    }
    
    if (weightFilter) {
        weightFilter.addEventListener('change', function() {
            filterTable();
        });
    }
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const weightRange = weightFilter.value;
        const rows = document.querySelectorAll('.criteria-row, .criteria-card');
        
        rows.forEach(row => {
            let showRow = true;
            
            // Search filter
            if (searchTerm) {
                const criteriaName = row.querySelector('.criteria-name, .card-info h4');
                if (criteriaName && !criteriaName.textContent.toLowerCase().includes(searchTerm)) {
                    showRow = false;
                }
            }
            
            // Weight filter
            if (weightRange && showRow) {
                const weightElement = row.querySelector('.weight-value, .weight-value-large');
                if (weightElement) {
                    const weight = parseInt(weightElement.textContent);
                    const [min, max] = weightRange.split('-').map(n => parseInt(n) || 0);
                    
                    if (weightRange === '76-100') {
                        if (weight < 76 || weight > 100) showRow = false;
                    } else if (weight < min || weight > max) {
                        showRow = false;
                    }
                }
            }
            
            row.style.display = showRow ? '' : 'none';
        });
    }
});

// Sort functionality
let sortDirection = {};

function sortTable(columnIndex) {
    const table = document.getElementById('criteriaTable');
    const tbody = table.querySelector('.table-body');
    const rows = Array.from(tbody.querySelectorAll('.criteria-row'));
    
    // Toggle sort direction
    sortDirection[columnIndex] = sortDirection[columnIndex] === 'asc' ? 'desc' : 'asc';
    
    rows.sort((a, b) => {
        let aValue, bValue;
        
        if (columnIndex === 0) {
            // Sort by name
            aValue = a.querySelector('.criteria-name').textContent.trim();
            bValue = b.querySelector('.criteria-name').textContent.trim();
        } else if (columnIndex === 1) {
            // Sort by weight
            aValue = parseInt(a.querySelector('.weight-value').textContent);
            bValue = parseInt(b.querySelector('.weight-value').textContent);
        }
        
        if (sortDirection[columnIndex] === 'asc') {
            return aValue > bValue ? 1 : -1;
        } else {
            return aValue < bValue ? 1 : -1;
        }
    });
    
    // Update sort icons
    document.querySelectorAll('.sort-icon').forEach(icon => {
        icon.className = 'fas fa-sort sort-icon';
    });
    
    const currentIcon = document.querySelectorAll('.sort-header')[columnIndex].querySelector('.sort-icon');
    currentIcon.className = sortDirection[columnIndex] === 'asc' ? 
        'fas fa-sort-up sort-icon' : 'fas fa-sort-down sort-icon';
    
    // Re-append sorted rows
    rows.forEach(row => tbody.appendChild(row));
}

// Reset filters
function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('weightFilter').value = '';
    
    // Show all rows
    document.querySelectorAll('.criteria-row, .criteria-card').forEach(row => {
        row.style.display = '';
    });
}

// Delete confirmation
function confirmDelete(button) {
    if (confirm('Apakah Anda yakin ingin menghapus kriteria ini? Tindakan ini tidak dapat dibatalkan.')) {
        const form = button.closest('form');
        if (form) {
            form.submit();
        }
    }
}

// Animate progress bars on load
document.addEventListener('DOMContentLoaded', function() {
    const progressBars = document.querySelectorAll('.weight-progress');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 100);
    });
    
    // Animate total progress bar
    const totalProgressBar = document.querySelector('.total-progress-fill');
    if (totalProgressBar) {
        const width = totalProgressBar.style.width;
        totalProgressBar.style.width = '0%';
        setTimeout(() => {
            totalProgressBar.style.width = width;
        }, 500);
    }
});

// Add loading states to buttons
document.querySelectorAll('.btn-primary, .btn-edit, .btn-subcriteria').forEach(btn => {
    btn.addEventListener('click', function() {
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        this.disabled = true;
        
        // Re-enable after navigation (fallback)
        setTimeout(() => {
            this.innerHTML = originalText;
            this.disabled = false;
        }, 3000);
    });
});

// Auto-hide success alerts
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert-success');
    alerts.forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-1rem)';
        setTimeout(() => {
            alert.remove();
        }, 300);
    });
}, 5000);
</script>
