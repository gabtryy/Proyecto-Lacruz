<?php

	require_once __DIR__ . '/../models/clienteModelo.php';


	function listarCliente() {

		$cliente = new clienteModelo();

		return $cliente->listar();

	}

	function obtenerCliente($rif) {

		$cliente = new clienteModelo();

		return $cliente->obtener($rif);

	}

	function crearCliente($rif, $nombre, $telefono, $correo, $direccion) {

		$fecha_registro = date("Y-m-d H:i:s");

		$cliente = new clienteModelo();

		$cliente->setRif($rif);

		$cliente->setNombre($nombre);

		$cliente->setTelefono($telefono);

		$cliente->setCorreo($correo);

		$cliente->setDireccion($direccion);

		$cliente->setFecha_registro($fecha_registro);

		$cliente->crear();

	}

	function actualizarCliente($rif, $nombre, $telefono, $correo, $direccion) {

		$fecha_registro = date("Y-m-d H:i:s");

		$cliente = new clienteModelo();

		$cliente->setRif($rif);

		$cliente->setNombre($nombre);

		$cliente->setTelefono($telefono);

		$cliente->setCorreo($correo);

		$cliente->setDireccion($direccion);

		$cliente->setFecha_registro($fecha_registro);

		$cliente->actualizar();

	}

	function eliminarCliente($rif) {

		$cliente = new clienteModelo();

		$cliente->eliminar($rif);

	}

?>