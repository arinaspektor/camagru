<?php 

    class Router {
    
        private $routes;
        public  $param = null;
        
        public function __construct() {
            $routesPath = ROOT . '/config/routes.php';
            $this->routes = include($routesPath);
        }

        private function getUri() {
            if (!empty($_SERVER['REQUEST_URI'])) {
                return trim($_SERVER['REQUEST_URI'], '/');
            }
        }

        public function run() {
            $uri = $this->getUri();
            $result = [];

            foreach ($this->routes as $uriPattern => $path) {
                if (preg_match("~$uriPattern~", $uri)) { 
                    $segments = explode('/', $path);

                    if (count($segments) > 2) {
                        $params = explode('/', $uri);
                        $this->param = end($params);
                    }

                    $controllerName = ucfirst(array_shift($segments) . 'Controller');
                    $actionName =  'action' . ucfirst(array_shift($segments));

                    $controllerFile = ROOT .'/app/controllers/' . $controllerName . '.php';
                    if (file_exists($controllerFile)) {
                        include_once($controllerFile);

                        $controllerObject = new $controllerName($this->param);
                        $controllerObject->$actionName();
            
                        break ;
                    }
                }
            }

        }

    }

?>