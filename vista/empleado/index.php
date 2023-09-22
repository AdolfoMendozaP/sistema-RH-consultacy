<?php
require_once '../../modelo/conexion.php';

$db = new Database();
$con = $db->conectar();

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

$nomUser = $_SESSION['usuario'];

function limpiarInput($input) 
{
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

foreach ($_GET as $key => $value) 
{
    $_GET[$key] = limpiarInput($value);
}

foreach ($_POST as $key => $value) 
{
    $_POST[$key] = limpiarInput($value);
}

function generarToken() 
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
    return $token;
}

function verificarToken($token) 
{
    return isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === $token;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $csrfToken = $_POST['csrf_token'] ?? '';
    if (!verificarToken($csrfToken)) {
        die("Token CSRF inválido.");
    }
}

function escaparHTML($string) 
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    

    <link type="text/css" rel="stylesheet" href="../../css/estilos.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Portal de Empleados Consultacy</title>
</head>
<body>
<header>
<!-- ========== Menu - Encabezado ========== -->
            <span id="button-menu" class="fa fa-bars"></span>
        <!-- ========== Modal Asistencia ========== -->
           <div class="boton-modal">
           <div class="d-flex align-items-center">
             <label for="btn-modal" class="btn btn-primary me-2">
                <span class="fa fa-clipboard-check"></span>Registrar Asistencia
            </label>
      <!-- ========== Sesiones ========== -->
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
           </div>
      <!-- =========Sesiones ========== -->
           <input type="checkbox" id="btn-modal">
             <div class="modal-dialog" id="container-modal">
               <div class="modal-content" id="content-modal">
               <div class="modal-header">
               <div class="d-flex justify-content-between align-items-center w-100">
                 <h2 class="modal-title fs-5">Bienvenido a Consultacy - <?php echo htmlspecialchars($nomUser['usuario']); ?> </h2>
                   <div class="btn-cerrar-modal position-relative">
                   <label for="btn-modal" class="btn btn-secondary p-6 rounded-circle"><span class="fa fa-close fa-1xs"></span></label>
                   </div>
                   </div>
                   </div>
                   <hr>
                   <div class="modal-body">
                    <h5>Por favor, registra tu asistencia</h5>
                     <h6 id="fecha"></h6>
                     <form action="../../modelo/asistencia.php" method="post" autocomplete="on">
                      <div class="mb-3">
                        <label for="">Ingrese su Folio:</label>
                      </div>
                      <div>
                       <input type="text" class="form-control" id="folio" name="folio" pattern="[A-Z0-9]+" title="Ingrese solo el Folio" maxlength="20" placeholder="Folio de Empleado" required>
                      </div>
                   </div>
                   <hr>
                   <input type="hidden" name="csrf_token" value="<?php echo generarToken(); ?>">
                   <div class="modal-footer d-flex justify-content-center">
                   <button type="submit" class="btn btn-outline-success btn-sm me-2 btn-hover-grow" name="accion" value="entrada" <?php echo isset($_GET['entry_registered']) ? 'disabled' : ''; ?>>Entrada</button>
                   <button type="submit" class="btn btn-outline-danger btn-sm ms-2 btn-hover-grow" name="accion" value="salida" <?php echo isset($_GET['exit_registered']) ? 'disabled' : ''; ?>>Salida</button>
              </div>
            </div>
            </div>
        <!-- =========Modal Asistencia ========== -->
        <nav class="navegacion">
			<ul class="menu">
            <li class="title-menu"><img src="../../image/logo.png" alt="Logo"></li>
            <li class="title-menu-ig"><span class="fa fa-house icon-menu"></span>Inicio</li>
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
				<li><a href="../calendario-laboral/"><span class="fa fa-calendar-days icon-menu"></span>Calendario Laboral</a></li>
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
<!-- ========== Menu - Encabezado ========== -->

<!-- ========== Section ========== -->
<div id="content">
<div class="container mt-4">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert" style="max-width: 200px;">
                <?php echo $_GET['success']; ?>
            </div>
            <script>
                setTimeout(function(){
                    document.querySelector(".alert-success").remove();
                }, 5000);
            </script>
        <?php endif; ?>
        
        <!-- Alerta de error -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert" style="max-width: 200px;">
                <?php echo $_GET['error']; ?>
            </div>
            <script>
                setTimeout(function(){
                    document.querySelector(".alert-danger").remove();
                }, 5000);
            </script>
        <?php endif; ?>
        </div>
              </div>
<!-- ========= Section ========== -->
<!-- ========== Footer ========== -->
    <footer>
    <p>Copyright © 2023 Consultancy SC</p>
    </footer>
<!-- ========= Footer ========== -->
    <script language="javascript" type="text/javascript" src="../../js/jquery-3.2.1.js"></script>
    <script language="javascript" type="text/javascript" src="../../js/main.js"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
          setInterval(function() {
          let fecha = new Date();
          let fechaHora = fecha.toLocaleString();
          $("#fecha").text(fechaHora);
        }, 1000);
    });
    </script>
    <script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

</body>
</html>