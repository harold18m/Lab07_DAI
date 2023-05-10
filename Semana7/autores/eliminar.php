<?php
include('../conexion/conexion.php');

// Primero, verificamos si se recibió el ID del autor a eliminar
if (isset($_POST['autor_id'])) {
    
    $conexion = conectar();

    // Preparamos la consulta SQL para eliminar el autor
    $consulta = 'DELETE FROM autores WHERE autor_id = ?';
    $sentencia = $conexion->prepare($consulta);
    $sentencia->bind_param('i', $_POST['autor_id']);
    
    // Ejecutamos la consulta
    if ($sentencia->execute()) {
        // Si se eliminó el autor correctamente, redirigimos a la página de autores
        header('Location: /Semana7/autores/autores.php');
        exit;
    } else {
        // Si hubo un error al eliminar el autor, mostramos un mensaje
        echo 'Error al eliminar el autor';
    }
    
} else {
    // Si no se recibió el ID del autor a eliminar, mostramos un mensaje
    echo 'No se recibió el ID del autor a eliminar';
}
desconectar($conexion);
?>

