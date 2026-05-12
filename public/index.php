<?php
require_once '../app/core/Router.php';
 
use App\Core\Router;
 
$router = new Router();
 
//Register Routes
$router->add('GET', '/students', 'StudentsController', 'index');
 
$router->add('GET', '/students/login', 'StudentsController', 'login');
$router->add('GET', '/students/register', 'StudentsController', 'register');
$router->add('GET', '/event/details', 'StudentsController', 'show');
 
 
$router->add('POST', '/students/login', 'StudentsController', 'loginProcess');
$router->add('POST', '/students/register', 'StudentsController', 'registerProcess');
// $router->add('GET', '/students/create', 'StudentController', 'create');
// $router->add('GET', '/students/{id}', 'StudentController', 'show');
// $router->add('GET', '/students/{id}/edit', 'StudentController', 'edit');
 
// $router->add('POST', '/students', 'StudentController', 'store');
// $router->add('PUT', '/students/{id}', 'StudentController', 'update');
// $router->add('DELETE', '/students/{id}', 'StudentController', 'destroy');
 
 
$router->run();
 
 