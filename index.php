<?php
session_start();

require_once 'modelo/login.php';
require_once 'modelo/conexion.php';

$db = new Database();
$con = $db->conectar();

$error = "";
$userData = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = htmlspecialchars($_POST['usuario']);
    $contrasena = htmlspecialchars($_POST['contrasena']);

    $usuario = filter_var($usuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contrasena = filter_var($contrasena, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $user = new Usuario();
    $userData = $user->login($usuario, $contrasena);

    if ($userData) {
        if ($userData['status'] === 'Activo') {
            session_regenerate_id(true);

            $_SESSION['usuario'] = $userData;
            $_SESSION['tipoUsuario'] = $userData['tipoUsuario'];

            if ($userData['tipoUsuario'] === 'admin') {
                header("Location: vista/admin/index.php");
            } elseif ($userData['tipoUsuario'] === 'estandar') {
                header("Location: vista/empleado/index.php");
            } else {
            }

            exit();
        } else {
            $error = "El usuario no tiene acceso debido a su estado.";
        }
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link type="text/css" rel="stylesheet" href="css/estilosLogin.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Iniciar Sesión - Portal del Empleado</title>
</head>
<body>
<div class="center-form">
        <div class="form-container w-50">
            <form action="" method="post" class="w-50" autocomplete="off">
                <div class="image-logo">
                    <img src="image/logo.png" alt="Logo Consultancy" class="centered-image">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="usuario">Usuario: *</label>
                    <input type="text" class="form-control" pattern="[a-záéíóúñ\.]*" title="Ingrese su usuario" minlength="10" maxlength="20" name="usuario" id="usuario" placeholder="Usuario" required>
                </div>
                <label class="form-label" for="contrasena">Contraseña: *</label>
                <div class="input-group">
                <input type="password" class="form-control" minlength="12" title="Ingrese su contraseña" maxlength="12" name="contrasena" id="contrasena" placeholder="Contraseña" required>
                <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="fa-regular fa-eye"></i>
                </button>
                </div>
                </div>
                <?php
                 if (!empty($error)) 
                 {
                    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error) . '</div>';
                 } 
                elseif ($userData && $userData['status'] !== 'Activo') 
                {
                    echo '<div class="alert alert-secondary" role="alert">Tu sesión ha caducado. No tienes acceso al portal. Por favor, comunícate con soporte técnico.</div>';
                }
                ?>                
              <button type="submit" class="btn-primary">INGRESAR</button>
                <a href="vista/reset-password/" class="forgot-password">¿Has olvidado tu contraseña?</a>
            </form>
        </div>
    </div>
    <footer>
       <p>Copyright © 2023 Consultancy SC</p>
    </footer>
    <script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script>
    $(document).ready(function() {
    const passwordInput = $('#contrasena');
    const toggleButton = $('#togglePassword');
    const eyeIcon = toggleButton.find('i');

    toggleButton.click(function() {
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordInput.attr('type', 'password');
            eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});
</script>
</body>
</html>