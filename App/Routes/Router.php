<?php

namespace App\Routes;

use App\Http\Response;
use App\Http\Request;
use App\Middleware\Middlewares;

class Router
{
    public static function dispatch(array $routes)
    {
        $url = '/';

        isset($_GET['url']) && $url .= $_GET['url'];

        $url != '/' && $url = rtrim($url, '/');

        $prefixControllers = [
            'App\Controllers\\', 
            'App\Controllers\Public\\'];

        $routeFound = false;

        foreach ($routes as $route) {

           $pattern = '#^'.preg_replace('/{number}/', '([\w-]+)', $route['path']).'$#';

            if(preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                $routeFound = true;

                 // Verificar e executar os middlewares
                 foreach ($route['middlewares'] as $middleware) {
                    $middlewareHandler = Middlewares::get($middleware);
                    if ($middlewareHandler && is_callable($middlewareHandler)) {
                        call_user_func($middlewareHandler);
                    }
                }

                if($route['method'] !== Request::method()) {
                    Response::json([
                        'error' => true, 
                        'success' => false,
                        'message' => 'Sorry, method not allowed.'],
                        405);
                    return;
                }

                [$controller, $action] = explode('@', $route['action']);

                $controllerFound = false;
                foreach ($prefixControllers as $prefixController) {
                    $fullController = $prefixController . $controller;
                    if (class_exists($fullController)) {
                        $controllerFound = true;
                        $controller = new $fullController;
                        $controller->$action($matches, new Request, new Response);
                        break;
                    }
                }

                if (!$controllerFound) {
                    $controller = 'App\Controllers\ErrorController';
                    if (class_exists($controller)) {
                        $controller = new $controller;
                        $controller->controller(new Request, new Response);
                    } 
                }

            }

        }

        if(!$routeFound) {
            $controller = 'App\Controllers\ErrorController';
            $controller = new $controller;
            $controller->route(new Request, new Response);
        }

    }
}
