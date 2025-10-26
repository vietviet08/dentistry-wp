<?php

use Livewire\Volt\Component;
use App\Models\Service;

new class extends Component {
    public Service $service;
    
    public function mount(Service $service)
    {
        $this->service = $service;
    }
    
    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">{{ $service->name }} - SmileLux</x-slot>

<div class="min-h-screen bg-white">
    <!-- Table of Contents Sidebar -->
    <div class="fixed left-0 top-24 w-80 h-full bg-white shadow-lg z-40 hidden lg:block">
        <div class="p-6">
            <h3 class="text-2xl font-bold text-blue-600 mb-6">Mục lục</h3>
            <div class="space-y-3">
                <a href="#introduction" class="block p-3 rounded-lg bg-white border border-gray-200 hover:bg-blue-50 transition">
                    <span class="text-gray-800 font-medium">Giới thiệu</span>
                </a>
                <a href="#process" class="block p-3 rounded-lg bg-blue-50 border border-blue-200 hover:bg-blue-100 transition">
                    <span class="text-blue-600 font-medium">Quy trình</span>
                </a>
                <a href="#benefits" class="block p-3 rounded-lg bg-white border border-gray-200 hover:bg-blue-50 transition">
                    <span class="text-gray-800 font-medium">Lợi ích</span>
                </a>
                <a href="#gallery" class="block p-3 rounded-lg bg-white border border-gray-200 hover:bg-blue-50 transition">
                    <span class="text-gray-800 font-medium">Hình ảnh thực tế</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="lg:ml-80">
        <!-- Introduction Section -->
        <section id="introduction" class="py-16 bg-white">
            <div class="max-w-4xl mx-auto px-5">
                <div class="mb-8">
                    <img src="https://source.unsplash.com/random/800x400/?dental-treatment,{{ Str::slug($service->name) }}" 
                         alt="{{ $service->name }}" 
                         class="w-full h-80 object-cover rounded-2xl shadow-lg">
                </div>
                
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ $service->name }}</span>
                    </h1>
                    
                    <div class="text-lg text-gray-600 leading-relaxed">
                        @if($service->description)
                            {{ $service->description }}
                        @else
                            {{ $service->name }} là một dịch vụ nha khoa chuyên nghiệp được thực hiện bởi đội ngũ bác sĩ giàu kinh nghiệm tại SmileLux. Chúng tôi cam kết mang đến cho khách hàng trải nghiệm điều trị an toàn, hiệu quả và thoải mái nhất.
                        @endif
                    </div>
                    
                    <div class="flex flex-wrap gap-4 text-sm">
                        @if($service->duration)
                            <div class="flex items-center bg-blue-50 px-4 py-2 rounded-full">
                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm0 18c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8-3.6 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                </svg>
                                <span class="text-blue-800 font-medium">{{ $service->duration }} phút</span>
                            </div>
                        @endif
                        
                        @if($service->price)
                            <div class="flex items-center bg-green-50 px-4 py-2 rounded-full">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                </svg>
                                <span class="text-green-800 font-medium">{{ number_format($service->price, 0, ',', '.') }}đ</span>
                            </div>
                        @endif
                        
                        @if($service->category)
                            <div class="flex items-center bg-purple-50 px-4 py-2 rounded-full">
                                <svg class="w-4 h-4 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                <span class="text-purple-800 font-medium">{{ ucfirst($service->category) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section id="process" class="py-16 bg-gray-50">
            <div class="max-w-4xl mx-auto px-5">
                <h2 class="text-4xl md:text-5xl font-bold mb-12 text-center">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Quy trình</span>
                </h2>
                
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-blue-200"></div>
                    
                    <!-- Process Steps -->
                    <div class="space-y-12">
                        <!-- Step 1 -->
                        <div class="flex items-center">
                            <div class="flex-1 text-right pr-8">
                                <div class="bg-white p-6 rounded-2xl shadow-lg">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Tư vấn 1-1</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Bác sĩ lắng nghe nhu cầu, đánh giá tình trạng răng và đưa ra phác đồ điều trị phù hợp với từng khách hàng.
                                    </p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                                01
                            </div>
                            <div class="flex-1 pl-8">
                                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="flex items-center">
                            <div class="flex-1 pr-8">
                                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                                02
                            </div>
                            <div class="flex-1 text-left pl-8">
                                <div class="bg-white p-6 rounded-2xl shadow-lg">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Mô phỏng kết quả bằng công nghệ số</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Sử dụng công nghệ hiện đại mô phỏng kết quả trước khi điều trị, giúp khách hàng hình dung rõ ràng về kết quả cuối cùng.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 3 -->
                        <div class="flex items-center">
                            <div class="flex-1 text-right pr-8">
                                <div class="bg-white p-6 rounded-2xl shadow-lg">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Thử mock-up</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Khách hàng trải nghiệm thử hình dáng, màu sắc để chọn lựa phù hợp nhất với mong muốn và gương mặt.
                                    </p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                                03
                            </div>
                            <div class="flex-1 pl-8">
                                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 4 -->
                        <div class="flex items-center">
                            <div class="flex-1 pr-8">
                                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg z-10">
                                04
                            </div>
                            <div class="flex-1 text-left pl-8">
                                <div class="bg-white p-6 rounded-2xl shadow-lg">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Gắn & Tinh chỉnh</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Thực hiện điều trị bằng kỹ thuật tối thiểu xâm lấn; tự nhiên, hài hòa với gương mặt và đảm bảo độ bền vững.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <section id="benefits" class="py-16 bg-white">
            <div class="max-w-6xl mx-auto px-5">
                <h2 class="text-4xl md:text-5xl font-bold mb-12 text-center">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Lợi ích</span>
                </h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Benefit 1 -->
                    <div class="bg-blue-50 p-6 rounded-2xl shadow-lg border border-blue-200">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Thiết kế cá nhân hóa</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Được thiết kế theo tỉ lệ gương mặt, mang lại nụ cười tự nhiên, sáng đẹp và tinh tế phù hợp với từng khách hàng.
                        </p>
                    </div>
                    
                    <!-- Benefit 2 -->
                    <div class="bg-blue-50 p-6 rounded-2xl shadow-lg border border-blue-200">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8-3.6 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Thực hiện nhanh chóng</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Thực hiện nhanh chóng, mang lại kết quả thẩm mỹ ổn định theo thời gian với quy trình chuẩn y khoa.
                        </p>
                    </div>
                    
                    <!-- Benefit 3 -->
                    <div class="bg-blue-50 p-6 rounded-2xl shadow-lg border border-blue-200">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Công nghệ tiên tiến</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Công nghệ mài siêu mỏng giúp hạn chế xâm lấn, giữ nguyên cấu trúc răng tự nhiên và đảm bảo an toàn tuyệt đối.
                        </p>
                    </div>
                    
                    <!-- Benefit 4 -->
                    <div class="bg-blue-50 p-6 rounded-2xl shadow-lg border border-blue-200">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Bảo hành toàn diện</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Chính sách bảo hành rõ ràng, đội ngũ theo dõi và chăm sóc tận tâm sau điều trị để đảm bảo kết quả tốt nhất.
                        </p>
                    </div>
                    
                    <!-- Center Image -->
                    <div class="lg:col-span-1 lg:row-span-2 flex items-center">
                        <img src="https://source.unsplash.com/random/400x600/?dental-care,professional" 
                             alt="Dental Care" 
                             class="w-full h-96 object-cover rounded-2xl shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section id="gallery" class="py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto px-5">
                <h2 class="text-4xl md:text-5xl font-bold mb-12 text-center">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Hình ảnh thực tế</span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <img src="https://source.unsplash.com/random/400x400/?dental-before-after,smile" 
                         alt="Before After 1" 
                         class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    <img src="https://source.unsplash.com/random/400x400/?dental-treatment,clean" 
                         alt="Treatment Process" 
                         class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    <img src="https://source.unsplash.com/random/400x400/?dental-result,happy" 
                         alt="Result" 
                         class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    <img src="https://source.unsplash.com/random/400x400/?dental-office,modern" 
                         alt="Office" 
                         class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    <img src="https://source.unsplash.com/random/400x400/?dental-equipment,technology" 
                         alt="Equipment" 
                         class="w-full h-64 object-cover rounded-2xl shadow-lg">
                    <img src="https://source.unsplash.com/random/400x400/?dental-smile,beautiful" 
                         alt="Beautiful Smile" 
                         class="w-full h-64 object-cover rounded-2xl shadow-lg">
                </div>
            </div>
        </section>

        <!-- Booking Form Section -->
        <section class="py-16 bg-blue-600">
            <div class="max-w-7xl mx-auto px-5">
                <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl">
                    <div class="text-center mb-8">
                        <p class="text-gray-600 text-lg mb-2">NHẬN THÔNG TIN MỚI NHẤT</p>
                        <h2 class="text-4xl md:text-5xl font-bold mb-6">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Tư vấn miễn phí</span>
                        </h2>
                    </div>
                    
                    <form class="max-w-4xl mx-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Họ và tên</label>
                                <input type="text" id="name" name="name" placeholder="Nhập họ và tên của bạn" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>
                            
                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Địa chỉ email</label>
                                <input type="email" id="email" name="email" placeholder="Nhập địa chỉ Email của bạn" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Phone Field -->
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại</label>
                                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>
                            
                            <!-- Issue Field -->
                            <div>
                                <label for="issue" class="block text-sm font-semibold text-gray-700 mb-2">Vấn đề bạn cần tư vấn</label>
                                <input type="text" id="issue" name="issue" placeholder="Vấn đề bạn cần tư vấn" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>
                        </div>
                        
                        <!-- Checkboxes -->
                        <div class="space-y-4 mb-8">
                            <label class="flex items-start space-x-3">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-gray-700 text-sm">Gửi cho tôi các thông tin cập nhật hàng tháng qua bản tin</span>
                            </label>
                            
                            <label class="flex items-start space-x-3">
                                <input type="checkbox" class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-gray-700 text-sm">Tôi xác nhận đã đọc và đồng ý với Hướng dẫn dành cho khách hàng và Điều khoản sử dụng.</span>
                            </label>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-12 py-4 rounded-full font-semibold text-lg hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                Đặt lịch ngay
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
