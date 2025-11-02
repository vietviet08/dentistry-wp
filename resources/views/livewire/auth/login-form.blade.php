<div>
    <form wire:submit="login" class="space-y-4">
        <!-- Email -->
        <flux:field>
            <flux:label>{{ __('auth.email_address') }} *</flux:label>
            <flux:input 
                wire:model="email" 
                type="email" 
                :placeholder="__('auth.email_placeholder')" 
                required 
            />
            <flux:error name="email" />
        </flux:field>

        <!-- Password -->
        <flux:field>
            <div class="flex items-center justify-between mb-2">
                <flux:label>{{ __('auth.password') }} *</flux:label>
                <button 
                    type="button"
                    wire:click="$parent.setTab('forgot-password')"
                    class="text-sm text-blue-600 hover:underline font-semibold"
                >
                    {{ __('auth.forgot_password') }}
                </button>
            </div>
            <div class="relative">
                <flux:input 
                    wire:model="password" 
                    type="{{ $showPassword ? 'text' : 'password' }}" 
                    :placeholder="__('auth.password_placeholder')" 
                    required 
                    class="pr-10"
                />
                <button 
                    type="button"
                    wire:click="$toggle('showPassword')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                    @if($showPassword)
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    @else
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    @endif
                </button>
            </div>
            <flux:error name="password" />
        </flux:field>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <flux:checkbox wire:model="remember" :label="__('auth.remember_me')" />
        </div>

        <!-- Submit Button -->
        <flux:button type="submit" class="w-full" variant="primary">
            {{ __('auth.log_in') }}
        </flux:button>

        <!-- Register Link -->
        <div class="text-center text-sm text-gray-600">
            {{ __('auth.dont_have_account') }}
            <button 
                type="button"
                wire:click="$parent.setTab('register')"
                class="text-blue-600 hover:underline font-semibold"
            >
                {{ __('auth.create_new_account') }}
            </button>
        </div>
    </form>
</div>

