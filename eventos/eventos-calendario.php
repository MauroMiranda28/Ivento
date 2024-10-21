<?php
header('Content-Type: application/json');
include "conexion/config.php";
include "conexion/conexion.php";
$stmt = $conn->prepare("SELECT * FROM eventos");

$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);

$eventos = $stmt->fetchAll();
session_start();
echo json_encode($eventos);

?>