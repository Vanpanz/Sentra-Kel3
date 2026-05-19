<?php
require_once '../app/core/Router.php';
 
use App\Core\Router;
 
$router = new Router();
 
//Register Routes
$router->add('GET', '/homepage', 'StudentsController', 'index');
 
$router->add('GET', '/login', 'StudentsController', 'login');
$router->add('GET', '/register', 'StudentsController', 'register');
$router->add('GET', '/event/details', 'StudentsController', 'show');
$router->add('GET', '/about-us', 'StudentsController', 'about');
$router->add('GET', '/profile', 'StudentsController', 'profile');
$router->add('GET', '/create', 'StudentsController', 'create');

// 🛠️ FIX UTAMA: /edit harus GET agar tombol dari detail bisa diklik dan dibuka lewat URL
$router->add('GET', '/edit', 'StudentsController', 'edit');

// 🛠️ KEMBALIKAN KE POST: Sesuai dengan setelan awalmu agar halaman detail tidak kosong lagi
$router->add('POST', '/detail', 'StudentsController', 'detail');

$router->add('POST', '/login', 'StudentsController', 'loginProcess');
$router->add('POST', '/register', 'StudentsController', 'registerProcess');
$router->add('POST', '/create-event', 'StudentsController', 'createProcess');
$router->add('POST', '/update-event', 'StudentsController', 'updateProcess');
$router->add('POST', '/delete-event', 'StudentsController', 'deleteProcess');
 
$router->run();