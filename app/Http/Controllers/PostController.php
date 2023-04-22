<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function index()
    {
        var_dump('index');
    }

    public function show($post, $param2)
    {
        var_dump($post);
        var_dump($param2);
    }
}
