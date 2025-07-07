<?php
require_once 'modelo/conexion.php';

class Ubicacion extends Conexion {
    
    public function listarEstados() {
        try {
            $sql = "SELECT id_estado, nombre FROM estado";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Ubicacion->listarEstados(): " . $e->getMessage());
            return [];
        }
    }

    public function listarMunicipios($id_estado) {
        try {
            $sql = "SELECT id_municipio, nombre FROM municipio WHERE id_estado = ? ORDER BY nombre";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_estado]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Ubicacion->listarMunicipios(): " . $e->getMessage());
            return [];
        }
    }

    public function listarParroquias($id_municipio) {
    try {
        $sql = "SELECT id_parroquia, nombre FROM parroquia WHERE id_municipio = ? ORDER BY nombre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_municipio]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result ?: []; // Devuelve array vacío si no hay resultados
    } catch (PDOException $e) {
        error_log("Error en Ubicacion->listarParroquias(): " . $e->getMessage());
        return [];
    }
}

public function registrarDireccion($datos) {
    try {
        // Verificar que todos los campos requeridos están presentes
        if(!isset($datos['id_estado']) || !isset($datos['id_municipio']) || 
           !isset($datos['id_parroquia']) || !isset($datos['calle'])) {
            error_log("Datos incompletos para dirección: " . print_r($datos, true));
            return false;
        }

        $sql = "INSERT INTO direccion (id_estado, id_municipio, id_parroquia, calle) 
                VALUES (:id_estado, :id_municipio, :id_parroquia, :calle)";
        $stmt = $this->pdo->prepare($sql);
        
        if($stmt->execute($datos)) {
            return $this->pdo->lastInsertId();
        } else {
            $error = $stmt->errorInfo();
            error_log("Error SQL al registrar dirección: " . print_r($error, true));
            return false;
        }
    } catch (PDOException $e) {
        error_log("Excepción al registrar dirección: " . $e->getMessage());
        return false;
    }
    }

    public function actualizarDireccion($datos) {
    try {
        $sql = "UPDATE direccion SET 
                id_estado = :id_estado,
                id_municipio = :id_municipio,
                id_parroquia = :id_parroquia,
                calle = :calle
                WHERE id_direccion = :id_direccion";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($datos);
    } catch (PDOException $e) {
        error_log("Error en Ubicacion->actualizarDireccion(): " . $e->getMessage());
        return false;
    }
}
}
?>