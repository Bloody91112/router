<?php

namespace App\RMVC;

use App\Http\Controllers\PostController;
use App\RMVC\Route\Route;
use App\RMVC\Route\RouteDispatcher;

class App
{
    public static function run(): void
    {

        $requestMethod = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
        $methodName = 'getRoutes' . $requestMethod;

        foreach (Route::$methodName() as $routeConfiguration) {
            $routeDispatcher = new RouteDispatcher($routeConfiguration);
            $routeDispatcher->process();
        }

    }
}