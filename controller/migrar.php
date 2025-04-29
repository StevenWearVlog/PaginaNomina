<?php
require '../vendor/autoload.php';
require '../model/Empleado.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
    $archivoTemporal = $_FILES['archivo']['tmp_name'];
    $destino = '../uploads/nomina.xlsx';
    move_uploaded_file($archivoTemporal, $destino);

    $documento = IOFactory::load($destino);
    $hoja = $documento->getActiveSheet();

    $empleados = [];

    // Leer solo filas de empleados (fila 10 a fila 35)
    $filaInicial = 10;
    $filaFinal = 35;

    for ($filaIndex = $filaInicial; $filaIndex <= $filaFinal; $filaIndex++) {
        $nombre           = $hoja->getCell("A$filaIndex")->getCalculatedValue();
        $salarioMensual   = $hoja->getCell("B$filaIndex")->getCalculatedValue();
        $diasLaborados    = $hoja->getCell("C$filaIndex")->getCalculatedValue();
        $totalSalario     = $hoja->getCell("D$filaIndex")->getCalculatedValue();
        $valorExtras      = $hoja->getCell("H$filaIndex")->getCalculatedValue();
        $comisiones       = $hoja->getCell("L$filaIndex")->getCalculatedValue();
        $totalDevengado   = $hoja->getCell("M$filaIndex")->getCalculatedValue();
        $totalDeducido    = $hoja->getCell("Q$filaIndex")->getCalculatedValue();
        $netoPagar        = $hoja->getCell("R$filaIndex")->getCalculatedValue();

        // Validar que la fila sea de un empleado
        if (
            !empty($nombre) &&
            is_numeric($salarioMensual) &&
            is_numeric($netoPagar) &&
            !in_array(strtoupper(trim($nombre)), ['HORA DIURNA', 'HORA NOCTURNA', 'DOMINICAL', 'TOTAL'])
        ) {
            $empleado = new Empleado(
                $nombre,
                (float)$salarioMensual,
                (int)$diasLaborados,
                (float)$totalSalario,
                (float)$valorExtras,
                (float)$comisiones,
                (float)$totalDevengado,
                (float)$totalDeducido,
                (float)$netoPagar
            );

            $empleados[] = $empleado->toArray(); // Guardamos usando POO
        }
    }

    // Guardar el archivo JSON
    file_put_contents('../json/nomina.json', json_encode($empleados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Redirigir
    header('Location: ../tabla-migrada.php');
    exit;
} else {
    echo "Error al subir el archivo.";
}
?>
