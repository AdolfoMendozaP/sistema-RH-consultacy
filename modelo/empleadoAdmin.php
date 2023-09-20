<?php
require_once 'conexion.php';
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

try {
    $db = new Database();
    $con = $db->conectar();
    $nombre = sanitizeInput($_POST['nombre']);
    $apellido = sanitizeInput($_POST['apellido']);
    $email = sanitizeInput($_POST['email']);
    $alta = sanitizeInput($_POST['alta']);
    $IDdepartamento = sanitizeInput($_POST['IDdepartamento']);
    $status = 'Activo';
    $stmt_check = $con->prepare("SELECT COUNT(*) FROM empleado WHERE Nombre = :nombre AND Apellido = :apellido AND Email = :email AND Alta = :alta");
    $stmt_check->bindParam(':nombre', $nombre);
    $stmt_check->bindParam(':apellido', $apellido);
    $stmt_check->bindParam(':email', $email);
    $stmt_check->bindParam(':alta', $alta);
    $stmt_check->execute();

    $count = $stmt_check->fetchColumn();

    if ($count == 0) {
        $inicialNombre = strtoupper(substr($nombre, 0, 1));
        $inicialApellido = strtoupper(substr($apellido, 0, 1));

        $fechaAlta = date('dYm', strtotime($alta));

        $folio = $inicialNombre . $inicialApellido . $fechaAlta . $IDdepartamento;

        $stmt = $con->prepare("INSERT INTO empleado (Nombre, Apellido, Email, Alta, Status, IDdepartamento, Folio) 
                           VALUES (:nombre, :apellido, :email, :alta, :status, :IDdepartamento, :folio)");

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':alta', $alta);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':IDdepartamento', $IDdepartamento);
        $stmt->bindParam(':folio', $folio);
        $stmt->execute();
        header('Location: ../vista/admin/empleados/');
        exit();
    } else {
        echo "Error: Ya existe un empleado con estos datos.";
        echo '<script>
                setTimeout(function() {
                    window.location.href = "../vista/admin/empleados/create.php";
                }, 3000);
              </script>';
    }
} catch (PDOException $e) {
    echo "Error al insertar el empleado: " . $e->getMessage();
}
?>