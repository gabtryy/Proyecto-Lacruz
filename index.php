<?php
session_start();
include_once('app/database.php');
include_once('models/Mlogin.php');

$loginControl = new usuario();

// Verificar si ya está logueado
if (isset($_SESSION['user_id'])) {
    header('Location: vistas/inicio.php');
    exit;
}

// Manejar cierre de sesión
if(isset($_POST['btn-cerrar'])) {
    $loginControl->Cerrarsession();
}

// Mostrar login si no está autenticado
if (!isset($_SESSION['user_id'])) {
    $loginControl->MostrarLogin();
    exit;
}