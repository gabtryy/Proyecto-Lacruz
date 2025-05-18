<?php
require_once __DIR__ . '/../app/database.php';

class usuario extends conexion {
    public function ObtenerPoremail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function Cerrarsession() {
        session_start();
        session_unset();
        session_destroy();
        header('Location:index.php');
        exit;
    }
    
    public function MostrarLogin() {
        header('Location:login.php');
        exit;
    }
}