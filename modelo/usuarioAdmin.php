<?php
require_once 'conexion.php';

try {
    $db = new Database();
    $con = $db->conectar();

    $usuario = $_POST['usuario'];
    $contrasena = generarContrasena();
    $IDempleado = $_POST['IDempleado'];

    $sql_verificar_empleado = "SELECT COUNT(*) FROM empleado WHERE IDempleado = :IDempleado";
    $stmt_verificar_empleado = $con->prepare($sql_verificar_empleado);
    $stmt_verificar_empleado->bindParam(':IDempleado', $IDempleado);
    $stmt_verificar_empleado->execute();
    $existe_empleado = $stmt_verificar_empleado->fetchColumn();

    $sql_verificar_usuario = "SELECT COUNT(*) FROM usuario WHERE usuario = :usuario";
    $stmt_verificar_usuario = $con->prepare($sql_verificar_usuario);
    $stmt_verificar_usuario->bindParam(':usuario', $usuario);
    $stmt_verificar_usuario->execute();
    $existe_usuario = $stmt_verificar_usuario->fetchColumn();

    if ($existe_empleado) {
        if ($existe_usuario) {
            echo "El usuario '$usuario' ya existe. Por favor, elige otro nombre de usuario.";
        } else {

            $sql = "INSERT INTO usuario (usuario, contrasena, IDempleado, tipoUsuario) VALUES (:usuario, :contrasena, :IDempleado, 'estandar')";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->bindParam(':IDempleado', $IDempleado);
            $stmt->execute();
            header('Location: ../vista/admin/usuarios/');
            exit();
        }
    } else {
        echo "El empleado con ID $IDempleado no existe.";
        echo '<script>
                setTimeout(function() {
                    window.location.href = "../vista/admin/usuarios/create.php";
                }, 3000);
              </script>';
    }

    

} catch (PDOException $e) {
    echo "Error al insertar usuario: " . $e->getMessage();
}

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