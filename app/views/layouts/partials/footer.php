<footer class="bg-gray-900 text-gray-300 mt-12">
    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-white font-bold text-lg mb-4">SENTRA</h3>
                <p class="text-sm text-gray-400">
                    Sistem manajemen event dan kegiatan sekolah yang terpusat untuk memudahkan pendaftaran dan pencatatan partisipasi siswa.
                </p>
            </div>

            <!-- Links -->
            <div>
                <h3 class="text-white font-bold text-lg mb-4">Menu</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="hover:text-white transition">Home</a></li>
                    <li><a href="/about" class="hover:text-white transition">Tentang Kami</a></li>
                    <?php if (!isset($_SESSION['user'])): ?>
                        <li><a href="/login" class="hover:text-white transition">Login</a></li>
                        <li><a href="/register" class="hover:text-white transition">Daftar</a></li>
                    <?php else: ?>
                        <li><a href="/profile" class="hover:text-white transition">Profil Saya</a></li>
                        <li><a href="/logout" class="hover:text-white transition">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-white font-bold text-lg mb-4">Kontak</h3>
                <ul class="space-y-2 text-sm">
                    <li>📧 info@sekolah.com</li>
                    <li>📞 (021) 1234-5678</li>
                    <li>📍 Jl. Pendidikan No. 123, Jakarta</li>
                </ul>
            </div>
        </div>

        <hr class="border-gray-700 my-8">

        <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
            <p>&copy; <?= date('Y') ?> SENTRA - Event Management System. All rights reserved.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition">Privacy Policy</a>
                <a href="#" class="hover:text-white transition">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
