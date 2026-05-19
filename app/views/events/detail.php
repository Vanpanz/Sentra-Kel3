<div class="mb-8">
    <!-- Back Button -->
    <a href="/" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">← Kembali ke Daftar</a>

    <!-- Event Header -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="card">
                <!-- Event Image -->
                <div class="mb-6 h-64 bg-gray-200 rounded overflow-hidden flex items-center justify-center">
                    <?php if ($event['image_url']): ?>
                        <img 
                            src="/<?= htmlspecialchars($event['image_url']) ?>" 
                            alt="<?= htmlspecialchars($event['title']) ?>"
                            class="w-full h-full object-cover"
                        >
                    <?php else: ?>
                        <div class="text-gray-400 text-center text-6xl">📷</div>
                    <?php endif; ?>
                </div>

                <!-- Title & Badges -->
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    <?= htmlspecialchars($event['title']) ?>
                </h1>

                <div class="flex gap-2 mb-6">
                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded font-semibold text-sm">
                        <?= htmlspecialchars($event['category']) ?>
                    </span>
                    <span class="inline-block px-3 py-1 text-sm rounded font-semibold
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

                <!-- Event Meta -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 p-4 bg-gray-50 rounded">
                    <div>
                        <div class="text-sm text-gray-600">Tanggal</div>
                        <div class="font-bold text-gray-800">
                            <?= date('d M Y', strtotime($event['event_date'])) ?>
                        </div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">Waktu</div>
                        <div class="font-bold text-gray-800">
                            <?= $event['event_time'] ? date('H:i', strtotime($event['event_time'])) : 'TBD' ?>
                        </div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">Lokasi</div>
                        <div class="font-bold text-gray-800">
                            <?= htmlspecialchars($event['location'] ?? '-') ?>
                        </div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-600">Kuota</div>
                        <div class="font-bold text-gray-800">
                            <?= intval($event['quota']) ?: '∞' ?>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Deskripsi</h2>
                    <div class="text-gray-700 leading-relaxed prose prose-sm max-w-none">
                        <?= nl2br(htmlspecialchars($event['description'])) ?>
                    </div>
                </div>

                <!-- Admin Actions -->
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <div class="border-t pt-6">
                        <h3 class="font-bold text-gray-800 mb-3">Admin Actions</h3>
                        <div class="flex gap-2">
                            <a 
                                href="/event/<?= $event['id'] ?>/edit" 
                                class="btn btn-primary"
                            >
                                ✏️ Edit Event
                            </a>
                            <a 
                                href="/event/<?= $event['id'] ?>/registrations" 
                                class="btn btn-secondary"
                            >
                                📋 Kelola Peserta (<?= intval($stats['total_registrations'] ?? 0) ?>)
                            </a>
                            <form action="/event/<?= $event['id'] ?>/delete" method="POST" style="display:inline;">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus event ini?')">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Registration Card -->
            <div class="card mb-6">
                <h3 class="card-header">Pendaftaran</h3>
                
                <?php if ($event['status'] !== 'published' && $event['status'] !== 'ongoing'): ?>
                    <p class="text-gray-600 text-sm mb-4">
                        Event ini belum dibuka untuk pendaftaran.
                    </p>
                <?php elseif ($isRegistered): ?>
                    <div class="bg-green-50 border border-green-200 rounded p-4 mb-4">
                        <div class="text-green-700 font-semibold mb-2">✓ Anda sudah terdaftar</div>
                        <div class="text-sm text-gray-600 mb-3">
                            <div>Status: 
                                <span class="font-semibold">
                                    <?php
                                        if ($registration['registration_status'] === 'confirmed') echo '✓ Dikonfirmasi';
                                        elseif ($registration['registration_status'] === 'pending') echo '⏳ Menunggu';
                                        elseif ($registration['registration_status'] === 'rejected') echo '✗ Ditolak';
                                        else echo ucfirst($registration['registration_status']);
                                    ?>
                                </span>
                            </div>
                            <div>Tanggal Daftar: <?= date('d M Y H:i', strtotime($registration['registered_at'])) ?></div>
                        </div>

                        <?php if ($registration['registration_status'] !== 'cancelled'): ?>
                            <form action="/registration/<?= $registration['id'] ?>/cancel" method="POST">
                                <button type="submit" class="btn btn-danger w-full text-center" onclick="return confirm('Batal pendaftaran?')">
                                    Batalkan Pendaftaran
                                </button>
                            </form>
                        <?php else: ?>
                            <p class="text-gray-600 text-sm">Pendaftaran telah dibatalkan</p>
                        <?php endif; ?>
                    </div>
                <?php elseif (isset($_SESSION['user'])): ?>
                    <?php if ($event['quota'] > 0 && intval($stats['total_registrations'] ?? 0) >= intval($event['quota'])): ?>
                        <div class="bg-red-50 border border-red-200 rounded p-4">
                            <div class="text-red-700 font-semibold">Event Penuh</div>
                            <p class="text-sm text-gray-600 mt-2">Kuota pendaftaran sudah penuh</p>
                        </div>
                    <?php else: ?>
                        <form id="registrationForm" action="/event/<?= $event['id'] ?>/register" method="POST">
                            <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                            <button type="submit" class="btn btn-success w-full text-center">
                                ✓ Daftar Event
                            </button>
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="text-gray-600 text-sm mb-4">
                        Silakan login untuk mendaftar event
                    </p>
                    <a href="/login" class="btn btn-primary w-full text-center block">
                        Login
                    </a>
                <?php endif; ?>
            </div>

            <!-- Statistics Card -->
            <div class="card mb-6">
                <h3 class="card-header">Statistik</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                        <span class="text-gray-700">Total Daftar</span>
                        <span class="font-bold text-lg"><?= intval($stats['total_registrations'] ?? 0) ?></span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-green-50 rounded">
                        <span class="text-gray-700">Dikonfirmasi</span>
                        <span class="font-bold text-lg text-green-600"><?= intval($stats['confirmed'] ?? 0) ?></span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-yellow-50 rounded">
                        <span class="text-gray-700">Menunggu</span>
                        <span class="font-bold text-lg text-yellow-600"><?= intval($stats['pending'] ?? 0) ?></span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-blue-50 rounded">
                        <span class="text-gray-700">Hadir</span>
                        <span class="font-bold text-lg text-blue-600"><?= intval($stats['present'] ?? 0) ?></span>
                    </div>
                </div>
            </div>

            <!-- Participants Preview -->
            <?php if (count($participants) > 0): ?>
                <div class="card">
                    <h3 class="card-header">Peserta Terdaftar</h3>
                    <div class="space-y-2 max-h-64 overflow-y-auto">
                        <?php foreach (array_slice($participants, 0, 5) as $participant): ?>
                            <div class="p-2 bg-gray-50 rounded text-sm">
                                <div class="font-semibold text-gray-800">
                                    👤 <?= htmlspecialchars($participant['name']) ?>
                                </div>
                                <div class="text-gray-600">
                                    Kelas: <?= htmlspecialchars($participant['student_class'] ?? '-') ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (count($participants) > 5): ?>
                            <div class="text-center text-sm text-gray-600 p-2">
                                +<?= count($participants) - 5 ?> peserta lainnya
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.getElementById('registrationForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    fetch(this.action, {
        method: 'POST',
        body: new FormData(this)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.reload();
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
});
</script>
