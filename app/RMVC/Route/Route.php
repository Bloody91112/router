<?php

namespace App\RMVC\Route;

class Route
{
    /** Гет роуты */
    private static array $routesGet = [];
    /** Пост роуты */
    private static array $routesPost = [];

    public static function getRoutesPost(): array
    {
        return self::$routesPost;
    }

    public static function getRoutesGet(): array
    {
        return self::$routesGet;
    }

    /** Создаем конфигурацию, записываем ее в соответсвующий массив */
    public static function get(string $route, array $controller): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesGet[] = $routeConfiguration;

        return $routeConfiguration;
    }

    /** Создаем конфигурацию, записываем ее в соответсвующий массив */
    public static function post(string $route, array $controller): RouteConfiguration
    {
        $routeConfiguration = new RouteConfiguration($route, $controller[0], $controller[1]);
        self::$routesPost[] = $routeConfiguration;

        return $routeConfiguration;
    }

    /** Метод для редиректа */
    public static function redirect($url)
    {
        header('Location: ' . $url);
    }

}
