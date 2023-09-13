<?php
require_once '../modelo/conexion.php';

if (isset($_GET['id'])) {
    try {
        $db = new Database();
        $con = $db->conectar();

        // Obtener el ID del empleado a eliminar desde la URL
        $idEmpleado = $_GET['id'];

        // Preparar la consulta SQL para eliminar el registro
        $query = "DELETE FROM empleado WHERE IDempleado = :IDempleado";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':IDempleado', $idEmpleado);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error al eliminar el empleado";
        }
    } catch (PDOException $e) {
        echo "Error al eliminar el empleado: " . $e->getMessage();
    }
} else {
    echo "ID de empleado no proporcionado";
    exit();
}
?>