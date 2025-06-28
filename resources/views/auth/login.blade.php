@extends('layouts.app')

@section('content')
    <style>
        @media (max-width: 767px) {
            .login-bg {
                background-image: none !important;
                background-color: #f3f4f6 !important;
            }
        }

        @media (min-width: 768px) {
            .login-bg {
                background-image: url('/images/bg5.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }
        }
        
        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #3b82f6;
            pointer-events: none;
            z-index: 5;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-with-icon {
            padding-left: 2.5rem !important;
            padding-right: 2.5rem !important;
        }
        
        .toggle-password {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6b7280;
            background: none;
            border: none;
            padding: 0.25rem;
            z-index: 10;
            border-radius: 0.25rem;
        }
        
        .toggle-password:hover {
            color: #374151;
            background-color: #f3f4f6;
        }

        /* Fix height issues */
        .login-container {
            min-height: 100vh;
            height: 100vh;
            overflow: hidden;
        }

        .login-card {
            max-height: 90vh;
        }
    </style>
    
    <div class="login-container flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8 login-bg">
        <div class="max-w-md w-full">
            <div class="login-card bg-white border   py-8 px-8 shadow-2xl rounded-2xl">
                <div class="text-center mb-6">
                    <div class="mx-auto h-16 w-16 rounded-full flex items-center justify-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-16 object-contain">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Masuk ke ReMine</h2>
                    <p class="mt-2 text-sm text-gray-600">Kelola tugas dan reminder Anda</p>
                </div>
                
                <form id="loginForm" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div class="input-group">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <span class="input-icon">
                                <svg class="h-5 w-5" fill="none"stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="input-with-icon w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-500 transition"
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <span class="input-icon">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="input-with-icon w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-500 transition"
                                placeholder="Masukkan password">
                            <button type="button" class="toggle-password" tabindex="-1" aria-label="Lihat Password" onclick="togglePassword()">
                                <svg id="eyeOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg id="eyeClosed" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" id="loginBtn"
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-semibold text-white bg-custom-madder hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 transition duration-150 ease-in-out">
                            <span id="loginBtnText">Masuk</span>
                            <svg id="loginSpinner" class="hidden animate-spin -mr-1 ml-3 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="flex items-center my-4">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="mx-3 text-gray-400 text-xs">atau</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-medium text-custom-madder hover:text-red-400 transition">
                                Daftar Akun
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');
            
            if (pwd.type === 'password') {
                pwd.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                pwd.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Logout Berhasil!',
                text: '{{ session("success") }}',
                timer: 1200,
                showConfirmButton: false
            });
        @endif

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const loginBtn = document.getElementById('loginBtn');
            const loginBtnText = document.getElementById('loginBtnText');
            const loginSpinner = document.getElementById('loginSpinner');

            // Show loading state
            loginBtn.disabled = true;
            loginBtnText.textContent = 'Memproses...';
            loginSpinner.classList.remove('hidden');

            // Show loading SweetAlert
            Swal.fire({
                title: 'Sedang masuk...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('{{ route('login') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Server tidak mengembalikan JSON response');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    throw new Error(data.message || 'Login gagal');
                }
            })
            .catch(error => {
                console.error('Login error:', error);

                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal!',
                    text: error.message || 'Email atau password tidak sesuai',
                    confirmButtonText: 'Coba Lagi'
                });

                // Reset button state
                loginBtn.disabled = false;
                loginBtnText.textContent = 'Masuk';
                loginSpinner.classList.add('hidden');
            });
        });
    </script>
@endsection