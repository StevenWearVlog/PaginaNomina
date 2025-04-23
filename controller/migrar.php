<?php
require '../vendor/autoload.php';
require '../model/Empleado.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Validar que haya archivo subido
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
    $archivoTemporal = $_FILES['archivo']['tmp_name'];
    $nombreFinal = '../uploads/nomina.xls';
    move_uploaded_file($archivoTemporal, $nombreFinal);

    $documento = IOFactory::load($nombreFinal);
    $hoja = $documento->getActiveSheet();
    $empleados = [];

    foreach ($hoja->getRowIterator() as $fila) {
        if ($fila->getRowIndex() < 2) continue;
    
        $filaIndex = $fila->getRowIndex();
        $id = $hoja->getCell("A$filaIndex")->getValue();
        $nombre = $hoja->getCell("B$filaIndex")->getValue();
        $cargo = $hoja->getCell("C$filaIndex")->getValue();
        $salario = $hoja->getCell("D$filaIndex")->getValue();
    
        if ($id !== null && $nombre !== null) {
            $empleado = new Empleado($id, $nombre, $cargo, $salario);
            $empleados[] = $empleado->toArray();
        }
    }
    

    file_put_contents('../json/nomina.json', json_encode($empleados, JSON_PRETTY_PRINT));
    echo "Migración exitosa. <a href='../tabla-migrada.php'>Ver tabla</a>";
} else {
    echo "Error al subir el archivo.";
}
?>
