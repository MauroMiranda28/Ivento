<?php
include "../conexion/conexion.php";
include "../conexion/config.php";
session_start();
$nombre = "";
$fecha = "";
$hora = "";
$ubicacion = "";
$capacidad = "";
$id = htmlspecialchars($_GET['id']);
try {
    $stmt = $conn->prepare("SELECT * FROM eventos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $evento = $stmt->fetch();
    $nombre = $evento['nombre'];
    $fecha = $evento['fecha'];
    $hora = $evento['hora'];
    $ubicacion = $evento['ubicacion'];
    $capacidad = $evento['capacidad'];
} catch (PDOException $e) {
    echo 'Error al obtener los datos del evento: ' . $e->getMessage();
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
try {
    $stmt = $conn->prepare("UPDATE eventos SET 
    nombre = :nombre,
    fecha = :fecha,
    hora = :hora,
    ubicacion = :ubicacion,
    capacidad = :capacidad 
    WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':ubicacion', $ubicacion);
        $stmt->bindParam(':capacidad', $capacidad);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    echo 'Registro actualizado correctamente.';
    header('Location: gestor-eventos.php');
} catch (PDOException $e) {
    echo 'Error al actualizar el registro: ' . $e->getMessage();
}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor de Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<div class="container">
        
        <h2 class="mt-5 mb-4">Agregar Evento</h2>
        <form class="row g-3" method="post" enctype="multipart/form-data">
            <div class="col-12">
                <label for="nombre">Nombre del Evento</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre del evento" required value="<?= $nombre ?>">
            </div>
                <br><br>
            <div class="col-md-7">  
                <label for="fecha" class="form-label">Fecha:</label>
                <input name="fecha" class="form-control" type="date" required value="<?= $fecha ?>">
            </div>
            <div class="col-md-5">
                <label for="hora" class="form-label">Hora:</label>
                    <input type="time" class="form-control" id="hora" name="hora" required value="<?= $hora ?>">
            </div>

                <br><br>
            <div class="col-12">
                <label for="ubicacion">Ubicacion</label>
                <input type="text" name="ubicacion" class="form-control" placeholder="Ubicacion" id="inputUbicacion"  required value="<?= $ubicacion ?>">
            </div>
            <div class="col-12">
                <label for="capacidad">Capacidad</label>
                <input type="text" name="capacidad" class="form-control" placeholder="Capacidad" required value="<?= $capacidad ?>">
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-dark" name="agregar" type="submit">Guardar Evento</button>
            </div>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>