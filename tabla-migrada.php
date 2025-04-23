<?php $datos = include 'controller/cargar_datos.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nomina</title>
    <link rel="stylesheet" href="view/style.css">
</head>
<body>
    <div class="cuerpo">
        <header class="header">
            <div class="logo-nomina">
                <img src="view/images/logo-nomina.png" alt="logo de la marca de la nomina">
            </div>
            <nav>
                <ul class="nav-links">
                    <li> <a href="index.html">Inicio</a> </li>
                </ul>
            </nav>
        </header>
    </div>

    <div class="contenedor-titulo">
        <h1>MIGRACIÓN <br> DE DATOS</h1>
    </div>

    <div class="carga-de-archivos">
        <form action="controller/migrar.php" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo" required>
            <button type="submit" class="boton-envio">Migrar archivo Excel</button>
        </form>
    </div>

    <div class="contenedor-tabla">
        <h1>TU TABLA NOMINA</h1>
        <div class="contenedor-de-tabla">
            <table border="1" style="color:white; border-collapse: collapse; width: 90%; text-align: center;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Salario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'view/tabla.php'; ?>
                </tbody>
            </table>

            <?php include 'view/estadisticas.php'; ?>
            <!-- GRÁFICO DE SALARIOS -->
            <div class="contenedor-estadisticas" style="color:white; margin-top: 50px;">
                <h2>📉 Gráfico: Salario por Empleado</h2>
                <canvas id="graficoSalarios" width="800" height="300" style="background-color: white; border-radius: 15px;"></canvas>
            </div>

        </div>
    </div>

        <!-- Script para generar el gráfico -->
        <?php
    $nombres = [];
    $salarios = [];
    foreach ($datos as $e) {
        if (is_numeric($e['salario'])) {
            $nombres[] = $e['nombre'];
            $salarios[] = $e['salario'];
        }
    }
    ?>
    <script>
        const ctx = document.getElementById('graficoSalarios').getContext('2d');
        const grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($nombres) ?>,
                datasets: [{
                    label: 'Salario por Empleado',
                    data: <?= json_encode($salarios) ?>,
                    backgroundColor: 'rgba(0, 255, 255, 0.5)',
                    borderColor: 'aqua',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>
</html>
