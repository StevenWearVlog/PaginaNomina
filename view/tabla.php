<?php foreach ($datos as $empleado): ?>
    <tr>
        <td><?= htmlspecialchars($empleado['nombre']) ?></td>
        <td>$<?= number_format($empleado['salario_mensual'], 0, ',', '.') ?></td>
        <td><?= $empleado['dias_laborados'] ?></td>
        <td>$<?= number_format($empleado['total_salario'], 0, ',', '.') ?></td>
        <td>$<?= number_format($empleado['valor_horas_extras'], 0, ',', '.') ?></td>
        <td>$<?= number_format($empleado['comisiones'], 0, ',', '.') ?></td>
        <td>$<?= number_format($empleado['total_devengado'], 0, ',', '.') ?></td>
        <td>$<?= number_format($empleado['total_deducido'], 0, ',', '.') ?></td>
        <td>$<?= number_format($empleado['neto_pagar'], 0, ',', '.') ?></td>
    </tr>
<?php endforeach; ?>
