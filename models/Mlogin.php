<?php

require_once __DIR__ . '/../controladores/database.php';
class usuario {

    private $pdo; 

    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ObtenerPoremail($email)
    {
        

        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}