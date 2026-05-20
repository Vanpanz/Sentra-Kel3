<div class="max-w-4xl mx-auto card p-8">
    <div class="flex justify-between items-center mb-8">
        <a href="/events" class="text-[#3f8e82] font-bold flex items-center gap-2 hover:opacity-70 transition">
            <span class="text-xl">&larr;</span>
            Back to Events
        </a>

        <h1 class="text-3xl font-black text-gray-700">
            Create Event
        </h1>
    </div>

    <?php if (!empty($error)): ?>
        <div class="bg-red-50 text-red-600 font-bold text-sm px-4 py-3 rounded-xl mb-6">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="/events" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div>
            <label class="block font-bold text-gray-600 mb-2">
                Event Title
            </label>

            <input type="text" name="title" required placeholder="Masukkan judul event"
                class="w-full px-4 py-3 input-field outline-none">
        </div>

        <div>
            <label class="block font-bold text-gray-600 mb-2">
                Location
            </label>

            <input type="text" name="location" placeholder="Masukkan lokasi event"
                class="w-full px-4 py-3 input-field outline-none">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-bold text-gray-600 mb-2">
                    Start Date
                </label>
                <input type="date" name="start_date" class="w-full px-4 py-3 input-field outline-none">
            </div>
            <div>
                <label class="block font-bold text-gray-600 mb-2">
                    End Date
                </label>
                <input type="date" name="end_date" class="w-full px-4 py-3 input-field outline-none">
            </div>
        </div>

        <div>
            <label class="block font-bold text-gray-600 mb-2">
                Capacity
            </label>
            <input type="number" name="capacity" min="1" placeholder="Jumlah peserta"
                class="w-full px-4 py-3 input-field outline-none">
        </div>

        <div>
            <label class="block font-bold text-gray-600 mb-2">
                Description
            </label>

            <textarea name="content" rows="6" required placeholder="Masukkan deskripsi event"
                class="w-full px-4 py-3 input-field outline-none"></textarea>
        </div>

        <div>
            <label class="block font-bold text-gray-600 mb-2">
                Upload Banner
            </label>

            <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-3 input-field">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-primary px-8 py-3">
                Create Event
            </button>
        </div>
    </form>
</div>