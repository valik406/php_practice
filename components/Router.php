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
        
        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {
            
            if(preg_match("~$uriPattern~", $uri)){
                
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                // Если есть совпадение, опредилить какой контроллер
                // и action обрабатывают запрос
                $segments = explode('/', $internalRoute);
                
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
               
                $actionName = 'action' . ucfirst(array_shift($segments));
                
                $parameters = $segments;
                
                
                //подключить файл класса контроллера
                $controllerFile = ROOT . '/controllers/' 
                        . $controllerName . '.php';
                
                if(file_exists($controllerFile)){
                    include_once($controllerFile);
                }
                
                //Создать обект вызвать метод(т.е. action)
                $controllerObject = new $controllerName;
                if(empty($parameters)):
                    $result = $controllerObject->$actionName();
                else:
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                    
                endif;
                
                
               if($result != null){
                   break;
               }
            }    
        }
    }
}
