<?php
include('../conexion/conexion.php');

// Primero, verificamos si se recibió el ID del Libro a eliminar
if (isset($_POST['libro_id'])) {
    
    $conexion = conectar();

    // Preparamos la consulta SQL para eliminar el Libro
    $consulta = 'DELETE FROM libros WHERE libro_id = ?';
    $sentencia = $conexion->prepare($consulta);
    $sentencia->bind_param('i', $_POST['libro_id']);
    
    // Ejecutamos la consulta
    if ($sentencia->execute()) {
        // Si se eliminó el Libro correctamente, redirigimos a la página de Libros
        header('Location: /Semana7/libros/libros.php');
        exit;
    } else {
        // Si hubo un error al eliminar el Libro, mostramos un mensaje
        echo 'Error al eliminar el libro';
    }
    
} else {
    // Si no se recibió el ID del Libro a eliminar, mostramos un mensaje
    echo 'No se recibió el ID del Libro a eliminar';
}
desconectar($conexion);
?>