<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Panggil koneksi database
require_once __DIR__ . '/../../config/db-connection.php';

// 2. Proteksi Sesi: Jika belum login, tendang ke halaman login
if (!isset($_SESSION['user']['id'])) {
    header("Location: /login");
    exit();
}

// 3. Validasi parameter ID event yang dikirim lewat URL (?id=...)
if (!isset($_GET['id'])) {
    die("ID Event tidak ditentukan.");
}

$id = intval($_GET['id']);
$user_id = $_SESSION['user']['id'];

// 4. Ambil data event lama dari database
// Kunci query dengan user_id supaya user lain tidak bisa edit lewat ganti ID di URL
$query = mysqli_query($connection, "SELECT * FROM posts WHERE id = $id AND user_id = $user_id");

if (mysqli_num_rows($query) == 0) {
    die("Event tidak ditemukan atau Anda tidak memiliki akses untuk mengedit event ini.");
}

$post = mysqli_fetch_assoc($query);

// Data disimpan di variabel $post, sekarang siap dikirim dan ditampilkan ke file Frontend di bawah