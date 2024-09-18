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

    class ExcelsatisfaccionController extends Controller
    {
        public function export2()
        {
            // Crear una nueva hoja de cálculo
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
    
            // Encabezados adaptados del archivo
            $sheet->setCellValue('A1', 'Nombre del prestador de Servicio');
            $sheet->setCellValue('B1', 'Equipo Asignado');
            $sheet->setCellValue('C1', 'Código');
            $sheet->setCellValue('D1', 'Fecha de Evaluación');
    
            // Datos de ejemplo que puedes sustituir por datos reales
            $data = [
                ['William Amurabi Lezama Murillo', '5CG10512VK', 'EV-TI-01-Rev.00', '05-oct-2022'],
                // Añade más filas de datos aquí
            ];
    


            
            $row = 2; // Comienza en la fila 2 porque la fila 1 tiene los encabezados
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item[0]);
                $sheet->setCellValue('B' . $row, $item[1]);
                $sheet->setCellValue('C' . $row, $item[2]);
                $sheet->setCellValue('D' . $row, $item[3]);
                $row++;
            }
            








            // Crear el archivo XLSX
            $writer = new Xlsx($spreadsheet);
    
            // Preparar la respuesta para descargar el archivo
            $fileName = 'EncuestaSatisfaccion.xlsx';
            $temp_file = tempnam(sys_get_temp_dir(), 'export_');
            $writer->save($temp_file);
    
            return Response::download($temp_file, $fileName)->deleteFileAfterSend(true);
        }
    }