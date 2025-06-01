<?php
require_once 'models/usuarioModelo.php';

/**
 * Función para listar todos los usuarios.
 * @return array
 */
function listarusuario() {
    $usuario = new usuarioModelo();
    return $usuario->listar();
}

/**
 * Función para obtener un usuario específico.
 * @param int $id
 * @return array|false
 */
function obtenerusuario($id) {
    $usuario = new usuarioModelo();
    return $usuario->obtener($id);
}

/**
 * Función para crear un nuevo usuario.
 * @param string $nombre
 
 */
function crearusuario($nombre, $email, $password) {
    $usuario = new usuarioModelo();
    $usuario->setNombre($nombre);
    $usuario->setEmail($email);
    $usuario->setPassword($password);
    $usuario->crear();
}

/**
 * Función para actualizar un usuario existente.
 * @param int $id
 * @param string $nombre
 * @param string $email
 */
function actualizarusuario($id, $nombre, $email, $password) {
    $usuario = new usuarioModelo();
    $usuario->setId($id);
    $usuario->setNombre($nombre);
    $usuario->setEmail($email);
    $usuario->setPassword($password);
    $usuario->actualizar();
}

/**
 * Función para eliminar un usuario por su ID.
 * @param int $id
 */
function eliminarusuario($id) {
    $usuario = new usuarioModelo();
    $usuario->eliminar($id);
}
?>

