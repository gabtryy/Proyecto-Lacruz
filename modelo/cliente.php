<?php
require_once 'modelo/conexion.php';

class ClienteModel extends Conexion {
    // Atributos privados
    private $rif;
    private $nombre;
    private $apellido;
    private $telefono;
    private $correo;
    private $cedula_usuario;
    private $id_direccion;
    private $fecha_registro;
    private $razon_social;

    // Métodos set y get
    public function setRif($rif) { $this->rif = $rif; }
    public function getRif() { return $this->rif; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function getNombre() { return $this->nombre; }

    public function setApellido($apellido) { $this->apellido = $apellido; }
    public function getApellido() { return $this->apellido; }

    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function getTelefono() { return $this->telefono; }

    public function setCorreo($correo) { $this->correo = $correo; }
    public function getCorreo() { return $this->correo; }

    public function setCedulaUsuario($cedula_usuario) { $this->cedula_usuario = $cedula_usuario; }
    public function getCedulaUsuario() { return $this->cedula_usuario; }

    public function setIdDireccion($id_direccion) { $this->id_direccion = $id_direccion; }
    public function getIdDireccion() { return $this->id_direccion; }

    public function setFechaRegistro($fecha_registro) { $this->fecha_registro = $fecha_registro; }
    public function getFechaRegistro() { return $this->fecha_registro; }

    public function setRazonSocial($razon_social) {$this->razon_social = $razon_social; }
    public function getRazonSocial() { return $this->razon_social; }

    // Registrar cliente usando atributos
    public function registrarCliente() {
        $sql = "INSERT INTO cliente (rif, nombre, apellido, telefono, correo, cedula_usuario, razon_social, id_direccion, fecha_registro) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $this->rif,
            $this->nombre,
            $this->apellido,
            $this->telefono,
            $this->correo,
            $this->cedula_usuario,
            $this->razon_social,
            $this->id_direccion,
            $this->fecha_registro
        ]);
    }

    public function listar() {
        $sql = "SELECT
            c.rif,
            c.nombre AS nombre_cliente,
            c.apellido AS apellido_cliente,
            c.telefono,
            c.correo,
            c.fecha_registro,
            u.username AS nombre_usuario, 
            d.calle,
            ciu.nombre AS ciudad,
            mun.nombre AS municipio,
            est.nombre AS estado,
            ciu.codigo_postal
        FROM
            cliente c
        JOIN
            usuario u ON c.cedula_usuario = u.cedula 
        JOIN
            direccion d ON c.id_direccion = d.id_direccion
        JOIN
            ciudad ciu ON d.id_ciudad = ciu.id_ciudad
        JOIN
            municipio mun ON d.id_municipio = mun.id_municipio
        JOIN
            estado est ON d.id_estado = est.id_estado
        ORDER BY
            fecha_registro ASC;";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($rif) {
        $sql = "DELETE FROM cliente WHERE rif = ?";    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$rif]);
    }

    public function obtener($rif) {
        $sql = "SELECT
            c.rif,
            c.nombre AS nombre_cliente,
            c.apellido AS apellido_cliente,
            c.telefono,
            c.correo,
            c.fecha_registro,
            u.username AS nombre_usuario,
            d.calle,
            d.id_estado,       
            d.id_municipio,    
            d.id_ciudad,       
            ciu.nombre AS nombre_ciudad,
            mun.nombre AS nombre_municipio,
            est.nombre AS nombre_estado,
            ciu.codigo_postal
        FROM
            cliente c
        JOIN
            usuario u ON c.cedula_usuario = u.cedula
        JOIN
            direccion d ON c.id_direccion = d.id_direccion
        JOIN
            ciudad ciu ON d.id_ciudad = ciu.id_ciudad
        JOIN
            municipio mun ON d.id_municipio = mun.id_municipio
        JOIN
            estado est ON d.id_estado = est.id_estado
        WHERE
            c.rif = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$rif]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editarClienteYDireccion($rifCliente, $datosCliente, $datosDireccion) {
        try {
            // Validación extra (opcional)
            if (
                empty($datosDireccion['id_estado']) ||
                empty($datosDireccion['id_municipio']) ||
                empty($datosDireccion['id_ciudad'])
            ) {
                throw new Exception("Estado, municipio y ciudad son obligatorios.");
            }

            $this->pdo->beginTransaction(); 

            $sqlCliente = "UPDATE cliente
                           SET nombre = ?, apellido = ?, telefono = ?, correo = ?
                           WHERE rif = ?";
            $stmtCliente = $this->pdo->prepare($sqlCliente);
            $stmtCliente->execute([
                $datosCliente['nombre'],
                $datosCliente['apellido'],
                $datosCliente['telefono'],
                $datosCliente['correo'],
                $rifCliente
            ]);

            $stmtGetIdDireccion = $this->pdo->prepare("SELECT id_direccion FROM cliente WHERE rif = ?");
            $stmtGetIdDireccion->execute([$rifCliente]);
            $idDireccion = $stmtGetIdDireccion->fetchColumn();

            if (!$idDireccion) {
                throw new Exception("No se encontró la dirección asociada para el cliente con RIF: " . $rifCliente);
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
            error_log("Error al editar cliente y dirección: " . $e->getMessage()); 
            return false; 
        }
    }
    public function obtenerpresupuestos($rif) {
        $sql = "SELECT p.id_factura, p.fecha, p.total_general, p.estatus
                FROM factura p
                JOIN cliente c ON p.rif = c.rif
                WHERE c.rif = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$rif]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>