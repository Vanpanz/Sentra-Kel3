<?php

namespace App\Core;

// Hapus baris "use App\Controllers\StudentController;" di sini karena controller 
// akan dipanggil secara dinamis di bawah.

class Router
{
    private array $routes = [];

    public function add(string $method, string $uri, string $controller, string $function)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'function' => $function,
        ];
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            $pattern = str_replace(
                '{id}',
                '([0-9]+)',
                $route['uri']
            );

            $pattern = '#^' . $pattern . '$#';

            if ($method === $route['method'] && preg_match($pattern, $uri, $matches)) {
                
                // PERBAIKAN 1: Folder Anda bernama 'controller', bukan 'controllers'
                require_once '../app/controller/' . $route['controller'] . '.php';
                
                array_shift($matches);
                
                // PERBAIKAN 2: Pastikan namespace sesuai dengan folder
                $controllerClass = 'App\\Controllers\\' . $route['controller'];
                
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                    $function = $route['function'];
                    call_user_func_array([$controller, $function], $matches);
                    return;
                }
            }
        }

        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
    }
}