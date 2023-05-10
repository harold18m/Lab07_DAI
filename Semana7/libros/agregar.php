<?php

include('../conexion/conexion.php');

// Obtenemos los valores del formulario
$anio = $_POST['anio'];
$autor_id = $_POST['autor_id'];
$titulo = $_POST['titulo'];
$url_libro = $_POST['url_libro'];
$especialidad = $_POST['especialidad'];
$editorial = $_POST['editorial'];

// Abrimos una conexión a la base de datos
$conexion = conectar();

// Preparamos la consulta a la base de datos
$query = $conexion->prepare('INSERT INTO libros ( anio, autor_id, titulo, url_libro, especialidad, editorial) VALUES (?, ?, ?, ?, ?, ?)');
$query->bind_param('sissss', $anio, $autor_id, $titulo, $url_libro, $especialidad, $editorial);

// Ejecutamos la consulta a la base de datos
$msg = '';
if ($query->execute()) {
    $msg = 'Libro registrado con éxito';
} else {
    $msg = 'No se pudo registrar al libro';
}

// Cerramos la conexión a la base de datos
desconectar($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
    <title>Agregar libro</title>
</head>
<body>
    <h1>Agregar libro</h1>
    <h3><?php echo $msg ?></h3>
    <a href="libros.php">Regresar</a>
</body>
</html>