<?php
require_once __DIR__ . "/../models/Equipo.php";

class EquipoRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllEquipos(): array {
        $sql = "SELECT * FROM equipos";
        $stmt = $this->pdo->query($sql);
        $equipos = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $equipos[] = new Equipo($fila["id"], $fila["nombre"], $fila["ciudad"], $fila["deporte"], $fila["capitan"],$fila["fecha_creacion"]);
        }
        return $equipos;
    }
    
    public function getEquipoById(int $id): ?Equipo {
        $sql = "SELECT * FROM equipos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id" => $id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $equipo = new Equipo($fila["id"], $fila["nombre"], $fila["ciudad"], $fila["deporte"],  $fila["capitan"], $fila["fecha_creacion"]);

        return $equipo;
    }

    public function addEquipo(Equipo $equipo): Equipo {
        $sql = "INSERT INTO equipos (nombre, ciudad, deporte, capitan, fecha_creacion) VALUES (:nombre, :ciudad, :deporte, :capitan, :fecha_creacion)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":nombre" => $equipo->getNombre(),
            ":ciudad" => $equipo->getCiudad(),
            ":deporte" => $equipo->getDeporte(),
            ":capitan" => $equipo->getCapitan(),
            ":fecha_creacion" => $equipo->getFechaCreacion()
        ]);

        $equipo->setId($this->pdo->lastInsertId());
        return $equipo;
    }

    public function updateEquipo(Equipo $equipo): bool {
        $sql = "UPDATE equipos SET nombre = :nombre, ciudad = :ciudad, deporte = :deporte, capitan = :capitan, fecha_creacion = :fecha_creacion WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $capitan = empty($equipo->getCapitan()) ? null : $equipo->getCapitan();

        return $stmt->execute([
            ":id" => $equipo->getId(),
            ":nombre" => $equipo->getNombre(),
            ":ciudad" => $equipo->getCiudad(),
            ":deporte" => $equipo->getDeporte(),
            ":capitan" => $capitan,
            ":fecha_creacion" => $equipo->getFechaCreacion()
        ]);
    }

    public function deleteEquipo(int $id): bool {
        $sql = "DELETE FROM equipos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }
}