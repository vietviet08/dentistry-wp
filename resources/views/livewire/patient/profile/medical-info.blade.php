<div>
    <x-layouts.app>
        <x-slot name="title">Medical Information</x-slot>

        <div class="py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Medical Information</h1>
                    <p class="text-gray-600 mt-2">Keep your medical history and emergency contacts updated</p>
                </div>

                @if (session()->has('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                <form wire:submit="save" class="bg-white rounded-lg shadow p-8">
                    <!-- Address -->
                    <div class="mb-6">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Home Address</label>
                        <textarea id="address" 
                                  wire:model="address" 
                                  rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('address') border-red-500 @enderror"></textarea>
                        @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Emergency Contact -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Name</label>
                            <input type="text" 
                                   id="emergency_contact_name" 
                                   wire:model="emergency_contact_name" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('emergency_contact_name') border-red-500 @enderror">
                            @error('emergency_contact_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Phone</label>
                            <input type="tel" 
                                   id="emergency_contact_phone" 
                                   wire:model="emergency_contact_phone" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('emergency_contact_phone') border-red-500 @enderror">
                            @error('emergency_contact_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Blood Type -->
                    <div class="mb-6">
                        <label for="blood_type" class="block text-sm font-medium text-gray-700 mb-2">Blood Type</label>
                        <select id="blood_type" 
                                wire:model="blood_type" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('blood_type') border-red-500 @enderror">
                            <option value="">Select blood type</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                        @error('blood_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Allergies -->
                    <div class="mb-6">
                        <label for="allergies" class="block text-sm font-medium text-gray-700 mb-2">Known Allergies</label>
                        <textarea id="allergies" 
                                  wire:model="allergies" 
                                  rows="3"
                                  placeholder="List any known allergies..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('allergies') border-red-500 @enderror"></textarea>
                        @error('allergies') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Medical Conditions -->
                    <div class="mb-6">
                        <label for="medical_conditions" class="block text-sm font-medium text-gray-700 mb-2">Medical Conditions</label>
                        <textarea id="medical_conditions" 
                                  wire:model="medical_conditions" 
                                  rows="3"
                                  placeholder="List any medical conditions..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('medical_conditions') border-red-500 @enderror"></textarea>
                        @error('medical_conditions') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Insurance Information -->
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Insurance Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="insurance_provider" class="block text-sm font-medium text-gray-700 mb-2">Insurance Provider</label>
                                <input type="text" 
                                       id="insurance_provider" 
                                       wire:model="insurance_provider" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('insurance_provider') border-red-500 @enderror">
                                @error('insurance_provider') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="insurance_number" class="block text-sm font-medium text-gray-700 mb-2">Insurance Number</label>
                                <input type="text" 
                                       id="insurance_number" 
                                       wire:model="insurance_number" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('insurance_number') border-red-500 @enderror">
                                @error('insurance_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    
</div>
