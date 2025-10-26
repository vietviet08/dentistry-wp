<?php

use Livewire\Volt\Component;
use App\Models\Service;
use App\Models\Doctor;

new class extends Component {
    public function layout()
    {
        return 'layouts.app';
    }
    public function with(): array
    {
        return [
            'featuredServices' => Service::where('is_active', true)
                ->orderBy('order')
                ->limit(4)
                ->get(),
            'featuredDoctors' => Doctor::where('is_available', true)
                ->orderBy('order')
                ->limit(4)
                ->get(),
        ];
    }
}; ?>

<x-slot name="title">SmileLux - Nha khoa thẩm mỹ</x-slot>

<div class="min-h-screen">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1606811841689-23dfddceeee3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                 alt="Dental Clinic" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-5 text-center text-white">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-7xl font-bold mb-8 leading-tight">
                    Kiến tạo nụ cười<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">
                        rạng ngời
                    </span>
                    </h1>
                <p class="text-xl md:text-2xl mb-12 text-gray-200 max-w-3xl mx-auto">
                    SmileLux kiến tạo nụ cười rạng ngời bằng chuyên môn, công nghệ và sự tận tâm
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <button class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-xl transition-all transform hover:scale-105">
                        Đặt lịch ngay
                    </button>
                    <button class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all">
                        Tìm hiểu thêm
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
            <div class="animate-bounce">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>

   

    <!-- Introduction Section -->
    <section class="py-20 bg-gradient-to-b from-white to-blue-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center ">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Giới thiệu</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    SmileLux kiến tạo nụ cười rạng ngời bằng chuyên môn, công nghệ và sự tận tâm
                </p>
            </div>
             <!-- Services Section -->
            <section class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Service Card 1: Cosmetic -->
                        <div class="bg-blue-50 rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Dịch vụ thẩm mỹ</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Mang đến nụ cười tự nhiên, rạng ngời với giải pháp dán sứ Veneer – khắc phục răng xỉn màu, sứt mẻ, khấp khểnh nhẹ và kém hài hòa.
                            </p>
                        </div>

                        <!-- Service Card 2: Implant -->
                        <div class="bg-blue-50 rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Dịch vụ Implant</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Khôi phục răng đã mất bằng giải pháp Implant hiện đại – an toàn, chắc chắn, đảm bảo chức năng ăn nhai và thẩm mỹ tự nhiên như răng thật.
                            </p>
                        </div>

                        <!-- Service Card 3: Orthodontics -->
                        <div class="bg-blue-50 rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Dịch vụ chỉnh nha</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Giúp sắp xếp răng đều đẹp, cải thiện khớp cắn và nụ cười tự nhiên với các phương pháp niềng răng trong suốt hoặc niềng mắc cài.
                            </p>
                        </div>

                        <!-- Service Card 4: General -->
                        <div class="bg-blue-50 rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Dịch vụ nha khoa tổng quát</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Chăm sóc toàn diện sức khỏe răng miệng: tẩy trắng răng, trám, điều trị tủy, nhổ răng khôn, nha chu và gói chăm sóc gia đình.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <!-- Before & After Section -->
    <section class="py-20 bg-gradient-to-b from-blue-50 to-white">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Trước & Sau điều trị</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Mỗi tấm hình trước – sau là một dấu mốc trong hành trình mà SmileLux đồng hành cùng khách hàng để tìm lại nụ cười rạng rỡ và tự tin hơn mỗi ngày.
                </p>
            </div>
            
            <!-- Before/After Image -->
            <div class="relative max-w-5xl mx-auto">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1606811971618-4486d14f3f99?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                         alt="Before After Treatment" 
                         class="w-full h-96 object-cover">
                    
                    <!-- Before/After Labels -->
                    <div class="absolute top-8 left-8">
                        <span class="bg-white text-gray-800 px-4 py-2 rounded-full font-semibold shadow-lg">Trước</span>
                    </div>
                    <div class="absolute top-8 right-8">
                        <span class="bg-blue-600 text-white px-4 py-2 rounded-full font-semibold shadow-lg">Sau</span>
                    </div>
                    
                    <!-- Play Button -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-20 h-20 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center shadow-xl hover:scale-110 transition-transform cursor-pointer">
                            <svg class="w-8 h-8 text-blue-600 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section class="py-20 bg-blue-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Đội ngũ y bác sĩ</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Đội ngũ bác sĩ tận tâm, giàu kinh nghiệm – đồng hành cùng bạn trong hành trình chăm sóc nụ cười
                </p>
            </div>
            
            <!-- Doctors Grid -->
            <div class="relative">
                <!-- Navigation Arrows -->
                <button class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-4 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:shadow-xl transition">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-4 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:shadow-xl transition">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Doctor 1 -->
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                                 alt="Dr. Đặng Thị Hồng Hạnh" 
                                 class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4">
                                    <h3 class="font-semibold text-gray-800 mb-1">Bác sĩ Đặng Thị Hồng Hạnh</h3>
                                    <p class="text-sm text-gray-600">Chuyên gia thẩm mỹ & Implant</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Doctor 2 -->
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                                 alt="Dr. Nguyễn Thị Hương" 
                                 class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4">
                                    <h3 class="font-semibold text-gray-800 mb-1">Bác sĩ Nguyễn Thị Hương</h3>
                                    <p class="text-sm text-gray-600">Chuyên gia thẩm mỹ & nha khoa tổng quát</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Doctor 3 -->
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4">
                            <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                                 alt="Dr. Lưu Thành Trung" 
                                 class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4">
                                    <h3 class="font-semibold text-gray-800 mb-1">Bác sĩ Lưu Thành Trung</h3>
                                    <p class="text-sm text-gray-600">Chuyên gia chỉnh nha & Implant</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Doctor 4 -->
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4">
                            <img src="https://images.unsplash.com/photo-1594824371740-4a0b2a2b2b2b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                                 alt="Dr. Đinh Thị Thư" 
                                 class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4">
                                    <h3 class="font-semibold text-gray-800 mb-1">Bác sĩ Đinh Thị Thư</h3>
                                    <p class="text-sm text-gray-600">Chuyên gia Veneer & nha khoa thẩm mỹ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Cơ sở vật chất của chúng tôi</span>
                </h2>
            </div>
            
            <!-- Facilities Grid -->
            <div class="relative">
                <!-- Navigation Arrows -->
                <button class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-4 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:shadow-xl transition">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-4 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:shadow-xl transition">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Facility 1 -->
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4">
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                                 alt="Consultation Room" 
                                 class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Phòng tư vấn & chẩn đoán</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Không gian riêng tư, thân thiện - nơi bác sĩ lắng nghe và lập kế hoạch điều trị cá nhân hóa cho từng khách hàng.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Facility 2 -->
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4">
                            <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                                 alt="X-ray Room" 
                                 class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Phòng X-quang & Scan 3D</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Trang bị công nghệ chẩn đoán hình ảnh tiên tiến, giúp phát hiện chính xác tình trạng răng và lên phác đồ điều trị tối ưu.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Facility 3 -->
                    <div class="group">
                        <div class="relative overflow-hidden rounded-2xl mb-4">
                            <img src="https://images.unsplash.com/photo-1606811841689-23dfddceeee3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                                 alt="Treatment Room" 
                                 class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Phòng điều trị & Implant</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Đạt tiêu chuẩn vô trùng, tích hợp thiết bị hiện đại hỗ trợ phẫu thuật và phục hình Implant an toàn, chính xác.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-blue-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 left-20 w-32 h-32 bg-blue-600 rounded-full"></div>
            <div class="absolute top-40 right-32 w-24 h-24 bg-blue-400 rounded-full"></div>
            <div class="absolute bottom-20 left-32 w-28 h-28 bg-blue-500 rounded-full"></div>
            <div class="absolute bottom-40 right-20 w-20 h-20 bg-blue-600 rounded-full"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-5 relative z-10">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Khách hàng nói gì về SmileLux</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Niềm tin của khách hàng là minh chứng rõ ràng nhất cho chất lượng SmileLux.
                </p>
            </div>
            
            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-600 font-semibold">M</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Mai Văn Đức</h4>
                            <p class="text-sm text-gray-600">Tự do</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        "Implant tại SmileLux giúp tôi ăn nhai thoải mái như răng thật. Quy trình nhanh, an toàn, đội ngũ bác sĩ rất tận tâm và chuyên nghiệp."
                    </p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-600 font-semibold">V</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Vũ Thị Thu Phương</h4>
                            <p class="text-sm text-gray-600">Kinh doanh</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        "Răng tôi bị xỉn màu và viêm nướu. Khi được đội ngũ bác sĩ SmileLux tận tình chăm sóc, nụ cười của tôi thay đổi rõ rệt – răng đều đẹp, nướu khỏe mạnh và tự tin hơn."
                    </p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition border-2 border-blue-600">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <span class="text-blue-600 font-semibold">N</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Nguyễn Thị Sinh</h4>
                            <p class="text-sm text-gray-600">Kinh doanh</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        "Tôi từng rất ngại cười vì răng nhiễm màu và lệch khớp. Sau khi dán sứ tại SmileLux, tôi thấy tự tin hơn hẳn. Bác sĩ tư vấn nhẹ nhàng, chu đáo và kết quả thì vượt mong đợi!"
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Testimonial -->
    <section class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Image -->
                <div class="relative">
                    <div class="relative rounded-2xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Trần Bình Trọng" 
                             class="w-full h-96 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                </div>
                
                <!-- Testimonial Content -->
                <div class="bg-white rounded-2xl p-8 shadow-xl border-2 border-blue-600">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Trần Bình Trọng</h3>
                        <p class="text-gray-600">Diễn viên</p>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-lg">
                        "Tôi luôn xem nụ cười là yếu tố quan trọng để tạo thiện cảm trước khán giả. SmileLux đã giúp tôi lấy lại nụ cười sáng, tự nhiên và đúng với hình ảnh tôi mong muốn. Trải nghiệm điều trị nhẹ nhàng, bác sĩ rất tận tâm."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Reasons to Choose Section -->
    <section class="py-20 bg-gradient-to-b from-white to-blue-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Lý do bạn nên chọn SmileLux</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    SmileLux mang đến trải nghiệm nha khoa chuẩn y khoa với công nghệ hiện đại, chi phí minh bạch, chính sách bảo hành dài lâu và quy trình vô trùng tuyệt đối – giúp mỗi khách hàng an tâm trên hành trình kiến tạo nụ cười hạnh phúc.
                </p>
            </div>
            
            <!-- Reasons Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Reason 1 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Công nghệ hiện đại</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Ứng dụng Scan 3D chẩn đoán chính xác và lập phác đồ điều trị tối ưu.
                    </p>
                </div>
                
                <!-- Reason 2 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Minh bạch chi phí</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Bảng giá rõ ràng, cam kết không phát sinh và đa dạng hình thức thanh toán.
                    </p>
                </div>
                
                <!-- Reason 3 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Chuẩn vô trùng</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Tuân thủ tiêu chuẩn vô trùng quốc tế, đảm bảo an toàn tuyệt đối cho khách hàng.
                    </p>
        </div>

                <!-- Reason 4 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Bảo hành dài lâu</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Chính sách bảo hành minh bạch, đồng hành cùng khách hàng dài lâu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="py-20 bg-blue-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="bg-white rounded-3xl p-12 shadow-2xl">
                <div class="text-center mb-12">
                    <p class="text-sm text-gray-500 mb-2">NHẬN THÔNG TIN MỚI NHẤT</p>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Tư vấn miễn phí</span>
                    </h2>
                </div>
                
                <!-- Contact Form -->
                <form class="max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Họ và tên</label>
                            <input type="text" placeholder="Nhập họ và tên của bạn" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Địa chỉ email</label>
                            <input type="email" placeholder="Nhập địa chỉ Email của bạn" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại</label>
                            <input type="tel" placeholder="Nhập số điện thoại của bạn" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Vấn đề bạn cần tư vấn</label>
                            <input type="text" placeholder="Vấn đề bạn cần từ vấn" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                            </div>
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                        <div class="space-y-4">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Gửi cho tôi các thông tin cập nhật hàng tháng qua bản tin</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Tôi xác nhận đã đọc và đồng ý với Hướng dẫn dành cho khách hàng và Điều khoản sử dụng.</span>
                            </label>
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-xl transition-all transform hover:scale-105">
                            Đặt lịch ngay
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-blue-800 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-20 h-20 bg-white rounded-full"></div>
            <div class="absolute top-20 right-20 w-16 h-16 bg-white rounded-full"></div>
            <div class="absolute bottom-10 left-20 w-24 h-24 bg-white rounded-full"></div>
            <div class="absolute bottom-20 right-10 w-12 h-12 bg-white rounded-full"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-5 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="text-center lg:text-left">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">
                        Tận tâm &<br>
                        Chuyên nghiệp
                    </h2>
                </div>
                
                <div class="flex flex-col items-center gap-8">
                    <button class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:shadow-xl transition-all transform hover:scale-105">
                        Đặt lịch Ngay
                    </button>
                    
                    <div class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">Nha khoa khẩn cấp 24H</h3>
                            <p class="text-blue-100">0918 19 69 91</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
