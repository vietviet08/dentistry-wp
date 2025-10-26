<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'SmileLux - Nha khoa thẩm mỹ hàng đầu' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'SmileLux - Nha khoa thẩm mỹ với đội ngũ bác sĩ chuyên nghiệp, công nghệ hiện đại. Dịch vụ niềng răng, cấy ghép implant, tẩy trắng răng và các dịch vụ nha khoa khác.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'nha khoa, nha khoa thẩm mỹ, niềng răng, cấy ghép implant, tẩy trắng răng, SmileLux' }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $ogTitle ?? ($title ?? 'SmileLux - Nha khoa thẩm mỹ') }}">
    <meta property="og:description" content="{{ $ogDescription ?? ($metaDescription ?? 'SmileLux - Nha khoa thẩm mỹ với đội ngũ bác sĩ chuyên nghiệp') }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $ogTitle ?? ($title ?? 'SmileLux - Nha khoa thẩm mỹ') }}">
    <meta name="twitter:description" content="{{ $ogDescription ?? ($metaDescription ?? 'SmileLux - Nha khoa thẩm mỹ với đội ngũ bác sĩ chuyên nghiệp') }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('images/og-image.jpg') }}">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "MedicalBusiness",
        "name": "SmileLux",
        "description": "Nha khoa thẩm mỹ hàng đầu với đội ngũ bác sĩ chuyên nghiệp và công nghệ hiện đại",
        "url": "{{ url('/') }}",
        "telephone": "0918 19 69 91",
        "email": "smileluxmarketing@gmail.com",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Tầng 6, 605 Quang Trung, Kiến Hưng, Hà Đông",
            "addressLocality": "Hà Nội",
            "addressCountry": "VN"
        },
        "priceRange": "$$",
        "medicalSpecialty": "Dentistry"
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        @include('layouts.partials.nav')

        <!-- Page Content -->
        <main class="pt-16">
            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </main>

        <!-- Footer -->
        @include('layouts.partials.footer')
    </div>

    @livewireScripts
</body>
</html>

