@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white shadow-md border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo & Brand -->
                    <div class="flex items-center">
                        <div class="h-8 w-8 bg-primary-500 rounded-full flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <span class="ml-3 text-xl font-semibold text-gray-900">Todo Reminder</span>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('dashboard') }}"
                            class="text-sm text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md">
                            Dashboard
                        </a>
                        <a href="{{ route('todos.index') }}"
                            class="text-sm text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md">
                            Kelola Todo
                        </a>
                        <span class="text-sm text-gray-700 font-bold">Halo, {{ Auth::user()->name }}</span>
                        <button onclick="confirmLogout()"
                            class="text-sm text-red-600 hover:text-red-800 px-3 py-2 rounded-md">
                            Logout
                        </button>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button onclick="toggleMobileMenu()"
                            class="text-gray-700 hover:text-primary-600 focus:outline-none focus:text-primary-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobileMenu" class="mobile-menu fixed top-0 left-0 h-full w-64 bg-white shadow-lg z-50 md:hidden">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="h-8 w-8 bg-primary-500 rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-3 text-lg font-semibold text-gray-900">Menu</span>
                        </div>
                        <button onclick="toggleMobileMenu()" class="text-gray-700 hover:text-primary-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-2">
                        <div class="px-3 py-2 text-sm text-gray-600 border-b font-bold">
                            {{ Auth::user()->name }}
                        </div>
                        <a href="{{ route('dashboard') }}"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                            Dashboard
                        </a>
                        <a href="{{ route('todos.index') }}"
                            class="block px-3 py-2 text-sm text-primary-600 bg-primary-50 rounded-md">
                            Kelola Todo
                        </a>
                        <button onclick="confirmLogout()"
                            class="block w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Main Content -->
        <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Kelola Todo List</h1>
                    <button onclick="openAddModal()"
                        class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        + Tambah Todo
                    </button>
                </div>

                <!-- Todo List - Mobile Friendly -->
                <livewire:todo-table />
            </div>
        </div>

    <!-- Add Todo Modal -->
    <div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Todo Baru</h3>
                    <form method="POST" action="{{ route('todos.store') }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                                <input type="text" name="title" id="title" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-white focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-white focus:ring-primary-500 focus:border-primary-500"
                                    required></textarea>
                            </div>
                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                                <select name="priority" id="priority" required
                                    class="mt-1 block w-full border p-1 border-gray-300 rounded-md shadow-sm bg-white focus:ring-primary-500 focus:border-primary-500">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                                <input type="date" name="due_date" id="due_date" required
                                    class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm bg-white focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nomor WhatsApp Lain</label>
                                
                                <!-- Tombol Pilih Kontak -->
                                <div class="flex gap-2 mb-2">
                                    <button type="button" id="selectContactBtn" onclick="selectFromContacts()" 
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm flex items-center">
                                        📞 Pilih dari Kontak
                                    </button>
                                    <button type="button" onclick="addPhoneInput()" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                        ➕ Tambah Manual
                                    </button>
                                </div>
                                
                                <div id="phone-inputs" class="max-h-48 overflow-y-auto pr-1">
                                    <div class="flex gap-2 mb-2">
                                        <input type="text" name="extra_phones[]"
                                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm bg-white focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="cth: 081234567890">
                                        <button type="button" onclick="removePhone(this)"
                                            class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">
                                            ×
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" onclick="closeAddModal()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md text-sm">
                                Batal
                            </button>
                            <button type="submit" id="submitBtn"
                                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm flex items-center justify-center">
                                <span id="btnText">Simpan</span>
                                <svg id="btnSpinner" class="animate-spin h-5 w-5 ml-2 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengecek apakah browser mendukung Contact Picker API
        function checkContactSupport() {
            if ('contacts' in navigator && 'ContactsManager' in window) {
                return true;
            } else {
                // Sembunyikan tombol jika tidak support
                const btn = document.getElementById('selectContactBtn');
                if (btn) {
                    btn.style.display = 'none';
                }
                return false;
            }
        }
        
        // Fungsi untuk membuka Contact Picker
        async function selectFromContacts() {
            // Cek support browser
            if (!checkContactSupport()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Tidak Didukung',
                    text: 'Browser Anda tidak mendukung fitur pilih kontak. Silakan input manual.',
                });
                return;
            }
        
            try {
                // Minta akses kontak
                const contacts = await navigator.contacts.select(['name', 'tel'], {
                    multiple: true // Bisa pilih beberapa kontak sekaligus
                });
                
                // Proses setiap kontak yang dipilih
                contacts.forEach(contact => {
                    if (contact.tel && contact.tel.length > 0) {
                        const phone = formatPhoneNumber(contact.tel[0]);
                        const name = contact.name ? contact.name[0] : 'Kontak';
                        addPhoneToList(phone, name);
                    }
                });
                
                if (contacts.length > 0) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: `${contacts.length} kontak berhasil ditambahkan`,
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
                
            } catch (error) {
                console.log('User cancelled or error:', error);
                // User membatalkan atau error lain
            }
        }
        
        // Fungsi untuk format nomor telepon
        function formatPhoneNumber(phone) {
            // Hapus karakter non-digit
            let cleaned = phone.replace(/\D/g, '');
            
            // Jika dimulai dengan 0, ganti dengan 62
            if (cleaned.startsWith('0')) {
                cleaned = '62' + cleaned.substring(1);
            }
            // Jika belum ada kode negara, tambahkan 62
            else if (!cleaned.startsWith('62')) {
                cleaned = '62' + cleaned;
            }
            
            return cleaned;
        }
        
        // Fungsi untuk menambahkan nomor ke list input
        function addPhoneToList(phone, name = '') {
            const phoneInputs = document.getElementById('phone-inputs');
            const newInputHTML = `
                <div class="flex gap-2 mb-2">
                    <input type="text" name="extra_phones[]" value="${phone}"
                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm bg-white focus:ring-primary-500 focus:border-primary-500"
                        placeholder="${name}">
                    <button type="button" onclick="removePhone(this)" 
                        class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">
                        ×
                    </button>
                </div>
            `;
            phoneInputs.insertAdjacentHTML('beforeend', newInputHTML);
        }
        
        // Fungsi untuk tambah input manual
        function addPhoneInput() {
            const phoneInputs = document.getElementById('phone-inputs');
            const newInputHTML = `
                <div class="flex gap-2 mb-2">
                    <input type="text" name="extra_phones[]"
                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm bg-white focus:ring-primary-500 focus:border-primary-500"
                        placeholder="cth: 081234567890">
                    <button type="button" onclick="removePhone(this)" 
                        class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm">
                        ×
                    </button>
                </div>
            `;
            phoneInputs.insertAdjacentHTML('beforeend', newInputHTML);
        }
        
        // Fungsi untuk hapus input nomor
        function removePhone(button) {
            button.parentElement.remove();
        }
        
        // Kondisi button submit saat di klik
        document.querySelector('form[action="{{ route('todos.store') }}"]').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.classList.remove('bg-primary-600', 'hover:bg-primary-700');
            btn.classList.add('bg-gray-400', 'cursor-not-allowed');
            document.getElementById('btnText').textContent = 'Menyimpan...';
            document.getElementById('btnSpinner').classList.remove('hidden');
        });
        
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }
        
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
        }
        
        function toggleTodo(todoId) {
            fetch(`/todos/${todoId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }
        
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin mau logout?',
                text: 'Anda akan keluar dari aplikasi',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Logging out...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
        
                    fetch('{{ route('logout') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Logout Berhasil!',
                                    text: 'Sampai jumpa lagi! 👋',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = data.redirect;
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat logout',
                                confirmButtonText: 'OK'
                            });
                        });
                }
            });
        }
        
        function kirimReminderGroup(todoId) {
            Swal.fire({
                title: 'Kirim Reminder ke Grup?',
                text: 'Reminder todo ini akan dikirim ke grup WhatsApp.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#22c55e',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Kirim',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mengirim...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
        
                    fetch(`/todos/${todoId}/reminder-group`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.close();
                            if (data.success) {
                                Swal.fire('Berhasil!', 'Reminder berhasil dikirim ke grup.', 'success');
                            } else {
                                Swal.fire('Gagal!', data.message || 'Gagal mengirim reminder.', 'error');
                            }
                        })
                        .catch(() => {
                            Swal.close();
                            Swal.fire('Gagal!', 'Terjadi kesalahan server.', 'error');
                        });
                }
            });
        }
        
        // Cek support saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            checkContactSupport();
        });
        </script>
    
@endsection
