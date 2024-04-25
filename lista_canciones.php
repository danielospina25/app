<?php
include 'conexion.php';

$sql = "SELECT * FROM canciones";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Canciones</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Lista de Canciones</h2>
        <ul>
            <?php
            include 'conexion.php';

            $sql = "SELECT * FROM canciones";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>" . $row["nombre_cancion"];
                    if (!empty($row["nombre_artista"])) {
                        echo " - " . $row["nombre_artista"];
                    }
                    echo " <a href='eliminar.php?id=" . $row["id"] . "' target='_blank'>Eliminar</a></li>";
                }
            } else {
                echo "<li>No hay canciones registradas.</li>";
            }
            ?>
        </ul>
        <a href="index.php"><button>Volver a la página principal</button></a>
    </div>
</body>
</html>


<?php
$conn->close();
?>
