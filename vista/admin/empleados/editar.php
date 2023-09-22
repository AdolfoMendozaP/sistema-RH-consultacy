<?php
require_once '../../../modelo/conexion.php';

if (isset($_POST['IDempleado'])) {
    try {
        $db = new Database();
        $con = $db->conectar();

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $alta = $_POST['alta'];
        $IDdepartamento = $_POST['IDdepartamento'];
        $status = $_POST['status'];
        $idEmpleado = $_POST['IDempleado'];

        $stmt = $con->prepare("UPDATE empleado SET nombre = :nombre, apellido = :apellido, email = :email, alta = :alta, IDdepartamento = :IDdepartamento, status = :status WHERE IDempleado = :idEmpleado");

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':alta', $alta);
        $stmt->bindParam(':IDdepartamento', $IDdepartamento);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':idEmpleado', $idEmpleado);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error: No se pudo editar el empleado.";
        }
    } catch (PDOException $e) {
        echo "Error al editar el empleado: " . $e->getMessage();
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $db = new Database();
        $con = $db->conectar();
        $query = "SELECT * FROM empleado WHERE IDempleado = :id";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$empleado) {
            echo "Empleado no encontrado.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error al obtener el empleado: " . $e->getMessage();
    }
} else {
    echo "ID de empleado no válido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' code.jquery.com cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' cdn.jsdelivr.net; img-src 'self' https://consultancysc.com; font-src 'self' cdn.jsdelivr.net; frame-ancestors 'none';">
    <title>Editar Empleado</title>
    
    <link type="text/css" rel="stylesheet" href="../css/estilosAdmin.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<header>
</header>
<br>    <br>    <br> 
<div class="container mt-5">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                        <div class="card-header text-center" style="background: linear-gradient(to right, #526BCA, #133A94); border: 1px solid #dee2e6; color:#fff">
                            <div class="user-icon">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <h2>Editar Empleado</h2>
                        </div>
                    <div class="card-body">
                        <form action="editar.php" method="POST" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+"  maxlength="40" name="IDempleado" value="<?php echo $empleado['IDempleado']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+"  maxlength="40" name="nombre" class="form-control" value="<?php echo $empleado['nombre']; ?>" required><br>
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" class="form-control" value="<?php echo $empleado['apellido']; ?>" required><br>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email"  required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]" maxlength="40" class="form-control" value="<?php echo $empleado['email']; ?>" required><br>
                            </div>

                            <div class="form-group">
                                <label for="alta">Alta:</label>
                                <input type="date" name="alta" class="form-control" value="<?php echo $empleado['alta']; ?>" required><br>
                            </div>

                            <div class="form-group">
                             <label for="status">Status:</label>
                             <select name="status" class="form-control" required>
                            <option value="Activo" <?php if ($empleado['status'] == 'Activo') echo 'selected'; ?>>Activo</option>
                            <option value="Retirado" <?php if ($empleado['status'] == 'Retirado') echo 'selected'; ?>>Retirado</option>
                             <option value="Baja" <?php if ($empleado['status'] == 'Baja') echo 'selected'; ?>>Baja</option>
                             <option value="Inactivo" <?php if ($empleado['status'] == 'Inactivo') echo 'selected'; ?>>Inactivo</option>
                            </select><br>
                           </div>

                           <div class="mb-3">
                            <label for="IDdepartamento" class="form-label">Departamento:</label>
                             <select name="IDdepartamento" class="form-select" required>
                              <?php
        $departamentos = [
            1 => 'Asociado',
            2 => 'Plant Manager',
            3 => 'Jefatura',
            4 => 'Proyect Manager',
            5 => 'Recursos Humanos',
            6 => 'Marketing',
            7 => 'Ventas',
            8 => 'TI',
            9 => 'Finanzas',
            10 => 'Contabilidad',
            11 => 'Calidad'
        ];

        foreach ($departamentos as $value => $label) {
            $selected = ($IDdepartamento == $value) ? 'selected' : '';
            echo "<option value=\"$value\" $selected>$label</option>";
        }
        ?>
    </select>
</div>

                            <button type="submit" class="btn btn-primary btn-block" name="editarEmpleado">Actualizar</button>
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
</body>
</html>