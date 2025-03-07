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
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100">
    <!-- Scroll Progress Indicator -->
    <div class="scroll-indicator" id="scrollIndicator"></div>
    
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-bicycle text-3xl text-blue-600 mr-2"></i>
                    <span class="font-bold text-xl text-blue-600">Rental Sepeda Pantai</span>
                </div>
                
                <div class="flex items-center space-x-4">
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
                    <!-- Tampilkan info user yang login -->
                    <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Informasi Peminjam:</h3>
                            <div class="space-y-2">
                                <p><span class="font-medium">Nama:</span> {{ Auth::user()->name }}</p>
                                <p><span class="font-medium">Alamat:</span> {{ Auth::user()->address }}</p>
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Foto Profil" 
                                 class="w-32 h-32 object-cover rounded-full border-4 border-blue-500">
                        </div>
                    </div>

                    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="sepeda_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Sepeda</label>
                                <select id="sepeda_id" name="sepeda_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                                    @foreach(App\Models\Sepeda::all() as $sepeda)
                                    <option value="{{ $sepeda->id }}" data-sewa="{{ $sepeda->sewa }}" data-foto="{{ asset('storage/' . $sepeda->foto) }}">
                                        {{ $sepeda->merk }} - Rp {{ number_format($sepeda->sewa, 0, ',', '.') }}/hari
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Sepeda</label>
                                <div class="h-40 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                                    <img id="sepeda_preview" src="" alt="Foto Sepeda" class="max-h-full object-cover">
                                </div>
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

    <!-- Testimonials -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 gsap-reveal">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pengalaman pelanggan kami yang telah menggunakan layanan rental sepeda pantai
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-md gsap-reveal">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-600 font-bold">RE</span>
                        </div>
                        <div>
                            <h4 class="font-semibold">Erwin R</h4>
                            <div class="text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                               
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "Desain Terlalu Meriah, algoritma tidak jelas"
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-md gsap-reveal">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-600 font-bold">SW</span>
                        </div>
                        <div>
                            <h4 class="font-semibold">Abdul Rahman Rasyid</h4>
                            <div class="text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "Pengalaman bersepeda di pantai menjadi lebih menyenangkan dengan sepeda yang nyaman. Harganya juga sangat terjangkau untuk kualitas yang ditawarkan."
                    </p>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-md gsap-reveal">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-600 font-bold">DP</span>
                        </div>
                        <div>
                            <h4 class="font-semibold">Dimas Putra</h4>
                            <div class="text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">
                        "Proses pemesanan yang mudah dan cepat. Sepeda dalam kondisi prima dan cocok untuk menjelajahi pantai. Pasti akan kembali lagi!"
                    </p>
                </div>
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
        });
    </script>
    
    <!-- GSAP ScrollTo Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollToPlugin.min.js"></script>
</body>
</html>