<?php

require_once 'modelo/conexion.php';

class PresupuestoModel extends Conexion {

    public function listar(){
        $sql = "SELECT
f.id_factura,
c.rif,
c.nombre AS nombre_cliente,
f.total_general,
f.fecha
FROM factura f 

JOIN cliente c ON f.rif = c.rif";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tasa(){
        $sql = "SELECT * FROM tasa_cambio";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function formasdePago() {
        $sql = "SELECT * FROM condicion_pago";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function iva() {
        $sql = "SELECT * FROM iva";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function guardarpresupuesto($datosPresupuesto, $servicios, $productos) {
    $this->pdo->beginTransaction();

    $sqlPresupuesto = "INSERT INTO factura (rif, fecha, numero_orden, id_iva, total_iva, total_general, id_tasa, estatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtPresupuesto = $this->pdo->prepare($sqlPresupuesto);
    $stmtPresupuesto->execute([
        $datosPresupuesto['rif'],
        $datosPresupuesto['fecha'],
        $datosPresupuesto['orden_compra'],
        //condicion de pago
        $datosPresupuesto['id_iva'],
        $datosPresupuesto['total_iva'],
        $datosPresupuesto['total'],
        $datosPresupuesto['id_tasa'],
       
        $datosPresupuesto['estatus']
    ]);
    
    $idPresupuesto = $this->pdo->lastInsertId();

    foreach ($servicios as $servicio) {
        $sqlServicio = "INSERT INTO servicio_det (id_servicio, id_factura, cantidad) VALUES (?, ?, ?)";
        $stmtServicio = $this->pdo->prepare($sqlServicio);
        $stmtServicio->execute([
            $servicio['id_servicio'],
            $idPresupuesto,
            $servicio['cantidad']
        ]);
    }
    foreach ($productos as $producto) {
        $sqlProducto = "INSERT INTO producto_det (id_producto, id_factura, cantidad) VALUES (?, ?, ?)";
        $stmtProducto = $this->pdo->prepare($sqlProducto);
        $stmtProducto->execute([
            $producto['id_producto'],
            $idPresupuesto,
            $producto['cantidad']
        ]);
    }
    $this->pdo->commit();
   }


   

    public function eliminarPresupuesto($id) {
        $this->pdo->beginTransaction();
        
        $sqlEliminarServicios = "DELETE FROM servicio_det WHERE id_factura = ?";
        $stmtServicios = $this->pdo->prepare($sqlEliminarServicios);
        $stmtServicios->execute([$id]);
        
        $sqlEliminarPresupuesto = "DELETE FROM factura WHERE id_factura = ?";
        $stmtPresupuesto = $this->pdo->prepare($sqlEliminarPresupuesto);
        $stmtPresupuesto->execute([$id]);
        
        $this->pdo->commit();
    }
     public function obtenerP($id) {
        $sql = "SELECT 
        f.id_factura,
        f.fecha,
        f.numero_orden,
        cp.forma AS condicion_pago,
        f.total_general,
        f.total_iva,
        f.estatus,
        c.rif,
        c.razon_social,
        c.nombre AS nombre_cliente,
        c.apellido AS apellido_cliente,
        c.telefono AS telefono_cliente,
        c.correo AS correo_cliente,
        e.nombre AS estado,
        m.nombre AS municipio,
        ci.nombre AS ciudad,
        d.calle,
        p.id_producto,
        p.nombre AS producto_nombre,
        pd.cantidad AS producto_cantidad,
        p.precio AS producto_precio_unitario,
        (p.precio * pd.cantidad) AS producto_subtotal,
        ts.id_servicio,
        ts.nombre AS servicio_nombre,
        sd.cantidad AS servicio_cantidad,
        ts.precio_base AS servicio_precio_unitario,
        (ts.precio_base * sd.cantidad) AS servicio_subtotal
    FROM factura f
    JOIN condicion_pago cp ON f.id_condicion_pago = cp.id_condicion_pago
    JOIN cliente c ON f.rif = c.rif
    JOIN direccion d ON c.id_direccion = d.id_direccion
    LEFT JOIN estado e ON d.id_estado = e.id_estado
    LEFT JOIN municipio m ON d.id_municipio = m.id_municipio
    LEFT JOIN ciudad ci ON d.id_ciudad = ci.id_ciudad
    LEFT JOIN producto_det pd ON f.id_factura = pd.id_factura
    LEFT JOIN productos p ON pd.id_producto = p.id_producto
    LEFT JOIN servicio_det sd ON f.id_factura = sd.id_factura
    LEFT JOIN tipo_servicio ts ON sd.id_servicio = ts.id_servicio
    WHERE f.id_factura = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $presupuesto = [];
        $productos = [];
        $servicios = [];

        foreach ($resultados as $row) {
            if (empty($presupuesto)) {
                $presupuesto = [
                    'id_factura' => $row['id_factura'] ?? '',
                    'fecha' => $row['fecha'] ?? '',
                    'numero_orden' => $row['numero_orden'] ?? '',
                    'condicion_pago' => $row['condicion_pago'] ?? '',
                    'total_general' => $row['total_general'] ?? '',
                    'total_iva' => $row['total_iva'] ?? '',
                    'estatus' => $row['estatus'] ?? '',
                    'rif' => $row['rif'] ?? '',
                    'razon_social' => $row['razon_social'] ?? '',
                    'nombre_cliente' => $row['nombre_cliente'] ?? '',
                    'apellido_cliente' => $row['apellido_cliente'] ?? '',
                    'telefono_cliente' => $row['telefono_cliente'] ?? '',
                    'correo_cliente' => $row['correo_cliente'] ?? '',
                    'estado' => $row['estado'] ?? '',
                    'municipio' => $row['municipio'] ?? '',
                    'ciudad' => $row['ciudad'] ?? '',
                    'calle' => $row['calle'] ?? '',
                ];
            }
            if (!empty($row['id_producto'])) {
                $productos[] = [
                    'id_producto' => $row['id_producto'],
                    'producto_nombre' => $row['producto_nombre'],
                    'producto_cantidad' => $row['producto_cantidad'],
                    'producto_precio_unitario' => $row['producto_precio_unitario'],
                    'producto_subtotal' => $row['producto_subtotal'],
                ];
            }
            if (!empty($row['id_servicio'])) {
                $servicios[] = [
                    'id_servicio' => $row['id_servicio'],
                    'servicio_nombre' => $row['servicio_nombre'],
                    'servicio_cantidad' => $row['servicio_cantidad'],
                    'servicio_precio_unitario' => $row['servicio_precio_unitario'],
                    'servicio_subtotal' => $row['servicio_subtotal'],
                ];
            }
        }
        return [
            'presupuesto' => $presupuesto,
            'productos' => $productos,
            'servicios' => $servicios
        ];
    }
}