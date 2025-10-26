<!-- Booking Form Section -->
<section class="py-16 bg-blue-50">
    <div class="max-w-7xl mx-auto px-5">
        <div class="bg-blue-100 rounded-3xl p-8 md:p-16 flex flex-col lg:flex-row items-center justify-between gap-12">
            <div class="lg:w-1/2 text-center lg:text-left">
                <p class="text-blue-600 font-semibold text-lg mb-2">NHẬN THÔNG TIN MỚI NHẤT</p>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Tư vấn miễn phí</span>
                </h2>
                <p class="text-gray-600 text-lg">
                    Đăng ký ngay để nhận tư vấn miễn phí từ đội ngũ chuyên gia của SmileLux và khám phá các dịch vụ nha khoa hàng đầu.
                </p>
            </div>
            <div class="lg:w-1/2 w-full bg-white p-8 rounded-2xl shadow-lg">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Họ và tên</label>
                            <input type="text" id="name" name="name" placeholder="Nhập họ và tên của bạn"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Địa chỉ email</label>
                            <input type="email" id="email" name="email" placeholder="Nhập địa chỉ Email của bạn"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại</label>
                            <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                        </div>
                        <div>
                            <label for="issue" class="block text-sm font-semibold text-gray-700 mb-2">Vấn đề bạn cần tư vấn</label>
                            <input type="text" id="issue" name="issue" placeholder="Vấn đề bạn cần từ vấn"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 text-gray-800">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <input type="checkbox" id="newsletter" name="newsletter" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="newsletter" class="ml-2 block text-sm text-gray-600">Gửi cho tôi các thông tin cập nhật hàng tháng qua bản tin</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="terms" class="ml-2 block text-sm text-gray-600">Tôi xác nhận đã đọc và đồng ý với Hướng dẫn dành cho khách hàng và Điều khoản sử dụng.</label>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition">
                        Đặt lịch ngay
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
