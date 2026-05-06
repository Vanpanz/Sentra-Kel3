<?php
// Pastikan BASEURL aman jika belum didefinisikan sebelumnya
if (!defined('BASEURL')) {
    define('BASEURL', 'http://localhost:3000');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentra - Dashboard</title>
    
    <link rel="stylesheet" href="/css/output.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-[#f4f9f8] text-[#2d3436] antialiased">

    <div class="flex min-h-screen">
        
        <?php 
        $sidebarPath = __DIR__ . '/../component/sidebar.php';
        // Fallback lokasi jika nama foldernya components (pakai 's')
        if (!file_exists($sidebarPath)) $sidebarPath = __DIR__ . '/../components/sidebar.php';
        
        if (file_exists($sidebarPath)) {
            include $sidebarPath;
        } else {
            echo "";
        }
        ?>

        <main class="flex-1 p-8 lg:px-12 overflow-y-auto">
            
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight">
                        👋 Welcome, <?= $_SESSION['user']['name'] ?? 'Admin'; ?>
                    </h1>
                </div>
                <div class="relative w-full md:w-72">
                    <input type="text" placeholder="Search for events..." 
                           class="w-full px-5 py-2.5 rounded-full border border-gray-200 shadow-sm focus:outline-none focus:border-[#64b3a4] focus:ring-1 focus:ring-[#64b3a4] text-sm transition-all">
                </div>
            </header>

            <div class="flex flex-wrap gap-4 mb-10">
                <button class="bg-[#64b3a4] hover:bg-[#4c8c80] text-white px-6 py-2.5 rounded-xl font-bold shadow-[0_4px_15px_rgba(100,179,164,0.3)] transition-all duration-300 transform hover:-translate-y-0.5">
                    + Create Event
                </button>
                <button class="bg-white hover:bg-gray-50 text-[#636e72] px-6 py-2.5 rounded-xl font-bold shadow-sm border border-gray-200 transition-all duration-300">
                    📣 Announcement
                </button>
            </div>

            <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-gray-50 text-center">
                    <p class="text-[#636e72] font-semibold text-sm mb-1">Total Events</p>
                    <h3 class="text-4xl font-extrabold text-[#4c8c80]">10</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-gray-50 text-center">
                    <p class="text-[#636e72] font-semibold text-sm mb-1">Participants</p>
                    <h3 class="text-4xl font-extrabold text-[#4c8c80]">200+</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-gray-50 text-center">
                    <p class="text-[#636e72] font-semibold text-sm mb-1">Upcoming Events</p>
                    <h3 class="text-4xl font-extrabold text-[#4c8c80]">1</h3>
                </div>
            </section>

            <section class="mb-10">
                <div class="mb-4">
                    <h3 class="text-xl font-extrabold">Ongoing Events</h3>
                </div>
                
                <a href="<?= BASEURL; ?>/event/1" class="block group">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.04)] border border-gray-100 transition-all duration-300 group-hover:shadow-[0_15px_35px_rgba(100,179,164,0.15)] group-hover:-translate-y-1">
                        <div class="h-40 bg-gradient-to-r from-[#80c4b7] to-[#64b3a4] flex items-center justify-center p-6">
                            <h2 class="text-white text-3xl font-extrabold tracking-wide drop-shadow-md">Sekolah XYZ - Class Meeting</h2>
                        </div>
                        <div class="p-6">
                            <h4 class="text-xl font-bold text-[#2d3436] mb-1">Class Meeting</h4>
                            <p class="text-[#636e72] text-sm font-medium mb-4">12 - 19 Desember 20XX</p>
                            
                            <div class="flex items-center gap-4">
                                <span class="bg-[#80c4b7]/20 text-[#4c8c80] px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                                    Ongoing
                                </span>
                                <div class="flex gap-4 text-[#636e72] font-semibold text-sm">
                                    <span class="flex items-center gap-1">👥 45/100</span>
                                    <span class="flex items-center gap-1">🏸 20/30</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </section>

            <section class="mb-10">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-extrabold">All Events</h3>
                    <a href="#" class="text-[#64b3a4] font-bold text-sm hover:underline">View All ></a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 bg-[#f4f9f8] rounded-xl flex-shrink-0 flex items-center justify-center text-2xl">⚽</div>
                        <div>
                            <h4 class="font-bold text-[#2d3436]">Futsal Tournament</h4>
                            <p class="text-[11px] text-[#636e72] font-medium mb-1.5">10 Des 20XX</p>
                            <span class="bg-[#80c4b7]/20 text-[#4c8c80] text-[10px] px-2.5 py-1 rounded-md font-bold uppercase">Ongoing</span>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 bg-blue-50 rounded-xl flex-shrink-0 flex items-center justify-center text-2xl">🔬</div>
                        <div>
                            <h4 class="font-bold text-[#2d3436]">Science Fair</h4>
                            <p class="text-[11px] text-[#636e72] font-medium mb-1.5">5-7 Des 20XX</p>
                            <span class="bg-blue-50 text-blue-600 text-[10px] px-2.5 py-1 rounded-md font-bold uppercase">Upcoming</span>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 bg-red-50 rounded-xl flex-shrink-0 flex items-center justify-center text-2xl">🎨</div>
                        <div>
                            <h4 class="font-bold text-[#2d3436]">Art Exhibition</h4>
                            <p class="text-[11px] text-[#636e72] font-medium mb-1.5">2 Des 20XX</p>
                            <span class="bg-red-50 text-red-600 text-[10px] px-2.5 py-1 rounded-md font-bold uppercase">Full</span>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="text-xl font-extrabold mb-4">Quick Insights</h3>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-3">
                    <p class="flex items-center gap-3 text-sm font-medium text-[#2d3436]">
                        <span class="text-lg">🔥</span> Futsal Tournament is almost full
                    </p>
                    <p class="flex items-center gap-3 text-sm font-medium text-[#2d3436]">
                        <span class="text-lg">📅</span> Tomorrow: Wiradana Workshop
                    </p>
                    <p class="flex items-center gap-3 text-sm font-medium text-[#2d3436]">
                        <span class="text-lg">🕒</span> Class Meeting ends in 3 days
                    </p>
                </div>
            </section>

        </main>
    </div>
</body>
</html>