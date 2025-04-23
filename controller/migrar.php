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

    // Leer solo las filas de los empleados (10 a 35)
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

        // Validar que los datos sean consistentes
        if (
            !empty($nombre) &&
            is_numeric($salarioMensual) &&
            is_numeric($netoPagar) &&
            !in_array(strtoupper(trim($nombre)), ['HORA DIURNA', 'HORA NOCTURNA', 'DOMINICAL', 'TOTAL'])
        ) {
            $empleado = [
                "nombre"              => $nombre,
                "salario_mensual"     => (float)$salarioMensual,
                "dias_laborados"      => (int)$diasLaborados,
                "total_salario"       => (float)$totalSalario,
                "valor_horas_extras"  => (float)$valorExtras,
                "comisiones"          => (float)$comisiones,
                "total_devengado"     => (float)$totalDevengado,
                "total_deducido"      => (float)$totalDeducido,
                "neto_pagar"          => (float)$netoPagar
            ];
            $empleados[] = $empleado;
        }
    }

    // Guardar el archivo JSON
    file_put_contents('../json/nomina.json', json_encode($empleados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Redirigir a la vista principal
    header('Location: ../tabla-migrada.php');
    exit;
} else {
    echo "Error al subir el archivo.";
}
?>
