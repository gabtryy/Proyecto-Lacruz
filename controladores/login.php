<?php
include_once('database.php');
require_once __DIR__ . '/../models/Mlogin.php';



class Lcontroler {

    private $Mlogin; 

    public function __construct($pdo) {
        global $pdo; 
        $this->Mlogin = new usuario($pdo);
    }

    public function MostrarLogin()
    {
        header('Location: login.php');
    }

    public function Login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
           

            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $User = $this->Mlogin->ObtenerPoremail($email);

                if ($password == $User['password'])
                {
                    session_start();
                    $_SESSION['user_id'] = $User['id'];
                    $_SESSION['user_email'] = $User['email'];
                    $_SESSION['user_name'] = $User['nombre'];

                    header('Location: index.php');
                    exit;
                }
                else
                {
                    echo "credenciales incorrectas";
                    require __DIR__ . '/../login.php';
                }
        }
    }
    public function Cerrarsession(){
        
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;

    }
}