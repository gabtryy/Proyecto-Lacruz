<?php

// ============================
// CONFIGURACIÓN GENERAL
// ============================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// ============================
// REDIRECCIÓN INICIAL SI NO HAY PARÁMETROS
// ============================
if (!isset($_GET['c']) && !isset($_GET['m'])) {
    header("Location: index.php?c=login&m=login");
    exit;
}

// ============================
// CONTROL DE SESIÓN
// ============================
if (!isset($_SESSION['cedula']) && ($_GET['c'] ?? '') !== 'login') {
    header("Location: index.php?c=login&m=login");
    exit;
}

// ============================
// CAPTURA DE PARÁMETROS
// ============================
$controlador = $_GET['c'];
$metodo      = $_GET['m'];

// ============================
// RUTA DEL CONTROLADOR
// ============================
$archivo = "controlador/{$controlador}.php";

// ============================
// EJECUCIÓN DEL CONTROLADOR
// ============================
if (file_exists($archivo)) {
    require_once $archivo;
} else {
    echo "<h3>Error: El controlador <strong>'$controlador'</strong> no existe.</h3>";
    echo "<p>Verifique que el archivo <code>controlador/$controlador.php</code> esté creado y que la URL esté bien escrita.</p>";
    exit;
}




