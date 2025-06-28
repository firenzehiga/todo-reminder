@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <!-- Welcome Card -->
                <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6 transition-colors duration-300">
                    <div class="p-6">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2 transition-colors duration-300">
                            Selamat Datang, {{ Auth::user()->name }}! 👋
                        </h1>
                        <p class="text-gray-600 transition-colors duration-300">
                            Kelola todo list dan reminder Anda dengan mudah.
                            <a href="{{ route('todos.index') }}"
                                class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">
                                Mulai sekarang →
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white overflow-hidden shadow-md rounded-lg transition-colors duration-300">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-custom-snow" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 transition-colors duration-300">Total Todo</p>
                                    <p class="text-2xl font-semibold text-gray-900 transition-colors duration-300">{{ $totalTodos }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="bg-white overflow-hidden shadow-md rounded-lg transition-colors duration-300">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-custom-snow" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 transition-colors duration-300">Selesai</p>
                                    <p class="text-2xl font-semibold text-gray-900 transition-colors duration-300">{{ $completedTodos }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-md rounded-lg transition-colors duration-300">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-custom-snow" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500 transition-colors duration-300">Pending</p>
                                    <p class="text-2xl font-semibold text-gray-900 transition-colors duration-300">{{ $pendingTodos }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Simple Progress Cards -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow transition-colors duration-300">
                        <div class="text-2xl font-bold text-green-600 transition-colors duration-300">{{ $stats['today_completed'] }}</div>
                        <div class="text-sm text-gray-600 transition-colors duration-300">Selesai Hari Ini</div>
                        <div class="text-xs text-gray-400 mt-1 transition-colors duration-300">
                            {{ $stats['today_completed'] }}/{{ $stats['today_total'] }} todo hari ini
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow transition-colors duration-300">
                        <div class="text-2xl font-bold text-blue-600 transition-colors duration-300">{{ $stats['today_total'] }}</div>
                        <div class="text-sm text-gray-600 transition-colors duration-300">Target Hari Ini</div>
                        @if($stats['today_total'] > 0)
                            <div class="w-full bg-gray-200 rounded-full h-2 mt-2 transition-colors duration-300">
                                <div class="bg-blue-600 h-2 rounded-full transition-colors duration-300" style="width: {{ ($stats['today_completed']/$stats['today_total'])*100 }}%"></div>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow transition-colors duration-300">
                        <div class="text-2xl font-bold text-purple-600 transition-colors duration-300">{{ $stats['week_completed'] }}</div>
                        <div class="text-sm text-gray-600 transition-colors duration-300">Selesai Minggu Ini</div>
                        <div class="text-xs text-gray-400 mt-1 transition-colors duration-300">7 hari terakhir</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Today's Todos -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg transition-colors duration-300">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 transition-colors duration-300">Todo Hari Ini</h2>
                            @if ($todayTodos->count() > 0)
                                <div class="space-y-3">
                                    @foreach ($todayTodos as $todo)
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg transition-colors duration-300">
                                            <div class="h-2 w-2 bg-{{ $todo->getPriorityColor() }}-500 rounded-full mr-3">
                                            </div>
                                            <div class="flex-1">
                                                <p
                                                    class="text-sm font-medium text-gray-900 {{ $todo->isCompleted() ? 'line-through' : '' }} transition-colors duration-300">
                                                    {{ $todo->title }}
                                                </p>
                                                <p class="text-xs text-gray-500 transition-colors duration-300">
                                                    Priority: {{ ucfirst($todo->priority) }}
                                                </p>
                                            </div>
                                            <span
                                                class="text-xs px-2 py-1 rounded-full {{ $todo->isCompleted() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} transition-colors duration-300">
                                                {{ ucfirst($todo->status) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4 transition-colors duration-300">Tidak ada todo untuk hari ini</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="bg-white overflow-hidden shadow-md rounded-lg transition-colors duration-300">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 transition-colors duration-300">Todo Terbaru</h2>
                            @if ($recentTodos->count() > 0)
                                <div class="space-y-3">
                                    @foreach ($recentTodos as $todo)
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg transition-colors duration-300">
                                            <div class="h-2 w-2 bg-{{ $todo->getPriorityColor() }}-500 rounded-full mr-3">
                                            </div>
                                            <div class="flex-1">
                                                <p
                                                    class="text-sm font-medium text-gray-900 {{ $todo->isCompleted() ? 'line-through' : '' }} transition-colors duration-300">
                                                    {{ $todo->title }}
                                                </p>
                                                <p class="text-xs text-gray-500 transition-colors duration-300">
                                                    {{ $todo->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                            <span
                                                class="text-xs px-2 py-1 rounded-full {{ $todo->isCompleted() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} transition-colors duration-300">
                                                {{ ucfirst($todo->status) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4 transition-colors duration-300">Belum ada todo</p>
                            @endif

                            <div class="mt-4 text-center">
                                <a href="{{ route('todos.index') }}"
                                    class="text-red-600 hover:text-custom-madder text-sm font-medium transition-colors duration-300">
                                    Lihat Semua Todo →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: '{{ session("success") }}',
            timer: 500,
            showConfirmButton: false,

        });
    </script>
    @endif


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
                                window.location.href = data.redirect;
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
