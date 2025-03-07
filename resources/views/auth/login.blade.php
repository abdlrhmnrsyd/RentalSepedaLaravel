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
</head>
<body>
    <div class="bg-white dark:bg-gray-900">
        <div class="flex justify-center h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url(https://images.unsplash.com/photo-1571068316344-75bc76f77890?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80)">
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                    <div>
                        <h2 class="text-2xl font-bold text-white sm:text-3xl">Rental Sepeda Pantai</h2>

                        <p class="max-w-xl mt-3 text-gray-300">
                            Selamat datang di layanan rental sepeda pantai kami. Nikmati pengalaman bersepeda yang menyenangkan dengan berbagai pilihan sepeda berkualitas.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
                <div class="flex-1">
                    <div class="text-center">
                        <div class="flex justify-center mx-auto">
                            <i class="fas fa-bicycle text-5xl text-blue-600 mb-4"></i>
                        </div>

                        <p class="mt-3 text-gray-500 dark:text-gray-300">Masuk untuk mengakses akun Anda</p>
                    </div>

                    <div class="mt-8">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div>
                                <label for="login" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Email atau Username</label>
                                <input type="text" name="login" id="login" value="{{ old('login') }}" placeholder="Masukkan email atau username" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                                @error('login')
                                    <div class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password" class="text-sm text-gray-600 dark:text-gray-200">Password</label>
                                </div>

                                <input type="password" name="password" id="password" placeholder="Password Anda" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                                @error('password')
                                    <div class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Masuk
                                </button>
                            </div>
                        </form>

                        <p class="mt-6 text-sm text-center text-gray-400">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500 focus:outline-none focus:underline hover:underline">Daftar disini</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>