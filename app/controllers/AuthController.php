<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        $this->view('auth.login', [
            'title' => 'Login',
            'bodyClass' => 'bg-[#e6fbf7] min-h-screen flex items-center justify-center font-sans p-4'
        ], 'layouts.auth');
    }

    public function login()
    {
        $this->ensureSession();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            $this->view('auth.login', [
                'title' => 'Login',
                'error' => 'Email dan password wajib diisi.',
                'bodyClass' => 'bg-[#e6fbf7] min-h-screen flex items-center justify-center font-sans p-4'
            ], 'layouts.auth');
            return;
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $this->view('auth.login', [
                'title' => 'Login',
                'error' => 'Email atau password salah.',
                'bodyClass' => 'bg-[#e6fbf7] min-h-screen flex items-center justify-center font-sans p-4'
            ], 'layouts.auth');
            return;
        }

        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        $this->redirect('/events');
    }

    public function showRegister()
    {
        $this->view('auth.register', [
            'title' => 'Register',
            'bodyClass' => 'bg-[#e6fbf7] min-h-screen flex items-center justify-center font-sans p-4'
        ], 'layouts.auth');
    }

    public function register()
    {
        $this->ensureSession();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register');
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($name === '' || $email === '' || $password === '' || $confirm === '') {
            $this->view('auth.register', [
                'title' => 'Register',
                'error' => 'Semua field wajib diisi.',
                'bodyClass' => 'bg-[#e6fbf7] min-h-screen flex items-center justify-center font-sans p-4'
            ], 'layouts.auth');
            return;
        }

        if ($password !== $confirm) {
            $this->view('auth.register', [
                'title' => 'Register',
                'error' => 'Password tidak sama.',
                'bodyClass' => 'bg-[#e6fbf7] min-h-screen flex items-center justify-center font-sans p-4'
            ], 'layouts.auth');
            return;
        }

        $userModel = new User();

        if ($userModel->findByEmail($email)) {
            $this->view('auth.register', [
                'title' => 'Register',
                'error' => 'Email sudah digunakan.',
                'bodyClass' => 'bg-[#e6fbf7] min-h-screen flex items-center justify-center font-sans p-4'
            ], 'layouts.auth');
            return;
        }

        $userId = $userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'participant'
        ]);

        $_SESSION['user'] = [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'role' => 'participant'
        ];

        $this->redirect('/events');
    }

    public function logout()
    {
        $this->ensureSession();
        $_SESSION = [];
        session_destroy();

        $this->redirect('/login');
    }
}
