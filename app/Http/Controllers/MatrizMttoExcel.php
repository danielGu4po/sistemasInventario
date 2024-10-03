<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\inventario;

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

            // Si llegas al límite de filas, puedes detener la iteración o manejarlo de otra manera
            if ($currentRow >= 54) {
                break; // Detén la iteración cuando llegues a la fila 54
            }
        }

        // Crear un archivo Excel para descargar
        $writer = new Xlsx($spreadsheet);

        // Definir el nombre del archivo y devolverlo para descarga
        $fileName = 'Matriz_Mtto_' . now()->format('Y-m-d') . '.xlsx';
        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }
}
