<?php
function potongTeks(string $teks, int $batasanKata = 10): string
{
    $kata = explode(' ', $teks);
    if (count($kata) > $batasanKata) {
        return implode(' ', array_slice($kata, 0, $batasanKata)) . '...';
    }
    return $teks;
}
?>

<?php include __DIR__ . '/../layouts/partials/navbar.php'; ?>

<header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight text-[#1f2a29]">
            Welcome back, <?= htmlspecialchars($userName); ?>
        </h1>
        <p class="text-sm text-[#63706e] mt-1">Manage your events and track community activity.</p>
    </div>
    <div class="relative w-full md:w-72">
        <input type="text" placeholder="Search for events..."
            class="w-full px-5 py-3 input-field focus:outline-none text-sm transition-all">
    </div>
</header>

<div class="flex flex-wrap gap-4 mb-10">
    <?php if (!empty($isAdmin)): ?>
        <a href="/events/create" class="btn-primary px-6 py-3 text-sm inline-flex items-center gap-2">
            + Create Event
        </a>
    <?php endif; ?>
    <button class="btn-secondary px-6 py-3 text-sm inline-flex items-center gap-2">
        Announcement
    </button>
</div>

<section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="card p-6 text-center">
        <p class="text-[#636e72] font-semibold text-sm mb-1">Total Events</p>
        <h3 class="text-4xl font-extrabold text-[#4c8c80]"><?= $totalEvents; ?></h3>
    </div>
    <div class="card p-6 text-center">
        <p class="text-[#636e72] font-semibold text-sm mb-1">Participants</p>
        <h3 class="text-4xl font-extrabold text-[#4c8c80]">200+</h3>
    </div>
    <div class="card p-6 text-center">
        <p class="text-[#636e72] font-semibold text-sm mb-1">Upcoming Events</p>
        <h3 class="text-4xl font-extrabold text-[#4c8c80]">1</h3>
    </div>
</section>

<section class="mb-10">
    <div class="mb-4">
        <h3 class="text-xl font-extrabold">Ongoing Events</h3>
    </div>

    <?php if ($ongoingEvent): ?>
        <a href="/events/<?= (int) $ongoingEvent['id']; ?>" class="block group">
            <div class="card overflow-hidden transition-all duration-300 group-hover:-translate-y-1">
                <div class="w-full aspect-[3/1] md:aspect-[21/9] lg:h-64 overflow-hidden bg-gray-100 relative">
                    <?php if (!empty($ongoingEvent['banner_path'])): ?>
                        <img src="/<?= htmlspecialchars($ongoingEvent['banner_path']); ?>" alt="Banner Event"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-r from-[#80c4b7] to-[#64b3a4]"></div>
                    <?php endif; ?>
                </div>

                <div class="p-6">
                    <h2
                        class="text-[#2d3436] text-xl md:text-2xl font-extrabold tracking-wide mb-2 group-hover:text-[#64b3a4] transition-colors">
                        <?= htmlspecialchars($ongoingEvent['title']); ?>
                    </h2>

                    <p class="text-[#636e72] text-sm font-medium mb-4">
                        <?= htmlspecialchars(potongTeks($ongoingEvent['description'], 12)); ?>
                    </p>

                    <div class="flex items-center gap-4">
                        <span class="badge-soft px-4 py-1.5 text-[10px]">
                            <?php
                                $statusLabel = [
                                    'draft' => 'Draft',
                                    'ongoing' => 'Ongoing',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled'
                                ];
                                echo $statusLabel[$ongoingEvent['status']] ?? ucfirst($ongoingEvent['status']);
                            ?>
                        </span>
                        <div class="flex gap-4 text-[#636e72] font-semibold text-sm">
                            <span class="flex items-center gap-1">👥 <?= htmlspecialchars($ongoingEvent['registered_count'] ?? 0); ?>/<?= htmlspecialchars($ongoingEvent['capacity'] ?? '∞'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <?php else: ?>
        <div class="bg-white p-10 rounded-3xl border border-dashed border-gray-200 text-center text-[#636e72]">
            <p class="font-medium">Belum ada event terdaftar. Klik tombol '+ Create Event' untuk menambahkan.</p>
        </div>
    <?php endif; ?>
</section>

<section class="mb-10">
    <div class="flex justify-between items-center mb-5">
        <h3 class="text-xl font-extrabold">All Events</h3>
        <a href="/events" class="text-[#64b3a4] font-bold text-sm hover:underline">View All ></a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <div class="card overflow-hidden flex flex-col group">
                    <a href="/events/<?= (int) $event['id']; ?>" class="block h-44 w-full overflow-hidden bg-gray-100 hover:-translate-y-0.5 transition-all duration-300">
                        <?php if (!empty($event['banner_path'])): ?>
                            <img src="/<?= htmlspecialchars($event['banner_path']); ?>" alt="Event Cover"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-[#80c4b7] to-[#64b3a4]"></div>
                        <?php endif; ?>
                    </a>

                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <a href="/events/<?= (int) $event['id']; ?>" class="block">
                                <h4 class="font-bold text-lg text-[#2d3436] truncate group-hover:text-[#64b3a4] transition-colors mb-1">
                                    <?= htmlspecialchars($event['title']); ?>
                                </h4>
                            </a>
                            <p class="text-xs text-[#636e72] font-medium mb-3">
                                <?= htmlspecialchars(potongTeks($event['description'], 8)); ?>
                            </p>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span class="badge-soft text-[10px] px-2.5 py-1 inline-block">
                                <?php
                                    $statusLabel = [
                                        'draft' => 'Draft',
                                        'ongoing' => 'Ongoing',
                                        'completed' => 'Completed',
                                        'cancelled' => 'Cancelled'
                                    ];
                                    echo $statusLabel[$event['status']] ?? ucfirst($event['status']);
                                ?>
                            </span>
                            <?php if (!empty($isAdmin)): ?>
                                <select onchange="updateEventStatusFromDashboard(<?= (int) $event['id']; ?>, this.value, this)" class="text-[10px] font-semibold bg-white border border-[#d0e8e4] text-[#4c8c80] px-2 py-1 rounded cursor-pointer hover:border-[#4c8c80] transition-colors">
                                    <option value="">Ubah</option>
                                    <option value="draft" <?= $event['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                                    <option value="ongoing" <?= $event['status'] === 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                                    <option value="completed" <?= $event['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                    <option value="cancelled" <?= $event['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-1 md:col-span-3 card p-10 text-center text-sm text-[#636e72] border-dashed">
                Belum ada list event yang dibuat.
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="mb-10">
    <h3 class="text-xl font-extrabold mb-4">Quick Insights</h3>
    <div class="card p-6 space-y-3">
        <p class="flex items-center gap-3 text-sm font-medium text-[#2d3436]">
            <span class="text-lg">🔥</span> Futsal Tournament is almost full
        </p>
        <p class="flex items-center gap-3 text-sm font-medium text-[#2d3436]">
            <span class="text-lg">📅</span> Tomorrow: Wiradana Workshop
        </p>
        <p class="flex items-center gap-3 text-sm font-medium text-[#2d3436]">
            <span class="text-lg">🕒</span> Class Meeting ends in 3 days
        </p>
    </div>
</section>

<script>
function updateEventStatusFromDashboard(eventId, newStatus, selectElement) {
    if (!newStatus) {
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
            // Reset jika dibatalkan
            selectElement.value = '';
        }
    );
}
</script>