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
                @auth
                    <!-- Dashboard & User Menu -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center space-x-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition {{ request()->routeIs('dashboard') ? 'bg-blue-100 font-semibold' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="hidden lg:inline">Dashboard</span>
                        </a>
                        
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" 
                                    class="flex items-center space-x-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden lg:inline">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                                <a href="{{ route('appointments.index') }}" 
                                   class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Lịch hẹn của tôi</span>
                                </a>
                                <a href="{{ route('profile.edit') }}" 
                                   class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>Thông tin cá nhân</span>
                                </a>
                                <a href="{{ route('documents.index') }}" 
                                   class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Tài liệu của tôi</span>
                                </a>
                                <a href="{{ route('reviews.index') }}" 
                                   class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    <span>Đánh giá của tôi</span>
                                </a>
                                <div class="border-t border-gray-200 my-2"></div>
                                <a href="{{ route('appointments.create') }}" 
                                   class="flex items-center space-x-3 px-4 py-2 text-blue-600 hover:bg-blue-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <span>Đặt lịch hẹn</span>
                                </a>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" 
                                       class="flex items-center space-x-3 px-4 py-2 text-purple-600 hover:bg-purple-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>Admin Panel</span>
                                    </a>
                                @endif
                                <div class="border-t border-gray-200 my-2"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center space-x-3 px-4 py-2 text-red-600 hover:bg-red-50 w-full text-left">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Đăng xuất</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Guest Menu -->
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
                    <a href="{{ route('appointments.create') }}" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transition">
                        Đặt lịch ngay
                    </a>
                    <a href="{{ route('login') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-full font-semibold hover:bg-gray-50 transition">
                        Đăng nhập
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>



