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
    <title>Cursos Consultancy</title>
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
    <br><br><br><br><br>
    <section id="cursos">
            <h1>Mis Cursos</h1>
            <div class="curso-tarjeta">
                <div class="video">
                    <iframe width="300" height="200" src="https://www.youtube.com/embed/XqFR2lqBYPs" frameborder="0" allowfullscreen></iframe>
                </div>
                <p>Curso de HTML</p>
                <div class="progreso">
                    <div class="barra"></div>
                    <p class="porcentaje">25%</p>
                </div>
            </div>
            <div class="curso-tarjeta">
                <div class="video">
                    <iframe width="300" height="200" src="https://www.youtube.com/embed/RqQ1d1qEWlE" frameborder="0" allowfullscreen></iframe>
                </div>
                <p>Curso de JavaScript</p>
                <div class="progreso">
                    <div class="barra"></div>
                    <p class="porcentaje">50%</p>
                </div>
            </div>
            <div class="curso-tarjeta">
                <div class="video">
                    <iframe width="300" height="200" src="https://www.youtube.com/embed/ZY3-MFxVdEw" frameborder="0" allowfullscreen></iframe>
                </div>
                <p>Curso de Photoshop</p>
                <div class="progreso">
                    <div class="barra"></div>
                    <p class="porcentaje">75%</p>
                </div>
            </div>
        </section>
    <section id="notificaciones">
        <!-- Aquí se mostrarán las notificaciones -->
    </section>
    
    <section id="courses">
        <h2>Cursos por Área</h2>
    
        <div class="area">
            <h3>IT</h3>
            <div class="curso">
                <h4>Curso de HTML</h4>
                <p>Duración: 4 semanas</p>
            </div>
            <div class="curso">
                <h4>Curso de JavaScript</h4>
                <p>Duración: 6 semanas</p>
            </div>
        </div>
    
        <div class="area">
            <h3>Marketing</h3>
            <div class="curso">
                <h4>Curso de Photoshop</h4>
                <p>Duración: 5 semanas</p>
            </div>
            <div class="curso">
                <h4>Curso de Illustrator</h4>
                <p>Duración: 4 semanas</p>
            </div>
        </div>

        <div class="area">
            <h3>Ventas</h3>
            <div class="curso">
                <h4>Curso de Photoshop</h4>
                <p>Duración: 5 semanas</p>
            </div>
            <div class="curso">
                <h4>Curso de Illustrator</h4>
                <p>Duración: 4 semanas</p>
            </div>
        </div>

        <div class="area">
            <h3>Recursos Humanos</h3>
            <div class="curso">
                <h4>Curso de Reclutamiento</h4>
                <p>Duración: 5 semanas</p>
            </div>
            <div class="curso">
                <h4>Curso de Illustrator</h4>
                <p>Duración: 4 semanas</p>
            </div>
        </div>
    </section>
    <script language="javascript" type="text/javascript" src="../../js/jquery-3.2.1.js"></script>
    <script language="javascript" type="text/javascript" src="../../js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>
