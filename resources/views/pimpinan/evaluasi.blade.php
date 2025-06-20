@extends('layouts.pimpinan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Animated Header Card -->
            <div class="card border-0 shadow-xl mb-4 header-card" style="border-radius: 25px;">
                <div class="card-header bg-gradient-primary text-black text-center py-5 position-relative overflow-hidden" style="border-radius: 25px 25px 0 0;">
                    <div class="floating-shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                    </div>
                    <div class="position-relative z-index-1">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-clipboard-check fa-3x"></i>
                        </div>
                        <h1 class="mb-3 fw-bold display-6">Evaluasi Laporan</h1>
                        <p class="mb-0 fs-5 opacity-90">Berikan penilaian dan persetujuan untuk laporan yang telah disubmit</p>
                        <div class="decorative-line mt-3"></div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="card border-0 shadow-xl main-card" style="border-radius: 25px;">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('pimpinan.submitEvaluasi', $report->id) }}" id="evaluationForm">
                        @csrf
                        
                        <!-- Report Info Section -->
                        <div class="report-info-section mb-5">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <div class="info-icon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6 class="fw-bold mb-1">Pelapor</h6>
                                            <p class="mb-0 text-muted">{{ $report->user->name ?? 'Tidak diketahui' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-card">
                                        <div class="info-icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6 class="fw-bold mb-1">Tanggal Submit</h6>
                                            <p class="mb-0 text-muted">{{ $report->created_at->format('d M Y H:i') ?? 'Tidak diketahui' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Evaluation Notes Section -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <div class="section-icon">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class="section-title">
                                    <h4 class="fw-bold mb-1">Catatan Evaluasi</h4>
                                    <p class="mb-0 text-muted">Berikan evaluasi yang detail dan konstruktif</p>
                                </div>
                            </div>
                            
                            <div class="textarea-wrapper">
                                <textarea 
                                    name="evaluation" 
                                    id="evaluation"
                                    class="form-control modern-textarea" 
                                    rows="6" 
                                    required
                                    placeholder="Masukkan catatan evaluasi yang detail dan konstruktif...&#10;&#10;Contoh:&#10;• Kualitas laporan secara keseluruhan&#10;• Kelengkapan data dan informasi&#10;• Saran perbaikan untuk laporan selanjutnya"
                                    maxlength="1000">{{ old('evaluation') }}</textarea>
                                <div class="textarea-footer">
                                    <div class="char-counter">
                                        <span id="charCount">0</span> / 1000 karakter
                                    </div>
                                    <div class="textarea-actions">
                                        <button type="button" class="btn-clear" onclick="clearTextarea()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Approval Section -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <div class="section-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="section-title">
                                    <h4 class="fw-bold mb-1">Status Persetujuan</h4>
                                    <p class="mb-0 text-muted">Pilih status persetujuan untuk laporan ini</p>
                                </div>
                            </div>
                            
                            <div class="approval-options">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="approval-card">
                                            <input 
                                                type="radio" 
                                                name="approval" 
                                                value="1" 
                                                id="approve"
                                                class="approval-radio"
                                                {{ old('approval') == '1' ? 'checked' : '' }}
                                            >
                                            <label for="approve" class="approval-label approve-option">
                                                <div class="approval-icon">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                                <div class="approval-content">
                                                    <h5 class="fw-bold mb-2">Disetujui</h5>
                                                    <p class="mb-0">Laporan memenuhi standar dan disetujui untuk diproses lebih lanjut</p>
                                                </div>
                                                <div class="approval-indicator">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="approval-card">
                                            <input 
                                                type="radio" 
                                                name="approval" 
                                                value="0" 
                                                id="reject"
                                                class="approval-radio"
                                                {{ old('approval') == '0' ? 'checked' : '' }}
                                            >
                                            <label for="reject" class="approval-label reject-option">
                                                <div class="approval-icon">
                                                    <i class="fas fa-times-circle"></i>
                                                </div>
                                                <div class="approval-content">
                                                    <h5 class="fw-bold mb-2">Tidak Disetujui</h5>
                                                    <p class="mb-0">Laporan perlu diperbaiki sebelum dapat disetujui</p>
                                                </div>
                                                <div class="approval-indicator">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions">
                            <div class="action-buttons">
                                <button type="button" class="btn btn-outline-secondary btn-lg me-3" onclick="history.back()">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg submit-btn">
                                    <i class="fas fa-save me-2"></i>
                                    <span class="btn-text">Simpan Evaluasi</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Success Message Card -->
            <div class="card border-0 shadow-sm mt-4 info-card-bottom" style="border-radius: 20px;">
                <div class="card-body bg-gradient-primary text-center py-4" style="border-radius: 20px;">
                    <div class="text-white">
                        <i class="fas fa-lightbulb me-2"></i>
                        <strong>Tips:</strong> Pastikan evaluasi yang diberikan objektif dan membantu untuk perbaikan di masa mendatang
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #a7f3d0 100%) !important;
}
/* Global Styles */
.z-index-1 { z-index: 1; }

/* Floating Shapes Animation */
.floating-shapes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    pointer-events: none;
}

.shape {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 60px;
    height: 60px;
    top: 60%;
    right: 20%;
    animation-delay: 2s;
}

.shape-3 {
    width: 40px;
    height: 40px;
    bottom: 30%;
    left: 60%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Header Card Styles */
.header-card {
    transform: translateY(0);
    transition: all 0.6s ease;
    animation: slideInFromTop 0.8s ease-out;
}

@keyframes slideInFromTop {
    0% { transform: translateY(-50px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

.icon-wrapper {
    display: inline-block;
    padding: 20px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    backdrop-filter: blur(10px);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.decorative-line {
    width: 100px;
    height: 4px;
    background: rgba(255, 255, 255, 0.3);
    margin: 0 auto;
    border-radius: 2px;
    position: relative;
    overflow: hidden;
}

.decorative-line::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Main Card Styles */
.main-card {
    animation: slideInFromBottom 0.8s ease-out 0.2s both;
}

@keyframes slideInFromBottom {
    0% { transform: translateY(50px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

/* Report Info Section */
.report-info-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 2rem;
}

.info-card {
    display: flex;
    align-items: center;
    padding: 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid rgba(102, 126, 234, 0.1);
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
}

.info-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 15px;
    font-size: 18px;
}

.info-content h6 {
    color: #333;
    margin-bottom: 5px;
}

.info-content p {
    color: #666;
    font-size: 14px;
}

/* Form Section Styles */
.form-section {
    padding: 30px;
    background: rgba(102, 126, 234, 0.02);
    border-radius: 20px;
    border: 1px solid rgba(102, 126, 234, 0.1);
    margin-bottom: 2rem;
}

.section-header {
    display: flex;
    align-items: center;
}

.section-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 20px;
    font-size: 20px;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.section-title h4 {
    color: #333;
    margin-bottom: 5px;
}

.section-title p {
    color: #666;
    margin-bottom: 0;
}

/* Modern Textarea Styles */
.textarea-wrapper {
    position: relative;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.textarea-wrapper:focus-within {
    border-color: #667eea;
    box-shadow: 0 5px 30px rgba(102, 126, 234, 0.2);
}

.modern-textarea {
    border: none;
    padding: 25px;
    font-size: 16px;
    line-height: 1.6;
    resize: vertical;
    min-height: 150px;
    background: transparent;
    border-radius: 0;
}

.modern-textarea:focus {
    box-shadow: none;
    border: none;
    outline: none;
}

.modern-textarea::placeholder {
    color: #adb5bd;
    opacity: 1;
}

.textarea-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 25px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.char-counter {
    font-size: 14px;
    color: #6c757d;
    font-weight: 500;
}

.char-counter.warning {
    color: #ffc107;
}

.char-counter.danger {
    color: #dc3545;
}

.btn-clear {
    background: none;
    border: none;
    color: #6c757d;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-clear:hover {
    background: #dc3545;
    color: white;
}

/* Approval Options Styles */
.approval-options {
    padding: 20px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.approval-card {
    height: 100%;
}

.approval-radio {
    display: none;
}

.approval-label {
    display: block;
    padding: 30px 25px;
    border: 2px solid #e9ecef;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.4s ease;
    background: white;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.approval-label::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.5s ease;
}

.approval-label:hover::before {
    left: 100%;
}

.approval-icon {
    text-align: center;
    margin-bottom: 20px;
}

.approval-icon i {
    font-size: 3rem;
    transition: all 0.3s ease;
}

.approval-content {
    text-align: center;
    position: relative;
    z-index: 1;
}

.approval-content h5 {
    margin-bottom: 15px;
    font-size: 1.3rem;
}

.approval-content p {
    color: #6c757d;
    font-size: 14px;
    line-height: 1.5;
}

.approval-indicator {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    opacity: 0;
}

/* Approve Option Styles */
.approve-option {
    border-color: #28a745;
    background: linear-gradient(135deg, #ffffff 0%, #f8fff9 100%);
}

.approve-option:hover {
    border-color: #28a745;
    background: linear-gradient(135deg, #f8fff9 0%, #e8f5e8 100%);
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(40, 167, 69, 0.2);
}

.approve-option .approval-icon i {
    color: #28a745;
}

.approval-radio:checked + .approve-option {
    border-color: #28a745;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    transform: scale(1.02);
    box-shadow: 0 15px 40px rgba(40, 167, 69, 0.4);
}

.approval-radio:checked + .approve-option .approval-icon i,
.approval-radio:checked + .approve-option .approval-content h5,
.approval-radio:checked + .approve-option .approval-content p {
    color: white;
}

.approval-radio:checked + .approve-option .approval-indicator {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    opacity: 1;
}

/* Reject Option Styles */
.reject-option {
    border-color: #dc3545;
    background: linear-gradient(135deg, #ffffff 0%, #fff8f8 100%);
}

.reject-option:hover {
    border-color: #dc3545;
    background: linear-gradient(135deg, #fff8f8 0%, #f8e8e8 100%);
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(220, 53, 69, 0.2);
}

.reject-option .approval-icon i {
    color: #dc3545;
}

.approval-radio:checked + .reject-option {
    border-color: #dc3545;
    background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
    color: white;
    transform: scale(1.02);
    box-shadow: 0 15px 40px rgba(220, 53, 69, 0.4);
}

.approval-radio:checked + .reject-option .approval-icon i,
.approval-radio:checked + .reject-option .approval-content h5,
.approval-radio:checked + .reject-option .approval-content p {
    color: white;
}

.approval-radio:checked + .reject-option .approval-indicator {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    opacity: 1;
}

/* Form Actions */
.form-actions {
    text-align: center;
    padding: 30px;
    background: rgba(102, 126, 234, 0.02);
    border-radius: 20px;
    margin-top: 2rem;
}

.action-buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.btn-lg {
    padding: 15px 40px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease;
    letter-spacing: 0.5px;
    border: 2px solid transparent;
}

.btn-outline-secondary {
    border-color: #6c757d;
    color: #6c757d;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    border-color: #6c757d;
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(108, 117, 125, 0.3);
}

.submit-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.submit-btn:hover::before {
    left: 100%;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
}

.submit-btn:active {
    transform: translateY(-1px);
}

.submit-btn.loading {
    opacity: 0.8;
    pointer-events: none;
}

.submit-btn.loading .btn-text {
    opacity: 0;
}

.submit-btn.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Info Card Bottom */
.info-card-bottom {
    animation: slideInFromBottom 0.8s ease-out 0.4s both;
}

/* Form Validation Styles */
.was-validated .modern-textarea:valid {
    border-color: #28a745;
}

.was-validated .modern-textarea:invalid {
    border-color: #dc3545;
}

.was-validated .textarea-wrapper:has(.modern-textarea:valid) {
    border-color: #28a745;
}

.was-validated .textarea-wrapper:has(.modern-textarea:invalid) {
    border-color: #dc3545;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 20px 10px;
    }
    
    .card-body {
        padding: 30px 20px !important;
    }
    
    .form-section {
        padding: 20px;
    }
    
    .section-header {
        flex-direction: column;
        text-align: center;
        margin-bottom: 20px;
    }
    
    .section-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .report-info-section {
        padding: 20px;
    }
    
    .info-card {
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .approval-label {
        padding: 20px 15px;
    }
    
    .approval-icon i {
        font-size: 2rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn-lg {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .floating-shapes {
        display: none;
    }
}

@media (max-width: 576px) {
    .display-6 {
        font-size: 1.5rem;
    }
    
    .card-header {
        padding: 30px 20px !important;
    }
    
    .approval-content h5 {
        font-size: 1.1rem;
    }
    
    .approval-content p {
        font-size: 13px;
    }
}

/* Smooth scrolling for the entire page */
html {
    scroll-behavior: smooth;
}

/* Focus styles for accessibility */
*:focus {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

.approval-radio:focus + .approval-label {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .floating-shapes,
    .btn,
    .form-actions {
        display: none !important;
    }
    
    .card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for textarea
    const textarea = document.getElementById('evaluation');
    const charCount = document.getElementById('charCount');
    const maxLength = 1000;
    
    function updateCharCount() {
        const count = textarea.value.length;
        charCount.textContent = count;
        
        // Remove existing classes
        charCount.classList.remove('warning', 'danger');
        
        if (count > maxLength * 0.9) {
            charCount.classList.add('danger');
        } else if (count > maxLength * 0.7) {
            charCount.classList.add('warning');
        }
        
        // Update progress visually
        const percentage = (count / maxLength) * 100;
        if (percentage > 90) {
            charCount.style.fontWeight = 'bold';
        } else {
            charCount.style.fontWeight = 'normal';
        }
    }
    
    textarea.addEventListener('input', updateCharCount);
    updateCharCount(); // Initial count
    
    // Clear textarea function
    window.clearTextarea = function() {
        if (confirm('Apakah Anda yakin ingin menghapus semua teks?')) {
            textarea.value = '';
            updateCharCount();
            textarea.focus();
        }
    };
    
    // Form submission with loading state
    const form = document.getElementById('evaluationForm');
    const submitBtn = form.querySelector('.submit-btn');
    const btnText = submitBtn.querySelector('.btn-text');
    
    form.addEventListener('submit', function(e) {
        // Validate form
        const evaluation = textarea.value.trim();
        const approval = form.querySelector('input[name="approval"]:checked');
        
        if (!evaluation || !approval) {
            e.preventDefault();
            
            // Show validation
            form.classList.add('was-validated');
            
            // Scroll to first error
            if (!evaluation) {
                textarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                textarea.focus();
            } else if (!approval) {
                document.querySelector('.approval-options').scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
    }
        
        // Add loading state
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        
        // Simulate processing time (remove this in production)
        setTimeout(() => {
            // In real implementation, the form will submit normally
            // This timeout is just for demonstration
        }, 1000);
    });
    
    // Enhanced approval option interactions
    const approvalRadios = document.querySelectorAll('.approval-radio');
    const approvalLabels = document.querySelectorAll('.approval-label');
    
    approvalRadios.forEach((radio, index) => {
        radio.addEventListener('change', function() {
            // Remove active state from all labels
            approvalLabels.forEach(label => {
                label.style.transform = '';
                label.style.boxShadow = '';
            });
            
            // Add active state to selected label
            if (this.checked) {
                const label = this.nextElementSibling;
                label.style.transform = 'scale(1.02)';
                
                // Add haptic feedback (if supported)
                if (navigator.vibrate) {
                    navigator.vibrate(50);
                }
                
                // Show success feedback
                showNotification('Status persetujuan telah dipilih', 'success');
            }
        });
    });
    
    // Auto-save functionality (optional)
    let autoSaveTimeout;
    const autoSaveDelay = 3000; // 3 seconds
    
    function autoSave() {
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        
        // Save to sessionStorage (fallback since localStorage is not available)
        try {
            sessionStorage.setItem('evaluation_draft', JSON.stringify(data));
            showNotification('Draft otomatis tersimpan', 'info', 2000);
        } catch (e) {
            console.log('Auto-save not available');
        }
    }
    
    function scheduleAutoSave() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(autoSave, autoSaveDelay);
    }
    
    // Listen for form changes
    textarea.addEventListener('input', scheduleAutoSave);
    approvalRadios.forEach(radio => {
        radio.addEventListener('change', scheduleAutoSave);
    });
    
    // Load draft on page load
    try {
        const savedDraft = sessionStorage.getItem('evaluation_draft');
        if (savedDraft) {
            const data = JSON.parse(savedDraft);
            if (data.evaluation && !textarea.value) {
                textarea.value = data.evaluation;
                updateCharCount();
            }
            if (data.approval) {
                const radio = document.querySelector(`input[name="approval"][value="${data.approval}"]`);
                if (radio && !document.querySelector('input[name="approval"]:checked')) {
                    radio.checked = true;
                }
            }
        }
    } catch (e) {
        console.log('No draft to restore');
    }
    
    // Enhanced keyboard navigation
    document.addEventListener('keydown', function(e) {
        // Alt + S to submit form
        if (e.altKey && e.key === 's') {
            e.preventDefault();
            submitBtn.click();
        }
        
        // Alt + C to clear textarea
        if (e.altKey && e.key === 'c') {
            e.preventDefault();
            clearTextarea();
        }
        
        // Escape to go back
        if (e.key === 'Escape') {
            if (confirm('Apakah Anda yakin ingin kembali? Perubahan yang belum disimpan akan hilang.')) {
                history.back();
            }
        }
    });
    
    // Notification system
    function showNotification(message, type = 'info', duration = 3000) {
        // Remove existing notifications
        const existingNotification = document.querySelector('.notification');
        if (existingNotification) {
            existingNotification.remove();
        }
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${getNotificationIcon(type)}"></i>
                <span>${message}</span>
            </div>
        `;
        
        // Add styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 15px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 500;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            transform: translateX(400px);
            transition: transform 0.3s ease;
            max-width: 300px;
            word-wrap: break-word;
        `;
        
        // Set background color based on type
        const colors = {
            success: '#28a745',
            error: '#dc3545',
            warning: '#ffc107',
            info: '#17a2b8'
        };
        notification.style.background = colors[type] || colors.info;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Auto remove
        setTimeout(() => {
            notification.style.transform = 'translateX(400px)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, duration);
        
        // Click to dismiss
        notification.addEventListener('click', () => {
            notification.style.transform = 'translateX(400px)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        });
    }
    
    function getNotificationIcon(type) {
        const icons = {
            success: 'check-circle',
            error: 'exclamation-circle',
            warning: 'exclamation-triangle',
            info: 'info-circle'
        };
        return icons[type] || icons.info;
    }
    
    // Form validation enhancement
    function validateForm() {
        const evaluation = textarea.value.trim();
        const approval = form.querySelector('input[name="approval"]:checked');
        let isValid = true;
        let errors = [];
        
        // Validate evaluation
        if (!evaluation) {
            errors.push('Catatan evaluasi harus diisi');
            isValid = false;
        } else if (evaluation.length < 10) {
            errors.push('Catatan evaluasi terlalu singkat (minimal 10 karakter)');
            isValid = false;
        }
        
        // Validate approval
        if (!approval) {
            errors.push('Status persetujuan harus dipilih');
            isValid = false;
        }
        
        return { isValid, errors };
    }
    
    // Real-time validation
    textarea.addEventListener('blur', function() {
        const validation = validateForm();
        if (!validation.isValid && this.value.trim()) {
            const error = validation.errors.find(err => err.includes('evaluasi'));
            if (error) {
                showNotification(error, 'warning');
            }
        }
    });
    
    // Prevent accidental page leave
    let formChanged = false;
    
    textarea.addEventListener('input', () => formChanged = true);
    approvalRadios.forEach(radio => {
        radio.addEventListener('change', () => formChanged = true);
    });
    
    window.addEventListener('beforeunload', function(e) {
        if (formChanged && !submitBtn.classList.contains('loading')) {
            e.preventDefault();
            e.returnValue = '';
            return '';
        }
    });
    
    // Form submitted successfully, clear the flag
    form.addEventListener('submit', function() {
        formChanged = false;
    });
    
    // Enhanced accessibility
    textarea.setAttribute('aria-describedby', 'charCount');
    
    // Add aria-labels for approval options
    document.getElementById('approve').setAttribute('aria-label', 'Setujui laporan');
    document.getElementById('reject').setAttribute('aria-label', 'Tolak laporan');
    
    // Smooth scroll to form sections
    function scrollToSection(selector) {
        const element = document.querySelector(selector);
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
    
    // Add keyboard shortcuts info
    const shortcutsInfo = document.createElement('div');
    shortcutsInfo.innerHTML = `
        <div class="keyboard-shortcuts" style="display: none; position: fixed; bottom: 20px; left: 20px; background: rgba(0,0,0,0.8); color: white; padding: 15px; border-radius: 10px; z-index: 1000; font-size: 12px;">
            <strong>Keyboard Shortcuts:</strong><br>
            Alt + S: Submit form<br>
            Alt + C: Clear textarea<br>
            Esc: Go back<br>
            F1: Show/hide this help
        </div>
    `;
    document.body.appendChild(shortcutsInfo);
    
    // Toggle shortcuts help with F1
    document.addEventListener('keydown', function(e) {
        if (e.key === 'F1') {
            e.preventDefault();
            const shortcuts = document.querySelector('.keyboard-shortcuts');
            shortcuts.style.display = shortcuts.style.display === 'none' ? 'block' : 'none';
        }
    });

    // Additional utility functions
function formatDateTime(date) {
    return new Intl.DateTimeFormat('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }).format(date);
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Export functions for potential external use
window.EvaluationForm = {
    showNotification,
    clearTextarea,
    validateForm,
    scrollToSection
};
    
    console.log('Evaluation form script loaded successfully');
});
</script>
@endsection
