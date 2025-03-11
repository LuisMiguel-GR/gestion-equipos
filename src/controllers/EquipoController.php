<?php

require_once  __DIR__ . "/../../app/View.php";
require_once __DIR__ . "/../repositories/EquipoRepository.php";
require_once __DIR__ . "/../repositories/DeporteRepository.php";

class EquipoController {

    private $equipoRepository;
    private $deporteRepository;
    public function __construct($pdo) {
        $this->equipoRepository = new EquipoRepository($pdo);
        $this->deporteRepository = new DeporteRepository($pdo);
    }
    public function index() {
        $data = $this->equipoRepository->getAllEquipos();
        View::render("Equipo/index", ["equipos" => $data]);
    }

    public function mostrarFormulario() {
        $deportes = $this->deporteRepository->getAllDeportes();
        View::render("Equipo/add", ["deportes" => $deportes]);
    }

    public function addEquipo() {
        $equipos = $this->equipoRepository->getAllEquipos();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $camposValidar = [
                "nombre" => "Campo nombre obligatorio",
                "ciudad" => "Campo ciudad obligatorio",
            ];
            $this->validarCamposVacios($_POST, $camposValidar, "Equipo/index", ["equipo" => $equipos]); 
    
            $fechaCreacion = $_POST["fecha_creacion"] ?? "";
    
            $fechaValida = DateTime::createFromFormat("Y-m-d", $fechaCreacion);
            
            if (!$fechaValida) {
                $fechaCreacion = date("Y-m-d");
            }
    
            $equipo = new Equipo(
                null,
                $_POST["nombre"],
                $_POST["ciudad"],
                $_POST["deporte"],
                $fechaCreacion
            );
    
            $this->equipoRepository->addEquipo($equipo);
            $_SESSION["mensajeExito"] = "Equipo {$_POST["nombre"]} creado correctamente";

            header("Location: /equipos/list");
            die();
        }
        
        View::render("Equipo/index", ["equipos" => $equipos]);
    }

    public function editEquipo($id) {
        $deportes = $this->deporteRepository->getAllDeportes();
        $equipo = $this->equipoRepository->getEquipoById($id);
        View::render("Equipo/edit", ["equipo" => $equipo, "deportes" => $deportes]);
    }

    public function updateEquipo($id) {
        $equipo = $this->equipoRepository->getEquipoById($id);

        $camposValidar = [
            "nombre" => "Campo nombre obligatorio",
            "ciudad" => "Campo ciudad obligatorio",
        ];

        $deportes = $this->deporteRepository->getAllDeportes();
        $this->validarCamposVacios($_POST, $camposValidar, "Equipo/edit", ["equipo" => $equipo, "deportes" => $deportes]);   
        $equipo = new Equipo(
            $id,
            $_POST["nombre"],
            $_POST["ciudad"],
            $_POST["deporte"],
             $_POST["fecha_creacion"]
        );
        $this->equipoRepository->updateEquipo($equipo);
        $equipo = $this->equipoRepository->getEquipoById($equipo->getId());

        $_SESSION["mensajeExito"] = "Actualizado con exito";
        View::render("Equipo/edit", ["equipo" => $equipo, "deportes" => $deportes]);
    }

    public function deleteEquipo($id) {
        $this->equipoRepository->deleteEquipo($id);
        $_SESSION["mensajeExito"] = "Equipo borrado";
        header("Location: /equipos/list");
        die();
    }

    private function validarCamposVacios($data, $camposValidar, $view, $dataAdicional){
        foreach ($camposValidar as $campo => $mensajeError) {
            if (empty($data[$campo])) {
                $_SESSION["mensajeError"] = $mensajeError;

                View::render($view, $dataAdicional);
                die();
            }
        }      
    }

}