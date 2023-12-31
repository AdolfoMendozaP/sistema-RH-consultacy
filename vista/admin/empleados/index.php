<?php
require_once '../../../modelo/conexion.php';

try 
{
    $db = new Database();
    $con = $db->conectar();

    $query = "SELECT empleado.*, departamento.nombreDep FROM empleado LEFT JOIN departamento ON empleado.IDdepartamento = departamento.IDdepartamento";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} 

catch (PDOException $e) 
{
    echo "Error al obtener los registros: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registros de Empleados - Consultacy</title>
    
    <link type="text/css" rel="stylesheet" href="../css/estilosAdmin.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
</head>
<body>
<header>
	   <a href="../index.php" class="btn btn-primary mb-3"><i class="fas fa-arrow-left"></i>Volver al inicio</a>
    </header>
    <br>
    <div class="container mt-5"> 
     <div class="container mt-4">
        <h1 class="text-center mb-4">Lista de Empleados</h1>
        <div class="container mt-4 button-container">
        <a href="create.php" class="btn btn-primary mb-3 dynamic-button">
            <i class="fas fa-user-plus"></i> Nuevo Empleado
        </a>
<<<<<<< HEAD
        <a href="personales/index.php" class="btn btn-secondary mb-3 dynamic-button" onclick="mostrarDatosPersonales()">
            <i class="fas fa-file-lines"></i> Datos Personales
        </a>
        <a href="index.php" class="btn btn-secondary mb-3 dynamic-button" onclick="mostrarDatosLaborales()">
=======
        <a href="#" class="btn btn-secondary mb-3 dynamic-button" onclick="mostrarDatosPersonales()">
            <i class="fas fa-file-lines"></i> Datos Personales
        </a>
        <a href="#" class="btn btn-secondary mb-3 dynamic-button" onclick="mostrarDatosLaborales()">
>>>>>>> e5b4655e5dc870626117b6d22c4c030afab54666
            <i class="fas fa-file-lines"></i> Datos Laborales
        </a>
        <a href="generadorExcel.php" class="btn btn-success mb-3 dynamic-button">
            <i class="fas fa-file-excel"></i> Generar Excel
        </a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre Completo</th>
                    <th>Email Corporativo</th>
                    <th>Alta</th>
                    <th>Folio</th>
                    <th>Departamento</th>
                    <th>Estado</th>
                    <th class="table-active">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($empleados as $empleado): ?>
    <tr>
        <td><?php echo $empleado['IDempleado']; ?></td>
<<<<<<< HEAD
        <td><?php echo $empleado['nombre'] . ' ' . $empleado['apellido']; ?></td>
=======
        <td><?php echo $empleado['nombre'] . ' ' . $empleado['apellido']; ?></td> <!-- Fusiona nombre y apellido -->
>>>>>>> e5b4655e5dc870626117b6d22c4c030afab54666
        <td><?php echo $empleado['email']; ?></td>
        <td><?php echo $empleado['alta']; ?></td>
        <td><?php echo $empleado['folio']; ?></td>
        <td><?php echo $empleado['nombreDep']; ?></td>
        <td class="<?php
            switch ($empleado['status']) {
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
        ?>"><?php echo $empleado['status']; ?></td>
        <td>
            <a href="editar.php?id=<?php echo $empleado['IDempleado']; ?>" class="btn btn-success btn-sm"><span class="fa-solid fa-pen"></span></a>
            <a href="eliminar.php?id=<?php echo $empleado['IDempleado']; ?>" class="btn btn-danger btn-sm"><span class="fa-solid fa-trash"></a>
        </td>
    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script language="javascript" type="text/javascript" src="../../../js/jquery-3.2.1.js"></script>
    <script language="javascript" type="text/javascript" src="../../../js/main.js"></script>
    <script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    
</body>
</html>