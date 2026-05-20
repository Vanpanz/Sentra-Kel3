<header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <a href="/events" class="text-[#4c8c80] font-bold text-sm flex items-center gap-2 hover:underline">
        <span>←</span> Back to Events
    </a>

    <div class="flex items-center gap-3">
        <?php if (!empty($isAdmin)): ?>
            <select id="eventStatusSelect" class="input-field px-4 py-2 text-xs uppercase tracking-widest font-semibold text-[#4c8c80]" onchange="updateEventStatus(<?= (int) $event['id']; ?>, this.value, this)">
                <option value="" disabled <?= !in_array($event['status'], ['ongoing', 'completed']) ? 'selected' : ''; ?>>Ubah Status...</option>
                <option value="ongoing" <?= $event['status'] === 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                <option value="completed" <?= $event['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>
            <a href="/events/<?= (int) $event['id']; ?>/edit"
                class="btn-secondary px-4 py-2 text-xs uppercase tracking-widest">
                Edit Event
            </a>
        <?php else: ?>
            <?php if (!empty($isRegistered)): ?>
                <button type="button" class="btn-secondary px-4 py-2 text-xs uppercase tracking-widest" disabled>
                    Sudah Terdaftar
                </button>
            <?php else: ?>
                <button type="button" class="btn-primary px-5 py-2 text-xs uppercase tracking-widest" onclick="showRegisterModal(<?= (int) $event['id']; ?>, '<?= htmlspecialchars(addslashes($event['title'])); ?>');">
                    Register
                </button>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</header>

<?php if (!empty($flashSuccess)): ?>
    <div class="bg-emerald-50 text-emerald-700 font-bold text-sm px-4 py-3 rounded-2xl mb-6">
        <?= htmlspecialchars($flashSuccess); ?>
    </div>
<?php endif; ?>

<?php if (!empty($flashError)): ?>
    <div class="bg-red-50 text-red-600 font-bold text-sm px-4 py-3 rounded-2xl mb-6">
        <?= htmlspecialchars($flashError); ?>
    </div>
<?php endif; ?>

<h1 class="text-3xl font-extrabold tracking-tight mb-6">Event Detail</h1>

<!-- Capacity Info Card -->
<?php if (!empty($event['capacity']) && !empty($capacityInfo)): ?>
<div class="mb-8 card p-6 bg-gradient-to-br from-[#f0faf8] to-[#e8f5f2]">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-extrabold text-[#4c8c80]">📊 Informasi Kuota Event</h3>
        <div class="text-right">
            <p class="text-3xl font-extrabold text-[#4c8c80]"><?= (int) $event['capacity'] - (int) $capacityInfo['registered_count']; ?></p>
            <p class="text-xs font-semibold text-[#636e72]">Sisa Kuota</p>
        </div>
    </div>
    
    <!-- Progress Bar -->
    <div class="mb-4">
        <div class="flex justify-between items-center mb-2">
            <p class="text-sm font-bold text-[#636e72]">Kapasitas Event</p>
            <p class="text-sm font-bold text-[#4c8c80]"><?= (int) $capacityInfo['registered_count']; ?> / <?= (int) $event['capacity']; ?> peserta</p>
        </div>
        <div class="w-full bg-[#d0e8e4] rounded-full h-3 overflow-hidden">
            <div class="bg-gradient-to-r from-[#4c8c80] to-[#5bb7a7] h-full rounded-full transition-all duration-500" style="width: <?= ((int) $capacityInfo['registered_count'] / (int) $event['capacity'] * 100); ?>%"></div>
        </div>
    </div>
    

    
    <?php if ((int) $capacityInfo['registered_count'] >= (int) $event['capacity']): ?>
        <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg text-center">
            <p class="text-sm font-bold text-red-700">⚠️ Kuota Penuh - Event Tidak Bisa Didaftarkan</p>
        </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<div class="w-full aspect-[3/1] md:aspect-[21/9] lg:h-80 rounded-3xl overflow-hidden shadow-sm bg-gray-100 mb-8">
    <?php if (!empty($event['banner_path'])): ?>
        <img src="/<?= htmlspecialchars($event['banner_path']) ?>" alt="Banner Detail" class="w-full h-full object-cover">
    <?php else: ?>
        <div
            class="w-full h-full bg-gradient-to-r from-[#80c4b7] to-[#64b3a4] flex items-center justify-center text-white font-bold">
            No Banner Provided
        </div>
    <?php endif; ?>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="card p-6">
            <?php
                $statusLabel = [
                    'draft' => 'Draft',
                    'ongoing' => 'Ongoing',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled'
                ];

                $statusStyles = [
                    'ongoing' => 'background: #eaf6f3; color: #3f8e82;',
                    'completed' => 'background: #fff4c8; color: #a07818;',
                ];

                $statusStyle = $statusStyles[$event['status']] ?? 'background: #eff3f1; color: #63706e;';
            ?>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-extrabold text-[#2d3436]"><?= htmlspecialchars($event['title']) ?></h2>
                <span class="badge-soft px-3 py-1 text-[10px]" style="<?= $statusStyle; ?>">
                    <?= $statusLabel[$event['status']] ?? ucfirst($event['status']); ?>
                </span>
            </div>

            <div class="text-[#636e72] text-sm leading-relaxed font-medium">
                <?= nl2br(htmlspecialchars($event['description'])) ?>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap gap-6 text-xs font-bold text-[#636e72]">
                <?php if (!empty($event['start_date']) || !empty($event['end_date'])): ?>
                    <span>📅 <?= htmlspecialchars($event['start_date'] ?? ''); ?> -
                        <?= htmlspecialchars($event['end_date'] ?? ''); ?></span>
                <?php endif; ?>
                <?php if (!empty($event['location'])): ?>
                    <span>📍 <?= htmlspecialchars($event['location']); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="card p-6">
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
                <p class="text-xs font-bold text-[#4c8c80]">
                    Total Slots: <?= !empty($event['capacity']) ? (int) $event['capacity'] : 'Unlimited'; ?>
                </p>
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

<?php if (!empty($isAdmin) && !empty($participants)): ?>
<div class="mt-12 pt-12 border-t border-gray-200">
    <div class="mb-8">
        <h2 class="text-2xl font-extrabold text-[#2d3436] mb-2">Peserta Event</h2>
        <p class="text-sm text-[#636e72]">Total <?= count($participants); ?> peserta terdaftar</p>
    </div>
    
    <div class="card overflow-hidden shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-[#4c8c80] to-[#3f7a70]">
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-white uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-white uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-center text-xs font-extrabold text-white uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-extrabold text-white uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-6 py-4 text-center text-xs font-extrabold text-white uppercase tracking-wider">Kehadiran</th>
                        <th class="px-6 py-4 text-center text-xs font-extrabold text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($participants as $idx => $participant): ?>
                        <tr class="hover:bg-[#f9fdfb] transition-colors duration-200">
                            <!-- Kolom Nama -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-[#4c8c80] to-[#3f7a70] rounded-lg flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                                        <?= $idx + 1; ?>
                                    </div>
                                    <p class="text-sm font-extrabold text-[#2d3436]"><?= htmlspecialchars($participant['name']); ?></p>
                                </div>
                            </td>

                            <!-- Kolom Email -->
                            <td class="px-6 py-4">
                                <a href="mailto:<?= htmlspecialchars($participant['email']); ?>" class="text-[#4c8c80] hover:underline text-sm">
                                    <?= htmlspecialchars($participant['email']); ?>
                                </a>
                            </td>

                            <!-- Kolom Status -->
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-xs font-extrabold rounded-full 
                                    <?= $participant['status'] === 'attended' ? 'bg-emerald-100 text-emerald-700' : 
                                        ($participant['status'] === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') ?>">
                                    <?= $participant['status'] === 'registered' ? 'Terdaftar' : 
                                        ($participant['status'] === 'attended' ? 'Hadir' : 'Batal') ?>
                                </span>
                            </td>

                            <!-- Kolom Tanggal Daftar -->
                            <td class="px-6 py-4 text-sm font-semibold text-[#636e72]">
                                <?= date('d M Y', strtotime($participant['created_at'])); ?>
                            </td>

                            <!-- Kolom Kehadiran -->
                            <td class="px-6 py-4 text-center">
                                <?php if ($participant['status'] === 'attended' && !empty($participant['attended_at'])): ?>
                                    <div class="text-center">
                                        <p class="text-xs font-bold text-emerald-600">✓ Hadir</p>
                                        <p class="text-xs text-emerald-600 font-medium"><?= date('d M Y', strtotime($participant['attended_at'])); ?></p>
                                    </div>
                                <?php elseif ($participant['status'] === 'cancelled'): ?>
                                    <p class="text-xs font-bold text-red-600">Dibatalkan</p>
                                <?php else: ?>
                                    <p class="text-xs text-[#95a4a0] font-medium">-</p>
                                <?php endif; ?>
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="px-6 py-4 text-center">
                                <select onchange="updateParticipantStatus(<?= (int) $event['id']; ?>, <?= (int) $participant['id']; ?>, this.value)" class="input-field text-xs font-semibold text-[#4c8c80] px-3 py-1.5 cursor-pointer border-[#d0e8e4] hover:border-[#4c8c80] transition-colors">
                                    <option value="">Ubah</option>
                                    <option value="registered" <?= $participant['status'] === 'registered' ? 'selected' : '' ?>>Terdaftar</option>
                                    <option value="attended" <?= $participant['status'] === 'attended' ? 'selected' : '' ?>>Hadir</option>
                                    <option value="cancelled" <?= $participant['status'] === 'cancelled' ? 'selected' : '' ?>>Batal</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php elseif (!empty($isAdmin) && empty($participants)): ?>
<div class="mt-12 pt-12 border-t border-gray-200">
    <h2 class="text-2xl font-extrabold text-[#2d3436] mb-6">Peserta Event</h2>
    <div class="card p-12 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-[#e8f5f2] rounded-full mb-4">
            <span class="text-3xl">📭</span>
        </div>
        <p class="text-[#636e72] font-semibold">Belum ada peserta yang terdaftar</p>
        <p class="text-xs text-[#95a4a0] mt-1">Data peserta akan muncul di sini ketika ada yang mendaftar</p>
    </div>
</div>
<?php endif; ?>

<script>
let previousEventStatus = '<?= $event['status']; ?>';

function updateEventStatus(eventId, newStatus, selectElement) {
    if (!newStatus) {
        selectElement.value = previousEventStatus;
        return;
    }

    const statusLabels = {
        'draft': 'Draft',
        'ongoing': 'Ongoing',
        'completed': 'Completed',
        'cancelled': 'Cancelled'
    };

    showConfirm(
        `Ubah status event menjadi "${statusLabels[newStatus] || newStatus}"?`,
        'Konfirmasi Perubahan Status Event',
        () => {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/events/${eventId}/update-status`;
            
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            input.value = newStatus;
            
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        },
        () => {
            // Callback jika user batal (menutup modal tanpa konfirmasi)
            selectElement.value = previousEventStatus;
        }
    );
}

function updateParticipantStatus(eventId, registrationId, newStatus) {
    showConfirm(
        `Ubah status peserta menjadi "${newStatus === 'attended' ? 'Hadir' : newStatus === 'cancelled' ? 'Batal' : 'Terdaftar'}"?`,
        'Konfirmasi Perubahan Status',
        () => {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/events/${eventId}/participants/${registrationId}/update-status`;
            
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'status';
            input.value = newStatus;
            
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    );
}
</script>