<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$artista = $_POST['artista'];

$sql = "INSERT INTO canciones (nombre_cancion, nombre_artista) VALUES ('$nombre', '$artista')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
