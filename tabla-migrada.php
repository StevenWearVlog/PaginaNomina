<?php $datos = include 'controller/cargar_datos.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nomina</title>
    <link rel="stylesheet" href="view/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="cuerpo">
        <header class="header">
            <div class="logo-nomina">
                <img src="view/images/logo-nomina.png" alt="Logo del sistema de nómina">
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.html">Inicio</a></li>
                </ul>
            </nav>
        </header>
    </div>

    <div class="contenedor-titulo">
        <h1>MIGRACIÓN <br> DE DATOS</h1>
    </div>

    <!-- Formulario para subir archivo Excel -->
    <div class="carga-de-archivos">
        <form action="controller/migrar.php" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo" required>
            <button type="submit" class="boton-envio">Migrar archivo Excel</button>
        </form>
    </div>

    <!-- Tabla de datos migrados -->
    <div class="contenedor-tabla">
        <h1>TU TABLA NOMINA</h1>
        <div>
            <table border="1" style="color:white; border-collapse: collapse; width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Salario Mensual</th>
                        <th>Días Laborados</th>
                        <th>Total Salario</th>
                        <th>Horas Extras</th>
                        <th>Comisiones</th>
                        <th>Total Devengado</th>
                        <th>Total Deducido</th>
                        <th>Neto a Pagar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'view/tabla.php'; ?>
                </tbody>
            </table>

            <!-- Estadísticas -->
            <?php include 'view/estadisticas.php'; ?>

            <!-- GRÁFICO DE NETO A PAGAR -->
            <?php
            $nombres = [];
            $netos = [];

            foreach ($datos as $e) {
                if (isset($e['nombre'], $e['neto_pagar']) && is_numeric($e['neto_pagar'])) {
                    $nombres[] = $e['nombre'];
                    $netos[] = (float)$e['neto_pagar'];
                }
            }
            ?>
            <div class="contenedor-estadisticas" style="color:white; margin-top: 50px;">
                <h2>📉 Gráfico: Neto a Pagar por Empleado</h2>
                <canvas id="graficoNeto" width="800" height="300" style="background-color: white; border-radius: 15px;"></canvas>
            </div>

            <script>
                const labels = <?= json_encode($nombres) ?>;
                const data = <?= json_encode($netos) ?>;

                console.log("👥 Nombres:", labels);
                console.log("💰 Netos:", data);

                const ctx = document.getElementById('graficoNeto')?.getContext('2d');

                if (labels.length > 0 && data.length > 0 && ctx) {
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Neto a Pagar',
                                data: data,
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return '$' + value.toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    });
                } else {
                    console.warn("⚠️ No hay datos válidos para graficar o canvas no encontrado.");
                }
            </script>
        </div>
    </div>
</body>
</html>
