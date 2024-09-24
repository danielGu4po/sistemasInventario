<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\Asignacion; // Asegúrate de que esta línea esté presente
use Carbon\Carbon;

class WordController extends Controller
{
    public function generarResponsiva($id)
    {
    // Buscar los datos de la asignación por su ID
    $asignacion = Asignacion::findOrFail($id);

    // Ruta de la plantilla de Word (.docx)
    $templatePath = storage_path('app/templates/responsiva_template.docx');

    // Cargar la plantilla de Word
    $templateProcessor = new TemplateProcessor($templatePath);

    // Obtén la fecha actual
    $fechaAplicacion = Carbon::now()->format('d/m/Y');
    


    // Reemplaza el marcador de posición con la fecha actual
    $templateProcessor->setValue('fecha_aplicacion', $fechaAplicacion);

        // Reemplazar las variables en la plantilla con los datos de la asignación
        $templateProcessor->setValue('asignarUsuario', $asignacion->asignarUsuario);
        $templateProcessor->setValue('asignarNoEmpleado', $asignacion->asignarNoEmpleado);
        $templateProcessor->setValue('asignarPuesto', $asignacion->asignarPuesto);
        $templateProcessor->setValue('asignarDepartamento', $asignacion->asignarDepartamento);
        $templateProcessor->setValue('asignarEquipoNombre', $asignacion->asignarEquipoNombre);
        $templateProcessor->setValue('asignarUsuarioNombre', $asignacion->asignarUsuarioNombre);
        $templateProcessor->setValue('inventarioContraseña', $asignacion->inventario->inventarioContraseña);
        $templateProcessor->setValue('asignarEquipoCorreo', $asignacion->asignarEquipoCorreo);
        $templateProcessor->setValue('inventarioMarca', $asignacion->inventario->inventarioMarca);
        $templateProcessor->setValue('inventarioModelo', $asignacion->inventario->inventarioModelo);
        $templateProcessor->setValue('inventarioAlmacenamiento', $asignacion->inventario->inventarioAlmacenamiento);
        $templateProcessor->setValue('inventarioRAM', $asignacion->inventario->inventarioRAM);
        $templateProcessor->setValue('inventarioSerie', $asignacion->inventario->inventarioSerie);
        $templateProcessor->setValue('inventarioObservaciones', $asignacion->inventario->inventarioObservaciones);

         // Generar el nombre del archivo Word
    $fileName = 'Carta_Responsiva_' . $asignacion->asignarUsuario . '.docx';
    $filePath = storage_path('app/public/' . $fileName);

    // Guardar el archivo Word con los valores reemplazados
    $templateProcessor->saveAs($filePath);

    // Devolver el archivo Word para su descarga
    return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
