<!-- Navigation Header -->
<header class="fixed top-0 left-0 right-0 z-50 bg-white/50 backdrop-blur-md border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-5">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="w-32 h-8 bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-lg">SmileLux</span>
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition' }}">Trang chủ</a>
                <a href="{{ route('about-us') }}" class="{{ request()->routeIs('about-us') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition' }}">Về chúng tôi</a>
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition' }}">Dịch vụ</a>
                        <a href="{{ route('team') }}" class="{{ request()->routeIs('team') || request()->routeIs('doctor-detail') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition' }}">Đội ngũ</a>
                <a href="{{ route('testimonials') }}" class="{{ request()->routeIs('testimonials') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition' }}">Cảm nhận</a>
                <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') || request()->routeIs('blog-detail') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition' }}">Blog</a>
                <a href="{{ route('faqs') }}" class="{{ request()->routeIs('faqs') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition' }}">FAQs</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition' }}">Liên hệ</a>
            </nav>
            
            <!-- Language & CTA -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-6 bg-red-600 relative overflow-hidden rounded-sm">
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <svg class="w-4 h-4 text-yellow-200" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-sm text-gray-600">VN</span>
                </div>
                <button class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transition">
                    Đặt lịch ngay
                </button>
            </div>
        </div>
    </div>
</header>

