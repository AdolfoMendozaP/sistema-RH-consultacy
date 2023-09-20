<?php
require_once '../../../modelo/conexion.php';
require '../../../vendor/autoload.php'; // Incluye la biblioteca PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

try {
    $db = new Database();
    $con = $db->conectar();
    
    $query = "SELECT usuario.IDusuario, usuario.usuario, empleado.IDempleado, empleado.nombre, empleado.apellido, empleado.status, empleado.folio, usuario.tipoUsuario, usuario.contrasena 
    FROM usuario
    JOIN empleado ON usuario.IDempleado = empleado.IDempleado";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crear un nuevo libro de Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar encabezados
    $sheet->setCellValue('A1', '#');
    $sheet->setCellValue('B1', 'Usuario');
    $sheet->setCellValue('C1', 'Contraseña');
    $sheet->setCellValue('D1', 'Nombre Completo');
    $sheet->setCellValue('E1', 'Folio');
    $sheet->setCellValue('F1', 'Estado');
    $sheet->setCellValue('G1', 'Tipo de Usuario');

    // Llenar el archivo Excel con los datos de la base de datos
    $row = 2; // Comenzar en la segunda fila
    foreach ($usuarios as $usuario) {
        $sheet->setCellValue('A' . $row, $usuario['IDempleado']);
        $sheet->setCellValue('B' . $row, $usuario['usuario']);
        $sheet->setCellValue('C' . $row, $usuario['contrasena']); // Contraseña oculta
        $sheet->setCellValue('D' . $row, $usuario['nombre'] . ' ' . $usuario['apellido']);
        $sheet->setCellValue('E' . $row, $usuario['folio']);
        $sheet->setCellValue('F' . $row, $usuario['status']);
        $sheet->setCellValue('G' . $row, $usuario['tipoUsuario']);
        $row++;
    }

    // Crear un objeto de escritura Excel
    $writer = new Xlsx($spreadsheet);

    // Definir las cabeceras para descargar el archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="usuarios.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit();
} catch (PDOException $e) {
    echo "Error al obtener los registros: " . $e->getMessage();
}
?>