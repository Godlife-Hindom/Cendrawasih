<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SPK Cenderawasih</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/pp.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow-y: auto;
        }

        .parallax {
            background-image: url('{{ asset('images/pp.png') }}'); /* Ganti dengan gambar burungmu */
            background-attachment: fixed;
            background-position: center;
            background-size: 43%;
            opacity: 0.20;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 158%;
            z-index: -1;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .logo-bounce:hover {
            animation: float 0.6s ease-in-out;
        }

        /* Responsive breakpoints */
        @media (max-width: 640px) {
            .parallax {
                background-size: 60%;
                opacity: 0.1;
            }
        }

        @media (max-width: 480px) {
            .parallax {
                background-size: 80%;
                opacity: 0.08;
            }
        }

        /* Custom scrollbar styles */
        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(16, 185, 129, 0.6);
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(16, 185, 129, 0.8);
        }

        /* For Firefox */
        html {
            scrollbar-width: thin;
            scrollbar-color: rgba(16, 185, 129, 0.6) rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-tr from-emerald-100 via-white to-emerald-200 min-h-screen flex items-center justify-center relative overflow-x-hidden p-4 sm:p-6 md:p-8">

    <!-- Background Parallax -->
    <div class="parallax"></div>
    
    <!-- Decorative floating elements -->
    <div class="absolute w-60 h-60 sm:w-80 sm:h-80 lg:w-96 lg:h-96 bg-emerald-200 rounded-full opacity-30 blur-2xl top-[-30px] sm:top-[-60px] left-[-30px] sm:left-[-60px]"></div>
    <div class="absolute w-72 h-72 sm:w-96 sm:h-96 lg:w-[400px] lg:h-[400px] bg-green-300 rounded-full opacity-40 blur-2xl bottom-[-40px] sm:bottom-[-60px] right-[-40px] sm:right-[-80px]"></div>
    
    <!-- Additional decorative elements -->
    <div class="absolute w-32 h-32 sm:w-48 sm:h-48 bg-emerald-300 rounded-full opacity-20 blur-xl top-1/4 right-1/4"></div>
    <div class="absolute w-24 h-24 sm:w-32 sm:h-32 bg-green-200 rounded-full opacity-25 blur-lg bottom-1/3 left-1/4"></div>

    <!-- Login card -->
    <div class="glass-effect shadow-2xl p-6 sm:p-8 md:p-10 rounded-3xl w-full max-w-sm sm:max-w-md lg:max-w-lg z-10 relative overflow-hidden">
        
        <div class="text-center mb-6 sm:mb-8 relative z-10">
            <div class="relative inline-block">
                <div class="absolute inset-0 bg-emerald-400 rounded-full blur-lg opacity-30"></div>
                <img src="{{ asset('images/pp.png') }}" class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-full mx-auto shadow-lg relative z-10 logo-bounce hover:scale-110 transition-all duration-300" alt="Cendrawasih">
            </div>
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800 mt-4">Selamat Datang</h2>
            <p class="text-gray-500 text-xs sm:text-sm md:text-base">Sistem SPK Penangkaran Cenderawasih</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-6 relative z-10">
            @csrf

            <!-- Email -->
            <div class="">
                <x-input-label for="email" :value="__('Email')" class="text-sm sm:text-base font-medium text-gray-700" />
                <div class="relative mt-1 sm:mt-2">
                    <x-text-input id="email" class="block w-full px-4 py-2 sm:py-3 text-sm sm:text-base border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 input-focus bg-white/50 backdrop-blur-sm"
                                  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="">
                <x-input-label for="password" :value="__('Password')" class="text-sm sm:text-base font-medium text-gray-700" />
                <div class="relative mt-1 sm:mt-2">
                    <x-text-input id="password" class="block w-full px-4 py-2 sm:py-3 text-sm sm:text-base border border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300 input-focus bg-white/50 backdrop-blur-sm"
                                  type="password" name="password" required autocomplete="current-password" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me dan Show Password -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 transition-all duration-200 hover:scale-110" name="remember">
                    <span class="ml-2 text-xs sm:text-sm text-gray-600 group-hover:text-gray-800 transition-colors duration-200">{{ __('Remember me') }}</span>
                </label>

                <label for="show_password" class="inline-flex items-center group cursor-pointer">
                    <input id="show_password" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 transition-all duration-200 hover:scale-110" onchange="togglePassword()">
                    <span class="ml-2 text-xs sm:text-sm text-gray-600 group-hover:text-gray-800 transition-colors duration-200">Show Password</span>
                </label>
            </div>

            <!-- Forgot + Submit -->
            <div class="flex flex-col sm:flex-row items-center justify-center mt-4 sm:mt-6 space-y-3 sm:space-y-0">
                <x-primary-button class="w-full sm:w-auto justify-center px-6 py-2 sm:py-3 text-sm sm:text-base font-semibold bg-emerald-600 hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-300 rounded-xl btn-hover">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>

        <div class="relative z-10">
            <div class="flex items-center my-4 sm:my-6">
                <div class="flex-1 border-t border-gray-300 opacity-50"></div>
                <span class="px-3 text-xs sm:text-sm text-gray-500 bg-white/50 rounded-lg">atau</span>
                <div class="flex-1 border-t border-gray-300 opacity-50"></div>
            </div>

            <p class="text-center text-xs sm:text-sm text-gray-300">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-emerald-600 hover:text-emerald-700 hover:underline font-medium transition-all duration-200 hover:scale-105 inline-block">Daftar akun</a>
            </p>
        </div>
    </div>

    <!-- Additional background particles -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute w-2 h-2 bg-emerald-300 rounded-full opacity-40 top-1/4 left-1/3"></div>
        <div class="absolute w-1 h-1 bg-green-400 rounded-full opacity-50 top-3/4 left-2/3"></div>
        <div class="absolute w-3 h-3 bg-emerald-200 rounded-full opacity-30 top-1/2 left-1/6"></div>
        <div class="absolute w-2 h-2 bg-green-300 rounded-full opacity-40 top-1/6 right-1/4"></div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const showPasswordCheckbox = document.getElementById('show_password');
            
            if (showPasswordCheckbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</body>
</html>