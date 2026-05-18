<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userName = $_SESSION['user']['name'] ?? 'Student';

// Koneksi ke database
require_once __DIR__ . '/../../config/db-connection.php';

// 1. Ambil 1 Event Terbaru untuk Banner Ongoing
$ongoingQuery = mysqli_query($connection, "SELECT * FROM posts ORDER BY id DESC LIMIT 1");
$ongoingEvent = mysqli_fetch_assoc($ongoingQuery);

// 2. Ambil Maksimal 6 Event untuk Section All Events
$allEventsQuery = mysqli_query($connection, "SELECT * FROM posts ORDER BY id DESC LIMIT 6");

// 3. Hitung Total Event
$totalEventsQuery = mysqli_query($connection, "SELECT COUNT(*) as total FROM posts");
$totalEventsData = mysqli_fetch_assoc($totalEventsQuery);
$totalEvents = $totalEventsData['total'] ?? 0;

// 💡 FUNGSI PHP UNTUK MEMOTONG TEKS DESKRIPSI BERDASARKAN JUMLAH KATA
function potongTeks($teks, $batasanKata = 10) {
    $kata = explode(' ', $teks);
    if (count($kata) > $batasanKata) {
        return implode(' ', array_slice($kata, 0, $batasanKata)) . '...';
    }
    return $teks;
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

    <form id="redirect-form" method="POST" action="/detail" class="hidden">
        <input type="hidden" name="id" id="target-id">
    </form>

    <div class="flex min-h-screen">

        <?php
        if (isset($sidebarPath) && file_exists($sidebarPath)) {
            include $sidebarPath;
        } 
        ?>

        <main class="flex-1 p-8 lg:px-12 overflow-y-auto">

            <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-extrabold tracking-tight">
                        👋 Welcome, <?= htmlspecialchars($userName); ?>
                    </h1>
                </div>
                <div class="relative w-full md:w-72">
                    <input type="text" placeholder="Search for events..."
                        class="w-full px-5 py-2.5 rounded-full border border-gray-200 shadow-sm focus:outline-none focus:border-[#64b3a4] focus:ring-1 focus:ring-[#64b3a4] text-sm transition-all">
                </div>
            </header>

            <div class="flex flex-wrap gap-4 mb-10">
                <a href="/create"
                     class="bg-[#64b3a4] hover:bg-[#4c8c80] text-white px-6 py-2.5 rounded-xl font-bold shadow-[0_4px_15px_rgba(100,179,164,0.3)] transition-all duration-300 transform hover:-translate-y-0.5 inline-block">
                 + Create Event
                </a>
                <button class="bg-white hover:bg-gray-50 text-[#636e72] px-6 py-2.5 rounded-xl font-bold shadow-sm border border-gray-200 transition-all duration-300">
                    📣 Announcement
                </button>
            </div>

            <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-gray-50 text-center">
                    <p class="text-[#636e72] font-semibold text-sm mb-1">Total Events</p>
                    <h3 class="text-4xl font-extrabold text-[#4c8c80]"><?= $totalEvents; ?></h3>
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

                <?php if ($ongoingEvent): ?>
                    <div onclick="goToDetail(<?= $ongoingEvent['id']; ?>)" class="block group cursor-pointer">
                        <div class="bg-white rounded-3xl overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.04)] border border-gray-100 transition-all duration-300 group-hover:shadow-[0_15px_35px_rgba(100,179,164,0.15)] group-hover:-translate-y-1">
                            
                            <div class="w-full aspect-[3/1] md:aspect-[21/9] lg:h-64 overflow-hidden bg-gray-100 relative">
                                <?php if (!empty($ongoingEvent['image_path'])): ?>
                                    <img src="/<?= htmlspecialchars($ongoingEvent['image_path']); ?>" alt="Banner Event" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <?php else: ?>
                                    <div class="w-full h-full bg-gradient-to-r from-[#80c4b7] to-[#64b3a4]"></div>
                                <?php endif; ?>
                            </div>

                            <div class="p-6">
                                <h2 class="text-[#2d3436] text-xl md:text-2xl font-extrabold tracking-wide mb-2 group-hover:text-[#64b3a4] transition-colors">
                                    <?= htmlspecialchars($ongoingEvent['title']); ?>
                                </h2>

                                <p class="text-[#636e72] text-sm font-medium mb-4">
                                    <?= htmlspecialchars(potongTeks($ongoingEvent['content'], 12)); ?>
                                </p>

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
                    </div>
                <?php else: ?>
                    <div class="bg-white p-10 rounded-3xl border border-dashed border-gray-200 text-center text-[#636e72]">
                        <p class="font-medium">Belum ada event terdaftar. Klik tombol '+ Create Event' untuk menambahkan.</p>
                    </div>
                <?php endif; ?>
            </section>

            <section class="mb-10">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-extrabold">All Events</h3>
                    <a href="#" class="text-[#64b3a4] font-bold text-sm hover:underline">View All ></a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php if (mysqli_num_rows($allEventsQuery) > 0): ?>
                        <?php while ($event = mysqli_fetch_assoc($allEventsQuery)): ?>
                            <div onclick="goToDetail(<?= $event['id']; ?>)" class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition-all duration-300 group cursor-pointer">
                                
                                <div class="h-44 w-full overflow-hidden bg-gray-100">
                                    <?php if (!empty($event['image_path'])): ?>
                                        <img src="/<?= htmlspecialchars($event['image_path']); ?>" alt="Event Cover" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-br from-[#80c4b7] to-[#64b3a4]"></div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-bold text-lg text-[#2d3436] truncate group-hover:text-[#64b3a4] transition-colors mb-1">
                                            <?= htmlspecialchars($event['title']); ?>
                                        </h4>
                                        <p class="text-xs text-[#636e72] font-medium mb-3">
                                            <?= htmlspecialchars(potongTeks($event['content'], 8)); ?>
                                        </p>
                                    </div>
                                    <div>
                                        <span class="bg-[#80c4b7]/20 text-[#4c8c80] text-[10px] px-2.5 py-1 rounded-md font-bold uppercase tracking-wider inline-block">
                                            Ongoing
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-span-1 md:col-span-3 bg-white p-10 rounded-2xl text-center text-sm text-[#636e72] border border-dashed">
                            Belum ada list event yang dibuat.
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <section class="mb-10">
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

    <script>
        function goToDetail(eventId) {
            document.getElementById('target-id').value = eventId;
            document.getElementById('redirect-form').submit();
        }
    </script>
</body>
</html>