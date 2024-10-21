<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<?php
include "../conexion/conexion.php";
include "../conexion/config.php";


session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $ubicacion = $_POST['ubicacion'];
    $capacidad = $_POST['capacidad'];

    // Consulta para insertar el evento en la base de datos usando preparación de consultas
    $sql = "INSERT INTO eventos (nombre, fecha, hora, ubicacion, capacidad) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
    $stmt->bindParam(2, $fecha, PDO::PARAM_STR);
    $stmt->bindParam(3, $hora, PDO::PARAM_STR);
    $stmt->bindParam(4, $ubicacion, PDO::PARAM_STR);
    $stmt->bindParam(5, $capacidad, PDO::PARAM_INT);
    
    $stmt->execute();
    $lastId = $conn->lastInsertId();

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $directorioImagenes = "../imagenes" . DIRECTORY_SEPARATOR; 
        $nombreArchivo = basename($_FILES["imagen"]["name"]);
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        $nuevoNombreImagen = $lastId . '.' . $extension;
        $rutaCompletaImagen = $directorioImagenes . $nuevoNombreImagen;
        
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaCompletaImagen);
    
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaCompletaImagen)) {
            echo "El archivo " . $nombreArchivo . " ha sido subido.";
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php
            if(isset($_POST['agregar'])) {
                // Redirige a otra página
                header('Location: gestor-eventos.php');
                exit();
            }
    ?>
    <div class="container">
       
        <h2 class="mt-5 mb-4">Agregar Evento</h2>
        <form class="row g-3" method="post" enctype="multipart/form-data">
            <div class="col-12">
                <label for="nombre">Nombre del Evento</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
                <br><br>
            <div class="col-md-5">  
                <label for="fecha" class="form-label">Fecha:</label>
                <input name="fecha" class="form-control" type="date" required>
            </div>
            <div class="col-md-3">
                <label for="time" class="form-label">Hora:</label>
                <input type="time" class="form-control"name="hora" required>
            </div>
                <br><br>
            <div class="col-12">
                <label for="ubicacion">Ubicacion</label>
                <input type="text" name="ubicacion" class="form-control" id="inputUbicacion"  required>
            </div>
            <div class="col-12">
                <label for="capacidad">Capacidad</label>
                <input type="text" name="capacidad" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del Evento</label>
                <input class="form-control" name="imagen" type="file" accept= "image/*">
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" name="agregar" type="submit">Agregar Evento</button>
            </div>
        </form>
    </div>
</body>