<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hubungkan ke database (mundur 1 folder ke app/config)
require_once __DIR__ . '/../config/db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    if ($id <= 0) {
        die("ID Event tidak valid.");
    }

    // 1. Cari data gambar banner lama untuk dihapus dari server fisik
    $imageQuery = mysqli_query($connection, "SELECT image_path FROM posts WHERE id = $id");
    if (mysqli_num_rows($imageQuery) > 0) {
        $postData = mysqli_fetch_assoc($imageQuery);
        $oldImagePath = __DIR__ . '/../../public/' . $postData['image_path'];
        
        // Hapus file dari folder jika filenya beneran ada
        if (!empty($postData['image_path']) && file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
    }

    // 2. Eksekusi query DELETE untuk menghapus data dari tabel MySQL
    $deleteSql = "DELETE FROM posts WHERE id = $id";

    if (mysqli_query($connection, $deleteSql)) {
        // Jika sukses hapus, tendang balik ke homepage
        header("Location: /homepage");
        exit();
    } else {
        die("Gagal menghapus event: " . mysqli_error($connection));
    }
} else {
    die("Akses langsung dilarang.");
}