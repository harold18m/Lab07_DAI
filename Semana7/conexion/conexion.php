<?php

function conectar() {
    $conn = mysqli_connect('localhost','root','usbw','lab07');
    return $conn;
}

function desconectar($conn) {
    mysqli_close($conn);
}

?>