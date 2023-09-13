<?php
require_once '../modelo/conexion.php';

try {
    $db = new Database();
    $con = $db->conectar();

    $query = "SELECT * FROM asistencias";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $asistencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Registros de Asistencias</title>

    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<a href="../index.php">Volver al inicio</a>
<div class="container mt-4">
    <h1 class="text-center">Lista de Asistencias</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID Asistencia</th>
            <th>Fecha</th>
            <th>Entrada</th>
            <th>Salida</th>
            <th>ID Empleado</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($asistencias as $asistencia): ?>
            <tr>
                <td><?php echo $asistencia['IDasistencia']; ?></td>
                <td><?php echo $asistencia['fecha']; ?></td>
                <td><?php echo $asistencia['entrada']; ?></td>
                <td><?php echo $asistencia['salida']; ?></td>
                <td><?php echo $asistencia['IDempleado']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script language="javascript" type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>