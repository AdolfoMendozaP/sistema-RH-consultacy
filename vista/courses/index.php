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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>

    <link type="text/css" rel="stylesheet" href="../../css/estilos.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<header>
<span id="button-menu" class="fa fa-bars"></span>
    <nav class="navegacion">
			<ul class="menu">
            <li class="title-menu"><img src="../../image/logo.png" alt="Logo"></li>
            <li class="title-menu-ig"><span class="fa fa-address-card icon-menu"></span>Onboarding</a></li>
            <li><a href="../empleado/"><span class="fa fa-house icon-menu"></span>Inicio</a></li>
				<li class="item-submenu" menu="1">
                <a href="#"><span class="fa fa-address-card icon-menu"></span>Onboarding</a>
					<ul class="submenu">
						<li class="title-menu"><span class="fa fa-address-card icon-menu"></span>Onboarding</li>
						<li class="go-back">Atras</li>

						<li><a href="../courses/index.php">Inducción</a></li>
                        <li><a href="../courses/course.php">Cursos</a></li>
                        <li><a href="../courses/buzon.php">Buzon</a></li>
						<li><a href="../courses/profile.php">Perfiles</a></li>
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
<br><br><br><br><br>
<section id="content">
    <div class="container">
            <h1>Bienvenido a Consultancy Servicios Contables</h1>
            <h5><em>Balanceando Tu Éxito Financiero</em></h5>
            <h2>Inducción</h2>
            <p>Aquí encontrarás el material de inducción que te ayudará a familiarizarte con nuestra empresa. ¡Bienvenido a nuestro equipo!</p>
        
            <!-- Carrusel de Imágenes -->
            <div id="carouselExample" class="carousel slide w-50 mx-auto" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../../image/consultancyt.png" class="d-block w-100" alt="Imagen 1">
                    </div>
                    <div class="carousel-item">
                        <img src="../../image/manual_empleado.png" class="d-block w-100" alt="Imagen 2">
                    </div>
                    <div class="carousel-item">
                        <img src="../../image/servicios_contables.png"  class="d-block w-100" alt="Imagen 3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
            <br>
            <h2>Cultura Organizacional</h2>
            <p>Nuestra cultura organizacional se basa en la colaboración, la innovación y el compromiso con nuestros valores fundamentales. Trabajamos juntos para alcanzar nuestros objetivos y servir a nuestros clientes de la mejor manera posible.</p>
            <!-- Agrega aquí más información sobre la cultura organizacional si es necesario. -->
        </section>
    </div>

    <script language="javascript" type="text/javascript" src="../../js/jquery-3.2.1.js"></script>
    <script language="javascript" type="text/javascript" src="../../js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>