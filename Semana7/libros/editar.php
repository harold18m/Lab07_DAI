<?php
include('../conexion/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $libro_id = $_POST['libro_id'];
    $anio = $_POST['anio'];
    $autor_id = $_POST['autor_id'];
    $titulo = $_POST['titulo'];
    $url_libro = $_POST['url_libro'];
    $especialidad = $_POST['especialidad'];
    $editorial = $_POST['editorial'];

    // Validar los datos recibidos
    // ...

    // Abrimos la conexión a la base de datos
    $conexion = conectar();

    // Realizamos la actualización en la base de datos
    $query = $conexion->prepare('UPDATE libros SET anio=?, autor_id=?, titulo=?, url_libro=? ,especialidad=?, editorial=? WHERE libro_id=?');
    $query->bind_param('sissssi', $anio, $autor_id, $titulo ,$url_libro, $especialidad, $editorial, $libro_id);
    $msg = '';
    if ($query->execute()) {
        $msg = 'Libro actualizado con éxito';
    } else {
        $msg = 'No se pudo actualizar al libro';
    }

    // Cerramos la conexión a la base de datos
    desconectar($conexion);

    // Redirigir al usuario a la página de libros
    header('Location: libros.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
    <title>Editar libro</title>
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
        </div>
    </nav>

    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-8">Editar libro</h1>

        <form action="editar.php" method="post" class="max-w-lg">
            <input type="hidden" name="libro_id" value="<?php echo $libro_id; ?>">

            <div class="mb-4">
                <label for="año" class="block font-bold mb-2">Año:</label>
                <input type="text" name="año" id="año" value="<?php echo $año; ?>"
                    class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="autor" class="block font-bold mb-2">Autor:</label>
                <input type="text" name="autor" id="autor" value="<?php echo $autor; ?>"
                    class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="libro" class="block font-bold mb-2">Libro:</label>
                <input type="text" name="libro" id="libro" value="<?php echo $url_libro; ?>"
                    class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="especialidad" class="block font-bold mb-2">Especialidad:</label>
                <input type="text" name="especialidad" id="especialidad" value="<?php echo $especialidad; ?>"
                    class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="editorial" class="block font-bold mb-2">Editorial:</label>
                <input type="text" name="editorial" id="editorial" value="<?php echo $editorial; ?>"
                    class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="text-right">
                <button type="submit" name="editar"
                    class="bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600">Actualizar</button>
            </div>
        </form>
        <a href="autores.php" class="text-blue-500 hover:underline">Regresar</a>
</body>

</html>