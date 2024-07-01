<?php
// index.php

require_once 'vendor/autoload.php';
require_once 'App/Routes/web.php';
require_once 'App/Middleware/MiddlewareRegister.php';

use App\Routes\Router;
use App\Routes\Route;

Router::dispatch(Route::routes());

