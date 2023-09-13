<?php
class Database 
{
    private $hostname = "localhost";
    private $database = "consultacy";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";

    function conectar() 
    {
        try 
        {
            $conexion = "mysql:host=".$this->hostname.";dbname=".$this->database.";charset=".$this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => FALSE,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
            ];

            $pdo = new PDO($conexion, $this->username, $this->password, $options);

            return $pdo;
        }
        catch (PDOException $e) 
        {
            echo 'Error de conexión: ' . $e->getMessage();
            exit();
        }
    }
}
?>