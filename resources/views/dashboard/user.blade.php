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
                            Halo, {{ Auth::user()->name }}
                        </div>
                        <a href="{{ route('dashboard') }}"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                            Dashboard
                        </a>
                        <a href="{{ route('todos.index') }}"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
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
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <!-- Welcome Card -->
                <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                    <div class="p-6">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">
                            Selamat Datang, {{ Auth::user()->name }}! 👋
                        </h1>
                        <p class="text-gray-600">
                            Kelola todo list dan reminder Anda dengan mudah.
                            <a href="{{ route('todos.index') }}"
                                class="text-primary-600 hover:text-primary-800 font-medium">
                                Mulai sekarang →
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white overflow-hidden shadow-md rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Todo</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $totalTodos }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-md rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Selesai</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $completedTodos }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-md rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Pending</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $pendingTodos }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Today's Todos -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Todo Hari Ini</h2>
                            @if ($todayTodos->count() > 0)
                                <div class="space-y-3">
                                    @foreach ($todayTodos as $todo)
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div class="h-2 w-2 bg-{{ $todo->getPriorityColor() }}-500 rounded-full mr-3">
                                            </div>
                                            <div class="flex-1">
                                                <p
                                                    class="text-sm font-medium text-gray-900 {{ $todo->isCompleted() ? 'line-through' : '' }}">
                                                    {{ $todo->title }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    Priority: {{ ucfirst($todo->priority) }}
                                                </p>
                                            </div>
                                            <span
                                                class="text-xs px-2 py-1 rounded-full {{ $todo->isCompleted() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($todo->status) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">Tidak ada todo untuk hari ini</p>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Todo Terbaru</h2>
                            @if ($recentTodos->count() > 0)
                                <div class="space-y-3">
                                    @foreach ($recentTodos as $todo)
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div class="h-2 w-2 bg-{{ $todo->getPriorityColor() }}-500 rounded-full mr-3">
                                            </div>
                                            <div class="flex-1">
                                                <p
                                                    class="text-sm font-medium text-gray-900 {{ $todo->isCompleted() ? 'line-through' : '' }}">
                                                    {{ $todo->title }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $todo->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                            <span
                                                class="text-xs px-2 py-1 rounded-full {{ $todo->isCompleted() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($todo->status) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">Belum ada todo</p>
                            @endif

                            <div class="mt-4 text-center">
                                <a href="{{ route('todos.index') }}"
                                    class="text-primary-600 hover:text-primary-800 text-sm font-medium">
                                    Lihat Semua Todo →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    </script>
@endsection
