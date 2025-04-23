<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..view\style.css">
    <title>Nomina</title>
</head>
<body>
    <div class="cuerpo">
            <header class="header">
                <div class="logo-nomina">
                    <img src="../view/images/logo-nomina.png
                    " alt="logo de la marca de la nomina">
                </div>
                <nav>
                    <ul class="nav-links">
                        <li> <a href="index.html">Inicio</a> </li>
                        <li> </li>
                    </ul>
                </nav>
            </header>
        </div>
        <div class="contenedor-titulo">
            <h1>
                MIGRACIÓN <br> DE DATOS
            </h1>
        </div>
        <div class="carga-de-archivos">
            <form action="controller/migrar.php" method="post" enctype="multipart/form-data">
                <input type="file" name="archivo" required>
                <button type="submit">Migrar archivo Excel</button>
            </form>
        </div>
        <div class="boton-envio">
            <button class="boton-envio" id="">CARGAR ARCHIVOS</button>
        </div>
        <div class="contenedor-tabla">
            <h1>TU TABLA NOMINA</h1>
            <div class="contenedor-de-tabla">
            <?php
            $jsonPath = 'json/nomina.json';
            $datos = [];
            if (file_exists($jsonPath)) {
    $contenido = file_get_contents($jsonPath);
    $datos = json_decode($contenido, true);
}
?>

<div class="contenedor-de-tabla">

    <?php if (empty($datos)) : ?>
        <p>No hay datos migrados aún. Por favor sube el archivo Excel.</p>
    <?php else : ?>
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
                <?php foreach ($datos as $empleado) : ?>
                    <tr>
                        <td><?= htmlspecialchars($empleado['id']) ?></td>
                        <td><?= htmlspecialchars($empleado['nombre']) ?></td>
                        <td><?= htmlspecialchars($empleado['cargo']) ?></td>
                        <td>$<?= number_format($empleado['salario'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

            </div>

        </div>
    </div>
</body>
</html>