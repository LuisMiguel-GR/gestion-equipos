<?php
require_once(__DIR__ . "/../config/Basedatos.php");
require_once(__DIR__ . "/../app/Router.php");
require_once(__DIR__ . "/../config/routes.php");
require_once(__DIR__ . "/../src/controllers/IndexController.php");

$pdo = Basedatos::getConexion();
$routes = include __DIR__ . "/../config/routes.php";
$router = new Router($routes, $pdo);

$method = $_SERVER["REQUEST_METHOD"];
$uri = trim($_SERVER["REQUEST_URI"], "/");

$router->gestionarPeticiones($method, $uri);