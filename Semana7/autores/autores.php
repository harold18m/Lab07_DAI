<?php

include('../conexion/conexion.php');

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consultamos a la base de datos
$query = $conexion->prepare('SELECT autor_id, nombres, ape_paterno, ape_materno FROM autores');
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
    <title>Autores</title>
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
        <h1 class="text-3xl font-bold text-gray-800 my-4">Gestión de autores</h1>
        <a href="agregar_autores.html" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md mb-4">Nuevo autor</a>
        <table class="table-auto w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 font-bold">#</th>
                    <th class="px-4 py-2 font-bold">Nombres</th>
                    <th class="px-4 py-2 font-bold">Apellido Paterno</th>
                    <th class="px-4 py-2 font-bold">Apellido Materno</th>
                    <th class="px-4 py-2 font-bold">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while ($autor = $resultado->fetch_array()) {
                    echo '<tr>';
                    echo '<td class="border px-4 py-2">' . $autor['autor_id'] . '</td>';
                    echo '<td class="border px-4 py-2">' . $autor['nombres'] . '</td>';
                    echo '<td class="border px-4 py-2">' . $autor['ape_paterno'] . '</td>';
                    echo '<td class="border px-4 py-2">' . $autor['ape_materno'] . '</td>';
                    echo '<td class="border px-4 py-2">
                    <form action="/Semana7/autores/editar.php" method="post" class="inline-block">
                    <input type="hidden" name="autor_id" value="' . $autor['autor_id'] . '">
                    <input type="hidden" name="nombres" value="' . $autor['nombres'] . '">
                    <input type="hidden" name="ape_paterno" value="' . $autor['ape_paterno'] . '">
                    <input type="hidden" name="ape_materno" value="' . $autor['ape_materno'] . '">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                    </form>
                    <form action="/Semana7/autores/eliminar.php" method="post" class="inline-block">
                        <input type="hidden" name="autor_id" value="' . $autor['autor_id'] . '">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                    </form>
                    
                </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>