<?php

use Livewire\Volt\Component;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $doctors;
    public ?Doctor $featuredDoctor = null;

    public function mount(): void
    {
        // Lấy bác sĩ đầu tiên làm featured doctor
        $this->featuredDoctor = Doctor::where('is_available', true)
                                     ->orderBy('order')
                                     ->orderBy('name')
                                     ->first();
        
        // Lấy tất cả bác sĩ còn lại
        $this->doctors = Doctor::where('is_available', true)
                              ->when($this->featuredDoctor, function($query) {
                                  $query->where('id', '!=', $this->featuredDoctor->id);
                              })
                              ->orderBy('order')
                              ->orderBy('name')
                              ->get();
    }

    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">{{ __('team.title') }}</x-slot>

<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-blue-600 to-blue-800 text-white py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://source.unsplash.com/random/1440x900/?dental-team,professionals" alt="Background" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="max-w-7xl mx-auto px-5 relative z-10">
            <div class="bg-blue-50 rounded-2xl p-8 md:p-12 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ __('team.hero.title') }}</span>
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-blue-800 mx-auto mb-6"></div>
                <p class="text-lg text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    {{ __('team.hero.description') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Featured Doctor Section -->
    @if($featuredDoctor)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-5">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <!-- Doctor Info -->
                    <div class="lg:w-1/3">
                        <h2 class="text-4xl md:text-5xl font-bold mb-6">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ $featuredDoctor->name }}</span>
                        </h2>
                        <p class="text-lg text-gray-600 mb-4 leading-relaxed">
                            {{ $featuredDoctor->specialization }}
                        </p>
                        @if($featuredDoctor->qualification)
                            <p class="text-sm text-gray-500 mb-4">
                                {{ $featuredDoctor->qualification }}
                            </p>
                        @endif
                        @if($featuredDoctor->experience_years)
                            <p class="text-sm text-gray-500 mb-4">
                                {{ $featuredDoctor->experience_years }} {{ __('team.featured.years_experience') }}
                            </p>
                        @endif
                        @if($featuredDoctor->bio)
                            <p class="text-gray-600 mb-8 leading-relaxed">
                                {{ Str::limit($featuredDoctor->bio, 200) }}
                            </p>
                        @endif
                        
                        <!-- Action Button -->
                        <div class="mt-6">
                            <a href="{{ route('doctor-detail', $featuredDoctor->slug) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-semibold rounded-full hover:shadow-lg transition">
                                {{ __('team.featured.view_profile') }}
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        
                        <!-- Social Links -->
                        <div class="flex space-x-4 mt-6">
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
                    
                    <!-- Doctor Image -->
                    <div class="lg:w-2/3">
                        @if($featuredDoctor->photo)
                            <img src="{{ $featuredDoctor->photo }}" 
                                 alt="{{ $featuredDoctor->name }}" 
                                 class="w-full h-auto rounded-2xl shadow-lg">
                        @else
                            <img src="https://source.unsplash.com/random/600x800/?doctor,dentist,professional" 
                                 alt="{{ $featuredDoctor->name }}" 
                                 class="w-full h-auto rounded-2xl shadow-lg">
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Team Grid Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ __('team.experts.title') }}</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    {{ __('team.experts.description') }}
                </p>
            </div>
            
            @if($doctors->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($doctors as $doctor)
                        <a href="{{ route('doctor-detail', $doctor->slug) }}" class="block bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                            <div class="relative">
                                @if($doctor->photo)
                                    <img src="{{ $doctor->photo }}" 
                                         alt="{{ $doctor->name }}" 
                                         class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <img src="https://source.unsplash.com/random/300x400/?dentist,doctor,professional" 
                                         alt="{{ $doctor->name }}" 
                                         class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <h3 class="text-white text-xl font-bold mb-1">{{ $doctor->name }}</h3>
                                    <p class="text-blue-200 text-sm">{{ $doctor->specialization }}</p>
                                    @if($doctor->experience_years)
                                        <p class="text-blue-100 text-xs mt-1">{{ $doctor->experience_years }} {{ __('team.featured.years_experience') }}</p>
                                    @endif
                                </div>
                                <div class="absolute top-4 right-4">
                                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-2 group-hover:bg-white/30 transition">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10">
                    <p class="text-xl text-gray-600">{{ __('team.no_doctors') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Qualifications Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ __('team.qualifications.title') }}</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    {{ __('team.qualifications.description') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Qualification Card 1 -->
                <div class="bg-blue-50 p-6 rounded-2xl shadow-md border border-blue-200 text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('team.qualifications.straumann.title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('team.qualifications.straumann.description') }}
                    </p>
                </div>
                
                <!-- Qualification Card 2 -->
                <div class="bg-blue-50 p-6 rounded-2xl shadow-md border border-blue-200 text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('team.qualifications.iso.title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('team.qualifications.iso.description') }}
                    </p>
                </div>
                
                <!-- Qualification Card 3 -->
                <div class="bg-blue-50 p-6 rounded-2xl shadow-md border border-blue-200 text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8-3.6 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('team.qualifications.international.title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('team.qualifications.international.description') }}
                    </p>
                </div>
                
                <!-- Qualification Card 4 -->
                <div class="bg-blue-50 p-6 rounded-2xl shadow-md border border-blue-200 text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">{{ __('team.qualifications.continuous.title') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('team.qualifications.continuous.description') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="py-16 bg-blue-600">
        <div class="max-w-7xl mx-auto px-5">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl">
                <div class="text-center mb-8">
                    <p class="text-gray-600 text-lg mb-2">{{ __('team.booking.subtitle') }}</p>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ __('team.booking.title') }}</span>
                    </h2>
                </div>
                
                <form class="max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('forms.name_placeholder') }}</label>
                            <input type="text" id="name" name="name" placeholder="{{ __('forms.name_placeholder') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                        
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('contact.form.email') }}</label>
                            <input type="email" id="email" name="email" placeholder="{{ __('forms.email_placeholder') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Phone Field -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('contact.form.phone') }}</label>
                            <input type="tel" id="phone" name="phone" placeholder="{{ __('forms.phone_placeholder') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                        
                        <!-- Issue Field -->
                        <div>
                            <label for="issue" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('contact.form.issue') }}</label>
                            <input type="text" id="issue" name="issue" placeholder="{{ __('forms.issue_placeholder') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        </div>
                    </div>
                    
                    <!-- Checkboxes -->
                    <div class="space-y-4 mb-8">
                        <label class="flex items-start space-x-3">
                            <input type="checkbox" class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-gray-700 text-sm">{{ __('contact.newsletter') }}</span>
                        </label>
                        
                        <label class="flex items-start space-x-3">
                            <input type="checkbox" class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-gray-700 text-sm">{{ __('contact.terms_accept') }}</span>
                        </label>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-12 py-4 rounded-full font-semibold text-lg hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            {{ __('common.book_now') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
