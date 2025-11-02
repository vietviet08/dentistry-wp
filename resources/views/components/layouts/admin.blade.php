<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Panel' }} - {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
        >
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Dentistry</span>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <x-admin.sidebar-item icon="layout-dashboard" href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    {{ __('nav.dashboard') }}
                </x-admin.sidebar-item>

                <x-admin.sidebar-item icon="calendar-check" href="{{ route('admin.appointments.index') }}" :active="request()->routeIs('admin.appointments.*')">
                    {{ __('admin.menu.appointments') }}
                </x-admin.sidebar-item>

                <x-admin.sidebar-item icon="users" href="{{ route('admin.patients.index') }}" :active="request()->routeIs('admin.patients.*')">
                    {{ __('admin.menu.patients') }}
                </x-admin.sidebar-item>

                <x-admin.sidebar-item icon="medical-bag" href="{{ route('admin.services.index') }}" :active="request()->routeIs('admin.services.*')">
                    {{ __('admin.menu.services') }}
                </x-admin.sidebar-item>

                <x-admin.sidebar-item icon="doctor" href="{{ route('admin.doctors.index') }}" :active="request()->routeIs('admin.doctors.*')">
                    {{ __('admin.menu.doctors') }}
                </x-admin.sidebar-item>

                <x-admin.sidebar-item icon="file-document" href="{{ route('admin.posts.index') }}" :active="request()->routeIs('admin.posts.*')">
                    {{ __('admin.menu.blog') }}
                </x-admin.sidebar-item>

                <x-admin.sidebar-item icon="image" href="{{ route('admin.gallery.index') }}" :active="request()->routeIs('admin.gallery.index')">
                    {{ __('admin.menu.gallery') }}
                </x-admin.sidebar-item>

                <x-admin.sidebar-item icon="star" href="{{ route('admin.reviews.index') }}" :active="request()->routeIs('admin.reviews.index')">
                    {{ __('admin.menu.reviews') }}
                </x-admin.sidebar-item>

                <x-admin.sidebar-item icon="cog" href="{{ route('admin.settings.general') }}" :active="request()->routeIs('admin.settings.*')">
                    {{ __('admin.menu.settings') }}
                </x-admin.sidebar-item>
            </nav>

            <!-- User Section -->
            <div class="px-4 py-4 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-gray-700 font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200">
                <div class="flex items-center justify-between h-16 px-4 lg:px-6">
                    <!-- Mobile Menu Button -->
                    <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Page Title -->
                    <div class="flex-1 lg:ml-0">
                        <h1 class="text-lg font-semibold text-gray-900">{{ $title ?? 'Dashboard' }}</h1>
                    </div>

                    <!-- Right Side Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Language Switcher -->
                        <livewire:locale-switcher />
                        
                        <!-- Notifications -->
                        <button class="relative text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                        </button>

                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" x-cloak
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('nav.dashboard') }}
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('nav.my_profile') }}
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ __('nav.logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 lg:p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false"
         x-cloak
         class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 lg:hidden">
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>

