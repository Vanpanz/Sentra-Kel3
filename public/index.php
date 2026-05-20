<?php
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        include $file;
    }
});

use App\Core\Router;

$router = new Router();

// Auth
$router->add('GET', '/login', 'AuthController', 'showLogin');
$router->add('POST', '/login', 'AuthController', 'login');
$router->add('GET', '/register', 'AuthController', 'showRegister');
$router->add('POST', '/register', 'AuthController', 'register');
$router->add('POST', '/logout', 'AuthController', 'logout');

// Pages
$router->add('GET', '/', 'EventController', 'index');
$router->add('GET', '/homepage', 'HomeController', 'homepage');
$router->add('GET', '/faq', 'HomeController', 'faq');
$router->add('GET', '/about-us', 'HomeController', 'about');
$router->add('GET', '/profile', 'HomeController', 'profile');

// Events (RESTful)
$router->add('GET', '/events', 'EventController', 'index');
$router->add('GET', '/events/create', 'EventController', 'create');
$router->add('POST', '/events', 'EventController', 'store');
$router->add('GET', '/events/{id}', 'EventController', 'show');
$router->add('GET', '/events/{id}/edit', 'EventController', 'edit');
$router->add('POST', '/events/{id}/register', 'EventController', 'register');
$router->add('POST', '/events/{id}/update-status', 'EventController', 'updateEventStatus');
$router->add('POST', '/events/{id}/participants/{registrationId}/update-status', 'EventController', 'updateParticipantStatus');
$router->add('PUT', '/events/{id}', 'EventController', 'update');
$router->add('DELETE', '/events/{id}', 'EventController', 'destroy');

$router->run();