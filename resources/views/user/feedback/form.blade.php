@extends('layouts.user-app')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3" style="width: 80px; height: 80px;">
            <i class="bi bi-chat-dots-fill text-primary fs-1"></i>
        </div>
        <h2 class="fw-bold text-dark mb-2">System Usability Scale</h2>
        <p class="text-muted fs-5">Bantu kami meningkatkan pengalaman Anda</p>
    </div>

    <!-- Instructions Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-start">
                <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3 flex-shrink-0">
                    <i class="bi bi-info-circle-fill text-info fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-semibold text-dark mb-2">Petunjuk Pengisian</h5>
                    <p class="text-muted mb-3">Pilih nilai dari <strong>1</strong> hingga <strong>5</strong> untuk setiap pernyataan berdasarkan pengalaman Anda:</p>
                    
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-danger rounded-pill me-2 fs-6">1</span>
                                <span class="text-muted">Sangat Tidak Setuju</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-warning rounded-pill me-2 fs-6">2</span>
                                <span class="text-muted">Tidak Setuju</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-secondary rounded-pill me-2 fs-6">3</span>
                                <span class="text-muted">Netral</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-info rounded-pill me-2 fs-6">4</span>
                                <span class="text-muted">Setuju</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success rounded-pill me-2 fs-6">5</span>
                                <span class="text-muted">Sangat Setuju</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('user.feedback.submit') }}" id="susForm">
                @csrf

                @php
                    $pertanyaanSUS = [
                        'Saya merasa akan sering menggunakan sistem ini.',
                        'Saya merasa sistem ini terlalu rumit.',
                        'Saya merasa sistem ini mudah digunakan.',
                        'Saya membutuhkan bantuan teknis untuk dapat menggunakan sistem ini.',
                        'Saya merasa fitur-fitur dalam sistem ini terintegrasi dengan baik.',
                        'Saya merasa sistem ini memiliki terlalu banyak inkonsistensi.',
                        'Saya membayangkan sebagian besar orang akan dapat belajar menggunakan sistem ini dengan cepat.',
                        'Saya merasa sistem ini terlalu membingungkan untuk digunakan.',
                        'Saya merasa percaya diri saat menggunakan sistem ini.',
                        'Saya perlu mempelajari banyak hal sebelum bisa menggunakan sistem ini.',
                    ];
                @endphp

                <div class="row">
                    @foreach ($pertanyaanSUS as $i => $q)
                        <div class="col-12 mb-4">
                            <div class="card border-light h-100 question-card" style="transition: all 0.3s ease;">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 40px; height: 40px;">
                                            <span class="fw-bold text-primary">{{ $i+1 }}</span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 fw-medium text-dark fs-6">{{ $q }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="rating-container">
                                        <!-- Custom Radio Button Rating -->
                                        <div class="d-flex justify-content-between align-items-center px-2">
                                            @for ($j = 1; $j <= 5; $j++)
                                                <div class="form-check form-check-inline mb-0">
                                                    <input class="form-check-input rating-input" type="radio" 
                                                           name="sus[{{ $i }}]" id="sus_{{ $i }}_{{ $j }}" 
                                                           value="{{ $j }}" required
                                                           style="transform: scale(1.3);">
                                                    <label class="form-check-label fw-semibold" for="sus_{{ $i }}_{{ $j }}"
                                                           style="margin-left: 8px;">
                                                        {{ $j }}
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                        
                                        <!-- Rating Labels -->
                                        <div class="d-flex justify-content-between mt-2 px-2">
                                            <small class="text-muted">Sangat Tidak Setuju</small>
                                            <small class="text-muted">Sangat Setuju</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Submit Button -->
                <div class="text-center pt-4 border-top">
                    <button type="submit" class="btn btn-success btn-lg px-5 py-3 rounded-pill shadow-sm" 
                            style="transition: all 0.3s ease; font-weight: 600;">
                        <i class="bi bi-send-fill me-2"></i>
                        Kirim Feedback
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Progress Indicator -->
    <div class="mt-4">
        <div class="card border-0 bg-light">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle text-muted me-2"></i>
                        <small class="text-muted">Progress: <span id="progressText">0/10</span> pertanyaan dijawab</small>
                    </div>
                    <div class="progress" style="width: 200px; height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" id="progressBar" 
                             style="width: 0%; transition: width 0.3s ease;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.question-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

.rating-input:checked {
    background-color: #198754;
    border-color: #198754;
}

.rating-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
}

.btn-success:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(25, 135, 84, 0.3);
}

.card {
    border-radius: 12px;
}

.badge {
    font-size: 0.75rem;
    padding: 0.5rem 0.75rem;
}

