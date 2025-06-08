<?php
require_once 'modelo/Conexion.php';

class Usuario extends Conexion {
    private $usuario;
    private $clave;

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function getClave() {
        return $this->clave;
    }

    /**
     * Registra un nuevo usuario con contraseña hasheada
     * @param string $usuario
     * @param string $clave
     * @return bool
     */
    public function registrar($usuario, $clave) {
        try {
            $pdo = $this->pdo;

            $sql = "INSERT INTO usuarios (usuario, clave) VALUES (:usuario, :clave)";
            $stmt = $pdo->prepare($sql);

            // Encripta la clave antes de guardarla
            $claveHash = password_hash($clave, PASSWORD_DEFAULT);

            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':clave', $claveHash);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Ideal para registrar el error en un log
            error_log("Error al registrar usuario: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Busca un usuario por nombre de usuario
     * @param string $usuario
     * @return array|null
     */
    public function buscarPorCredenciales($usuario) {
        try {
            $sql = "SELECT * FROM usuario WHERE username = :username";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['username' => $usuario]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al buscar usuario: " . $e->getMessage());
            return null;
        }
    }

    // Obtener todos los usuarios
    public function listar() {
        $sql = "SELECT id, usuario FROM usuarios";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar usuario por ID
    public function buscarPorId($id) {
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // <-- IMPORTANTE
}




    // Actualizar usuario
    public function actualizar($id, $usuario, $clave = null) {
        try {
            if ($clave) {
                $sql = "UPDATE usuarios SET usuario = :usuario, clave = :clave WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $claveHash = password_hash($clave, PASSWORD_DEFAULT);
                $stmt->bindParam(':clave', $claveHash);
            } else {
                $sql = "UPDATE usuarios SET usuario = :usuario WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
            }

            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Eliminar usuario
    public function eliminar($id) {
        try {
            $sql = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
