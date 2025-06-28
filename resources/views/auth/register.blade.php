@extends('layouts.app')

@section('content')
<style>
    @media (max-width: 767px) {
        .register-bg {
            background-image: none !important;
            background-color: #f3f4f6 !important;
        }
    }

    @media (min-width: 768px) {
        .register-bg {
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
    .register-container {
        min-height: 100vh;
        height: 100vh;
        overflow: hidden;
    }

    .register-card {
        max-height: 90vh;
        width: 100%;
        max-width: 800px; /* Ubah dari width: 800px ke max-width */
        margin: 0 auto; /* Tambahkan untuk center */
    }

    /* Responsive adjustments */
    @media (max-width: 868px) {
        .register-card {
            max-width: 95vw; /* Di mobile, gunakan hampir full width */
            margin: 0 auto;
        }
    }

    @media (min-width: 869px) {
        .register-card {
            max-width: 800px; /* Di desktop, gunakan 800px */
        }
    }
</style>

<div class="register-container flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8 register-bg">
    <!-- Ubah container wrapper untuk accommodasi width yang lebih besar -->
    <div class="w-full flex justify-center">
        <div class="register-card bg-white border border-red-200 py-8 px-8 shadow-2xl rounded-2xl">
            <div class="text-center mb-6">
                <div class="mx-auto h-16 w-16 rounded-full flex items-center justify-center mb-4">
                    <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="h-17 w-17">
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Buat Akun ReMine</h2>
            </div>
            
            <!-- Rest of your form content stays the same -->
            <form id="registerForm" class="space-y-3">
                @csrf                    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div class="input-group">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap
                        </label>
                        <div class="relative">
                            <span class="input-icon">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </span>
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="input-with-icon w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-custom-madder  focus:border-custom-madder  transition"
                                placeholder="Masukkan nama lengkap">
                        </div>
                    </div>
                    <!-- Telepon -->
                    <div class="input-group">
                        <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor WhatsApp <span class="text-gray-400">(untuk reminder)</span>
                        </label>
                        <div class="relative">
                            <span class="input-icon">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </span>
                            <input id="telepon" name="telepon" type="tel" autocomplete="tel" required
                                class="input-with-icon w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-custom-madder  focus:border-custom-madder  transition"
                                placeholder="08123456789">
                        </div>
                    </div>
                </div>
                <!-- Email -->
                <div class="input-group">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <span class="input-icon">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="input-with-icon w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-custom-madder  focus:border-custom-madder  transition"
                            placeholder="nama@email.com">
                    </div>
                </div>
                
                
                <!-- Password Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="input-with-icon w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-custom-madder  focus:border-custom-madder  transition"
                                placeholder="Minimal 8 karakter">
                            <button type="button" class="toggle-password" tabindex="-1" aria-label="Lihat Password" onclick="togglePassword('password', 'eyeOpen1', 'eyeClosed1')">
                                <svg id="eyeOpen1" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg id="eyeClosed1" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-group">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <span class="input-icon">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                                class="input-with-icon w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-custom-madder  focus:border-custom-madder  transition"
                                placeholder="Ulangi password">
                            <button type="button" class="toggle-password" tabindex="-1" aria-label="Lihat Password" onclick="togglePassword('password_confirmation', 'eyeOpen2', 'eyeClosed2')">
                                <svg id="eyeOpen2" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg id="eyeClosed2" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" id="registerBtn"
                        class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-semibold text-white bg-gradient-to-r from-custom-madder  to-custom-madder  hover:from-custom-madder  hover:to-custom-madder  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-madder  transition duration-150 ease-in-out">
                        <span id="registerBtnText">Buat Akun ReMine</span>
                        <svg id="registerSpinner" class="hidden animate-spin -mr-1 ml-3 h-5 w-5 text-white"
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

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-custom-madder  hover:text-custom-madder  transition">
                            Masuk sekarang
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        function togglePassword(inputId, eyeOpenId, eyeClosedId) {
            const pwd = document.getElementById(inputId);
            const eyeOpen = document.getElementById(eyeOpenId);
            const eyeClosed = document.getElementById(eyeClosedId);
            
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

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const registerBtn = document.getElementById('registerBtn');
            const registerBtnText = document.getElementById('registerBtnText');
            const registerSpinner = document.getElementById('registerSpinner');

            // Show loading state
            registerBtn.disabled = true;
            registerBtnText.textContent = 'Membuat akun...';
            registerSpinner.classList.remove('hidden');

            // Show loading SweetAlert
            Swal.fire({
                title: 'Membuat akun...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('{{ route('register') }}', {
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Akun Berhasil Dibuat! 🎉',
                        text: 'Selamat datang di ReMine!',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = data.redirect;
                    });
                } else {
                    throw new Error(data.message || 'Registrasi gagal');
                }
            })
            .catch(error => {
                console.error('Register error:', error);

                Swal.fire({
                    icon: 'error',
                    title: 'Registrasi Gagal!',
                    text: error.message || 'Terjadi kesalahan, silakan coba lagi',
                    confirmButtonText: 'Coba Lagi'
                });

                // Reset button state
                registerBtn.disabled = false;
                registerBtnText.textContent = 'Buat Akun ReMine';
                registerSpinner.classList.add('hidden');
            });
        });
    </script>
@endsection