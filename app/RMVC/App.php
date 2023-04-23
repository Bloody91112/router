<?php

namespace App\RMVC;

use App\RMVC\Route\Route;
use App\RMVC\Route\RouteDispatcher;
use JetBrains\PhpStorm\NoReturn;

class App
{
    #[NoReturn] public static function run(): void
    {
        $methodName = 'getRoutes' . ucfirst(strtolower($_SERVER['REQUEST_METHOD']));

        /** Перебор всех роутов (routes/web.php) с текущим методом запроса */
        foreach (Route::$methodName() as $routeConfiguration) {
            $routeDispatcher = new RouteDispatcher($routeConfiguration);
            $routeDispatcher->process();
        }

    }
}