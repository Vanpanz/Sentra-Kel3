<?php

session_start();

require_once __DIR__ . '/../config/db-connnection.php';

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

        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email
        ];

        header("Location: /students");

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

    header("Location: /students/register");

    exit();
}
?>