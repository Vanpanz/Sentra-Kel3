<?php
// Mengambil koneksi database bawaan project kamu
require_once __DIR__ . '/../../config/db-connection.php';

// 🛠️ MENANGKAP ID YANG DIKIRIM LEWAT METHOD POST
if (!isset($_POST['id'])) {
    die("Post tidak ditemukan atau akses langsung dilarang.");
}

$id = intval($_POST['id']);

// Ambil data postingan utuh dari database
$query = mysqli_query($connection, "SELECT * FROM posts WHERE id = $id");

if (mysqli_num_rows($query) == 0) {
    die("Post tidak ditemukan.");
}

$post = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?></title>

    <link rel="stylesheet" href="/css/output.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-[#f4f9f8] text-[#2d3436] antialiased">

    <div class="flex min-h-screen">

    
        <main class="flex-1 p-8 lg:px-12 overflow-y-auto">
            
            <header class="flex items-center justify-between mb-6">
                <a href="/homepage" class="text-[#64b3a4] font-bold text-sm flex items-center gap-2 hover:underline">
                    <span>←</span> Back to Home
                </a>
                <button class="bg-[#64b3a4]/20 text-[#4c8c80] hover:bg-[#64b3a4]/30 px-5 py-2 rounded-xl text-xs font-bold transition-all">
                    Edit Event
                </button>
            </header>

            <h1 class="text-3xl font-extrabold tracking-tight mb-6">Event Detail</h1>

            <div class="w-full aspect-[3/1] md:aspect-[21/9] lg:h-80 rounded-3xl overflow-hidden shadow-sm bg-gray-100 mb-8">
                <?php if (!empty($post['image_path'])): ?>
                    <img src="/<?= htmlspecialchars($post['image_path']) ?>" alt="Banner Detail" class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="w-full h-full bg-gradient-to-r from-[#80c4b7] to-[#64b3a4] flex items-center justify-center text-white font-bold">
                        No Banner Provided
                    </div>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white p-6 rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-extrabold text-[#2d3436]">Event Description</h2>
                            <span class="bg-[#80c4b7]/20 text-[#4c8c80] px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Ongoing
                            </span>
                        </div>
                        
                        <div class="text-[#636e72] text-sm leading-relaxed font-medium">
                            <?= nl2br(htmlspecialchars($post['content'])) ?>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap gap-6 text-xs font-bold text-[#636e72]">
                            <span class="flex items-center gap-1.5">📅 12-19 Desember 20XX</span>
                            <span class="flex items-center gap-1.5">📍 Lapangan Utama</span>
                        </div>
                    </div>

                    
                        
    
                <div class="space-y-6">
                    
                    <div class="bg-white p-6 rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-gray-100">
                        <h2 class="text-base font-extrabold text-[#2d3436] mb-4">Event Highlights</h2>
                        
                        <div class="grid grid-cols-2 gap-3 mb-6">
                            <div class="p-2.5 bg-[#64b3a4]/5 text-[#4c8c80] text-[11px] font-bold rounded-lg text-center">
                                8 Cabang Lomba
                            </div>
                            <div class="p-2.5 bg-[#64b3a4]/5 text-[#4c8c80] text-[11px] font-bold rounded-lg text-center">
                                Sertifikat Peserta
                            </div>
                            <div class="p-2.5 bg-[#64b3a4]/5 text-[#4c8c80] text-[11px] font-bold rounded-lg text-center">
                                Doorprize Menarik
                            </div>
                            <div class="p-2.5 bg-[#64b3a4]/5 text-[#4c8c80] text-[11px] font-bold rounded-lg text-center">
                                Guest Performance
                            </div>
                        </div>

                        <div class="text-center pt-2 border-t border-gray-100">
                            <p class="text-xs font-bold text-[#4c8c80]">Total Slots: 100 Students</p>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.02)] border border-gray-100 text-xs font-bold text-[#2d3436] space-y-2.5">
                        <p class="flex items-start gap-2"><span>✨</span> <span>Event Highlights</span></p>
                        <ul class="list-disc list-inside pl-4 text-[#636e72] font-semibold space-y-1">
                            <li>8 Cabang lomba</li>
                            <li>Doorprize menarik</li>
                            <li>Guest performance</li>
                            <li>Sertifikat peserta</li>
                        </ul>
                    </div>

                </div>

            </div>

        </main>
    </div>

</body>
</html>