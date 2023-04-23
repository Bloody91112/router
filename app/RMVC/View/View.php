<?php

namespace App\RMVC\View;

class View
{
    /** Путь view */
    private static string $path;
    /** Переменные для view */
    private static array $data;

    /** Записываем переменные, преобразуя путь в нужный вид*/
    public static function view(string $str, array $data = []): string
    {
        self::$data = $data;
        $path = str_replace('public', 'resources/views/', $_SERVER['DOCUMENT_ROOT']);
        self::$path = $path . str_replace('.', '/', $str) . '.php';
        return self::getContent();

    }

    /** "Расскрываем" массив с данными, "берем" шаблон */
    private static function getContent(): string
    {
        extract(self::$data);
        ob_start();
        include self::$path;
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}
