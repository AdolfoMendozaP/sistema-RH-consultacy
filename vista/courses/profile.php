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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link type="text/css" rel="stylesheet" href="../../css/estilos.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/styles_profile.css">
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
<section id="perfilUsuario">
        <div class="perfil-info">
            <img src="https://electronicssoftware.net/wp-content/uploads/user.png" alt="Foto de perfil">
            <h2>Cristian Santos Benavides</h2>
            <p>Área: TI</p>
            <a href="https://www.linkedin.com/in/nombre-usuario" target="_blank">LinkedIn</a>
        </div>
    </section>

    <section id="miProgreso">
        <h2>Mi Progreso</h2>
        <div class="curso">
            <img src="https://static.platzi.com/media/achievements/badge-basicojs-e2ead888-428e-4f55-962c-8894aeaeacda.png" alt="Icono del Curso 1">
            <div class="curso-info">
                <div class="progress-container">
                    <p>Progreso: 75%</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: 75%;"></div>
                    </div>
                    <button>Continuar Curso</button>
                </div>
            </div>
        </div>
        <div class="curso">
            <img src="https://static.platzi.com/cdn-cgi/image/width=768,quality=85,format=auto/media/achievements/badge-ingles-mkting-668bd901-07bf-406e-bd94-f16d7c729b19.png" alt="Icono del Curso 2">
            <div class="curso-info">
                <h3>Entrenamiento en Marketing Digital</h3>
                <div class="progress-container">
                    <p>Progreso: 50%</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: 50%;"></div>
                    </div>
                    <button>Continuar Curso</button>
                </div>
            </div>
        </div>
    </section>
    

    <section id="constancias">
        <h2>Constancias</h2>
        <div class="constancia">
            <img src="https://www.archivoexcel.com/wp-content/uploads/2017/12/Certificado.png" alt="Certificado 1">
            <p>Constancia de Excel Avanzado - Emitida el 5 de septiembre de 2023</p>
        </div>
        <div class="constancia">
            <img src="https://imgv2-1-f.scribdassets.com/img/document/395834168/original/8b27563be8/1690323821?v=1" alt="Certificado 2">
            <p>Constancia de Liderazgo Efectivo - Emitida el 20 de agosto de 2023</p>
        </div>
    </section>
    </section>
    <script language="javascript" type="text/javascript" src="../../js/jquery-3.2.1.js"></script>
    <script language="javascript" type="text/javascript" src="../../js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>