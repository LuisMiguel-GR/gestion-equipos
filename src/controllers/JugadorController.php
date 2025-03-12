<?php

require_once  __DIR__ . "/../../app/View.php";
require_once __DIR__ . "/../repositories/EquipoRepository.php";
require_once __DIR__ . "/../repositories/JugadorRepository.php";
require_once __DIR__ . "/../repositories/DeporteRepository.php";

class JugadorController {

    private $jugadorRepository;
    private $equipoRepository;
    private $deporteRepository;

    public function __construct($pdo) {
        $this->equipoRepository = new EquipoRepository($pdo);
        $this->jugadorRepository = new JugadorRepository($pdo);
        $this->deporteRepository = new DeporteRepository($pdo);
    }
    public function index() {
        $data = $this->equipoRepository->getAllEquipos();
        View::render("Equipo/index", ["equipos" => $data]);
    }

    public function mostrarFormulario() {
        $idEquipo = $_POST['equipo_id'] ?? null;
        $equipo = $this->equipoRepository->getEquipoById($idEquipo);
        View::render("Jugador/add", ["equipo" => $equipo]);
    }

    public function addJugador() {
        $idEquipo = $_POST['equipo_id'] ?? null;

        if (!$idEquipo) {
            die("No existe ID de equipo");
        }

        $equipo = $this->equipoRepository->getEquipoById($idEquipo);
        $jugadores = $this->jugadorRepository->getAllJugadoresByEquipo($idEquipo);
        $deportes = $this->deporteRepository->getAllDeportes();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if ($this->jugadorRepository->existeNumJugador($_POST["numero"], $idEquipo)) {
                $_SESSION["mensajeError"] = "El numero escogido ya esta en uso";
                View::render( "Jugador/add", ["equipo" => $equipo]);
                die();
            }

            if (empty($_POST["nombre"])) {
                $_SESSION["mensajeError"] = "EL nombre es obligatorio";

                View::render( "Equipo/edit", [
                    "equipo" => $equipo,
                    "jugadores" => $jugadores,
                    "deportes" => $deportes
                ]);
                die();
            }

            $jugador = new Jugador(
                null,
                $_POST["nombre"],
                $_POST["numero"]
            );
    
            $jugador = $this->jugadorRepository->addJugador($jugador);
            $this->jugadorRepository->relJugadorEquipo($jugador->getId(), $idEquipo);
            $_SESSION["mensajeExito"] = "Jugador {$_POST["nombre"]} creado correctamente";

            header("Location: /equipos/edit/{$idEquipo}");
            die();
        }
        
        View::render("Equipo/edit", [
            "equipo" => $equipo,
            "jugadores" => $jugadores,
            "deportes" => $deportes
        ]);
    }

    public function editJugador($id) {
        $jugador = $this->jugadorRepository->getJugadorById($id);
        $idEquipo = $this->jugadorRepository->getEquipoIdByJugador($id);
        View::render("Jugador/edit", ["jugador" => $jugador, "idEquipo" => $idEquipo]);
    }

    public function updateJugador($id) {
        $idEquipo = $this->jugadorRepository->getEquipoIdByJugador($id);
        $jugador = $this->jugadorRepository->getJugadorById($id);

        if (empty($_POST["nombre"])) {
            $_SESSION["mensajeError"] = "El nombre es obligatorio";
            View::render( "Jugador/edit", ["idEquipo" => $idEquipo, "jugador" => $jugador]);
            die();
        }

        if (empty($_POST["numero"])) {
            $_SESSION["mensajeError"] = "El numero es obligatorio";
            View::render( "Jugador/edit", ["idEquipo" => $idEquipo, "jugador" => $jugador]);
            die();
        }

        if(($_POST["numero"] != $jugador->getNumero())  && ($this->jugadorRepository->existeNumJugador($_POST["numero"], $idEquipo))){
            $_SESSION["mensajeError"] = "El numero escogido ya lo tiene otro jugador";
            View::render( "Jugador/edit", ["idEquipo" => $idEquipo, "jugador" => $jugador]);
            die();
        }

        $jugador = new Jugador(
            $id,
            $_POST["nombre"],
            $_POST["numero"]
        );
        $this->jugadorRepository->updateJugador($jugador);
        $_SESSION["mensajeExito"] = "Actualizado con exito";
        View::render("Jugador/edit", ["idEquipo" => $idEquipo, "jugador" => $jugador]);
    }

    public function deleteJugador($id) {
        $idEquipo = $this->jugadorRepository->getEquipoIdByJugador((int)$id);

        $this->jugadorRepository->deleteJugador($id);
        $_SESSION["mensajeExito"] = "Jugador eliminado";
        header("Location: /equipos/edit/$idEquipo");
        die();
    }

}