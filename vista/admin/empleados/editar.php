<?php
require_once '../modelo/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new Database();
        $con = $db->conectar();

        // Obtener los datos del formulario
        $IDempleado = $_POST['IDempleado'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $alta = $_POST['alta'];
        $status = $_POST['status'];
        $IDdepartamento = $_POST['IDdepartamento'];

        // Actualizar el registro del empleado en la base de datos
        $query = "UPDATE empleado
                  SET nombre = :nombre, apellido = :apellido, email = :email, alta = :alta, status = :status, IDdepartamento = :IDdepartamento
                  WHERE IDempleado = :IDempleado";

        $stmt = $con->prepare($query);
        $stmt->bindParam(':IDempleado', $IDempleado);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':alta', $alta);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':IDdepartamento', $IDdepartamento);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error al actualizar el empleado";
        }
    } catch (PDOException $e) {
        echo "Error al actualizar el empleado: " . $e->getMessage();
    }
} else {
    // Obtener el ID del empleado a editar desde la URL
    if (isset($_GET['id'])) {
        $idEmpleado = $_GET['id'];

        try {
            $db = new Database();
            $con = $db->conectar();

            // Consultar el empleado por su ID
            $query = "SELECT * FROM empleado WHERE IDempleado = :IDempleado";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':IDempleado', $idEmpleado);
            $stmt->execute();
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$empleado) {
                echo "Empleado no encontrado";
                exit();
            }
        } catch (PDOException $e) {
            echo "Error al obtener el empleado: " . $e->getMessage();
        }
    } else {
        echo "ID de empleado no proporcionado";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Empleado</title>
</head>
<body>
    <h1>Editar Empleado</h1>
    <form action="editar.php" method="POST">
        <input type="hidden" name="IDempleado" value="<?php echo $empleado['IDempleado']; ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $empleado['nombre']; ?>" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" value="<?php echo $empleado['apellido']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $empleado['email']; ?>" required><br>

        <label for="alta">Alta:</label>
        <input type="date" name="alta" value="<?php echo $empleado['alta']; ?>" required><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo $empleado['status']; ?>" required><br>

        <label for="IDdepartamento">ID Departamento:</label>
        <input type="text" name="IDdepartamento" value="<?php echo $empleado['IDdepartamento']; ?>" required><br>

        <input type="submit" value="Actualizar">
    </form>
</body>
</html>