<style>
    .card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .accent-color {
        color: #50B498;
    }

    .bg-accent {
        background-color: #50B498;
    }
</style>

<h2 class="text-2xl font-bold text-gray-600 mb-4 shrink-0 text-center">My Profile</h2>

<div class="card p-6 mb-6 shrink-0">
    <h3 class="text-2xl font-bold accent-color leading-tight"><?= htmlspecialchars($userName); ?></h3>
    <p class="text-gray-400 text-xs"><?= htmlspecialchars($userEmail); ?></p>
</div>

<div class="card p-6 flex flex-col flex-1 min-h-0 mb-12">
    <h4 class="text-xl font-bold text-gray-600 mb-3 shrink-0">Account Detail</h4>
    <div class="space-y-3 flex-1 overflow-y-auto pr-2">
        <div>
            <label class="text-[10px] text-gray-400 font-bold uppercase ml-1">Name</label>
            <input type="text" readonly value="<?= htmlspecialchars($userName); ?>"
                class="w-full border-2 border-gray-50 rounded-lg p-2 text-sm text-emerald-500 focus:outline-none">
        </div>
        <div>
            <label class="text-[10px] text-gray-400 font-bold uppercase ml-1">Email</label>
            <input type="email" readonly value="<?= htmlspecialchars($userEmail); ?>"
                class="w-full border-2 border-gray-50 rounded-lg p-2 text-sm text-emerald-500 focus:outline-none">
        </div>
    </div>
</div>

<!-- Event History Section -->
<div class="card p-6">
    <h3 class="text-xl font-bold text-gray-600 mb-4">Riwayat Event</h3>
    
    <?php if (!empty($eventHistory)): ?>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-emerald-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-[#50B498] uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-[#50B498] uppercase">Nama Event</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-[#50B498] uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-[#50B498] uppercase">Terdaftar</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-[#50B498] uppercase">Hadir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($eventHistory as $idx => $event): ?>
                        <tr class="hover:bg-emerald-50 transition">
                            <td class="px-4 py-3 text-sm font-semibold text-gray-700"><?= $idx + 1; ?></td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-700">
                                <?= htmlspecialchars($event['title']); ?>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 text-xs font-bold rounded-full
                                    <?php
                                    if ($event['status'] === 'attended') {
                                        echo 'bg-emerald-100 text-emerald-700';
                                    } elseif ($event['status'] === 'cancelled') {
                                        echo 'bg-red-100 text-red-700';
                                    } else {
                                        echo 'bg-blue-100 text-blue-700';
                                    }
                                    ?>">
                                    <?php
                                    $statusLabel = [
                                        'registered' => 'Terdaftar',
                                        'attended' => 'Hadir',
                                        'cancelled' => 'Batal'
                                    ];
                                    echo $statusLabel[$event['status']] ?? ucfirst($event['status']);
                                    ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                <?= date('d M Y', strtotime($event['created_at'])); ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <?php if (!empty($event['attended_at'])): ?>
                                    <span class="text-sm text-emerald-600 font-semibold">✓ <?= date('d M Y', strtotime($event['attended_at'])); ?></span>
                                <?php else: ?>
                                    <span class="text-sm text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="text-center py-8">
            <p class="text-gray-400 font-medium">Belum ada riwayat event</p>
        </div>
    <?php endif; ?>
</div>