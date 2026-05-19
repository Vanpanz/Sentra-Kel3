<?php
require_once '../app/core/Router.php';
 
use App\Core\Router;
 
$router = new Router();

// ==========================================================================
// PUBLIC ROUTES
// ==========================================================================

// Homepage - Daftar Event
$router->add('GET', '/', 'EventController', 'index');
$router->add('GET', '/homepage', 'EventController', 'index');

// Authentication
$router->add('GET', '/login', 'EventController', 'login');
$router->add('POST', '/login', 'EventController', 'loginProcess');
$router->add('GET', '/register', 'EventController', 'register_page');
$router->add('POST', '/register', 'EventController', 'registerProcess');
$router->add('GET', '/logout', 'EventController', 'logout');

// Info Pages
$router->add('GET', '/about', 'EventController', 'about');
$router->add('GET', '/about-us', 'EventController', 'about');

// Search
$router->add('GET', '/search', 'EventController', 'search');

// ==========================================================================
// USER ROUTES
// ==========================================================================

// Profile
$router->add('GET', '/profile', 'EventController', 'profile');

// Event Details & Registration
$router->add('GET', '/events/{id}', 'EventController', 'show');
$router->add('GET', '/event/{id}', 'EventController', 'show');
$router->add('POST', '/event/{id}/register', 'EventController', 'register');
$router->add('POST', '/registration/{id}/cancel', 'EventController', 'cancelRegistration');

// ==========================================================================
// ADMIN ROUTES - EVENT MANAGEMENT
// ==========================================================================

// Create Event
$router->add('GET', '/event/create', 'EventController', 'create');
$router->add('POST', '/event/store', 'EventController', 'store');

// Edit Event
$router->add('GET', '/event/{id}/edit', 'EventController', 'edit');
$router->add('POST', '/event/{id}/update', 'EventController', 'update');

// Delete Event
$router->add('POST', '/event/{id}/delete', 'EventController', 'destroy');

// Registration Management
$router->add('GET', '/event/{id}/registrations', 'EventController', 'registrations');
$router->add('POST', '/registration/{id}/update', 'EventController', 'updateRegistration');

// ==========================================================================
// Legacy Routes (untuk backward compatibility)
// ==========================================================================
$router->add('GET', '/create', 'EventController', 'create');
$router->add('POST', '/create-event', 'EventController', 'store');
$router->add('GET', '/event/details', 'EventController', 'show');
$router->add('POST', '/detail', 'EventController', 'show');

$router->run();