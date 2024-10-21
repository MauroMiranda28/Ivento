<?php
include "../conexion/conexion.php";
include "../conexion/config.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        $stmt = $conn->prepare("DELETE FROM eventos WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: gestor-eventos.php");
    } catch (PDOException $e) {
        // echo $e->getMessage();
        echo "El evento no pudo ser eliminado";
        exit;
    }
} else {
    echo "No se proporcionó un ID válido para eliminar el evento.";
}

?>