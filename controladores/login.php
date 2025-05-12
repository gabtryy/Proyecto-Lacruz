<?php
session_start(); // Mover al inicio del archivo
require_once __DIR__ . '/../models/Mlogin.php'; // Corregir ruta

$loginControl = new usuario();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $User = $loginControl->ObtenerPoremail($email);

    if ($password == $User['password']) {
        $_SESSION['user_id'] = $User['id'];
        $_SESSION['user_email'] = $User['email'];
        $_SESSION['user_name'] = $User['nombre'];

        header("Location: ../vistas/inicio.php");
        exit;
    } else {
        $msj = "Credenciales incorrectas";
        require __DIR__ . '/../login.php';
    }
}
