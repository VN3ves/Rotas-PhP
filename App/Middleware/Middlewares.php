<?php
namespace App\Middleware;

class Middlewares
{
    protected static $middlewares = [];

    public static function register($name, $handler)
    {
        self::$middlewares[$name] = $handler;
    }

    public static function get($name)
    {
        return self::$middlewares[$name] ?? null;
    }
    
}
