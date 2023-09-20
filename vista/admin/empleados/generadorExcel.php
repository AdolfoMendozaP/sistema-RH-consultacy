<?php
require_once '../../../modelo/conexion.php';
require '../../../vendor/autoload.php'; // Incluye la biblioteca PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

try {
    $db = new Database();
    $con = $db->conectar();

    $query = "SELECT empleado.*, departamento.nombreDep FROM empleado LEFT JOIN departamento ON empleado.IDdepartamento = departamento.IDdepartamento";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crear un nuevo libro de Excel
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar encabezados
    $sheet->setCellValue('A1', '#');
    $sheet->setCellValue('B1', 'Nombre Completo');
    $sheet->setCellValue('C1', 'Email Corporativo');
    $sheet->setCellValue('D1', 'Alta');
    $sheet->setCellValue('E1', 'Folio');
    $sheet->setCellValue('F1', 'Departamento');
    $sheet->setCellValue('G1', 'Estado');

    // Llenar el archivo Excel con los datos de la base de datos
    $row = 2; // Comenzar en la segunda fila
    foreach ($empleados as $empleado) {
        $sheet->setCellValue('A' . $row, $empleado['IDempleado']);
        $sheet->setCellValue('B' . $row, $empleado['nombre'] . ' ' . $empleado['apellido']);
        $sheet->setCellValue('C' . $row, $empleado['email']);
        $sheet->setCellValue('D' . $row, $empleado['alta']);
        $sheet->setCellValue('E' . $row, $empleado['folio']);
        $sheet->setCellValue('F' . $row, $empleado['nombreDep']);
        $sheet->setCellValue('G' . $row, $empleado['status']);
        $row++;
    }

    // Crear un objeto de escritura Excel
    $writer = new Xlsx($spreadsheet);

    // Definir las cabeceras para descargar el archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="empleados.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit();
} catch (PDOException $e) {
    echo "Error al obtener los registros: " . $e->getMessage();
}
?>