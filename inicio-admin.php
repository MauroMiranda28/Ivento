<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<?php

include "conexion/conexion.php";
include "conexion/config.php";
session_start();

// Comprobar si el usuario ha iniciado sesión y es un administrador
if (isset($_SESSION['id']) && isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1) {

} else {
  // Redirigir a la página de inicio de sesión si no es administrador
  header("Location: inicio.php");
  exit; 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
</head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
<button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
  <i class="bi bi-list"></i>
  <a class="navbar-brand" href="inicio-admin.php">
      <img src="logo_size.jpg" alt="Logo" width="100px" height="50px" ></a>
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
    <a class="navbar-brand p-3 py-md-1" href="admin/gestor-eventos.php">Gestionar Eventos</a>
    <br><br>
  </p>
  <p>
    <a class="navbar-brand p-3 py-md-1" href="admin/usuarios/gestor-usuarios.php">Gestionar Usuarios</a>
    <br><br>
  </p>
    <p>
    <a class="navbar-brand p-3 py-md-1" href="admin/reservas/gestor-reservas.php">Gestionar Reservas</a>
    <br><br>
    </p>
    <p>
    <a class="navbar-brand p-3 py-md-1" href="admin/informes/informe.php">Generar Informes</a>
    <br><br>
    </p>
    <p>
    <a class="navbar-brand text-danger p-3 py-md-1" type="button" href="sesion/logout.php">Cerrar sesión</a>
</p>
</div>
</div>

<div class="content" style="margin-left: 200px; padding: 20px;">
    <h1>Bienvenido al Panel de Administrador, <?php echo $_SESSION['nombre']; ?>!</h1>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
