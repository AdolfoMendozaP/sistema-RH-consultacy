<?php
require_once 'conexion.php';

class Usuario 
{
    private $con;

    public function __construct() 
    {
        $db = new Database();
        $this->con = $db->conectar();
    }

    public function login($usuario, $contrasena) 
    {
        $query = "SELECT usuario.*, empleado.status FROM usuario INNER JOIN empleado ON usuario.IDempleado = empleado.IDempleado WHERE usuario.usuario = :usuario AND usuario.contrasena = :contrasena AND empleado.status = 'Activo'";
        $s = $this->con->prepare($query);

        $s->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $s->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);

        $s->execute();

        return $s->fetch(PDO::FETCH_ASSOC);
    }
}
?>