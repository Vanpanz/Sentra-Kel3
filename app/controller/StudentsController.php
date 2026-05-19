<?php

namespace App\Controllers;

class StudentsController {

    // homepage
    public function index() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!defined('BASEURL')) {
            define('BASEURL', 'http://localhost:3000');
        }

        $userName = $_SESSION['user']['name'] ?? 'Admin';

        $sidebarPath = __DIR__ . '/../models/sidebar.php';

        require_once __DIR__ . '/../views/home/homepage_view.php';
    }

    // login page
    public function login() {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    // login process
    public function loginProcess() {
        require_once __DIR__ . '/../models/login.php';
    }

    // register page
    public function register() {
        require_once __DIR__ . '/../views/auth/register.php';
    }

    // register process
    public function registerProcess() {
        require_once __DIR__ . '/../models/register.php';
    }

    // detail event
    public function show() {
        require_once __DIR__ . '/../views/event/detailevent.php';
    }

    // about page
    public function about() {
        require_once __DIR__ . '/../views/home/about.php';
    }

    // profile page
    public function profile() {
        require_once __DIR__ . '/../views/home/profile.php';
    }

    // create page
    public function create() {
        require_once __DIR__ . '/../views/home/create.php';
    }

    // create process
    public function createProcess() {
        require_once __DIR__ . '/../models/create.php';
    }



   public function detail() {
        require_once __DIR__ . '/../views/home/detail_view.php';
    }


    public function edit() {
        require_once __DIR__ . '/../views/home/edit_view.php';
    }

    public function updateProcess() {
        require_once __DIR__ . '/../models/update.php';
    }

    public function deleteProcess() {
        require_once __DIR__ . '/../models/delete.php';
    }

    

}
?>