
<div class="bg-white auth-card flex max-w-[950px] w-full min-h-[650px] overflow-hidden flex-col-reverse md:flex-row">
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
        <h1 class="block md:hidden text-center mb-4">
            <label for="">
                <img src="../../../assets/foto/sentraasli(1).png" alt="Logo" class="w-20 mx-auto">
            </label>
        </h1>
        <h3 class="text-4xl font-bold text-[#555555] text-center mb-6">
            Sign Up
        </h3>
        <div class="container w-full">
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 text-red-600 font-bold text-sm px-4 py-3 rounded-xl mb-6">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form action="/register" method="POST" class="flex flex-col items-center w-full">
                <div class="form-group w-full max-w-[370px] mb-4">
                    <label for="" class="block text-[#555555] text-base font-bold mb-1 ml-4">Name</label>
                    <input type="text" name="name"
                        class="form-control auth-input w-full h-[50px] bg-transparent px-6 outline-none text-base text-gray-700"
                        required>
                </div>
                <div class="form-group w-full max-w-[370px] mb-4">
                    <label class="block text-[#555555] text-base font-bold mb-1 ml-4">Email</label>
                    <input type="email" name="email"
                        class="form-control auth-input w-full h-[50px] bg-transparent px-6 outline-none text-base text-gray-700"
                        required>
                </div>
                <div class="form-group w-full max-w-[370px] mb-4">
                    <label class="block text-[#555555] text-base font-bold mb-1 ml-4">Password</label>
                    <input type="password" name="password"
                        class="form-control auth-input w-full h-[50px] bg-transparent px-6 outline-none text-base text-gray-700"
                        required>
                </div>
                <div class="form-group w-full max-w-[370px] mb-4">
                    <label class="block text-[#555555] text-base font-bold mb-1 ml-4">Confirm Password</label>
                    <input type="password" name="confirm_password"
                        class="form-control auth-input w-full h-[50px] bg-transparent px-6 outline-none text-base text-gray-700"
                        required>
                </div>
                <div class="w-full max-w-[370px] flex justify-between items-center text-xs text-black mb-6 px-2">
                    <a href="#" onclick="alert('YAHAHAHA ingat sendiri dong'); return false;" class="hover:underline text-gray-600">Forgot password?</a>
                    <div>
                        <span class="text-gray-600">Already have an account? </span>
                        <a href="/login" class="text-[#00c3ff] font-medium hover:underline">Sign In</a>
                    </div>
                </div>
                <button type="submit" name="store"
                    class="btn auth-button w-[160px] h-[45px] text-white font-bold text-lg hover:opacity-90 transition-all duration-200">
                    Sign Up
                </button>
            </form>
        </div>
    </div>
    <div class="w-full md:w-1/2 bg-[#61c3ae] flex items-center justify-center p-8 md:p-12">
        <h2
            class="w-[180px] h-[180px] md:w-[280px] md:h-[280px] bg-white rounded-full flex items-center justify-center shadow-lg overflow-hidden">
            <img src="../../../assets/foto/sentraasli(1).png" alt="Logo" class="w-full h-full object-cover p-4">
        </h2>
    </div>
</div>
