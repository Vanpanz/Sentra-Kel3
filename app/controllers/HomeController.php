<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Registration;

class HomeController extends Controller
{
    public function homepage()
    {
        $this->requireAuth();

        $this->view('home.homepage', [
            'title' => 'Sentra - Homepage',
            'bodyClass' => 'font-[\'Plus_Jakarta_Sans\'] bg-[#E0F7F1] text-[#2d3436] antialiased',
            'headContent' => '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">'
        ]);
    }

    public function faq()
    {
        $this->requireAuth();

        $this->view('home.faq', [
            'title' => 'Sentra - FAQ',
            'bodyClass' => 'font-[\'Plus_Jakarta_Sans\'] bg-[#E0F7F1] text-[#2d3436] antialiased',
            'headContent' => '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">'
        ]);
    }

    public function about()
    {
        $this->requireAuth();

        $this->view('home.about', [
            'title' => 'Sentra - About Us',
            'bodyClass' => 'font-[\'Plus_Jakarta_Sans\'] bg-[#E0F7F1] text-[#2d3436] antialiased',
            'headContent' => '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">'
        ]);
    }

    public function profile()
    {
        $this->requireAuth();

        $userId = (int) $_SESSION['user']['id'];
        $registrationModel = new Registration();
        $eventHistory = $registrationModel->listByUser($userId);
        
        // Fetch full user data including password for display
        $userModel = new \App\Models\User();
        $userData = $userModel->findById($userId);

        $this->view('home.profile', [
            'title' => 'Sentra - Profile',
            'bodyClass' => 'font-[\'Plus_Jakarta_Sans\'] bg-[#E0F7F1] text-[#2d3436] antialiased',
            'headContent' => '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">',
            'eventHistory' => $eventHistory,
            'userName' => $_SESSION['user']['name'] ?? 'User',
            'userEmail' => $_SESSION['user']['email'] ?? '',
            'userPassword' => $userData['password'] ?? '',
            'user' => $userData
        ]);
    }
}
