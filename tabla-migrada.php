<?php $datos = include 'controller/cargar_datos.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nomina</title>
    <link rel="stylesheet" href="../nomina/view/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="cuerpo">
        <header class="header">
            <div class="logo-nomina">
                <img src="../nomina/view/images/Logo_nomina.png" alt="logo de la marca de la nomina">
            </div>
            <nav>
                <ul class="nav-links">
                    <li> <a href="index.html">Inicio</a> </li>
                </ul>
            </nav>
            <a href="https://wa.me/qr/K3S5FEXWJUIMD1" class="btn"><button>Contacto soporte</button></a>
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
        <div>
            <table border="1" style="color:white; border-collapse: collapse; width: 90%; text-align: center;">
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

            <?php include 'view/estadisticas.php'; ?>
            <!-- GRÁFICO DE SALARIOS -->
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

                const ctx = document.getElementById('graficoNeto').getContext('2d');
                if (labels.length > 0 && data.length > 0) {
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
                }
            </script>
        </div>
    </div>

</body>
</html>
