<header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <a href="/events/<?= (int) $event['id']; ?>" class="text-[#4c8c80] font-bold text-sm flex items-center gap-2 hover:underline">
            <span>←</span> Back to Event Detail
        </a>
        <h1 class="text-3xl font-extrabold tracking-tight mt-2">Edit Event</h1>
        <p class="text-sm text-[#636e72] mt-1">Perbarui informasi event — tampilannya mengikuti halaman detail.</p>
    </div>

    <div class="flex flex-col gap-2">
        <form method="POST" action="/events/<?= (int) $event['id']; ?>" style="display: inline;">
            <input type="hidden" name="_method" value="PUT">
            <button type="submit" form="editForm" class="btn-primary px-6 py-2 text-xs uppercase tracking-widest font-bold whitespace-nowrap">
                Save Event
            </button>
        </form>
        <form method="POST" action="/events/<?= (int) $event['id']; ?>" 
            onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini? Tindakan ini tidak dapat dibatalkan.');">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 text-xs uppercase tracking-widest font-bold rounded-2xl shadow-[0_4px_15px_rgba(239,68,68,0.2)] transition-all duration-300 transform hover:-translate-y-0.5 whitespace-nowrap">
                🗑️ Delete
            </button>
        </form>
    </div>
</header>

<?php if (!empty($error)): ?>
    <div class="bg-red-50 text-red-600 font-bold text-sm px-4 py-3 rounded-2xl mb-6">
        <?= htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<div class="relative w-full aspect-[3/1] md:aspect-[21/9] lg:h-72 rounded-3xl overflow-hidden shadow-sm bg-gray-100 mb-8 group">
    <?php if (!empty($event['banner_path'])): ?>
        <img src="/<?= htmlspecialchars($event['banner_path']) ?>" alt="Banner Detail" class="w-full h-full object-cover">
    <?php else: ?>
        <div class="w-full h-full bg-gradient-to-r from-[#80c4b7] to-[#64b3a4] flex items-center justify-center text-white font-bold">
            No Banner Provided
        </div>
    <?php endif; ?>
    
    <label for="imageBannerInput" class="absolute bottom-4 right-4 btn-primary px-4 py-2 text-xs uppercase tracking-widest font-bold cursor-pointer shadow-lg hover:opacity-90 transition-all">
        📷 Change Picture
    </label>
</div>

<form id="editForm" action="/events/<?= (int) $event['id']; ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
    <input type="hidden" name="_method" value="PUT">
    <input type="file" id="imageBannerInput" name="image" accept="image/*" style="display: none;">

                <div>
                    <label class="block text-sm font-bold text-[#2d3436] mb-2">Event Title</label>
                    <input type="text" name="title" required value="<?= htmlspecialchars($event['title']); ?>"
                        class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#2d3436] mb-2">Location</label>
                    <input type="text" name="location" value="<?= htmlspecialchars($event['location'] ?? ''); ?>"
                        class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-[#2d3436] mb-2">Start Date</label>
                        <input type="date" name="start_date" value="<?= htmlspecialchars($event['start_date'] ?? ''); ?>"
                            class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#2d3436] mb-2">End Date</label>
                        <input type="date" name="end_date" value="<?= htmlspecialchars($event['end_date'] ?? ''); ?>"
                            class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#2d3436] mb-2">Description</label>
                    <textarea name="content" rows="6" class="w-full px-4 py-3 input-field outline-none text-sm font-medium"><?= htmlspecialchars($event['description']); ?></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-[#2d3436] mb-2">Capacity</label>
                        <input type="number" name="capacity" min="1" value="<?= htmlspecialchars($event['capacity'] ?? ''); ?>"
                            class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="space-y-6">
        <div class="card p-6">
            <h2 class="text-base font-extrabold text-[#2d3436] mb-4">Event Highlights</h2>

            <div class="grid grid-cols-2 gap-3 mb-6">
                <div class="p-2.5 bg-[#64b3a4]/5 text-[#4c8c80] text-[11px] font-bold rounded-lg text-center">8 Cabang Lomba</div>
                <div class="p-2.5 bg-[#64b3a4]/5 text-[#4c8c80] text-[11px] font-bold rounded-lg text-center">Sertifikat Peserta</div>
                <div class="p-2.5 bg-[#64b3a4]/5 text-[#4c8c80] text-[11px] font-bold rounded-lg text-center">Doorprize Menarik</div>
                <div class="p-2.5 bg-[#64b3a4]/5 text-[#4c8c80] text-[11px] font-bold rounded-lg text-center">Guest Performance</div>
            </div>

            <div class="text-center pt-2 border-t border-gray-100">
                <p class="text-xs font-bold text-[#4c8c80]">Total Slots: <?= !empty($event['capacity']) ? (int) $event['capacity'] : 'Unlimited'; ?></p>
            </div>
        </div>

        <div class="card p-5 text-xs font-bold text-[#2d3436] space-y-2.5">
            <p class="flex items-start gap-2"><span>✨</span> <span>Event Quick Insights</span></p>
            <ul class="list-disc list-inside pl-4 text-[#636e72] font-semibold space-y-1">
                <li>8 Cabang lomba</li>
                <li>Doorprize menarik</li>
                <li>Guest performance</li>
                <li>Sertifikat peserta</li>
            </ul>
        </div>
    </div>
</div>
