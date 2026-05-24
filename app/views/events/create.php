<header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <a href="/events" class="text-[#4c8c80] font-bold text-sm flex items-center gap-2 hover:underline">
            <span>←</span> Back to Events
        </a>
        <h1 class="text-3xl font-extrabold tracking-tight mt-2">Create New Event</h1>
        <p class="text-sm text-[#636e72] mt-1">Isi title, lokasi, waktu, deskripsi, dan banner untuk membuat event baru.</p>
    </div>

    <button type="submit" form="createForm" class="btn-primary px-6 py-2 text-xs uppercase tracking-widest font-bold whitespace-nowrap">
        Create Event
    </button>
</header>

<?php if (!empty($error)): ?>
    <div class="bg-red-50 text-red-600 font-bold text-sm px-4 py-3 rounded-2xl mb-6">
        <?= htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<form id="createForm" action="/events" method="POST" enctype="multipart/form-data">
    <div class="relative w-full aspect-[3/1] md:aspect-[21/9] lg:h-72 rounded-3xl overflow-hidden shadow-sm bg-gray-100 mb-8 group">
        <div class="w-full h-full bg-gradient-to-r from-[#80c4b7] to-[#64b3a4] flex items-center justify-center text-white font-bold">
            Upload Banner
        </div>
        
        <label for="imageBannerCreate" class="absolute bottom-4 right-4 btn-primary px-4 py-2 text-xs uppercase tracking-widest font-bold cursor-pointer shadow-lg hover:opacity-90 transition-all">
            📷 Upload Banner
        </label>
        <input type="file" id="imageBannerCreate" name="gambar" accept="image/*" style="display: none;" onchange="updateBannerPreview(this)">
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="card p-6">
                <div class="mb-4">
                    <h2 class="text-xl font-extrabold text-[#2d3436]">Event Details</h2>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-[#2d3436] mb-2">Event Title</label>
                        <input type="text" name="title" required placeholder="Masukkan judul event"
                            class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#2d3436] mb-2">Location</label>
                        <input type="text" name="location" placeholder="Masukkan lokasi event"
                            class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-[#2d3436] mb-2">Start Date</label>
                            <input type="date" name="start_date" class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#2d3436] mb-2">End Date</label>
                            <input type="date" name="end_date" class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#2d3436] mb-2">Description</label>
                        <textarea name="content" rows="6" required placeholder="Masukkan deskripsi event"
                            class="w-full px-4 py-3 input-field outline-none text-sm font-medium"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#2d3436] mb-2">Capacity</label>
                        <input type="number" name="capacity" min="1" placeholder="Jumlah peserta"
                            class="w-full px-4 py-3 input-field outline-none text-sm font-medium">
                    </div>
                </div>
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
                <p class="text-xs font-bold text-[#4c8c80]">Tips: Semakin lengkap data, semakin menarik event Anda.</p>
            </div>
        </div>

        <div class="card p-5 text-xs font-bold text-[#2d3436] space-y-2.5">
            <p class="flex items-start gap-2"><span>✨</span> <span>Quick Tips</span></p>
            <ul class="list-disc list-inside pl-4 text-[#636e72] font-semibold space-y-1">
                <li>Gunakan judul yang menarik</li>
                <li>Deskripsi detail & jelas</li>
                <li>Banner berkualitas tinggi</li>
                <li>Kapasitas realistis</li>
            </ul>
        </div>
    </div>
</div>
</form>
