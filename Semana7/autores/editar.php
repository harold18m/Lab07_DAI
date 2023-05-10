<?php

include('../conexion/conexion.php');

// Si se envió el formulario de edición
if (isset($_POST['editar'])) {

    // Obtenemos los valores del formulario
    $autor_id = $_POST['autor_id'];
    $nombres = $_POST['nombres'];
    $ape_paterno = $_POST['ape_paterno'];
    $ape_materno = $_POST['ape_materno'];

    // Abrimos una conexión a la base de datos
    $conexion = conectar();

    // Actualizamos los datos del autor en la base de datos
    $query = $conexion->prepare('UPDATE autores SET nombres = ?, ape_paterno = ?, ape_materno = ? WHERE autor_id = ?');
    $query->bind_param('sssi', $nombres, $ape_paterno, $ape_materno, $autor_id);
    $msg = '';
    if ($query->execute()) {
        $msg = 'Autor actualizado con éxito';
    } else {
        $msg = 'No se pudo actualizar al autor';
    }

    // Cerramos la conexión a la base de datos
    desconectar($conexion);

    // Redirigimos al listado de autores
    header('Location: autores.php');
    exit();
}

// Si no se envió el formulario de edición, mostramos los datos actuales del autor
else {

    // Obtenemos el ID del autor a editar
    $autor_id = $_POST['autor_id'];

    // Abrimos una conexión a la base de datos
    $conexion = conectar();

    // Consultamos los datos del autor en la base de datos
    $query = $conexion->prepare('SELECT nombres, ape_paterno, ape_materno FROM autores WHERE autor_id = ?');
    $query->bind_param('i', $autor_id);
    $query->execute();
    $resultado = $query->get_result();
    $autor = $resultado->fetch_array();

    // Cerramos la conexión a la base de datos
    desconectar($conexion);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
    <title>Editar autor</title>
</head>

<body>
    <h1 class="text-3xl font-bold mb-8 py-5 text-center">Editar autor</h1>
    <form action="editar.php" method="post" class="w-1/2 mx-auto">
        <input type="hidden" name="autor_id" value="<?php echo $autor_id ?>">
        <div class="mb-4">
            <label for="nombres" class="block font-medium mb-2">Nombres:</label>
            <input type="text" name="nombres" id="nombres" value="<?php echo $autor['nombres'] ?>" required
                class="w-full border border-gray-300 px-4 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label for="ape_paterno" class="block font-medium mb-2">Apellido Paterno:</label>
            <input type="text" name="ape_paterno" id="ape_paterno" value="<?php echo $autor['ape_paterno'] ?>" required
                class="w-full border border-gray-300 px-4 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label for="ape_materno" class="block font-medium mb-2">Apellido Materno:</label>
            <input type="text" name="ape_materno" id="ape_materno" value="<?php echo $autor['ape_materno'] ?>" required
                class="w-full border border-gray-300 px-4 py-2 rounded-md">
        </div>
        <div class="text-right">
            <button type="submit" name="editar"
                class="bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600">Actualizar</button>
        </div>
    </form>
    <div class="mt-8 text-center">
        <a href="autores.php" class="text-blue-500 hover:underline">Regresar</a>
    </div>
</body>

</html>