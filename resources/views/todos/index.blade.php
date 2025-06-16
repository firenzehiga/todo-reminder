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
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    @if ($todos->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="hidden lg:block">
                            <div class="table-responsive">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Todo</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Priority</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Due Date</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($todos as $todo)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <button onclick="toggleTodo({{ $todo->id }})" class="flex-shrink-0">
                                                        @if ($todo->isCompleted())
                                                            <div
                                                                class="h-5 w-5 bg-green-500 rounded-full flex items-center justify-center">
                                                                <svg class="h-3 w-3 text-white" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                            </div>
                                                        @else
                                                            <div class="h-5 w-5 border-2 border-gray-300 rounded-full">
                                                            </div>
                                                        @endif
                                                    </button>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div
                                                        class="text-sm font-medium text-gray-900 {{ $todo->isCompleted() ? 'line-through' : '' }}">
                                                        {{ $todo->title }}
                                                    </div>
                                                    @if ($todo->description)
                                                        <div class="text-sm text-gray-500 mt-1">
                                                            {{ Str::limit($todo->description, 50) }}</div>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $todo->getPriorityColor() }}-100 text-{{ $todo->getPriorityColor() }}-800">
                                                        {{ ucfirst($todo->priority) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $todo->due_date ? $todo->due_date->format('d M Y') : '-' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    {{-- <button onclick="editTodo({{ $todo->id }})"
                                                        class="text-blue-600 hover:text-blue-900 mr-3">
                                                        Edit
                                                    </button> --}}
                                                    <button onclick="kirimReminderGroup({{ $todo->id }})"
                                                        class="inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded shadow transition">
                                                        Kirim ke Grup
                                                    </button>
                                                    <form method="POST" action="{{ route('todos.destroy', $todo) }}"
                                                        class="inline" onsubmit="return confirm('Yakin hapus todo ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="lg:hidden divide-y divide-gray-200">
                            @foreach ($todos as $todo)
                                <div class="p-4">
                                    <div class="flex items-start space-x-3">
                                        <!-- Toggle Complete -->
                                        <button onclick="toggleTodo({{ $todo->id }})" class="flex-shrink-0 mt-1">
                                            @if ($todo->isCompleted())
                                                <div
                                                    class="h-5 w-5 bg-green-500 rounded-full flex items-center justify-center">
                                                    <svg class="h-3 w-3 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="h-5 w-5 border-2 border-gray-300 rounded-full"></div>
                                            @endif
                                        </button>

                                        <div class="flex-1 min-w-0">
                                            <h3
                                                class="text-sm font-medium text-gray-900 {{ $todo->isCompleted() ? 'line-through' : '' }}">
                                                {{ $todo->title }}
                                            </h3>
                                            @if ($todo->description)
                                                <p class="text-sm text-gray-500 mt-1">{{ $todo->description }}</p>
                                            @endif
                                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $todo->getPriorityColor() }}-100 text-{{ $todo->getPriorityColor() }}-800">
                                                    {{ ucfirst($todo->priority) }}
                                                </span>
                                                @if ($todo->due_date)
                                                    <span class="text-xs text-gray-500">
                                                        Due: {{ $todo->due_date->format('d M Y') }}
                                                    </span>
                                                @endif
                                                <span class="text-xs text-gray-500">
                                                    {{ $todo->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex flex-col space-y-1">
                                            {{-- <button onclick="editTodo({{ $todo->id }})"
                                                class="text-blue-600 hover:text-blue-800 text-xs">
                                                Edit
                                            </button> --}}
                                            <button onclick="kirimReminderGroup({{ $todo->id }})"
                                                class="inline-flex items-center justify-center px-2 py-1 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded shadow transition">
                                                Kirim Grup
                                            </button>
                                            <form method="POST" action="{{ route('todos.destroy', $todo) }}"
                                                class="inline" onsubmit="return confirm('Yakin hapus todo ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-xs">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada todo</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat todo pertama Anda.</p>
                            <div class="mt-6">
                                <button onclick="openAddModal()"
                                    class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    + Tambah Todo
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Add Todo Modal -->
    <div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Todo Baru</h3>
                    <form method="POST" action="{{ route('todos.store') }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                                <input type="text" name="title" id="title" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500"
                                    required></textarea>
                            </div>
                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                                <select name="priority" id="priority" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                                <input type="date" name="due_date" id="due_date" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" onclick="closeAddModal()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md text-sm">
                                Batal
                            </button>
                            <button type="submit"
                                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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

        function editTodo(todoId) {
            // Simple redirect to edit - bisa dikembangkan jadi modal
            alert('Edit feature - bisa dikembangkan dengan modal atau halaman terpisah');
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
                    // Show loading
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

                    // Perform logout
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
    </script>

@endsection
