<?php

/**
 * Created by PhpStorm.
 * User: Gear
 * Date: 02.07.2018
 * Time: 22:11
 */
class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Returns request string
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        // Получаем строку запроса
        $uri = $this->getURI();

        // Проверить наличие такого элемента в routes.php
        foreach ($this->routes as $uriPattern => $path) {
            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {
                // Получаем внутренний путь из внешнего согласно правилу
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                // Определить контроллер, экшен и параметры
                // Разбиваем полученный URL и помещаем в массив
                $segments = explode('/', $internalRoute);
                // Извлекаем элементы из массива и записываем их в переменные
                $controllerName = ucfirst(array_shift($segments)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($segments));
                // Получаем оставшиеся элементы в качестве параметров
                $parameters = $segments;
                // Подключаем файл класса контроллера
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                // Проверяем наличие файла и подключаем
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                // Создаем объект и вызываем его экшен
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }
            }
        }
    }
}