<?php

namespace App\Http\Controllers;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use App\Models\asignar;
use App\Models\Satisfaccion;

class ExcelsatisfaccionController extends Controller
{
    public function export2($id)
{
    // Obtener la evaluación desde la base de datos usando el id
    $evaluacion = \App\Models\Satisfaccion::findOrFail($id);

    // Crear una nueva hoja de cálculo
    $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setShowGridlines(false);

        $drawing = new Drawing();
        $drawing->setPath(public_path('img/Imagen1.png')); // Asegúrate de que la ruta es correcta
        $drawing->setCoordinates('B1'); // La imagen comenzará en la columna A
        $drawing->setOffsetX(5); // Ajusta el desplazamiento desde la esquina izquierda de la celda
        $drawing->setOffsetY(5); // Ajusta el desplazamiento desde la parte superior de la celda
        $drawing->setHeight(28); // Ajusta la altura para que coincida con el espacio del encabezado
        $drawing->setWorksheet($sheet);

        // Configuración de las celdas de título y encabezado
        $sheet->mergeCells('B1:R1');
        $sheet->mergeCells('B2:P2');
        $sheet->mergeCells('Q2:R2');
        $sheet->mergeCells('B3:P3');
        $sheet->mergeCells('Q3:R3');
        $sheet->setCellValue('B1', '                                      Servicios y Equipos TOPO S.A. de C.V.');
        $sheet->setCellValue('B2', 'Tecnologias de la informacion');
        $sheet->setCellValue('Q2', 'Código: EV-TI-01-Rev.00');
        $sheet->setCellValue('B3', 'Evaluacion de Servicio.');
        $sheet->setCellValue('Q3', 'Emisión: 05-oct-2022');

        // Estilos generales para el encabezado
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFFFFF'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ];

        $wrappedTextArray = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,  // Activar el ajuste de texto
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        $centeredStyleArray = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFFFFF'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ];

        $headerStyleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFFFFF'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ]
        ];

