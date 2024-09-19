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

class ExcelController extends Controller
{
    public function export()
    {
        //OBTENER TODOS LOS DATOS DE LA TABLA DE ASIGNACIONES Y DE INVENTARIO.
        $asignaciones = asignar::with('inventario')->get();
        //OBTENER TODOS LOS DATOS DE LA TABLA DE ASIGNACIONES Y DE INVENTARIO.


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
        $sheet->setCellValue('B2', 'Plan de Tecnologías de la Información recursos de infraestructura');
        $sheet->setCellValue('Q2', 'Código: DS-TI-01-REV.00');
        $sheet->setCellValue('B3', 'Control de asignación de equipos de computo activos.');
        $sheet->setCellValue('Q3', 'Emisión: 12-09-2021');

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
        $sheet->mergeCells('B5');
        $sheet->setCellValue('B5', 'Ubicación:');
        $sheet->getStyle('B5')->applyFromArray([
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



        $sheet->getColumnDimension('B')->setWidth(15);

        $sheet->mergeCells('C5:E5');
        $sheet->setCellValue('C5', 'Oficinas Centrales  Servicios y Equipos TOPO S.A.  de C.V.');
        $sheet->getStyle('C5:E5')->applyFromArray($styleArray);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(20);

        $sheet->mergeCells('F5');
        $sheet->setCellValue('F5', '');
        $sheet->getColumnDimension('F')->setWidth(15);

        $sheet->mergeCells('G5');
        $sheet->setCellValue('G5', 'Área/Departamento: ');
        $sheet->getStyle('G5')->applyFromArray([
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
        $sheet->getColumnDimension('G')->setWidth(35);

        $sheet->mergeCells('H5:I5');
        $sheet->setCellValue('H5', 'Tecnologías de la Información ');
        $sheet->getStyle('H5:I5')->applyFromArray($styleArray);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(30);

        $sheet->mergeCells('J5');
        $sheet->setCellValue('J5', '');
        $sheet->getColumnDimension('J')->setWidth(15);

        $sheet->mergeCells('K5');
        $sheet->setCellValue('K5', 'Encargado de área :');
        $sheet->getStyle('K5')->applyFromArray([
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
        $sheet->getColumnDimension('K')->setWidth(35);

        $sheet->mergeCells('L5');
        $sheet->setCellValue('L5', 'William Amurabi Lezama Murillo');
        $sheet->getStyle('L5')->applyFromArray($styleArray);
        $sheet->getColumnDimension('L')->setWidth(30);

        $sheet->mergeCells('M5');
        $sheet->setCellValue('M5', '');
        $sheet->getColumnDimension('M')->setWidth(15);

        $sheet->mergeCells('N5');
        $sheet->setCellValue('N5', 'Categoría: ');
        $sheet->getStyle('N5')->applyFromArray([
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

        $sheet->mergeCells('O5');
        $sheet->setCellValue('O5', 'Encargado TI ');
        $sheet->getStyle('O5')->applyFromArray($styleArray);
        $sheet->getColumnDimension('O')->setWidth(15);

        $sheet->mergeCells('P5');
        $sheet->setCellValue('P5', '');
        $sheet->getColumnDimension('P')->setWidth(15);

        $sheet->mergeCells('Q5');
        $sheet->setCellValue('Q5', 'Categoría: ');
        $sheet->getStyle('Q5')->applyFromArray([
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
        $sheet->getColumnDimension('Q')->setWidth(15);

        $sheet->mergeCells('R5');
        $sheet->setCellValue('R5', 'Encargado TI ');
        $sheet->getStyle('R5')->applyFromArray($styleArray);
        $sheet->getColumnDimension('R')->setWidth(15);
        //CONFIGURACION DE LA PRIMERA FILA DEL ARCHIVO

        // TERCER RENGLON
        $sheet->mergeCells('B7');
        $sheet->setCellValue('B7', 'Objetivo: ');
        $sheet->getStyle('B7')->applyFromArray([
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
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getRowDimension('7')->setRowHeight(28);

        $sheet->mergeCells('C7:I7');
        $sheet->setCellValue('C7', 'Identificar los recursos activos de infraestructura  del departamento de Tecnologías de la información ,  sus características y asignación en la organización para realizar el control respectivo ');
        $sheet->getStyle('C7:I7')->applyFromArray($styleArray);
        $sheet->getStyle('C7:I7')->applyFromArray($wrappedTextArray);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(30);

        $sheet->mergeCells('K7');
        $sheet->setCellValue('K7', 'Encargado de área :');
        $sheet->getStyle('K7')->applyFromArray([
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
        $sheet->getColumnDimension('K')->setWidth(35);

        $sheet->mergeCells('L7');
        $sheet->setCellValue('L7', '=TODAY()');
        $sheet->getStyle('L7')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
        $sheet->getStyle('L7')->applyFromArray($styleArray);
        $sheet->getColumnDimension('L')->setWidth(30);

        $sheet->mergeCells('M7');
        $sheet->setCellValue('M7', '');
        $sheet->getColumnDimension('M')->setWidth(15);

        $sheet->mergeCells('N7');
        $sheet->setCellValue('N7', 'Periodo: ');
        $sheet->getStyle('N7')->applyFromArray([
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

        $sheet->mergeCells('O7');
        $sheet->setCellValue('O7', '2022-2024 ');
        $sheet->getStyle('O7')->applyFromArray($styleArray);
        $sheet->getColumnDimension('O')->setWidth(15);

        $sheet->mergeCells('P7');
        $sheet->setCellValue('P7', '');
        $sheet->getColumnDimension('P')->setWidth(15);

        $sheet->mergeCells('Q7');
        $sheet->setCellValue('Q7', 'Periodo: ');
        $sheet->getStyle('Q7')->applyFromArray([
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
        $sheet->getColumnDimension('Q')->setWidth(15);

        $sheet->mergeCells('R7');
        $sheet->setCellValue('R7', '2022-2024 ');
        $sheet->getStyle('R7')->applyFromArray($styleArray);
        $sheet->getColumnDimension('R')->setWidth(15);
        //TERCER RENGLON

        //CUARTO RENGLON
        $sheet->mergeCells('B9:R9');
        $sheet->setCellValue('B9', 'Control de asignación de equipos de computo');
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


        //ENCABEZADOS DE LA MATRIZ
        $sheet->setCellValue('B10', 'Código');
        $sheet->setCellValue('C10', 'Numero de Serie/Control');
        $sheet->setCellValue('D10', 'Marca');
        $sheet->setCellValue('E10', 'Modelo');
        $sheet->setCellValue('F10', 'RAM');
        $sheet->setCellValue('G10', 'HDD');
        $sheet->mergeCells('G10');
        $sheet->getColumnDimension('G')->setWidth(35);
        $sheet->setCellValue('H10', 'Contraseña');
        $sheet->setCellValue('I10', 'Nombre Usuario');
        $sheet->setCellValue('J10', 'Asignación');
        $sheet->setCellValue('K10', 'Empleado');
        $sheet->setCellValue('L10', 'Correo');
        $sheet->mergeCells('M10:O10');
        $sheet->setCellValue('M10', 'Observaciones');
        $sheet->mergeCells('P10:R10');
        $sheet->setCellValue('P10', 'Primer Mtto Programado');
        $sheet->getStyle('B10:R10')->applyFromArray($orangeBackground);
        //ENCABEZADOS DE LA MATRIZ

        //CONFIGURACIÓN DE LA MATRIZ PARA MOSTRAR LOS DATOS
        $row = 11; // INICIO DE RECORRIDO EN LA FILA 11
        foreach ($asignaciones as $asignacion) {
            $sheet->setCellValue('B' . $row, $asignacion->id);
            $sheet->setCellValue('C' . $row, $asignacion->inventario->inventarioSerie ?? '');
            $sheet->setCellValue('D' . $row, $asignacion->inventario->inventarioMarca ?? '');
            $sheet->setCellValue('E' . $row, $asignacion->inventario->inventarioModelo ?? '');
            $sheet->setCellValue('F' . $row, $asignacion->inventario->inventarioRAM ?? '');
            $sheet->setCellValue('G' . $row, $asignacion->inventario->inventarioAlmacenamiento ?? '');
            $sheet->setCellValue('H' . $row, $asignacion->inventario->inventarioContraseña ?? '');
            $sheet->setCellValue('I' . $row, $asignacion->asignarUsuarioNombre);
            $sheet->setCellValue('J' . $row, $asignacion->inventario->inventarioEstado);
            $sheet->setCellValue('K' . $row, $asignacion->asignarUsuario);
            $sheet->setCellValue('L' . $row, $asignacion->asignarEquipoCorreo);
            $sheet->mergeCells('M' . $row . ':O' . $row);
            $sheet->setCellValue('M' . $row, $asignacion->inventario->inventarioObservaciones);
            $sheet->mergeCells('P' . $row . ':R' . $row);
            $sheet->setCellValue('P' . $row, 'Sin programar');

            // APLICAR ESTILOS GENERALES A CADA FILA DE DATOS
            $sheet->getStyle('B' . $row . ':R' . $row)->applyFromArray([
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
            ]);

            $sheet->getStyle('B' . $row)->applyFromArray($grayStyleArray);

            $sheet->getRowDimension($row)->setRowHeight(28);

            $row++; // Pasar a la siguiente fila
        }

        //CONFIGURACIÓN DE LA MATRIZ PARA MOSTRAR LOS DATOS


        // Preparar escritor y salida del archivo
        $writer = new Xlsx($spreadsheet);
        $fileName = 'reporte_encabezado.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName, ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])->deleteFileAfterSend(true);
    }
}
