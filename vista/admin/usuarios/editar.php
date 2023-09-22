<?php
require_once '../../../modelo/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new Database();
        $con = $db->conectar();

        $IDusuario = $_POST['IDusuario'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $IDempleado = $_POST['IDempleado'];

        $query = "UPDATE usuario
                  SET usuario = :usuario, contrasena = :contrasena, IDempleado = :IDempleado
                  WHERE IDusuario = :IDusuario";

        $stmt = $con->prepare($query);
        $stmt->bindParam(':IDusuario', $IDusuario);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':IDempleado', $IDempleado);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error al actualizar el usuario";
        }
    } catch (PDOException $e) {
        echo "Error al actualizar el usuario: " . $e->getMessage();
    }
} else {
    // Obtener el ID del usuario a editar desde la URL
    if (isset($_GET['id'])) {
        $IDusuario = $_GET['id'];

        try {
            $db = new Database();
            $con = $db->conectar();

            // Consultar el usuario por su ID
            $query = "SELECT * FROM usuario WHERE IDusuario = :IDusuario";
            $stmt = $con->prepare($query);
            $stmt->bindParam(':IDusuario', $IDusuario);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                echo "Usuario no encontrado";
                exit();
            }
        } catch (PDOException $e) {
            echo "Error al obtener el usuario: " . $e->getMessage();
        }
    } else {
        echo "ID de usuario no proporcionado";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    
    <link type="text/css" rel="stylesheet" href="../css/estilosAdmin.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <header>
    </header>
    <br>     
    <div class="container mt-5">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                        <div class="card-header text-center" style="background: linear-gradient(to right, #526BCA, #133A94); border: 1px solid #dee2e6; color:#fff">
                            <div class="user-icon">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <h2>Editar Usuario</h2>
                        </div>
                        <div class="card-body">
                            <form action="editar.php" method="POST" autocomplete="off">
                                <input type="hidden" name="IDusuario" value="<?php echo $usuario['IDusuario']; ?>">

                                <div class="form-group">
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" name="usuario" class="form-control" value="<?php echo $usuario['usuario']; ?>" required><br>
                                </div>

                                <div class="form-group">
                                    <label for="IDempleado">ID Empleado:</label>
                                    <input type="text" name="IDempleado" class="form-control" value="<?php echo $usuario['IDempleado']; ?>" required><br>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block" name="editarUsuario">Actualizar</button>
                                <a href="index.php" class="btn btn-secondary btn-block">Regresar</a>
                            </form>
                        </div>
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