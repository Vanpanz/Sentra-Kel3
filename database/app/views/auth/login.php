<div class="bg-white auth-card flex max-w-[950px] w-full min-h-[600px] overflow-hidden flex-col-reverse md:flex-row">

    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">

        <h1 class="block md:hidden text-center mb-6">
            <label for="">
                <img src="/assets/foto/logo bs.png" alt="Logo" class="w-20 mx-auto">
            </label>
        </h1>

        <h3 class="text-4xl font-bold text-[#555555] text-center mb-8">
            Sign In
        </h3>

        <div class="container w-full">
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 text-red-600 font-bold text-sm px-4 py-3 rounded-xl mb-6">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form action="/login" method="POST" class="flex flex-col items-center w-full">

                <div class="form-group w-full max-w-[370px] mb-6">
                    <label for="" class="block text-[#555555] text-lg font-bold mb-2 ml-4">Email</label>
                    <input type="text" name="email"
                        class="form-control auth-input w-full h-[60px] bg-transparent px-6 outline-none text-lg text-gray-700"
                        required>
                </div>

                <div class="form-group w-full max-w-[370px] mb-4">
                    <label for="" class="block text-[#555555] text-lg font-bold mb-2 ml-4">Password</label>
                    <input type="password" name="password"
                        class="form-control auth-input w-full h-[60px] bg-transparent px-6 outline-none text-lg text-gray-700"
                        required>
                </div>

                <div class="w-full max-w-[370px] flex justify-between items-center text-xs text-black mb-8 px-2">
                    <a href="#" class="hover:underline">Forgot password?</a>
                    <div>
                        <span class="text-gray-600">Don't have an account? </span>
                        <a href="/register" class="text-[#00c3ff] font-medium hover:underline">Sign Up</a>
                    </div>
                </div>

                <button type="submit" name="login"
                    class="btn auth-button w-[160px] h-[45px] text-white font-bold text-lg hover:opacity-90 transition-all duration-200">
                    Sign in
                </button>
            </form>
        </div>
    </div>

    <div class="w-full md:w-1/2 bg-[#61c3ae] flex items-center justify-center p-8 md:p-12">
        <h2
            class="w-[180px] h-[180px] md:w-[280px] md:h-[280px] bg-white rounded-full flex items-center justify-center shadow-lg overflow-hidden">
            <img src="/assets/foto/logo bs.png" alt="Logo" class="w-full h-full object-cover p-4">
        </h2>
    </div>

</div>