        $orangeBackground = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF6600'], // Fondo naranja
            ],
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FF000000'], // Texto negro
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ]
        ];

        $grayStyleArray = [
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFCCCCCC']], 
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => 'FF000000']]]
        ];



        // Aplicar estilos generales a las celdas del encabezado
        $sheet->getStyle('B1:R3')->applyFromArray($styleArray);

        // Ajustes de altura de fila para el encabezado
        $sheet->getRowDimension('1')->setRowHeight(28);
        $sheet->getRowDimension('2')->setRowHeight(15);
        $sheet->getRowDimension('3')->setRowHeight(15);

        // Ajuste del ancho de la columna R
        $sheet->getColumnDimension('R')->setWidth(20);  // Aumentado el ancho

        //CONFIGURACION DE LA PRIMERA FILA DEL ARCHIVO

        // Configuración de celdas adicionales como solicitado
        $sheet->mergeCells('B5:C5');
        $sheet->setCellValue('B5', 'Nombre del prestador de servicio:');
        $sheet->getStyle('B5:C5')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getRowDimension('5')->setRowHeight(30);

        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(25);

        $sheet->mergeCells('D5:E5');
        $sheet->setCellValue('D5', $evaluacion->nombrePrestador);
        $sheet->getStyle('D5:E5')->applyFromArray($styleArray);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(20);

        $sheet->mergeCells('F5');
        $sheet->setCellValue('F5', '');
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->mergeCells('G5');
        $sheet->setCellValue('G5', '');
        $sheet->getColumnDimension('G')->setWidth(15);

        $sheet->mergeCells('H5:I5');
        $sheet->setCellValue('H5', 'Equipo Asignado:');
        $sheet->getStyle('H5:I5')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(15);

        $evaluaciones = Satisfaccion::all();  // Obtener todas las evaluaciones

        // En tu lógica de creación de Excel
        $sheet = $spreadsheet->getActiveSheet();
    
        foreach ($evaluaciones as $evaluacion) {
            // Buscar el registro en la tabla 'asignar' basado en 'numUsuario'
            $asignacion = Asignar::where('asignarNoEmpleado', $evaluacion->numUsuario)->first();
    
            if ($asignacion) {
                $equipoAsignado = $asignacion->asignarEquipoNombre; // Obtener el equipo asignado
            } else {
                $equipoAsignado = 'No asignado'; // Si no hay coincidencia, mostrar un valor por defecto
            }
    
            // Establecer el valor en la celda correspondiente del Excel
            $sheet->mergeCells('J5:K5');
            $sheet->setCellValue('J5', $equipoAsignado);  // Aquí ponemos el equipo asignado
            $sheet->getStyle('J5:K5')->applyFromArray($styleArray);
            $sheet->getColumnDimension('J')->setWidth(20);
            $sheet->getColumnDimension('K')->setWidth(30);
        }

        $sheet->mergeCells('L5');
        $sheet->setCellValue('L5', '');
        $sheet->getColumnDimension('L')->setWidth(15);


        $sheet->mergeCells('M5');
        $sheet->setCellValue('M5', '');
        $sheet->getColumnDimension('M')->setWidth(15);

        $sheet->mergeCells('N5:O5');
        $sheet->setCellValue('N5', 'Fecha de Evaluación: ');
        $sheet->getStyle('N5:O5')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getColumnDimension('N')->setWidth(15);
        $sheet->getColumnDimension('O')->setWidth(15);

        $sheet->mergeCells('P5:Q5');
        $sheet->setCellValue('P5', $evaluacion->numEvaluacion);
        $sheet->getStyle('P5:Q5')->applyFromArray($styleArray);
        $sheet->getColumnDimension('P')->setWidth(10);
        $sheet->getColumnDimension('Q')->setWidth(15);

        $sheet->mergeCells('R5');
        $sheet->setCellValue('R5', '');
        $sheet->getColumnDimension('R')->setWidth(15);

        
        //CONFIGURACION DE LA PRIMERA FILA DEL ARCHIVO

        // TERCER RENGLON
        $sheet->mergeCells('B7:C7');
        $sheet->setCellValue('B7', 'Nombre del Evaluador: ');
        $sheet->getStyle('B7:C7')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getRowDimension('7')->setRowHeight(28);

        $sheet->mergeCells('D7:E7');
        $sheet->setCellValue('D7', $evaluacion->evaluador);
        $sheet->getStyle('D7:E7')->applyFromArray($styleArray);
        $sheet->getStyle('D7:E7')->applyFromArray($wrappedTextArray);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);





        $sheet->mergeCells('H7:I7');
        $sheet->setCellValue('H7', 'Periodo de Evaluacion: ');
        $sheet->getStyle('H7:I7')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(15);

        $sheet->mergeCells('J7:K7');
        $sheet->setCellValue('J7', $evaluacion->periodo);
        $sheet->getStyle('J7:K7')->applyFromArray($styleArray);
        $sheet->getStyle('J7:K7')->applyFromArray($wrappedTextArray);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);




       


        $sheet->mergeCells('N7:O7');
        $sheet->setCellValue('N7', 'Numero de Evaluación: ');
        $sheet->getStyle('N7:O7')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getColumnDimension('N')->setWidth(15);
        $sheet->getColumnDimension('O')->setWidth(15);

        $sheet->mergeCells('P7:Q7');
        $sheet->setCellValue('P7', $evaluacion->numEvaluacion);
        $sheet->getStyle('P7:Q7')->applyFromArray($styleArray);
        $sheet->getColumnDimension('P')->setWidth(10);
        $sheet->getColumnDimension('Q')->setWidth(15);

        $sheet->mergeCells('R7');
        $sheet->setCellValue('R7', '');
        $sheet->getColumnDimension('R')->setWidth(15);

       
        //TERCER RENGLON

        //CUARTO RENGLON
        $sheet->mergeCells('B9:R9');
        $sheet->setCellValue('B9', 'Evaluación de servicio: Tecnologias de la informacion');
        $blackBackgroundWhiteText = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF000000'], // Negro
            ],
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'], // Blanco
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ];
        $sheet->getStyle('B9:R9')->applyFromArray($blackBackgroundWhiteText);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getRowDimension('9')->setRowHeight(28);
        //CUARTO RENGLON














        $centeredStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];





        //ENCABEZADOS DE LA MATRIZ
        $sheet->mergeCells('B11:G11');
        $sheet->setCellValue('B11', 'Requisitos');
        $sheet->mergeCells('H11:I11');
        $sheet->setCellValue('H11', 'Cumple');
        $sheet->setCellValue('B12', 'Núm');
        $sheet->mergeCells('C12:G12');
        $sheet->setCellValue('C12', 'Concepto');
        $sheet->setCellValue('H12', 'Si');
        $sheet->setCellValue('I12', 'No');
        $sheet->getStyle('B11:I11')->applyFromArray($orangeBackground);
        $sheet->getStyle('B12:I12')->applyFromArray($orangeBackground);
        
        $sheet->mergeCells('B13');
        $sheet->setCellValue('B13', '1');
        $sheet->getStyle('B13')->applyFromArray($styleArray);
        $sheet->getStyle('B13')->applyFromArray($wrappedTextArray);
        $sheet->getStyle('B13')->applyFromArray($centeredStyle);

        $sheet->mergeCells('C13:G13');
                $sheet->setCellValue('C13', 'Analiza las necesidades del cliente ofreciendo así un servicio adecuado.');
                $sheet->getStyle('C13:G13')->applyFromArray($styleArray);
                $sheet->getStyle('C13:G13')->applyFromArray($wrappedTextArray);

                if ($evaluacion->check1 == 1) {
                    // Colocar 1 en la columna "Si"
                    $sheet->mergeCells('H13');
                    $sheet->setCellValue('H13', '1');
                    $sheet->mergeCells('I13');
                    $sheet->setCellValue('I13', '-'); // Dejar vacío el "No"
                } else {
                    // Colocar 1 en la columna "No"
                    $sheet->mergeCells('H13');
                    $sheet->setCellValue('H13', '-'); // Dejar vacío el "Si"
                    $sheet->mergeCells('I13');
                    $sheet->setCellValue('I13', '1');
                }
                
                // Aplicar estilos a las celdas
                $sheet->getStyle('H13:I13')->applyFromArray($styleArray);
                $sheet->getStyle('H13:I13')->applyFromArray($wrappedTextArray);
                $sheet->getStyle('H13:I13')->applyFromArray($centeredStyle);

        $sheet->getRowDimension('13')->setRowHeight(30);


        


        $sheet->mergeCells('B14');
        $sheet->setCellValue('B14', '2');
        $sheet->getStyle('B14')->applyFromArray($styleArray);
        $sheet->getStyle('B14')->applyFromArray($wrappedTextArray);
        $sheet->getStyle('B14')->applyFromArray($centeredStyle);

        $sheet->mergeCells('C14:G14');
                $sheet->setCellValue('C14', 'El servicio que se solicita responde a lo que se esperaba y atendido en el tiempo acordado.');
                $sheet->getStyle('C14:G14')->applyFromArray($styleArray);
                $sheet->getStyle('C14:G14')->applyFromArray($wrappedTextArray);

 // Verificar si el checkbox es 1 o 0 y asignar el valor en la columna adecuada para la fila 14
