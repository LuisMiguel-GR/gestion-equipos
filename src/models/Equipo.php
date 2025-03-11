<?php
class Equipo {
    private ?int $id;
    private ?string $nombre;
    private ?string $ciudad;
    private ?string $deporte;
    private ?string $fecha_creacion;

    public function __construct(?int $id = null, $nombre = null, $ciudad = null, $deporte = null, $fecha_creacion = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ciudad = $ciudad;
        $this->deporte = $deporte;
        $this->fecha_creacion =  $fecha_creacion ?? date("Y-m-d");
    }

    public function getId(): ?int { 
        return $this->id; 
    }
    public function getNombre(): string { 
        return $this->nombre; 
    }
    public function getCiudad(): string { 
        return $this->ciudad; 
    }
    public function getDeporte(): string { 
        return $this->deporte; 
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
    public function setCiudad(string $ciudad) { 
        $this->ciudad = $ciudad; 
    }
    public function setDeporte(string $deporte) { 
        $this->deporte = $deporte; 
    }
    public function setFechaCreacion(string $fecha_creacion) { 
        $this->fecha_creacion = $fecha_creacion; 
    }
}
?>