<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<?php
include "../conexion/conexion.php";
include "../conexion/config.php";
if(isset($_POST['agregar_evento'])) {
  // Redirige a otra página
  header('Location: agregar-evento.php');
  exit();
}
if(isset($_POST['eliminar_evento'])) {
  // Redirige a otra página
  header('Location: eliminar-evento.php');
  exit();
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
<button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
  <i class="bi bi-list"></i>
  <a class="navbar-brand" href="../inicio-admin.php">
      <img src="../logo_size.jpg" alt="Logo" width="100px" height="50px" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
</button>
</div>
</nav>
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h2 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"><strong>Menú de Administrador</h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <p class="d-inline-flex gap-1">
    <a class="navbar-brand p-3 py-md-1" href="gestor-eventos.php">Gestionar Eventos</a>
    <br><br>
  </p>
  <p>
    <a class="navbar-brand p-3 py-md-1" href="usuarios/gestor-usuarios.php">Gestionar Usuarios</a>
    <br><br>
  </p>
    <p>
    <a class="navbar-brand p-3 py-md-1" href="reservas/gestor-reservas.php">Gestionar Reservas</a>
    <br><br>
    </p>
    <p>
    <a class="navbar-brand p-3 py-md-1" href="informes/informe.php">Generar Informes</a>
    <br><br>
    </p>
    <p>
    <a class="navbar-brand text-danger p-3 py-md-1" type="button" href="../sesion/logout.php">Cerrar sesión</a>
</p>
</div>
</div>
    <script>
        function eliminar(){
            var respuesta=confirm("Estas seguro de que quieres elimnar este evento?");
            return respuesta
        }
    </script>
    <br><br>

    <form form method="post" action="">
    <button type="submit" class="btn btn-dark" name="agregar_evento">Agregar Evento</button>
    </form>

 
    <h2>Lista de Eventos</h2>
<?php
    // Consulta para mostrar eventos desde la base de datos
    $sql = "SELECT * FROM eventos";
    $result = $conn->query($sql);

 if ($result->rowCount() > 0): ?>
      <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
          <h3 class='text-center'><?= $row['nombre'] ?></h3>
          <p class='text-center'><strong>Fecha:</strong> <?= $row['fecha'] ?></p>
          <p class='text-center'><strong>Hora:</strong> <?= $row['hora'] ?></p>
          <p class='text-center'><strong>Ubicacion:</strong> <?= $row['ubicacion'] ?></p>
          <p class='text-center'><strong>Capacidad:</strong> <?= $row['capacidad'] ?></p>
          <div class="d-grid gap-2 col-6 mx-auto">
              <a href="editar-evento.php?id=<?= $row['id'] ?>" class="btn btn-outline-dark">Editar Evento</a>
              <a onclick="return eliminar()" href="eliminar-evento.php?id=<?= $row['id'] ?>" class="btn btn-dark">Eliminar Evento</a>
          </div>
          <hr>
      <?php endwhile; ?>
      <?php else: ?>
    <p class="text-center">No hay eventos disponibles.</p>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
