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
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 280px;
            background-color: #0093E9;
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
            z-index: 50;
            transition: all 0.3s ease;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: white;
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            margin: 0.5rem 0.75rem;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }
        
        .sidebar-link.active {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .main-content {
            margin-left: 280px;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 100%;
                max-width: 300px;
                z-index: 60;
            }
            
            .sidebar.open {
                transform: translateX(0);
                box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            }
            
            .main-content {
                margin-left: 0 !important;
                padding-top: 60px !important;
            }

            .mobile-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 55;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .mobile-overlay.show {
                display: block;
                opacity: 1;
            }

            .mobile-header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 60px;
                background-color: #0093E9;
                background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
                padding: 0 1rem;
                display: flex;
                align-items: center;
                z-index: 50;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
        }

        .sidebar-link .glass-effect {
            transition: all 0.3s ease;
        }
        
        .sidebar-link:hover .glass-effect {
            transform: rotate(10deg);
            background: rgba(255, 255, 255, 0.3);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
   
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
</head>
<body class="bg-gray-100" x-data="{ isSidebarOpen: false }">
    <div class="mobile-overlay lg:hidden" 
         x-show="isSidebarOpen" 
         @click="isSidebarOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <div class="mobile-header lg:hidden">
        <button @click="isSidebarOpen = !isSidebarOpen" 
                class="p-2 rounded-lg glass-effect text-white hover:bg-white/20 transition-colors">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <div class="flex items-center ml-4">
            <i class="fas fa-bicycle text-white text-xl mr-2"></i>
            <span class="text-white font-semibold">Rental Sepeda Pantai</span>
        </div>
    </div>

    <aside class="sidebar shadow-xl" 
           :class="{'open': isSidebarOpen}"
           @keydown.escape="isSidebarOpen = false">
        <div class="flex justify-end p-4 lg:hidden">
            <button @click="isSidebarOpen = false" 
                    class="p-2 rounded-lg glass-effect text-white hover:bg-white/20 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="p-6">
            <div class="flex items-center space-x-3 mb-10">
                <div class="glass-effect p-3 rounded-xl">
                    <i class="fas fa-bicycle text-white text-2xl"></i>
                </div>
                <div>
                    <a class="text-white text-xl font-bold tracking-wider" href="/">
                        Rental Sepeda Pantai
                    </a>
                    <p class="text-white/80 text-sm font-medium">Sewa Sepeda Terpercaya</p>
                </div>
            </div>

            <div class="space-y-3">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link group">
                            <div class="glass-effect p-2 rounded-lg mr-3">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        <a href="{{ route('peminjam.index') }}" class="sidebar-link group">
                            <div class="glass-effect p-2 rounded-lg mr-3">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            <span class="font-medium">Peminjam</span>
                        </a>
                        <a href="{{ route('sepeda.index') }}" class="sidebar-link group">
                            <div class="glass-effect p-2 rounded-lg mr-3">
                                <i class="fas fa-bicycle text-white"></i>
                            </div>
                            <span class="font-medium">Sepeda</span>
                        </a>
                    @endif
                @endauth

                <a href="{{ url('/') }}" class="sidebar-link group">
                    <div class="glass-effect p-2 rounded-lg mr-3">
                        <i class="fas fa-home text-white"></i>
                    </div>
                    <span class="font-medium">Homepage</span>
                </a>

                <a href="{{ route('transaksi.index') }}" class="sidebar-link group">
                    <div class="glass-effect p-2 rounded-lg mr-3">
                        <i class="fas fa-receipt text-white"></i>
                    </div>
                    <span class="font-medium">Transaksi</span>
                </a>
                
                @auth
                    <a href="{{ route('profile') }}" class="sidebar-link group">
                        <div class="glass-effect p-2 rounded-lg mr-3">
                            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'default-profile.png' }}" 
                                 alt="Profile" 
                                 class="w-8 h-8 rounded-lg object-cover">
                        </div>
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                    </a>
                    
                    <form action="{{ route('logout')}}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="sidebar-link w-full text-left group hover:bg-red-500/20">
                            <div class="glass-effect p-2 rounded-lg mr-3">
                                <i class="fas fa-sign-out-alt text-white"></i>
                            </div>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </aside>

    <main class="main-content">
        <div class="p-4 lg:p-6">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <script>
        new DataTable('#example');
        
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            
            sidebarLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            if (window.innerWidth >= 1024) {
                Alpine.store('sidebar', { isSidebarOpen: true });
            }

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    Alpine.store('sidebar', { isSidebarOpen: true });
                } else {
                    Alpine.store('sidebar', { isSidebarOpen: false });
                }
            });

            const body = document.querySelector('body');
            Alpine.watch('isSidebarOpen', value => {
                if (window.innerWidth < 1024) {
                    if (value) {
                        body.style.overflow = 'hidden';
                    } else {
                        body.style.overflow = '';
                    }
                }
            });
        });
    </script>
</body>
</html>