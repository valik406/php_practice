<?php

class Router {
    
    private $routes;
    
    public function __construct() {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }
    
    /**
     * Return request string
     */
    private function getURI() {
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    
    public function run() {
        // Получить строку запроса
        $uri = $this->getURI();
        echo $uri;
        // Проверить наличие такого запроса в routes.php
        
        // Если есть совпадение, опредилить какой контроллер
        // и action обрабатывают запрос
        
        //подключить файл класса контроллера
        
        //Создать обект вызвать метод(т.е. action)
        
    }
}
