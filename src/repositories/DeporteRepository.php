<?php

class DeporteRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllDeportes(): array {
        $sql = "SELECT * FROM deportes";
        $stmt = $this->pdo->query($sql);
        $equipos = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $equipos[] = ["id" => $fila["id"], "nombre" => $fila["nombre"]];
        }
        return $equipos;
    }
}