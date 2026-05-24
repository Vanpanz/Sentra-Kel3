<?php
namespace App\Core;

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
        if ($method === "POST" && isset($_POST['_method'])) {
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
            // /students/{id} => /students/#^([0-9]+)$# = /students/1

            if (preg_match($pattern, $uri, $matches) && $method === $route['method']) {
                array_shift($matches);
                $controllerClass = 'App\\Controllers\\' . $route['controller'];
                if (!class_exists($controllerClass)) {
                    http_response_code(500);
                    echo '<h1>500 - Controller Not Found</h1>';
                    return;
                }
                $controller = new $controllerClass();
                $function = $route['function'];

                if (!method_exists($controller, $function)) {
                    http_response_code(500);
                    echo '<h1>500 - Method Not Found</h1>';
                    return;
                }

                call_user_func_array([$controller, $function], $matches);
                return;
            }

        }

        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
    }

}

?>