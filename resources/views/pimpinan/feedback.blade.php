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