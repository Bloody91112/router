<?php

namespace App\RMVC\Route;

use App\Http\Controllers\PostController;

class RouteDispatcher
{
    private RouteConfiguration $routeConfiguration;
    private string $requestUri = '/';
    private array $paramsMap = [];

    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }

    public function process()
    {
        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegexRequest();
        $this->run();
    }

    private function saveRequestUri(): void
    {


        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri = $this->clean($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->route = $this->clean($this->routeConfiguration->route);
        }
    }

    private function clean(string $string): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $string);
    }

    private function setParamMap(): void
    {
        $routeArray = explode('/', $this->routeConfiguration->route);

        foreach ($routeArray as $paramKey => $param) {
            if (preg_match('/{.*}/', $param)) {
                $this->paramsMap[$paramKey] = preg_replace('/(^{)|(}$)/', '', $param);
            }
        }

    }

    private function makeRegexRequest(): void
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramsMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }

            $requestUriArray[$paramKey] = '{.*}';
        }

        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();


    }

    public function prepareRegex(): void
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    public function run(): void
    {
        if( preg_match("/$this->requestUri/", $this->routeConfiguration->route) ){
            $this->render();
        }
    }

    public function render(): void
    {
        $ClassName = $this->routeConfiguration->controller;
        $action = $this->routeConfiguration->action;
        print((new $ClassName)->$action());
        die();
//        echo '<pre>';
//        var_dump((new $ClassName)->$action());
//        echo '</pre>';


    }

}
