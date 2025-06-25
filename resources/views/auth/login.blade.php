@extends('layouts.app')

@section('content')
    <style>
        @media (max-width: 767px) {
            .login-bg {
                background-image: none !important;
                background-color: #f3f4f6 !important;
                /* Tailwind gray-100 */
            }
        }

        @media (min-width: 768px) {
            .login-bg {
                background-image: url('/images/bg5.jpg');
                background-size: cover;
                background-position: right;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-color: transparent;
            }

            .bg-color {
                background-color: #fff !important;
            }
        }
    </style>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 login-bg">

        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <!-- Logo placeholder -->
                <div class="mx-auto h-16 w-16 bg-primary-500 rounded-full flex items-center justify-center mb-6">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                        </path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Masuk ke ReMine</h2>
                <p class="mt-2 text-sm text-gray-600">Kelola tugas dan reminder Anda</p>
            </div>

            <div class="bg-white border-2 py-4 px-6 shadow-lg rounded-lg">
                <form id="loginForm" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                            placeholder="nama@email.com">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Masukkan password">
                    </div>

                    {{-- <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div> --}}

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" id="loginBtn"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out">
                            <span id="loginBtnText">Masuk</span>
                            <svg id="loginSpinner" class="hidden animate-spin -mr-1 ml-3 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                Daftar Akun
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Logout Berhasil!',
                text: '{{ session("success") }}',
                timer: 1200,
                showConfirmButton: false
            });
        </script>
        @endif
    </script>
    <script>
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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Accept': 'application/json', // PENTING: Tambah ini
                        'X-Requested-With': 'XMLHttpRequest' // PENTING: Tambah ini
                    }
                })
                .then(response => {
                    // Cek apakah response adalah JSON
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
