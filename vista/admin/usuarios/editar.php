<?php
require_once '../modelo/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new Database();
        $con = $db->conectar();

        // Obtener los datos del formulario
        $IDusuario = $_POST['IDusuario'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $IDempleado = $_POST['IDempleado'];

        // Actualizar el registro del usuario en la base de datos
        $query = "UPDATE usuario
                  SET usuario = :usuario, contrasena = :contrasena, IDempleado = :IDempleado
                  WHERE IDusuario = :IDusuario";

        $stmt = $con->prepare($query);
        $stmt->bindParam(':IDusuario', $IDusuario);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':IDempleado', $IDempleado);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error al actualizar el usuario";
        }
    } catch (PDOException $e) {
        echo "Error al actualizar el usuario: " . $e->getMessage();
    }
} else {
    // Obtener el ID del usuario a editar desde la URL
    if (isset($_GET['id'])) {
        $IDusuario = $_GET['id'];

        try {
            $db = new Database();
            $con = $db->conectar();

            // Consultar el usuario por su ID
            $query = "SELECT * FROM usuario WHERE IDusuario = :IDusuario";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':IDusuario', $IDusuario);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                echo "Usuario no encontrado";
                exit();
            }
        } catch (PDOException $e) {
            echo "Error al obtener el usuario: " . $e->getMessage();
        }
    } else {
        echo "ID de usuario no proporcionado";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="editar.php" method="POST">
        <input type="hidden" name="IDusuario" value="<?php echo $usuario['IDusuario']; ?>">

        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" value="<?php echo $usuario['usuario']; ?>" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" value="<?php echo '********'; // Muestra asteriscos en lugar de la contraseña real ?>" required><br>

        <label for="IDempleado">ID Empleado:</label>
        <input type="text" name="IDempleado" value="<?php echo $usuario['IDempleado']; ?>" required><br>

        <input type="submit" value="Actualizar">
    </form>
</body>
</html>