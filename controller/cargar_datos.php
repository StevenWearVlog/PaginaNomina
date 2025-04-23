<?php
$jsonPath = 'json/nomina.json';
$datos = [];

if (file_exists($jsonPath)) {
    $contenido = file_get_contents($jsonPath);
    $datos = json_decode($contenido, true);
}

return $datos;
