<?php
require_once '../../../modelo/conexion.php';

if (isset($_GET['id'])) {
    try {
        $db = new Database();
        $con = $db->conectar();
        $IDempleado = $_GET['id'];

        $query_delete_usuario = "DELETE FROM usuario WHERE IDempleado = :IDempleado";
        $stmt_delete_usuario = $con->prepare($query_delete_usuario);
        $stmt_delete_usuario->bindParam(':IDempleado', $IDempleado);

        $stmt_delete_usuario->execute();

        $query_delete_empleado = "DELETE FROM empleado WHERE IDempleado = :IDempleado";
        $stmt_delete_empleado = $con->prepare($query_delete_empleado);
        $stmt_delete_empleado->bindParam(':IDempleado', $IDempleado);

        if ($stmt_delete_empleado->execute()) {
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