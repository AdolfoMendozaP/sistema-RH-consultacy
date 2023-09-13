<?php
require_once 'conexion.php';

$db = new Database();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $folio = $_POST['folio'];
    $accion = $_POST['accion'];

    try 
    {
        $query = $con->prepare("SELECT IDempleado FROM empleado WHERE folio = ?");
        $query->execute([$folio]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) 
        {
            $IDempleado = $row['IDempleado'];

            if ($accion === 'entrada') 
            {
                $query = $con->prepare("INSERT INTO asistencias (fecha, entrada, IDempleado) VALUES (CURDATE(), NOW(), ?)");
                $query->execute([$IDempleado]);
                $successMessage = "Entrada registrada correctamente.";

                $redirectUrl = "../vista/empleado/index.php?success=" . urlencode($successMessage) . "&entry_registered=true";
                header("Location: $redirectUrl");
                exit();
            } 
            elseif ($accion === 'salida') 
            {
                $query = $con->prepare("UPDATE asistencias SET salida = NOW() WHERE IDempleado = ? AND fecha = CURDATE()");
                $query->execute([$IDempleado]);
                $successMessage = "Salida registrada correctamente.";

                // Después de registrar una salida
                $redirectUrl = "../vista/empleado/index.php?success=" . urlencode($successMessage) . "&exit_registered=true";
                header("Location: $redirectUrl");
                exit();
            }
        }
        else 
        {
            $errorMessage = "No se encontró empleado con el folio proporcionado.";
            $redirectUrl = "../vista/empleado/index.php?error=" . urlencode($errorMessage);
            header("Location: $redirectUrl");
            exit();
        }
    } 
    catch (PDOException $e) 
    {
        $errorMessage = "Error al registrar asistencia: " . $e->getMessage();
        $redirectUrl = "../vista/empleado/index.php?error=" . urlencode($errorMessage);
        header("Location: $redirectUrl");
        exit();
    }
}
?>