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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 text-xl font-semibold text-gray-900">Admin Panel</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-700 hover:text-primary-600">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users') }}" class="text-sm text-gray-700 hover:text-primary-600">
                        Kelola User
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
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('admin.users') }}" class="text-primary-600 hover:text-primary-800 text-sm font-medium">
                    ← Kembali ke Daftar User
                </a>
            </div>

            <!-- User Info -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
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
                                Bergabung {{ $user->created_at->format('d M Y') }} • {{ $user->created_at->diffForHumans() }}
                            </p>
                        </div>
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
                            <p class="text-sm text-gray-500">Overdue</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Todos -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Todo Terbaru</h2>
                    @if($user->todos->count() > 0)
                        <div class="space-y-3">
                            @foreach($user->todos as $todo)
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <div class="h-2 w-2 bg-{{ $todo->getPriorityColor() }}-500 rounded-full mr-3"></div>
                                    <div class="flex-1">
                                        <h3 class="text-sm font-medium text-gray-900 {{ $todo->isCompleted() ? 'line-through' : '' }}">
                                            {{ $todo->title }}
                                        </h3>
                                        @if($todo->description)
                                            <p class="text-sm text-gray-500 mt-1">{{ $todo->description }}</p>
                                        @endif
                                        <div class="flex items-center space-x-4 mt-2">
                                            <span class="text-xs px-2 py-1 rounded-full bg-{{ $todo->getPriorityColor() }}-100 text-{{ $todo->getPriorityColor() }}-800">
                                                {{ ucfirst($todo->priority) }}
                                            </span>
                                            @if($todo->due_date)
                                                <span class="text-xs text-gray-500">
                                                    Due: {{ $todo->due_date->format('d M Y') }}
                                                </span>
                                            @endif
                                            <span class="text-xs text-gray-500">
                                                {{ $todo->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                    <span class="text-xs px-2 py-1 rounded-full {{ $todo->isCompleted() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($todo->status) }}
                                    </span>
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
@endsection
