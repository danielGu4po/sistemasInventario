<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExcelController extends Controller
{
    public function export()
    {
        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Configurar los encabezados
        $sheet->setCellValue('A1', 'Empleado');
        $sheet->setCellValue('B1', 'Número de Empleado');
        $sheet->setCellValue('C1', 'Puesto');
        $sheet->setCellValue('D1', 'Departamento');
        $sheet->setCellValue('E1', 'Modelo');
        $sheet->setCellValue('F1', 'Marca');
        $sheet->setCellValue('G1', 'No. Serie');
        $sheet->setCellValue('H1', 'Observaciones');

        // Aquí debes añadir los datos de la base de datos, por ejemplo:
        $data = [
            ['Juan Pérez', '001', 'Gerente', 'Ventas', 'Dell XPS', 'Dell', 'ABC123', 'Sin observaciones'],
            ['Ana López', '002', 'Asistente', 'Marketing', 'HP Envy', 'HP', 'XYZ789', 'Sin observaciones'],
        ];

        $row = 2; // Comienza en la fila 2 porque la fila 1 tiene los encabezados
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item[0]);
            $sheet->setCellValue('B' . $row, $item[1]);
            $sheet->setCellValue('C' . $row, $item[2]);
            $sheet->setCellValue('D' . $row, $item[3]);
            $sheet->setCellValue('E' . $row, $item[4]);
            $sheet->setCellValue('F' . $row, $item[5]);
            $sheet->setCellValue('G' . $row, $item[6]);
            $sheet->setCellValue('H' . $row, $item[7]);
            $row++;
        }

        // Crear el archivo XLSX
        $writer = new Xlsx($spreadsheet);

        // Preparar la respuesta para descargar el archivo
        $fileName = 'asignaciones.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return Response::download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
}
