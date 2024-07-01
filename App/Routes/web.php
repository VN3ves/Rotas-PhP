<?php
use App\Routes\Route;
// path App/Routes/web.php

//Route::metodo('rota', 'Controller@metodo', ['middleware']);

/*
METODS: GET, POST, PUT, DELETE
*/

//Rota principal do front
Route::get('/', 'HomeController@index', ['auth']);

