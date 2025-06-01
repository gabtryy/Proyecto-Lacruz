<?php
require_once 'models/Mprovedor.php';

function listarProvedor() {
    $provedor = new provedorModelo();
    return $provedor->listar();
}

function obtenerProvedor($rif) {
    $provedor = new provedorModelo();
    return $provedor->obtener($rif);
}

	function crearProvedor($rif, $nombre, $telefono, $correo,) {

		$provedor = new provedorModelo();

		$provedor->setRif($rif);

		$provedor->setNombre($nombre);

		$provedor->setTelefono($telefono);

		$provedor->setCorreo($correo);

		$provedor->crear();

	}
function eliminarprovedor($rif) {
    $servicio = new provedorModelo();
    $servicio->eliminar($rif);
}    





