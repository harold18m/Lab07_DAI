<?php

include('../conexion/conexion.php');

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consultamos a la base de datos
$query = $conexion->prepare('SELECT a.libro_id, a.anio ,CONCAT(b.nombres, " ", b.ape_paterno) as autor, a.titulo, a.url_libro, a.especialidad, a.editorial FROM libros a INNER JOIN autores b ON a.autor_id = b.autor_id');

if (!$query) {
    die('Error en la consulta: '.$conexion->error);
}

$query->execute();
$resultado = $query->get_result();
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
    <title>Libros</title>
</head>

<body class="bg-gray-100">
<nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <a href="/Semana7/index.html" class="font-bold text-xl text-blue-500">Gestión</a>
                <div class="flex space-x-4">
                    <a href="/Semana7/autores/autores.php"
                        class="py-2 px-4 rounded-md bg-blue-500 text-white font-semibold hover:bg-blue-600">Autores</a>
                    <a href="/Semana7/libros/libros.php"
                        class="py-2 px-4 rounded-md bg-blue-500 text-white font-semibold hover:bg-blue-600">Libros</a>
                </div>
            </div>
    </nav>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-8">Gestión de libros</h1>
        <a href="agregar_libro.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md mb-4">Nuevo libro</a>
        <table class="table-auto w-full bg-white shadow rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 text-gray-800 font-bold">Id</th>
                    <th class="py-2 px-4 text-gray-800 font-bold">Año</th>
                    <th class="py-2 px-4 text-gray-800 font-bold">Autor</th>
                    <th class="py-2 px-4 text-gray-800 font-bold">Titulo</th>
                    <th class="py-2 px-4 text-gray-800 font-bold">URL</th>
                    <th class="py-2 px-4 text-gray-800 font-bold">Especialidad</th>
                    <th class="py-2 px-4 text-gray-800 font-bold">Editorial</th>
                    <th class="py-2 px-4 text-gray-800 font-bold">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while ($libro = $resultado->fetch_array()) {
                    echo '<tr>';
                    echo '<td class="border py-2 px-4">' . $libro['libro_id'] . '</td>';
                    echo '<td class="border py-2 px-4">' . $libro['anio'] . '</td>';
                    echo '<td class="border py-2 px-4">' . $libro['autor'] . '</td>';
                    echo '<td class="border py-2 px-4">' . $libro['titulo'] . '</td>';
                    echo '<td class="border py-2 px-4"><a href="' . $libro['url_libro'] . '" target="_blank" rel="noopener noreferrer">Ver libro</a></td>';
                    echo '<td class="border py-2 px-4">' . $libro['especialidad'] . '</td>';
                    echo '<td class="border py-2 px-4">' . $libro['editorial'] . '</td>';
                    echo '<td class="border py-2 px-4">
                        <form action="./editar.php" method="post" class="inline-block">
                            <input type="hidden" name="libro_id" value="' . $libro['libro_id'] . '">
                            <input type="hidden" name="anio" value="' . $libro['anio'] . '">
                            <input type="hidden" name="autor_id" value="' . $libro['autor_id'] . '">
                            <input type="hidden" name="autor_id" value="' . $libro['titulo'] . '">
                            <input type="hidden" name="url_libro" value="' . $libro['url_libro'] . '">
                            <input type="hidden" name="especialidad" value="' . $libro['especialidad'] . '">
                            <input type="hidden" name="editorial" value="' . $libro['editorial'] . '">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                    </form>
                    <form action="/Semana7/libros/eliminar.php" class="inline-block" method="post">
                        <input type="hidden" name="libro_id" value="' . $libro['libro_id'] . '">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" >Eliminar</button>
                    </form>
                </td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</body>

</html>