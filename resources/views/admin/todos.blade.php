@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <!-- Main Content -->
        <div class="max-w-6xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 space-y-4 sm:space-y-0">
                    <h1 class="text-2xl font-bold text-gray-900">Semua Todo ({{ $todos->count() }})</h1>

                    @if ($todos->count() > 0)
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                            <button onclick="confirmDeleteAll()"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium w-full sm:w-auto">
                                🗑️ Hapus Semua Todo
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Todos List -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    @if ($todos->count() > 0)
                        <!-- Desktop View -->
                        <div class="hidden lg:block">
                            <div class="divide-y divide-gray-200">
                                @foreach ($todos as $todo)
                                    <div class="p-4 hover:bg-gray-50">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="h-2 w-2 bg-{{ $todo->getPriorityColor() }}-500 rounded-full">
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
                                                        <span
                                                            class="text-xs px-2 py-1 rounded-full {{ $todo->isCompleted() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                            {{ ucfirst($todo->status) }}
                                                        </span>
                                                        <span class="text-xs text-gray-500">
                                                            by {{ $todo->user->name }}
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
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <button
                                                    onclick="confirmDeleteTodo({{ $todo->id }}, '{{ $todo->title }}', '{{ $todo->user->name }}')"
                                                    class="text-red-600 hover:text-red-800 text-sm px-3 py-1 rounded-md hover:bg-red-50">
                                                    🗑️ Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Mobile View -->
                        <div class="lg:hidden divide-y divide-gray-200">
                            @foreach ($todos as $todo)
                                <div class="p-4">
                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="h-2 w-2 bg-{{ $todo->getPriorityColor() }}-500 rounded-full mt-2 flex-shrink-0">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1 min-w-0">
                                                    <h3
                                                        class="text-sm font-medium text-gray-900 {{ $todo->isCompleted() ? 'line-through' : '' }}">
                                                        {{ $todo->title }}
                                                    </h3>
                                                    @if ($todo->description)
                                                        <p class="text-sm text-gray-500 mt-1">
                                                            {{ Str::limit($todo->description, 80) }}</p>
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
                                                        <span class="text-xs text-gray-500">
                                                            {{ $todo->user->name }}
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
                                                    onclick="confirmDeleteTodo({{ $todo->id }}, '{{ $todo->title }}', '{{ $todo->user->name }}')"
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
                        <div class="p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada todo</h3>
                            <p class="mt-1 text-sm text-gray-500">Todo akan muncul setelah user membuat todo.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Forms for Delete Actions -->
    <form id="deleteTodoForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <form id="deleteAllTodosForm" method="POST" action="{{ route('admin.todos.deleteAll') }}" style="display: none;">
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
                    // Show loading
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

                    // Set form action and submit
                    const form = document.getElementById('deleteTodoForm');
                    form.action = `/admin/todos/${todoId}`;
                    form.submit();
                }
            });
        }

        function confirmDeleteAll() {
            const totalTodos = {{ $todos->count() }};

            Swal.fire({
                title: 'Hapus Semua Todo?',
                html: `Yakin mau hapus <strong>SEMUA ${totalTodos} todo</strong>?<br><br><span style="color: #ef4444;">⚠️ Aksi ini tidak bisa dibatalkan!</span>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus Semua!',
                cancelButtonText: 'Batal',
                input: 'text',
                inputPlaceholder: 'Ketik "HAPUS SEMUA" untuk konfirmasi',
                inputValidator: (value) => {
                    if (value !== 'HAPUS SEMUA') {
                        return 'Ketik "HAPUS SEMUA" untuk konfirmasi!'
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus semua todo...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Submit form
                    document.getElementById('deleteAllTodosForm').submit();
                }
            });
        }
    </script>
@endsection
