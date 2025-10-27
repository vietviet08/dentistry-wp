<footer class="bg-blue-50 py-16">
    <div class="max-w-7xl mx-auto px-5">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <!-- Logo & Social -->
            <div class="md:col-span-1">
                <div class="mb-6">
                    <div class="w-32 h-8 bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white font-bold text-lg">SmileLux</span>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Links -->
            <div>
                <h3 class="font-bold text-gray-800 mb-4">Liên Kết</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('about-us') }}" class="text-gray-600 hover:text-blue-600 transition">Về chúng tôi</a></li>
                            <li><a href="{{ route('services') }}" class="text-gray-600 hover:text-blue-600 transition">Dịch vụ</a></li>
                            <li><a href="{{ route('team') }}" class="text-gray-600 hover:text-blue-600 transition">Đội ngũ</a></li>
                            <li><a href="{{ route('gallery') }}" class="text-gray-600 hover:text-blue-600 transition">Thư viện ảnh</a></li>
                            <li><a href="{{ route('blog') }}" class="text-gray-600 hover:text-blue-600 transition">Blog</a></li>
                            <li><a href="{{ route('testimonials') }}" class="text-gray-600 hover:text-blue-600 transition">Cảm nhận khách hàng</a></li>
                            <li><a href="{{ route('faqs') }}" class="text-gray-600 hover:text-blue-600 transition">Câu hỏi thường gặp</a></li>
                            <li><a href="{{ route('contact') }}" class="text-gray-600 hover:text-blue-600 transition">Liên hệ</a></li>
                        </ul>
            </div>
            
            <!-- Branches -->
            <div>
                <h3 class="font-bold text-gray-800 mb-4">Chi nhánh</h3>
                <div class="space-y-3 text-sm text-gray-600">
                    <div>
                        <p class="font-semibold">Hà nội - cơ sở 1:</p>
                        <p>Tầng 6, 605 Quang Trung, Kiến Hưng, Hà Đông, Hà Nội</p>
                    </div>
                    <div>
                        <p class="font-semibold">Hà nội - cơ sở 2:</p>
                        <p>133 Hải Âu 1, KĐT Vinhomes Ocean Park 1, xã Gia Lâm, Hà Nội</p>
                    </div>
                    <div>
                        <p class="font-semibold">Đà Nẵng - cơ sở 3:</p>
                        <p>106 Tố Hữu, phường Hòa Cường, Đà Nẵng (Pre-opening)</p>
                    </div>
                    <div>
                        <p class="font-semibold">TP.HCM - cơ sở 4:</p>
                        <p>658/5 Cách Mạng Tháng 8, Phường Nhiêu Lộc, TP. Hồ Chí Minh</p>
                    </div>
                </div>
            </div>
            
            <!-- Contact -->
            <div>
                <h3 class="font-bold text-gray-800 mb-4">Liên hệ</h3>
                <div class="space-y-2 text-sm text-gray-600">
                    <p>Email: smileluxmarketing@gmail.com</p>
                    <p>Website: smilelux.vn</p>
                    <p>Hotline: 0918 19 69 91</p>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="border-t border-gray-300 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    2025 Dentist . Tất cả các quyền được bảo lưu.
                </div>
                <div class="flex space-x-6 text-sm text-gray-500">
                    <a href="#" class="hover:text-blue-600 transition">Chính sách bảo mật</a>
                    <a href="#" class="hover:text-blue-600 transition">Điều khoản dịch vụ</a>
                </div>
            </div>
        </div>
    </div>
</footer>

