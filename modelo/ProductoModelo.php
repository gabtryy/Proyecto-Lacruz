<?php
require_once 'modelo/conexion.php';

class Producto extends Conexion {
    private $id_producto;
    private $nombre;
    private $stock;
    private $precio;
    private $precio_mayor;
    private $id_unidad_medida;
    private $es_fabricado;

    public function getConexion() {
        return $this->pdo;
    }

    public function getIdProducto() {
        return $this->id_producto;
    }

    public function setIdProducto($id_producto) {
        $this->id_producto = $id_producto;
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
        return $this;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
        return $this;
    }

    public function getPrecioMayor() {
        return $this->precio_mayor;
    }

    public function setPrecioMayor($precio_mayor) {
        $this->precio_mayor = $precio_mayor;
        return $this;
    }
    public function getIdUnidadMedida() {
        return $this->id_unidad_medida;
    }

    public function setIdUnidadMedida($id_unidad_medida) {
        $this->id_unidad_medida = $id_unidad_medida;
        return $this;
    }

    public function getEsFabricado() {
        return $this->es_fabricado;
    }

    public function setEsFabricado($es_fabricado) {
        $this->es_fabricado = $es_fabricado;
        return $this;
    }

    public function listar() {
    try {
        $sql = "SELECT p.*, um.nombre as unidad_medida 
                FROM productos p
                LEFT JOIN unidades_medida um ON p.id_unidad_medida = um.id_unidad_medida
                ORDER BY p.id_producto DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en Producto->listar(): " . $e->getMessage());
        return [];
    }
}

    public function buscarPorId($id) {
        try {
            $sql = "SELECT p.*, um.nombre as unidad_medida 
                FROM productos p
                LEFT JOIN unidades_medida um ON p.id_unidad_medida = um.id_unidad_medida
                WHERE p.id_producto = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        error_log("Error en Producto->buscarPorId(): " . $e->getMessage());
        return false;
        }
    }

public function registrar() {
    try {
        $sql = "INSERT INTO productos (nombre, stock, precio, precio_mayor, es_fabricado, id_unidad_medida) 
                VALUES (:nombre, :stock, :precio, :precio_mayor, :es_fabricado,:id_unidad_medida)";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $this->stock, PDO::PARAM_INT);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':precio_mayor', $this->precio_mayor);
        $stmt->bindParam(':es_fabricado', $this->es_fabricado, PDO::PARAM_INT);
        $stmt->bindParam(':id_unidad_medida', $this->id_unidad_medida, PDO::PARAM_INT);
        
        $result = $stmt->execute();
        
        if (!$result) {
            $errorInfo = $stmt->errorInfo();
            error_log("Error SQL al registrar producto: " . print_r($errorInfo, true));
            throw new Exception("Error en la consulta SQL: " . $errorInfo[2]);
        }
        
        return $result;
        } catch (PDOException $e) {
        error_log("PDOException en Producto->registrar(): " . $e->getMessage());
        throw $e;
        }
    }

    public function actualizar() {
    try {
        $sql = "UPDATE productos SET 
                nombre = :nombre,
                stock = :stock,
                precio = :precio,
                precio_mayor = :precio_mayor,
                es_fabricado = :es_fabricado,
                id_unidad_medida = :id_unidad_medida
                WHERE id_producto = :id_producto";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':stock', $this->stock, PDO::PARAM_INT);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':precio_mayor', $this->precio_mayor);
        $stmt->bindParam(':es_fabricado', $this->es_fabricado, PDO::PARAM_INT);
        $stmt->bindParam(':id_unidad_medida', $this->id_unidad_medida, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
        
        $result = $stmt->execute();
        
        if (!$result) {
            $errorInfo = $stmt->errorInfo();
            error_log("Error SQL al actualizar producto: " . print_r($errorInfo, true));
        }
        
        return $result;
    } catch (PDOException $e) {
        error_log("PDOException en Producto->actualizar(): " . $e->getMessage());
        return false;
    }
}
    public function eliminar() {
        try {
            $sql = "DELETE FROM productos WHERE id_producto = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $this->id_producto, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Producto->eliminar(): " . $e->getMessage());
            return false;
        }
    }

    public function listarFabricados() {
        try {
            $sql = "SELECT * FROM productos WHERE es_fabricado = 1 ORDER BY nombre ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Producto->listarFabricados(): " . $e->getMessage());
            return [];
        }
    }
}
?>