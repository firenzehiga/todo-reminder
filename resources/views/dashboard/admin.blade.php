@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
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
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('admin.users') }}" class="text-sm text-gray-700 hover:text-primary-600">
                            Kelola User
                        </a>
                        <a href="{{ route('admin.todos') }}" class="text-sm text-gray-700 hover:text-primary-600">
                            Semua Todo
                        </a>
                        <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="px-4 py-6 sm:px-0">
                <!-- Welcome Card -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                    <div class="p-6">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">
                            Dashboard Admin 👨‍💼
                        </h1>
                        <p class="text-gray-600">
                            Kelola sistem Todo Reminder dan monitor aktivitas user.
                        </p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total User</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-green-500 rounded-full flex items-center justify-center">
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
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Users -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">User Terbaru</h2>
                            @if ($recentUsers->count() > 0)
                                <div class="space-y-3">
                                    @foreach ($recentUsers as $user)
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div
                                                class="h-8 w-8 bg-primary-500 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white text-sm font-medium">
                                                    {{ substr($user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                            </div>
                                            <span class="text-xs text-gray-500">
                                                {{ $user->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">Belum ada user</p>
                            @endif

                            <div class="mt-4 text-center">
                                <a href="{{ route('admin.users') }}"
                                    class="text-primary-600 hover:text-primary-800 text-sm font-medium">
                                    Lihat Semua User →
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Todos -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
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
                                                    by {{ $todo->user->name }} • {{ $todo->created_at->diffForHumans() }}
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
                                <a href="{{ route('admin.todos') }}"
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
@endsection
