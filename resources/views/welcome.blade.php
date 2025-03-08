<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Sepeda Pantai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <!-- GSAP Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
        
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
        
        .gsap-reveal {
            opacity: 0;
            visibility: hidden;
        }
        
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

        /* Efek hover baru */
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
            min-width: 280px;
            height: 360px;
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
            min-width: 320px;
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
        
        /* Tambahkan efek glow untuk card aktif */
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
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100">
    <!-- Cursor Elements -->
    <div class="cursor"></div>
    <div class="cursor-follower"></div>
    
    <!-- Scroll Progress Indicator -->
    <div class="scroll-indicator" id="scrollIndicator"></div>
    
    <!-- Navbar -->
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

        <!-- Mobile Menu -->
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

    <!-- Hero Section -->
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

    <!-- Features Section -->
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

    <!-- Peminjaman Langsung Section -->
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
                    <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
                            <h3 class="text-lg font-semibold mb-4">Informasi Peminjam:</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Nama:</span> {{ Auth::user()->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ Auth::user()->email }}</p>
                                <p><span class="font-medium">Alamat:</span> {{ Auth::user()->address }}</p>
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Foto Profil" 
                                 class="w-32 h-32 object-cover rounded-full border-4 border-blue-500 shadow-lg transition-transform transform hover:scale-110">
                        </div>
                    </div>

                    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
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

    <!-- Bikes Section -->
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

    <!-- Testimonials Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 gsap-reveal">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pengalaman pelanggan kami yang telah menggunakan layanan rental sepeda pantai
                </p>
            </div>

            @auth
            <!-- Form Rating -->
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

            <!-- Daftar Testimonial -->
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

    <!-- Footer -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize GSAP ScrollTrigger
            gsap.registerPlugin(ScrollTrigger);
            
            // Scroll Progress Indicator
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
            
            // Reveal animations for sections
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
            
            // Smooth scroll for anchor links
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
            
            // Peminjaman sepeda functionality
            const sepedaSelect = document.getElementById('sepeda_id');
            const sepedaPreview = document.getElementById('sepeda_preview');
            const tglPinjam = document.getElementById('tgl_pinjam');
            const tglPulang = document.getElementById('tgl_pulang');
            const bayarDisplay = document.getElementById('bayar_display');
            const bayarInput = document.getElementById('bayar');
            
            // Set initial preview image
            if (sepedaSelect && sepedaPreview) {
                updateSepedaPreview();
                calculateTotal();
            }
            
            // Update preview when sepeda selection changes
            if (sepedaSelect) {
                sepedaSelect.addEventListener('change', function() {
                    updateSepedaPreview();
                    calculateTotal();
                });
            }
            
            // Calculate total when dates change
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
                
                // Calculate days difference
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

            // Sepeda Slider functionality
            const sliderWrapper = document.querySelector('.sepeda-wrapper');
            const cards = document.querySelectorAll('.sepeda-card');
            const prevBtn = document.querySelector('.slider-prev');
            const nextBtn = document.querySelector('.slider-next');
            const sepedaIdInput = document.getElementById('sepeda_id');
            let currentIndex = 0;

            // Initialize first card as active
            if (cards.length > 0) {
                cards[0].classList.add('active');
                sepedaIdInput.value = cards[0].dataset.id;
                updateSepedaPreview(cards[0].dataset.foto);
            }

            // Card click handler
            cards.forEach((card, index) => {
                card.addEventListener('click', () => {
                    if (index === currentIndex) return;
                    
                    // Remove active class from all cards
                    cards.forEach(c => c.classList.remove('active'));
                    // Add active class to clicked card
                    card.classList.add('active');
                    // Update selected sepeda
                    sepedaIdInput.value = card.dataset.id;
                    calculateTotal();
                    
                    // Animate to center
                    currentIndex = index;
                    updateSliderPosition();
                    
                    // Tambahkan efek highlight untuk card yang dipilih
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

            // Previous button handler
            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    // Hapus kelas active dari semua card
                    cards.forEach(c => c.classList.remove('active'));
                    // Tambahkan kelas active ke card yang baru
                    cards[currentIndex].classList.add('active');
                    // Update nilai input sepeda yang dipilih
                    sepedaIdInput.value = cards[currentIndex].dataset.id;
                    // Hitung ulang total
                    calculateTotal();
                    // Update posisi slider
                    updateSliderPosition();
                }
            });

            // Next button handler
            nextBtn.addEventListener('click', () => {
                if (currentIndex < cards.length - 1) {
                    currentIndex++;
                    // Hapus kelas active dari semua card
                    cards.forEach(c => c.classList.remove('active'));
                    // Tambahkan kelas active ke card yang baru
                    cards[currentIndex].classList.add('active');
                    // Update nilai input sepeda yang dipilih
                    sepedaIdInput.value = cards[currentIndex].dataset.id;
                    // Hitung ulang total
                    calculateTotal();
                    // Update posisi slider
                    updateSliderPosition();
                }
            });

            function updateSliderPosition() {
                const cardWidth = 320;
                const containerWidth = sliderWrapper.parentElement.offsetWidth;
                const centerOffset = (containerWidth - cardWidth) / 2;
                const offset = -currentIndex * cardWidth + centerOffset;
                
                // Animasi dengan GSAP
                gsap.to(sliderWrapper, {
                    x: offset,
                    duration: 0.5,
                    ease: "power2.out"
                });
                
                // Update tampilan card
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

            // Update the existing updateSepedaPreview function
            function updateSepedaPreview(fotoUrl) {
                const sepedaPreview = document.getElementById('sepeda_preview');
                if (sepedaPreview) {
                    sepedaPreview.src = fotoUrl;
                }
            }

            // Update the existing calculateTotal function
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

            // Touch and Drag functionality
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
                
                // If moved enough negative
                if (movedBy < -100 && currentIndex < cards.length - 1) {
                    currentIndex += 1;
                }
                // If moved enough positive
                if (movedBy > 100 && currentIndex > 0) {
                    currentIndex -= 1;
                }
                
                cards.forEach(c => c.classList.remove('active'));
                cards[currentIndex].classList.add('active');
                sepedaIdInput.value = cards[currentIndex].dataset.id;
                calculateTotal();
                
                updateSliderPosition();
            }

            // Initialize slider
            window.addEventListener('resize', updateSliderPosition);
            updateSliderPosition(); // Call once at start
        });
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollToPlugin.min.js"></script>
</body>
</html>