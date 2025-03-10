<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Sepeda Pantai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html { scroll-behavior: smooth; }
        .hero-pattern {
            background-color: #0093E9;
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .gsap-reveal { opacity: 0; visibility: hidden; }
        .scroll-indicator {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: #0093E9;
            transform-origin: 0%;
            z-index: 1000;
        }
        .cursor {
            width: 12px;
            height: 12px;
            background: #0093E9;
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            mix-blend-mode: difference;
            z-index: 9999;
        }
        .cursor-follower {
            width: 30px;
            height: 30px;
            border: 2px solid #0093E9;
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            transition: transform 0.1s;
            z-index: 9998;
        }
        a:hover ~ .cursor-follower,
        button:hover ~ .cursor-follower {
            transform: scale(1.5) rotate(45deg);
            border-radius: 10px;
            background: rgba(0, 147, 233, 0.1);
        }
        .sepeda-slider {
            overflow-x: hidden;
            position: relative;
            padding: 40px 0;
            margin: 0 -20px;
        }
        .sepeda-wrapper {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            gap: 20px;
            padding: 10px 20px;
            align-items: center;
        }
        .sepeda-card {
            min-width: 260px;
            height: 320px;
            flex-shrink: 0;
            cursor: pointer;
            transform: scale(0.85);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            border: 3px solid transparent;
            position: relative;
            background: white;
            opacity: 0.7;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        .sepeda-card.active {
            min-width: 280px;
            transform: scale(1);
            border-color: #0093E9;
            box-shadow: 0 20px 25px -5px rgba(0, 147, 233, 0.2), 0 10px 10px -5px rgba(0, 147, 233, 0.1);
            opacity: 1;
            z-index: 2;
        }
        .sepeda-card:not(.active) {
            filter: grayscale(30%);
            border: 3px solid #e5e7eb;
        }
        .sepeda-card:hover:not(.active) {
            border-color: #80D0C7;
            opacity: 0.9;
            filter: grayscale(0%);
        }
        .sepeda-card .sepeda-info {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(4px);
            border-top: 1px solid rgba(0, 147, 233, 0.1);
            transition: all 0.3s ease;
        }
        .sepeda-card.active .sepeda-info {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 -4px 6px -1px rgba(0, 147, 233, 0.1);
        }
        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background: #0093E9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            font-size: 1.2rem;
        }
        .slider-nav:hover {
            background: #80D0C7;
            transform: translateY(-50%) scale(1.1);
        }
        .slider-prev {
            left: 20px;
        }
        .slider-next {
            right: 20px;
        }
        .sepeda-status {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 4px 8px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 1;
        }
        .status-available {
            background-color: #10B981;
            color: white;
        }
        .status-rented {
            background-color: #EF4444;
            color: white;
        }
        .sepeda-card.active::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 0.75rem;
            background: linear-gradient(45deg, #0093E9, #80D0C7);
            z-index: -1;
            opacity: 0.5;
            filter: blur(8px);
            transition: all 0.5s ease;
        }
        .swal2-popup {
            padding: 2rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            animation: checkmark 0.5s ease-in-out forwards;
        }
        @keyframes checkmark {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
        .rental-success-animation {
            position: relative;
            overflow: hidden;
        }
        .rental-success-animation::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(255, 255, 255, 0.8),
                transparent
            );
            transform: rotate(45deg);
            animation: shine 1.5s infinite;
        }
        @keyframes shine {
            0% {
                transform: translateX(-100%) rotate(45deg);
            }
            100% {
                transform: translateX(100%) rotate(45deg);
            }
        }
        .loading-animation {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .bike-animation {
            position: relative;
            width: 200px;
            height: 200px;
        }
        .bike-animation::before {
            content: '🚲';
            font-size: 60px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            animation: bikeRide 2s ease-in-out forwards;
        }
        .loading-circle {
            width: 200px;
            height: 200px;
            border: 4px solid #e2e8f0;
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: loadingSpin 1s linear infinite;
        }
        @keyframes loadingSpin {
            to { transform: rotate(360deg); }
        }
        @keyframes bikeRide {
            0% {
                transform: translate(-150%, -50%) rotate(0deg);
                opacity: 0;
            }
            20% {
                opacity: 1;
            }
            80% {
                opacity: 1;
            }
            100% {
                transform: translate(150%, -50%) rotate(360deg);
                opacity: 0;
            }
        }
        .success-ripple {
            position: fixed;
            inset: 0;
            background: #3b82f6;
            transform: scale(0);
            z-index: 9998;
        }
        .bike-ride-animation {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .bike-path {
            position: relative;
            width: 100%;
            height: 100px;
        }
        .bike-emoji {
            position: absolute;
            font-size: 3rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .bike-trail {
            position: absolute;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, transparent);
            transform-origin: left;
        }
        .success-flash {
            position: fixed;
            inset: 0;
            background: #3b82f6;
            opacity: 0;
            z-index: 9998;
        }
        .bike-animation-container {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .bike-scene {
            width: 100%;
            height: 200px;
            position: relative;
            overflow: hidden;
        }
        .bike-emoji {
            font-size: 4rem;
            position: absolute;
            left: -100px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
        }
        .bike-trail {
            position: absolute;
            height: 4px;
            background: linear-gradient(90deg,
                rgba(59, 130, 246, 0.8),
                rgba(59, 130, 246, 0.4),
                transparent);
            width: 100px;
            top: calc(50% + 30px);
            left: -100px;
            filter: blur(2px);
        }
        .sparkles {
            position: absolute;
            font-size: 1.5rem;
            opacity: 0;
            color: #3b82f6;
        }
        .success-ripple {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at center, #3b82f6, #60a5fa);
            transform: scale(0);
            z-index: 9998;
        }
        .modern-loading {
            position: fixed;
            inset: 0;
            backdrop-filter: blur(8px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.2);
        }
        .loading-content {
            position: relative;
            width: 100%;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .bike-container {
            width: 100%;
            height: 100px;
            position: relative;
            overflow: hidden;
        }
        .bike-wrapper {
            position: absolute;
            display: flex;
            align-items: center;
            left: -100px;
            top: 50%;
            transform: translateY(-50%);
        }
        .bike-emoji {
            font-size: 3rem;
            margin-right: 10px;
        }
        .bike-wheel {
            width: 10px;
            height: 2px;
            background: #3b82f6;
            position: absolute;
            bottom: -5px;
            opacity: 0.6;
        }
        .bike-path {
            position: absolute;
            bottom: 40px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
            transform-origin: left;
        }
        .loading-text {
            color: #3b82f6;
            font-size: 1.2rem;
            font-weight: 500;
            margin-top: 2rem;
            opacity: 0;
            transform: translateY(20px);
        }
        .loading-progress {
            width: 200px;
            height: 3px;
            background: rgba(59, 130, 246, 0.2);
            border-radius: 999px;
            margin-top: 1rem;
            overflow: hidden;
            opacity: 0;
            transform: translateY(20px);
        }
        .progress-bar {
            height: 100%;
            background: #3b82f6;
            width: 0%;
            border-radius: 999px;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }
        .modern-loading {
            position: fixed;
            inset: 0;
            backdrop-filter: blur(8px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.2);
        }
        .loading-content {
            position: relative;
            width: 100%;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .bike-scene {
            width: 100%;
            height: 120px;
            position: relative;
            overflow: hidden;
        }
        .bike-wrapper {
            position: absolute;
            display: flex;
            align-items: center;
            left: -100px;
            top: 50%;
            transform: translateY(-50%);
        }
        .bike-emoji {
            font-size: 3.5rem;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }
        .bike-particles {
            position: absolute;
            pointer-events: none;
        }
        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #3b82f6;
            border-radius: 50%;
            opacity: 0;
        }
        .bike-path {
            position: absolute;
            bottom: 30px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg,
                transparent,
                rgba(59, 130, 246, 0.3),
                rgba(59, 130, 246, 0.5),
                rgba(59, 130, 246, 0.3),
                transparent
            );
        }
        .loading-text {
            margin-top: 2rem;
            font-size: 1.2rem;
            font-weight: 500;
            color: #3b82f6;
            opacity: 0;
            transform: translateY(20px);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .progress-container {
            margin-top: 1.5rem;
            width: 240px;
            position: relative;
        }
        .progress-bar {
            height: 4px;
            background: rgba(59, 130, 246, 0.2);
            border-radius: 999px;
            overflow: hidden;
            position: relative;
        }
        .progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
            border-radius: 999px;
            position: relative;
        }
        .progress-glow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                transparent,
                rgba(59, 130, 246, 0.6),
                transparent
            );
            filter: blur(4px);
            transform: translateX(-100%);
        }
        .progress-text {
            position: absolute;
            right: 0;
            top: -20px;
            font-size: 0.875rem;
            color: #3b82f6;
            opacity: 0;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        .info-card-hover {
            transition: all 0.3s ease;
        }
        .info-card-hover:hover {
            transform: translateY(-2px);
        }
        .profile-photo-container {
            position: relative;
            display: inline-block;
        }
        .profile-photo-container::after {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            background: linear-gradient(45deg, #3b82f6, #60a5fa);
            border-radius: 50%;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .profile-photo-container:hover::after {
            opacity: 1;
        }
        .verification-badge {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .sepeda-card img {
            height: 160px;
            object-fit: cover;
        }
        @media (max-width: 640px) {
            .sepeda-card {
                min-width: 220px;
                height: 280px;
            }
            .sepeda-card.active {
                min-width: 240px;
            }
            .sepeda-card img {
                height: 140px;
            }
            .sepeda-card .p-4 {
                padding: 0.75rem;
            }
            .sepeda-card h3 {
                font-size: 1rem;
            }
            .sepeda-card p {
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100">
    <div class="cursor"></div>
    <div class="cursor-follower"></div>
    <div class="scroll-indicator" id="scrollIndicator"></div>
    <nav class="bg-white shadow-md fixed w-full z-10" x-data="{ isOpen: false }">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-bicycle text-3xl text-blue-600 mr-2"></i>
                    <span class="font-bold text-xl text-blue-600">Rental Sepeda Pantai</span>
                </div>
                <div class="flex items-center space-x-4">
                    <button @click="isOpen = !isOpen" class="lg:hidden p-2 rounded-md text-gray-600 hover:bg-gray-200 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="hidden lg:flex items-center space-x-4">
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ url('/admin/dashboard') }}" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300">
                                            <i class="fas fa-chart-line mr-1"></i> Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('profile') }}" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300">
                                            <i class="fas fa-user mr-1"></i> Profil
                                        </a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}" class="inline-block ml-2">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 rounded-md border border-red-500 text-red-500 hover:bg-red-50 transition-colors duration-300">
                                            <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                                        </button>
                                    </form>
                                @else
                                    <div class="flex space-x-2">
                                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-md border border-blue-600 text-blue-600 hover:bg-blue-50 transition-colors duration-300">Masuk</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300">Daftar</a>
                                        @endif
                                    </div>
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div x-show="isOpen" class="lg:hidden bg-white shadow-md">
            <div class="flex flex-col p-4">
                @if (Route::has('login'))
                    <div>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Dashboard</a>
                            @else
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profil</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-200">
                                    Keluar
                                </button>
                            </form>
                        @else
                            <div class="flex flex-col space-y-2">
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Daftar</a>
                                @endif
                            </div>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>
    <section class="hero-pattern pt-24 pb-16 md:pt-32 md:pb-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0 gsap-reveal">
                    <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                        Nikmati Keindahan Pantai dengan Sepeda Kami
                    </h1>
                    <p class="text-xl text-white opacity-90 mb-8">
                        Sewa sepeda berkualitas untuk menikmati pemandangan pantai yang indah dengan harga terjangkau.
                    </p>
                </div>
                <div class="md:w-1/2 flex justify-center gsap-reveal">
                    <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Sepeda Pantai" class="rounded-lg shadow-2xl max-w-full h-auto" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-white" id="tentang">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 gsap-reveal">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Memilih Kami?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan layanan rental sepeda pantai terbaik dengan berbagai keunggulan
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-blue-50 p-8 rounded-xl shadow-md gsap-reveal">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-bicycle text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Sepeda Berkualitas</h3>
                    <p class="text-gray-600 text-center">
                        Kami hanya menyediakan sepeda berkualitas tinggi yang terawat dengan baik untuk kenyamanan Anda.
                    </p>
                </div>
                <div class="bg-blue-50 p-8 rounded-xl shadow-md gsap-reveal">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-map-marker-alt text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Lokasi Strategis</h3>
                    <p class="text-gray-600 text-center">
                        Lokasi rental kami berada di dekat pantai dengan akses mudah ke berbagai tempat wisata menarik.
                    </p>
                </div>
                <div class="bg-blue-50 p-8 rounded-xl shadow-md gsap-reveal">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-tag text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Harga Terjangkau</h3>
                    <p class="text-gray-600 text-center">
                        Kami menawarkan harga sewa yang terjangkau dengan berbagai paket menarik untuk semua kebutuhan.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-gray-100" id="pinjam-sekarang">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 gsap-reveal">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Pinjam Sepeda Sekarang</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Isi form di bawah ini untuk langsung meminjam sepeda favorit Anda
                </p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-4xl mx-auto gsap-reveal">
                @auth
                    <div class="mb-6">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5 shadow-lg border border-blue-200 max-w-3xl mx-auto">
                            <h3 class="text-lg font-semibold text-blue-800 mb-3 flex items-center">
                                <i class="fas fa-user-circle mr-2"></i>
                                Informasi Peminjam
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="flex justify-center items-center">
                                    <div class="relative group">
                                        <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-blue-400 rounded-full blur opacity-30 group-hover:opacity-60 transition duration-300"></div>
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                                 alt="Foto Profil"
                                                 class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg transform group-hover:scale-105 transition duration-300"
                                            >
                                            <div class="absolute bottom-0 right-0 bg-blue-500 text-white p-1.5 rounded-full shadow-lg">
                                                <i class="fas fa-bicycle text-xs"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <div class="flex items-center p-2.5 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-user text-blue-500 text-sm"></i>
                                        </div>
                                        <div class="ml-3 min-w-0">
                                            <p class="text-xs text-gray-500">Nama</p>
                                            <p class="text-sm font-medium text-gray-800 truncate">{{ Auth::user()->name }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-2.5 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-envelope text-blue-500 text-sm"></i>
                                        </div>
                                        <div class="ml-3 min-w-0 flex-1">
                                            <p class="text-xs text-gray-500">Email</p>
                                            <p class="text-sm font-medium text-gray-800 truncate" title="{{ Auth::user()->email }}">
                                                {{ Auth::user()->email }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-2.5 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-map-marker-alt text-blue-500 text-sm"></i>
                                        </div>
                                        <div class="ml-3 min-w-0">
                                            <p class="text-xs text-gray-500">Alamat</p>
                                            <p class="text-sm font-medium text-gray-800 truncate" title="{{ Auth::user()->address }}">
                                                {{ Auth::user()->address }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6" data-rental-form>
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Sepeda</label>
                                <div class="sepeda-slider">
                                    <div class="slider-nav slider-prev">
                                        <i class="fas fa-chevron-left"></i>
                                    </div>
                                    <div class="slider-nav slider-next">
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                    <div class="sepeda-wrapper">
                                        @foreach(App\Models\Sepeda::all() as $sepeda)
                                        <div class="sepeda-card bg-white rounded-xl shadow-md overflow-hidden transition-transform transform hover:scale-105"
                                             data-id="{{ $sepeda->id }}"
                                             data-sewa="{{ $sepeda->sewa }}"
                                             data-foto="{{ asset('storage/' . $sepeda->foto) }}">
                                            <img src="{{ asset('storage/' . $sepeda->foto) }}"
                                                 alt="{{ $sepeda->merk }}"
                                                 class="w-full h-48 object-cover">
                                            <div class="p-4">
                                                <h3 class="font-semibold text-lg mb-2">{{ $sepeda->merk }}</h3>
                                                <p class="text-blue-600 font-bold">
                                                    Rp {{ number_format($sepeda->sewa, 0, ',', '.') }}/hari
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <input type="hidden" name="sepeda_id" id="sepeda_id" required>
                            </div>
                            <div>
                                <label for="tgl_pinjam" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pinjam</label>
                                <input type="date" id="tgl_pinjam" name="tgl_pinjam" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div>
                                <label for="tgl_pulang" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kembali</label>
                                <input type="date" id="tgl_pulang" name="tgl_pulang" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                            <div>
                                <label for="jaminan" class="block text-sm font-medium text-gray-700 mb-2">Jaminan</label>
                                <select id="jaminan" name="jaminan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="KTP">KTP</option>
                                    <option value="SIM">SIM</option>
                                    <option value="Kartu Pelajar">Kartu Pelajar</option>
                                    <option value="Kartu Keluarga">Kartu Keluarga</option>
                                </select>
                            </div>
                            <div>
                                <label for="bayar" class="block text-sm font-medium text-gray-700 mb-2">Total Biaya</label>
                                <input type="text" id="bayar_display" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                                <input type="hidden" id="bayar" name="bayar">
                                <input type="hidden" name="status" value="Pinjam">
                            </div>
                        </div>
                        <div class="text-center pt-4">
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                Pinjam Sekarang
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-lock text-5xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-4">Silakan Login untuk Meminjam Sepeda</h3>
                        <p class="text-gray-600 mb-6">Anda perlu login terlebih dahulu untuk dapat meminjam sepeda.</p>
                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition-colors duration-300">
                                Daftar
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </section>
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 gsap-reveal">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Pilihan Sepeda Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Berbagai jenis sepeda yang dapat Anda sewa untuk menikmati liburan di pantai
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach(App\Models\Sepeda::all() as $sepeda)
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 gsap-reveal">
                    <img src="{{ asset('storage/' . $sepeda->foto) }}" alt="{{ $sepeda->merk }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $sepeda->merk }}</h3>
                        <p class="text-gray-600 mb-4">
                            Sepeda berkualitas tinggi untuk pengalaman bersepeda yang nyaman.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-bold">Rp {{ number_format($sepeda->sewa, 0, ',', '.') }}/hari</span>
                            <a href="#pinjam-sekarang" class="scroll-link px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 gsap-reveal">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pengalaman pelanggan kami yang telah menggunakan layanan rental sepeda pantai
                </p>
            </div>
            @auth
            <div class="max-w-2xl mx-auto mb-12 bg-white p-6 rounded-lg shadow-md gsap-reveal">
                <h3 class="text-xl font-semibold mb-4">Berikan Ulasan Anda</h3>
                <form action="{{ route('ratings.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                        <div class="flex space-x-2" x-data="{ rating: 0 }">
                            @for ($i = 1; $i <= 5; $i++)
                            <button type="button"
                                    class="text-2xl focus:outline-none"
                                    x-on:click="rating = {{ $i }}"
                                    x-on:mouseover="$el.classList.add('text-yellow-400')"
                                    x-on:mouseleave="$el.classList.remove('text-yellow-400')"
                                    x-bind:class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'">
                                <i class="fas fa-star"></i>
                            </button>
                            @endfor
                            <input type="hidden" name="rating" x-bind:value="rating">
                        </div>
                    </div>
                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Komentar</label>
                        <textarea id="comment" name="comment" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                  required></textarea>
                    </div>
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                        Kirim Ulasan
                    </button>
                </form>
            </div>
            @endauth
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach(\App\Models\Rating::with('user')->latest()->take(6)->get() as $testimonial)
                <div class="bg-white p-8 rounded-xl shadow-md gsap-reveal">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 overflow-hidden rounded-full mr-4">
                            <img src="{{ asset('storage/' . $testimonial->user->photo) }}"
                                 alt="{{ $testimonial->user->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-semibold">{{ $testimonial->user->name }}</h4>
                            <div class="text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $testimonial->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "{{ $testimonial->comment }}"
                    </p>
                    <div class="mt-2 text-sm text-gray-500">
                        {{ $testimonial->created_at->diffForHumans() }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start mb-3">
                        <i class="fas fa-bicycle text-2xl text-blue-400 mr-2"></i>
                        <span class="font-bold text-lg">Rental Sepeda Pantai</span>
                    </div>
                    <p class="text-gray-400 text-sm max-w-md">
                        Nikmati pengalaman bersepeda di pantai yang menyenangkan dengan sepeda berkualitas.
                    </p>
                </div>
                <div class="text-gray-400 text-sm">
                    <p>abdulrahmanrasyid</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; 2023 Rental Sepeda Pantai. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
    @if(session('success_rental'))
    <div id="success-alert" class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0,0,0,0.5);">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="text-center">
                <div class="mb-4">
                                <i class="fas fa-check-circle text-5xl text-green-500"></i>
                            </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Transaksi Berhasil!</h3>
                <p class="text-gray-600 mb-6">{{ session('success_rental')['message'] }}</p>
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('transaksi.index') }}" class="inline-flex justify-center items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                        <i class="fas fa-eye mr-2"></i>
                        Lihat Transaksi
                    </a>
                    <button onclick="closeAlert()" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            gsap.registerPlugin(ScrollTrigger);
            gsap.to('#scrollIndicator', {
                scaleX: 1,
                ease: 'none',
                scrollTrigger: {
                    trigger: 'body',
                    scrub: 0.3,
                    start: 'top top',
                    end: 'bottom bottom',
                    invalidateOnRefresh: true
                }
            });
            gsap.utils.toArray('.gsap-reveal').forEach(function(elem) {
                gsap.set(elem, {
                    autoAlpha: 0,
                    y: 50
                });
                ScrollTrigger.create({
                    trigger: elem,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    onEnter: function() {
                        gsap.to(elem, {
                            duration: 1,
                            autoAlpha: 1,
                            y: 0,
                            ease: 'power2.out',
                            stagger: {
                                amount: 0.3
                            }
                        });
                    },
                    once: true
                });
            });
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                        const startPosition = window.pageYOffset;
                        const distance = targetPosition - startPosition;
                        gsap.to(window, {
                            duration: 1,
                            scrollTo: {
                                y: targetPosition,
                                autoKill: false
                            },
                            ease: 'power2.inOut'
                        });
                    }
                });
            });
            const sepedaSelect = document.getElementById('sepeda_id');
            const sepedaPreview = document.getElementById('sepeda_preview');
            const tglPinjam = document.getElementById('tgl_pinjam');
            const tglPulang = document.getElementById('tgl_pulang');
            const bayarDisplay = document.getElementById('bayar_display');
            const bayarInput = document.getElementById('bayar');
            if (sepedaSelect && sepedaPreview) {
                updateSepedaPreview();
                calculateTotal();
            }
            if (sepedaSelect) {
                sepedaSelect.addEventListener('change', function() {
                    updateSepedaPreview();
                    calculateTotal();
                });
            }
            if (tglPinjam) {
                tglPinjam.addEventListener('change', calculateTotal);
            }
            if (tglPulang) {
                tglPulang.addEventListener('change', calculateTotal);
            }
            function updateSepedaPreview() {
                const selectedOption = sepedaSelect.options[sepedaSelect.selectedIndex];
                const fotoUrl = selectedOption.getAttribute('data-foto');
                sepedaPreview.src = fotoUrl;
            }
            function calculateTotal() {
                if (!tglPinjam.value || !tglPulang.value) return;
                const selectedOption = sepedaSelect.options[sepedaSelect.selectedIndex];
                const sewaPerHari = parseInt(selectedOption.getAttribute('data-sewa'));
                const startDate = new Date(tglPinjam.value);
                const endDate = new Date(tglPulang.value);
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if (diffDays <= 0) {
                    bayarDisplay.value = "Tanggal tidak valid";
                    return;
                }
                const totalBayar = sewaPerHari * diffDays;
                bayarDisplay.value = "Rp " + totalBayar.toLocaleString();
                bayarInput.value = totalBayar;
            }
            const sliderWrapper = document.querySelector('.sepeda-wrapper');
            const cards = document.querySelectorAll('.sepeda-card');
            const prevBtn = document.querySelector('.slider-prev');
            const nextBtn = document.querySelector('.slider-next');
            const sepedaIdInput = document.getElementById('sepeda_id');
            let currentIndex = 0;
            if (cards.length > 0) {
                cards[0].classList.add('active');
                sepedaIdInput.value = cards[0].dataset.id;
                updateSepedaPreview(cards[0].dataset.foto);
            }
            cards.forEach((card, index) => {
                card.addEventListener('click', () => {
                    if (index === currentIndex) return;
                    cards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    sepedaIdInput.value = card.dataset.id;
                    calculateTotal();
                    currentIndex = index;
                    updateSliderPosition();
                    gsap.fromTo(card,
                        {
                            scale: 1.05,
                            borderColor: "#80D0C7"
                        },
                        {
                            scale: 1,
                            borderColor: "#0093E9",
                            duration: 0.5,
                            ease: "elastic.out(1, 0.5)"
                        }
                    );
                });
            });
            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    cards.forEach(c => c.classList.remove('active'));
                    cards[currentIndex].classList.add('active');
                    sepedaIdInput.value = cards[currentIndex].dataset.id;
                    calculateTotal();
                    updateSliderPosition();
                }
            });
            nextBtn.addEventListener('click', () => {
                if (currentIndex < cards.length - 1) {
                    currentIndex++;
                    cards.forEach(c => c.classList.remove('active'));
                    cards[currentIndex].classList.add('active');
                    sepedaIdInput.value = cards[currentIndex].dataset.id;
                    calculateTotal();
                    updateSliderPosition();
                }
            });
            function updateSliderPosition() {
                const cardWidth = 320;
                const containerWidth = sliderWrapper.parentElement.offsetWidth;
                const centerOffset = (containerWidth - cardWidth) / 2;
                const offset = -currentIndex * cardWidth + centerOffset;
                gsap.to(sliderWrapper, {
                    x: offset,
                    duration: 0.5,
                    ease: "power2.out"
                });
                cards.forEach((card, index) => {
                    if (index === currentIndex) {
                        gsap.to(card, {
                            scale: 1,
                            opacity: 1,
                            duration: 0.5,
                            zIndex: 2,
                            borderColor: "#0093E9",
                            filter: "grayscale(0%)",
                            ease: "power2.out"
                        });
                    } else {
                        const distance = Math.abs(index - currentIndex);
                        const scale = Math.max(0.85, 1 - (distance * 0.1));
                        const opacity = Math.max(0.7, 1 - (distance * 0.2));
                        gsap.to(card, {
                            scale: scale,
                            opacity: opacity,
                            duration: 0.5,
                            zIndex: 1,
                            borderColor: "#e5e7eb",
                            filter: "grayscale(30%)",
                            ease: "power2.out"
                        });
                    }
                });
            }
            function updateSepedaPreview(fotoUrl) {
                const sepedaPreview = document.getElementById('sepeda_preview');
                if (sepedaPreview) {
                    sepedaPreview.src = fotoUrl;
                }
            }
            function calculateTotal() {
                if (!tglPinjam.value || !tglPulang.value) return;
                const activeCard = document.querySelector('.sepeda-card.active');
                const sewaPerHari = parseInt(activeCard.dataset.sewa);
                const startDate = new Date(tglPinjam.value);
                const endDate = new Date(tglPulang.value);
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if (diffDays <= 0) {
                    bayarDisplay.value = "Tanggal tidak valid";
                    return;
                }
                const totalBayar = sewaPerHari * diffDays;
                bayarDisplay.value = "Rp " + totalBayar.toLocaleString();
                bayarInput.value = totalBayar;
            }
            let isDragging = false;
            let startPos = 0;
            let currentTranslate = 0;
            let prevTranslate = 0;
            let animationID = 0;
            let currentDragIndex = currentIndex;
            function dragStart(e) {
                if (e.type === 'touchstart') {
                    startPos = e.touches[0].clientX;
                } else {
                    startPos = e.clientX;
                    sliderWrapper.style.cursor = 'grabbing';
                }
                isDragging = true;
                animationID = requestAnimationFrame(animation);
            }
            function animation() {
                if (isDragging) {
                    requestAnimationFrame(animation);
                }
            }
            function dragEnd() {
                isDragging = false;
                cancelAnimationFrame(animationID);
                sliderWrapper.style.cursor = 'grab';
                const movedBy = currentTranslate - prevTranslate;
                if (movedBy < -100 && currentIndex < cards.length - 1) {
                    currentIndex += 1;
                }
                if (movedBy > 100 && currentIndex > 0) {
                    currentIndex -= 1;
                }
                cards.forEach(c => c.classList.remove('active'));
                cards[currentIndex].classList.add('active');
                sepedaIdInput.value = cards[currentIndex].dataset.id;
                calculateTotal();
                updateSliderPosition();
            }
            window.addEventListener('resize', updateSliderPosition);
            updateSliderPosition();
        });
        function closeAlert() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                gsap.to(alert, {
                    opacity: 0,
                    duration: 0.3,
                    onComplete: () => alert.remove()
                });
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const rentalForm = document.querySelector('form[action*="transaksi"]');
            if (rentalForm) {
                rentalForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const currentScroll = window.pageYOffset;
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                    try {
                        const loadingContainer = document.createElement('div');
                        loadingContainer.className = 'modern-loading';
                        loadingContainer.innerHTML = `
                            <div class="loading-content">
                                <div class="loading-bike">🚲</div>
                                <div class="loading-text">Memproses Transaksi...</div>
                                <div class="loading-progress">
                                    <div class="progress-bar"></div>
                                </div>
                            </div>
                        `;
                        document.body.appendChild(loadingContainer);
                        const tl = gsap.timeline({
                            onComplete: () => {
                                gsap.to(loadingContainer, {
                                    duration: 0.5,
                                    opacity: 0,
                                    onComplete: () => {
                                        loadingContainer.remove();
                                        Swal.fire({
                                            title: 'Transaksi Berhasil!',
                                            text: data.message,
                                            icon: 'success',
                                            showCancelButton: true,
                                            confirmButtonText: 'Lihat Transaksi',
                                            cancelButtonText: 'Tutup',
                                            allowOutsideClick: false,
                                            background: 'rgba(255, 255, 255, 0.95)',
                                            backdrop: `
                                                rgba(0,0,123,0.4)
                                                url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cstyle%3E.spinner_V8m1%7Btransform-origin:center;animation:spinner_zKoa 2s linear infinite%7D.spinner_V8m1 circle%7Bstroke-linecap:round;animation:spinner_YpZS 1.5s ease-in-out infinite%7D%40keyframes spinner_zKoa%7B100%25%7Btransform:rotate(360deg)%7D%7D%40keyframes spinner_YpZS%7B0%25%7Bstroke-dasharray:0 150;stroke-dashoffset:0%7D47.5%25%7Bstroke-dasharray:42 150;stroke-dashoffset:-16%7D95%25%2C100%25%7Bstroke-dasharray:42 150;stroke-dashoffset:-59%7D%7D%3C%2Fstyle%3E%3Cg class='spinner_V8m1'%3E%3Ccircle cx='12' cy='12' r='9.5' fill='none' stroke='%23fff' stroke-width='3'%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E")
                                                center center no-repeat
                                            `
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = '/transaksi';
                                            }
                                        });
                                        confetti({
                                            particleCount: 100,
                                            spread: 70,
                                            origin: { y: 0.6 }
                                        });
                                    }
                                });
                            }
                        });
                        tl.to(loadingContainer, {
                            duration: 0.3,
                            opacity: 1
                        })
                        .to(loadingContainer.querySelector('.loading-bike'), {
                            duration: 0.5,
                            opacity: 1,
                            y: 0,
                            ease: "back.out(1.7)"
                        })
                        .to(loadingContainer.querySelector('.loading-text'), {
                            duration: 0.5,
                            opacity: 1,
                            y: 0,
                            ease: "back.out(1.7)"
                        }, "-=0.3")
                        .to(loadingContainer.querySelector('.loading-progress'), {
                            duration: 0.5,
                            opacity: 1,
                            y: 0,
                            ease: "back.out(1.7)"
                        }, "-=0.3")
                        .to(loadingContainer.querySelector('.progress-bar'), {
                            duration: 1.5,
                            width: "100%",
                            ease: "power1.inOut"
                        });
                        const formData = new FormData(this);
                        const response = await fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        const data = await response.json();
                        if (data.success) {
                            this.reset();
                            window.scrollTo({
                                top: currentScroll,
                                behavior: 'instant'
                            });
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan. Silakan coba lagi.',
                            icon: 'error'
                        });
                    } finally {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }
                });
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollToPlugin.min.js"></script>
</body>
</html>
