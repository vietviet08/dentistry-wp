<?php

use Livewire\Volt\Component;
use App\Models\Service;

new class extends Component {
    public function layout()
    {
        return 'layouts.app';
    }
    
    public function with(): array
    {
        return [
            'services' => Service::where('is_active', true)
                ->orderBy('order')
                ->orderBy('name')
                ->get()
        ];
    }
}; ?>

<x-slot name="title">Dịch vụ - SmileLux</x-slot>

<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://source.unsplash.com/random/1440x900/?dentist-office,clean" alt="Background" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="max-w-7xl mx-auto px-5 relative z-10 text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">Các dịch vụ kỹ thuật chuyên môn của SmileLux</span>
            </h1>
            <p class="text-xl md:text-2xl mb-12 text-gray-200 max-w-4xl mx-auto leading-relaxed">
                Tại SmileLux, chúng tôi không chỉ chú trọng đến chuyên môn mà còn đề cao trải nghiệm và cảm xúc của khách hàng. Với đội ngũ bác sĩ tận tâm cùng hệ thống công nghệ hiện đại, mỗi quy trình đều được thực hiện cẩn trọng và an toàn tuyệt đối. Chúng tôi hướng đến việc mang lại những giá trị bền vững, giúp khách hàng tự tin với nụ cười khỏe đẹp mỗi ngày. SmileLux – nơi kết hợp giữa kỹ thuật, tận tâm và thẩm mỹ hoàn hảo.
            </p>
        </div>
    </section>

    <!-- Services Grid Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <!-- Service Image -->
                        <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg mb-4 flex items-center justify-center overflow-hidden">
                            @if($service->image)
                                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-blue-600 text-6xl">
                                    <svg class="w-16 h-16 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Service Content -->
                        <div class="space-y-3">
                            <h3 class="text-xl font-bold text-gray-800">{{ $service->name }}</h3>
                            
                            @if($service->description)
                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                    {{ Str::limit($service->description, 120) }}
                                </p>
                            @endif
                            
                            <div class="flex items-center justify-between pt-2">
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    @if($service->duration)
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm0 18c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8-3.6 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                            </svg>
                                            {{ $service->duration }} phút
                                        </span>
                                    @endif
                                    
                                    @if($service->price)
                                        <span class="flex items-center font-semibold text-blue-600">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                            </svg>
                                            {{ number_format($service->price, 0, ',', '.') }}đ
                                        </span>
                                    @endif
                                </div>
                                
                                <a href="{{ route('service-detail', $service->slug) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($services->isEmpty())
                <div class="text-center py-16">
                    <div class="text-gray-400 text-6xl mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Chưa có dịch vụ nào</h3>
                    <p class="text-gray-500">Hiện tại chưa có dịch vụ nào được cung cấp.</p>
                </div>
            @endif
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
