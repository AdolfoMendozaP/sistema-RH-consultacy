<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' code.jquery.com cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' cdn.jsdelivr.net; img-src 'self' https://consultancysc.com; font-src 'self' cdn.jsdelivr.net; frame-ancestors 'none';">
    <title>Nuevo empleado</title>

    <link type="text/css" rel="stylesheet" href="../css/estilosAdmin.css">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<header>
    </header>
    <br>    <br>    <br>  
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                <div class="card-header text-center" style="background: linear-gradient(to right, #526BCA, #133A94); border: 1px solid #dee2e6; color:#fff">
                    <div class="user-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h2>Nuevo Empleado</h2>
                </div>
                <div class="card-body">
                    <form action="../../../modelo/empleadoAdmin.php" method="POST" autocomplete="off">
                    <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+"  maxlength="40" required>
                    </div>
                    <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" class="form-control" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+"  maxlength="40" required>
                    </div>
                    <div class="form-group">
                     <label for="email">Email:</label>
                     <input type="email" name="email" class="form-control" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]" maxlength="40">
                     </div>
                        <div class="form-group">
                            <label for="alta">Alta:</label>
                            <input type="date" name="alta" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="IDdepartamento" class="form-label">Departamento:</label>
                            <select name="IDdepartamento" class="form-select" required>
                                <option selected disabled>-----Seleccione el Área o Departamento-----</option>
                                <option value="1">Asociado</option>
                                <option value="2">Plant Manager</option>
                                <option value="3">Jefatura</option>
                                <option value="4">Proyect Manager</option>
                                <option value="5">Recursos Humanos</option>
                                <option value="6">Marketing</option>
                                <option value="7">Ventas</option>
                                <option value="8">TI</option>
                                <option value="9">Finanzas</option>
                                <option value="10">Contabilidad</option>
                                <option value="11">Calidad</option>
                            </select>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                            <a href="index.php" class="btn btn-secondary btn-block">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>