if ($evaluacion->check2 == 1) {
    // Colocar 1 en la columna "Si" (H14)
    $sheet->mergeCells('H14');
    $sheet->setCellValue('H14', '1');
    
    // Dejar la columna "No" (I14) vacía
    $sheet->mergeCells('I14');
    $sheet->setCellValue('I14', '-');
} else {
    // Dejar vacía la columna "Si" (H14)
    $sheet->mergeCells('H14');
    $sheet->setCellValue('H14', '-');
    
    // Colocar 0 en la columna "No" (I14)
    $sheet->mergeCells('I14');
    $sheet->setCellValue('I14', '1');
}

// Aplicar los estilos a las celdas de H14 y I14
$sheet->getStyle('H14:I14')->applyFromArray($styleArray);
$sheet->getStyle('H14:I14')->applyFromArray($wrappedTextArray);
$sheet->getStyle('H14:I14')->applyFromArray($centeredStyle);


        $sheet->getRowDimension('14')->setRowHeight(30);





        $sheet->mergeCells('B15');
        $sheet->setCellValue('B15', '3');
        $sheet->getStyle('B15')->applyFromArray($styleArray);
        $sheet->getStyle('B15')->applyFromArray($wrappedTextArray);
        $sheet->getStyle('B15')->applyFromArray($centeredStyle);

        $sheet->mergeCells('C15:G15');
                $sheet->setCellValue('C15', 'Demuestra conocimiento técnico para ejecutar las actividades y cumplir con el cliente.');
                $sheet->getStyle('C15:G15')->applyFromArray($styleArray);
                $sheet->getStyle('C15:G15')->applyFromArray($wrappedTextArray);

        // Verificar si el checkbox es 1 o 0 y asignar el valor en la columna adecuada para la fila 15
