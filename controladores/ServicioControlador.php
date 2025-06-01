<?php
require_once 'models/Mservicio.php';

function listarServicio() {
    $servicio = new ServicioModelo();
    return $servicio->listarServicio();
}

function obtenerServicio($id_servicio) {
    $servicio = new ServicioModelo();
    return $servicio->obtenerServicio($id_servicio);
}

function crearServicio($nombre,$descripcion, $precio_hora) {
    $servicio = new ServicioModelo();
    $servicio->setNombre($nombre);
    $servicio->setDescripcion($descripcion);
    $servicio->setPrecio_hora($precio_hora);
    $servicio->crearServicio();
 
}

function actualizarServicio($id_servicio, $nombre,$descripcion, $precio_hora) {
    $servicio = new ServicioModelo();
    $servicio->setId_servicio($id_servicio);
    $servicio->setNombre($nombre);
    $servicio->setDescripcion($descripcion);
    $servicio->setPrecio_hora($precio_hora);
    $servicio->actualizarServicio();
}

function eliminarServicio($id_servicio) {
    $servicio = new ServicioModelo();
    $servicio->eliminarServicio($id_servicio);
}
?>

