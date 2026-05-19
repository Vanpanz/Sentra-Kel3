<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Ambil database dari global controller
global $db, $conn;
$database = $db ?? $conn;

// Jika ternyata masih null, buatkan koneksi emergency langsung ke Laragon MySQL
if ($database === null) {
    try {
        $database = new PDO("mysql:host=localhost;dbname=sentra;charset=utf8mb4", "root", "", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        die("Koneksi database gagal: " . $e->getMessage());
    }
}

// Ambil ID Event dari URL
$id = $_GET['id'] ?? 1;

// 2. LOGIC PROSES PENDAFTARAN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register_event') {
    // Menangkap data post_id dari form
    $post_id = $_POST['post_id'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $phone_number = $_POST['phone_number'];
    $user_id = $_SESSION['user']['id'] ?? 1;

    // Disini query INSERT juga disesuaikan menggunakan event_id
    $stmtInsert = $database->prepare("INSERT INTO registrations (event_id, user_id, name, class, phone_number) VALUES (?, ?, ?, ?, ?)");
    $stmtInsert->execute([$post_id, $user_id, $name, $class, $phone_number]);

    header("Location: /detail?id=" . $post_id);
    exit;
}

// 3. AMBIL DATA EVENT UTAMA
$stmtPost = $database->prepare("SELECT * FROM posts WHERE id = ?");
$stmtPost->execute([$id]);
$post = $stmtPost->fetch();

// 4. AMBIL DATA LIST PESERTA UNTUK TABEL (Menggunakan event_id sesuai struktur tabelmu)
$stmtParticipants = $database->prepare("SELECT * FROM registrations WHERE event_id = ? ORDER BY id DESC");
$stmtParticipants->execute([$id]);
$participants = $stmtParticipants->fetchAll();