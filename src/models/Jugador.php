<?php
class Jugador {
    private ?int $id;
    private ?string $nombre;
    private ?int $numero;
    private ?string $fecha_creacion;

    public function __construct(?int $id = null, $nombre = null, $numero = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->fecha_creacion = date("Y-m-d");
    }

    public function getId(): ?int { 
        return $this->id; 
    }
    public function getNombre(): string { 
        return $this->nombre; 
    }
    public function getNumero(): int { 
        return $this->numero; 
    }
    public function getFechaCreacion(): string {
        return $this->fecha_creacion; 
    }

    public function setId(int $id) {
        $this->id = $id;
    }
    public function setNombre(string $nombre) { 
        $this->nombre = $nombre; 
    }
    public function setNumero(int $numero) { 
        $this->numero = $numero; 
    }
    public function setFechaCreacion(string $fecha_creacion) { 
        $this->fecha_creacion = $fecha_creacion; 
    }
}
?>