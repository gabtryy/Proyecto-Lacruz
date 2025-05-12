


<?php

class conexion {
    protected $conexion;

    public function __construct(){
        try {
            $this->conexion = new PDO("mysql:host=localhost;dbname=proyecto_lacruz","root","");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die("error de conexion".$e->getMessage());
        }
    }
}

$URL = "http://localhost/proyecto-lacruz";
date_default_timezone_set("America/Caracas");
$fechahora = date("Y-m-d H:i:s");
?>