if ($evaluacion->check3 == 1) {
    // Colocar 1 en la columna "Si" (H15)
    $sheet->mergeCells('H15');
    $sheet->setCellValue('H15', '1');
    
    // Dejar la columna "No" (I15) vacía
    $sheet->mergeCells('I15');
    $sheet->setCellValue('I15', '-');
} else {
    // Dejar vacía la columna "Si" (H15)
    $sheet->mergeCells('H15');
    $sheet->setCellValue('H15', '-');
    
    // Colocar 0 en la columna "No" (I15)
    $sheet->mergeCells('I15');
    $sheet->setCellValue('I15', '1');
}

// Aplicar los estilos a las celdas de H15 y I15
$sheet->getStyle('H15:I15')->applyFromArray($styleArray);
$sheet->getStyle('H15:I15')->applyFromArray($wrappedTextArray);
$sheet->getStyle('H15:I15')->applyFromArray($centeredStyle);


        $sheet->getRowDimension('15')->setRowHeight(30);






        $sheet->mergeCells('B16');
        $sheet->setCellValue('B16', '4');
        $sheet->getStyle('B16')->applyFromArray($styleArray);
        $sheet->getStyle('B16')->applyFromArray($wrappedTextArray);
        $sheet->getStyle('B16')->applyFromArray($centeredStyle);

        $sheet->mergeCells('C16:G16');
                $sheet->setCellValue('C16', 'Implementar procedimiento de seguimiento y correción de las actividades planeadas.');
                $sheet->getStyle('C16:G16')->applyFromArray($styleArray);
                $sheet->getStyle('C16:G16')->applyFromArray($wrappedTextArray);

// Verificar si el checkbox es 1 o 0 y asignar el valor en la columna adecuada para la fila 16
if ($evaluacion->check4 == 1) {
    // Colocar 1 en la columna "Si" (H16)
    $sheet->mergeCells('H16');
    $sheet->setCellValue('H16', '1');
    
    // Dejar la columna "No" (I16) vacía
    $sheet->mergeCells('I16');
    $sheet->setCellValue('I16', '-');
} else {
    // Dejar vacía la columna "Si" (H16)
    $sheet->mergeCells('H16');
    $sheet->setCellValue('H16', '-');
    
    // Colocar 0 en la columna "No" (I16)
    $sheet->mergeCells('I16');
    $sheet->setCellValue('I16', '1');
}

// Aplicar los estilos a las celdas de H16 y I16
$sheet->getStyle('H16:I16')->applyFromArray($styleArray);
$sheet->getStyle('H16:I16')->applyFromArray($wrappedTextArray);
$sheet->getStyle('H16:I16')->applyFromArray($centeredStyle);


        $sheet->getRowDimension('16')->setRowHeight(30);










        $sheet->mergeCells('B17');
        $sheet->setCellValue('B17', '5');
        $sheet->getStyle('B17')->applyFromArray($styleArray);
        $sheet->getStyle('B17')->applyFromArray($wrappedTextArray);
        $sheet->getStyle('B17')->applyFromArray($centeredStyle);

        $sheet->mergeCells('C17:G17');
                $sheet->setCellValue('C17', 'Acato los parámetros establecidos por el cliente para satisfacer las necesidades.');
                $sheet->getStyle('C17:G17')->applyFromArray($styleArray);
                $sheet->getStyle('C17:G17')->applyFromArray($wrappedTextArray);

