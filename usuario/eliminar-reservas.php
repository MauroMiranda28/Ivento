<?php
include "../conexion/conexion.php";
include "../conexion/config.php";
$id = htmlspecialchars($_GET["id"]);
try{
    $stmt = $conn->prepare(
        "DELETE FROM reserva WHERE id = $id
        "
    );
    $stmt->execute();
    header("Location: mis-reservas.php");
}catch(PDOException $e){
    //echo $e->getMessage();
    echo "El registro no pudo ser eliminado";
    exit;
}
?>