/* RESPONSIVE STYLES - TAMBAHAN UNTUK MOBILE */
@media (max-width: 768px) {
    /* Container padding untuk mobile */
    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    /* Header responsive */
    .text-center h2 {
        font-size: 1.5rem;
    }
    
    .text-center p.fs-5 {
        font-size: 1rem !important;
    }
    
    /* Card padding untuk mobile */
    .card-body {
        padding: 1.5rem !important;
    }
    
    /* Instructions card responsive */
    .d-flex.align-items-start {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .d-flex.align-items-start .bg-info {
        margin-bottom: 1rem;
        margin-right: 0;
    }
    
    /* Rating container mobile */
    .rating-container .d-flex:first-child {
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
        padding: 10px 0;
    }
    
    .form-check {
        margin-bottom: 10px;
    }
    
    /* Rating input lebih besar di mobile */
    .rating-input {
        transform: scale(1.5) !important;
        margin-right: 10px;
    }
    
    .form-check-label {
        font-size: 1.1rem;
        margin-left: 12px !important;
    }
    
    /* Rating labels mobile */
    .rating-container .d-flex:last-child {
        flex-direction: column;
        text-align: center;
        gap: 5px;
    }
    
    .rating-container .d-flex:last-child small:first-child {
        order: 1;
    }
    
    .rating-container .d-flex:last-child small:last-child {
        order: 2;
    }
    
    /* Question card mobile */
    .question-card .d-flex.align-items-start {
        flex-direction: row;
        align-items: flex-start;
        text-align: left;
    }
    
    .question-card .bg-primary {
        margin-right: 1rem;
        margin-bottom: 0;
    }
    
    /* Progress bar mobile */
    .progress {
        width: 100px !important;
        margin-top: 10px;
    }
    
    .d-flex.align-items-center.justify-content-between {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    /* Button responsive */
    .btn-lg {
        width: 100%;
        padding: 15px 20px !important;
        font-size: 1.1rem;
    }
    
    /* Icon header size mobile */
    .d-inline-flex[style*="width: 80px"] {
        width: 60px !important;
        height: 60px !important;
    }
    
    .bi-chat-dots-fill {
        font-size: 1.5rem !important;
    }
    
    /* Question number circle mobile */
    .bg-primary.rounded-circle[style*="width: 40px"] {
        width: 35px !important;
        height: 35px !important;
        font-size: 0.9rem;
    }
}

/* Extra small devices */
@media (max-width: 576px) {
    .container {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .card-body {
        padding: 1rem !important;
    }
    
    .py-5 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }
    
    .mb-5 {
        margin-bottom: 2rem !important;
    }
    
    /* Rating container extra small */
    .rating-container .d-flex:first-child {
        gap: 10px;
    }
    
    .rating-input {
        transform: scale(1.3) !important;
    }
    
    .form-check-label {
        font-size: 1rem;
        margin-left: 8px !important;
    }
    
    /* Instructions badges responsive */
    .row.g-2 {
        flex-direction: column;
    }
    
    .col-md-6 {
        margin-bottom: 1rem;
    }
    
    /* Text sizing */
    h5.fw-semibold {
        font-size: 1.1rem;
    }
    
    p.fw-medium {
        font-size: 0.95rem;
    }
}

/* Landscape orientation mobile */
@media (max-width: 896px) and (orientation: landscape) {
    .py-5 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }
    
    .mb-5 {
        margin-bottom: 1rem !important;
    }
    
    .mb-4 {
        margin-bottom: 1rem !important;
    }
}

/* PENAMBAHAN RESPONSIVE YANG LEBIH BAIK UNTUK MOBILE */

/* Optimasi untuk layar sangat kecil (iPhone SE, dll) */
@media (max-width: 375px) {
    .container {
        padding-left: 8px;
        padding-right: 8px;
    }
    
    .text-center h2 {
        font-size: 1.3rem;
        line-height: 1.4;
    }
    
    .card-body {
        padding: 0.75rem !important;
    }
    
    /* Rating buttons spacing untuk layar kecil */
    .rating-container .d-flex:first-child {
        gap: 8px;
        padding: 8px 0;
    }
    
    .form-check-label {
        font-size: 0.9rem;
        margin-left: 6px !important;
    }
    
    .rating-input {
        transform: scale(1.2) !important;
    }
    
    /* Badge size adjustment */
    .badge {
        font-size: 0.7rem;
        padding: 0.4rem 0.6rem;
    }
    
    /* Question text */
    p.fw-medium {
        font-size: 0.9rem;
        line-height: 1.4;
    }
}

/* Perbaikan untuk tablet portrait */
@media (min-width: 768px) and (max-width: 991px) {
    .container {
        max-width: 100%;
        padding-left: 20px;
        padding-right: 20px;
    }
    
    .rating-container .d-flex:first-child {
        justify-content: space-around;
        padding: 0 20px;
    }
    
    .form-check-label {
        font-size: 1rem;
    }
    
    .rating-input {
        transform: scale(1.4);
    }
}

/* Touch targets improvement untuk mobile */
@media (hover: none) and (pointer: coarse) {
    /* Larger touch targets */
    .form-check {
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .form-check-input {
        min-width: 24px;
        min-height: 24px;
    }
    
    .form-check-label {
        cursor: pointer;
        padding: 8px;
        min-height: 44px;
        display: flex;
        align-items: center;
    }
    
    /* Better button interaction */
    .btn {
        min-height: 48px;
        font-size: 1.1rem;
    }
    
    /* Remove hover effects on touch devices */
    .question-card:hover {
        transform: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
    }
    
    .btn-success:hover {
        transform: none;
    }
}

/* High DPI displays optimization */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .rating-input {
        border-width: 1px;
    }
    
    .card {
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }
}

/* Dark mode support untuk devices yang support */
@media (prefers-color-scheme: dark) {
    .bg-light {
        background-color: #f8f9fa !important;
    }
}

/* Reduce motion untuk users yang prefer reduced motion */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
    
    .question-card {
        transition: none !important;
    }
    
    .btn {
        transition: none !important;
    }
}

