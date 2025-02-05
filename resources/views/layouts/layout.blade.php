<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Sepeda Pantai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a class="text-white text-lg font-bold" href="/">Rental Sepeda</a>
                <div class="hidden md:flex space-x-4">
                    <a class="text-gray-300 hover:text-white" href="{{ route('peminjam.index') }}">Peminjam</a>
                    <a class="text-gray-300 hover:text-white" href="{{ route('sepeda.index') }}">Sepeda</a>
                    <a class="text-gray-300 hover:text-white" href="{{ route('transaksi.index') }}">Transaksi</a>
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