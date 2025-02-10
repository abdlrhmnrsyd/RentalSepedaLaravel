<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Sepeda Pantai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-bicycle text-white text-2xl"></i>
                    <div>
                        <a class="text-white text-xl font-bold" href="/">BikeRent</a>
                        <p class="text-blue-100 text-xs">Sewa Sepeda Pantai Terpercaya</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a class="text-white hover:text-blue-200 transition duration-300 flex items-center space-x-1" href="{{ route('peminjam.index') }}">
                        <i class="fas fa-users text-sm"></i>
                        <span>Peminjam</span>
                    </a>
                    <a class="text-white hover:text-blue-200 transition duration-300 flex items-center space-x-1" href="{{ route('sepeda.index') }}">
                        <i class="fas fa-bicycle text-sm"></i>
                        <span>Sepeda</span>
                    </a>
                    <a class="text-white hover:text-blue-200 transition duration-300 flex items-center space-x-1" href="{{ route('transaksi.index') }}">
                        <i class="fas fa-receipt text-sm"></i>
                        <span>Transaksi</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>
</html>