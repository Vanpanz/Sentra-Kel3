<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../register.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    <!-- Regis Text -->
    <h3>
        Register
    </h3>

    <!-- Format Buat Register -->
   <div class="container">
        <form action="../../actions/register/register.php" method="POST">
            <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <a href="../login/login.php">Already have account?</a>
            <button type="submit" name="store" class="btn">Create Account</button>
        </form>
    </div>
</body>
</html>