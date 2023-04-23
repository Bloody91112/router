<?php

namespace App\Http\Controllers;

use App\RMVC\Route\Route;
use App\RMVC\View\View;

class IndexController
{
    public function index(): string
    {
        $routes = array_merge(Route::getRoutesGet(), Route::getRoutesPost());
        return View::view('index', compact('routes'));
    }
}