// Verificar si el checkbox es 1 o 0 y asignar el valor en la columna adecuada para la fila 17
if ($evaluacion->check5 == 1) {
    // Colocar 1 en la columna "Si" (H17)
    $sheet->mergeCells('H17');
    $sheet->setCellValue('H17', '1');
    
    // Dejar la columna "No" (I17) vacía
    $sheet->mergeCells('I17');
    $sheet->setCellValue('I17', '-');
} else {
    // Dejar vacía la columna "Si" (H17)
    $sheet->mergeCells('H17');
    $sheet->setCellValue('H17', '-');
    
    // Colocar 0 en la columna "No" (I17)
    $sheet->mergeCells('I17');
    $sheet->setCellValue('I17', '1');
}

// Aplicar los estilos a las celdas de H17 e I17
$sheet->getStyle('H17:I17')->applyFromArray($styleArray);
$sheet->getStyle('H17:I17')->applyFromArray($wrappedTextArray);
$sheet->getStyle('H17:I17')->applyFromArray($centeredStyle);


        $sheet->getRowDimension('17')->setRowHeight(30);










        $sheet->mergeCells('B18');
        $sheet->setCellValue('B18', '6');
        $sheet->getStyle('B18')->applyFromArray($styleArray);
        $sheet->getStyle('B18')->applyFromArray($wrappedTextArray);
        $sheet->getStyle('B18')->applyFromArray($centeredStyle);

        $sheet->mergeCells('C18:G18');
                $sheet->setCellValue('C18', 'El servicio brindado muestra respeto, y actitudes de trato igualitario y/o desinteresado.');
                $sheet->getStyle('C18:G18')->applyFromArray($styleArray);
                $sheet->getStyle('C18:G18')->applyFromArray($wrappedTextArray);

        // Verificar si el checkbox es 1 o 0 y asignar el valor en la columna adecuada para la fila 18
if ($evaluacion->check6 == 1) {
    // Colocar 1 en la columna "Si" (H18)
    $sheet->mergeCells('H18');
    $sheet->setCellValue('H18', '1');
    
    // Dejar la columna "No" (I18) vacía
    $sheet->mergeCells('I18');
    $sheet->setCellValue('I18', '-');
} else {
    // Dejar vacía la columna "Si" (H18)
    $sheet->mergeCells('H18');
    $sheet->setCellValue('H18', '-');
    
    // Colocar 0 en la columna "No" (I18)
    $sheet->mergeCells('I18');
    $sheet->setCellValue('I18', '1');
}

// Aplicar los estilos a las celdas de H18 e I18
$sheet->getStyle('H18:I18')->applyFromArray($styleArray);
$sheet->getStyle('H18:I18')->applyFromArray($wrappedTextArray);
$sheet->getStyle('H18:I18')->applyFromArray($centeredStyle);








// Obtener los valores de los checkboxes
$check1 = $evaluacion->check1;
$check2 = $evaluacion->check2;
$check3 = $evaluacion->check3;
$check4 = $evaluacion->check4;
$check5 = $evaluacion->check5;
$check6 = $evaluacion->check6;

// Calcular la suma de los checkboxes que cumplen
$checkYes = $check1 + $check2 + $check3 + $check4 + $check5 + $check6;
$checkNo = 6 - $checkYes; // Total menos los checkboxes que cumplen

// Escribir en el Excel
$sheet->mergeCells('H19');
$sheet->setCellValue('H19', $checkYes);


$sheet->getStyle('H19')->applyFromArray($styleArray);
$sheet->getStyle('H19')->applyFromArray($wrappedTextArray);
$sheet->getStyle('H19')->applyFromArray($centeredStyle);

$sheet->mergeCells('I19');
$sheet->setCellValue('I19', $checkNo);


