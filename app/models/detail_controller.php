<?php
// Aktifkan pelaporan error agar jika ada yang salah, kelihatan di layar (tidak putih polos)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Cek apakah file database benar-benar ada sebelum di-require
$dbPath = __DIR__ . '/../config/db-connection.php';
if (!file_exists($dbPath)) {
    die("Gagal memuat database! File tidak ditemukan di: " . realpath(__DIR__ . '/../') . '/config/db-connection.php');
}
require_once $dbPath;

// 2. Menangkap ID yang dikirim lewat parameter URL (GET) atau REQUEST
if (!isset($_GET['id']) && !isset($_POST['id'])) {
    die("ID Event tidak ditemukan di URL. Pastikan linknya berbentuk /detail?id=ANGKA");
}

$id = isset($_GET['id']) ? intval($_GET['id']) : intval($_POST['id']);

if ($id <= 0) {
    die("ID Event tidak valid!");
}

// 3. Ambil data postingan utuh dari database
$query = mysqli_query($connection, "SELECT * FROM posts WHERE id = $id");

if (!$query) {
    die("Query Database Error: " . mysqli_error($connection));
}

if (mysqli_num_rows($query) == 0) {
    die("Post dengan ID " . $id . " tidak ditemukan di database.");
}

$post = mysqli_fetch_assoc($query);

// Data siap dilempar ke file detail_view.php via variabel $post