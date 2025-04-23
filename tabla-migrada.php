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
        </div>
    </div>
</body>
</html>
