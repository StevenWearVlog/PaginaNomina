<?php
require '../vendor/autoload.php';
require '../model/Empleado.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
    $archivoTemporal = $_FILES['archivo']['tmp_name'];
    $destino = '../uploads/nomina.xls';
    move_uploaded_file($archivoTemporal, $destino);

    $documento = IOFactory::load($destino);
    $hoja = $documento->getActiveSheet();

    $empleados = [];

    foreach ($hoja->getRowIterator() as $fila) {
        $filaIndex = $fila->getRowIndex();
        if ($filaIndex < 2) continue;

        $id = $hoja->getCell("A$filaIndex")->getCalculatedValue();
        $nombre = $hoja->getCell("B$filaIndex")->getCalculatedValue();
        $cargo = $hoja->getCell("C$filaIndex")->getCalculatedValue();
        $salario = $hoja->getCell("D$filaIndex")->getCalculatedValue();

        if (
            is_numeric($salario) &&
            !empty($id) &&
            !empty($nombre) &&
            strtoupper(trim($nombre)) !== 'TOTAL' &&
            strtoupper(trim($salario)) !== 'TOTAL'
        ) {
            $empleado = new Empleado($id, $nombre, $cargo, $salario);
            $empleados[] = $empleado->toArray();
        }
    }

    file_put_contents('../json/nomina.json', json_encode($empleados, JSON_PRETTY_PRINT));
    header('Location: ../tabla-migrada.php');
    exit;
} else {
    echo "Error al subir el archivo.";
}
?>
