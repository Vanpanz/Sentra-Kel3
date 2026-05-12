<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="/resources/css/input.css">

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register</title>

</head>

<body>

    <h1>
        <img src="/foto/logo bs.png" alt="">
    </h1>

    <h2>
        <img src="/foto/logo bs.png" alt="">
    </h2>

    <h3>
        Register
    </h3>

    <div class="container">

        <form action="/students/register"
              method="POST">

            <div class="form-group">
                <label>Name</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       required>
            </div>

            <div class="form-group">
                <label>Email</label>

                <input type="email"
                       name="email"
                       class="form-control"
                       required>
            </div>

            <div class="form-group">
                <label>Password</label>

                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>

                <input type="password"
                       name="confirm_password"
                       class="form-control"
                       required>
            </div>

            <a href="/students/login">
                Already have account?
            </a>

            <button type="submit"
                    class="btn">

                Create Account

            </button>

        </form>

    </div>

</body>
</html>