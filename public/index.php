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
$router->add('GET', '/faq', 'StudentsController', 'faq');
 
$router->add('POST', '/login', 'StudentsController', 'loginProcess');
$router->add('POST', '/register', 'StudentsController', 'registerProcess');
// $router->add('GET', '/students/create', 'StudentController', 'create');
// $router->add('GET', '/students/{id}', 'StudentController', 'show');
// $router->add('GET', '/students/{id}/edit', 'StudentController', 'edit');
 
// $router->add('POST', '/students', 'StudentController', 'store');
// $router->add('PUT', '/students/{id}', 'StudentController', 'update');
// $router->add('DELETE', '/students/{id}', 'StudentController', 'destroy');
 
 
$router->run();
 
 