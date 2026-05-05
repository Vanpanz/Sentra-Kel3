<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <form action="../../actions/login/login.php" method="POST">
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <a href="../register/register.php">Create an account</a>
        <button type="submit" name="login" class="btn">Login</button>
    </form>
</div>
</body>
</html>
