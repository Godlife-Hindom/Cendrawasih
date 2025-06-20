@extends('layouts.admin-app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Kriteria</h1>
            <p class="text-gray-600">Perbarui informasi kriteria dengan mudah dan cepat</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Form Edit Kriteria
                </h2>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('criteria.update', $criterion) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Kode Kriteria -->
                    <div class="group mt-4">
                        <label for="code" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 00-8 0v4a4 4 0 008 0V7zM12 17v1m0 0v1m0-1h.01M12 17H9m3 0h3"></path>
                            </svg>
                            Kode Kriteria
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="code"
                                name="code" 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition-all duration-200 placeholder-gray-400 text-gray-700" 
                                value="{{ old('code', $criterion->code ?? '') }}" 
                                placeholder="Contoh: C1, C2, dst..."
                                required>
                        </div>
                        @error('code')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
    
                    <!-- Nama Kriteria Field -->
                    <div class="group">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Nama Kriteria
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="name"
                                name="name" 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 placeholder-gray-400 text-gray-700 group-hover:border-gray-300" 
                                value="{{ old('name', $criterion->name) }}" 
                                placeholder="Masukkan nama kriteria..."
                                required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Bobot Field -->
                    <div class="group">
                        <label for="weight" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                            </svg>
                            Bobot Kriteria
                        </label>
                        <div class="relative">
                            <input 
                                type="number" 
                                id="weight"
                                step="0.01" 
                                name="weight" 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-200 placeholder-gray-400 text-gray-700 group-hover:border-gray-300" 
                                value="{{ old('weight', $criterion->weight) }}" 
                                placeholder="0.00"
                                min="0"
                                max="1"
                                required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-400 text-sm font-medium">%</span>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            Masukkan nilai bobot antara 0.00 - 1.00
                        </p>
                        @error('weight')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Tipe Kriteria -->
                    <div class="group mt-4">
                        <label for="type" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3"></path>
                            </svg>
                            Tipe Kriteria
                        </label>
                        <div class="relative">
                            <select 
                                id="type"
                                name="type" 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-4 focus:ring-red-100 focus:border-red-500 transition-all duration-200 text-gray-700"
                                required>
                                <option value="" disabled {{ old('type', $criterion->type ?? '') == '' ? 'selected' : '' }}>Pilih tipe...</option>
                                <option value="Benefit" {{ old('type', $criterion->type ?? '') == 'Benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="Cost" {{ old('type', $criterion->type ?? '') == 'Cost' ? 'selected' : '' }}>Cost</option>
                            </select>
                        </div>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                        <button 
                            type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 hover:shadow-lg focus:ring-4 focus:ring-blue-200 focus:outline-none flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            Update Kriteria
                        </button>
                        
                        <a 
                            href="{{ route('criteria.index') }}" 
                            class="flex-1 sm:flex-initial bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 focus:ring-4 focus:ring-gray-200 focus:outline-none flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <!-- Tips Card -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-blue-800 mb-2">Tips Pengisian</h3>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li>• Nama kriteria harus jelas dan deskriptif</li>
                            <li>• Bobot berkisar antara 0.00 hingga 1.00</li>
                            <li>• Pastikan total semua bobot = 1.00</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-green-800 mb-2">Status Kriteria</h3>
                        <div class="text-sm text-green-700">
                            <p><strong>Nama:</strong> {{ $criterion->name }}</p>
                            <p><strong>Bobot Saat Ini:</strong> {{ $criterion->weight }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    /* ============================================
   COMPLETE CSS FOR EDIT CRITERIA FORM
   ============================================ */

/* Reset and Base Styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #374151;
    background-color: #f9fafb;
}

/* Main Container */
.min-h-screen {
    min-height: 100vh;
}

.bg-gradient-to-br {
    background: linear-gradient(to bottom right, #eff6ff, #ffffff, #eef2ff);
}

.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.mx-auto {
    margin-left: auto;
    margin-right: auto;
}

.max-w-4xl {
    max-width: 56rem;
}

.px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
}

.py-8 {
    padding-top: 2rem;
    padding-bottom: 2rem;
}

/* Header Section */
.text-center {
    text-align: center;
}

.mb-8 {
    margin-bottom: 2rem;
}

.mb-4 {
    margin-bottom: 1rem;
}

.mb-2 {
    margin-bottom: 0.5rem;
}

.inline-flex {
    display: inline-flex;
}

.items-center {
    align-items: center;
}

.justify-center {
    justify-content: center;
}

.w-16 {
    width: 4rem;
}

.h-16 {
    height: 4rem;
}

.w-8 {
    width: 2rem;
}

.h-8 {
    height: 2rem;
}

.w-6 {
    width: 1.5rem;
}

.h-6 {
    height: 1.5rem;
}

.w-5 {
    width: 1.25rem;
}

.h-5 {
    height: 1.25rem;
}

.w-4 {
    width: 1rem;
}

.h-4 {
    height: 1rem;
}

.w-3 {
    width: 0.75rem;
}

.h-3 {
    height: 0.75rem;
}

.bg-gradient-to-r {
    background: linear-gradient(to right, #3b82f6, #6366f1);
}

.from-blue-500 {
    --tw-gradient-from: #3b82f6;
}

.to-indigo-600 {
    --tw-gradient-to: #4f46e5;
}

.rounded-full {
    border-radius: 9999px;
}

.shadow-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.text-white {
    color: #ffffff;
}

.text-3xl {
    font-size: 1.875rem;
    line-height: 2.25rem;
}

.font-bold {
    font-weight: 700;
}

.text-gray-800 {
    color: #1f2937;
}

.text-gray-600 {
    color: #4b5563;
}

.text-gray-700 {
    color: #374151;
}

.text-gray-400 {
    color: #9ca3af;
}

.text-gray-500 {
    color: #6b7280;
}

/* Main Form Card */
.bg-white {
    background-color: #ffffff;
}

.rounded-2xl {
    border-radius: 1rem;
}

.shadow-xl {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.overflow-hidden {
    overflow: hidden;
}

/* Card Header */
.px-8 {
    padding-left: 2rem;
    padding-right: 2rem;
}

.py-6 {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.text-xl {
    font-size: 1.25rem;
    line-height: 1.75rem;
}

.font-semibold {
    font-weight: 600;
}

.flex {
    display: flex;
}

.mr-3 {
    margin-right: 0.75rem;
}

.mr-2 {
    margin-right: 0.5rem;
}

.mr-1 {
    margin-right: 0.25rem;
}

.ml-3 {
    margin-left: 0.75rem;
}

.ml-1 {
    margin-left: 0.25rem;
}

/* Form Content */
.p-8 {
    padding: 2rem;
}

.p-6 {
    padding: 1.5rem;
}

.p-4 {
    padding: 1rem;
}

/* Error Messages */
.mb-6 {
    margin-bottom: 1.5rem;
}

.bg-red-50 {
    background-color: #fef2f2;
}

.border-l-4 {
    border-left-width: 4px;
}

.border-red-400 {
    border-color: #f87171;
}

.rounded-r-lg {
    border-top-right-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}

.flex-shrink-0 {
    flex-shrink: 0;
}

.text-red-400 {
    color: #f87171;
}

.text-red-800 {
    color: #991b1b;
}

.text-red-700 {
    color: #b91c1c;
}

.text-red-600 {
    color: #dc2626;
}

.text-sm {
    font-size: 0.875rem;
    line-height: 1.25rem;
}

.text-xs {
    font-size: 0.75rem;
    line-height: 1rem;
}

.font-medium {
    font-weight: 500;
}

.mt-2 {
    margin-top: 0.5rem;
}

.mt-1 {
    margin-top: 0.25rem;
}

.list-disc {
    list-style-type: disc;
}

.list-inside {
    list-style-position: inside;
}

/* Form Styles */
.space-y-6 > :not([hidden]) ~ :not([hidden]) {
    margin-top: 1.5rem;
}

.space-y-1 > :not([hidden]) ~ :not([hidden]) {
    margin-top: 0.25rem;
}

.group {
    position: relative;
}

.block {
    display: block;
}

.text-blue-500 {
    color: #3b82f6;
}

.text-green-500 {
    color: #10b981;
}

.text-blue-800 {
    color: #1e40af;
}

.text-blue-700 {
    color: #1d4ed8;
}

.text-green-800 {
    color: #065f46;
}

.text-green-700 {
    color: #047857;
}

/* Input Styles */
.relative {
    position: relative;
}

.w-full {
    width: 100%;
}

.px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
}

.py-3 {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
}

.border-2 {
    border-width: 2px;
}

.border {
    border-width: 1px;
}

.border-gray-200 {
    border-color: #e5e7eb;
}

.border-gray-100 {
    border-color: #f3f4f6;
}

.border-blue-200 {
    border-color: #bfdbfe;
}

.border-green-200 {
    border-color: #bbf7d0;
}

.border-red-300 {
    border-color: #fca5a5;
}

.rounded-lg {
    border-radius: 0.5rem;
}

.rounded-xl {
    border-radius: 0.75rem;
}

.focus\:ring-4:focus {
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

.focus\:ring-blue-100:focus {
    --tw-ring-color: #dbeafe;
}

.focus\:ring-blue-200:focus {
    --tw-ring-color: #bfdbfe;
}

.focus\:ring-gray-200:focus {
    --tw-ring-color: #e5e7eb;
}

.focus\:ring-red-200:focus {
    --tw-ring-color: #fecaca;
}

.focus\:border-blue-500:focus {
    border-color: #3b82f6;
}

.focus\:border-red-500:focus {
    border-color: #ef4444;
}

.focus\:outline-none:focus {
    outline: 2px solid transparent;
    outline-offset: 2px;
}

.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

.duration-200 {
    transition-duration: 200ms;
}

.placeholder-gray-400::placeholder {
    color: #9ca3af;
}

.absolute {
    position: absolute;
}

.inset-y-0 {
    top: 0;
    bottom: 0;
}

.right-0 {
    right: 0;
}

.pr-3 {
    padding-right: 0.75rem;
}

.pointer-events-none {
    pointer-events: none;
}

/* Hover Effects */
.group:hover .group-hover\:border-gray-300 {
    border-color: #d1d5db;
}

.hover\:from-blue-600:hover {
    --tw-gradient-from: #2563eb;
}

.hover\:to-indigo-700:hover {
    --tw-gradient-to: #4338ca;
}

.hover\:bg-gray-200:hover {
    background-color: #e5e7eb;
}

.hover\:scale-105:hover {
    transform: scale(1.05);
}

.hover\:shadow-lg:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.transform {
    transform: translate(var(--tw-translate-x), var(--tw-translate-y)) 
               rotate(var(--tw-rotate)) 
               skewX(var(--tw-skew-x)) 
               skewY(var(--tw-skew-y)) 
               scaleX(var(--tw-scale-x)) 
               scaleY(var(--tw-scale-y));
}

/* Button Styles */
.flex-col {
    flex-direction: column;
}

.gap-4 {
    gap: 1rem;
}

.gap-6 {
    gap: 1.5rem;
}

.pt-6 {
    padding-top: 1.5rem;
}

.border-t {
    border-top-width: 1px;
}

.flex-1 {
    flex: 1 1 0%;
}

.bg-gray-100 {
    background-color: #f3f4f6;
}

.bg-blue-50 {
    background-color: #eff6ff;
}

.bg-green-50 {
    background-color: #f0fdf4;
}

.justify-center {
    justify-content: center;
}

/* Grid Styles */
.grid {
    display: grid;
}

.grid-cols-1 {
    grid-template-columns: repeat(1, minmax(0, 1fr));
}

.mt-8 {
    margin-top: 2rem;
}

.items-start {
    align-items: flex-start;
}

/* Custom Animations */
.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { 
        opacity: 0; 
        transform: translateY(10px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

/* Focus Styles */
input:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
}

/* Custom Input Styles */
input[type="text"],
input[type="number"] {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: textfield;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Button Hover Effects */
button:hover,
a:hover {
    cursor: pointer;
}

/* Responsive Design */
@media (min-width: 640px) {
    .sm\:flex-row {
        flex-direction: row;
    }
    
    .sm\:flex-initial {
        flex: initial;
    }
}

@media (min-width: 768px) {
    .md\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (min-width: 1024px) {
    .container {
        padding: 0 2rem;
    }
}

/* Error State Styles */
.border-red-300 {
    border-color: #fca5a5;
}

.focus\:border-red-500:focus {
    border-color: #ef4444;
}

.focus\:ring-red-200:focus {
    --tw-ring-color: #fecaca;
}

/* Loading States */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid #3b82f6;
    border-top-color: transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* Additional Interactive Elements */
.interactive-element {
    transition: all 0.2s ease-in-out;
}

.interactive-element:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Success States */
.success {
    background-color: #f0fdf4;
    border-color: #10b981;
    color: #065f46;
}

/* Print Styles */
@media print {
    .bg-gradient-to-br,
    .bg-gradient-to-r {
        background: #ffffff !important;
        color: #000000 !important;
    }
    
    .shadow-xl,
    .shadow-lg {
        box-shadow: none !important;
    }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
    .dark\:bg-gray-800 {
        background-color: #1f2937;
    }
    
    .dark\:text-white {
        color: #ffffff;
    }
    
    .dark\:border-gray-600 {
        border-color: #4b5563;
    }
}
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation class to main container
        document.querySelector('.container').classList.add('animate-fade-in');
        
        // Form validation
        const form = document.querySelector('form');
        const weightInput = document.querySelector('input[name="weight"]');
        
        form.addEventListener('submit', function(e) {
            const weight = parseFloat(weightInput.value);
            if (weight < 0 || weight > 1) {
                e.preventDefault();
                alert('Bobot harus berada dalam rentang 0.00 - 1.00');
                weightInput.focus();
            }
        });
        
        // Real-time validation for weight input
        weightInput.addEventListener('input', function() {
            const value = parseFloat(this.value);
            const parent = this.closest('.group');
            const existingError = parent.querySelector('.error-message');
            
            if (existingError) {
                existingError.remove();
            }
            
            if (value < 0 || value > 1) {
                const errorMsg = document.createElement('p');
                errorMsg.className = 'mt-1 text-sm text-red-600 flex items-center error-message';
                errorMsg.innerHTML = `
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Nilai bobot harus antara 0.00 - 1.00
                `;
                parent.appendChild(errorMsg);
                this.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-200');
            } else {
                this.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-200');
            }
        });
    });
</script>
@endpush
@endsection