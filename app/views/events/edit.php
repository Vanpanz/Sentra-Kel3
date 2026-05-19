<div class="max-w-2xl mx-auto mb-8">
    <a href="/events/<?= $event['id'] ?>" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">← Kembali ke Event</a>

    <div class="card">
        <h1 class="card-header">✏️ Edit Event</h1>

        <form action="/event/<?= $event['id'] ?>/update" method="POST" enctype="multipart/form-data">
            <!-- Title -->
            <div class="form-group">
                <label class="form-label">Judul Event *</label>
                <input 
                    type="text" 
                    name="title" 
                    class="form-control"
                    value="<?= htmlspecialchars($event['title']) ?>"
                    required
                >
            </div>

            <!-- Description -->
            <div class="form-group">
                <label class="form-label">Deskripsi *</label>
                <textarea 
                    name="description" 
                    class="form-control"
                    rows="6"
                    required
                ><?= htmlspecialchars($event['description']) ?></textarea>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label class="form-label">Kategori *</label>
                <select name="category" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Lomba" <?= $event['category'] === 'Lomba' ? 'selected' : '' ?>>Lomba</option>
                    <option value="Seminar" <?= $event['category'] === 'Seminar' ? 'selected' : '' ?>>Seminar</option>
                    <option value="Workshop" <?= $event['category'] === 'Workshop' ? 'selected' : '' ?>>Workshop</option>
                    <option value="Festival" <?= $event['category'] === 'Festival' ? 'selected' : '' ?>>Festival</option>
                    <option value="Olahraga" <?= $event['category'] === 'Olahraga' ? 'selected' : '' ?>>Olahraga</option>
                    <option value="Sosial" <?= $event['category'] === 'Sosial' ? 'selected' : '' ?>>Sosial</option>
                    <option value="Lainnya" <?= $event['category'] === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                </select>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label class="form-label">Lokasi *</label>
                <input 
                    type="text" 
                    name="location" 
                    class="form-control"
                    value="<?= htmlspecialchars($event['location']) ?>"
                    required
                >
            </div>

            <!-- Date & Time -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="form-group">
                    <label class="form-label">Tanggal Mulai *</label>
                    <input 
                        type="date" 
                        name="event_date" 
                        class="form-control"
                        value="<?= $event['event_date'] ?>"
                        required
                    >
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Mulai</label>
                    <input 
                        type="time" 
                        name="event_time" 
                        class="form-control"
                        value="<?= substr($event['event_time'], 0, 5) ?>"
                    >
                </div>
            </div>

            <!-- End Date & Time -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="form-group">
                    <label class="form-label">Tanggal Akhir</label>
                    <input 
                        type="date" 
                        name="end_date" 
                        class="form-control"
                        value="<?= $event['end_date'] ?>"
                    >
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Akhir</label>
                    <input 
                        type="time" 
                        name="end_time" 
                        class="form-control"
                        value="<?= substr($event['end_time'], 0, 5) ?>"
                    >
                </div>
            </div>

            <!-- Quota -->
            <div class="form-group">
                <label class="form-label">Kuota Peserta (0 = Unlimited)</label>
                <input 
                    type="number" 
                    name="quota" 
                    class="form-control"
                    min="0"
                    value="<?= intval($event['quota']) ?>"
                >
            </div>

            <!-- Image -->
            <div class="form-group">
                <label class="form-label">Gambar Event</label>
                <?php if ($event['image_url']): ?>
                    <div class="mb-3 p-3 bg-gray-50 rounded">
                        <img 
                            src="/<?= htmlspecialchars($event['image_url']) ?>" 
                            alt="Event image"
                            style="max-width: 200px; height: auto;"
                        >
                    </div>
                <?php endif; ?>
                <input 
                    type="file" 
                    name="image" 
                    class="form-control"
                    accept="image/*"
                >
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar</p>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    <option value="draft" <?= $event['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="published" <?= $event['status'] === 'published' ? 'selected' : '' ?>>Dipublikasikan</option>
                    <option value="ongoing" <?= $event['status'] === 'ongoing' ? 'selected' : '' ?>>Sedang Berlangsung</option>
                    <option value="completed" <?= $event['status'] === 'completed' ? 'selected' : '' ?>>Selesai</option>
                    <option value="cancelled" <?= $event['status'] === 'cancelled' ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 mt-8">
                <button type="submit" class="btn btn-success flex-1">
                    ✓ Simpan Perubahan
                </button>
                <a href="/events/<?= $event['id'] ?>" class="btn btn-secondary flex-1 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
