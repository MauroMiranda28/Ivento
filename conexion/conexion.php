<?php
include 'config.php';
try{
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    
}catch(PDOException $e){
    echo "No se pudo conectar con la base de datos";
}