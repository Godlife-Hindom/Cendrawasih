<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register SPK Cendrawasih</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .delay-2s {
            animation-delay: 1s;
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
    </style>
</head>
<body class="bg-gradient-to-tr from-emerald-100 via-white to-emerald-200 min-h-screen relative overflow-x-hidden">

    <!-- Background Parallax -->
    <div class="parallax"></div>
    
    <!-- Background Dekoratif -->
    <div class="fixed w-80 h-80 bg-emerald-200 rounded-full opacity-30 blur-2xl top-[-60px] left-[-60px] animate-float z-0"></div>
    <div class="fixed w-96 h-96 bg-green-300 rounded-full opacity-40 blur-2xl bottom-[-60px] right-[-80px] animate-float delay-2s z-0"></div>

    <!-- Wrapper agar konten bisa discroll -->
    <div class="relative z-10 flex flex-col items-center px-4 py-12 min-h-screen">
        <div class="bg-white/70 backdrop-blur-xl border border-white/30 shadow-2xl p-10 rounded-3xl w-full max-w-md animate-fade-in">
            <div class="text-center mb-6">
                <img src="{{ asset('images/pp.png') }}" class="w-20 h-20 rounded-full mx-auto shadow-md" alt="Cendrawasih">
                <h2 class="text-2xl font-bold text-gray-800 mt-4">Daftar Akun</h2>
                <p class="text-gray-500 text-sm">Sistem SPK Penangkaran Cendrawasih</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                    @error('name')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Daftar Sebagai</label>
                    <select id="role" name="role" required
                            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                        <option value="user">User</option>
                    </select>
                    @error('role')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" required
                               class="mt-1 w-full px-4 py-2 pr-12 border border-gray-300 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                        <button type="button" onclick="togglePassword('password')" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                            <svg id="eye-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-slash-password" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               class="mt-1 w-full px-4 py-2 pr-12 border border-gray-300 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                        <button type="button" onclick="togglePassword('password_confirmation')" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                            <svg id="eye-password_confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-slash-password_confirmation" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl shadow-lg transition-all duration-300">
                    Daftar
                </button>
            </form>

            <p class="text-center text-sm text-gray-600 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-emerald-600 hover:underline font-medium">Masuk</a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById('eye-' + fieldId);
            const eyeSlashIcon = document.getElementById('eye-slash-' + fieldId);
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }
    </script>

</body>
</html>