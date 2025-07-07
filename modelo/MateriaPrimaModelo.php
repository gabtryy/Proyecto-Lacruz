<?php
require_once 'modelo/conexion.php';

class MateriaPrima extends Conexion
{
    private $id_materia;
    private $id_proveedores;
    private $nombre;
    private $medida;
    private $stock;

    public function getIdMateria() {
        return $this->id_materia;
    }

    public function setIdMateria($id_materia) {
        $this->id_materia = $id_materia;
        return $this;
    }

    public function getIdProveedores() {
        return $this->id_proveedores;
    }

    public function setIdProveedores($id_proveedores) {
        $this->id_proveedores = $id_proveedores;
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function getMedida() {
        return $this->medida;
    }

    public function setMedida($medida) {
        $this->medida = $medida;
        return $this;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
        return $this;
    }

    public function listar() {
        try {
            $sql = "SELECT m.*, p.nombre AS proveedor
                    FROM materia_prima m
                    JOIN proveedores p ON m.id_provedores = p.id_proveedores
                    ORDER BY m.id_materia ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error en MateriaPrima->listar(): ' . $e->getMessage());
            return [];
        }
    }

    public function buscarId($id) {
        try {
            $sql = "SELECT m.*, p.nombre AS proveedor 
                   FROM materia_prima m  
                   JOIN proveedores p ON m.id_provedores = p.id_proveedores
                   WHERE m.id_materia = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en MateriaPrima->buscarId(): " . $e->getMessage());
            return false;
        }
    }

  
    public function registrar() {
        try {
            $sql = "INSERT INTO materia_prima (nombre, medida, id_provedores, stock) 
                   VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                $this->nombre, 
                $this->medida, 
                $this->id_proveedores, 
                $this->stock
            ]);
        } catch (PDOException $e) {
            error_log("Error en MateriaPrima->registrar(): " . $e->getMessage());
            return false;
        }
    }

    public function actualizar() {
        try {
            $sql = "UPDATE materia_prima 
                   SET nombre = ?, medida = ?, id_provedores = ?, stock = ? 
                   WHERE id_materia = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                $this->nombre, 
                $this->medida, 
                $this->id_proveedores, 
                $this->stock,
                $this->id_materia
            ]);
        } catch (PDOException $e) {
            error_log("Error en MateriaPrima->actualizar(): " . $e->getMessage());
            return false;
        }
    }

    public function eliminar() {
        try {
            $sql = "DELETE FROM materia_prima WHERE id_materia = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$this->id_materia]);
        } catch (PDOException $e) {
            error_log("Error en MateriaPrima->eliminar(): " . $e->getMessage());
            return false;
        }
    }
}
?>