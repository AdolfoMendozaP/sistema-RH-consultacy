<?php
require_once '../../../modelo/conexion.php';
require '../../../vendor/autoload.php'; // Incluye la biblioteca PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$asistencias = [];

try {
    $db = new Database();
    $con = $db->conectar();

    $query = "SELECT * FROM asistencias";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $asistencias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crear un nuevo libro de Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar encabezados
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Fecha');
    $sheet->setCellValue('C1', 'Entrada');
    $sheet->setCellValue('D1', 'Salida');

    // Llenar el archivo Excel con los datos de asistencias
    $row = 2; // Comenzar en la segunda fila
    foreach ($asistencias as $asistencia) {
        $sheet->setCellValue('A' . $row, $asistencia['IDempleado']);
        $sheet->setCellValue('B' . $row, $asistencia['fecha']);
        $sheet->setCellValue('C' . $row, $asistencia['entrada']);
        $sheet->setCellValue('D' . $row, $asistencia['salida']);
        $row++;
    }

    // Crear un objeto de escritura Excel
    $writer = new Xlsx($spreadsheet);

    // Definir las cabeceras para descargar el archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="asistencias.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit();
} catch (PDOException $e) {
    echo "Error al obtener los registros: " . $e->getMessage();
}
?>