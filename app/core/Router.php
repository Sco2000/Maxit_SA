<?php

namespace App\core;

class Router
{
    public static function resolveRoute(array $routes): void{
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if(array_key_exists($uri, $routes)){
            if(isset($routes[$uri]['middleware'])){
                Middlewares::execute($routes[$uri]['middleware']);
            }
            $controllerName = $routes[$uri]['controller'];
            $methodName = $routes[$uri]['method'];
            $controller = new $controllerName();
            $controller->$methodName();
        }
        else{
            echo "404";
        }
    }
}