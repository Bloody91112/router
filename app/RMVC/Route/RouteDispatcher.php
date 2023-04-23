<?php

namespace App\RMVC\Route;

use App\Http\Controllers\PostController;


/** Ищет нужный роут и выполняет его */
class RouteDispatcher
{
    /** Конфигурация роута */
    private RouteConfiguration $routeConfiguration;
    /** Строка запроса */
    private string $requestUri = '/';
    /** Динамические параметры роута */
    private array $paramsMap = [];
    /** Динамические параметры (ключ -> значение) */
    private array $paramsRequestMap = [];

    public function __construct(RouteConfiguration $routeConfiguration)
    {
        $this->routeConfiguration = $routeConfiguration;
    }
    /** Оператор */
    public function process()
    {
        $this->saveRequestUri();
        $this->setParamMap();
        $this->makeRegexRequest();
        $this->run();
    }

    /** Сохраняем строку запроса */
    private function saveRequestUri(): void
    {
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri = $this->clean($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->route = $this->clean($this->routeConfiguration->route);
        }
    }

    /** Убираем слэш в конце строки */
    private function clean(string $string): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $string);
    }

    /** Маппинг динамических параметров роута */
    private function setParamMap(): void
    {
        $routeArray = explode('/', $this->routeConfiguration->route);

        foreach ($routeArray as $paramKey => $param) {
            if (preg_match('/{.*}/', $param)) {
                $this->paramsMap[$paramKey] = preg_replace('/(^{)|(}$)/', '', $param);
            }
        }
    }

    /**
     * Соотносим динамические параметры роута с сегментами строки запроса
     * При совпадении записываем в массив @paramsRequestMap
     * Строку запроса приводим в regex-паттерн
     */
    private function makeRegexRequest(): void
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->paramsMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }
            $this->paramsRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';
        }
        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();
    }

    /** Экранирование слэшей строки запроса */
    public function prepareRegex(): void
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    /** Берем строку запроса (к этому моменту regex-паттерн)
     * и проверяем подходит ли к ней роут конфигурации.
     * Если подходит - рендерим
     */
    public function run(): void
    {
        if( preg_match("/$this->requestUri/", $this->routeConfiguration->route) ){
            $this->render();
        }
    }

    /** Выполняем метод конфигурации роута, прокидываем параметры */
    public function render(): void
    {
        $ClassName = $this->routeConfiguration->controller;
        $action = $this->routeConfiguration->action;
        print((new $ClassName)->$action(...$this->paramsRequestMap));
        die();
    }

}
