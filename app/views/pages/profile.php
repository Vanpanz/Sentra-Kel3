<div class="max-w-4xl mx-auto">
    <a href="/" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">← Kembali ke Home</a>

    <div class="card">
        <h1 class="card-header">👤 Profil Saya</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Profile Info -->
            <div class="md:col-span-2">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Profil</h2>
                    
                    <div class="space-y-4">
                        <div class="p-4 bg-gray-50 rounded">
                            <label class="text-sm text-gray-600">Nama</label>
                            <div class="font-semibold text-gray-800"><?= htmlspecialchars($user['name']) ?></div>
                        </div>
                        
                        <div class="p-4 bg-gray-50 rounded">
                            <label class="text-sm text-gray-600">Email</label>
                            <div class="font-semibold text-gray-800"><?= htmlspecialchars($user['email']) ?></div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 rounded">
                                <label class="text-sm text-gray-600">Kelas</label>
                                <div class="font-semibold text-gray-800"><?= htmlspecialchars($user['class'] ?? '-') ?></div>
                            </div>
                            
                            <div class="p-4 bg-gray-50 rounded">
                                <label class="text-sm text-gray-600">Role</label>
                                <div class="font-semibold text-gray-800"><?= ucfirst($user['role']) ?></div>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gray-50 rounded">
                            <label class="text-sm text-gray-600">Nomor Telepon</label>
                            <div class="font-semibold text-gray-800"><?= htmlspecialchars($user['phone_number'] ?? '-') ?></div>
                        </div>
                        
                        <div class="p-4 bg-gray-50 rounded">
                            <label class="text-sm text-gray-600">Tanggal Daftar</label>
                            <div class="font-semibold text-gray-800"><?= date('d M Y', strtotime($user['created_at'])) ?></div>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Aksi</h2>
                    <div class="flex gap-2">
                        <button class="btn btn-primary" onclick="alert('Edit profil akan segera tersedia')">
                            ✏️ Edit Profil
                        </button>
                        <button class="btn btn-secondary" onclick="alert('Ubah password akan segera tersedia')">
                            🔐 Ubah Password
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Quick Stats -->
                <div class="card mb-6">
                    <h3 class="card-header">Statistik</h3>
                    <div class="space-y-3">
                        <div class="p-3 bg-blue-50 rounded text-center">
                            <div class="text-2xl font-bold text-blue-600">0</div>
                            <div class="text-sm text-gray-600">Event Diikuti</div>
                        </div>
                        <div class="p-3 bg-green-50 rounded text-center">
                            <div class="text-2xl font-bold text-green-600">0</div>
                            <div class="text-sm text-gray-600">Event Dikonfirmasi</div>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="card">
                    <h3 class="card-header text-red-600">⚠️ Zona Berbahaya</h3>
                    <button class="btn btn-danger w-full" onclick="alert('Hapus akun akan segera tersedia')">
                        Hapus Akun
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
