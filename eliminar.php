<?php
include 'conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM canciones WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: lista_canciones.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
