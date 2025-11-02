<?php

use Livewire\Volt\Component;

new class extends Component {
    public string $activeTab = 'login';
    
    public function mount(): void
    {
        // Check for tab query parameter
        $tab = request()->query('tab');
        if ($tab && in_array($tab, ['login', 'register', 'forgot-password'])) {
            $this->activeTab = $tab;
        }
    }
    
    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }
}; ?>

<div class="min-h-screen relative overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img 
            src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=1920&h=1080&fit=crop&q=80" 
            alt="Modern Dental Clinic" 
            class="w-full h-full object-cover"
        />
        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-blue-800/85 to-cyan-900/90"></div>
        
        <!-- Pattern Overlay -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative min-h-screen flex items-center justify-end px-4 py-12">
        <div class="w-full max-w-6xl mx-auto grid lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left side - Branding & Info -->
            <div class="lg:col-span-5 space-y-8 order-2 lg:order-1 text-white">
                <!-- Brand Header -->
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30">
                            <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white drop-shadow-lg">{{ __('auth.brand_name') }}</h1>
                            <p class="text-blue-100">{{ __('auth.brand_tagline') }}</p>
                        </div>
                    </div>
                    
                    <p class="text-white/90 text-lg leading-relaxed">
                        {{ __('auth.welcome_message') }}
                    </p>
                </div>

                <!-- Feature Cards -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Secure -->
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white">{{ __('auth.features.secure') }}</h3>
                                <p class="text-sm text-blue-100">{{ __('auth.features.secure_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Convenient -->
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white">{{ __('auth.features.convenient') }}</h3>
                                <p class="text-sm text-blue-100">{{ __('auth.features.convenient_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quality -->
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white">{{ __('auth.features.quality') }}</h3>
                                <p class="text-sm text-blue-100">{{ __('auth.features.quality_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Professional -->
                    <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 hover:bg-white/20 transition-all">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white">{{ __('auth.features.professional') }}</h3>
                                <p class="text-sm text-blue-100">{{ __('auth.features.professional_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Auth Forms (Offset to Right) -->
            <div class="lg:col-span-6 lg:col-start-7 order-1 lg:order-2">
                <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 backdrop-blur-sm">
                    <!-- Card Header -->
                    <div class="pb-6 space-y-2">
                        <h2 class="text-2xl font-bold text-center text-gray-900">{{ __('auth.welcome_title') }}</h2>
                        <p class="text-center text-gray-600">{{ __('auth.welcome_desc') }}</p>
                    </div>

                    <!-- Tabs -->
                    <div class="space-y-6">
                        <!-- Tab Buttons (Hidden for forgot password) -->
                        @if($activeTab !== 'forgot-password')
                            <div class="grid grid-cols-2 gap-2 p-1 bg-gray-100 rounded-lg">
                                <button 
                                    wire:click="setTab('login')"
                                    class="py-2.5 px-4 rounded-md font-semibold transition-all duration-200 @if($activeTab === 'login') bg-white text-blue-600 shadow-sm @else text-gray-600 hover:text-gray-900 @endif"
                                >
                                    {{ __('auth.tab_login') }}
                                </button>
                                <button 
                                    wire:click="setTab('register')"
                                    class="py-2.5 px-4 rounded-md font-semibold transition-all duration-200 @if($activeTab === 'register') bg-white text-blue-600 shadow-sm @else text-gray-600 hover:text-gray-900 @endif"
                                >
                                    {{ __('auth.tab_register') }}
                                </button>
                            </div>
                        @else
                            <!-- Forgot Password Header -->
                            <div class="text-center space-y-2">
                                <h3 class="text-xl font-bold text-gray-900">{{ __('auth.forgot_password_title') }}</h3>
                            </div>
                        @endif

                        <!-- Tab Content -->
                        <div class="space-y-4">
                            @if($activeTab === 'login')
                                <!-- Login Form -->
                                <livewire:auth.login-form />
                            @elseif($activeTab === 'register')
                                <!-- Register Form -->
                                <livewire:auth.register-form />
                            @elseif($activeTab === 'forgot-password')
                                <!-- Forgot Password Form -->
                                <livewire:auth.forgot-password-form />
                            @endif
                        </div>

                        <!-- Terms Footer -->
                        <div class="pt-6 border-t border-gray-200">
                            <p class="text-xs text-center text-gray-500">
                                {{ __('auth.terms_footer') }}
                                <a href="{{ route('contact') }}" class="text-blue-600 hover:underline" wire:navigate>
                                    {{ __('auth.terms_service') }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

