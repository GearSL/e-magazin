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

    public function __construct(){
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    /**
     * Returns request string
     * @return string
     */
    private function getURI(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run(){
        // Получаем строку запроса
        $uri = $this->getURI();

        // Проверить наличие такого элемента в routes.php
        foreach ($this->routes as $uriPattern => $path){
            // Сравниваем $uriPattern и $uri
            if(preg_match("~$uriPattern~", $uri)){
                // Определить какой контроллер и экшен обрабатывают запрос
                $segments = explode('/', $path);
                // Извлекаем из массива $segments первый элемент, делаем первую букву результата заглавной
                // и присваиваем переменной $controllerName
                $controllerName = ucfirst(array_shift($segments)).'Controller';
                // Извлекаем из массива $segments имя экшена
                $actionName = 'action'.ucfirst(array_shift($segments));
                // Записываем в переменную $controllerFile путь к полученному имени контроллера
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                // Проверяем существует ли файл класса контроллера
                if(file_exists($controllerFile)){
                    include_once($controllerFile);
                }
                // Создать объект, вызвать метод (action)
                $controllerObject = new $controllerName;
                $controllerObject->$actionName();
            }
        }
    }
}