<?php

use Livewire\Volt\Component;

new class extends Component {
    public function layout()
    {
        return 'layouts.app';
    }
    // No additional logic needed for static about page
}; ?>

<x-slot name="title">About Us - Dentistry Clinic</x-slot>

<div>
    <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        About Our Clinic
                    </h1>
                    <p class="text-xl md:text-2xl text-blue-100">
                        Committed to providing exceptional dental care for over 20 years
                    </p>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                        <p class="text-lg text-gray-600 mb-4">
                            To provide comprehensive, high-quality dental care in a comfortable and welcoming environment. 
                            We are committed to helping our patients achieve and maintain optimal oral health through 
                            personalized treatment plans and state-of-the-art technology.
                        </p>
                        <p class="text-lg text-gray-600">
                            Our team of experienced professionals is dedicated to making every visit a positive experience, 
                            ensuring that our patients feel confident and comfortable throughout their dental journey.
                        </p>
                    </div>
                    
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Vision</h2>
                        <p class="text-lg text-gray-600 mb-4">
                            To be the leading dental practice in our community, recognized for excellence in patient care, 
                            innovative treatments, and commitment to continuing education. We strive to create lasting 
                            relationships with our patients built on trust, respect, and exceptional service.
                        </p>
                        <p class="text-lg text-gray-600">
                            We envision a future where every patient leaves our clinic with a healthy, beautiful smile 
                            and the confidence that comes with knowing they've received the best possible dental care.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Values</h2>
                    <p class="text-lg text-gray-600">The principles that guide everything we do</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <span class="text-2xl">💙</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Compassion</h3>
                        <p class="text-gray-600">
                            We treat every patient with empathy, understanding, and genuine care for their well-being.
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <span class="text-2xl">⭐</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Excellence</h3>
                        <p class="text-gray-600">
                            We maintain the highest standards of clinical care and continuously improve our skills and techniques.
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <span class="text-2xl">🤝</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Integrity</h3>
                        <p class="text-gray-600">
                            We conduct ourselves with honesty, transparency, and ethical practices in all our interactions.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technology -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Advanced Technology</h2>
                    <p class="text-lg text-gray-600">We invest in the latest dental technology to provide the best care</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl mb-4">🔬</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Digital X-Rays</h3>
                        <p class="text-gray-600 text-sm">Reduced radiation exposure and instant results</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-4xl mb-4">🦷</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">CAD/CAM Technology</h3>
                        <p class="text-gray-600 text-sm">Same-day crowns and restorations</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-4xl mb-4">💡</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Laser Dentistry</h3>
                        <p class="text-gray-600 text-sm">Minimally invasive procedures</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-4xl mb-4">📱</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">3D Imaging</h3>
                        <p class="text-gray-600 text-sm">Precise treatment planning</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-blue-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold mb-4">Experience the Difference</h2>
                <p class="text-xl mb-8 text-blue-100">
                    Schedule your consultation today and discover why our patients choose us for their dental care
                </p>
                <a href="/contact" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Schedule Consultation
                </a>
            </div>
        </div>
</div>
