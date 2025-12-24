<div class="relative" x-data="{ open: false }">
    <!-- Language Selector Button -->
    <button @click="open = !open" 
            class="flex items-center space-x-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">
        @if($currentLocale === 'vi')
            <div class="w-6 h-4 relative overflow-hidden rounded-sm">
                <img src="{{ asset('vn.svg') }}" alt="VN" class="w-full h-full object-cover">
            </div>
            <span class="text-sm font-medium">VI</span>
        @else
             <div class="w-6 h-4 relative overflow-hidden rounded-sm">
                <img src="{{ asset('eng.svg') }}" alt="EN" class="w-full h-full object-cover">
            </div>
            <span class="text-sm font-medium">EN</span>
        @endif
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    <!-- Dropdown Menu -->
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
        
        <!-- Vietnamese -->
        <button wire:click="switchLocale('vi')" 
                class="flex items-center space-x-3 px-4 py-2 w-full text-left hover:bg-gray-50 {{ $currentLocale === 'vi' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700' }}">
            <div class="w-6 h-4 relative overflow-hidden rounded-sm">
                <img src="{{ asset('vn.svg') }}" alt="VN" class="w-full h-full object-cover">
            </div>
            <span>Tiếng Việt</span>
            @if($currentLocale === 'vi')
                <svg class="w-4 h-4 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            @endif
        </button>
        
        <!-- English -->
        <button wire:click="switchLocale('en')" 
                class="flex items-center space-x-3 px-4 py-2 w-full text-left hover:bg-gray-50 {{ $currentLocale === 'en' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700' }}">
            <div class="w-6 h-4 relative overflow-hidden rounded-sm">
                <img src="{{ asset('eng.svg') }}" alt="EN" class="w-full h-full object-cover">
            </div>
            <span>English</span>
            @if($currentLocale === 'en')
                <svg class="w-4 h-4 ml-auto" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            @endif
        </button>
    </div>
</div>

