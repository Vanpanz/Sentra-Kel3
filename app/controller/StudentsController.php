<?php
namespace App\Controllers;

class StudentsController {

    public function index() {
        // 1. Pastikan session berjalan agar bisa ambil nama user
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 2. Pastikan BASEURL aman
        if (!defined('BASEURL')) {
            define('BASEURL', 'http://localhost:3000');
        }

        // 3. Siapkan data yang akan dikirim ke layar (View)
        $userName = $_SESSION['user']['name'] ?? 'Admin';
        
        // 4. Siapkan jalur Sidebar (menuju folder models tempat Louis menaruhnya)
        // Pakai __DIR__ agar jalurnya absolut dan anti-error
        $sidebarPath = __DIR__ . '/../models/sidebar.php';

        // 5. Panggil file layarnya (View)
        require_once __DIR__ . '/../views/home/homepage_view.php';
    }

    // halaman login
    public function login() {
        require_once '../app/views/auth/login.php';
    }

    // proses login
    public function loginProcess() {
        require_once '../app/models/login.php';
    }

    // halaman register
    public function register() {
        require_once '../app/views/auth/register.php';
    }

    // proses register
    public function registerProcess() {
        require_once '../app/models/register.php';
    }
        
    public function show() {
        require_once '../app/views/event/detailevent.php';
    }


    public function about() {
        require_once '../app/views/home/about.php';
    }

    public function faq() {
        require_once '../app/views/home/faq.php';
    }


}
?>