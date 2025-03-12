<?php
require_once __DIR__ . "/../models/Jugador.php";

class JugadorRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllJugadoresByEquipo(int $equipoId): array {
        $sql = "SELECT j.id, j.nombre, j.numero 
                FROM jugadores j 
                INNER JOIN rel_equipos_jugadores rej ON rej.jugador_id = j.id
                WHERE rej.equipo_id = :equipo_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':equipo_id', $equipoId, PDO::PARAM_INT);
        $stmt->execute();

        $jugadores = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $jugadores[] = new Jugador($fila["id"], $fila["nombre"], $fila["numero"]);
        }
        return $jugadores;
    }
    
    public function getJugadorById(int $id): ?Jugador {
        $sql = "SELECT * FROM jugadores WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $jugador = new Jugador($fila["id"], $fila["nombre"], $fila["numero"]);

        return $jugador;
    }

    public function addJugador(Jugador $jugador): Jugador {
        $sql = "INSERT INTO jugadores (nombre, numero, fecha_creacion) VALUES (:nombre, :numero, :fecha_creacion)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nombre" => $jugador->getNombre(),
            ":numero" => $jugador->getNumero(),
            ":fecha_creacion" => date("Y-m-d")
        ]);

        $jugador->setId($this->pdo->lastInsertId());
        return $jugador;
    }

    public function relJugadorEquipo($idJugador, $idEquipo) {
        $sql = "INSERT INTO rel_equipos_jugadores (equipo_id, jugador_id) VALUES (:equipo_id, :jugador_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":equipo_id" => $idEquipo,
            ":jugador_id" => $idJugador
        ]);
    }

    public function updateJugador(Jugador $jugador): bool {
        $sql = "UPDATE jugadores SET nombre = :nombre, numero = :numero WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":id" => $jugador->getId(),
            ":nombre" => $jugador->getNombre(),
            ":numero" => $jugador->getNumero()
        ]);
    }

    public function deleteJugador(int $id): bool {
        $sqlRel = "DELETE FROM rel_equipos_jugadores WHERE jugador_id = :jugador_id";
        $stmtRel = $this->pdo->prepare($sqlRel);
        $stmtRel->execute([":jugador_id" => $id]);

        $sql = "DELETE FROM jugadores WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }

    public function getEquipoIdByJugador($idJugador) {
        $sql = "SELECT equipo_id FROM rel_equipos_jugadores WHERE jugador_id = :jugador_id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([":jugador_id" => $idJugador]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $resultado['equipo_id'] ?? null;
    }

    public function existeNumJugador($numero, $idEquipo) {
        $sql = "SELECT COUNT(*) FROM jugadores j
                JOIN rel_equipos_jugadores rje ON rje.jugador_id = j.id
                WHERE j.numero = :numero AND rje.equipo_id = :equipo_id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":numero" => $numero, ":equipo_id" => $idEquipo]);
        $resultado = $stmt->fetchColumn();
        
        return $resultado > 0;
    }
}