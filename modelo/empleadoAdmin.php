<?php
require_once 'conexion.php';

try {
    $db = new Database();
    $con = $db->conectar();

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $alta = $_POST['alta'];
    $status = $_POST['status'];
    $iDdepartamento = $_POST['iDdepartamento'];

    $folio = substr($nombre, 0, 1) . substr($apellido, 0, 1) . $alta . date('Ymd');

    // Preparar la consulta SQL para la inserción
    $stmt = $con->prepare("INSERT INTO empleado (Nombre, Apellido, Email, Alta, Status, IDdepartamento, Folio) 
                           VALUES (:nombre, :apellido, :email, :alta, :status, :IDdepartamento, :folio)");

    // Bind de los parámetros
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':alta', $alta);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':IDdepartamento', $iDdepartamento);
    $stmt->bindParam(':folio', $folio);
    $stmt->execute();

    header('Location: ../vista/admin/empleados/');
    exit();
} catch (PDOException $e) {
    echo "Error al insertar el empleado: " . $e->getMessage();
}
?>