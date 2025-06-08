<?php
//requerir modelos


switch ($metodo) {
    case 'index':
        require 'vista/clientes/index.php';
        break;
    case 'crear':
        require 'vista/clientes/crear.php';
        break;
   
    default:
        echo "Acción no válida.";
        break;
}

