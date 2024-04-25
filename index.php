<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Canciones</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        include 'conexion.php';

        // Procesar el formulario de registro si se ha enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['nombre']) && isset($_POST['artista'])) {
                $nombre = $_POST['nombre'];
                $artista = $_POST['artista'];

                $sql = "INSERT INTO canciones (nombre_cancion, nombre_artista) VALUES ('$nombre', '$artista')";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>La canción se ha registrado correctamente.</p>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }

        // Procesar la solicitud de eliminación si se ha enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_id'])) {
            $eliminar_id = $_POST['eliminar_id'];
            $sql_eliminar = "DELETE FROM canciones WHERE id=$eliminar_id";

            if ($conn->query($sql_eliminar) === TRUE) {
                echo "<p>La canción se ha eliminado correctamente.</p>";
                // Redireccionar a la misma página después de eliminar
                echo "<script>window.location.href='index.php';</script>";
            } else {
                echo "Error al eliminar la canción: " . $conn->error;
            }
        }
        ?>

        <!-- Formulario de registro -->
        <h2>Registrar Canción</h2>
        <form id="registroForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="nombre">Nombre de la Canción:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="artista">Nombre del Artista:</label>
            <input type="text" id="artista" name="artista">
            <button type="submit">Registrar</button>
        </form>

        <!-- Lista de canciones -->
        <h2>Lista de Canciones</h2>
        <ul id="listaCanciones">
            <?php
            // Consultar y mostrar la lista de canciones
            $sql = "SELECT * FROM canciones";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>" . $row["nombre_cancion"];
                    if (!empty($row["nombre_artista"])) {
                        echo " - " . $row["nombre_artista"];
                    }
                    echo " <form method='POST' style='display:inline;'>
                              <input type='hidden' name='eliminar_id' value='" . $row["id"] . "'>
                              <button type='submit'>Eliminar</button>
                          </form></li>";
                }
            } else {
                echo "<li>No hay canciones registradas.</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
