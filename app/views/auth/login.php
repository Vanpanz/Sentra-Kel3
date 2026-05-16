<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />

  <meta name="viewport"
        content="width=device-width, initial-scale=1.0"/>

  <script src="https://cdn.tailwindcss.com"></script>

  <title>Login</title>

</head>
<body>
    <!-- Logo -->
     <h1>
        <label for="">
            <img src="/foto/logo bs.png" alt="">
        </label>
     </h1>
 
     <!-- Logo Tengah -->
    <h2>
        <img src="/foto/logo bs.png" alt="">
    </h2>
 
    <!-- Login Text -->
    <h3>
        Login
    </h3>
 
    <!-- Format Buat Login -->
   <div class="container">
    <form action="/login" method="POST">
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" class="form-control" required>
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
        <a href="/register">Create an account</a>
        <button type="submit" name="login" class="btn">Login</button>
    </form>
</div>
</body>
</html>