<?php

include('../conexion/conexion.php');

// Obtenemos los valores del formulario
$nombres = $_POST['nombres'];
$ape_paterno = $_POST['ape_paterno'];
$ape_materno = $_POST['ape_materno'];

// Abrimos una conexión a la base de datos
$conexion = conectar();

// Consultamos a la base de datos
$query = $conexion->prepare('INSERT INTO autores (nombres, ape_paterno, ape_materno) VALUE (?, ?, ?)');
$query->bind_param('sss', $nombres, $ape_paterno, $ape_materno);
$msg = '';
if ($query->execute()) {
    $msg = 'Autor registrado con éxito';
}
else {
    $msg = 'No se pudo registrar al autor';
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
    <title>Agregar autor</title>
</head>
<body class="bg-gray-200">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-8">Agregar autor</h1>
        <h3 class="text-red-600 mb-4"><?php echo $msg ?></h3>
        <a href="autores.php" class="text-blue-500 hover:text-blue-600 mb-4 inline-block">&laquo; Regresar</a>
    </div>
</body>

</html>