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
    <link class="js-stylesheet" href="/css/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-[#f4f9f8] text-[#2d3436] antialiased">

    <div class="flex min-h-screen justify-center items-center p-6">
        <div class="w-full max-w-2xl bg-white p-8 rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.04)] border border-gray-100">
            
            <header class="mb-6">
                <a href="/homepage" class="text-[#64b3a4] font-bold text-sm flex items-center gap-2 hover:underline mb-2">
                    <span>←</span> Cancel and Back
                </a>
                <h1 class="text-2xl font-extrabold tracking-tight">✏️ Edit Event</h1>
                <p class="text-sm text-[#636e72] font-medium">Perbarui informasi event atau ganti banner gambar Anda.</p>
            </header>

            <form action="/update-event" method="POST" enctype="multipart/form-data" class="space-y-5 mb-4">
                
                <input type="hidden" name="id" value="<?= $post['id'] ?>">

                <div>
                    <label class="block text-sm font-bold text-[#2d3436] mb-2">Event Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-[#64b3a4] focus:ring-1 focus:ring-[#64b3a4] text-sm transition-all font-medium">
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#2d3436] mb-2">Event Description</label>
                    <textarea name="content" rows="6" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-[#64b3a4] focus:ring-1 focus:ring-[#64b3a4] text-sm transition-all font-medium"><?= htmlspecialchars($post['content']) ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#2d3436] mb-2">Event Banner</label>
                    
                    <?php if (!empty($post['image_path'])): ?>
                        <div class="mb-3 w-40 h-24 rounded-lg overflow-hidden border border-gray-200">
                            <img src="/<?= $post['image_path'] ?>" class="w-full h-full object-cover" alt="Current Banner">
                        </div>
                        <p class="text-[11px] text-[#636e72] mb-2 font-medium">Ganti gambar baru jika ingin mengubah banner saat ini.</p>
                    <?php endif; ?>

                    <input type="file" name="image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#64b3a4]/10 file:text-[#4c8c80] hover:file:bg-[#64b3a4]/20">
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-[#64b3a4] hover:bg-[#4c8c80] text-white py-3 rounded-xl font-bold shadow-[0_4px_15px_rgba(100,179,164,0.3)] transition-all duration-300 transform hover:-translate-y-0.5">
                        Save Changes
                    </button>
                </div>
            </form>

            <hr class="border-gray-100 my-4">

            <form action="/delete-event" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini? Tindakan ini tidak dapat dibatalkan.');">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                <button type="submit" 
                    class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-bold shadow-[0_4px_15px_rgba(239,68,68,0.2)] transition-all duration-300 transform hover:-translate-y-0.5 text-center block text-sm">
                    🗑️ Delete Event
                </button>
            </form>

        </div>
    </div>

</body>
</html>