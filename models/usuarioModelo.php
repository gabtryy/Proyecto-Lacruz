<?php
require_once 'app/database.php';

class usuarioModelo extends Conexion {
    private $id;
    private $nombre;
    private $email;
    private $password;

    public function __construct() {
        parent::__construct(); 
    }

   
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function getEmailo() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }

    // CRUD

    public function listar() {
        $stmt = $this->conexion->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear() {
        $stmt = $this->conexion->prepare("INSERT INTO usuarios (nombre, email, password1) VALUES (?, ?, ?)");
        $stmt->execute([$this->nombre, $this->email, $this->password]);
    }

    public function actualizar() {
        $stmt = $this->conexion->prepare("UPDATE usuarios SET nombre = ?, email = ? , password1 = ? WHERE id = ?");
        $stmt->execute([$this->nombre, $this->email, $this->password, $this->id]);
    }

    public function eliminar($id) {
        $stmt = $this->conexion->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
