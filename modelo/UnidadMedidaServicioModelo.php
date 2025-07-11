<?php
require_once 'modelo/conexion.php';

class UnidadMedidaServicio extends Conexion {
    
    private $id_unidad_medida;
    private $nombre;

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

    public function listar() {
        try {
            $sql = "SELECT * FROM unidades_medida_servicio ORDER BY nombre";
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