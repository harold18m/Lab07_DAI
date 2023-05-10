<?php
include('../conexion/conexion.php');
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

<body class="bg-gray-100 font-sans">
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
        </div>
    </nav>

    <h1 class="text-3xl font-bold text-gray-800 my-4 text-center">Agregar libro</h1>

    <form action="agregar.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="anio">Año:</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="anio" name="anio" type="text" placeholder="Año" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="autor">Autor:</label>
            <select
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="autor" name="autor_id" required>
                <?php
                $conexion = conectar();
                $resultados = $conexion->query('SELECT autor_id, CONCAT(nombres, " ", ape_paterno) as nombre_completo FROM autores');
                while ($fila = $resultados->fetch_assoc()) {
                    echo '<option value="' . $fila['autor_id'] . '">' . $fila['nombre_completo'] . '</option>';
                }
                desconectar($conexion);
                ?>
            </select>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="titulo">Título:</label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" name="titulo" id="titulo" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="url_libro">URL:</label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="url" name="url_libro" id="url_libro" placeholder="https://example.com" pattern="https://.*"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="especialidad">Especialidad:</label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" name="especialidad" id="especialidad" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="editorial">Editorial:</label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text" name="editorial" id="editorial" required>
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                type="submit">Agregar</button>

</body>

</html>