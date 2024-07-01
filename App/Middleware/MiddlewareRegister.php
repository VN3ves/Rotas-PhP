<?php
namespace App\Middleware;


use App\Middleware\Middlewares;
use App\Middleware\AuthMiddleware;

Middlewares::register('auth', [AuthMiddleware::class, 'handle']);