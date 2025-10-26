<?php

use Livewire\Volt\Component;
use App\Models\Doctor;

new class extends Component {
    public Doctor $doctor;

    public function mount(Doctor $doctor): void
    {
        $this->doctor = $doctor;
    }

    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">{{ $doctor->name }} - SmileLux</x-slot>

<div class="min-h-screen bg-white pt-16">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-5 py-10">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left Sidebar -->
            <div class="lg:w-1/3 space-y-6">
                <!-- Doctor Profile Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative">
                        @if($doctor->photo)
                            <img src="{{ $doctor->photo }}" 
                                 alt="{{ $doctor->name }}" 
                                 class="w-full h-96 object-cover">
                        @else
                            <img src="https://source.unsplash.com/random/400x500/?doctor,dentist,professional" 
                                 alt="{{ $doctor->name }}" 
                                 class="w-full h-96 object-cover">
                        @endif
                    </div>
                    <div class="p-6">
                        <h1 class="text-3xl font-bold mb-2">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ $doctor->name }}</span>
                        </h1>
                        <p class="text-blue-600 font-semibold mb-4">{{ $doctor->specialization }}</p>
                        @if($doctor->bio)
                            <p class="text-gray-600 leading-relaxed">{{ Str::limit($doctor->bio, 150) }}</p>
                        @endif
                    </div>
                </div>

                <!-- Contact Information Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Thông tin liên hệ</h3>
                    <div class="space-y-4">
                        @if($doctor->phone)
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Số điện thoại:</p>
                                <p class="text-gray-800">{{ $doctor->phone }}</p>
                            </div>
                        @endif
                        @if($doctor->email)
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Mail:</p>
                                <p class="text-gray-800">{{ $doctor->email }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Giờ làm việc:</p>
                            <p class="text-gray-800">Thứ 2 – Thứ 6<br>9:00 AM – 5:00 PM</p>
                        </div>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="flex space-x-3 mt-6">
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
            </div>

            <!-- Main Content -->
            <div class="lg:w-2/3 space-y-8">
                <!-- Introduction Section -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-4">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Giới thiệu</span>
                    </h2>
                    @if($doctor->bio)
                        <p class="text-gray-600 leading-relaxed">{{ $doctor->bio }}</p>
                    @else
                        <p class="text-gray-600 leading-relaxed">
                            Với hơn {{ $doctor->experience_years ?? 'nhiều' }} năm kinh nghiệm trong lĩnh vực nha khoa thẩm mỹ và phục hình, {{ $doctor->name }} luôn được bệnh nhân biết đến với phong thái điềm đạm, kỹ thuật tỉ mỉ và sự tận tâm trong từng ca điều trị. Bác sĩ không chỉ chú trọng vào yếu tố thẩm mỹ, mà còn hướng tới sự bền vững và sức khỏe răng miệng lâu dài cho mỗi khách hàng.
                        </p>
                    @endif
                </div>

                <!-- Education & Certificates Section -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Học vấn & Chứng chỉ chuyên môn</span>
                    </h2>
                    <div class="space-y-4">
                        @if($doctor->qualification)
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-600">{{ $doctor->qualification }}</p>
                            </div>
                        @endif
                        
                        <!-- Additional certificates -->
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600">Chứng chỉ hành nghề Nha khoa cấp năm {{ date('Y') - ($doctor->experience_years ?? 5) }}</p>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600">Chứng chỉ Cấy ghép Implant – Bệnh viện Hữu nghị Việt Nam - Cuba</p>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600">Chứng chỉ Dán sứ Veneer & Thẩm mỹ nụ cười – Hội răng hàm mặt Việt Nam</p>
                        </div>
                    </div>
                </div>

                <!-- Achievements Section -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Thành tựu & Ghi nhận chuyên môn</span>
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 p-6 rounded-xl border border-blue-200">
                            <div class="flex items-center justify-center w-12 h-12 bg-white rounded-full mb-4 shadow-inner">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600 text-sm">Thực hiện thành công hơn {{ ($doctor->experience_years ?? 10) * 100 }}+ ca phục hình sứ và tiểu phẫu răng miệng</p>
                        </div>
                        
                        <div class="bg-blue-50 p-6 rounded-xl border border-blue-200">
                            <div class="flex items-center justify-center w-12 h-12 bg-white rounded-full mb-4 shadow-inner">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600 text-sm">Diễn giả khách mời tại các hội thảo chuyên ngành Implant & Veneer</p>
                        </div>
                        
                        <div class="bg-blue-50 p-6 rounded-xl border border-blue-200">
                            <div class="flex items-center justify-center w-12 h-12 bg-white rounded-full mb-4 shadow-inner">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600 text-sm">Thành viên Hiệp hội Nha khoa Việt Nam (VDA)</p>
                        </div>
                    </div>
                </div>

                <!-- Quote Section -->
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl p-8 relative">
                    <div class="absolute top-4 left-4">
                        <svg class="w-12 h-12 text-blue-600 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <p class="text-lg text-gray-700 italic leading-relaxed">
                            "Một nụ cười đẹp không chỉ đến từ kỹ thuật, mà còn từ sự thấu hiểu và tận tâm trong từng chi tiết điều trị."
                        </p>
                        <p class="text-right text-blue-600 font-semibold mt-4">— {{ $doctor->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Form Section -->
    <section class="py-16 bg-blue-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="bg-blue-100 rounded-3xl p-8 md:p-16 flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="lg:w-1/2 text-center lg:text-left">
                    <p class="text-blue-600 font-semibold text-lg mb-2">NHẬN THÔNG TIN MỚI NHẤT</p>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight mb-6">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Tư vấn miễn phí</span>
                    </h2>
                    <p class="text-gray-600 text-lg">
                        Đăng ký ngay để nhận tư vấn miễn phí từ {{ $doctor->name }} và khám phá các dịch vụ nha khoa hàng đầu.
                    </p>
                </div>
                <div class="lg:w-1/2 w-full bg-white p-8 rounded-2xl shadow-lg">
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Họ và tên</label>
                                <input type="text" id="name" name="name" placeholder="Nhập họ và tên của bạn"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Địa chỉ email</label>
                                <input type="email" id="email" name="email" placeholder="Nhập địa chỉ Email của bạn"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại</label>
                                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                            </div>
                            <div>
                                <label for="issue" class="block text-sm font-semibold text-gray-700 mb-2">Vấn đề bạn cần tư vấn</label>
                                <input type="text" id="issue" name="issue" placeholder="Vấn đề bạn cần từ vấn"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input type="checkbox" id="newsletter" name="newsletter" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="newsletter" class="ml-2 block text-sm text-gray-600">Gửi cho tôi các thông tin cập nhật hàng tháng qua bản tin</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="terms" class="ml-2 block text-sm text-gray-600">Tôi xác nhận đã đọc và đồng ý với Hướng dẫn dành cho khách hàng và Điều khoản sử dụng.</label>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition">
                            Đặt lịch ngay
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
