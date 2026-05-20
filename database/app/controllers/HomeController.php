<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
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

        $this->view('home.profile', [
            'title' => 'Sentra - Profile',
            'bodyClass' => 'font-[\'Plus_Jakarta_Sans\'] bg-[#E0F7F1] text-[#2d3436] antialiased',
            'headContent' => '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">'
        ]);
    }
}