$sheet->getStyle('I19')->applyFromArray($styleArray);
$sheet->getStyle('I19')->applyFromArray($wrappedTextArray);
$sheet->getStyle('I19')->applyFromArray($centeredStyle);


        $sheet->mergeCells('G19');
        $sheet->setCellValue('G19', 'Total');
        $sheet->getStyle('G19')->applyFromArray($styleArray);
        $sheet->getStyle('G19')->applyFromArray($wrappedTextArray);

        $sheet->getRowDimension('18')->setRowHeight(30);
        $sheet->getRowDimension('19')->setRowHeight(15);


        








        $sheet->mergeCells('K11:R12');
        $sheet->setCellValue('K11', 'Acciones de mejora');
        $sheet->getStyle('K11:R12')->applyFromArray($orangeBackground);


// Definir estilo para centrar el contenido
$centeredStyleArray = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
];

// Acción de Mejora 1
$sheet->mergeCells('K13:R13');
$sheet->setCellValue('K13', !empty($evaluacion->accionesMejora1) ? $evaluacion->accionesMejora1 : 'N/A');
$sheet->getStyle('K13:R13')->applyFromArray($styleArray);
$sheet->getStyle('K13:R13')->applyFromArray($wrappedTextArray);
$sheet->getStyle('K13:R13')->applyFromArray($centeredStyleArray); // Centrado

// Acción de Mejora 2
$sheet->mergeCells('K14:R14');
$sheet->setCellValue('K14', !empty($evaluacion->accionesMejora2) ? $evaluacion->accionesMejora2 : 'N/A');
$sheet->getStyle('K14:R14')->applyFromArray($styleArray);
$sheet->getStyle('K14:R14')->applyFromArray($wrappedTextArray);
$sheet->getStyle('K14:R14')->applyFromArray($centeredStyleArray); // Centrado

// Acción de Mejora 3
$sheet->mergeCells('K15:R15');
$sheet->setCellValue('K15', !empty($evaluacion->accionesMejora3) ? $evaluacion->accionesMejora3 : 'N/A');
$sheet->getStyle('K15:R15')->applyFromArray($styleArray);
$sheet->getStyle('K15:R15')->applyFromArray($wrappedTextArray);
$sheet->getStyle('K15:R15')->applyFromArray($centeredStyleArray); // Centrado

// Acción de Mejora 4
$sheet->mergeCells('K16:R16');
$sheet->setCellValue('K16', !empty($evaluacion->accionesMejora4) ? $evaluacion->accionesMejora4 : 'N/A');
$sheet->getStyle('K16:R16')->applyFromArray($styleArray);
$sheet->getStyle('K16:R16')->applyFromArray($wrappedTextArray);
$sheet->getStyle('K16:R16')->applyFromArray($centeredStyleArray); // Centrado

// Acción de Mejora 5
$sheet->mergeCells('K17:R17');
$sheet->setCellValue('K17', !empty($evaluacion->accionesMejora5) ? $evaluacion->accionesMejora5 : 'N/A');
$sheet->getStyle('K17:R17')->applyFromArray($styleArray);
$sheet->getStyle('K17:R17')->applyFromArray($wrappedTextArray);
$sheet->getStyle('K17:R17')->applyFromArray($centeredStyleArray); // Centrado

