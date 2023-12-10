<?php
class Router
{
    private static $routes = [];


    public static function match($type, $path, $controller, $method)
    {
        self::$routes[] = [
            'type' => $type,
            'path' => $path,
            'controller' => $controller,
            'method' => $method,
        ];
    }

    public static function get($path, $controller, $method)
    {
        self::match('GET', $path, $controller, $method);
    }

    public static function POST($path, $controller, $method)
    {
        self::match('POST', $path, $controller, $method);
    }

    function __construct()
    {
        $url = '/' . trim($_GET['url'] ?? '', '/');

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {

            $quoted = preg_quote($route['path'], '/');
            $pattern = preg_replace('/\\\{[A-Za-z0-9_\-]+\\\}/', '(.+)', $quoted);
            if ($method === $route['type'] && preg_match('/^' . $pattern . '$/', $url, $matches)) {

                require 'Controller/' . $route['controller'] . 'Controller.php';

                $class_name = $route['controller'] . 'Controller';


                if (class_exists($class_name)) {
                    $c = new $class_name;
                    $c->{$route['method']}(...array_slice($matches, 1));
                }

                exit;
            }
        }

        http_response_code(404);
        exit;
    }
}
