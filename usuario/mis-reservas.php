<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<?php
include "../conexion/conexion.php";
include "../conexion/config.php";

session_start();

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    
  
    $stmt = $conn ->prepare("SELECT r.*, e.nombre AS nombre_evento, e.fecha AS fecha_evento
    FROM reserva r
    INNER JOIN eventos e ON r.eventid = e.id
    WHERE r.userid = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: ../sesion/login.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" href="../inicio.php">
      <img src="../logo_size.jpg" alt="Logo" width="100px" height="50px" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php
              if(isset($_SESSION['nombre'])and($_SESSION['apellido'])){   
                echo $_SESSION['nombre']. " ". $_SESSION["apellido"];                   
                      }
            ?>

          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="mi-perfil.php?id=<?=$_SESSION['id']?>">Mi Perfil</a></li>
            <li><a class="dropdown-item" href="mis-reservas">Mis Reservas</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="../sesion/logout.php">Cerrar Sesion</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../eventos/calendario.php">Calendario</a>

        </li>
		<li class="nav-item">
          <a class="nav-link" href="../eventos/eventos.php">Catálogo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../nosotros.php">Nosotros</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
    <script>
        function eliminar(){
            var respuesta=confirm("Estas seguro de que quieres eliminar este evento?");
            return respuesta
        }
    </script>
    <h2 class="text-center fs-1 fw-bold">Mis Reservas</h2>
    <div class="container-fluid">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th class="text-center">Evento</th>
                <th class="text-center">Cantidad de Plazas</th>
                <th class="text-center">Fecha de evento</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva) { ?>
                <tr>
                    <td class="text-center"><?php echo $reserva['nombre_evento']; ?></td>
                    <td class="text-center"><?php echo $reserva['cantplaza']; ?></td>
                    <td class="text-center"><?php echo $reserva['fecha_evento']; ?></td>
                    <td>
                          <div class="text-center">
                            <a class="btn btn-dark" href="eliminar-reservas.php?id=<?=$reserva['id']?>" onclick="return eliminar();"><i class="bi bi-trash"></i></a>
                          </div>
                        </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>