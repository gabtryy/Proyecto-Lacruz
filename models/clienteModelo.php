<?php

	require_once __DIR__ . '/../app/database.php';

	class clienteModelo extends conexion
	{
		private $rif;
		private $nombre;
		private $telefono;
		private $correo;
		private $direccion;
		private $fecha_registro;

		public function __construct() {

			parent:: __construct();
			
		}

		public function getRif() {

			return $this->rif;

		}

		public function setRif($rif) {

			$this->rif = $rif;

		}

		public function getNombre() {

			return $this->nombre;

		}

		public function setNombre($nombre) {

			$this->nombre = $nombre;

		}

		public function getTelefono(){

			return $this->telefono;

		}

		public function setTelefono($telefono) {

			$this->telefono = $telefono;

		}

		public function getCorreo(){

			return $this->correo;

		}

		public function setCorreo($correo) {

			$this->correo = $correo;

		}

		public function getDireccion(){

			return $this->direccion;

		}

		public function setDireccion($direccion) {

			$this->direccion = $direccion;

		}

		public function getFecha_registro(){

			return $this->fecha_registro;

		}

		public function setFecha_registro($fecha_registro) {

			$this->fecha_registro = $fecha_registro;

		}

		//-------------------------------------------------------------------------------------------------//

		public function listar() {
    $stmt = $this->conexion->query("SELECT * FROM cliente");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
		}

		public function obtener($rif) {

			$stmt = $this->conexion->prepare("SELECT * FROM cliente WHERE rif = ?");

			$stmt->execute([$rif]);

			return  $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

		public function crear() {

			$stmt = $this->conexion->prepare("INSERT INTO cliente(rif, nombre, telefono, correo, direccion, fecha_registro) VALUES (?, ?, ?, ?, ?, ?)");

			$stmt->execute([$this->rif, $this->nombre, $this->telefono, $this->correo, $this->direccion, $this->fecha_registro]);

		}

		public function actualizar() {

			$stmt = $this->conexion->prepare("UPDATE cliente SET nombre = ?, telefono = ?, correo = ?, direccion = ?, fecha_registro = ? WHERE rif = ?");

			$stmt->execute([ $this->nombre, $this->telefono, $this->correo, $this->direccion, $this->fecha_registro, $this->rif]);

		} 

		public function eliminar($rif) {

			$stmt = $this->conexion->prepare("DELETE FROM cliente WHERE rif = ?");

			$stmt->execute([$rif]);

		} 



	}

?>