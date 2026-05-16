<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/db-connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ambil data form
    $title = mysqli_real_escape_string($connection, $_POST['title']);

    $content = mysqli_real_escape_string($connection, $_POST['content']);

    // ambil user login
    $user_id = $_SESSION['user']['id'];

    // default jika tidak ada gambar
    $image_path = null;

    // upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {

        // folder upload
        $target_dir = __DIR__ . '/../../public/assets/foto/';

        // buat folder jika belum ada
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // nama file unik
        $image_name = time() . "_" . basename($_FILES["gambar"]["name"]);

        // lokasi file
        $target_file = $target_dir . $image_name;

        // upload file
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {

            // path untuk database
            $image_path = "assets/foto/" . $image_name;
        }
    }

    // simpan postingan
    $sql = "INSERT INTO posts (title, content, user_id, image_path)
            VALUES ('$title', '$content', '$user_id', '$image_path')";

    // execute query
    if (mysqli_query($connection, $sql)) {

        header("Location: /homepage");
        exit;

    } else {

        echo "Gagal menyimpan postingan: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}