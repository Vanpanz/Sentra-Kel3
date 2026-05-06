<?php
 
$host = "localhost";
$username = "root";
$password = "";
$database = "sentra";
 
$conn = mysqli_connect($host, $username, $password, $database);
 
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
 
session_start();
 
if (isset($_POST['login'])) {
    // Ambil inputan user
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    // Query untuk mencari user berdasarkan email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
 
    // Ambil hasilnya
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
 
    // Cek apakah pengguna ada
    if ($user) {
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Jika cocok
            session_regenerate_id(true);
            $_SESSION['user'] = $user;
 
            // Redirect ke dashboard
            header('Location: ../../app/views/home/homepage.php');
            exit;
        } else {
            // Jika password salah
            echo "
                <script>
                    alert('Email atau password salah!');
                    window.location.href = '../../app/views/login/login.php';
                </script>
            ";
        }
    } else {
        // Jika pengguna tidak ditemukan
        echo "
            <script>
                alert('Email atau password salah!');
                window.location.href = '../../app/views/login/login.php';
            </script>
        ";
    }
}
?>