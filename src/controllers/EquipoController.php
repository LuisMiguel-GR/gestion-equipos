<?php

require_once  __DIR__ . "/../../app/View.php";
require_once __DIR__ . "/../repositories/EquipoRepository.php";
require_once __DIR__ . "/../repositories/DeporteRepository.php";
require_once __DIR__ . "/../repositories/JugadorRepository.php";

class EquipoController {

    private $equipoRepository;
    private $deporteRepository;
    private $jugadorRepository;
    public function __construct($pdo) {
        $this->equipoRepository = new EquipoRepository($pdo);
        $this->deporteRepository = new DeporteRepository($pdo);
        $this->jugadorRepository = new JugadorRepository($pdo);
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
                $_POST["capitan"] ?? null,
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
        $jugadores = $this->jugadorRepository->getAllJugadoresByEquipo($id);

        View::render("Equipo/edit", ["equipo" => $equipo, "deportes" => $deportes, "jugadores" => $jugadores]);
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
            $_POST["capitan"] ?? null,
             $_POST["fecha_creacion"]
        );
        $this->equipoRepository->updateEquipo($equipo);
        $jugadores = $this->jugadorRepository->getAllJugadoresByEquipo($id);

        $_SESSION["mensajeExito"] = "Actualizado con exito";
        View::render("Equipo/edit", ["equipo" => $equipo, "deportes" => $deportes, "jugadores" => $jugadores]);
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