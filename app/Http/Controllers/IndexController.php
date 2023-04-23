<?php

namespace App\Http\Controllers;

use App\RMVC\View\View;

class IndexController
{
    public function index(): string
    {
        return View::view('index');
    }
}
