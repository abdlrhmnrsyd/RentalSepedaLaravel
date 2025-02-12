<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Sepeda Pantai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .nav-link-hover {
            position: relative;
        }
        .nav-link-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: #f3f3f3;
            transition: width 0.3s ease;
        }
        .nav-link-hover:hover::after {
            width: 100%;
        }
    </style>
   
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-gradient-to-r from-indigo-900 via-purple-800 to-pink-900 shadow-lg" x-data="{ isOpen: false }">
        <div class="container mx-auto px-3">
            <div class="flex justify-between items-center py-2">
                <div class="flex items-center space-x-3">
                    <div class="glass-effect p-2 rounded-lg">
                        <i class="fas fa-bicycle text-white text-xl transform hover:rotate-12 transition-transform duration-300"></i>
                    </div>
                    <div>
                        <a class="text-white text-xl font-bold tracking-wider hover:text-pink-200 transition duration-300" href="/">
                            <span class="text-pink-300">Bike</span>Rent
                        </a>
                        <p class="text-gray-300 text-xs font-medium italic">Sewa Sepeda Terpercaya</p>
                    </div>
                </div>
                
                <div class="hidden lg:flex items-center space-x-6">
                    <a class="nav-link-hover text-white hover:text-pink-200 transition duration-300 flex items-center space-x-2 px-3 py-1" 
                       href="{{ route('peminjam.index') }}">
                        <div class="glass-effect p-1.5 rounded-lg">
                            <i class="fas fa-users text-sm"></i>
                        </div>
                        <span class="font-medium text-sm">Peminjam</span>
                    </a>
                    <a class="nav-link-hover text-white hover:text-pink-200 transition duration-300 flex items-center space-x-2 px-3 py-1" 
                       href="{{ route('sepeda.index') }}">
                        <div class="glass-effect p-1.5 rounded-lg">
                            <i class="fas fa-bicycle text-sm"></i>
                        </div>
                        <span class="font-medium text-sm">Sepeda</span>
                    </a>
                    <a class="nav-link-hover text-white hover:text-pink-200 transition duration-300 flex items-center space-x-2 px-3 py-1" 
                       href="{{ route('transaksi.index') }}">
                        <div class="glass-effect p-1.5 rounded-lg">
                            <i class="fas fa-receipt text-sm"></i>
                        </div>
                        <span class="font-medium text-sm">Transaksi</span>
                    </a>
                    <form action="{{ route('logout')}}" method="POST" class="inline">
                        @csrf
                        @method('POST')
                        <button type="submit" class="nav-link-hover text-white hover:text-pink-200 transition duration-300 flex items-center space-x-2 px-3 py-1">
                            <div class="glass-effect p-1.5 rounded-lg">
                                <i class="fas fa-sign-out-alt text-sm"></i>
                            </div>
                            <span class="font-medium text-sm">Logout</span>
                        </button>
                    </form>
                </div>

                <div class="lg:hidden">
                    <button @click="isOpen = !isOpen" class="glass-effect p-1.5 rounded-lg text-white hover:text-pink-200 focus:outline-none">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>

            <div class="lg:hidden" x-show="isOpen" @click.away="isOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4">
                <div class="py-3 space-y-2">
                    <a class="block text-white hover:bg-white/10 px-3 py-2 rounded-lg transition duration-300 flex items-center space-x-2" 
                       href="{{ route('peminjam.index') }}">
                        <div class="glass-effect p-1.5 rounded-lg">
                            <i class="fas fa-users text-sm"></i>
                        </div>
                        <span class="text-sm">Peminjam</span>
                    </a>
                    <a class="block text-white hover:bg-white/10 px-3 py-2 rounded-lg transition duration-300 flex items-center space-x-2" 
                       href="{{ route('sepeda.index') }}">
                        <div class="glass-effect p-1.5 rounded-lg">
                            <i class="fas fa-bicycle text-sm"></i>
                        </div>
                        <span class="text-sm">Sepeda</span>
                    </a>
                    <a class="block text-white hover:bg-white/10 px-3 py-2 rounded-lg transition duration-300 flex items-center space-x-2" 
                       href="{{ route('transaksi.index') }}">
                        <div class="glass-effect p-1.5 rounded-lg">
                            <i class="fas fa-receipt text-sm"></i>
                        </div>
                        <span class="text-sm">Transaksi</span>
                    </a>
                    <form action="{{ route('logout')}}" method="POST">
                        @csrf 
                        @method('POST')
                        <button type="submit" class="w-full text-left text-white hover:bg-white/10 px-3 py-2 rounded-lg transition duration-300 flex items-center space-x-2">
                            <div class="glass-effect p-1.5 rounded-lg">
                                <i class="fas fa-sign-out-alt text-sm"></i>
                            </div>
                            <span class="text-sm">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <!-- Tambahkan JavaScript yang diperlukan -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <script>
        new DataTable('#example');
        </script>   
   
</body>
</html>