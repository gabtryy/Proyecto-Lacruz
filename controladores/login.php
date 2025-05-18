<?php

require_once __DIR__ . '/../models/Mlogin.php'; // Corregir ruta



    function loginC($email, $password){

    $loginControl = new usuario();
    $User = $loginControl->ObtenerPoremail($email);

    if ($password == $User['password']) {
        session_start(); // Mover al inicio del archivo
        $_SESSION['user_id'] = $User['id'];
        $_SESSION['user_email'] = $User['email'];
        $_SESSION['user_name'] = $User['nombre'];

        header("Location: index.php");
        exit;
    } else {
        $msj = "Credenciales incorrectas";
        require __DIR__ . '/../login.php';
    }
}
    function cerrar(){
        $loginControl = new usuario();

        $loginControl->Cerrarsession();
    }