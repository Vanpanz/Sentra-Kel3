<header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <a href="/events" class="text-[#4c8c80] font-bold text-sm flex items-center gap-2 hover:underline">
        <span>←</span> Back to Events
    </a>

    <div class="flex items-center gap-3">
        <?php if (!empty($isAdmin)): ?>
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
                <form action="/events/<?= (int) $event['id']; ?>/register" method="POST"
                    onsubmit="return confirm('Daftar ke event ini?');">
                    <button type="submit" class="btn-primary px-5 py-2 text-xs uppercase tracking-widest">
                        Register
                    </button>
                </form>
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
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-extrabold text-[#2d3436]"><?= htmlspecialchars($event['title']) ?></h2>
                <span class="badge-soft px-3 py-1 text-[10px]">
                    Ongoing
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