@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo & Brand -->
                    <div class="flex items-center">
                        <div class="h-8 w-8 bg-red-500 rounded-full flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="ml-3 text-xl font-semibold text-gray-900">Admin Panel</span>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-sm text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.users') }}"
                            class="text-sm text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md">
                            Kelola User
                        </a>
                        <a href="{{ route('admin.todos') }}"
                            class="text-sm text-gray-700 hover:text-primary-600 px-3 py-2 rounded-md">
                            Semua Todo
                        </a>
                        <span class="text-sm text-gray-700 font-bold">Hi, {{ Auth::user()->name }}</span>
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
                            <div class="h-8 w-8 bg-red-500 rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="ml-3 text-lg font-semibold text-gray-900">Admin Menu</span>
                        </div>
                        <button onclick="toggleMobileMenu()" class="text-gray-700 hover:text-primary-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-2">
                        <div class="px-3 py-2 text-sm text-gray-600 border-b">
                            {{ Auth::user()->name }}
                        </div>
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.users') }}"
                            class="block px-3 py-2 text-sm text-primary-600 bg-primary-50 rounded-md">
                            Kelola User
                        </a>
                        <a href="{{ route('admin.todos') }}"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                            Semua Todo
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
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.users') }}"
                        class="text-primary-600 hover:text-primary-800 text-sm font-medium">
                        ← Kembali ke Daftar User
                    </a>
                </div>

                <!-- User Info -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-2">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="h-16 w-16 bg-primary-500 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white text-xl font-medium">
                                        {{ substr($user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                                    <p class="text-gray-600">{{ $user->email }}</p>
                                    <p class="text-sm text-gray-500">
                                        Bergabung {{ $user->created_at->format('d M Y') }} •
                                        {{ $user->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delete All Todos -->
                <div class="bg-whiteshadow-sm rounded-lg mb-2">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            @if ($user->todos()->count() > 0)
                                <button
                                    onclick="confirmDeleteUserTodos('{{ $user->name }}', {{ $user->id }}, {{ $user->todos()->count() }})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    🗑️ Hapus Semua ToDo
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <div class="text-center">
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_todos'] }}</p>
                                <p class="text-sm text-gray-500">Total Todo</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <div class="text-center">
                                <p class="text-2xl font-semibold text-green-600">{{ $stats['completed_todos'] }}</p>
                                <p class="text-sm text-gray-500">Selesai</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <div class="text-center">
                                <p class="text-2xl font-semibold text-yellow-600">{{ $stats['pending_todos'] }}</p>
                                <p class="text-sm text-gray-500">Pending</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <div class="text-center">
                                <p class="text-2xl font-semibold text-red-600">{{ $stats['overdue_todos'] }}</p>
                                <p class="text-sm text-gray-500">Terlambat</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Todos -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Todo Terbaru</h2>
                        @if ($user->todos->count() > 0)
                            <!-- Desktop View -->
                            <div class="hidden lg:block">
                                <div class="space-y-3">
                                    @foreach ($user->todos as $todo)
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div class="h-2 w-2 bg-{{ $todo->getPriorityColor() }}-500 rounded-full mr-3">
                                            </div>
                                            <div class="flex-1">
                                                <h3
                                                    class="text-sm font-medium text-gray-900 {{ $todo->isCompleted() ? 'line-through' : '' }}">
                                                    {{ $todo->title }}
                                                </h3>
                                                @if ($todo->description)
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        {{ Str::limit($todo->description, 100) }}</p>
                                                @endif
                                                <div class="flex items-center space-x-4 mt-2">
                                                    <span
                                                        class="text-xs px-2 py-1 rounded-full bg-{{ $todo->getPriorityColor() }}-100 text-{{ $todo->getPriorityColor() }}-800">
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
                                            <div class="flex items-center space-x-2">
                                                <span
                                                    class="text-xs px-2 py-1 rounded-full {{ $todo->isCompleted() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ ucfirst($todo->status) }}
                                                </span>
                                                <button
                                                    onclick="confirmDeleteTodo({{ $todo->id }}, '{{ $todo->title }}', '{{ $user->name }}')"
                                                    class="text-red-600 hover:text-red-800 text-xs px-2 py-1 rounded-md hover:bg-red-50">
                                                    🗑️
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Mobile View -->
                            <div class="lg:hidden space-y-3">
                                @foreach ($user->todos as $todo)
                                    <div class="p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-start space-x-3">
                                            <div
                                                class="h-2 w-2 bg-{{ $todo->getPriorityColor() }}-500 rounded-full mt-2 flex-shrink-0">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-start justify-between">
                                                    <div class="flex-1 min-w-0">
                                                        <h3
                                                            class="text-sm font-medium text-gray-900 {{ $todo->isCompleted() ? 'line-through' : '' }} truncate">
                                                            {{ $todo->title }}
                                                        </h3>
                                                        @if ($todo->description)
                                                            <p class="text-sm text-gray-500 mt-1">
                                                                {{ Str::limit($todo->description, 60) }}</p>
                                                        @endif
                                                        <div class="flex flex-wrap items-center gap-2 mt-2">
                                                            <span
                                                                class="text-xs px-2 py-1 rounded-full bg-{{ $todo->getPriorityColor() }}-100 text-{{ $todo->getPriorityColor() }}-800">
                                                                {{ ucfirst($todo->priority) }}
                                                            </span>
                                                            <span
                                                                class="text-xs px-2 py-1 rounded-full {{ $todo->isCompleted() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                                {{ ucfirst($todo->status) }}
                                                            </span>
                                                            @if ($todo->due_date)
                                                                <span class="text-xs text-gray-500">
                                                                    {{ $todo->due_date->format('d M Y') }}
                                                                </span>
                                                            @endif
                                                            <span class="text-xs text-gray-500">
                                                                {{ $todo->created_at->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <button
                                                        onclick="confirmDeleteTodo({{ $todo->id }}, '{{ $todo->title }}', '{{ $user->name }}')"
                                                        class="text-red-600 hover:text-red-800 text-xs px-2 py-1 rounded-md hover:bg-red-50 ml-2 flex-shrink-0">
                                                        🗑️
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">User ini belum membuat todo</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Forms for Delete Actions -->
    <form id="deleteTodoForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <form id="deleteUserTodosForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
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
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
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
                            console.error('Logout error:', error);
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

        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }

        function confirmDeleteTodo(todoId, todoTitle, userName) {
            Swal.fire({
                title: 'Hapus Todo?',
                html: `Yakin mau hapus todo:<br><strong>"${todoTitle}"</strong><br>dari <strong>${userName}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus todo...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const form = document.getElementById('deleteTodoForm');
                    form.action = `/admin/todos/${todoId}`;
                    form.submit();
                }
            });
        }

        function confirmDeleteUserTodos(userName, userId, totalTodos) {
            Swal.fire({
                title: 'Hapus Semua Todo User?',
                html: `Yakin mau hapus <strong>SEMUA ${totalTodos} todo</strong> dari <strong>${userName}</strong>?<br><br><span style="color: #ef4444;">⚠️ Aksi ini tidak bisa dibatalkan!</span>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus Semua!',
                cancelButtonText: 'Batal',
                input: 'text',
                inputPlaceholder: `Ketik "${userName}" untuk konfirmasi`,
                inputValidator: (value) => {
                    if (value !== userName) {
                        return `Ketik "${userName}" untuk konfirmasi!`
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus semua todo user...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const form = document.getElementById('deleteUserTodosForm');
                    form.action = `/admin/users/${userId}/todos`;
                    form.submit();
                }
            });
        }
    </script>
@endsection