// Acción de Mejora 6
$sheet->mergeCells('K18:R18');
$sheet->setCellValue('K18', !empty($evaluacion->accionesMejora6) ? $evaluacion->accionesMejora6 : 'N/A');
$sheet->getStyle('K18:R18')->applyFromArray($styleArray);
$sheet->getStyle('K18:R18')->applyFromArray($wrappedTextArray);
$sheet->getStyle('K18:R18')->applyFromArray($centeredStyleArray); // Centrado
















        //ENCABEZADOS DE LA MATRIZ











        $sheet->mergeCells('B22:C22');
        $sheet->setCellValue('B22', 'Nombre del prestador de servicio:');
        $sheet->getStyle('B22:C22')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getRowDimension('5')->setRowHeight(30);

        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(25);
        
        $sheet->getRowDimension('22')->setRowHeight(28);

        $sheet->mergeCells('D22:E22');
        $sheet->setCellValue('D22', $evaluacion->nombrePrestador);
        $sheet->getStyle('D22:E22')->applyFromArray($styleArray);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(20);

        $sheet->mergeCells('F22');
        $sheet->setCellValue('F22', '');
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->mergeCells('G22');
        $sheet->setCellValue('G22', '');
        $sheet->getColumnDimension('G')->setWidth(15);

        $sheet->mergeCells('H22:I22');
        $sheet->setCellValue('H22', 'Categoria:');
        $sheet->getStyle('H22:I22')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(15);

        $sheet->mergeCells('J22:K22');
        $sheet->setCellValue('J22', $evaluacion->categoriaServicio);
        $sheet->getStyle('J22:K22')->applyFromArray($styleArray);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(30);

        $sheet->mergeCells('L22');
        $sheet->setCellValue('L22', '');
        $sheet->getColumnDimension('L')->setWidth(15);


        $sheet->mergeCells('M22');
        $sheet->setCellValue('M22', '');
        $sheet->getColumnDimension('M')->setWidth(15);

        $sheet->mergeCells('N22:O22');
        $sheet->setCellValue('N22', 'Firma: ');
        $sheet->getStyle('N22:O22')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getColumnDimension('N')->setWidth(15);
        $sheet->getColumnDimension('O')->setWidth(15);

        $sheet->mergeCells('P22:Q22');
        $sheet->setCellValue('P22', '');
        $sheet->getStyle('P22:Q22')->applyFromArray($styleArray);
        $sheet->getColumnDimension('P')->setWidth(10);
        $sheet->getColumnDimension('Q')->setWidth(15);

        $sheet->mergeCells('R22');
        $sheet->setCellValue('R22', '');
        $sheet->getColumnDimension('R')->setWidth(15);

        
        //CONFIGURACION DE LA PRIMERA FILA DEL ARCHIVO

        // TERCER RENGLON
        $sheet->mergeCells('B24:C24');
        $sheet->setCellValue('B24', 'Nombre del Evaluador: ');
        $sheet->getStyle('B24:C24')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getRowDimension('24')->setRowHeight(28);
        

        $sheet->mergeCells('D24:E24');
        $sheet->setCellValue('D24', $evaluacion->evaluador);
        $sheet->getStyle('D24:E24')->applyFromArray($styleArray);
        $sheet->getStyle('D24:E24')->applyFromArray($wrappedTextArray);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);





        $sheet->mergeCells('H24:I24');
        $sheet->setCellValue('H24', 'Categoria: ');
        $sheet->getStyle('H24:I24')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(15);

        $sheet->mergeCells('J24:K24');
        $sheet->setCellValue('J24', $evaluacion->categoriaEvaluador);
        $sheet->getStyle('J24:K24')->applyFromArray($styleArray);
        $sheet->getStyle('J24:K24')->applyFromArray($wrappedTextArray);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);




       


        $sheet->mergeCells('N24:O24');
        $sheet->setCellValue('N24', 'Firma: ');
        $sheet->getStyle('N24:O24')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFCCCCCC']  // Color gris claro
            ],
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->getColumnDimension('N')->setWidth(10);
        $sheet->getColumnDimension('O')->setWidth(15);

        $sheet->mergeCells('P24:Q24');
        $sheet->setCellValue('P24', '');
        $sheet->getStyle('P24:Q24')->applyFromArray($styleArray);
        $sheet->getColumnDimension('P')->setWidth(10);
        $sheet->getColumnDimension('Q')->setWidth(15);

        $sheet->mergeCells('R24');
        $sheet->setCellValue('R24', '');
        $sheet->getColumnDimension('R')->setWidth(15);









        



    // Crear el archivo Excel en memoria
    $writer = new Xlsx($spreadsheet);
    $fileName = 'EncuestaSatisfaccion.xlsx';

    // Enviar el archivo directamente como respuesta al navegador
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. urlencode($fileName) .'"');
    $writer->save('php://output');
    exit;
}
}

