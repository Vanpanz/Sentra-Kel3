<?php
namespace App\Controllers;

class StudentsController {

    public function index() {
        require_once '../app/views/home/homepage.php';
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

}
?>
