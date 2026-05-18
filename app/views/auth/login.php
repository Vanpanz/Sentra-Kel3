<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Login</title>
</head>

<body class="bg-[#d8ebe7] min-h-screen flex items-center justify-center overflow-hidden">

  <!-- Text kiri atas -->
  <div class="absolute top-3 left-5 text-sky-500 text-xl font-medium">
    Sign In
  </div>

  <!-- Card -->
  <div class="w-[950px] h-[640px] bg-[#ededed] rounded-[30px] shadow-[8px_8px_10px_rgba(0,0,0,0.35)] overflow-hidden flex">

    <!-- LEFT -->
    <div class="w-1/2 bg-[#ededed] flex flex-col items-center pt-16">

      <!-- Title -->
      <h1 class="text-[55px] font-extrabold text-gray-600 mb-8">
        Sign In
      </h1>

      <!-- FORM -->
      <form action="//students/login" method="POST" class="w-full flex flex-col items-center">

        <!-- EMAIL -->
        <div class="w-[370px] mb-7">
          <label class="block text-gray-600 text-[20px] font-semibold mb-2">
            Email
          </label>

          <input
            type="email"
            name="email"
            required
            class="w-full h-[60px] rounded-full border-2 border-[#61c3ae] bg-transparent px-6 outline-none text-lg"
          />
        </div>

        <!-- PASSWORD -->
        <div class="w-[370px] mb-4">
          <label class="block text-gray-600 text-[20px] font-semibold mb-2">
            Password
          </label>

          <input
            type="password"
            name="password"
            required
            class="w-full h-[60px] rounded-full border-2 border-[#61c3ae] bg-transparent px-6 outline-none text-lg"
          />
        </div>

        <!-- Links -->
        <div class="w-[370px] flex justify-between text-[15px] mb-7">
          <a href="#" class="text-black hover:underline">
            Forgot password?
          </a>

          <p>
            Don't have an account?
            <a href="/students/register" class="text-sky-500 hover:underline">
              Sign Up
            </a>
          </p>
        </div>

        <!-- BUTTON -->
        <button
          type="submit"
          class="w-[145px] h-[52px] rounded-full bg-[#61c3ae] text-white text-[32px] font-bold shadow-[0_8px_10px_rgba(97,195,174,0.8)] hover:scale-105 duration-200"
        >
          Sign in
        </button>

      </form>
    </div>

    <!-- RIGHT -->
    <div class="w-1/2 bg-gradient-to-br from-[#5ec0a8] to-[#c5e2db] flex items-center justify-center">

      <!-- Circle -->
      <div class="w-[320px] h-[320px] bg-white rounded-full flex items-center justify-center shadow-lg">

        <img
          src="/foto/logo bs.png"
          alt="logo"
          class="w-[240px] h-[240px] object-contain"
        />

      </div>

    </div>

  </div>

=======
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body class="bg-[#e6fbf7] min-h-screen flex items-center justify-center font-sans p-4">

    <div class="bg-white rounded-[30px] shadow-2xl flex max-w-[950px] w-full min-h-[600px] overflow-hidden flex-col-reverse md:flex-row">
        
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
                <form action="/login" method="POST" class="flex flex-col items-center w-full">
                    
                    <div class="form-group w-full max-w-[370px] mb-6">
                        <label for="" class="block text-[#555555] text-lg font-bold mb-2 ml-4">Email</label>
                        <input type="text" name="email" class="form-control w-full h-[60px] rounded-full border-2 border-[#61c3ae] bg-transparent px-6 outline-none text-lg text-gray-700" required>
                    </div>
                    
                    <div class="form-group w-full max-w-[370px] mb-4">
                        <label for="" class="block text-[#555555] text-lg font-bold mb-2 ml-4">Password</label>
                        <input type="password" name="password" class="form-control w-full h-[60px] rounded-full border-2 border-[#61c3ae] bg-transparent px-6 outline-none text-lg text-gray-700" required>
                    </div>
                    
                    <div class="w-full max-w-[370px] flex justify-between items-center text-xs text-black mb-8 px-2">
                        <a href="#" class="hover:underline">Forgot password?</a>
                        <div>
                            <span class="text-gray-600">Don't have an account? </span>
                            <a href="/register" class="text-[#00c3ff] font-medium hover:underline">Sign Up</a>
                        </div>
                    </div>

                    <button type="submit" name="login" class="btn w-[160px] h-[45px] text-white font-bold text-lg rounded-full bg-gradient-to-b from-[#69cbbf] to-[#4fae9e] shadow-[0_4px_10px_rgba(79,174,158,0.4)] hover:opacity-90 transition-all duration-200">
                        Sign in
                    </button>
                </form>`
            </div>
        </div>

        <div class="w-full md:w-1/2 bg-[#61c3ae] flex items-center justify-center p-8 md:p-12">
            <h2 class="w-[180px] h-[180px] md:w-[280px] md:h-[280px] bg-white rounded-full flex items-center justify-center shadow-lg overflow-hidden">
                <img src="/assets/foto/logo bs.png" alt="Logo" class="w-full h-full object-cover p-4">
            </h2>
        </div>

    </div>

>>>>>>> louis/implement-login
</body>
</html>