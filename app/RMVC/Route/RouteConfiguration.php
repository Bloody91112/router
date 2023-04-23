<?php

namespace App\RMVC\Route;

class RouteConfiguration
{
    /** Роут (что-то вроде паттерна для строки запроса)*/
    public string $route;
    /** Класс-исполнитель */
    public string $controller;
    /** Метод класса-исполнителя */
    public string $action;
    /** Имя роута */
    public string $name;
    /** Проверяющие */
    public string $middleware;

    public function __construct(string $route, string $controller, string $action)
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function middleware(string $middleware): self
    {
        $this->middleware = $middleware;
        return $this;
    }

}
