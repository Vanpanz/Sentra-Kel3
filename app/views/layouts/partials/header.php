<header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo & Branding -->
            <div class="flex items-center space-x-2">
                <a href="/" class="font-bold text-2xl hover:text-blue-200 transition">
                    📚 SENTRA
                </a>
                <span class="text-sm text-blue-200">Event Management System</span>
            </div>

            <!-- Navigation & User Menu -->
            <div class="flex items-center space-x-4">
                <?php if (isset($_SESSION['user'])): ?>
                    <nav class="hidden md:flex space-x-4">
                        <a href="/" class="hover:text-blue-200 transition">Home</a>
                        <a href="/about" class="hover:text-blue-200 transition">Tentang</a>
                    </nav>

                    <div class="flex items-center space-x-3">
                        <span class="text-sm">👤 <?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                        
                        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                            <a href="/event/create" class="bg-green-500 hover:bg-green-600 px-3 py-1 rounded text-sm transition">
                                + Event
                            </a>
                        <?php endif; ?>

                        <div class="dropdown">
                            <button class="bg-blue-700 hover:bg-blue-900 px-3 py-1 rounded text-sm transition">
                                ⚙️
                            </button>
                            <div class="dropdown-content">
                                <a href="/profile" class="block px-4 py-2 hover:bg-gray-200">Profil</a>
                                <a href="/logout" class="block px-4 py-2 hover:bg-gray-200">Logout</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <nav class="flex space-x-3">
                        <a href="/login" class="bg-white text-blue-600 hover:bg-blue-100 px-4 py-2 rounded transition font-semibold">
                            Login
                        </a>
                        <a href="/register" class="border border-white hover:bg-blue-700 px-4 py-2 rounded transition">
                            Daftar
                        </a>
                    </nav>
                <?php endif; ?>

                <!-- Mobile Menu Toggle -->
                <button class="md:hidden text-white hover:text-blue-200" onclick="toggleMobileMenu()">
                    ☰
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <nav id="mobileMenu" class="md:hidden hidden mt-4 space-y-2">
            <a href="/" class="block py-2 hover:text-blue-200">Home</a>
            <a href="/about" class="block py-2 hover:text-blue-200">Tentang</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/profile" class="block py-2 hover:text-blue-200">Profil</a>
                <a href="/logout" class="block py-2 hover:text-blue-200">Logout</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<style>
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    color: #333;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 4px;
    top: 100%;
    right: 0;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-content a {
    color: #333;
    text-decoration: none;
    display: block;
    padding: 12px 16px;
}

.dropdown-content a:first-child {
    border-radius: 4px 4px 0 0;
}

.dropdown-content a:last-child {
    border-radius: 0 0 4px 4px;
}
</style>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}
</script>
