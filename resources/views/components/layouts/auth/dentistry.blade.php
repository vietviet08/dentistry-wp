<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'SmileLux - Nha khoa thẩm mỹ hàng đầu' }}</title>
        <meta name="description" content="{{ $metaDescription ?? 'SmileLux - Nha khoa thẩm mỹ với đội ngũ bác sĩ chuyên nghiệp, công nghệ hiện đại.' }}">

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @fluxAppearance
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation Header -->
            @include('layouts.partials.nav')

            <!-- Main Content -->
            <main class="flex-grow flex items-center justify-center py-16 pt-24">
                <div class="w-full max-w-md px-6">
                    <!-- Auth Card -->
                    <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                        <!-- Header Gradient Bar -->
                        <div class="bg-gradient-to-r from-blue-600 to-blue-800 h-2">
                            <div class="h-full w-24 mx-auto bg-gradient-to-r from-yellow-400 to-orange-500 rounded-b-full"></div>
                        </div>
                        
                        <!-- Content -->
                        <div class="px-10 py-8">
                            {{ $slot }}
                        </div>
                    </div>

                    <!-- Footer Help Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            {{ __('auth.need_help') }} 
                            <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors" wire:navigate>
                                {{ __('auth.contact_us') }}
                            </a>
                        </p>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            @include('layouts.partials.footer')
        </div>

        @livewireScripts
        @fluxScripts
    </body>
</html>

