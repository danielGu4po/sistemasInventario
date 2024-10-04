<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\inventario;
use App\Models\mantenimiento;
use Carbon\Carbon;

class MatrizMttoExcel extends Controller
{
    public function exportExcel()
    {
        // Ruta a la plantilla
        $templatePath = storage_path('app/templates/PGR-TI.xlsx');
        
        // Cargar la plantilla
        $spreadsheet = IOFactory::load($templatePath);

        // Obtener los inventarios junto con la información de asignación
        $inventarios = inventario::with('asignaciones')->get(); // Trae las relaciones de asignaciones

        // Obtener la hoja activa
        $sheet = $spreadsheet->getActiveSheet();

        // Definir las celdas donde se insertarán los datos
        $startingCell = 15; // Empezamos en la fila 15
        $cellInterval = 3; // Cada 3 filas (C15, C18, C21, etc.)
        
        // Mapear los meses a las celdas correspondientes
        $monthCells = [
            1  => ['O15' => 'P', 'O16' => 'R'],   // Enero
            2  => ['Q15' => 'P', 'Q16' => 'R'],   // Febrero
            3  => ['S15' => 'P', 'S16' => 'R'],   // Marzo
            4  => ['U15' => 'P', 'U16' => 'R'],   // Abril
            5  => ['W15' => 'P', 'W16' => 'R'],   // Mayo
            6  => ['Y15' => 'P', 'Y16' => 'R'],   // Junio
            7  => ['AA15' => 'P', 'AA16' => 'R'], // Julio
            8  => ['AC15' => 'P', 'AC16' => 'R'], // Agosto
            9  => ['AE15' => 'P', 'AE16' => 'R'], // Septiembre
            10 => ['AG15' => 'P', 'AG16' => 'R'], // Octubre
            11 => ['AI15' => 'P', 'AI16' => 'R'], // Noviembre
            12 => ['AK15' => 'P', 'AK16' => 'R'], // Diciembre
        ];

        foreach ($inventarios as $index => $inventario) {
            // Calcula la fila actual (15, 18, 21, etc.)
            $currentRow = $startingCell + ($index * $cellInterval);
            
            // Celdas para los datos del inventario (columna C)
            $inventoryCell = 'C' . $currentRow;

            // Celdas para el usuario asignado (columna E)
            $userCell = 'E' . $currentRow;

            // Obtener la primera asignación (si existe)
            $asignacion = $inventario->asignaciones->first(); // Asumimos que hay solo una asignación por inventario

            // Verifica si hay una asignación para este inventario
            $asignarUsuario = $asignacion ? $asignacion->asignarUsuario : 'Sin asignar';

            // Inserta el texto con los valores de las variables del inventario en la columna C
            $sheet->setCellValue($inventoryCell, 
                "Laptop: {$inventario->inventarioMarca}\n" . 
                "Codigo: \n" . 
                "Modelo: {$inventario->inventarioModelo}\n" . 
                "Numero de serie/control: {$inventario->inventarioSerie}"
            );

            // Inserta el usuario asignado en la columna E
            $sheet->setCellValue($userCell, $asignarUsuario);

            // Obtener los mantenimientos del inventario
            $mantenimientos = mantenimiento::where('item_id', $inventario->id)->get();

            foreach ($mantenimientos as $key => $mantenimiento) {
                // Calcular la fila para los registros de mantenimiento, pasando dos filas por cada registro
                $maintenanceRowStart = $currentRow + ($key * 2);

                // Obtener el mes de la fecha de mantenimiento
                $mantenimientoFecha = Carbon::parse($mantenimiento->mantenimientoFecha);
                $month = $mantenimientoFecha->month;

                // Si el mes existe en el mapeo, asigna "P" y "R" en las celdas correctas
                if (isset($monthCells[$month])) {
                    $cells = $monthCells[$month];

                    // Modificar las celdas con el número de fila adecuado
                    $cellP = preg_replace('/\d+/', $maintenanceRowStart, array_key_first($cells));
                    $cellR = preg_replace('/\d+/', $maintenanceRowStart + 1, array_key_last($cells));

                    // Colocar las letras P y R en las celdas correspondientes
                    $sheet->setCellValue($cellP, $cells[array_key_first($cells)]);
                    $sheet->setCellValue($cellR, $cells[array_key_last($cells)]);
                }
            }

            // Si llegas al límite de filas, detén la iteración
            if ($currentRow >= 54) {
                break; // Detén la iteración cuando llegues a la fila 54
            }
        }

        // Colocar la fecha actual en W6
        $sheet->setCellValue('W6', now()->format('d-m-Y'));

        // Obtener la fecha actual
        $currentDate = now();
        $currentYear = $currentDate->year;

        // Determinar el trimestre basado en el mes actual
        $month = $currentDate->month;
        $trimestre = '';

        if ($month >= 1 && $month <= 3) {
            $trimestre = 'Ene-Mar ' . $currentYear;
        } elseif ($month >= 4 && $month <= 6) {
            $trimestre = 'Abr-Jun ' . $currentYear;
        } elseif ($month >= 7 && $month <= 9) {
            $trimestre = 'Jul-Sep ' . $currentYear;
        } else {
            $trimestre = 'Oct-Dic ' . $currentYear;
        }

        // Colocar el trimestre en W8
        $sheet->setCellValue('W8', $trimestre);

        // Crear un archivo Excel para descargar
        $writer = new Xlsx($spreadsheet);

        // Definir el nombre del archivo y devolverlo para descarga
        $fileName = 'Matriz_Mtto_' . now()->format('Y-m-d') . '.xlsx';
        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }
}
