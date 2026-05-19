<div class="mb-8">
    <a href="/" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">← Kembali ke Daftar Event</a>

    <h1 class="text-3xl font-bold text-gray-800 mb-2">🔍 Hasil Pencarian</h1>
    <p class="text-gray-600 mb-8">Pencarian untuk: <strong><?= htmlspecialchars($keyword) ?></strong></p>

    <?php if (count($events) > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($events as $event): ?>
                <div class="card hover:shadow-lg transition">
                    <div class="mb-4 h-40 bg-gray-200 rounded overflow-hidden">
                        <?php if ($event['image_url']): ?>
                            <img 
                                src="/<?= htmlspecialchars($event['image_url']) ?>" 
                                alt="<?= htmlspecialchars($event['title']) ?>"
                                class="w-full h-full object-cover"
                            >
                        <?php else: ?>
                            <div class="flex items-center justify-center h-full text-gray-400">📷</div>
                        <?php endif; ?>
                    </div>

                    <h3 class="font-bold text-lg mb-2 text-gray-800">
                        <?= htmlspecialchars(substr($event['title'], 0, 50)) ?>
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                        <?= htmlspecialchars(substr($event['description'], 0, 100)) ?>
                    </p>

                    <div class="text-xs text-gray-500 mb-4 space-y-1">
                        <div>📅 <?= date('d M Y', strtotime($event['event_date'])) ?></div>
                        <div>📍 <?= htmlspecialchars($event['location'] ?? 'Lokasi tidak ditentukan') ?></div>
                    </div>

                    <a href="/events/<?= $event['id'] ?>" class="btn btn-primary w-full text-center">
                        Lihat Detail
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="card text-center py-12">
            <div class="text-6xl mb-4">😕</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak ada hasil</h3>
            <p class="text-gray-600 mb-6">Coba gunakan kata kunci yang berbeda atau kembali ke daftar event.</p>
            <a href="/" class="btn btn-primary inline-block">
                ← Kembali ke Daftar Event
            </a>
        </div>
    <?php endif; ?>
</div>
