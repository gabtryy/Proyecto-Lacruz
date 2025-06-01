<?php
require_once  __DIR__ . '/../app/database.php';

class provedorModelo extends conexion {
        private $rif;
		private $nombre;
		private $telefono;
		private $correo;
	

    public function __construct() {
        parent::__construct();
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

			return $this->nombre;

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

    public function listar() {
    $stmt = $this->conexion->query("SELECT * FROM provedores");
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
		}

    public function obtener($rif) {

			$stmt = $this->conexion->prepare("SELECT * FROM provedores WHERE rif = ?");

			$stmt->execute([$rif]);

			return  $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

    public function crear() {

			$stmt = $this->conexion->prepare("INSERT INTO provedores (rif, nombre, telefono, correo) VALUES (?, ?, ?, ?)");

			$stmt->execute([$this->rif, $this->nombre, $this->telefono, $this->correo]);

		}
    public function actualizarServicio() {
        $stmt = $this->conexion->prepare("UPDATE servicio SET nombre = ?, descripcion = ?, precio_hora = ? WHERE id_servicio = ?");
        $stmt->execute([$this->nombre,$this->descripcion, $this->precio_hora, $this->id_servicio]);
    }

    public function eliminar($rif) {
        $stmt = $this->conexion->prepare("DELETE FROM provedores WHERE rif = ?");
        $stmt->execute([$rif]);
    }
}
?>
