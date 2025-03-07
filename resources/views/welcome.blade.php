<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Rent</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <style>
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
        
        .scroll-animations {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-animations.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-bicycle text-3xl text-blue-600 mr-2">Bike Rent</i>
                    <span class="font-bold text-xl text-blue-600"></span>
                </div>
                
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        <div>
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-300">Dashboard</a>
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
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                        Nikmati Keindahan Pantai dengan Sepeda Kami
                    </h1>
                    <p class="text-xl text-white opacity-90 mb-8">
                        Sewa sepeda berkualitas untuk menikmati pemandangan yang indah dengan harga terjangkau.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-blue-600 font-medium rounded-lg shadow-md hover:bg-gray-100 transition-colors duration-300 text-center">
                            Mulai Sekarang
                        </a>
                        <a href="#tentang" class="px-6 py-3 bg-transparent border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-blue-600 transition-colors duration-300 text-center">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Sepeda Pantai" class="rounded-lg shadow-2xl max-w-full h-auto" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white" id="tentang">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Memilih Kami?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan layanan rental sepeda terbaik dengan berbagai keunggulan
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-blue-50 p-8 rounded-xl shadow-md scroll-animations">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-bicycle text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Sepeda Berkualitas</h3>
                    <p class="text-gray-600 text-center">
                        Kami hanya menyediakan sepeda berkualitas tinggi yang terawat dengan baik untuk kenyamanan Anda.
                    </p>
                </div>
                
                <div class="bg-blue-50 p-8 rounded-xl shadow-md scroll-animations" style="transition-delay: 0.2s;">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-map-marker-alt text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Lokasi Strategis</h3>
                    <p class="text-gray-600 text-center">
                        Lokasi rental kami berada di dekat pantai dengan akses mudah ke berbagai tempat wisata menarik.
                    </p>
                </div>
                
                <div class="bg-blue-50 p-8 rounded-xl shadow-md scroll-animations" style="transition-delay: 0.4s;">
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

    <!-- Bikes Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Pilihan Sepeda Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Berbagai jenis sepeda yang dapat Anda sewa untuk menikmati liburan di pantai
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 scroll-animations">
                    <img src="https://images.unsplash.com/photo-1485965120184-e220f721d03e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Road Bike" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Sepeda Jalan</h3>
                        <p class="text-gray-600 mb-4">
                            Sepeda ringan dan cepat, ideal untuk perjalanan jarak jauh di jalan beraspal.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-bold">Rp 50.000/jam</span>
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 scroll-animations" style="transition-delay: 0.2s;">
                    <img src="https://images.unsplash.com/photo-1532298229144-0ec0c57515c7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Mountain Bike" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Sepeda Gunung</h3>
                        <p class="text-gray-600 mb-4">
                            Sepeda tangguh dengan suspensi untuk medan yang tidak rata dan petualangan off-road.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-bold">Rp 75.000/jam</span>
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 scroll-animations" style="transition-delay: 0.4s;">
                    <img src="https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Beach Cruiser" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Sepeda Pantai</h3>
                        <p class="text-gray-600 mb-4">
                            Sepeda nyaman dengan ban lebar, sempurna untuk bersantai di sepanjang pantai.
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-bold">Rp 60.000/jam</span>
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pengalaman pelanggan kami yang telah menggunakan layanan rental sepeda pantai
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-blue-50 p-8 rounded-xl shadow-md scroll-animations">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-600 font-bold">BP</span>
                        </div>
                        <div>
                            <h4 class="font-semibold">Budi Pratama</h4>
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
                        "Sepeda yang disewakan sangat berkualitas dan terawat dengan baik. Pelayanannya juga ramah dan profesional. Sangat direkomendasikan!"
                    </p>
                </div>
                
                <div class="bg-blue-50 p-8 rounded-xl shadow-md scroll-animations" style="transition-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-600 font-bold">SW</span>
                        </div>
                        <div>
                            <h4 class="font-semibold">Siti Wulandari</h4>
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
                
                <div class="bg-blue-50 p-8 rounded-xl shadow-md scroll-animations" style="transition-delay: 0.4s;">
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

    <!-- CTA Section -->
    <section class="py-16 hero-pattern">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white mb-6">Siap Untuk Berpetualang?</h2>
                <p class="text-xl text-white opacity-90 mb-8">
                    Daftar sekarang dan nikmati pengalaman bersepeda di pantai yang tak terlupakan
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-blue-600 font-medium rounded-lg shadow-md hover:bg-gray-100 transition-colors duration-300">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-transparent border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-blue-600 transition-colors duration-300">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-bicycle text-3xl text-blue-400 mr-2"></i>
                        <span class="font-bold text-xl">Rental Sepeda Pantai</span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Nikmati pengalaman bersepeda di pantai yang menyenangkan dengan sepeda berkualitas.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Layanan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Rental Sepeda</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Tur Sepeda</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Perbaikan Sepeda</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Aksesoris Sepeda</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Informasi</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">FAQ</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2 text-blue-400"></i>
                            <span class="text-gray-400">Jl. Pantai Indah No. 123, Bali, Indonesia</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-2 text-blue-400"></i>
                            <span class="text-gray-400">+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-2 text-blue-400"></i>
                            <span class="text-gray-400">info@rentalsepedapantai.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2023 Rental Sepeda Pantai. Hak Cipta Dilindungi.</p>
            </div>
    </div>
    </footer>

    <script>
        // Scroll animation
        document.addEventListener('DOMContentLoaded', function() {
            const scrollAnimations = document.querySelectorAll('.scroll-animations');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, { threshold: 0.1 });
            
            scrollAnimations.forEach(animation => {
                observer.observe(animation);
            });
        });
    </script>
</body>
</html>