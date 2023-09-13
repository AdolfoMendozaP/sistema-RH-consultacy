<?php
require_once 'conexion.php';

try {
    $db = new Database();
    $con = $db->conectar();

    // Datos del usuario
    $usuario = "nombre_de_usuario"; // Reemplaza con el nombre de usuario deseado
    $contrasena = generarContrasena(); // Genera una contraseña segura
    $IDempleado = 1; // Reemplaza con el ID del empleado correspondiente

    // Consulta SQL para insertar un nuevo usuario
    $sql = "INSERT INTO usuario (usuario, contrasena, IDempleado) VALUES (:usuario, :contrasena, :IDempleado)";
    
    // Preparar la consulta
    $stmt = $con->prepare($sql);

    // Enlazar parámetros
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->bindParam(':IDempleado', $IDempleado);

    // Ejecutar la consulta
    $stmt->execute();

    echo "Usuario insertado con éxito.";

} catch (PDOException $e) {
    echo "Error al insertar usuario: " . $e->getMessage();
}

// Función para generar una contraseña aleatoria segura
function generarContrasena($longitud = 12) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+[]{}|';
    $contrasena = '';
    $caracteres_longitud = strlen($caracteres);

    for ($i = 0; $i < $longitud; $i++) {
        $indice = rand(0, $caracteres_longitud - 1);
        $contrasena .= $caracteres[$indice];
    }

    return $contrasena;
}
?>