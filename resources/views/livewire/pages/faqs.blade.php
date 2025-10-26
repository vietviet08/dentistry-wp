<?php

use Livewire\Volt\Component;

new class extends Component {
    public $selectedCategory = 'Dịch vụ';
    public $openIndex = 1;

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
        $this->openIndex = 1; // Reset to first item when category changes
    }

    public function toggle($index)
    {
        $this->openIndex = $this->openIndex === $index ? null : $index;
    }

    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">Câu hỏi thường gặp - SmileLux</x-slot>

<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <div class="relative h-[715px] bg-cover bg-center" style="background-image: url('https://source.unsplash.com/random/1440x715/?dentistry,clinic')">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/60 to-blue-600/60"></div>
        <div class="relative max-w-7xl mx-auto px-5 h-full flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-4 bg-gradient-to-r from-indigo-900 via-blue-700 to-blue-700 bg-clip-text text-transparent">
                    Mọi câu trả lời cho<br>nụ cười tự tin của bạn
                </h1>
                <div class="flex justify-center mt-8">
                    <svg class="w-96 h-1" viewBox="0 0 400 1" fill="none">
                        <path d="M0 0.5L400 0.5" stroke="url(#gradient)" stroke-width="1"/>
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#0071F9" />
                                <stop offset="100%" stop-color="#2E3192" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Cards -->
    <div class="max-w-7xl mx-auto px-5 -mt-32 mb-16">
        <div class="flex justify-center gap-6 flex-wrap">
            <!-- Category Card: Dịch vụ -->
            <div wire:click="selectCategory('Dịch vụ')" class="w-full md:w-[397px] bg-blue-50 rounded-2xl p-9 shadow-lg cursor-pointer hover:shadow-xl transition {{ $selectedCategory === 'Dịch vụ' ? 'ring-4 ring-blue-200' : '' }}">
                <div class="flex items-start gap-6">
                    <div class="bg-white rounded-lg p-3 shadow-md">
                        <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-medium text-gray-900 mb-2">Dịch vụ</h3>
                        <p class="text-base text-gray-600">Hỏi chúng tôi về dịch vụ</p>
                    </div>
                </div>
            </div>

            <!-- Category Card: Thanh toán -->
            <div wire:click="selectCategory('Thanh toán')" class="w-full md:w-[397px] bg-white rounded-2xl p-9 shadow-lg cursor-pointer hover:shadow-xl transition {{ $selectedCategory === 'Thanh toán' ? 'ring-4 ring-blue-200' : '' }}">
                <div class="flex items-start gap-6">
                    <div class="bg-white rounded-lg p-3 shadow-md">
                        <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-medium text-gray-900 mb-2">Thanh toán</h3>
                        <p class="text-base text-gray-600">Hỏi chúng tôi về thanh toán</p>
                    </div>
                </div>
            </div>

            <!-- Category Card: Bảo hành -->
            <div wire:click="selectCategory('Bảo hành')" class="w-full md:w-[397px] bg-white rounded-2xl p-9 shadow-lg cursor-pointer hover:shadow-xl transition {{ $selectedCategory === 'Bảo hành' ? 'ring-4 ring-blue-200' : '' }}">
                <div class="flex items-start gap-6">
                    <div class="bg-white rounded-lg p-3 shadow-md">
                        <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-medium text-gray-900 mb-2">Bảo hành</h3>
                        <p class="text-base text-gray-600">Hỏi chúng tôi về bảo hành</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="max-w-4xl mx-auto px-5 mb-12">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-indigo-900 via-blue-700 to-blue-700 bg-clip-text text-transparent mb-4">
                Câu hỏi thường gặp
            </h2>
            <div class="flex justify-center">
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
        </div>

        <!-- FAQ Accordion -->
        <div class="space-y-0 border-t border-gray-200">
            <!-- FAQ Item 1 -->
            <div class="border-b border-gray-200">
                <div wire:click="toggle(1)" class="flex justify-between items-center py-6 cursor-pointer hover:bg-gray-50 transition">
                    <h3 class="text-xl font-medium text-gray-900 pr-4">
                        SmileLux có dịch vụ tư vấn miễn phí không?
                    </h3>
                    <div class="flex-shrink-0">
                        @if($openIndex === 1)
                            <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @else
                            <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        @endif
                    </div>
                </div>
            </div>

            <!-- FAQ Item 2 (Open by default) -->
            <div class="border-b border-gray-200">
                <div wire:click="toggle(2)" class="flex justify-between items-center py-6 cursor-pointer hover:bg-gray-50 transition {{ $openIndex === 2 ? 'bg-gray-50' : '' }}">
                    <h3 class="text-xl font-medium text-gray-900 pr-4">
                        Quy trình dán sứ/niềng răng/implant tại SmileLux gồm những bước nào?
                    </h3>
                    <div class="flex-shrink-0">
                        @if($openIndex === 2)
                            <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @else
                            <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        @endif
                    </div>
                </div>
                @if($openIndex === 2)
                    <div class="pb-6 pl-0">
                        <p class="text-base text-gray-700 leading-relaxed">
                            Mọi dịch vụ tại SmileLux đều tuân theo 4 bước tiêu chuẩn y khoa:<br><br>
                            1. Tư vấn & khám tổng quát<br>
                            2. Scan 3D chẩn đoán – lập phác đồ điều trị<br>
                            3. Thực hiện điều trị chính (dán sứ, niềng, implant...)<br>
                            4. Chăm sóc & bảo hành sau điều trị.<br><br>
                            Quy trình được cá nhân hóa theo từng khách hàng để đạt kết quả tối ưu.
                        </p>
                    </div>
                @endif
            </div>

            <!-- FAQ Item 3 -->
            <div class="border-b border-gray-200">
                <div wire:click="toggle(3)" class="flex justify-between items-center py-6 cursor-pointer hover:bg-gray-50 transition">
                    <h3 class="text-xl font-medium text-gray-900 pr-4">
                        Thời gian điều trị trung bình là bao lâu?
                    </h3>
                    <div class="flex-shrink-0">
                        @if($openIndex === 3)
                            <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @else
                            <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        @endif
                    </div>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="border-b border-gray-200">
                <div wire:click="toggle(4)" class="flex justify-between items-center py-6 cursor-pointer hover:bg-gray-50 transition">
                    <h3 class="text-xl font-medium text-gray-900 pr-4">
                        Sau khi điều trị có được tái khám miễn phí không?
                    </h3>
                    <div class="flex-shrink-0">
                        @if($openIndex === 4)
                            <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @else
                            <svg class="w-9 h-9 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Form Section -->
    @include('layouts.partials.booking-form')
</div>
