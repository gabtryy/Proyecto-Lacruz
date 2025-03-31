<?php
include_once('database.php');

//loginControl = new Lcontroler($pdo);
//$loginControl->Cerrarsession();
session_start();
session_unset();
session_destroy();
header('Location: ../index.php');
