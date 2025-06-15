@extends('layouts.app')

@section('content')
    <style>
        @media (max-width: 767px) {
            .register-bg {
                background-image: none !important;
                background-color: #f3f4f6 !important;
                /* Tailwind gray-100 */
            }
        }

        @media (min-width: 768px) {
            .register-bg {
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
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 register-bg">

        <div class="max-w-2xl w-full space-y-8">
            <div class="text-center">

                <h2 class="text-2xl font-bold text-gray-900">Buat Akun ReMine</h2>
                <p class="mt-2 text-sm text-gray-600">Kelola tugas dan reminder Anda dengan mudah</p>
            </div>

            <div class="bg-white py-2 px-6 shadow-lg rounded-lg border-2">
                <form id="registerForm" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 min-w-0">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap
                            </label>
                            <input id="name" name="name" type="text" autocomplete="name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Masukkan nama lengkap">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                                placeholder="nama@email.com">
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor WhatsApp <span class="text-gray-400">(untuk reminder)</span>
                            </label>
                            <input id="telepon" name="telepon" type="text" autocomplete="telepon"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                                placeholder="08123456789">
                        </div>

                        <!-- Confirm Password (full width) -->

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Minimal 8 karakter">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                autocomplete="new-password" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Ulangi password">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" id="registerBtn"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out">
                            <span id="registerBtnText">Buat Akun Todo Reminder</span>
                            <svg id="registerSpinner" class="hidden animate-spin -mr-1 ml-3 h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                Masuk sekarang
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Akun Berhasil Dibuat! 🎉',
                            text: 'Selamat datang di Todo Reminder!',
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
                    registerBtnText.textContent = 'Buat Akun Todo Reminder';
                    registerSpinner.classList.add('hidden');
                });
        });
    </script>
@endsection
