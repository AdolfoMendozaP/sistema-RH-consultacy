<?php
require_once 'conexion.php';

$db = new Database();
$con = $db->conectar();

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../index.php");
    exit();
}

$nomUser = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folio = $_POST['folio'];
    $fecha = $_POST['fecha'];
    $motivo = $_POST['motivo'];

    $folio = filter_var($folio, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $fecha = filter_var($fecha, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $motivo = filter_var($motivo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (strlen($folio) > 20 || strlen($fecha) == 0 || strlen($motivo) == 0) {
        $errorMessage = "Entrada de datos no válida.";
        $redirectUrl = "../vista/calendario-laboral/index.php?error=" . urlencode($errorMessage);
        header("Location: $redirectUrl");
        exit();
    }

    try {
        $query = $con->prepare("SELECT IDempleado FROM empleado WHERE folio = ?");
        $query->execute([$folio]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $IDempleado = $row['IDempleado'];

            $query = $con->prepare("INSERT INTO ausencias (fecha, motivo, IDempleado) VALUES (?, ?, ?)");
            $query->execute([$fecha, $motivo, $IDempleado]);

            $query = $con->prepare("UPDATE asistencias SET checador_desactivado = 1 WHERE fecha = ? AND IDempleado = ?");
            $query->execute([$fecha, $IDempleado]);

            $successMessage = "Ausencia registrada correctamente.";
            $redirectUrl = "../vista/calendario-laboral/index.php?success=" . urlencode($successMessage);
            header("Location: $redirectUrl");
            exit();
        } else {
            $errorMessage = "No se encontró empleado con el folio proporcionado.";
            $redirectUrl = "../vista/calendario-laboral/index.php?error=" . urlencode($errorMessage);
            header("Location: $redirectUrl");
            exit();
        }
    } catch (PDOException $e) {
        $errorMessage = "Error al registrar ausencia: " . $e->getMessage();
        $redirectUrl = "../vista/calendario-laboral/index.php?error=" . urlencode($errorMessage);
        header("Location: $redirectUrl");
        exit();
    }
}
?>