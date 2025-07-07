<?php
require_once 'modelo/conexion.php';

class ProductoMateria extends Conexion {
    private $id_promat;
    private $id_materia;
    private $id_producto;
    private $cantidad;

    public function getConexion() {
        return $this->pdo;
    }

    public function getIdPromat() {
        return $this->id_promat;
    }

    public function setIdPromat($id_promat) {
        $this->id_promat = $id_promat;
        return $this;
    }

    public function getIdMateria() {
        return $this->id_materia;
    }

    public function setIdMateria($id_materia) {
        $this->id_materia = $id_materia;
        return $this;
    }

    public function getIdProducto() {
        return $this->id_producto;
    }

    public function setIdProducto($id_producto) {
        $this->id_producto = $id_producto;
        return $this;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
        return $this;
    }

    public function registrar() {
    try {
        $sql = "INSERT INTO producto_materia (id_materia, id_producto, cantidad) 
                VALUES (:id_materia, :id_producto, :cantidad)";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':id_materia', $this->id_materia, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_STR);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error en ProductoMateria->registrar(): " . $e->getMessage());
        return false;
    }
    }
    public function listar() {
        try {
            $sql = "SELECT pm.*, 
                    p.nombre AS producto, 
                    m.nombre AS materia_prima,
                    m.medida
                    FROM producto_materia pm
                    JOIN productos p ON pm.id_producto = p.id_producto
                    JOIN materia_prima m ON pm.id_materia = m.id_materia
                    ORDER BY p.nombre ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en ProductoMateria->listar(): " . $e->getMessage());
            return [];
        }
    }

    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM producto_materia WHERE id_promat = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en ProductoMateria->buscarPorId(): " . $e->getMessage());
            return false;
        }
    }

    public function actualizar() {
        try {
            $sql = "UPDATE producto_materia SET 
                    cantidad = :cantidad
                    WHERE id_promat = :id_promat";
            $stmt = $this->pdo->prepare($sql);
            
            $stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_STR);
            $stmt->bindParam(':id_promat', $this->id_promat, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en ProductoMateria->actualizar(): " . $e->getMessage());
            return false;
        }
    }

    public function eliminar() {
        try {
            $sql = "DELETE FROM producto_materia WHERE id_promat = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $this->id_promat, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en ProductoMateria->eliminar(): " . $e->getMessage());
            return false;
        }
    }

    public function listarPorProducto($id_producto) {
        try {
            $sql = "SELECT pm.id_promat, pm.id_materia, pm.cantidad, 
                       m.nombre AS materia_prima, m.medida
                FROM producto_materia pm
                JOIN materia_prima m ON pm.id_materia = m.id_materia
                WHERE pm.id_producto = ?
                ORDER BY m.nombre ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_producto]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en ProductoMateria->listarPorProducto(): " . $e->getMessage());
            return [];
        }
    }

    public function eliminarPorProducto($id_producto) {
        try {
            $sql = "DELETE FROM producto_materia WHERE id_producto = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id_producto, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en ProductoMateria->eliminarPorProducto(): " . $e->getMessage());
            return false;
        }
    }

    public function buscarPorProductoYMateria($id_producto, $id_materia) {
        try {
            $sql = "SELECT * FROM producto_materia 
                WHERE id_producto = ? AND id_materia = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_producto, $id_materia]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en ProductoMateria->buscarPorProductoYMateria(): " . $e->getMessage());
        return false;
        }
    }
}
?>