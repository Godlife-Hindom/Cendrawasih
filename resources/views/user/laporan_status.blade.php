
@extends('layouts.user-app')
<!-- Enhanced Custom Styles -->
<style>
    /* Root Variables */
    :root {
        --primary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --luxury-gradient: linear-gradient(lightseagreen);
        --subtle-gradient: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(248,250,252,0.9) 100%);
        --glass-bg: rgba(255, 255, 255, 0.25);
        --glass-border: rgba(255, 255, 255, 0.18);
        --shadow-luxury: 0 8px 32px rgba(31, 38, 135, 0.37);
        --text-gradient: linear-gradient(135deg, #667eea, #764ba2);
    }

    /* Floating Background Shapes */
    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: -1;
    }

    .shape {
        position: absolute;
        background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .shape-1 {
        width: 80px;
        height: 80px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 10%;
        animation-delay: 2s;
    }

    .shape-3 {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 70%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* Enhanced Header Styles */
    .icon-container {
        position: relative;
        display: inline-block;
    }

    .icon-wrapper {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100px;
        height: 100px;
        background: var(--luxury-gradient);
        border-radius: 50%;
        box-shadow: var(--shadow-luxury);
        animation: iconPulse 3s ease-in-out infinite;
    }

    .icon-pulse {
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        border: 2px solid rgba(102, 126, 234, 0.3);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes iconPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(1.4); opacity: 0; }
    }

    .title-gradient {
        background: var(--text-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: titleGlow 3s ease-in-out infinite alternate;
    }

    @keyframes titleGlow {
        from { filter: brightness(1); }
        to { filter: brightness(1.2); }
    }

    .subtitle-fade {
        animation: fadeInUp 1s ease-out 0.5s both;
    }

    .decorative-line {
        width: 80px;
        height: 3px;
        background: var(--primary-gradient);
        border-radius: 2px;
        margin-top: 1rem;
        animation: lineExpand 1s ease-out 1s both;
    }

    @keyframes lineExpand {
        from { width: 0; }
        to { width: 80px; }
    }

    /* Enhanced Card Styles */
    .elegant-card {
        backdrop-filter: blur(16px) saturate(180%);
        background-color: var(--glass-bg);
        border: 1px solid var(--glass-border);
        box-shadow: var(--shadow-luxury);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .elegant-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 60px rgba(31, 38, 135, 0.5);
    }

    .card-fade-in {
        animation: fadeInUp 0.8s ease-out;
    }

    .bg-gradient-luxury {
        background: var(--luxury-gradient);
        position: relative;
    }

    .bg-gradient-subtle {
        background: var(--subtle-gradient);
    }

    .header-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 20% 80%, rgba(255,255,255,0.2) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255,255,255,0.2) 0%, transparent 50%);
        animation: patternShift 4s ease-in-out infinite;
    }

    @keyframes patternShift {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.6; }
    }

    .header-shine {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
        transform: rotate(45deg);
        animation: shine 3s infinite;
    }

    @keyframes shine {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    }

    .icon-glow {
        animation: iconGlow 2s ease-in-out infinite alternate;
    }

    @keyframes iconGlow {
        from { text-shadow: 0 0 5px rgba(255,255,255,0.5); }
        to { text-shadow: 0 0 20px rgba(255,255,255,0.8); }
    }

    /* Enhanced Section Styles */
    .section-container {
        animation: slideInLeft 0.6s ease-out;
        animation-fill-mode: both;
    }

    .section-container:nth-child(1) { animation-delay: 0.2s; }
    .section-container:nth-child(2) { animation-delay: 0.4s; }
    .section-container:nth-child(3) { animation-delay: 0.6s; }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .label-enhanced {
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }

    .icon-circle {
        width: 35px;
        height: 35px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        animation: iconBounce 2s ease-in-out infinite;
    }

    @keyframes iconBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }

    .content-box {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .content-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .primary-border {
        border-left: 4px solid #667eea !important;
    }

    .info-border {
        border-left: 4px solid #17a2b8 !important;
    }

    .glass-effect {
        backdrop-filter: blur(16px) saturate(180%);
        background-color: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(209, 213, 219, 0.3);
    }

    .content-inner {
        position: relative;
    }

    .quote-icon {
        position: absolute;
        top: -5px;
        left: -5px;
        font-size: 1.5rem;
    }

    .quote-icon-right {
        position: absolute;
        bottom: -5px;
        right: -5px;
        font-size: 1.5rem;
    }

    /* Enhanced Status Styles */
    .status-container {
        position: relative;
        transition: all 0.4s ease;
    }

    .status-pending {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(255, 235, 59, 0.1));
        border-left: 4px solid #ffc107;
    }

    .status-approved {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(76, 175, 80, 0.1));
        border-left: 4px solid #28a745;
    }

    .status-rejected {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(244, 67, 54, 0.1));
        border-left: 4px solid #dc3545;
    }

    .status-badge {
        padding: 15px 30px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .badge-pending {
        background: linear-gradient(135deg, #ffc107, #ffeb3b);
        color: #000;
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
    }

    .badge-approved {
        background: linear-gradient(135deg, #28a745, #4caf50);
        color: white;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    }

    .badge-rejected {
        background: linear-gradient(135deg, #dc3545, #f44336);
        color: white;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
    }

    .badge-glow {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
        animation: badgeGlow 2s ease-in-out infinite;
    }

    @keyframes badgeGlow {
        0%, 100% { opacity: 0; transform: scale(0.8); }
        50% { opacity: 1; transform: scale(1.2); }
    }

    .badge-icon {
        font-size: 1.2rem;
        animation: iconSpin 3s linear infinite;
    }

    @keyframes iconSpin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .badge-text {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .loading-dots {
        margin-left: 10px;
        display: flex;
        gap: 3px;
    }

    .loading-dots span {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(0,0,0,0.4);
        animation: loadingDots 1.4s ease-in-out infinite both;
    }

    .loading-dots span:nth-child(1) { animation-delay: -0.32s; }
    .loading-dots span:nth-child(2) { animation-delay: -0.16s; }

    @keyframes loadingDots {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }

    .success-checkmark {
        margin-left: 10px;
        font-size: 1.5rem;
        color: rgba(255,255,255,0.8);
        animation: checkmarkPop 0.6s ease-out;
    }

    @keyframes checkmarkPop {
        0% { transform: scale(0) rotate(-45deg); }
        50% { transform: scale(1.3) rotate(-22deg); }
        100% { transform: scale(1) rotate(0deg); }
    }

    /* Enhanced Evaluation Styles */
    .evaluation-card {
        background: linear-gradient(135deg, rgba(23, 162, 184, 0.1), rgba(108, 117, 125, 0.05));
        border-left: 4px solid #17a2b8;
        position: relative;
        transition: all 0.4s ease;
        margin-top: 1rem;
    }

    .evaluation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(23, 162, 184, 0.2);
    }

    .evaluation-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 25% 25%, rgba(23, 162, 184, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(108, 117, 125, 0.1) 0%, transparent 50%);
        animation: evaluationShift 5s ease-in-out infinite;
    }

    @keyframes evaluationShift {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.7; }
    }

    .leader-avatar {
        position: relative;
    }

    .avatar-wrapper {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #17a2b8, #20c997);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(23, 162, 184, 0.3);
        position: relative;
        overflow: hidden;
    }

    .avatar-pulse {
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        border: 2px solid rgba(23, 162, 184, 0.3);
        border-radius: 50%;
        animation: avatarPulse 2.5s infinite;
    }

    @keyframes avatarPulse {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(1.3); opacity: 0; }
    }

    .evaluation-header {
        position: relative;
    }

    .evaluation-title {
        font-size: 1.2rem;
        letter-spacing: 0.5px;
    }

    .evaluation-line {
        width: 50px;
        height: 2px;
        background: linear-gradient(90deg, #17a2b8, transparent);
        margin-top: 5px;
        animation: evaluationLineGrow 1s ease-out;
    }

    @keyframes evaluationLineGrow {
        from { width: 0; }
        to { width: 50px; }
    }

    .icon-sparkle {
        animation: sparkle 2s ease-in-out infinite;
    }

    @keyframes sparkle {
        0%, 100% { transform: rotate(0deg) scale(1); }
        25% { transform: rotate(-5deg) scale(1.1); }
        75% { transform: rotate(5deg) scale(1.1); }
    }

    .quote-container {
        position: relative;
        padding: 0 20px;
    }

    .evaluation-quote {
        position: absolute;
        top: -10px;
        left: 0;
        font-size: 2rem;
    }

    .evaluation-quote-right {
        position: absolute;
        bottom: -10px;
        right: 0;
        font-size: 2rem;
    }

    .evaluation-text {
        font-style: italic;
        line-height: 1.8;
        position: relative;
        z-index: 1;
    }

    .evaluation-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(23, 162, 184, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        animation: evaluationGlow 3s ease-in-out infinite;
    }

    @keyframes evaluationGlow {
        0%, 100% { opacity: 0.3; transform: translate(-50%, -50%) scale(0.8); }
        50% { opacity: 0.8; transform: translate(-50%, -50%) scale(1.2); }
    }

    /* Enhanced Button Styles */
    .action-section {
        margin-top: 2rem;
        animation: fadeInUp 1s ease-out 1s both;
    }

    .button-container {
        position: relative;
        display: inline-block;
    }

    .btn-elegant {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
        text-decoration: none;
        display: inline-block;
    }

    .btn-elegant:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 15px 40px rgba(108, 117, 125, 0.4);
        color: white;
    }

    .btn-primary-elegant {
        background: var(--primary-gradient);
        color: white;
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary-elegant:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-content {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-shine {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s ease;
    }

    .btn-elegant:hover .btn-shine,
    .btn-primary-elegant:hover .btn-shine {
        left: 100%;
    }

    .btn-ripple {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.6s ease;
    }

    .btn-elegant:active .btn-ripple,
    .btn-primary-elegant:active .btn-ripple {
        width: 300px;
        height: 300px;
    }

    .btn-particles {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .btn-particles span {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(255,255,255,0.8);
        border-radius: 50%;
        animation: particles 2s ease-in-out infinite;
    }

    .btn-particles span:nth-child(1) {
        top: -20px;
        left: -10px;
        animation-delay: 0s;
    }

    .btn-particles span:nth-child(2) {
        top: -15px;
        right: -10px;
        animation-delay: 0.7s;
    }

    .btn-particles span:nth-child(3) {
        bottom: -20px;
        left: 5px;
        animation-delay: 1.4s;
    }

    @keyframes particles {
        0%, 100% { opacity: 0; transform: translateY(0) scale(0); }
        50% { opacity: 1; transform: translateY(-10px) scale(1); }
    }

    /* Enhanced Empty State */
    .empty-state {
        animation: fadeIn 1s ease-out;
    }

    .empty-illustration {
        position: relative;
    }

    .empty-icon-container {
        position: relative;
        display: inline-block;
    }

    .empty-bg-circle {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        border-radius: 50%;
        transform: translate(-50%, -50%);
        animation: emptyCirclePulse 3s ease-in-out infinite;
    }

    @keyframes emptyCirclePulse {
        0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
        50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.6; }
    }

    .floating-papers {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .paper {
        position: absolute;
        width: 20px;
        height: 25px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 2px;
        opacity: 0.3;
    }

    .paper-1 {
        top: -40px;
        left: -30px;
        animation: paperFloat 4s ease-in-out infinite;
        animation-delay: 0s;
    }

    .paper-2 {
        top: -20px;
        right: -35px;
        animation: paperFloat 4s ease-in-out infinite;
        animation-delay: 1.3s;
    }

    .paper-3 {
        bottom: -30px;
        left: -20px;
        animation: paperFloat 4s ease-in-out infinite;
        animation-delay: 2.6s;
    }

    @keyframes paperFloat {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        33% { transform: translateY(-10px) rotate(5deg); }
        66% { transform: translateY(-5px) rotate(-3deg); }
    }

    .empty-icon {
        position: relative;
        z-index: 2;
        animation: emptyIconBob 2s ease-in-out infinite;
    }

    @keyframes emptyIconBob {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .empty-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            radial-gradient(circle at 30% 30%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 70% 70%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
        animation: emptyPatternShift 4s ease-in-out infinite;
    }

    @keyframes emptyPatternShift {
        0%, 100% { opacity: 0.2; }
        50% { opacity: 0.5; }
    }

    .empty-title {
        animation: fadeInUp 1s ease-out 0.5s both;
    }

    .empty-subtitle {
        animation: fadeInUp 1s ease-out 0.7s both;
    }

    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .card-body {
            padding: 2rem 1.5rem !important;
        }
        
        .icon-wrapper {
            width: 80px;
            height: 80px;
        }
        
        .fa-3x {
            font-size: 2rem !important;
        }
        
        .fa-5x {
            font-size: 3rem !important;
        }

        .status-badge {
            padding: 12px 20px;
            font-size: 0.9rem;
        }

        .avatar-wrapper {
            width: 60px;
            height: 60px;
        }

        .btn-elegant,
        .btn-primary-elegant {
            padding: 12px 24px !important;
            font-size: 0.9rem;
        }

        .floating-shapes {
            display: none;
        }
    }
    
    @media (max-width: 576px) {
        .icon-circle {
            width: 30px;
            height: 30px;
            font-size: 0.8rem;
        }

        .content-box {
            padding: 1rem !important;
        }

        .status-badge {
            padding: 10px 16px;
            font-size: 0.85rem;
        }

        .evaluation-card {
            padding: 1rem !important;
        }

        .avatar-wrapper {
            width: 50px;
            height: 50px;
        }

        .btn-elegant,
        .btn-primary-elegant {
            padding: 10px 20px !important;
            font-size: 0.85rem;
        }

        .decorative-line {
            width: 60px;
        }
    }

    /* Animation Utilities */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Accessibility Improvements */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* Print Styles */
    @media print {
        .floating-shapes,
        .btn-elegant,
        .btn-primary-elegant,
        .action-section {
            display: none !important;
        }
        
        .elegant-card {
            box-shadow: none !important;
            border: 1px solid #dee2e6 !important;
        }
    }
</style>


@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Animated Background Elements -->
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>

            <!-- Header Section with Enhanced Animation -->
            <div class="text-center mb-5 position-relative">
                <div class="mb-4 icon-container">
                    <div class="icon-wrapper">
                        <i class="fas fa-clipboard-list fa-3x text-white"></i>
                        <div class="icon-pulse"></div>
                    </div>
                </div>
                <h3 class="fw-bold text-dark mb-3 title-gradient">Status Laporan Anda</h3>
                <p class="text-muted fs-5 subtitle-fade">Pantau status dan evaluasi laporan yang telah Anda kirimkan</p>
                <div class="decorative-line mx-auto"></div>
            </div>

            @if($report)
                <!-- Enhanced Report Card -->
                <div class="card elegant-card border-0 mb-5 card-fade-in">
                    <div class="card-header bg-gradient-luxury text-white py-4 position-relative overflow-hidden">
                        <div class="header-pattern"></div>
                        <h5 class="card-title mb-0 position-relative z-2">
                            <i class="fas fa-file-alt me-2 icon-glow"></i>
                            Detail Laporan
                        </h5>
                        <div class="header-shine"></div>
                    </div>
                    <div class="card-body p-5 bg-gradient-subtle">
                        <!-- Enhanced Title Section -->
                        <div class="mb-5 section-container">
                            <label class="form-label fw-bold text-secondary mb-3 label-enhanced">
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle me-2">
                                        <i class="fas fa-heading"></i>
                                    </div>
                                    Judul Laporan
                                </div>
                            </label>
                            <div class="content-box primary-border glass-effect p-4 rounded-4">
                                <div class="content-inner">
                                    <i class="fas fa-quote-left text-primary opacity-25 quote-icon"></i>
                                    <p class="mb-0 fs-6 text-dark fw-medium">{{ $report->title }}</p>
                                    <i class="fas fa-quote-right text-primary opacity-25 quote-icon-right"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Content Section -->
                        <div class="mb-5 section-container">
                            <label class="form-label fw-bold text-secondary mb-3 label-enhanced">
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle me-2">
                                        <i class="fas fa-align-left"></i>
                                    </div>
                                    Isi Laporan
                                </div>
                            </label>
                            <div class="content-box info-border glass-effect p-4 rounded-4">
                                <div class="content-inner">
                                    <div class="content-text">
                                        <p class="mb-0 fs-6 text-dark lh-lg">{{ $report->content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Status Section -->
                        <div class="mb-5 section-container">
                            <label class="form-label fw-bold text-secondary mb-3 label-enhanced">
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle me-2">
                                        <i class="fas fa-flag"></i>
                                    </div>
                                    Status Laporan
                                </div>
                            </label>
                            <div class="status-container p-4 rounded-4 glass-effect
                                @if($report->status == 'pending') 
                                    status-pending
                                @elseif($report->status == 'approved')
                                    status-approved
                                @else
                                    status-rejected
                                @endif
                            ">
                                <div class="d-flex align-items-center justify-content-center">
                                    @if($report->status == 'pending')
                                        <div class="status-badge badge-pending">
                                            <div class="badge-glow"></div>
                                            <i class="fas fa-clock me-2 badge-icon"></i>
                                            <span class="badge-text">Menunggu Evaluasi</span>
                                            <div class="loading-dots">
                                                <span></span><span></span><span></span>
                                            </div>
                                        </div>
                                    @elseif($report->status == 'approved')
                                        <div class="status-badge badge-approved">
                                            <div class="badge-glow"></div>
                                            <i class="fas fa-check-circle me-2 badge-icon"></i>
                                            <span class="badge-text">Disetujui</span>
                                            <div class="success-checkmark">✓</div>
                                        </div>
                                    @else
                                        <div class="status-badge badge-rejected">
                                            <div class="badge-glow"></div>
                                            <i class="fas fa-times-circle me-2 badge-icon"></i>
                                            <span class="badge-text">Ditolak</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Evaluation Section -->
                        @if($report->evaluation)
                            <div class="evaluation-card glass-effect border-0 shadow-luxury rounded-4 p-4 position-relative overflow-hidden">
                                <div class="evaluation-pattern"></div>
                                <div class="d-flex align-items-start position-relative z-2">
                                    <div class="me-4 leader-avatar">
                                        <div class="avatar-wrapper">
                                            <i class="fas fa-user-tie fa-2x text-white"></i>
                                            <div class="avatar-pulse"></div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="evaluation-header mb-3">
                                            <h6 class="fw-bold mb-1 text-primary evaluation-title">
                                                <i class="fas fa-comment-dots me-2 icon-sparkle"></i>
                                                Evaluasi Pimpinan
                                            </h6>
                                            <div class="evaluation-line"></div>
                                        </div>
                                        <div class="evaluation-content">
                                            <div class="quote-container">
                                                <i class="fas fa-quote-left text-info opacity-30 evaluation-quote"></i>
                                                <p class="mb-0 fs-6 lh-lg text-dark evaluation-text">{{ $report->evaluation }}</p>
                                                <i class="fas fa-quote-right text-info opacity-30 evaluation-quote-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="evaluation-glow"></div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Enhanced Action Buttons -->
                <div class="text-center action-section">
                    <div class="button-container">
                        <a href="{{ url()->previous() }}" class="btn btn-elegant px-5 py-3 rounded-pill position-relative overflow-hidden">
                            <span class="btn-content position-relative z-2">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali
                            </span>
                            <div class="btn-shine"></div>
                            <div class="btn-ripple"></div>
                        </a>
                    </div>
                </div>

            @else
                <!-- Enhanced Empty State -->
                <div class="text-center py-5 empty-state">
                    <div class="empty-illustration mb-5">
                        <div class="empty-icon-container">
                            <div class="empty-bg-circle"></div>
                            <div class="floating-papers">
                                <div class="paper paper-1"></div>
                                <div class="paper paper-2"></div>
                                <div class="paper paper-3"></div>
                            </div>
                            <i class="fas fa-inbox fa-5x text-primary empty-icon"></i>
                        </div>
                    </div>
                    <div class="card elegant-card border-0 shadow-luxury bg-gradient-subtle">
                        <div class="card-body py-5 px-4 position-relative overflow-hidden">
                            <div class="empty-pattern"></div>
                            <div class="position-relative z-2">
                                <h5 class="text-primary mb-3 fw-bold empty-title">Belum Ada Laporan</h5>
                                <p class="text-secondary mb-4 fs-6 lh-lg empty-subtitle">Anda belum mengirimkan laporan apapun. Silakan buat laporan baru untuk memulai.</p>
                                <div class="button-container">
                                    <a href="#" class="btn btn-primary-elegant px-5 py-3 rounded-pill position-relative overflow-hidden">
                                        <span class="btn-content position-relative z-2">
                                            <i class="fas fa-plus me-2"></i>
                                            Buat Laporan Baru
                                        </span>
                                        <div class="btn-shine"></div>
                                        <div class="btn-particles">
                                            <span></span><span></span><span></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
    
    .badge {
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .btn {
        transition: all 0.3s ease;
        font-weight: 500;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    
    .alert {
        border-radius: 15px;
    }
    
    @media (max-width: 768px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .card-body {
            padding: 1.5rem !important;
        }
        
        .fa-3x {
            font-size: 2rem !important;
        }
        
        .fa-5x {
            font-size: 3rem !important;
        }
    }
    
    @media (max-width: 576px) {
        .badge {
            font-size: 0.8rem !important;
            padding: 0.5rem 1rem !important;
        }
        
        .btn {
            font-size: 0.9rem;
            padding: 0.6rem 1.5rem;
        }
    }
</style>
@endsection