@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <!-- Main Content -->
        <div class="max-w-6xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Kelola User</h1>
                </div>

                <!-- Users Table -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    @if ($users->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="hidden lg:block">
                            <div class="table-responsive">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                User</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Email</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Bergabung</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Todo Count</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($users as $user)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="h-8 w-8 bg-blue-700 rounded-full flex items-center justify-center mr-3">
                                                            <span class="text-white text-sm font-medium">
                                                                {{ substr($user->name, 0, 1) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $user->name }}</div>
                                                            <div class="text-sm text-gray-500">{{ ucfirst($user->role) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $user->email }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $user->created_at->format('d M Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $user->todos()->count() }} todo
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="{{ route('admin.users.show', $user) }}"
                                                        class="text-blue-600 hover:text-blue-900 mr-3">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.users.delete', $user) }}"
                                                        class="inline"
                                                        onsubmit="return confirm('Yakin hapus user {{ $user->name }}? Semua todo-nya akan ikut terhapus!')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            <i class="fas fa-trash"></i>
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
                            @foreach ($users as $user)
                                <div class="p-4">
                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="h-10 w-10 bg-custom-madder rounded-full flex items-center justify-center flex-shrink-0">
                                            <span class="text-white text-sm font-medium">
                                                {{ substr($user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                                <h3 class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}
                                                </h3>
                                                <span class="text-xs text-gray-500">{{ ucfirst($user->role) }}</span>
                                            </div>
                                            <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
                                            <div class="flex items-center justify-between mt-2">
                                                <div class="flex items-center space-x-4 text-xs text-gray-500">
                                                    <span>{{ $user->created_at->format('d M Y') }}</span>
                                                    <span>{{ $user->todos()->count() }} todo</span>
                                                </div>
                                                <div class="space-x-2">
                                                    <a href="{{ route('admin.users.show', $user) }}"
                                                        class="text-blue-600 hover:text-blue-900 text-xs">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('admin.users.delete', $user) }}" class="inline"
                                                        onsubmit="return confirm('Yakin hapus user {{ $user->name }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 text-xs">
                                                            🗑️ </button>
                                                    </form>
                                                </div>
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
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada user</h3>
                            <p class="mt-1 text-sm text-gray-500">User akan muncul setelah registrasi.</p>
                        </div>
                    @endif
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
