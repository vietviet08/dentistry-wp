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
                ->limit(6)
                ->get(),
            'featuredDoctors' => Doctor::where('is_available', true)
                ->orderBy('order')
                ->limit(4)
                ->get(),
        ];
    }
}; ?>

<x-slot name="title">Welcome to Dentistry Clinic</x-slot>

<div>
    <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        Your Smile, Our Priority
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 text-blue-100">
                        Professional dental care with modern technology and compassionate service
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="/services" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Our Services
                        </a>
                        <a href="/contact" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                            Book Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Services -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Services</h2>
                    <p class="text-lg text-gray-600">Comprehensive dental care for the whole family</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredServices as $service)
                        <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition">
                            <div class="text-4xl mb-4">🦷</div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $service->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ $service->duration }} min</span>
                                <span class="text-lg font-semibold text-blue-600">${{ $service->price }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-8">
                    <a href="/services" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        View All Services
                    </a>
                </div>
            </div>
        </div>

        <!-- Featured Doctors -->
        <div class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Doctors</h2>
                    <p class="text-lg text-gray-600">Experienced professionals dedicated to your oral health</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($featuredDoctors as $doctor)
                        <div class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition">
                            <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <span class="text-2xl">👨‍⚕️</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $doctor->name }}</h3>
                            <p class="text-blue-600 mb-2">{{ $doctor->specialization }}</p>
                            <p class="text-sm text-gray-600">{{ $doctor->experience_years }} years experience</p>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-8">
                    <a href="/doctors" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Meet Our Team
                    </a>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-blue-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold mb-4">Ready to Schedule Your Visit?</h2>
                <p class="text-xl mb-8 text-blue-100">
                    Book your appointment today and take the first step towards a healthier smile
                </p>
                <a href="/contact" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Book Appointment
                </a>
            </div>
        </div>
</div>
