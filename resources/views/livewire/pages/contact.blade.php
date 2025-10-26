<?php

use Livewire\Volt\Component;

new class extends Component {
    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">Liên hệ - SmileLux</x-slot>

<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <div class="relative bg-cover bg-center pt-32 pb-24" style="background-image: url('https://source.unsplash.com/random/1440x600/?dentistry,clinic')">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/60 to-blue-600/60"></div>
        <div class="relative max-w-7xl mx-auto px-5">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-4 bg-gradient-to-r from-indigo-900 via-blue-700 to-blue-700 bg-clip-text text-transparent">
                    Liên hệ với chúng tôi
                </h1>
                <div class="flex justify-center mt-8 mb-6">
                    <svg class="w-64 h-1" viewBox="0 0 256 1" fill="none">
                        <path d="M0 0.5L256 0.5" stroke="url(#gradient)" stroke-width="1"/>
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#0071F9" />
                                <stop offset="100%" stop-color="#2E3192" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <p class="text-xl text-gray-300">Vì nụ cười của bạn</p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="max-w-7xl mx-auto px-5 -mt-24 mb-20 relative z-10">
        <div class="grid md:grid-cols-2 gap-10">
            <!-- Left: Contact Info -->
            <div class="bg-blue-600 rounded-2xl p-8 shadow-xl">
                <h2 class="text-white text-2xl font-bold mb-6">
                    Đội ngũ của chúng tôi luôn sẵn sàng giúp bạn và trả lời mọi câu hỏi
                </h2>
                
                <div class="space-y-6">
                    <!-- Location -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="space-y-2">
                            <p class="text-white text-sm">Hà Nội – Cơ sở 1: Tầng 6, 605 Quang Trung, Kiến Hưng, Hà Đông, Hà Nội</p>
                            <p class="text-white text-sm">Hà Nội – Cơ sở 2: 133 Hải Âu 1, KĐT Vinhomes Ocean Park 1, xã Gia Lâm, Hà Nội</p>
                            <p class="text-white text-sm">Đà Nẵng – Cơ sở 3: 106 Tố Hữu, phường Hòa Cường, Đà Nẵng (Pre-opening)</p>
                            <p class="text-white text-sm">TP. HCM – Cơ sở 4: 658/5 Cách Mạng Tháng 8, Phường Nhiêu Lộc, TP. Hồ Chí Minh</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-white flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <p class="text-white">0918 19 69 91</p>
                    </div>

                    <!-- Email -->
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-white flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p class="text-white">smileluxmarketing@gmail.com</p>
                    </div>

                    <!-- Hours -->
                    <div class="flex gap-3">
                        <svg class="w-6 h-6 text-white flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-white">Thứ Hai - Thứ Sáu</p>
                            <p class="text-white">8:00 AM to 20:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Booking Form -->
            <div class="bg-white rounded-2xl p-8 shadow-xl">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Đặt lịch hẹn</h2>
                <p class="text-gray-600 mb-8">Hãy liên hệ với chúng tôi và gửi câu hỏi của bạn</p>

                <form class="space-y-5">
                    <!-- Name -->
                    <div>
                        <label for="name" class="sr-only">Họ và tên</label>
                        <input type="text" id="name" name="name" placeholder="Họ và tên"
                               class="w-full px-6 py-4 rounded-full border border-gray-200 bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="sr-only">Địa chỉ email</label>
                        <input type="email" id="email" name="email" placeholder="Địa chỉ email"
                               class="w-full px-6 py-4 rounded-full border border-gray-200 bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="sr-only">Số điện thoại</label>
                        <input type="tel" id="phone" name="phone" placeholder="Số điện thoại"
                               class="w-full px-6 py-4 rounded-full border border-gray-200 bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Consultation Topic -->
                    <div>
                        <label for="consultation" class="sr-only">Nội dung cần tư vấn</label>
                        <div class="relative">
                            <select id="consultation" name="consultation"
                                    class="w-full px-6 py-4 rounded-full border border-gray-200 bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none">
                                <option value="">Nội dung cần tư vấn</option>
                                <option value="general">Tư vấn tổng quát</option>
                                <option value="cleaning">Vệ sinh răng miệng</option>
                                <option value="whitening">Tẩy trắng răng</option>
                                <option value="braces">Niềng răng</option>
                                <option value="implant">Cấy ghép implant</option>
                            </select>
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Date & Time -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Date -->
                        <div>
                            <label for="date" class="sr-only">Ngày</label>
                            <div class="relative">
                                <input type="date" id="date" name="date" placeholder="Ngày"
                                       class="w-full px-6 py-4 rounded-full border border-gray-200 bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Time -->
                        <div>
                            <label for="time" class="sr-only">Giờ</label>
                            <div class="relative">
                                <input type="time" id="time" name="time" placeholder="Giờ"
                                       class="w-full px-6 py-4 rounded-full border border-gray-200 bg-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-4 rounded-full font-semibold hover:shadow-lg transition">
                        Đặt lịch hẹn Ngay
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Map Section (Optional - can be filled with actual map) -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="bg-gray-200 rounded-2xl h-[400px] flex items-center justify-center">
                <p class="text-gray-500">Bản đồ sẽ được hiển thị tại đây</p>
            </div>
        </div>
    </div>
</div>
