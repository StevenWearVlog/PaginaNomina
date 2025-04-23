<?php foreach ($datos as $empleado): ?>
    <?php if (!is_numeric($empleado['salario'])) continue; ?>
    <tr>
        <td><?= htmlspecialchars($empleado['id']) ?></td>
        <td><?= htmlspecialchars($empleado['nombre']) ?></td>
        <td><?= htmlspecialchars($empleado['cargo']) ?></td>
        <td>$<?= number_format($empleado['salario'], 0, ',', '.') ?></td>
    </tr>
<?php endforeach; ?>
