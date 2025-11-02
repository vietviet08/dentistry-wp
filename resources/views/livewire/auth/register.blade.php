<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <!-- Header Section -->
        <div class="text-center space-y-4">
            <!-- Logo/Icon with modern design -->
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-600 via-blue-600 to-blue-700 rounded-3xl shadow-xl shadow-blue-500/30 mb-3 relative">
                <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent rounded-3xl"></div>
                <svg class="w-10 h-10 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 bg-clip-text text-transparent tracking-tight mb-2">
                    {{ __('auth.create_account') }}
                </h1>
                <p class="text-sm text-gray-600 leading-relaxed max-w-sm mx-auto">
                    {{ __('auth.create_subtitle') }}
                </p>
            </div>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg text-sm">
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <div class="flex-1">
                        <p class="font-semibold mb-1">{{ __('auth.please_correct_errors') }}</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4">
            @csrf
            
            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-semibold text-gray-700">
                    {{ __('auth.full_name') }}
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <flux:input
                        name="name"
                        type="text"
                        required
                        autofocus
                        autocomplete="name"
                        value="{{ old('name') }}"
                        :placeholder="__('auth.name_placeholder')"
                        class="w-full pl-11 pr-4 py-3.5 border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 rounded-xl transition-all text-base placeholder:text-gray-400"
                    />
                </div>
            </div>

            <!-- Email Address -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-semibold text-gray-700">
                    {{ __('auth.email_address') }}
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <flux:input
                        name="email"
                        type="email"
                        required
                        autocomplete="email"
                        value="{{ old('email') }}"
                        :placeholder="__('auth.email_placeholder')"
                        class="w-full pl-11 pr-4 py-3.5 border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 rounded-xl transition-all text-base placeholder:text-gray-400"
                    />
                </div>
            </div>

            <!-- Password Grid -->
            <div class="grid grid-cols-1 gap-4">
                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        {{ __('auth.password') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <flux:input
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            :placeholder="__('auth.password_new')"
                            viewable
                            class="w-full pl-11 pr-12 py-3.5 border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 rounded-xl transition-all text-base placeholder:text-gray-400"
                        />
                    </div>
                    <p class="text-xs text-gray-500 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ __('auth.password_hint') }}
                    </p>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                        {{ __('auth.password_confirm') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <flux:input
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            :placeholder="__('auth.password_confirm_placeholder')"
                            viewable
                            class="w-full pl-11 pr-12 py-3.5 border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 rounded-xl transition-all text-base placeholder:text-gray-400"
                        />
                    </div>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-start gap-3 bg-blue-50/50 p-4 rounded-xl border border-blue-100">
                <flux:checkbox 
                    name="terms" 
                    class="mt-0.5"
                />
                <label for="terms" class="text-sm text-gray-600 leading-relaxed">
                    {{ __('auth.terms_agree') }} 
                    <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-700 font-semibold underline decoration-2 underline-offset-2 transition-colors" wire:navigate>{{ __('auth.terms_of_service') }}</a> 
                    {{ __('auth.and') }} 
                    <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-700 font-semibold underline decoration-2 underline-offset-2 transition-colors" wire:navigate>{{ __('auth.privacy_policy') }}</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="group relative w-full bg-gradient-to-r from-blue-600 via-blue-600 to-indigo-600 hover:from-blue-700 hover:via-blue-700 hover:to-indigo-700 text-white px-6 py-4 rounded-xl font-semibold text-base shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 hover:-translate-y-0.5 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300/50 disabled:opacity-50 disabled:cursor-not-allowed mt-2"
                data-test="register-user-button"
            >
                <span class="relative flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <span>{{ __('auth.create_account_button') }}</span>
                </span>
                <!-- Shine effect -->
                <div class="absolute inset-0 rounded-xl overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                </div>
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-2">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t-2 border-gray-100"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="px-3 bg-white text-gray-400 font-medium uppercase tracking-wider">{{ __('auth.or') }}</span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center space-y-3 pt-2">
            <p class="text-sm text-gray-600">
                {{ __('auth.already_have_account') }}
            </p>
            <a 
                href="{{ route('auth') }}?tab=login" 
                class="group inline-flex items-center justify-center w-full border-2 border-gray-200 hover:border-blue-600 text-gray-700 hover:text-blue-600 bg-white hover:bg-blue-50/50 px-6 py-3.5 rounded-xl font-semibold text-base transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300/30"
                wire:navigate
            >
                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                {{ __('auth.log_in_to_account') }}
            </a>
        </div>
    </div>
</x-layouts.auth>