/* Perbaikan spacing dan alignment */
@media (max-width: 480px) {
    /* Question number circle adjustment */
    .question-card .d-flex.align-items-start .bg-primary {
        width: 30px !important;
        height: 30px !important;
        font-size: 0.8rem;
        margin-right: 0.75rem;
        flex-shrink: 0;
    }
    
    /* Better text wrapping */
    .flex-grow-1 p {
        word-wrap: break-word;
        hyphens: auto;
    }
    
    /* Instructions card better mobile layout */
    .d-flex.align-items-start:not(.question-card .d-flex) .bg-info {
        width: 40px;
        height: 40px;
        margin-bottom: 0.75rem;
    }
    
    /* Progress indicator mobile */
    .progress {
        width: 80px !important;
        height: 6px;
    }
    
    #progressText {
        font-size: 0.8rem;
    }
    
    /* Submit button area */
    .text-center.pt-4 {
        padding-top: 1.5rem !important;
    }
}

/* Orientation change handling */
@media (max-height: 500px) and (orientation: landscape) {
    .py-5 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }
    
    .mb-5, .mb-4 {
        margin-bottom: 0.5rem !important;
    }
    
    .card-body {
        padding: 1rem !important;
    }
    
    .text-center h2 {
        font-size: 1.2rem;
        margin-bottom: 0.5rem !important;
    }
}

/* Focus states untuk keyboard navigation */
@media (max-width: 768px) {
    .rating-input:focus {
        outline: 2px solid #198754;
        outline-offset: 2px;
    }
    
    .btn:focus {
        outline: 2px solid #198754;
        outline-offset: 2px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('susForm');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const totalQuestions = {{ count($pertanyaanSUS) }};
    
    function updateProgress() {
        const answeredQuestions = form.querySelectorAll('input[type="radio"]:checked').length;
        const percentage = (answeredQuestions / totalQuestions) * 100;
        
        progressBar.style.width = percentage + '%';
        progressText.textContent = answeredQuestions + '/' + totalQuestions;
        
        // Change progress bar color based on completion
        if (percentage === 100) {
            progressBar.classList.remove('bg-warning');
            progressBar.classList.add('bg-success');
        } else if (percentage > 0) {
            progressBar.classList.remove('bg-success');
            progressBar.classList.add('bg-warning');
        }
    }
    
    // Add event listeners to all radio buttons
    const radioButtons = form.querySelectorAll('input[type="radio"]');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', updateProgress);
    });
    
    // Form validation
    form.addEventListener('submit', function(e) {
        const answeredQuestions = form.querySelectorAll('input[type="radio"]:checked').length;
        
        if (answeredQuestions < totalQuestions) {
            e.preventDefault();
            alert('Mohon jawab semua pertanyaan sebelum mengirim feedback.');
            
            // Scroll to first unanswered question
            const firstUnanswered = form.querySelector('input[type="radio"]:not(:checked)');
            if (firstUnanswered) {
                firstUnanswered.closest('.question-card').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                firstUnanswered.closest('.question-card').style.border = '2px solid #dc3545';
                setTimeout(() => {
                    firstUnanswered.closest('.question-card').style.border = '';
                }, 3000);
            }
        }
    });
    
    // Initialize progress
    updateProgress();
});
</script>
@endsection