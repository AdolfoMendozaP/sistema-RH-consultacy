<?php
require_once 'conexion.php';

class RecuperarContrasena
{
    private $con;

    public function __construct($conn)
    {
        $this->con = $conn;
        if (session_status() == PHP_SESSION_NONE) 
        {
            session_start();
        }
    }

    public function generateCSRFToken()
    {
        if (empty($_SESSION['csrf_token'])) 
        {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public function ResetPassword($usuario, $folio, $csrfToken)
    {
        if ($csrfToken !== $_SESSION['csrf_token']) 
        {
            return "Token CSRF inválido";
        }

        $query = "SELECT * FROM usuario WHERE usuario = :usuario AND IDempleado IN (SELECT IDempleado FROM empleado WHERE folio = :folio)";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->bindParam(":folio", $folio);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result !== false) 
        {
            $newPassword = $this->generateRandomPassword(12);
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $userID = $result["IDusuario"];

            $updateQuery = "UPDATE usuario SET contrasena = :contrasena WHERE IDusuario = :idUsuario";
            $updateStmt = $this->con->prepare($updateQuery);
            $updateStmt->bindParam(":contrasena", $hashedPassword);
            $updateStmt->bindParam(":idUsuario", $userID);
            $updateStmt->execute();

            // Devolver la contraseña nueva
            return $newPassword;
        } 
        else 
        {
            return "Los datos proporcionados no son válidos.";
        }
    }

    private function generateRandomPassword($length)
    {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
        $password = "";
        $charLength = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, $charLength - 1);
            $password .= $characters[$index];
        }

        return $password;
    }
}
?>