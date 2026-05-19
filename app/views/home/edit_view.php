<?php 
// Hubungkan dengan file logika backend yang berada di folder app/models/
require_once __DIR__ . '/../../models/detail_controller.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - <?= htmlspecialchars($post['title']) ?></title>
    <link rel="stylesheet" href="/css/output.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-[#DFF4EE] text-[#2d3436] antialiased min-h-screen flex flex-col">

    <main class="flex-1 w-full max-w-4xl mx-auto px-6 py-8 space-y-6">
        
        <header class="flex items-center justify-between">
            <a href="/homepage" class="text-[#50B498] font-bold text-sm flex items-center gap-1.5 hover:underline transition-all">
                <span>←</span> Back to Home
            </a>
            
            <div class="flex items-center gap-3">
                <button type="button" onclick="triggerDelete()" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl text-xs font-bold shadow-sm transition-all transform hover:-translate-y-0.5">
                    🗑️ Delete Event
                </button>

                <button type="button" onclick="document.getElementById('mainEditForm').submit();" class="bg-[#50B498] hover:bg-[#3d9179] text-white px-5 py-2 rounded-xl text-xs font-bold shadow-sm transition-all transform hover:-translate-y-0.5">
                    Save Event
                </button>
            </div>
        </header>

        <div class="space-y-1">
            <h1 class="text-3xl font-extrabold text-gray-700 tracking-tight">Edit Event</h1>
            <p class="text-xl font-bold text-[#50B498]"><?= htmlspecialchars($post['title']) ?></p>
        </div>

        <form id="mainEditForm" action="/update-event" method="POST" enctype="multipart/form-data" class="space-y-6">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">

            <div class="w-full rounded-3xl overflow-hidden shadow-[0_4px_15px_rgba(0,0,0,0.03)] bg-white p-1">
                <div class="w-full aspect-[21/9] md:h-80 rounded-[22px] overflow-hidden bg-gray-100 relative">
                    <?php if (!empty($post['image_path'])): ?>
                        <img src="/<?= htmlspecialchars($post['image_path']) ?>" alt="Banner Event" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-r from-[#6fc5b0] to-[#b8e1d1] flex items-center justify-center text-white font-bold">
                            No Banner Image
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex justify-end">
                <label class="bg-[#83DCD0] hover:bg-[#6abcb0] text-[#3b7a70] px-4 py-2 rounded-xl text-xs font-bold cursor-pointer shadow-sm transition-all">
                    Change Picture
                    <input type="file" name="image" accept="image/*" class="hidden">
                </label>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-[0_4px_20px_rgba(0,0,0,0.02)] border border-gray-50 space-y-4">
                <h2 class="text-xl font-extrabold text-gray-700">Event Description</h2>
                
                <div class="mb-2">
                    <label class="block text-[10px] uppercase font-extrabold text-gray-400 mb-1">Edit Title Name</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-100 bg-gray-50/50 text-gray-700 text-xs font-semibold focus:outline-none focus:border-[#50B498] focus:bg-white transition-all">
                </div>

                <div>
                    <label class="block text-[10px] uppercase font-extrabold text-gray-400 mb-1">Edit Description</label>
                    <textarea name="content" rows="4" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50/50 text-gray-600 text-xs font-semibold focus:outline-none focus:border-[#50B498] focus:bg-white transition-all resize-none leading-relaxed"><?= htmlspecialchars($post['content']) ?></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center pt-2">
                    <div>
                        <label class="block text-[10px] uppercase font-extrabold text-gray-400 mb-1">Event Date</label>
                        <input type="text" name="date_info" value="12-19 Desember 20XX" placeholder="Tanggal Event"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-100 text-xs font-semibold text-gray-500 focus:outline-none focus:border-[#50B498] transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-extrabold text-gray-400 mb-1">Location</label>
                        <input type="text" name="location" value="Lapangan Utama" placeholder="Tempat Event"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-100 text-xs font-semibold text-gray-500 focus:outline-none focus:border-[#50B498] transition-all">
                    </div>
                    <div class="flex justify-end pt-4 md:pt-0">
                        <button type="submit" class="w-full md:w-auto bg-[#83DCD0] hover:bg-[#6abcb0] text-[#3b7a70] px-8 py-2.5 rounded-xl text-xs font-bold shadow-sm transition-all">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <form id="deleteEventForm" action="/delete-event" method="POST" class="hidden">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
        </form>

    </main>

    <footer class="w-full text-center py-4 bg-transparent mt-auto">
        <p class="text-[#3b7a70]/40 font-bold text-xs tracking-[0.4em]">SENTRA</p>
    </footer>

    <script>
        function triggerDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus event ini? Tindakan ini tidak dapat dibatalkan.')) {
                document.getElementById('deleteEventForm').submit();
            }
        }
    </script>

</body>
</html>