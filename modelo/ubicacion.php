<?php
require_once 'modelo/conexion.php';

class UbicacionModel extends Conexion {
    public function listarE() {
        $sql = "SELECT id_estado, nombre FROM estado";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Omunicipios($id_estado) {
        $sql = "SELECT id_municipio, nombre FROM municipio WHERE id_estado = ? ORDER BY nombre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_estado]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Ociudades($id_municipio) {
        $sql = "SELECT id_ciudad, nombre FROM ciudad WHERE id_municipio = ? ORDER BY nombre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_municipio]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function registrarDireccion($datos) {
    $sql = "INSERT INTO direccion (id_estado, id_ciudad, id_municipio, calle) VALUES (?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$datos['id_estado'], $datos['id_ciudad'], $datos['id_municipio'], $datos['calle']]);
    return $this->pdo->lastInsertId();
}
}
?>
