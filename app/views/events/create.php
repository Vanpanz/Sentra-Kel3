<div class="max-w-2xl mx-auto mb-8">
    <div class="card">
        <h1 class="card-header">📝 Buat Event Baru</h1>

        <form action="/event/store" method="POST" enctype="multipart/form-data">
            <!-- Title -->
            <div class="form-group">
                <label class="form-label">Judul Event *</label>
                <input 
                    type="text" 
                    name="title" 
                    class="form-control"
                    placeholder="Masukkan judul event"
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
                    placeholder="Jelaskan detail event..."
                    required
                ></textarea>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label class="form-label">Kategori *</label>
                <select name="category" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Lomba">Lomba</option>
                    <option value="Seminar">Seminar</option>
                    <option value="Workshop">Workshop</option>
                    <option value="Festival">Festival</option>
                    <option value="Olahraga">Olahraga</option>
                    <option value="Sosial">Sosial</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label class="form-label">Lokasi *</label>
                <input 
                    type="text" 
                    name="location" 
                    class="form-control"
                    placeholder="Tempat/ruangan pelaksanaan"
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
                        required
                    >
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Mulai</label>
                    <input 
                        type="time" 
                        name="event_time" 
                        class="form-control"
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
                    >
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Akhir</label>
                    <input 
                        type="time" 
                        name="end_time" 
                        class="form-control"
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
                    value="0"
                >
            </div>

            <!-- Image -->
            <div class="form-group">
                <label class="form-label">Gambar Event</label>
                <input 
                    type="file" 
                    name="image" 
                    class="form-control"
                    accept="image/*"
                >
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 5MB)</p>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label class="form-label">Status *</label>
                <select name="status" class="form-control" required>
                    <option value="draft">Draft (Belum dipublikasikan)</option>
                    <option value="published">Dipublikasikan</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 mt-8">
                <button type="submit" class="btn btn-success flex-1">
                    ✓ Buat Event
                </button>
                <a href="/" class="btn btn-secondary flex-1 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
