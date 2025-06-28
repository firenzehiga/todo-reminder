@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        
        <!-- Main Content -->
        <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 space-y-4 md:space-y-0">
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <h1 class="text-2xl font-bold text-gray-900">Kelola Todo List</h1>
                        
                        <!-- View Toggle -->
                        <div class="flex items-center bg-gray-100 rounded-lg p-1 w-fit">
                            <button onclick="toggleView('list')" id="listViewBtn"
                                class="view-toggle px-3 py-1 rounded text-sm font-medium transition-all duration-200 bg-white text-gray-900 shadow-sm">
                                📋 List
                            </button>
                            <button onclick="toggleView('kanban')" id="kanbanViewBtn"
                                class="view-toggle px-3 py-1 rounded text-sm font-medium transition-all duration-200 text-gray-600 hover:text-gray-900">
                                📊 Kanban
                            </button>
                            <button onclick="toggleView('calendar')" id="calendarViewBtn"
                                class="view-toggle px-3 py-1 rounded text-sm font-medium transition-all duration-200 text-gray-600 hover:text-gray-900">
                                📅 Calendar
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <!-- Compact Toggle -->
                        <div class="flex items-center">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" id="compactToggle" onchange="toggleCompactView()" class="sr-only">
                                <div class="compact-toggle-switch relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                    <span class="compact-toggle-dot inline-block h-4 w-4 transform rounded-full bg-white transition-transform"></span>
                                </div>
                                <span class="text-sm text-gray-700">Compact</span>
                            </label>
                        </div>

                        <button onclick="openAddModal()"
                            class="hidden md:flex bg-custom-madder hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Todo
                        </button>
                    </div>
                </div>

                <!-- Todo List - Multiple Views -->
                <div id="listView" class="view-content">
                    <livewire:todo-table />
                </div>

                <!-- Kanban Board View -->
                <div id="kanbanView" class="view-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 kanban-columns">
                        <!-- To Do Column -->
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-gray-900">📋 To Do</h3>
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs" id="todoCount">0</span>
                            </div>
                            <div id="todoColumn" class="space-y-3 min-h-32">
                                <div class="text-center text-gray-500 text-sm py-8">
                                    Drag todos here or click to add new ones
                                </div>
                            </div>
                        </div>

                        <!-- In Progress Column -->
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-gray-900">🔄 In Progress</h3>
                                <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs" id="progressCount">0</span>
                            </div>
                            <div id="progressColumn" class="space-y-3 min-h-32">
                                <div class="text-center text-gray-500 text-sm py-8">
                                    Drag todos here when you start working on them
                                </div>
                            </div>
                        </div>

                        <!-- Done Column -->
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-gray-900">✅ Done</h3>
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs" id="doneCount">0</span>
                            </div>
                            <div id="doneColumn" class="space-y-3 min-h-32">
                                <div class="text-center text-gray-500 text-sm py-8">
                                    Completed todos will appear here
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Calendar View -->
                <div id="calendarView" class="view-content hidden">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">📅 Calendar View</h3>
                            <div class="flex space-x-2">
                                <button onclick="previousMonth()" class="p-2 hover:bg-gray-100 rounded">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <span id="currentMonth" class="px-4 py-2 text-sm font-medium text-gray-900"></span>
                                <button onclick="nextMonth()" class="p-2 hover:bg-gray-100 rounded">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div id="calendarGrid" class="grid grid-cols-7 gap-1">
                            <!-- Calendar will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Action Button -->
        <button onclick="openAddModal()" id="fab" 
            class="fixed bottom-6 right-6 bg-primary-600 hover:bg-primary-700 text-white w-14 h-14 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center z-40 md:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </button>

        <!-- Keyboard Shortcuts Help (Toggle with ?) -->
        <div id="shortcutsHelp" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 items-center justify-center">
            <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">⌨️ Keyboard Shortcuts</h3>
                    <button onclick="toggleShortcuts()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Add New Todo</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">Ctrl + N</kbd>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Navigate Down</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">J</kbd>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Navigate Up</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">K</kbd>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Toggle Complete</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">Space</kbd>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Clear Selection</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">Esc</kbd>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Toggle Compact View</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">Ctrl + C</kbd>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Refresh Page</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">Ctrl + R</kbd>
                    </div>
                    <hr class="border-gray-200">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Switch to List View</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">1</kbd>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Switch to Kanban</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">2</kbd>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Switch to Calendar</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">3</kbd>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Show Shortcuts</span>
                        <kbd class="px-2 py-1 bg-gray-100 rounded text-xs">?</kbd>
                    </div>
                </div>
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
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:ring-primary-500 focus:border-primary-500"
                                    required></textarea>
                            </div>
                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                                <select name="priority" id="priority" required
                                    class="mt-1 block w-full border p-1 border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:ring-primary-500 focus:border-primary-500">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                                <input type="date" name="due_date" id="due_date" required
                                    class="mt-1 p-1 block w-full border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp Lain</label>
                                
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
                                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="cth: 081234567890">
                                        <button type="button" onclick="removePhone(this)"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
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
                                class="bg-custom-madder hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm flex items-center justify-center">
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
                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:ring-primary-500 focus:border-primary-500"
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
                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm bg-white text-gray-900 focus:ring-primary-500 focus:border-primary-500"
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

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const overlay = document.getElementById('mobileMenuOverlay');
            const body = document.body;

            if (mobileMenu) {
                mobileMenu.classList.toggle('active');
                
                // Create overlay if it doesn't exist
                if (!overlay) {
                    const newOverlay = document.createElement('div');
                    newOverlay.id = 'mobileMenuOverlay';
                    newOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-40';
                    newOverlay.addEventListener('click', toggleMobileMenu);
                    document.body.appendChild(newOverlay);
                } else {
                    overlay.classList.toggle('hidden');
                }
                
                // Prevent body scroll when menu is open
                body.classList.toggle('overflow-hidden');
            }
        }

        // VIEW MANAGEMENT
        let currentView = 'list';
        let isCompactView = false;
        let todos = [];
        let currentSelectedIndex = -1;

        // Switch between views
        function toggleView(view) {
            const oldView = currentView;
            currentView = view;
            
            // Hide all views
            document.querySelectorAll('.view-content').forEach(v => v.classList.add('hidden'));
            
            // Show selected view
            document.getElementById(view + 'View').classList.remove('hidden');
            
            // Update view buttons
            document.querySelectorAll('.view-toggle').forEach(btn => {
                btn.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
                btn.classList.add('text-gray-600', 'hover:text-gray-900');
            });
            
            const activeBtn = document.getElementById(view + 'ViewBtn');
            activeBtn.classList.remove('text-gray-600', 'hover:text-gray-900');
            activeBtn.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            
            // Load data for view
            if (view === 'kanban') {
                loadKanbanData();
            } else if (view === 'calendar') {
                loadCalendarData();
            }
            
            // Show brief notification for keyboard switch
            if (oldView !== view) {
                showNotification(`Switched to ${view.charAt(0).toUpperCase() + view.slice(1)} view`);
            }
        }

        // Toggle compact view
        function toggleCompactView() {
            isCompactView = !isCompactView;
            const toggle = document.getElementById('compactToggle');
            const toggleSwitch = document.querySelector('.compact-toggle-switch');
            const toggleDot = document.querySelector('.compact-toggle-dot');
            
            if (isCompactView) {
                toggleSwitch.classList.add('bg-blue-600');
                toggleSwitch.classList.remove('bg-gray-200');
                toggleDot.classList.add('translate-x-5');
                
                // Apply compact styles to todo list
                document.querySelectorAll('.todo-row').forEach(item => {
                    item.classList.add('compact-todo');
                });
                
                showNotification('Compact view enabled');
            } else {
                toggleSwitch.classList.remove('bg-blue-600');
                toggleSwitch.classList.add('bg-gray-200');
                toggleDot.classList.remove('translate-x-5');
                
                // Remove compact styles
                document.querySelectorAll('.todo-row').forEach(item => {
                    item.classList.remove('compact-todo');
                });
                
                showNotification('Expanded view enabled');
            }
        }

        // KANBAN BOARD FUNCTIONS
        function loadKanbanData() {
            // Get todos from Livewire component data or fetch from server
            fetchTodos().then(todosData => {
                todos = todosData;
                populateKanbanColumns();
            });
        }

        function populateKanbanColumns() {
            const todoColumn = document.getElementById('todoColumn');
            const progressColumn = document.getElementById('progressColumn');
            const doneColumn = document.getElementById('doneColumn');
            
            // Clear columns
            todoColumn.innerHTML = '';
            progressColumn.innerHTML = '';
            doneColumn.innerHTML = '';
            
            let todoCount = 0, progressCount = 0, doneCount = 0;
            
            todos.forEach(todo => {
                const todoCard = createKanbanCard(todo);
                
                if (todo.status === 'completed') {
                    doneColumn.appendChild(todoCard);
                    doneCount++;
                } else if (todo.status === 'in_progress') {
                    progressColumn.appendChild(todoCard);
                    progressCount++;
                } else {
                    todoColumn.appendChild(todoCard);
                    todoCount++;
                }
            });
            
            // Add placeholder messages only if columns are empty AND no todos exist
            if (todoCount === 0 && todos.length > 0) {
                const placeholder = document.createElement('div');
                placeholder.className = 'text-center text-gray-500 text-sm py-4 placeholder-msg';
                placeholder.textContent = 'No pending todos';
                todoColumn.appendChild(placeholder);
            } else if (todoCount === 0) {
                const placeholder = document.createElement('div');
                placeholder.className = 'text-center text-gray-500 text-sm py-8 placeholder-msg';
                placeholder.innerHTML = 'Drag todos here or <button onclick="openAddModal()" class="text-primary-500 hover:text-primary-600 underline">click to add new ones</button>';
                todoColumn.appendChild(placeholder);
            }
            
            if (progressCount === 0) {
                const placeholder = document.createElement('div');
                placeholder.className = 'text-center text-gray-500 text-sm py-8 placeholder-msg';
                placeholder.textContent = 'Drag todos here when you start working on them';
                progressColumn.appendChild(placeholder);
            }
            
            if (doneCount === 0) {
                const placeholder = document.createElement('div');
                placeholder.className = 'text-center text-gray-500 text-sm py-8 placeholder-msg';
                placeholder.textContent = 'Completed todos will appear here';
                doneColumn.appendChild(placeholder);
            }
            
            // Update counts
            document.getElementById('todoCount').textContent = todoCount;
            document.getElementById('progressCount').textContent = progressCount;
            document.getElementById('doneCount').textContent = doneCount;
        }

        function createKanbanCard(todo) {
            const card = document.createElement('div');
            card.className = 'kanban-card bg-gray-50 p-3 rounded-lg border border-gray-200 cursor-pointer transition-all duration-200 hover:shadow-md';
            card.draggable = true;
            card.dataset.todoId = todo.id;
            
            const priorityColors = {
                'high': 'bg-red-100 text-red-800',
                'medium': 'bg-yellow-100 text-yellow-800',
                'low': 'bg-green-100 text-green-800'
            };
            
            const dueDateFormatted = todo.due_date ? new Date(todo.due_date).toLocaleDateString('id-ID') : '';
            const isOverdue = todo.due_date && new Date(todo.due_date) < new Date() && todo.status !== 'completed';
            
            card.innerHTML = `
                <div class="flex justify-between items-start mb-2">
                    <h4 class="font-medium text-gray-900 text-sm">${todo.title}</h4>
                    <span class="px-2 py-1 rounded-full text-xs ${priorityColors[todo.priority] || priorityColors['medium']}">${todo.priority}</span>
                </div>
                <p class="text-gray-600 text-xs mb-2 line-clamp-2">${todo.description}</p>
                ${dueDateFormatted ? `<div class="flex items-center text-xs ${isOverdue ? 'text-red-600' : 'text-gray-500'}">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    ${dueDateFormatted} ${isOverdue ? '(Overdue)' : ''}
                </div>` : ''}
                <div class="mt-2 flex justify-between items-center">
                    <button onclick="toggleTodo(${todo.id})" class="text-xs px-2 py-1 rounded ${todo.status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'} hover:opacity-80 transition-opacity">
                        ${todo.status === 'completed' ? '✅ Done' : '⭕ Mark Done'}
                    </button>
                    <span class="text-xs text-gray-400">${new Date(todo.created_at).toLocaleDateString('id-ID')}</span>
                </div>
            `;
            
            // Add drag events
            card.addEventListener('dragstart', handleDragStart);
            card.addEventListener('dragend', handleDragEnd);
            card.addEventListener('click', () => selectTodoCard(card));
            
            return card;
        }

        // Drag and drop for Kanban
        let draggedElement = null;

        function handleDragStart(e) {
            draggedElement = this;
            this.style.opacity = '0.7';
            this.classList.add('dragging');
            
            // Add visual feedback
            showNotification('Drag to a column to change status', 'info');
            
            // Highlight drop zones
            document.querySelectorAll('[id$="Column"]').forEach(col => {
                col.style.border = '2px dashed #3b82f6';
                col.style.backgroundColor = 'rgba(59, 130, 246, 0.05)';
            });
        }

        function handleDragEnd(e) {
            this.style.opacity = '1';
            this.classList.remove('dragging');
            
            // Remove highlight from drop zones
            document.querySelectorAll('[id$="Column"]').forEach(col => {
                col.style.border = '';
                col.style.backgroundColor = '';
            });
            
            // Clean up any remaining drag styles
            document.querySelectorAll('.drag-over').forEach(el => {
                el.classList.remove('drag-over');
            });
        }

        // Add drop zones
        document.addEventListener('DOMContentLoaded', function() {
            const columns = ['todoColumn', 'progressColumn', 'doneColumn'];
            columns.forEach(columnId => {
                const column = document.getElementById(columnId);
                if (column) {
                    column.addEventListener('dragover', handleDragOver);
                    column.addEventListener('drop', handleDrop);
                    column.addEventListener('dragleave', handleDragLeave);
                }
            });
        });

        function handleDragOver(e) {
            e.preventDefault();
            this.classList.add('drag-over');
        }

        function handleDragLeave(e) {
            // Only remove class if we're actually leaving the drop zone
            if (!this.contains(e.relatedTarget)) {
                this.classList.remove('drag-over');
            }
        }

        function handleDrop(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
            
            if (draggedElement) {
                const todoId = draggedElement.dataset.todoId;
                const targetColumn = this.id;
                
                let newStatus;
                switch(targetColumn) {
                    case 'todoColumn':
                        newStatus = 'pending';
                        break;
                    case 'progressColumn':
                        newStatus = 'in_progress';
                        break;
                    case 'doneColumn':
                        newStatus = 'completed';
                        break;
                }
                
                if (newStatus) {
                    // Optimistic UI update - move immediately
                    const oldParent = draggedElement.parentNode;
                    this.appendChild(draggedElement);
                    draggedElement.style.opacity = '1';
                    
                    // Update counts immediately
                    updateKanbanCounts();
                    
                    // Then update backend
                    updateTodoStatus(todoId, newStatus).then((response) => {
                        if (response.success) {
                            showNotification('Todo moved successfully', 'success');
                        } else {
                            // Revert on failure
                            oldParent.appendChild(draggedElement);
                            updateKanbanCounts();
                            showNotification('Failed to update todo status', 'error');
                        }
                    }).catch(() => {
                        // Revert on error
                        oldParent.appendChild(draggedElement);
                        updateKanbanCounts();
                        showNotification('Error updating todo status', 'error');
                    });
                }
                
                draggedElement = null;
            }
        }

        // Helper function to update kanban counts
        function updateKanbanCounts() {
            const todoCards = document.querySelectorAll('#todoColumn .kanban-card');
            const progressCards = document.querySelectorAll('#progressColumn .kanban-card');
            const doneCards = document.querySelectorAll('#doneColumn .kanban-card');
            
            document.getElementById('todoCount').textContent = todoCards.length;
            document.getElementById('progressCount').textContent = progressCards.length;
            document.getElementById('doneCount').textContent = doneCards.length;
            
            // Remove placeholders if cards exist, add if empty
            const todoColumn = document.getElementById('todoColumn');
            const progressColumn = document.getElementById('progressColumn');
            const doneColumn = document.getElementById('doneColumn');
            
            // Handle todo column
            const todoPlaceholder = todoColumn.querySelector('.placeholder-msg');
            if (todoCards.length > 0 && todoPlaceholder) {
                todoPlaceholder.remove();
            } else if (todoCards.length === 0 && !todoPlaceholder) {
                const placeholder = document.createElement('div');
                placeholder.className = 'text-center text-gray-500 text-sm py-8 placeholder-msg';
                placeholder.textContent = 'Drop todos here';
                todoColumn.appendChild(placeholder);
            }
            
            // Handle progress column
            const progressPlaceholder = progressColumn.querySelector('.placeholder-msg');
            if (progressCards.length > 0 && progressPlaceholder) {
                progressPlaceholder.remove();
            } else if (progressCards.length === 0 && !progressPlaceholder) {
                const placeholder = document.createElement('div');
                placeholder.className = 'text-center text-gray-500 text-sm py-8 placeholder-msg';
                placeholder.textContent = 'Drop todos here when working on them';
                progressColumn.appendChild(placeholder);
            }
            
            // Handle done column
            const donePlaceholder = doneColumn.querySelector('.placeholder-msg');
            if (doneCards.length > 0 && donePlaceholder) {
                donePlaceholder.remove();
            } else if (doneCards.length === 0 && !donePlaceholder) {
                const placeholder = document.createElement('div');
                placeholder.className = 'text-center text-gray-500 text-sm py-8 placeholder-msg';
                placeholder.textContent = 'Completed todos appear here';
                doneColumn.appendChild(placeholder);
            }
        }

        // CALENDAR FUNCTIONS
        let currentCalendarDate = new Date();

        function loadCalendarData() {
            fetchTodos().then(todosData => {
                todos = todosData;
                renderCalendar();
            });
        }

        function renderCalendar() {
            const calendarGrid = document.getElementById('calendarGrid');
            const currentMonth = document.getElementById('currentMonth');
            
            // Set month header
            currentMonth.textContent = currentCalendarDate.toLocaleDateString('id-ID', { 
                month: 'long', 
                year: 'numeric' 
            });
            
            // Clear grid
            calendarGrid.innerHTML = '';
            
            // Add day headers
            const dayHeaders = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
            dayHeaders.forEach(day => {
                const header = document.createElement('div');
                header.className = 'p-2 text-center text-sm font-medium text-gray-500';
                header.textContent = day;
                calendarGrid.appendChild(header);
            });
            
            // Get first day of month and days in month
            const firstDay = new Date(currentCalendarDate.getFullYear(), currentCalendarDate.getMonth(), 1);
            const lastDay = new Date(currentCalendarDate.getFullYear(), currentCalendarDate.getMonth() + 1, 0);
            const startDate = new Date(firstDay);
            startDate.setDate(startDate.getDate() - firstDay.getDay());
            
            // Generate calendar days
            for (let i = 0; i < 42; i++) {
                const date = new Date(startDate);
                date.setDate(startDate.getDate() + i);
                
                const dayElement = createCalendarDay(date, currentCalendarDate.getMonth());
                calendarGrid.appendChild(dayElement);
            }
        }

        function createCalendarDay(date, currentMonth) {
            const day = document.createElement('div');
            const isCurrentMonth = date.getMonth() === currentMonth;
            const isToday = date.toDateString() === new Date().toDateString();
            
            day.className = `p-2 min-h-[80px] border border-gray-200 ${
                isCurrentMonth ? 'bg-white' : 'bg-gray-50'
            } ${isToday ? 'ring-2 ring-primary-500' : ''}`;
            
            // Day number
            const dayNumber = document.createElement('div');
            dayNumber.className = `text-sm font-medium ${
                isCurrentMonth ? 'text-gray-900' : 'text-gray-400'
            }`;
            dayNumber.textContent = date.getDate();
            day.appendChild(dayNumber);
            
            // Find todos for this date
            const dayTodos = todos.filter(todo => {
                if (!todo.due_date) return false;
                const todoDate = new Date(todo.due_date);
                return todoDate.toDateString() === date.toDateString();
            });
            
            // Add todo indicators
            dayTodos.slice(0, 3).forEach(todo => {
                const todoIndicator = document.createElement('div');
                todoIndicator.className = `text-xs p-1 mt-1 rounded truncate ${
                    todo.status === 'completed' ? 'bg-green-100 text-green-800' :
                    todo.priority === 'high' ? 'bg-red-100 text-red-800' :
                    'bg-blue-100 text-blue-800'
                }`;
                todoIndicator.textContent = todo.title;
                todoIndicator.title = todo.description;
                day.appendChild(todoIndicator);
            });
            
            // Show "more" indicator if there are more todos
            if (dayTodos.length > 3) {
                const moreIndicator = document.createElement('div');
                moreIndicator.className = 'text-xs text-gray-500 mt-1';
                moreIndicator.textContent = `+${dayTodos.length - 3} more`;
                day.appendChild(moreIndicator);
            }
            
            return day;
        }

        function previousMonth() {
            currentCalendarDate.setMonth(currentCalendarDate.getMonth() - 1);
            renderCalendar();
        }

        function nextMonth() {
            currentCalendarDate.setMonth(currentCalendarDate.getMonth() + 1);
            renderCalendar();
        }

        // KEYBOARD SHORTCUTS
        let selectedTodoElement = null;

        function initKeyboardShortcuts() {
            document.addEventListener('keydown', function(e) {
                // Don't trigger shortcuts when typing in inputs
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
                    return;
                }
                
                switch(e.key.toLowerCase()) {
                    case 'j':
                        e.preventDefault();
                        navigateDown();
                        break;
                    case 'k':
                        e.preventDefault();
                        navigateUp();
                        break;
                    case ' ':
                        e.preventDefault();
                        toggleSelectedTodo();
                        break;
                    case '1':
                        e.preventDefault();
                        toggleView('list');
                        break;
                    case '2':
                        e.preventDefault();
                        toggleView('kanban');
                        break;
                    case '3':
                        e.preventDefault();
                        toggleView('calendar');
                        break;
                    case 'c':
                        if (e.ctrlKey || e.metaKey) {
                            e.preventDefault();
                            toggleCompactView();
                        }
                        break;
                    case 'r':
                        if (e.ctrlKey || e.metaKey) {
                            e.preventDefault();
                            location.reload();
                        }
                        break;
                    case '?':
                        e.preventDefault();
                        toggleShortcuts();
                        break;
                    case 'escape':
                        e.preventDefault();
                        clearSelection();
                        break;
                    case 'n':
                        if (e.ctrlKey || e.metaKey) {
                            e.preventDefault();
                            openAddModal();
                        }
                        break;
                }
            });
        }

        function navigateDown() {
            const todoElements = getTodoElements();
            if (todoElements.length === 0) return;
            
            if (currentSelectedIndex < todoElements.length - 1) {
                currentSelectedIndex++;
            } else {
                currentSelectedIndex = 0; // Wrap to top
            }
            
            updateSelection(todoElements);
        }

        function navigateUp() {
            const todoElements = getTodoElements();
            if (todoElements.length === 0) return;
            
            if (currentSelectedIndex > 0) {
                currentSelectedIndex--;
            } else {
                currentSelectedIndex = todoElements.length - 1; // Wrap to bottom
            }
            
            updateSelection(todoElements);
        }

        function getTodoElements() {
            if (currentView === 'list') {
                return document.querySelectorAll('[wire\\:key]');
            } else if (currentView === 'kanban') {
                return document.querySelectorAll('[data-todo-id]');
            }
            return [];
        }

        function updateSelection(todoElements) {
            // Remove previous selection
            todoElements.forEach(el => el.classList.remove('keyboard-selected'));
            
            // Add selection to current element
            if (todoElements[currentSelectedIndex]) {
                todoElements[currentSelectedIndex].classList.add('keyboard-selected');
                selectedTodoElement = todoElements[currentSelectedIndex];
                
                // Scroll into view
                selectedTodoElement.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'nearest' 
                });
            }
        }

        function toggleSelectedTodo() {
            if (selectedTodoElement) {
                const todoId = selectedTodoElement.getAttribute('wire:key') || 
                              selectedTodoElement.dataset.todoId;
                if (todoId) {
                    toggleTodo(todoId);
                }
            }
        }

        function selectTodoCard(card) {
            // Remove previous selections
            document.querySelectorAll('.keyboard-selected').forEach(el => 
                el.classList.remove('keyboard-selected'));
            
            // Add selection to clicked card
            card.classList.add('keyboard-selected');
            selectedTodoElement = card;
            
            // Update index
            const todoElements = getTodoElements();
            currentSelectedIndex = Array.from(todoElements).indexOf(card);
        }

        function toggleShortcuts() {
            const modal = document.getElementById('shortcutsHelp');
            modal.classList.toggle('hidden');
        }

        function clearSelection() {
            document.querySelectorAll('.keyboard-selected').forEach(el => 
                el.classList.remove('keyboard-selected'));
            selectedTodoElement = null;
            currentSelectedIndex = -1;
            showNotification('Selection cleared');
        }

        // UTILITY FUNCTIONS
        function fetchTodos() {
            return fetch('/api/todos', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('API not available');
                }
                return response.json();
            })
            .catch(() => {
                // Fallback: extract data from existing DOM
                return extractTodosFromDOM();
            });
        }

        function extractTodosFromDOM() {
            const todoElements = document.querySelectorAll('[wire\\:key]');
            const todos = [];
            
            todoElements.forEach(el => {
                const todoId = el.getAttribute('wire:key');
                const titleEl = el.querySelector('.todo-title');
                const descEl = el.querySelector('.todo-description');
                const statusEl = el.querySelector('.todo-status');
                const priorityEl = el.querySelector('.todo-priority');
                const dateEl = el.querySelector('.todo-date');
                
                if (titleEl && todoId) {
                    const todoData = {
                        id: todoId,
                        title: titleEl.textContent.trim(),
                        description: descEl ? descEl.textContent.trim() : '',
                        status: statusEl ? statusEl.textContent.trim() : 'pending',
                        priority: priorityEl ? priorityEl.textContent.toLowerCase().trim() : 'medium',
                        due_date: dateEl && dateEl.textContent.includes('Due:') ? 
                                  dateEl.textContent.replace(/.*Due:\s*/, '').replace(/\s*\(.*\).*/, '').trim() : null,
                        created_at: new Date().toISOString()
                    };
                    
                    // Convert date format if needed
                    if (todoData.due_date && todoData.due_date !== '-') {
                        try {
                            const parts = todoData.due_date.split(' ');
                            if (parts.length === 3) {
                                const day = parts[0];
                                const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                                  'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                const month = monthNames.indexOf(parts[1]) + 1;
                                const year = parts[2];
                                todoData.due_date = `${year}-${month.toString().padStart(2, '0')}-${day.padStart(2, '0')}`;
                            }
                        } catch (e) {
                            todoData.due_date = null;
                        }
                    }
                    
                    todos.push(todoData);
                }
            });
            
            return Promise.resolve(todos);
        }

        function updateTodoStatus(todoId, status) {
            return fetch(`/todos/${todoId}/status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .catch(error => {
                console.error('Error updating todo status:', error);
                return { success: false };
            });
        }

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-4 py-2 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
                type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                type === 'warning' ? 'bg-yellow-500 text-white' :
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // Keyboard navigation helpers
        function navigateToNextPage() {
            // Could implement pagination navigation
            showNotification('No more pages');
        }

        function navigateToPrevPage() {
            // Could implement pagination navigation  
            showNotification('Already at first page');
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initKeyboardShortcuts();
            
            // Load initial data for current view
            if (currentView === 'kanban') {
                loadKanbanData();
            } else if (currentView === 'calendar') {
                loadCalendarData();
            }
            
            // Show keyboard shortcuts hint on first visit
            if (!localStorage.getItem('keyboardHintsShown')) {
                setTimeout(() => {
                    const hint = document.createElement('div');
                    hint.className = 'fixed bottom-20 right-6 bg-primary-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 text-sm max-w-xs';
                    hint.innerHTML = '💡 Tip: Press <kbd class="bg-primary-700 px-1 rounded">?</kbd> for keyboard shortcuts!';
                    document.body.appendChild(hint);
                    
                    setTimeout(() => {
                        hint.remove();
                        localStorage.setItem('keyboardHintsShown', 'true');
                    }, 5000);
                }, 2000);
            }
        });

        // Demo data for testing (uncomment to test with sample data)
        /*
        function generateDemoTodos() {
            return [
                {
                    id: 1,
                    title: 'Design new homepage',
                    description: 'Create wireframes and mockups for the new homepage layout',
                    status: 'z',
                    priority: 'high',
                    due_date: '2025-06-30',
                    created_at: '2025-06-25T10:00:00Z'
                },
                {
                    id: 2,
                    title: 'Review client proposal',
                    description: 'Go through the proposal and provide feedback',
                    status: 'pending',
                    priority: 'medium',
                    due_date: '2025-06-28',
                    created_at: '2025-06-24T15:30:00Z'
                },
                {
                    id: 3,
                    title: 'Setup development environment',
                    description: 'Configure Docker and development tools',
                    status: 'completed',
                    priority: 'low',
                    due_date: '2025-06-26',
                    created_at: '2025-06-23T09:15:00Z'
                },
                {
                    id: 4,
                    title: 'Team meeting prep',
                    description: 'Prepare agenda and materials for weekly team meeting',
                    status: 'pending',
                    priority: 'medium',
                    due_date: '2025-07-01',
                    created_at: '2025-06-25T14:20:00Z'
                }
            ];
        }
        
        // To use demo data, uncomment this line:
        // todos = generateDemoTodos();
        */
        </script>
    
@endsection
