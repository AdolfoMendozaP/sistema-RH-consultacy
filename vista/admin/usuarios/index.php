<?php
require_once '../../../modelo/conexion.php';

try {
    $db = new Database();
    $con = $db->conectar();
    $query = "SELECT usuario.IDusuario, usuario.usuario, empleado.IDempleado, empleado.nombre, empleado.apellido, empleado.status, empleado.folio, usuario.tipoUsuario, usuario.contrasena 
    FROM usuario
    JOIN empleado ON usuario.IDempleado = empleado.IDempleado";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener los registros: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Usuarios</title>
    <link type="text/css" rel="stylesheet" href="../css/estilosAdmin.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<header>
    <a href="../index.php" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i> Volver al inicio</a>
</header>
<br>
<div class="container mt-5"> 
<div class="container mt-4">
    <h1 class="text-center">Lista de Usuarios</h1>
    <a href="create.php" class="btn btn-primary mb-3"><i class="fas fa-user-plus"></i>Nuevo Usuario</a>
    <a href="generadorExcel.php" class="btn btn-success mb-3 dynamic-button">
            <i class="fas fa-file-excel"></i> Generar Excel
        </a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Nombre Completo</th>
            <th>Folio</th>
            <th>Estado</th>
            <th>Tipo de Usuario</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['IDempleado']; ?></td>
                <td><?php echo $usuario['usuario']; ?></td>
                <td><?php echo '<span id="contrasena_' . $usuario['usuario'] . '">********</span>'; ?></td>
                <td><?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?></td>
                <td><?php echo $usuario['folio']; ?></td>
                <td class="<?php
                    switch ($usuario['status']) {
                        case 'Activo':
                            echo 'table-success';
                            break;
                        case 'Baja':
                            echo 'table-danger';
                            break;
                        case 'Retirado':
                            echo 'table-secondary';
                            break;
                        case 'Inactivo':
                            echo 'table-warning';
                            break;
                        default:
                            echo '';
                    }
                ?>"><?php echo $usuario['status']; ?></td>
                <td><?php echo $usuario['tipoUsuario']; ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $usuario['IDusuario']; ?>" class="btn btn-success btn-sm"><span class="fa-solid fa-pen"></span></a>
                    <a href="eliminar.php?id=<?php echo $usuario['IDusuario']; ?>" class="btn btn-danger btn-sm"><span class="fa-solid fa-trash"></a>
                    <button class="btn btn-warning btn-sm" onclick="mostrarContrasena(this)" data-usuario="<?php echo $usuario['usuario']; ?>">
                    <i class="fa fa-key"></i>
                     </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
<script language="javascript">
    function mostrarContrasena(button) {
        const usuario = button.getAttribute('data-usuario');
        const contrasenaElement = document.getElementById('contrasena_' + usuario);
        const icono = button.querySelector('i');

        if (contrasenaElement.innerHTML === '********') {
            contrasenaElement.innerHTML = '<?php echo $usuario['contrasena']; ?>';
            icono.classList.remove('fa fa-key');
            icono.classList.add('fa fa-regular fa-key');
        } else {
            contrasenaElement.innerHTML = '********';
            icono.classList.remove('fa fa-regular fa-key');
            icono.classList.add('fa fa-key');
        }
    }
</script>
<script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>