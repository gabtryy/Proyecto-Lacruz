<?php
require_once  __DIR__ . '/../app/database.php';

class ServicioModelo extends conexion {
    private $id_servicio;
    private $nombre;
    private $descripcion;
    private $precio_hora;

    public function __construct() {
        parent::__construct();
    }

    public function getId_servicio() {
        return $this->id_servicio;
    }
    public function setId_servicio($id_servicio) {
        $this->id_servicio = $id_servicio;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function getPrecio_hora() {
        return $this->precio_hora;
    }
    public function setPrecio_hora($precio_hora) {
        $this->precio_hora = $precio_hora;
    }

    public function listarServicio() {
        $stmt = $this->conexion->query("SELECT * FROM servicio");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerServicio($id_servicio) {
        $stmt = $this->conexion->prepare("SELECT * FROM servicio WHERE id_servicio = ?");
        $stmt->execute([$id_servicio]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crearServicio() {
        $stmt = $this->conexion->prepare("INSERT INTO servicio (nombre, descripcion, precio_hora) VALUES (?, ?, ?)");
        $stmt->execute([$this->nombre, $this->descripcion, $this->precio_hora]);
    }

    public function actualizarServicio() {
        $stmt = $this->conexion->prepare("UPDATE servicio SET nombre = ?, descripcion = ?, precio_hora = ? WHERE id_servicio = ?");
        $stmt->execute([$this->nombre,$this->descripcion, $this->precio_hora, $this->id_servicio]);
    }

    public function eliminarServicio($id_servicio) {
        $stmt = $this->conexion->prepare("DELETE FROM servicio WHERE id_servicio = ?");
        $stmt->execute([$id_servicio]);
    }
}
?>
