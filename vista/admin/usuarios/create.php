<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
    <link type="text/css" rel="stylesheet" href="../css/estilosAdmin.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<header>
    <a href="index.php" class="btn btn-primary mb-3">
        <i class="fas fa-arrow-left"></i> Volver al inicio</a>
</header>
<br>    <br>    <br>  
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                <div class="card-header text-center" style="background: linear-gradient(to right, #526BCA, #133A94); border: 1px solid #dee2e6; color:#fff">
                    <div class="user-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h1 class="text-center">Nuevo Usuario</h1>
                </div>
                <div class="card-body">
                    <form action="../../../modelo/usuarioAdmin.php" method="POST" autocomplete="off">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="IDempleado">ID Empleado:</label>
                            <input type="text" name="IDempleado" class="form-control" required>
                        </div>
                        <!-- Mostrar la alerta de duplicación aquí -->
                        <div id="alerta-duplicado" class="alert alert-warning alert-dismissible fade show" style="display: none;" role="alert">
                            <!-- Mensaje de alerta dinámico que se llenará desde JavaScript -->
                            <!-- No es necesario escribir un mensaje estático aquí -->
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Fin de la alerta -->
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <a href="index.php" class="btn btn-secondary btn-block">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script language="javascript" type="text/javascript">
// Espera a que el documento HTML esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Obtén el elemento de alerta por su ID
    const alertaDuplicado = document.getElementById("alerta-duplicado");

    // Verifica si la variable de sesión "alerta" está configurada
    <?php if (isset($_SESSION['alerta'])): ?>
        // Rellena el mensaje de alerta con el mensaje de la variable de sesión
        alertaDuplicado.innerHTML = '<?php echo $_SESSION['alerta']; ?>';
        // Muestra el elemento de alerta
        alertaDuplicado.style.display = "block";

        // Configura un temporizador para ocultar el elemento de alerta después de 5 segundos
        setTimeout(function () {
            alertaDuplicado.style.display = "none";
        }, 5000); // 5000 milisegundos (5 segundos)
        <?php
        // Borra la variable de sesión para que la alerta no se muestre en futuras recargas de la página
        unset($_SESSION['alerta']);
        ?>
    <?php endif; ?>
});
</script>
</body>
</html>