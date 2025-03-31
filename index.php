<?php
// index.php

session_start(); // Iniciar la sesión

// Incluye el archivo de conexión a la base de datos
include_once('database.php');

// Incluye el controlador
include_once('controladores/login.php');

$loginControl = new Lcontroler($pdo);



// Verifica si el usuario ya está logueado
if (isset($_SESSION['user_id'])) {
    header('Location: '.$URL.'/vistas/inicio.php');
    exit; 
    
}
else
{
    $loginControl->MostrarLogin();
}

// Crear una instancia del controlador y pasarle $pdo


if(isset($_POST['btn-cerrar'])){
    $loginControl->Cerrarsession();
}

if (isset($_POST['btnLogin'])) {
    $loginControl->login();
  
} else {
    $loginControl->MostrarLogin();
}
