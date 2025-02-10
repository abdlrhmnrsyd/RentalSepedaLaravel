<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Sepeda Pantai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <title>login</title>
    <style>
        .bike-bg {
            background-image: url('https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
        }
        
        .glass-effect {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
    </style>
</head>
<body class="bike-bg min-h-screen flex items-center justify-center bg-gray-100">
    <div class="container max-w-md mx-auto glass-effect p-8 rounded-2xl">
        <div class="text-center mb-8">
            <i class="fas fa-bicycle text-5xl text-blue-600 mb-4"></i>
            <h2 class="text-3xl font-bold text-gray-800">Selamat Datang</h2>
            <p class="text-gray-600 mt-2">di Rental Sepeda</p>
        </div>
        
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="login" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-user mr-2"></i>Name or Email
                </label>
                <input type="text" 
                       id="login" 
                       name="login" 
                       value="{{ old('login') }}" 
                       required
                       class="w-full px-4 py-2 bg-transparent border-b-2 border-gray-300 focus:border-blue-500 focus:outline-none transition-all duration-300">
                @error('login')
                    <div class="text-red-500 text-sm"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    <i class="fas fa-lock mr-2"></i>Password
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required
                       class="w-full px-4 py-2 bg-transparent border-b-2 border-gray-300 focus:border-blue-500 focus:outline-none transition-all duration-300">
                @error('password')
                    <div class="text-red-500 text-sm"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 flex items-center justify-center space-x-2">
                <i class="fas fa-sign-in-alt"></i>
                <span>Masuk</span>
            </button>
        </form>

        <div class="text-center mt-6 text-sm text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">
                Daftar disini
            </a>
        </div>
    </div>
</body>
</html>