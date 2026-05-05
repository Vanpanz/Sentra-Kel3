<?php
// 1. Perbaikan path include agar tidak Error Warning
$sidebarPath = __DIR__ . '/../component/sidebar.php';
?>




<div class="flex min-h-screen bg-gray-50">

    <?php if (file_exists($sidebarPath)) include $sidebarPath; ?>

    <main class="flex-1 p-8">
        
        <header class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <link rel="stylesheet" href="/css/output.css">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    👋 Welcome, <?= isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'Admin'; ?>
                </h1>
            </div>
        </header>

        <div class="flex gap-4 mb-8">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                + Create Event
            </button>
            <button class="bg-white border border-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-50 transition">
                📣 Announcement
            </button>
        </div>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                <p class="text-gray-500 text-sm">Total Events</p>
                <h3 class="text-3xl font-bold text-gray-800">10</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                <p class="text-gray-500 text-sm">Participants</p>
                <h3 class="text-3xl font-bold text-gray-800">200+</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center">
                <p class="text-gray-500 text-sm">Upcoming Events</p>
                <h3 class="text-3xl font-bold text-gray-800">1</h3>
            </div>
        </section>

        <section class="mb-10">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Ongoing Events</h3>
            <a href="/event/1" class="group block bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition">
                <div class="h-48 bg-teal-100 flex items-center justify-center group-hover:bg-teal-200 transition">
                    <h2 class="text-2xl font-bold text-teal-800">Sekolah XYZ - Class Meeting</h2>
                </div>
                <div class="p-6">
                    <h4 class="text-lg font-bold">Class Meeting</h4>
                    <p class="text-gray-500">12 - 19 Desember 20XX</p>
                    <div class="mt-4 flex items-center gap-4">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">Ongoing</span>
                        <div class="flex gap-4 text-gray-600 font-semibold text-sm">
                            <span>👥 45/100</span>
                            <span>🏸 20/30</span>
                        </div>
                    </div>
                </div>
            </a>
        </section>

        <section>
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">All Events</h3>
                <a href="#" class="text-blue-600 font-semibold hover:underline text-sm">View All ></a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-16 h-16 bg-gray-200 rounded-lg"></div>
                    <div>
                        <h4 class="font-bold text-gray-800">Futsal Tournament</h4>
                        <p class="text-xs text-gray-500">10 Des 20XX</p>
                        <span class="inline-block mt-1 bg-green-100 text-green-700 text-[10px] px-2 py-0.5 rounded-full uppercase">Ongoing</span>
                    </div>
                </div>
                </div>
        </section>

    </main>
</div>
<!-- Footer -->
        <footer class="absolute bottom-4 left-0 w-full text-center shrink-0">
            <p class="text-emerald-700/40 font-bold text-xs tracking-[0.4em]">SENTRA</p>
        </footer>
    </main>