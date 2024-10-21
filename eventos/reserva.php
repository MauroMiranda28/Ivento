<?php
include "../conexion/conexion.php";
include "../conexion/config.php";

session_start();

if (isset($_SESSION['id'])) {
    // Obtener el ID del evento desde la URL
    if (isset($_POST['id'])) {
        $eventid = $_POST['id'];
        $userid = $_SESSION['id']; // Obtener el ID del usuario desde la sesión
        $cantplaza = $_POST['cantplaza']; // Cantidad de plazas a reservar 

        // Verificar la disponibilidad de plazas
        $stmt = $conn->prepare("SELECT capacidad FROM eventos WHERE id = :id");
        $stmt->bindParam(':id', $eventid);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $capacidad = $row['capacidad'];
            if ($capacidad >= $cantplaza) {
                // Iniciar una transacción
                $conn->beginTransaction();

                try {
                    // Insertar la reserva en la tabla "reserva"
                    $insertStmt = $conn->prepare("INSERT INTO reserva (userid, eventid, cantplaza) VALUES (:userid, :eventid, :cantplaza)");
                    $insertStmt->bindParam(':userid', $userid);
                    $insertStmt->bindParam(':eventid', $eventid);
                    $insertStmt->bindParam(':cantplaza', $cantplaza);
                    $insertStmt->execute();

                    // Actualizar la disponibilidad de plazas en la tabla "eventos"
                    $updateStmt = $conn->prepare("UPDATE eventos SET capacidad = capacidad - :cantplaza WHERE id = :eventid");
                    $updateStmt->bindParam(':cantplaza', $cantplaza);
                    $updateStmt->bindParam(':eventid', $eventid);
                    $updateStmt->execute();

                    // Confirmar la transacción
                    $conn->commit();

                    // Redireccionar a la página de confirmación de reserva
                    header("Location: confirmacion_reserva.php");

                } catch (PDOException $e) {
                    // En caso de error, deshacer la transacción
                    $conn->rollBack();
                    echo "Error al realizar la reserva: " . $e->getMessage();
                }
            } else {
                echo "No hay suficientes plazas disponibles para este evento.";
            }
        } else {
            echo "Evento no encontrado.";
        }
    } else {
        echo "ID del evento no proporcionado.";
    }
} else {
    echo "Debes iniciar sesión para realizar una reserva.";
}
?>
