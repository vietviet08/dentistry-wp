<div>
    <!-- Success Message -->
    @if($status)
        <div class="mb-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>{{ $status }}</span>
        </div>
    @endif

    <form wire:submit="sendResetLink" class="space-y-4">
        <!-- Description -->
        <div class="text-sm text-gray-600 mb-4">
            {{ __('auth.forgot_password_desc') }}
        </div>

        <!-- Email -->
        <flux:field>
            <flux:label>{{ __('auth.email_address') }} *</flux:label>
            <flux:input 
                wire:model="email" 
                type="email" 
                :placeholder="__('auth.email_placeholder')" 
                required 
                autofocus
            />
            <flux:error name="email" />
        </flux:field>

        <!-- Submit Button -->
        <flux:button type="submit" class="w-full" variant="primary">
            {{ __('auth.send_reset_link') }}
        </flux:button>

        <!-- Back to Login Link -->
        <div class="text-center text-sm text-gray-600">
            <button 
                type="button"
                wire:click="$parent.setTab('login')"
                class="text-blue-600 hover:underline font-semibold inline-flex items-center gap-1"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                {{ __('auth.back_to_login') }}
            </button>
        </div>
    </form>
</div>

