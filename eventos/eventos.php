<?php
include "../conexion/config.php";
include "../conexion/conexion.php";
session_start();
if(isset($_GET['search_query']) AND isset($_GET['search_date']) AND isset($_GET['search_location'])){
  $searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';
  $searchDate = isset($_GET['search_date']) ? $_GET['search_date'] : '';
  $searchLocation = isset($_GET['search_location']) ? $_GET['search_location'] : '';

  $stmt = $conn->prepare("SELECT * FROM eventos WHERE nombre LIKE :searchQuery AND fecha >= :searchDate AND ubicacion LIKE :searchLocation");
  $stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
  $stmt->bindValue(':searchDate', $searchDate, PDO::PARAM_STR);
  $stmt->bindValue(':searchLocation', "%$searchLocation%", PDO::PARAM_STR);
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $eventos = $stmt->fetchAll();
}else{

  $stmt = $conn->prepare("SELECT * FROM eventos");

  $stmt->execute();
  
  $stmt->setFetchMode(PDO::FETCH_ASSOC);   
  
  $eventos = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
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
            <li><a class="dropdown-item" href="../usuario/mi-perfil.php?id=<?=$_SESSION['id']?>">Mi Perfil</a></li>
            <li><a class="dropdown-item" href="../usuario/mis-reservas.php">Mis Reservas</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="../sesion/logout.php">Cerrar Sesion</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="calendario.php">Calendario</a>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="../nosotros.php">Nosotros</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<h2 class="text-center">Lista de Eventos</h2>
<br>
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <table class="table">
        <thead>
          <tr class="filters">
            <th>
              <form class="d-flex" role="search" method="get" action="">
                <label for="search_query" class="col-sm-1 col-form-label">Nombre:</label>
                <input class="form-control me-2" type="search" aria-label="Search" name="search_query">
                <label for="search_date" class="col-sm-1 col-form-label">Desde:</label>
                <input class="form-control me-2" type="date" name="search_date">
                <label for="search_location" class="col-sm-1 col-form-label">Ubicacion:</label>
                <input class="form-control me-2" type="text" name="search_location">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
                
             </form>
            </th>
         </tr>
       </thead>
      </table>
        <?php foreach($eventos as $evento) { ?>
            <?php
            $id = $evento['id'];
            $nombreImagen = "$id.jpg";
            $rutaImagen = "../imagenes/$nombreImagen";

            if(!file_exists($rutaImagen)) {
                $rutaImagen = "../imagenes/nophoto.jpg";
            }
            ?>
            <div class="col mb-4">
                <div class="card">
                    <img class="card-img-top" src="<?php echo $rutaImagen; ?>">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo $evento['nombre']; ?></h5>
                        <p class="card-text">Fecha: <?php echo $evento['fecha']; ?></p>
                        <p class="card-text">Hora: <?php echo $evento['hora']; ?></p>
                        <p class="card-text">Ubicacion: <?php echo $evento['ubicacion']; ?></p>
                        <p class="card-text">Capacidad: <?php echo $evento['capacidad']; ?></p>
                        <form action="reserva.php" method="post" class="reserva-form" data-event-title="<?php echo $evento['nombre']; ?>">
                        <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <label class="col-sm-4 col-form-label" for="cantplaza">Cantidad de Plazas:</label>
                                <select class="form-select" name="cantplaza" id="cantplaza">
                                    <?php
                                    // Generar opciones para la cantidad de plazas disponibles
                                    for ($i = 1; $i <= $evento['capacidad']; $i++) {
                                        echo "<option value='$i'>$i plaza" . ($i > 1 ? 's' : '') . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-dark">Reservar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php }; ?>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const reservaForms = document.querySelectorAll(".reserva-form");

    reservaForms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); 

            const eventTitle = form.getAttribute("data-event-title");
            const cantPlaza = form.querySelector("select[name='cantplaza']").value;

            // Preguntar
            if (window.confirm(`¿Estás seguro de querer reservar ${cantPlaza} plaza(s) para el evento: ${eventTitle}?`)) {
                // Si se confirma, enviar el formulario
                form.submit();
            }
        });
    });
});
</script>
</body>
</html>
