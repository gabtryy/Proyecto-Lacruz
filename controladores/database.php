<?php
define('servidor', 'localhost');
define('usuario', 'root');
define('password', '');
define('bd', 'proyecto_lacruz');


$servidor = "mysql:host=" . servidor . ";dbname=" . bd;

try {
    // Conexión PDO con la base de datos
    $pdo = new PDO($servidor, usuario, password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar excepciones para errores de PDO
    echo "La conexión a la base de datos fue exitosa";
} catch (PDOException $k) {
    // Mostrar mensaje de error
    die("Error en la conexión: " . $k->getMessage());
}

$URL = "http://localhost/proyecto-lacruz";
date_default_timezone_set("America/Caracas");
$fechahora = date("Y-m-d H:i:s");

