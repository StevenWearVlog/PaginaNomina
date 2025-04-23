<?php
$validos = array_filter($datos, fn($e) => is_numeric($e['salario']));
$totalEmpleados = count($validos);
$totalSalarios = array_sum(array_column($validos, 'salario'));
$salarioPromedio = $totalEmpleados > 0 ? $totalSalarios / $totalEmpleados : 0;
$empleadoTop = array_reduce($validos, fn($top, $e) => $e['salario'] > ($top['salario'] ?? 0) ? $e : $top);
?>

<div class="contenedor-estadisticas" style="margin-top: 30px; color: white;">
    <h2>📊 Estadísticas de la Nómina</h2>
    <p><strong>Total de empleados:</strong> <?= $totalEmpleados ?></p>
    <p><strong>Salario promedio:</strong> $<?= number_format($salarioPromedio, 0, ',', '.') ?></p>
    <p><strong>Total de la nómina:</strong> $<?= number_format($totalSalarios, 0, ',', '.') ?></p>
    <?php if ($empleadoTop): ?>
        <p><strong>Empleado con mayor salario:</strong> <?= $empleadoTop['nombre'] ?> (<?= $empleadoTop['cargo'] ?> - $<?= number_format($empleadoTop['salario'], 0, ',', '.') ?>)</p>
    <?php else: ?>
        <p><strong>Empleado con mayor salario:</strong> No disponible.</p>
    <?php endif; ?>
</div>
