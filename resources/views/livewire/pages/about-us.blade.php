<?php

use Livewire\Volt\Component;

new class extends Component {
    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">Về chúng tôi - SmileLux</x-slot>

<div class="min-h-screen">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white py-20">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="max-w-7xl mx-auto px-5 relative z-10">
            <div class="text-center">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full"></div>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">
                        Về chúng tôi
                    </span>
                </h1>
                <p class="text-xl md:text-2xl mb-12 text-gray-200 max-w-4xl mx-auto leading-relaxed">
                    Tại SmileLux, chúng tôi tin rằng mỗi nụ cười đều mang một câu chuyện riêng. Với đội ngũ bác sĩ tận tâm và công nghệ hiện đại, SmileLux mang đến giải pháp nha khoa an toàn, thẩm mỹ và hiệu quả.
                </p>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Sứ mệnh và Tầm nhìn của chúng tôi</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    SmileLux mong mọi khách hàng, dù ở bất kỳ đâu, đều có cơ hội tiếp cận dịch vụ nha khoa chất lượng, an toàn và tận tâm.
                </p>
            </div>
            
            <!-- Mission & Vision Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Mission -->
                <div class="bg-blue-50 rounded-2xl p-8 shadow-lg border border-blue-100">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Sứ mệnh SmileLux</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Mang đến giải pháp nha khoa chuẩn y khoa, an toàn và tận tâm – kiến tạo nụ cười khỏe đẹp, bền vững cho mỗi khách hàng.
                    </p>
                </div>
                
                <!-- Vision -->
                <div class="bg-blue-50 rounded-2xl p-8 shadow-lg border border-blue-100">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Tầm nhìn SmileLux</h3>
                    <p class="text-gray-600 leading-relaxed">
                        SmileLux tiên phong số hóa hành trình nha khoa để mọi khách hàng đều có thể sở hữu nụ cười rạng ngời
                    </p>
                </div>
                
                <!-- Core Values -->
                <div class="bg-blue-50 rounded-2xl p-8 shadow-lg border border-blue-100">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Giá trị cốt lõi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Khách hàng là trung tâm – Dịch vụ tận tâm – Đổi mới liên tục – Bản sắc Việt, chuẩn quốc tế.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Bộ sưu tập</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Mỗi chi nhánh SmileLux đều được xây dựng theo chuẩn quốc tế, chuẩn y khoa, mang lại cảm giác an tâm tuyệt đối cho khách hàng.
                </p>
            </div>
            
            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <img src="https://images.unsplash.com/photo-1606811841689-23dfddceeee3?w=400&h=300&fit=crop" alt="Dental Clinic" class="w-full h-64 object-cover rounded-lg shadow-lg">
                </div>
                <div class="md:col-span-2">
                    <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&h=300&fit=crop" alt="Modern Dental Equipment" class="w-full h-64 object-cover rounded-lg shadow-lg">
                </div>
                <div class="md:col-span-2">
                    <img src="https://images.unsplash.com/photo-1551601651-2a8555f1a136?w=800&h=300&fit=crop" alt="Dental Treatment Room" class="w-full h-64 object-cover rounded-lg shadow-lg">
                </div>
                <div class="md:col-span-1">
                    <img src="https://images.unsplash.com/photo-1609840114035-3c981b782dfe?w=400&h=300&fit=crop" alt="Dental Consultation" class="w-full h-64 object-cover rounded-lg shadow-lg">
                </div>
                <div class="md:col-span-1">
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=300&fit=crop" alt="Dental Technology" class="w-full h-64 object-cover rounded-lg shadow-lg">
                </div>
                <div class="md:col-span-2">
                    <img src="https://images.unsplash.com/photo-1606811971618-4486d14f3f99?w=800&h=300&fit=crop" alt="Dental Care" class="w-full h-64 object-cover rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Awards & Achievements Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Giải thưởng & Thành tựu</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Những thành tựu là minh chứng cho sự uy tín và chất lượng tại SmileLux
                </p>
            </div>
            
            <!-- Awards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Award 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Nha khoa uy tín hàng đầu Việt Nam</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Được vinh danh bởi các tổ chức y tế uy tín, tiên phong trong implant, chỉnh nha và thẩm mỹ răng sứ chuẩn y khoa.
                    </p>
                </div>
                
                <!-- Award 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Dịch vụ chăm sóc khách hàng xuất sắc</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Khẳng định quy trình chăm sóc tận tâm, theo dõi sát sau điều trị, mang lại sự hài lòng tuyệt đối cho khách hàng.
                    </p>
                </div>
                
                <!-- Award 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Chứng nhận ISO 9001:2015</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Áp dụng hệ thống quản lý chất lượng quốc tế, đảm bảo mọi quy trình điều trị đạt chuẩn an toàn và hiệu quả cao nhất.
                    </p>
                </div>
                
                <!-- Award 4 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Chứng nhận Straumann (Thụy Sĩ)</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Đội ngũ bác sĩ được đào tạo và cấp chứng chỉ bởi Straumann, bảo chứng cho kỹ thuật implant chính xác và an toàn.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Journey Section -->
    <section class="py-20 bg-gradient-to-br from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-16">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full"></div>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">Hành trình của chúng tôi</span>
                </h2>
                <p class="text-xl text-blue-100 max-w-4xl mx-auto leading-relaxed">
                    SmileLux được thành lập với sứ mệnh đồng hành cùng người Việt trên hành trình chăm sóc sức khỏe răng miệng toàn diện. Từng bước phát triển, từng chi nhánh ra đời đều là nỗ lực không ngừng để kiến tạo nụ cười rạng ngời và cuộc đời an vui cho hàng ngàn khách hàng.
                </p>
            </div>
            
            <!-- Timeline -->
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-white/20 rounded-full"></div>
                
                <!-- Timeline Items -->
                <div class="space-y-16">
                    <!-- 2024 -->
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-white rounded-2xl p-8 shadow-xl">
                                <div class="text-blue-600 text-6xl font-light mb-4">2024</div>
                                <h3 class="text-3xl font-bold text-gray-800 mb-4">Thành lập & đặt nền tảng</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Đây là cột mốc đầu tiên đánh dấu sứ mệnh "Kiến tạo nụ cười hạnh phúc"–nơi nụ cười không chỉ đẹp mà còn khỏe mạnh và bền vững.
                                </p>
                            </div>
                        </div>
                        <div class="w-8 h-8 bg-white rounded-full border-4 border-blue-600 flex items-center justify-center z-10">
                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="w-1/2 pl-8"></div>
                    </div>
                    
                    <!-- 2025 -->
                    <div class="flex items-center">
                        <div class="w-1/2 pr-8"></div>
                        <div class="w-8 h-8 bg-white rounded-full border-4 border-blue-600 flex items-center justify-center z-10">
                            <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-white rounded-2xl p-8 shadow-xl">
                                <div class="text-blue-600 text-6xl font-light mb-4">2025</div>
                                <h3 class="text-3xl font-bold text-gray-800 mb-4">Mở rộng & Khẳng định</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Hệ thống SmileLux mở rộng tại TP.HCM và Đà Nẵng, đầu tư công nghệ Scan 3D, chuẩn vô trùng quốc tế và đội ngũ chuyên khoa hàng đầu. Cùng năm, SmileLux vinh dự nhận giải thưởng "Nha khoa uy tín hàng đầu Việt Nam", khẳng định vị thế tiên phong trong lĩnh vực nha khoa thẩm mỹ.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-blue-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl p-12 text-white">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">Về chúng tôi</h2>
                    <p class="text-xl text-blue-100 max-w-4xl mx-auto leading-relaxed">
                        Chúng tôi hướng đến việc không chỉ chăm sóc răng miệng, mà còn lan tỏa sự tự tin và niềm vui đến từng khách hàng, đồng hành cùng bạn trên hành trình kiến tạo nụ cười rạng rỡ.
                    </p>
                </div>
                
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-5xl font-bold mb-2">100%</div>
                        <div class="text-blue-100">Vô trùng chuẩn y khoa</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold mb-2">1000+</div>
                        <div class="text-blue-100">Nụ cười được kiến tạo</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold mb-2">50+</div>
                        <div class="text-blue-100">Chuyên gia và nhân sự y tế</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold mb-2">98%</div>
                        <div class="text-blue-100">Khách hàng hài lòng</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
