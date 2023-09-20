<?php
require_once '../../../modelo/conexion.php';

if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    try {
        $db = new Database();
        $con = $db->conectar();

        $query = "DELETE FROM usuario WHERE IDusuario = :id";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error al eliminar el usuario.";
        }
    } catch (PDOException $e) {
        echo "Error al conectar a la base de datos: " . $e->getMessage();
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>