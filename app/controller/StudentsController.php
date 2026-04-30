<?php
namespace App\Controllers;

class StudentsController {

    public function index() {
        require_once '../app/views/auth/login.php';
    }

    public function show() {
        require_once '../app/views/event/detailevent.php';
    }

}
