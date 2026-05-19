<div class="mb-8">
    <a href="/events/<?= $event['id'] ?>" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">← Kembali ke Event</a>

    <div class="card mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">📋 Kelola Peserta - <?= htmlspecialchars($event['title']) ?></h1>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-6">
            <div class="p-3 bg-gray-50 rounded text-center">
                <div class="text-lg font-bold"><?= intval($stats['total_registrations'] ?? 0) ?></div>
                <div class="text-xs text-gray-600">Total</div>
            </div>
            <div class="p-3 bg-green-50 rounded text-center">
                <div class="text-lg font-bold text-green-600"><?= intval($stats['confirmed'] ?? 0) ?></div>
                <div class="text-xs text-gray-600">Dikonfirmasi</div>
            </div>
            <div class="p-3 bg-yellow-50 rounded text-center">
                <div class="text-lg font-bold text-yellow-600"><?= intval($stats['pending'] ?? 0) ?></div>
                <div class="text-xs text-gray-600">Menunggu</div>
            </div>
            <div class="p-3 bg-blue-50 rounded text-center">
                <div class="text-lg font-bold text-blue-600"><?= intval($stats['present'] ?? 0) ?></div>
                <div class="text-xs text-gray-600">Hadir</div>
            </div>
            <div class="p-3 bg-red-50 rounded text-center">
                <div class="text-lg font-bold text-red-600"><?= intval($stats['absent'] ?? 0) ?></div>
                <div class="text-xs text-gray-600">Tidak Hadir</div>
            </div>
        </div>
    </div>

    <!-- Registrations Table -->
    <div class="card">
        <h2 class="card-header">Daftar Peserta</h2>

        <?php if (count($registrations) > 0): ?>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-50">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelas</th>
                            <th>Status Registrasi</th>
                            <th>Kehadiran</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registrations as $index => $reg): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="font-semibold"><?= htmlspecialchars($reg['name']) ?></td>
                                <td><?= htmlspecialchars($reg['email']) ?></td>
                                <td><?= htmlspecialchars($reg['student_class'] ?? '-') ?></td>
                                <td>
                                    <select onchange="updateStatus(<?= $reg['id'] ?>, this.value)" class="text-sm p-1 rounded border"
                                        <?= $reg['registration_status'] === 'cancelled' ? 'disabled' : '' ?>>
                                        <option value="pending" <?= $reg['registration_status'] === 'pending' ? 'selected' : '' ?>>⏳ Menunggu</option>
                                        <option value="confirmed" <?= $reg['registration_status'] === 'confirmed' ? 'selected' : '' ?>>✓ Dikonfirmasi</option>
                                        <option value="rejected" <?= $reg['registration_status'] === 'rejected' ? 'selected' : '' ?>>✗ Ditolak</option>
                                        <option value="cancelled" <?= $reg['registration_status'] === 'cancelled' ? 'selected' : '' ?>>🚫 Dibatalkan</option>
                                    </select>
                                </td>
                                <td>
                                    <select onchange="updateAttendance(<?= $reg['id'] ?>, this.value)" class="text-sm p-1 rounded border">
                                        <option value="not-taken" <?= $reg['attendance_status'] === 'not-taken' ? 'selected' : '' ?>>-</option>
                                        <option value="present" <?= $reg['attendance_status'] === 'present' ? 'selected' : '' ?>>✓ Hadir</option>
                                        <option value="absent" <?= $reg['attendance_status'] === 'absent' ? 'selected' : '' ?>>✗ Tidak Hadir</option>
                                    </select>
                                </td>
                                <td><?= date('d M Y', strtotime($reg['registered_at'])) ?></td>
                                <td>
                                    <button onclick="viewDetails(<?= $reg['id'] ?>)" class="btn btn-primary text-xs">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-8">
                <div class="text-4xl mb-2">📭</div>
                <p class="text-gray-600">Belum ada peserta yang mendaftar</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function updateStatus(registrationId, status) {
    if (confirm('Ubah status pendaftaran?')) {
        fetch(`/registration/${registrationId}/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `status=${status}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.error);
            }
        });
    }
}

function updateAttendance(registrationId, status) {
    fetch(`/registration/${registrationId}/update`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `attendance_status=${status}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error: ' + data.error);
        }
    });
}

function viewDetails(registrationId) {
    alert('Fitur detail akan segera tersedia');
}
</script>
