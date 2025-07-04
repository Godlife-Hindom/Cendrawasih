@extends('layouts.pimpinan')

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
            <form method="POST" action="{{ route('pimpinan.feedback.store') }}" id="susForm">
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

@media (max-width: 768px) {
    .rating-container .d-flex {
        flex-direction: column;
        gap: 10px;
    }
    
    .rating-container .d-flex:first-child {
        flex-direction: row;
        justify-content: space-around;
    }
}

/* RESPONSIVE MOBILE STYLING - ADDITIONS */
@media (max-width: 575.98px) {
    /* Container padding untuk mobile */
    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    /* Header section responsive */
    .text-center.mb-5 h2 {
        font-size: 1.5rem;
    }
    
    .text-center.mb-5 p {
        font-size: 1rem;
    }
    
    /* Instructions card mobile */
    .card-body {
        padding: 1rem !important;
    }
    
    .d-flex.align-items-start .me-3 {
        margin-right: 0.75rem !important;
    }
    
    /* Rating scale mobile - vertikal layout */
    .row.g-2 {
        gap: 0.5rem;
    }
    
    .col-md-6 {
        margin-bottom: 1rem;
    }
    
    /* Question cards mobile */
    .question-card .card-body {
        padding: 1rem !important;
    }
    
    .question-card .d-flex.align-items-start .me-3 {
        margin-right: 0.75rem !important;
        width: 30px;
        height: 30px;
        min-width: 30px;
        min-height: 30px;
    }
    
    .question-card .fw-medium {
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    /* Rating container mobile responsive */
    .rating-container .d-flex:first-child {
        justify-content: space-between;
        padding: 0.5rem 0;
    }
    
    .rating-container .form-check {
        margin-right: 0;
        margin-bottom: 0;
    }
    
    .rating-input {
        transform: scale(1.5) !important;
        margin-right: 0.25rem;
    }
    
    .form-check-label {
        margin-left: 0.5rem !important;
        font-size: 0.9rem;
    }
    
    /* Rating labels mobile */
    .rating-container .d-flex:last-child small {
        font-size: 0.7rem;
        text-align: center;
        flex: 1;
    }
    
    /* Submit button mobile */
    .btn-lg {
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
    
    /* Progress indicator mobile */
    .progress {
        width: 100px !important;
        height: 6px;
    }
    
    .card-body.p-3 {
        padding: 1rem !important;
    }
    
    .d-flex.align-items-center.justify-content-between {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    /* Badge sizing mobile */
    .badge {
        font-size: 0.7rem;
        padding: 0.35rem 0.6rem;
    }
    
    /* Icon sizing mobile */
    .bg-primary.bg-opacity-10 {
        width: 60px !important;
        height: 60px !important;
    }
    
    .bi-chat-dots-fill {
        font-size: 2rem !important;
    }
    
    .bg-info.bg-opacity-10 .bi-info-circle-fill {
        font-size: 1rem;
    }
}

/* Extra small mobile devices */
@media (max-width: 375px) {
    .container {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .question-card .card-body {
        padding: 0.75rem !important;
    }
    
    .rating-container .d-flex:first-child {
        gap: 0.25rem;
    }
    
    .rating-input {
        transform: scale(1.3) !important;
    }
    
    .form-check-label {
        font-size: 0.85rem;
    }
    
    .question-card .fw-medium {
        font-size: 0.85rem;
    }
    
    .rating-container .d-flex:last-child small {
        font-size: 0.65rem;
    }
}

/* Landscape orientation mobile */
@media (max-width: 768px) and (orientation: landscape) {
    .container {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
    
    .text-center.mb-5 {
        margin-bottom: 2rem !important;
    }
    
    .col-12.mb-4 {
        margin-bottom: 1.5rem !important;
    }
}

/* Touch-friendly improvements */
@media (hover: none) and (pointer: coarse) {
    .rating-input {
        transform: scale(1.8) !important;
    }
    
    .form-check-label {
        padding: 0.5rem;
        cursor: pointer;
    }
    
    .question-card {
        margin-bottom: 1rem;
    }
    
    .btn-success {
        min-height: 50px;
        touch-action: manipulation;
    }
}

/* ENHANCED RESPONSIVE IMPROVEMENTS - TAMBAHAN BARU */

/* Tablet Portrait (768px - 991px) */
@media (min-width: 768px) and (max-width: 991px) {
    .container {
        max-width: 720px;
        padding-left: 20px;
        padding-right: 20px;
    }
    
    .text-center.mb-5 h2 {
        font-size: 1.75rem;
    }
    
    .question-card .card-body {
        padding: 1.5rem !important;
    }
    
    .rating-input {
        transform: scale(1.4);
    }
    
    .btn-lg {
        padding: 1rem 2rem;
        font-size: 1.1rem;
    }
}

/* Mobile Large (480px - 575px) */
@media (min-width: 480px) and (max-width: 575px) {
    .container {
        padding-left: 20px;
        padding-right: 20px;
    }
    
    .text-center.mb-5 h2 {
        font-size: 1.6rem;
    }
    
    .question-card .d-flex.align-items-start .me-3 {
        width: 35px;
        height: 35px;
        min-width: 35px;
        min-height: 35px;
    }
    
    .question-card .fw-medium {
        font-size: 0.95rem;
        line-height: 1.5;
    }
    
    .rating-input {
        transform: scale(1.6) !important;
    }
    
    .form-check-label {
        font-size: 0.95rem;
        margin-left: 0.6rem !important;
    }
    
    .rating-container .d-flex:last-child small {
        font-size: 0.75rem;
    }
}

/* Mobile Medium (414px - 479px) */
@media (min-width: 414px) and (max-width: 479px) {
    .container {
        padding-left: 18px;
        padding-right: 18px;
    }
    
    .text-center.mb-5 h2 {
        font-size: 1.55rem;
    }
    
    .question-card .card-body {
        padding: 0.9rem !important;
    }
    
    .question-card .fw-medium {
        font-size: 0.9rem;
        line-height: 1.45;
    }
    
    .rating-input {
        transform: scale(1.55) !important;
    }
    
    .form-check-label {
        font-size: 0.9rem;
        margin-left: 0.55rem !important;
    }
    
    .rating-container .d-flex:last-child small {
        font-size: 0.72rem;
    }
}

/* Mobile Small (360px - 413px) */
@media (min-width: 360px) and (max-width: 413px) {
    .container {
        padding-left: 16px;
        padding-right: 16px;
    }
    
    .text-center.mb-5 h2 {
        font-size: 1.45rem;
        line-height: 1.3;
    }
    
    .text-center.mb-5 p {
        font-size: 0.95rem;
    }
    
    .question-card .card-body {
        padding: 0.85rem !important;
    }
    
    .question-card .d-flex.align-items-start .me-3 {
        width: 28px;
        height: 28px;
        min-width: 28px;
        min-height: 28px;
        margin-right: 0.6rem !important;
    }
    
    .question-card .fw-medium {
        font-size: 0.87rem;
        line-height: 1.4;
    }
    
    .rating-container .d-flex:first-child {
        justify-content: space-evenly;
        padding: 0.4rem 0;
    }
    
    .rating-input {
        transform: scale(1.4) !important;
    }
    
    .form-check-label {
        font-size: 0.87rem;
        margin-left: 0.4rem !important;
    }
    
    .rating-container .d-flex:last-child small {
        font-size: 0.68rem;
    }
    
    .btn-lg {
        padding: 0.8rem 1.2rem;
        font-size: 0.95rem;
    }
}

/* Mobile Extra Small (320px - 359px) */
@media (min-width: 320px) and (max-width: 359px) {
    .container {
        padding-left: 12px;
        padding-right: 12px;
    }
    
    .text-center.mb-5 h2 {
        font-size: 1.35rem;
        line-height: 1.25;
    }
    
    .text-center.mb-5 p {
        font-size: 0.9rem;
    }
    
    .bg-primary.bg-opacity-10 {
        width: 55px !important;
        height: 55px !important;
    }
    
    .bi-chat-dots-fill {
        font-size: 1.8rem !important;
    }
    
    .question-card .card-body {
        padding: 0.8rem !important;
    }
    
    .question-card .d-flex.align-items-start .me-3 {
        width: 26px;
        height: 26px;
        min-width: 26px;
        min-height: 26px;
        margin-right: 0.5rem !important;
    }
    
    .question-card .fw-medium {
        font-size: 0.82rem;
        line-height: 1.35;
    }
    
    .rating-container .d-flex:first-child {
        justify-content: space-between;
        padding: 0.3rem 0;
        gap: 0.1rem;
    }
    
    .rating-input {
        transform: scale(1.25) !important;
    }
    
    .form-check-label {
        font-size: 0.82rem;
        margin-left: 0.3rem !important;
    }
    
    .rating-container .d-flex:last-child small {
        font-size: 0.62rem;
        padding: 0 0.1rem;
    }
    
    .btn-lg {
        padding: 0.7rem 1rem;
        font-size: 0.9rem;
    }
    
    .badge {
        font-size: 0.65rem;
        padding: 0.3rem 0.5rem;
    }
}

/* Ultra Mobile (< 320px) */
@media (max-width: 319px) {
    .container {
        padding-left: 8px;
        padding-right: 8px;
    }
    
    .text-center.mb-5 h2 {
        font-size: 1.25rem;
        line-height: 1.2;
    }
    
    .text-center.mb-5 p {
        font-size: 0.85rem;
    }
    
    .bg-primary.bg-opacity-10 {
        width: 50px !important;
        height: 50px !important;
    }
    
    .bi-chat-dots-fill {
        font-size: 1.6rem !important;
    }
    
    .question-card .card-body {
        padding: 0.7rem !important;
    }
    
    .question-card .d-flex.align-items-start .me-3 {
        width: 24px;
        height: 24px;
        min-width: 24px;
        min-height: 24px;
        margin-right: 0.4rem !important;
    }
    
    .question-card .fw-medium {
        font-size: 0.78rem;
        line-height: 1.3;
    }
    
    .rating-container .d-flex:first-child {
        flex-wrap: wrap;
        justify-content: space-around;
        gap: 0.2rem 0.1rem;
    }
    
    .rating-input {
        transform: scale(1.1) !important;
    }
    
    .form-check-label {
        font-size: 0.78rem;
        margin-left: 0.2rem !important;
    }
    
    .rating-container .d-flex:last-child {
        flex-direction: column;
        gap: 0.1rem;
    }
    
    .rating-container .d-flex:last-child small {
        font-size: 0.58rem;
        text-align: center;
    }
    
    .btn-lg {
        padding: 0.6rem 0.8rem;
        font-size: 0.85rem;
    }
    
    .badge {
        font-size: 0.6rem;
        padding: 0.25rem 0.4rem;
    }
    
    .progress {
        width: 80px !important;
        height: 5px;
    }
}

/* Improved touch targets for all mobile devices */
@media (max-width: 767px) {
    .form-check {
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .form-check-input {
        margin: 0;
    }
    
    .form-check-label {
        padding: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        touch-action: manipulation;
    }
    
    .question-card {
        touch-action: manipulation;
    }
    
    .btn-success {
        touch-action: manipulation;
        min-height: 48px;
    }
}

/* High DPI/Retina Display Adjustments */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .rating-input {
        border-width: 0.5px;
    }
    
    .card {
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    
    .question-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.12) !important;
    }
}

/* Dark mode support for mobile (if system preference) */
@media (prefers-color-scheme: dark) and (max-width: 767px) {
    .question-card {
        background-color: rgba(255,255,255,0.95);
    }
    
    .card {
        background-color: rgba(255,255,255,0.98);
    }
}

/* Reduce motion for users who prefer it */
@media (prefers-reduced-motion: reduce) {
    .question-card,
    .btn-success,
    .progress-bar {
        transition: none !important;
    }
    
    .question-card:hover {
        transform: none !important;
    }
    
    .btn-success:hover {
        transform: none !important;
    }
}

/* Print styles for mobile */
@media print {
    .container {
        padding: 0;
        max-width: 100%;
    }
    
    .question-card {
        break-inside: avoid;
        page-break-inside: avoid;
    }
    
    .btn-success,
    .progress {
        display: none;
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