<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full card">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">📝 Daftar Akun</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-error mb-4">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/register" method="POST">
            <!-- Name -->
            <div class="form-group">
                <label class="form-label">Nama Lengkap *</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control"
                    placeholder="Masukkan nama lengkap"
                    required
                    autofocus
                >
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label">Email *</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control"
                    placeholder="user@example.com"
                    required
                >
            </div>

            <!-- Class -->
            <div class="form-group">
                <label class="form-label">Kelas</label>
                <input 
                    type="text" 
                    name="class" 
                    class="form-control"
                    placeholder="Contoh: X A"
                >
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label class="form-label">Nomor Telepon</label>
                <input 
                    type="tel" 
                    name="phone_number" 
                    class="form-control"
                    placeholder="08123456789"
                >
            </div>

            <!-- Password -->
            <div class="form-group">
                <label class="form-label">Password *</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control"
                    placeholder="••••••••"
                    required
                >
            </div>

            <!-- Confirm Password -->
            <div class="form-group mb-6">
                <label class="form-label">Konfirmasi Password *</label>
                <input 
                    type="password" 
                    name="confirm_password" 
                    class="form-control"
                    placeholder="••••••••"
                    required
                >
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-success w-full mb-4">
                Daftar
            </button>

            <!-- Login Link -->
            <p class="text-center text-sm text-gray-600">
                Sudah punya akun? 
                <a href="/login" class="text-blue-600 hover:text-blue-800 font-semibold">
                    Login di sini
                </a>
            </p>
        </form>
    </div>
</div>