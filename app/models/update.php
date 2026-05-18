<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hubungkan ke database
require_once __DIR__ . '/../config/db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $content = mysqli_real_escape_string($connection, $_POST['content']);

    // 🛠️ BYPASS: Langsung ambil data berdasarkan ID event tanpa cek user_id
    $checkQuery = mysqli_query($connection, "SELECT image_path FROM posts WHERE id = $id");
    
    if (mysqli_num_rows($checkQuery) === 0) {
        die("Event tidak ditemukan di database.");
    }
    
    $currentPost = mysqli_fetch_assoc($checkQuery);
    $image_path = $currentPost['image_path']; 

    // Proses unggah file banner baru jika ada
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        
        $uploadFileDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }
        
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            if (!empty($currentPost['image_path']) && file_exists(__DIR__ . '/../../public/' . $currentPost['image_path'])) {
                unlink(__DIR__ . '/../../public/' . $currentPost['image_path']);
            }
            $image_path = 'uploads/' . $newFileName;
        }
    }

    // 🛠️ BYPASS: Query UPDATE diubah agar hanya mencari berdasarkan ID saja
    $sql = "UPDATE posts SET title = '$title', content = '$content', image_path = '$image_path' WHERE id = $id";

    if (mysqli_query($connection, $sql)) {
        header("Location: /homepage");
        exit();
    } else {
        die("Gagal memperbarui data: " . mysqli_error($connection));
    }
} else {
    die("Akses langsung dilarang.");
}