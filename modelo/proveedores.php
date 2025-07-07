<?php
require_once 'modelo/conexion.php';

class ProveedorModel extends Conexion {
public function registrarProveedor($datos) {
    $sql = "INSERT INTO proveedores (id_proveedores, nombre, telefono, correo, id_direccion) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        $datos['id_proveedores'],
        $datos['nombre'],
        $datos['telefono'],
        $datos['correo'],
        $datos['id_direccion'],
        
    ]);
}

public function listar() {
        $sql = "SELECT
    p.id_proveedores,
    p.nombre AS nombre_provedor,
    p.telefono,
    p.correo,
    d.calle,
    ciu.nombre AS ciudad,
    mun.nombre AS municipio,
    est.nombre AS estado,
    ciu.codigo_postal
FROM
    proveedores p
JOIN
    direccion d ON p.id_direccion = d.id_direccion 
JOIN
    ciudad ciu ON d.id_ciudad = ciu.id_ciudad
JOIN
    municipio mun ON d.id_municipio = mun.id_municipio
JOIN
    estado est ON d.id_estado = est.id_estado
ORDER BY
    id_proveedores ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function eliminar($id_proveedores)
{
$sql = "DELETE FROM proveedores WHERE id_proveedores = ?";    

$stmt = $this->pdo->prepare($sql);
$stmt->execute([$id_proveedores]);


}
public function obtener($id_proveedores)
    {
        $sql = "SELECT
            p.id_proveedores,
            p.nombre AS nombre_provedor,
            p.telefono,
            p.correo,
            d.calle,
            d.id_estado,       
            d.id_municipio,    
            d.id_ciudad,       
            ciu.nombre AS nombre_ciudad,
            mun.nombre AS nombre_municipio,
            est.nombre AS nombre_estado,
            ciu.codigo_postal
        FROM
            proveedores p
        JOIN
            direccion d ON p.id_direccion = d.id_direccion
        JOIN
            ciudad ciu ON d.id_ciudad = ciu.id_ciudad
        JOIN
            municipio mun ON d.id_municipio = mun.id_municipio
        JOIN
            estado est ON d.id_estado = est.id_estado
        WHERE
            p.id_proveedores = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_proveedores]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function editarProveedorYDireccion($id_proveedores, $datosProveedor, $datosDireccion) {
        try {
            $this->pdo->beginTransaction(); 

            
            $sqlProveedor = "UPDATE proveedores
                           SET nombre = ?, telefono = ?, correo = ?
                           WHERE id_proveedores = ?";
            $stmtProveedor = $this->pdo->prepare($sqlProveedor);
            $stmtProveedor->execute([
                $datosProveedor['nombre'],
                $datosProveedor['telefono'],
                $datosProveedor['correo'],
                $id_proveedores
            ]);

           
            $stmtGetIdDireccion = $this->pdo->prepare("SELECT id_direccion FROM proveedores WHERE id_proveedores = ?");
            $stmtGetIdDireccion->execute([$id_proveedores]);
            $idDireccion = $stmtGetIdDireccion->fetchColumn();

            if (!$idDireccion) {
                throw new Exception("No se encontró la dirección asociada para el proveedor con Id Proveedor: " . $id_proveedores);
            }

            
            $sqlDireccion = "UPDATE direccion
                             SET calle = ?, id_estado = ?, id_ciudad = ?, id_municipio = ?
                             WHERE id_direccion = ?";
            $stmtDireccion = $this->pdo->prepare($sqlDireccion);
            $stmtDireccion->execute([
                $datosDireccion['calle'],
                $datosDireccion['id_estado'],
                $datosDireccion['id_ciudad'],
                $datosDireccion['id_municipio'],
                $idDireccion
            ]);

            $this->pdo->commit(); 
            return true; 
        } catch (Exception $e) {
            $this->pdo->rollBack(); 
            error_log("Error al editar proveedor y dirección: " . $e->getMessage()); 
            return false; 
        }
    }
}

?>