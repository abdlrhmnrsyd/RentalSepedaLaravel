<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Sepeda Pantai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <title>register</title>
</head>
<body>
    <div class="bg-white dark:bg-gray-900">
        <div class="flex justify-center h-screen">
            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
                <div class="flex-1">
                    <div class="text-center">
                        <div class="flex justify-center mx-auto">
                            <i class="fas fa-bicycle text-5xl text-blue-600 mb-4"></i>
                        </div>

                        <p class="mt-3 text-gray-500 dark:text-gray-300">Daftar akun baru</p>
                    </div>

                    <div class="mt-8">
                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Nama</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Nama lengkap Anda" class="block w-full px-3 py-1.5 mt-1 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" required />
                                @error('name')
                                    <div class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="contoh@email.com" class="block w-full px-3 py-1.5 mt-1 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" required />
                                @error('email')
                                    <div class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <label for="password" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" placeholder="Password Anda" class="block w-full px-3 py-1.5 mt-1 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" required />
                                    <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500" onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="password-icon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <label for="password_confirmation" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Konfirmasi Password</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password Anda" class="block w-full px-3 py-1.5 mt-1 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" required />
                                    <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="photo" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Foto</label>
                                <input type="file" name="photo" id="photo" class="block w-full px-3 py-1.5 mt-1 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" required />
                                @error('photo')
                                    <div class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <label for="address" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Alamat</label>
                                <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Alamat lengkap Anda" class="block w-full px-3 py-1.5 mt-1 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" required />
                                @error('address')
                                    <div class="text-red-500 text-xs mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Daftar
                                </button>
                            </div>
                        </form>

                        <p class="mt-6 text-sm text-center text-gray-400">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 focus:outline-none focus:underline hover:underline">Masuk disini</a>.</p>
                    </div>
                </div>
            </div>
            
            <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url(https://images.unsplash.com/photo-1517649763962-0c623066013b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80)">
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                    <div>
                        <h2 class="text-2xl font-bold text-white sm:text-3xl">Rental Sepeda Pantai</h2>

                        <p class="max-w-xl mt-3 text-gray-300">
                            Bergabunglah dengan kami dan nikmati pengalaman bersepeda di pantai yang menyenangkan. Kami menyediakan berbagai jenis sepeda berkualitas untuk Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>