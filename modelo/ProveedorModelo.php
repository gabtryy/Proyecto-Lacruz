<?php
require_once 'modelo/Conexion.php';

class Proveedor extends Conexion {
    private $id_proveedores;
    private $id_direccion;
    private $nombre;
    private $telefono;
    private $correo;

    public function getConexion() {
        return $this->pdo;
    }

    public function getIdProveedores() {
        return $this->id_proveedores;
    }

    public function setIdProveedores($id_proveedores) {
        $this->id_proveedores = $id_proveedores;
        return $this;
    }

    public function getIdDireccion() {
        return $this->id_direccion;
    }

    public function setIdDireccion($id_direccion) {
        $this->id_direccion = $id_direccion;
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
        return $this;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
        return $this;
    }

    // Métodos CRUD
    public function listar() {
    try {
        $sql = "SELECT p.*, 
                d.calle, 
                e.nombre AS estado,
                m.nombre AS municipio,
                pa.nombre AS parroquia,
                d.id_estado,
                d.id_municipio,
                d.id_parroquia
                FROM proveedores p
                JOIN direccion d ON p.id_direccion = d.id_direccion
                JOIN estado e ON d.id_estado = e.id_estado
                JOIN municipio m ON d.id_municipio = m.id_municipio
                JOIN parroquia pa ON d.id_parroquia = pa.id_parroquia
                ORDER BY p.id_proveedores ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en Proveedor->listar(): " . $e->getMessage());
        return [];
    }
}

    public function buscarPorId($id) {
    try {
        $sql = "SELECT p.*, 
                d.id_direccion, d.calle, d.id_estado, d.id_municipio, d.id_parroquia,
                e.nombre AS estado,
                m.nombre AS municipio,
                pa.nombre AS parroquia
                FROM proveedores p
                JOIN direccion d ON p.id_direccion = d.id_direccion
                JOIN estado e ON d.id_estado = e.id_estado
                JOIN municipio m ON d.id_municipio = m.id_municipio
                JOIN parroquia pa ON d.id_parroquia = pa.id_parroquia
                WHERE p.id_proveedores = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en Proveedor->buscarPorId(): " . $e->getMessage());
        return false;
    }
    }

    public function registrar() {
        try {
            $sql = "INSERT INTO proveedores (id_direccion, nombre, telefono, correo) 
                    VALUES (:id_direccion, :nombre, :telefono, :correo)";
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->bindParam(':id_direccion', $this->id_direccion, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
            $stmt->bindParam(':correo', $this->correo, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Proveedor->registrar(): " . $e->getMessage());
            return false;
        }
    }

    public function actualizar() {
    try {
        $sql = "UPDATE proveedores SET 
                id_direccion = :id_direccion,
                nombre = :nombre,
                telefono = :telefono,
                correo = :correo
                WHERE id_proveedores = :id_proveedores";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':id_direccion', $this->id_direccion, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $this->correo, PDO::PARAM_STR);
        $stmt->bindParam(':id_proveedores', $this->id_proveedores, PDO::PARAM_INT);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error en Proveedor->actualizar(): " . $e->getMessage());
        return false;
    }
    }

    public function eliminar() {
        try {
            $sql = "DELETE FROM proveedores WHERE id_proveedores = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $this->id_proveedores, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Proveedor->eliminar(): " . $e->getMessage());
            return false;
        }
    }
}
?>