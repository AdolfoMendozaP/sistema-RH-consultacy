<?php
require_once '../../modelo/conexion.php';

$db = new Database();
$con = $db->conectar();

session_start();

if (!isset($_SESSION['usuario'])) 
{
    header("Location: ../../index.php");
    exit();
}

$nomUser = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link type="text/css" rel="stylesheet" href="../../css/estilos.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Calendario laboral Consultacy</title>
</head>
<body>
<!-- ========== Menu - Encabezado ========== -->
<header>
    <div class="d-flex justify-content-between align-items-center">
        <span id="button-menu" class="fa fa-bars"></span>
        <div class="dropdown">
            <label class="btn btn-primary dropdown-toggle me-2" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i> <?php echo htmlspecialchars($nomUser['usuario']); ?>
            </label>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Soporte Tecnico</a></li>
                <li><a class="dropdown-item" href="../../modelo/logout.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
    <nav class="navegacion">
			<ul class="menu">
            <li class="title-menu"><img src="../../image/logo.png" alt="Logo"></li>
            <li class="title-menu-ig"><span class="fa fa-calendar-days icon-menu"></span>Calendario Laboral</a></li>
            <li><a href="../empleado/"><span class="fa fa-house icon-menu"></span>Inicio</a></li>
				<li class="item-submenu" menu="1">
					<a href="#"><span class="fa fa-address-card icon-menu"></span>Onboarding</a>
					<ul class="submenu">
						<li class="title-menu"><span class="fa fa-address-card icon-menu"></span>Onboarding</li>
						<li class="go-back">Atras</li>

						<li><a href="#">Manual del Empleado</a></li>
						<li><a href="#">Gestor de Archivos</a></li>
					</ul>
				</li>

				<li class="item-submenu" menu="2">
					<a href="#"><span class="fa fa-clipboard icon-menu"></span>Loops</a>
					<ul class="submenu">
						<li class="title-menu"><span class="fa fa-clipboard icon-menu"></span>Loops</li>
						<li class="go-back">Atras</li>

						<li><a href="#">Asignacion de Actividades</a></li>
						<li><a href="#">Desempeño del Proyecto</a></li>
					</ul>
				</li>
                <li><a href="#"><span class="fa fa-users icon-menu"></span>Reuniones</a></li>
				<li class="item-submenu" menu="3">
					<a href="#"><span class="fa fa-user-gear icon-menu"></span>Configuracion</a>
					<ul class="submenu">
						<li class="title-menu"><span class="fa fa-user-gear icon-menu"></span>Configuracion</li>
						<li class="go-back">Atras</li>

						<li><a href="#">Cambiar Contraseña</a></li>
						<li><a href="#">Ver Perfil</a></li>
					</ul>
				</li>
			</ul>
		</nav>
</header>
<!-- ========== Section ========== -->
<br><br><br><br><br>
<section id="content">
    <div class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6">
                <form action="../../modelo/ausencia.php" method="post" autocomplete="on">
                    <div class="form-group">
                        <label for="folio">Folio de Empleado:</label>
                        <input type="text" class="form-control" id="folio" name="folio" pattern="[A-Z0-9]+" title="Ingrese solo el Folio" maxlength="20" placeholder="Folio de Empleado" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo:</label>
                        <textarea class="form-control" id="motivo" name="motivo" required maxlength="100" oninput="this.value = this.value.replace(/[^A-Za-z\s.]/g, '');"></textarea>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo bin2hex(random_bytes(32)); ?>">
                    <br><br>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ========= Section ========== -->
<!-- ========== Footer ========== -->
<footer>
    <p>Copyright © 2023 Consultancy SC</p>
    </footer>
<!-- ========= Footer ========== -->
    <script language="javascript" type="text/javascript" src="../../js/jquery-3.2.1.js"></script>
    <script language="javascript" type="text/javascript" src="../../js/main.js"></script>
    <script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>