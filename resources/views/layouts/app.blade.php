<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ReMine | Reminder App</title>
    <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}"> 

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Poppins', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont',
                            'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif'
                        ],
                    },
                    colors: {
                        custom: {
                            madder: '#A31621',
                            snow: '#FCF7F8',
                        
                        }
                        
                    }
                }
            }
        }
    </script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <style>
        /* Prevent FOUC - Set initial colors */
        html {
            background-color: #f9fafb; /* light mode default */
        }
        
        /* Pastikan Poppins diterapkan ke semua elemen */
        * {
            font-family: 'Poppins', sans-serif;
        }

        /* Custom SweetAlert2 font */
        .swal2-popup {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Light mode scrollbar */
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Compact View Styles */
        .compact-todo {
            padding: 0.75rem !important;
            margin-bottom: 0.5rem !important;
        }

        .compact-todo .todo-description {
            display: none !important;
        }

        .compact-todo .todo-actions {
            padding: 0.25rem !important;
        }

        .compact-todo .todo-title {
            font-size: 0.875rem !important;
            line-height: 1.25rem !important;
        }

        .compact-todo .todo-meta {
            font-size: 0.75rem !important;
        }

        /* Keyboard Navigation Styles */
        .keyboard-selected {
            ring: 2px;
            ring-color: #3b82f6;
            ring-offset: 2px;
            outline: none;
            background-color: rgba(59, 130, 246, 0.05) !important;
        }

        /* Kanban Card Animations */
        .kanban-card {
            transition: all 0.2s ease;
            position: relative;
        }

        .kanban-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Smooth kanban column transitions */
        #todoColumn, #progressColumn, #doneColumn {
            transition: background-color 0.2s ease;
            min-height: 120px;
        }

        /* Placeholder styling */
        .placeholder-msg {
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .placeholder-msg button {
            pointer-events: all;
        }

        /* Drag effects */
        .kanban-card.dragging {
            transform: rotate(5deg);
            z-index: 1000;
        }

        /* Calendar Day Styles */
        .calendar-day {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .calendar-day:hover {
            background-color: rgba(59, 130, 246, 0.05);
        }

        .calendar-day.today {
            background-color: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }

        /* View transition animations */
        .view-content {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .kanban-columns {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .calendar-grid {
                gap: 1px;
            }
            
            .calendar-day {
                min-height: 60px;
                font-size: 0.75rem;
            }
            
            /* Mobile kanban card adjustments */
            .kanban-card {
                margin-bottom: 0.75rem;
            }
            
            /* Mobile header adjustments */
            .view-toggle {
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
            }
            
            /* Compact mobile layout for todos */
            .todo-row.compact-todo .todo-actions {
                flex-direction: row;
                space-x: 0.5rem;
            }
            
            .todo-row.compact-todo .todo-actions > * {
                font-size: 0.625rem;
                padding: 0.25rem 0.5rem;
            }
        }

        /* Tablet adjustments */
        @media (min-width: 768px) and (max-width: 1024px) {
            .kanban-columns {
                gap: 1rem;
            }
            
            .calendar-day {
                min-height: 70px;
            }
        }

        /* Focus styles for accessibility */
        .view-toggle:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        /* Custom focus styles for better keyboard navigation */
        button:focus-visible,
        input:focus-visible,
        textarea:focus-visible,
        select:focus-visible {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        /* Drag and drop styles */
        .drag-over {
            background-color: rgba(59, 130, 246, 0.1) !important;
            border-color: #3b82f6 !important;
            border-style: dashed !important;
        }

        /* Utility classes for text truncation */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Mobile menu animation */
        .mobile-menu {
            transition: all 0.3s ease-in-out;
            transform: translateX(-100%);
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Responsive table styles */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        @media (max-width: 768px) {
            .table-responsive table {
                min-width: 600px;
            }
        }
    </style>
    @livewireStyles
</head>

<body class="bg-gray-50 font-sans antialiased min-h-screen">
    
    <div class="min-h-screen">
        @auth
        <!-- Navigation -->
        <nav class="bg-custom-madder shadow-md border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                    <!-- Logo & Brand -->
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="h-14 w-14 object-cover">
                        <span class="ml-4 text-2xl font-semibold text-white">Todo Reminder</span>
                    </a>
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-4">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-sm text-custom-snow hover:text-red-200 px-3 py-2 rounded-md transition-colors duration-300">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.users') }}"
                            class="text-sm text-custom-snow hover:text-red-200 px-3 py-2 rounded-md transition-colors duration-300">
                            Kelola User
                        </a>
                        <a href="{{ route('admin.todos') }}"
                            class="text-sm text-custom-snow hover:text-red-200 px-3 py-2 rounded-md transition-colors duration-300">
                            Semua Todo
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}"
                            class="text-sm text-custom-snow hover:text-red-200 px-3 py-2 rounded-md transition-colors duration-300">
                            Dashboard
                        </a>
                        <a href="{{ route('todos.index') }}"
                            class="text-sm text-custom-snow hover:text-red-200 px-3 py-2 rounded-md transition-colors duration-300">
                            Kelola Todo
                        </a>
                    @endif

                <span class="text-sm text-custom-snow font-bold transition-colors duration-300">Halo, {{ Auth::user()->name }}</span>
                <button onclick="confirmLogout()"
                    class="flex items-center gap-2 bg-white  hover:bg-red-200 text-black text-sm font-semibold px-4 py-2 rounded-md shadow transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 group">
                    <svg class="w-5 h-5 text-black group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                    </svg>
                    Logout
                </button>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                <button onclick="toggleMobileMenu()"
                    class="text-white hover:text-red-200 focus:outline-none focus:text-primary-600">
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
                <div class="px-3 py-2 text-sm text-gray-600 border-b border-gray-200 font-bold">
                    {{ Auth::user()->name }}
                </div>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                        Dashboard Admin
                    </a>
                    <a href="{{ route('admin.users') }}"
                        class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                        Kelola User
                    </a>
                    <a href="{{ route('admin.todos') }}"
                        class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                        Semua Todo
                    </a>
                @else
                <a href="{{ route('dashboard') }}"
                    class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                    Dashboard
                </a>
                <a href="{{ route('todos.index') }}"
                    class="block px-3 py-2 text-sm text-primary-600 bg-primary-50 rounded-md">
                    Kelola Todo
                </a>
                @endif

                <button onclick="confirmLogout()"
                    class="block w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md">
                    Logout
                </button>
                </div>
            </div>
            </div>
        </nav>
        @endauth
        @yield('content')
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

    <!-- SweetAlert2 untuk Flash Messages -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'font-poppins'
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'font-poppins'
                }
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: '@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'font-poppins'
                }
            });
        </script>
    @endif

    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const overlay = document.getElementById('mobileMenuOverlay');

            if (mobileMenu && overlay) {
                mobileMenu.classList.toggle('active');
                overlay.classList.toggle('hidden');
            }
        }

        // Close mobile menu when clicking overlay
        document.addEventListener('DOMContentLoaded', function() {
            const overlay = document.getElementById('mobileMenuOverlay');
            if (overlay) {
                overlay.addEventListener('click', toggleMobileMenu);
            }
        });
    </script>
    @livewireScripts
</body>

</html>
