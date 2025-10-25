<footer class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-lg font-semibold mb-4">🦷 Dentistry Clinic</h3>
                <p class="text-gray-300 mb-4">
                    Providing exceptional dental care with modern technology and compassionate service.
                </p>
                <div class="text-sm text-gray-400">
                    <p>📍 123 Health Street, Medical City</p>
                    <p>📞 (555) 123-4567</p>
                    <p>✉️ info@dentistry.com</p>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white">About Us</a></li>
                    <li><a href="/services" class="text-gray-300 hover:text-white">Services</a></li>
                    <li><a href="/doctors" class="text-gray-300 hover:text-white">Our Doctors</a></li>
                    <li><a href="/contact" class="text-gray-300 hover:text-white">Contact</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Services</h4>
                <ul class="space-y-2">
                    <li><a href="/services/general" class="text-gray-300 hover:text-white">General Dentistry</a></li>
                    <li><a href="/services/cosmetic" class="text-gray-300 hover:text-white">Cosmetic Dentistry</a></li>
                    <li><a href="/services/orthodontics" class="text-gray-300 hover:text-white">Orthodontics</a></li>
                    <li><a href="/services/surgery" class="text-gray-300 hover:text-white">Oral Surgery</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-gray-700">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © {{ date('Y') }} Dentistry Clinic. All rights reserved.
                </p>
                <div class="mt-4 md:mt-0">
                    <a href="/privacy" class="text-gray-400 hover:text-white text-sm mr-6">Privacy Policy</a>
                    <a href="/terms" class="text-gray-400 hover:text-white text-sm">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

