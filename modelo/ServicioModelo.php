<?php
require_once 'modelo/conexion.php';

class Servicio extends Conexion {
    private $id_servicio;
    private $id_unidad_medida_servicio;
    private $nombre;
    private $descripcion;
    private $precio_base;

    
    public function getIdServicio() {
        return $this->id_servicio;
    }

    public function setIdServicio($id_servicio) {
        $this->id_servicio = $id_servicio;
        return $this;
    }

    public function getIdUnidadMedida() {
        return $this->id_unidad_medida_servicio;
    }

    public function setIdUnidadMedida($id_unidad_medida_servicio) {
        $this->id_unidad_medida_servicio = $id_unidad_medida_servicio;
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getPrecioBase() {
        return $this->precio_base;
    }

    public function setPrecioBase($precio_base) {
        $this->precio_base = $precio_base;
        return $this;
    }

    public function listar() {
        try {
            $sql = "SELECT s.*, um.nombre AS unidad_medida 
                    FROM tipo_servicio s
                    JOIN unidades_medida_servicio um ON s.id_unidad_medida_servicio = um.id_unidad_medida_servicio
                    ORDER BY s.id_servicio DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Servicio->listar(): " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        try {
            $sql = "SELECT s.*, um.nombre AS nombre_unidad_medida 
                FROM tipo_servicio s 
                JOIN unidades_medida_servicio um ON s.id_unidad_medida_servicio = um.id_unidad_medida_servicio 
                WHERE s.id_servicio = ?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            error_log("Error en Servicio->buscarPorId(): " . $e->getMessage());
        return false;
        }
    }

    public function registrar() {
        try {
            $sql = "INSERT INTO tipo_servicio (id_unidad_medida_servicio, nombre, descripcion, precio_base) 
                    VALUES (:id_unidad_medida_servicio, :nombre, :descripcion, :precio_base)";
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->bindParam(':id_unidad_medida_servicio', $this->id_unidad_medida_servicio, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':precio_base', $this->precio_base);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Servicio->registrar(): " . $e->getMessage());
            return false;
        }
    }

    public function actualizar() {
        try {
            $sql = "UPDATE tipo_servicio SET 
                    id_unidad_medida_servicio = :id_unidad_medida_servicio,
                    nombre = :nombre,
                    descripcion = :descripcion,
                    precio_base = :precio_base
                    WHERE id_servicio = :id_servicio";
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->bindParam(':id_unidad_medida_servicio', $this->id_unidad_medida_servicio, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':precio_base', $this->precio_base);
            $stmt->bindParam(':id_servicio', $this->id_servicio, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Servicio->actualizar(): " . $e->getMessage());
            return false;
        }
    }

    public function eliminar() {
        try {
            $sql = "DELETE FROM tipo_servicio WHERE id_servicio = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $this->id_servicio, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Servicio->eliminar(): " . $e->getMessage());
            return false;
        }
    }
}
?>