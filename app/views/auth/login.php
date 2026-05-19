<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full card">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">🔐 Login</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-error mb-4">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST">
            <!-- Email -->
            <div class="form-group">
                <label class="form-label">Email *</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control"
                    placeholder="user@example.com"
                    required
                    autofocus
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

            <!-- Remember Me -->
            <div class="form-group mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-sm text-gray-700">Ingat saya</span>
                </label>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-full mb-4">
                Login
            </button>

            <!-- Sign Up Link -->
            <p class="text-center text-sm text-gray-600">
                Belum punya akun? 
                <a href="/register" class="text-blue-600 hover:text-blue-800 font-semibold">
                    Daftar di sini
                </a>
            </p>

            <!-- Info -->
            <div class="mt-6 p-4 bg-blue-50 rounded text-sm text-gray-700">
                <strong>Demo Account:</strong>
                <div>Email: admin@sekolah.com</div>
                <div>Password: password</div>
            </div>
        </form>
    </div>
</div>