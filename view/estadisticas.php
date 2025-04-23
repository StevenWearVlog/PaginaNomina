<?php
$totalEmpleados = count($datos);
$totalNeto = array_sum(array_column($datos, 'neto_pagar'));
$promedioNeto = $totalEmpleados > 0 ? $totalNeto / $totalEmpleados : 0;
$empleadoTop = array_reduce($datos, fn($top, $e) => $e['neto_pagar'] > ($top['neto_pagar'] ?? 0) ? $e : $top);
?>

<div class="contenedor-estadisticas" style="margin-top: 30px; color: white;">
    <h2>📊 Estadísticas de la Nómina</h2>
    <p><strong>Total de empleados:</strong> <?= $totalEmpleados ?></p>
    <p><strong>Promedio de neto a pagar:</strong> $<?= number_format($promedioNeto, 0, ',', '.') ?></p>
    <p><strong>Total a pagar en nómina:</strong> $<?= number_format($totalNeto, 0, ',', '.') ?></p>
    <?php if ($empleadoTop): ?>
        <p><strong>Empleado mejor pagado:</strong> <?= $empleadoTop['nombre'] ?> - $<?= number_format($empleadoTop['neto_pagar'], 0, ',', '.') ?></p>
    <?php else: ?>
        <p><strong>Empleado mejor pagado:</strong> No disponible.</p>
    <?php endif; ?>
</div>
