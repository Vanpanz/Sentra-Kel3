<div class="mb-8">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">📅 Daftar Event & Kegiatan</h1>
        <div class="flex gap-3">
            <form action="/search" method="GET" class="flex gap-2">
                <input 
                    type="text" 
                    name="q" 
                    placeholder="Cari event..." 
                    class="form-control"
                    required
                >
                <button type="submit" class="btn btn-primary">🔍</button>
            </form>
        </div>
    </div>

    <!-- Filter & Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="card">
            <div class="text-2xl font-bold text-blue-600"><?= count($events) ?></div>
            <div class="text-gray-600 text-sm">Total Event</div>
        </div>
        <div class="card">
            <div class="text-2xl font-bold text-green-600"><?= count(array_filter($events, fn($e) => $e['status'] === 'published')) ?></div>
            <div class="text-gray-600 text-sm">Event Aktif</div>
        </div>
        <div class="card">
            <div class="text-2xl font-bold text-orange-600"><?= count(array_filter($events, fn($e) => $e['status'] === 'completed')) ?></div>
            <div class="text-gray-600 text-sm">Event Selesai</div>
        </div>
        <div class="card">
            <div class="text-2xl font-bold text-purple-600"><?= count(array_filter($events, fn($e) => $e['status'] === 'draft')) ?></div>
            <div class="text-gray-600 text-sm">Draft</div>
        </div>
    </div>

    <!-- Events Grid -->
    <?php if (count($events) > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($events as $event): ?>
                <div class="card hover:shadow-lg transition transform hover:-translate-y-1">
                    <!-- Event Image -->
                    <div class="mb-4 h-40 bg-gray-200 rounded overflow-hidden flex items-center justify-center">
                        <?php if ($event['image_url']): ?>
                            <img 
                                src="/<?= htmlspecialchars($event['image_url']) ?>" 
                                alt="<?= htmlspecialchars($event['title']) ?>"
                                class="w-full h-full object-cover"
                            >
                        <?php else: ?>
                            <div class="text-gray-400 text-center">
                                <div class="text-4xl">📷</div>
                                <div class="text-sm">No Image</div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Event Info -->
                    <div class="mb-3">
                        <!-- Badge -->
                        <div class="mb-2 flex gap-2">
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded font-semibold">
                                <?= htmlspecialchars($event['category']) ?>
                            </span>
                            <span class="inline-block px-2 py-1 text-xs rounded font-semibold
                                <?php
                                    if ($event['status'] === 'published') echo 'bg-green-100 text-green-700';
                                    elseif ($event['status'] === 'completed') echo 'bg-gray-100 text-gray-700';
                                    elseif ($event['status'] === 'draft') echo 'bg-yellow-100 text-yellow-700';
                                    else echo 'bg-red-100 text-red-700';
                                ?>
                            ">
                                <?= ucfirst($event['status']) ?>
                            </span>
                        </div>

                        <!-- Title & Description -->
                        <h3 class="font-bold text-lg mb-2 text-gray-800">
                            <?= htmlspecialchars(substr($event['title'], 0, 50)) ?>
                            <?= strlen($event['title']) > 50 ? '...' : '' ?>
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            <?= htmlspecialchars(substr($event['description'], 0, 100)) ?>
                            <?= strlen($event['description']) > 100 ? '...' : '' ?>
                        </p>

                        <!-- Meta Info -->
                        <div class="space-y-1 text-xs text-gray-500 mb-3">
                            <div>📅 <?= date('d M Y', strtotime($event['event_date'])) ?> <?= $event['event_time'] ? date('H:i', strtotime($event['event_time'])) : '' ?></div>
                            <div>📍 <?= htmlspecialchars($event['location'] ?? 'Lokasi tidak ditentukan') ?></div>
                            <div>👥 <?= intval($event['registered_count']) ?>/<?= intval($event['quota']) ?: '∞' ?> peserta</div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="flex gap-2">
                        <a 
                            href="/events/<?= $event['id'] ?>" 
                            class="btn btn-primary flex-1 text-center"
                        >
                            Lihat Detail
                        </a>
                        
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                            <a 
                                href="/event/<?= $event['id'] ?>/edit" 
                                class="btn btn-secondary"
                            >
                                ✏️
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="card text-center py-12">
            <div class="text-6xl mb-4">📭</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak ada event</h3>
            <p class="text-gray-600 mb-4">Event akan segera ditambahkan oleh administrator sekolah.</p>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="/event/create" class="btn btn-primary">+ Buat Event Baru</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
