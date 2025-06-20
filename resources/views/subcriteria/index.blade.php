@extends('layouts.admin-app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center space-x-4">
                    <div class="bg-white p-3 rounded-xl shadow-lg hover-lift">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-1">Subkriteria</h1>
                        <p class="text-lg text-gray-600">{{ $criteria->name ?? 'Data Kriteria' }}</p>
                    </div>
                </div>
                
                <a href="{{ route('subcriterias.create', $criteria->id ?? 1) }}" 
                   class="btn-primary no-print">
                    <svg class="w-5 h-5 mr-2 icon-rotate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Subkriteria
                </a>
            </div>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success animate-fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Error Alert -->
        @if(session('error'))
            <div class="alert alert-error animate-fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-red-700 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="stats-grid mb-8">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-label">Total Subkriteria</p>
                        <p class="stat-value">{{ $subcriterias->count() ?? 0 }}</p>
                    </div>
                    <div class="stat-icon bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-label">Rata-rata Nilai</p>
                        <p class="stat-value">
                            {{ $subcriterias->count() > 0 ? number_format($subcriterias->avg('score'), 1) : '0.0' }}
                        </p>
                    </div>
                    <div class="stat-icon bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-label">Nilai Tertinggi</p>
                        <p class="stat-value">{{ $subcriterias->max('score') ?? 0 }}</p>
                    </div>
                    <div class="stat-icon bg-purple-100">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="main-content-card">
            <div class="card-header">
                <h2 class="card-title">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 00-2 2v0a2 2 0 002 2h14a2 2 0 002-2v0a2 2 0 00-2-2"></path>
                    </svg>
                    Daftar Subkriteria
                </h2>
            </div>

            @if(isset($subcriterias) && $subcriterias->count() > 0)
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="table-header">
                                    <div class="header-content">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <span>Nama Subkriteria</span>
                                    </div>
                                </th>
                                <th class="table-header">
                                    <div class="header-content">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                                        </svg>
                                        <span>Rentang</span>
                                    </div>
                                </th>
                                <th class="table-header">
                                    <div class="header-content">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2-2V7a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 002 2h2a2 2 0 012-2V7a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 00-2 2h-2a2 2 0 00-2 2v6a2 2 0 01-2 2H9z"></path>
                                        </svg>
                                        <span>Nilai</span>
                                    </div>
                                </th>
                                <th class="table-header text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcriterias as $index => $sub)
                                <tr class="table-row">
                                    <td class="table-cell">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="row-number">
                                                    {{ $index + 1 }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="item-name">{{ $sub->name }}</div>
                                                @if(isset($sub->description))
                                                    <div class="item-description">{{ Str::limit($sub->description, 50) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-cell">
                                        <span class="range-badge">
                                            {{ $sub->range ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="table-cell">
                                        <div class="score-container">
                                            <span class="score-badge">
                                                {{ $sub->score ?? 0 }}
                                            </span>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: {{ (($sub->score ?? 0) / 10) * 100 }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-cell text-center">
                                        <div class="action-buttons">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('subcriterias.edit', ['criteria' => $criteria->id, 'subcriteria' => $sub->id]) }}"
                                               class="btn-edit">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('subcriterias.destroy', ['criteria' => $criteria->id, 'subcriteria' => $sub->id]) }}"
                                                method="POST" class="inline-block delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
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
            @else
                <div class="empty-state">
                    <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="empty-title">Belum ada subkriteria</h3>
                    <p class="empty-description">Mulai dengan menambahkan subkriteria pertama untuk kriteria ini.</p>
                    <a href="{{ route('subcriterias.create', $criteria->id ?? 1) }}" class="btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Subkriteria Pertama
                    </a>
                </div>
            @endif
        </div>

        <!-- Back Button -->
        <div class="mt-8 flex justify-start">
            <a href="{{ url()->previous() }}" class="btn-back">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>
</div>

<style>
    /* Reset dan Base Styles */
    * {
        box-sizing: border-box;
    }

    /* Container dan Layout */
    .page-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 50%, #f3e8ff 100%);
        padding: 2rem 0;
    }

    .main-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Header Section */
    .page-header {
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-icon-container {
        background: white;
        padding: 0.75rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .header-icon-container:hover {
        transform: translateY(-2px);
    }

    .header-icon {
        width: 2rem;
        height: 2rem;
        color: #4f46e5;
    }

    .header-text h1 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 0.25rem 0;
    }

    .header-text p {
        font-size: 1.125rem;
        color: #6b7280;
        margin: 0;
    }

    /* Button Styles */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #059669, #10b981);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
        margin-right: 0.5rem;
    }

    .btn-edit:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #dc2626, #ef4444);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        background: #f3f4f6;
        color: #374151;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        border: 1px solid #d1d5db;
    }

    .btn-back:hover {
        background: #e5e7eb;
        transform: translateY(-1px);
    }

    /* Alert Styles */
    .alert {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        animation: fadeIn 0.3s ease-in;
    }

    .alert-success {
        background-color: #d1fae5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    }

    .alert-error {
        background-color: #fee2e2;
        border: 1px solid #fca5a5;
        color: #991b1b;
    }

    .alert .flex {
        display: flex;
        align-items: center;
    }

    .alert svg {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.75rem;
        flex-shrink: 0;
    }

    /* Statistics Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
        border: 1px solid #e5e7eb;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .stat-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0 0 0.5rem 0;
        font-weight: 500;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .stat-icon {
        padding: 0.75rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon.bg-blue-100 {
        background-color: #dbeafe;
    }

    .stat-icon.bg-green-100 {
        background-color: #dcfce7;
    }

    .stat-icon.bg-purple-100 {
        background-color: #f3e8ff;
    }

    .stat-icon svg {
        width: 1.5rem;
        height: 1.5rem;
    }

    /* Main Content Card */
    .main-content-card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    .card-header {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        padding: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .card-title svg {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.5rem;
    }

    /* Table Styles */
    .table-container {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-header {
        background: #f8fafc;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 2px solid #e2e8f0;
        font-size: 0.875rem;
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .header-content svg {
        width: 1rem;
        height: 1rem;
        color: #6b7280;
    }

    .table-row {
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.2s ease;
    }

    .table-row:hover {
        background-color: #f8fafc;
    }

    .table-cell {
        padding: 1rem;
        vertical-align: middle;
    }

    .row-number {
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        color: white;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .item-name {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }

    .item-description {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .range-badge {
        background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
        color: #3730a3;
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-block;
    }

    .score-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .score-badge {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.875rem;
        min-width: 3rem;
        text-align: center;
    }

    .progress-bar {
        background: #e5e7eb;
        height: 0.5rem;
        border-radius: 0.25rem;
        overflow: hidden;
        flex: 1;
        max-width: 100px;
    }

    .progress-fill {
        background: linear-gradient(90deg, #10b981, #059669);
        height: 100%;
        transition: width 0.3s ease;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        width: 4rem;
        height: 4rem;
        color: #9ca3af;
        margin: 0 auto 1rem;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #374151;
        margin: 0 0 0.5rem 0;
    }

    .empty-description {
        color: #6b7280;
        margin: 0 0 2rem 0;
        font-size: 1rem;
    }

    /* Icon Sizes */
    svg {
        width: 1rem;
        height: 1rem;
        flex-shrink: 0;
    }

    .btn-primary svg,
    .btn-back svg {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.5rem;
    }

    .btn-edit svg,
    .btn-delete svg {
        width: 1rem;
        height: 1rem;
        margin-right: 0.25rem;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: stretch;
        }

        .header-left {
            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .table-container {
            border-radius: 0.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-edit,
        .btn-delete {
            margin-right: 0;
            margin-bottom: 0.5rem;
        }

        .score-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }

    /* Print Styles */
    @media print {
        .no-print {
            display: none !important;
        }
        
        .page-container {
            background: white;
        }
        
        .main-content-card {
            box-shadow: none;
            border: 1px solid #000;
        }
    }
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 500);
        }, 5000);
    });

    // Enhanced delete confirmation
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const result = confirm('⚠️ Apakah Anda yakin ingin menghapus subkriteria ini?\n\nTindakan ini tidak dapat dibatalkan.');
            
            if (result) {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `
                        <svg class="w-4 h-4 mr-1 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Menghapus...
                    `;
                }
                form.submit();
            }
        });
    });

    // Loading state for buttons
    const buttons = document.querySelectorAll('a[href], button');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.classList.contains('btn-primary') || this.classList.contains('btn-edit')) {
                this.classList.add('btn-loading');
                
                // Reset after 3 seconds if page hasn't changed
                setTimeout(() => {
                    this.classList.remove('btn-loading');
                }, 3000);
            }
        });
    });

    // Smooth scroll for back button
    const backButton = document.querySelector('.btn-back');
    if (backButton) {
        backButton.addEventListener('click', function(e) {
            // Add a subtle animation before navigation
            this.style.transform = 'translateX(-5px)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    }

    // Enhanced table row interactions
    const tableRows = document.querySelectorAll('.table-row');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(2px)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Progress bar animation on scroll
    const progressBars = document.querySelectorAll('.progress-fill');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const progressObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressFill = entry.target;
                const width = progressFill.style.width;
                progressFill.style.width = '0%';
                setTimeout(() => {
                    progressFill.style.width = width;
                }, 100);
            }
        });
    }, observerOptions);

    progressBars.forEach(bar => {
        progressObserver.observe(bar);
    });

    // Keyboard navigation enhancement
    document.addEventListener('keydown', function(e) {
        // ESC key to close modals or go back
        if (e.key === 'Escape') {
            const backButton = document.querySelector('.btn-back');
            if (backButton) {
                backButton.click();
            }
        }
        
        // Ctrl/Cmd + N for new subcriteria
        if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
            e.preventDefault();
            const addButton = document.querySelector('a[href*="create"]');
            if (addButton) {
                addButton.click();
            }
        }
    });

    // Enhanced accessibility
    const focusableElements = document.querySelectorAll('a, button, [tabindex]:not([tabindex="-1"])');
    focusableElements.forEach(element => {
        element.addEventListener('focus', function() {
            this.style.outline = '2px solid var(--primary-color)';
            this.style.outlineOffset = '2px';
        });
        
        element.addEventListener('blur', function() {
            this.style.outline = '';
            this.style.outlineOffset = '';
        });
    });

    // Performance optimization: Lazy load images if any
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('loading');
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Touch device optimizations
    if ('ontouchstart' in window) {
        document.body.classList.add('touch-device');
        
        // Enhanced touch feedback
        const touchElements = document.querySelectorAll('.btn-primary, .btn-edit, .btn-delete, .stat-card');
        touchElements.forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.98)';
            });
            
            element.addEventListener('touchend', function() {
                this.style.transform = '';
            });
        });
    }
});

// Service Worker registration for offline support (optional)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('SW registered: ', registration);
            })
            .catch(function(registrationError) {
                console.log('SW registration failed: ', registrationError);
            });
    });
}
</script>
@endpush