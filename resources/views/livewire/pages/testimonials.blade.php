<?php

use Livewire\Volt\Component;

new class extends Component {
    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">{{ __('testimonials.title') }}</x-slot>

<div class="min-h-screen bg-white">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-5 py-24">
        <!-- Title Section with Decorative Line -->
        <div class="mb-16">
            <div class="flex items-center mb-4">
                <h1 class="text-3xl md:text-4xl font-bold">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ __('testimonials.hero.title') }}</span>
                </h1>
                <svg class="w-24 h-16 ml-4 text-blue-600" viewBox="0 0 100 80" fill="currentColor">
                    <path d="M2 2 L98 78 L2 78 Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-20">
            <!-- Testimonial Card 1 -->
            <div class="bg-blue-50 rounded-2xl overflow-hidden shadow-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <img src="https://source.unsplash.com/random/100x100/?portrait,woman,professional" 
                             alt="Thái Phương" 
                             class="w-12 h-12 rounded-full object-cover">
                    </div>
                    <div class="mb-4">
                        <h3 class="text-sm font-semibold text-gray-800 mb-1">Thái Phương</h3>
                        <p class="text-xs text-gray-600">Kinh doanh</p>
                    </div>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Tôi từng ngại giao tiếp vì răng ố vàng nặng và lệch khớp. Sau khi điều trị tại SmileLux, mọi thứ thay đổi hoàn toàn – răng trắng sáng, nướu khỏe mạnh, và nụ cười trở thành điểm tự tin nhất trên khuôn mặt tôi.
                    </p>
                </div>
            </div>

            <!-- Testimonial Card 2 -->
            <div class="bg-blue-50 rounded-2xl overflow-hidden shadow-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <img src="https://source.unsplash.com/random/100x100/?portrait,woman,happy" 
                             alt="Hồng Minh" 
                             class="w-12 h-12 rounded-full object-cover">
                    </div>
                    <div class="mb-4">
                        <h3 class="text-sm font-semibold text-gray-800 mb-1">Hồng Minh</h3>
                        <p class="text-xs text-gray-600">Kinh doanh</p>
                    </div>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Hơn 20 năm tự ti vì răng bị tetracycline và cười hở lợi, tôi quyết định thay đổi nụ cười của bản thân và chọn SmileLux là nơi đồng hành. Các bác sĩ SmileLux làm việc rất tỉ mỉ, nhẹ nhàng và tận tâm. Bây giờ, tôi cảm thấy quyết định của mình rất chính xác.
                    </p>
                </div>
            </div>

            <!-- Testimonial Card 3 -->
            <div class="bg-blue-50 rounded-2xl overflow-hidden shadow-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <img src="https://source.unsplash.com/random/100x100/?portrait,man,professional" 
                             alt="Đức Quảng" 
                             class="w-12 h-12 rounded-full object-cover">
                    </div>
                    <div class="mb-4">
                        <h3 class="text-sm font-semibold text-gray-800 mb-1">Đức Quảng</h3>
                        <p class="text-xs text-gray-600">Kinh doanh</p>
                    </div>
                    <p class="text-sm text-gray-700 leading-relaxed">
                        Trước đây, răng tôi khấp khểnh và ố vàng nên luôn ngại nở nụ cười. Nhờ SmileLux, tôi có hàm răng đều đẹp tự nhiên và khỏe mạnh hơn nhiều. Cảm ơn đội ngũ bác sĩ đã giúp tôi tìm lại sự tự tin mỗi ngày.
                    </p>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <div class="flex justify-center gap-4 mb-20">
            <button class="w-11 h-11 bg-blue-100 rounded-full flex items-center justify-center hover:bg-blue-200 transition">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="w-11 h-11 bg-blue-100 rounded-full flex items-center justify-center hover:bg-blue-200 transition">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <!-- Hero Section -->
        <div class="text-center mb-20">
            <h2 class="text-5xl md:text-6xl font-bold mb-6">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ __('testimonials.hero.customer_testimonials') }}</span>
            </h2>
            <div class="w-96 h-1 bg-blue-600 mx-auto mb-8"></div>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                {{ __('testimonials.hero.description') }}
            </p>
        </div>
    </div>

    <!-- Booking Form Section -->
    <section class="py-16 bg-blue-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="bg-blue-100 rounded-3xl p-8 md:p-16 flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="lg:w-1/2 text-center lg:text-left">
                    <p class="text-blue-600 font-semibold text-lg mb-2">{{ __('testimonials.booking.subtitle') }}</p>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight mb-6">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ __('testimonials.booking.title') }}</span>
                    </h2>
                    <p class="text-gray-600 text-lg">
                        {{ __('testimonials.booking.description') }}
                    </p>
                </div>
                <div class="lg:w-1/2 w-full bg-white p-8 rounded-2xl shadow-lg">
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('contact.form.name') }}</label>
                                <input type="text" id="name" name="name" placeholder="{{ __('forms.name_placeholder') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('contact.form.email') }}</label>
                                <input type="email" id="email" name="email" placeholder="{{ __('forms.email_placeholder') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('contact.form.phone') }}</label>
                                <input type="tel" id="phone" name="phone" placeholder="{{ __('forms.phone_placeholder') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                            </div>
                            <div>
                                <label for="issue" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('contact.form.issue') }}</label>
                                <input type="text" id="issue" name="issue" placeholder="{{ __('forms.issue_placeholder') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input type="checkbox" id="newsletter" name="newsletter" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="newsletter" class="ml-2 block text-sm text-gray-600">{{ __('contact.newsletter') }}</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="terms" class="ml-2 block text-sm text-gray-600">{{ __('contact.terms_accept') }}</label>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition">
                            {{ __('common.book_now') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
