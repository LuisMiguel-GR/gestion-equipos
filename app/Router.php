<?php

    class Router {
        private $routes = [];
        private $pdo;
    
        public function __construct($routes, $pdo) {
            $this->routes = $routes;
            $this->pdo = $pdo;
        }
    
        public function gestionarPeticiones($metodo, $uri) {
            foreach ($this->routes as $route) {

                if ($route[0] == $metodo) {
                    $partesRuta = explode("/", trim($route[1], "/"));
                    $partesUri = explode("/", trim($uri, "/"));

                    if (count($partesRuta) !== count($partesUri)) {
                        continue;
                    }

                    $parametros = [];
                    $coincide = true;
                    foreach ($partesRuta as $i => $parte) {
                        if (strpos($parte, "@") === 0) {
                            $parametros[] = $partesUri[$i];
                        } elseif ($parte !== $partesUri[$i]) {
                            $coincide = false;
                            break;
                        }
                    }

                    if ($coincide) {
                        return $this->servirRuta($route[2], $parametros);
                    }
                }
            }
        
            die("Ruta no disponible");
        }
    
        private function servirRuta($accion, $parametros = []) {
            $controlador = explode("->", $accion)[0];
            $metodo = explode("->", $accion)[1];

            $dirControllers = __DIR__ . "/../src/controllers/";
            $archivo = $dirControllers . $controlador . ".php";
 
            if (!file_exists($archivo)) {
                die("no se encontro el fichero del controlador: $archivo");
            }

            require_once $archivo;

            if (!class_exists($controlador)) {
                die("la clase del controlador: $controlador no se ha encontrado");
            }
        
            $insController = new $controlador($this->pdo);
            return $insController->$metodo(...$parametros);
        }
    }
    