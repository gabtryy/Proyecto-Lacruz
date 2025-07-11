<?php
require_once 'modelo/conexion.php';

class UnidadMedidaProducto extends Conexion {
    
    private $unidades_medida_producto_id;
    private $nombre;

    public function getIdUnidadMedida() {
        return $this->unidades_medida_producto_id;
    }

    public function setIdUnidadMedida($unidades_medida_producto_id) {
        $this->unidades_medida_producto_id = $unidades_medida_producto_id;
        return $this;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM unidades_medida_producto ORDER BY nombre";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en UnidadMedida->listar(): " . $e->getMessage());
            return [];
        }
    }
}
?>