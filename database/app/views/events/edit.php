<div class="w-full max-w-2xl card p-8 mx-auto">
    <header class="mb-6">
        <a href="/events/<?= (int) $event['id']; ?>"
            class="text-[#3f8e82] font-bold text-sm flex items-center gap-2 hover:underline mb-2">
            <span>←</span> Cancel and Back
        </a>
        <h1 class="text-2xl font-extrabold tracking-tight">✏️ Edit Event</h1>
        <p class="text-sm text-[#636e72] font-medium">Perbarui informasi event atau ganti banner gambar Anda.</p>
    </header>

    <?php if (!empty($error)): ?>
        <div class="bg-red-50 text-red-600 font-bold text-sm px-4 py-3 rounded-xl mb-6">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="/events/<?= (int) $event['id']; ?>" method="POST" enctype="multipart/form-data"
        class="space-y-5 mb-4">
        <input type="hidden" name="_method" value="PUT">

        <div>
            <label class="block text-sm font-bold text-[#2d3436] mb-2">Event Title</label>
            <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" required
                class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
        </div>

        <div>
            <label class="block text-sm font-bold text-[#2d3436] mb-2">Location</label>
            <input type="text" name="location" value="<?= htmlspecialchars($event['location'] ?? '') ?>"
                class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-bold text-[#2d3436] mb-2">Start Date</label>
                <input type="date" name="start_date" value="<?= htmlspecialchars($event['start_date'] ?? '') ?>"
                    class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
            </div>
            <div>
                <label class="block text-sm font-bold text-[#2d3436] mb-2">End Date</label>
                <input type="date" name="end_date" value="<?= htmlspecialchars($event['end_date'] ?? '') ?>"
                    class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-[#2d3436] mb-2">Capacity</label>
            <input type="number" name="capacity" min="1" value="<?= htmlspecialchars($event['capacity'] ?? '') ?>"
                class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
        </div>

        <div>
            <label class="block text-sm font-bold text-[#2d3436] mb-2">Event Description</label>
            <textarea name="content" rows="6" required
                class="w-full px-4 py-3 input-field outline-none text-sm font-medium"><?= htmlspecialchars($event['description']) ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-bold text-[#2d3436] mb-2">Event Banner</label>

            <?php if (!empty($event['banner_path'])): ?>
                <div class="mb-3 w-40 h-24 rounded-lg overflow-hidden border border-gray-200">
                    <img src="/<?= htmlspecialchars($event['banner_path']) ?>" class="w-full h-full object-cover"
                        alt="Current Banner">
                </div>
                <p class="text-[11px] text-[#636e72] mb-2 font-medium">Ganti gambar baru jika ingin mengubah banner saat
                    ini.</p>
            <?php endif; ?>

            <input type="file" name="image" accept="image/*"
                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#64b3a4]/10 file:text-[#4c8c80] hover:file:bg-[#64b3a4]/20">
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full btn-primary py-3">
                Save Changes
            </button>
        </div>
    </form>

    <hr class="border-gray-100 my-4">

    <form action="/events/<?= (int) $event['id']; ?>" method="POST"
        onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini? Tindakan ini tidak dapat dibatalkan.');">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit"
            class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-bold shadow-[0_4px_15px_rgba(239,68,68,0.2)] transition-all duration-300 transform hover:-translate-y-0.5 text-center block text-sm">
            🗑️ Delete Event
        </button>
    </form>
</div>