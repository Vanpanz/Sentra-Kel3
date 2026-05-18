<?php

session_start();

// Memanggil file koneksi database di dalam folder app/config/
require_once __DIR__ . '/../../app/config/db-connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validasi field kosong
    if (
        empty($name) ||
        empty($email) ||
        empty($password) ||
        empty($confirmPassword)
    ) {
        echo "
        <script>
            alert('Semua field wajib diisi!');
            history.back();
        </script>
        ";
        exit();
    }

    // Validasi password
    if ($password !== $confirmPassword) {
        echo "
        <script>
            alert('Password tidak sama!');
            history.back();
        </script>
        ";
        exit();
    }

    // Cek email sudah ada
    $checkQuery = "SELECT id FROM users WHERE email = ?";

    $checkStmt = $connection->prepare($checkQuery);

    if (!$checkStmt) {
        die("Query Error: " . $connection->error);
    }

    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "
        <script>
            alert('Email sudah digunakan!');
            history.back();
        </script>
        ";
        exit();
    }

    // Hash password
    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    // Insert user
    $query = "
        INSERT INTO users
        (name, email, password)
        VALUES (?, ?, ?)
    ";

    $stmt = $connection->prepare($query);

    if (!$stmt) {
        die("Insert Error: " . $connection->error);
    }

    $stmt->bind_param(
        "sss",
        $name,
        $email,
        $hashedPassword
    );

    // Execute
    if ($stmt->execute()) {

        // PERBAIKAN DI SINI: Ambil ID user yang baru saja digenerate oleh database
        $userId = $connection->insert_id;

        // Simpan ke session lengkap dengan struktur array ['user']['id']
        $_SESSION['user'] = [
            'id'    => $userId,
            'name'  => $name,
            'email' => $email
        ];

        // Jika berhasil, diarahkan ke dashboard utama kamu
        header("Location: /homepage");
        exit();

    } else {
        echo "
        <script>
            alert('Register gagal!');
            history.back();
        </script>
        ";
    }

    $stmt->close();

} else {
    header("Location: /register");
    exit();
}
?>