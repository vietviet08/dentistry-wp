<?php

use Livewire\Volt\Component;

new class extends Component {
    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">{{ __('about.title') }}</x-slot>

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
                        {{ __('about.hero.title') }}
                    </span>
                </h1>
                <p class="text-xl md:text-2xl mb-12 text-gray-200 max-w-4xl mx-auto leading-relaxed">
                    {{ __('about.hero.subtitle') }}
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
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ __('about.mission_vision.title') }}</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    {{ __('about.mission_vision.subtitle') }}
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
                    <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('about.mission_vision.mission.title') }}</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('about.mission_vision.mission.description') }}
                    </p>
                </div>
                
                <!-- Vision -->
                <div class="bg-blue-50 rounded-2xl p-8 shadow-lg border border-blue-100">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('about.mission_vision.vision.title') }}</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('about.mission_vision.vision.description') }}
                    </p>
                </div>
                
                <!-- Core Values -->
                <div class="bg-blue-50 rounded-2xl p-8 shadow-lg border border-blue-100">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('about.mission_vision.core_values.title') }}</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('about.mission_vision.core_values.description') }}
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
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ __('about.gallery.title') }}</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    {{ __('about.gallery.subtitle') }}
                </p>
            </div>
            
            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2068" alt="Dental Clinic" class="w-full h-64 object-cover rounded-lg shadow-lg">
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
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ __('about.awards.title') }}</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    {{ __('about.awards.subtitle') }}
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
                    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ __('about.awards.top_dental.title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('about.awards.top_dental.description') }}
                    </p>
                </div>
                
                <!-- Award 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ __('about.awards.excellent_service.title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('about.awards.excellent_service.description') }}
                    </p>
                </div>
                
                <!-- Award 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ __('about.awards.iso.title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('about.awards.iso.description') }}
                    </p>
                </div>
                
                <!-- Award 4 -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ __('about.awards.straumann.title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('about.awards.straumann.description') }}
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
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">{{ __('about.journey.title') }}</span>
                </h2>
                <p class="text-xl text-blue-100 max-w-4xl mx-auto leading-relaxed">
                    {{ __('about.journey.subtitle') }}
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
                                <h3 class="text-3xl font-bold text-gray-800 mb-4">{{ __('about.journey.milestones.2024.title') }}</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('about.journey.milestones.2024.description') }}
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
                                <h3 class="text-3xl font-bold text-gray-800 mb-4">{{ __('about.journey.milestones.2025.title') }}</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('about.journey.milestones.2025.description') }}
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
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">{{ __('about.stats.title') }}</h2>
                    <p class="text-xl text-blue-100 max-w-4xl mx-auto leading-relaxed">
                        {{ __('about.stats.subtitle') }}
                    </p>
                </div>
                
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-5xl font-bold mb-2">100%</div>
                        <div class="text-blue-100">{{ __('about.stats.sterile') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold mb-2">1000+</div>
                        <div class="text-blue-100">{{ __('about.stats.smiles') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold mb-2">50+</div>
                        <div class="text-blue-100">{{ __('about.stats.experts') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold mb-2">98%</div>
                        <div class="text-blue-100">{{ __('about.stats.satisfied') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
