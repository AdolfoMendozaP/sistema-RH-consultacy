<?php
session_start();

require_once '../../modelo/reset-password.php';
require_once '../../modelo/conexion.php';

$db = new Database();
$conn = $db->conectar();
$recuperarContrasena = new RecuperarContrasena($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $usuario = $_POST['usuario'];
    $folio = $_POST['folio'];

    $csrfToken = $recuperarContrasena->generateCSRFToken();

    $result = $recuperarContrasena->ResetPassword($usuario, $folio, $csrfToken);

    if (strlen($result) === 12) 
    {
        echo "<script>
                alert('Tu contraseña ha sido restablecida con éxito. Tu nueva contraseña es: " . $result . "');
                window.location.href = '../../index.php'; // Redirige al usuario al índice de inicio de sesión
              </script>";
        exit;
    } 
    else 
    {
        echo "<script>alert('Error: " . $result . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link type="text/css" rel="stylesheet" href="../../css/estilosLogin.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Recuperar Contraseña - Portal del Empleado</title>
</head>
<body>
    <div class="center-form">
        <div class="form-container w-75">
            <form action="" method="post" class="w-75" autocomplete="off">
                <div class="recover-password">
                    <p>Para restablecer tu contraseña, por favor, introduce 
                        a continuación tu usuario y folio de empleado.</p>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="usuario">Usuario: *</label>
                    <input type="text" class="form-control" pattern="[a-záéíóúñ\.]*" title="Ingrese su usuario" minlength="10" maxlength="20" name="usuario" id="usuario" placeholder="Usuario" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="folio">Folio: *</label>
                    <input type="text" class="form-control" id="folio" name="folio" pattern="[A-Z0-9]+" title="Ingrese solo el Folio" maxlength="20" placeholder="Folio de Empleado" required="">
                </div>
                <div class="input-group">
                    <div class="input-group-append"></div>
                </div>
                <button type="submit" class="btn-primary">Restablecer Contraseña</button>
                <a href="../../index.php" class="forgot-password">REGRESAR</a>
            </form>
        </div>
    </div>
    <footer>
        <p>Copyright © 2023 Consultancy SC</p>
    </footer>
</body>
</html>