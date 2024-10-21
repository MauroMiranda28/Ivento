<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include "../conexion/config.php";
include "../conexion/conexion.php";
session_start();
$id = htmlspecialchars($_GET['id']);
try{
    $stmt = $conn->prepare(
        "SELECT * FROM usuarios WHERE id = $id
        "
    );
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $usuario = $stmt->fetch();
    $apellido = $usuario["apellido"];
    $nombre = $usuario["nombre"];
    $username = $usuario["username"];
    $email = $usuario["email"];
    $fechanac = $usuario["fechanac"];
    $password = $usuario["password"];
    $id_rol = $usuario["id_rol"];
}catch(PDOException $e){
    //echo $e->getMessage();
    echo "El registro no pudo ser editado";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <style>
    body {
        background-image: url('../sesion/pexels-david-bartus-963278.jpg'); /* Cambia 'ruta/a/tu/imagen.jpg' a la URL de tu imagen */
        background-size: cover; /* Esto hace que la imagen de fondo cubra todo el área del cuerpo */
    }
    </style>
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
            <li><a class="dropdown-item" href="mis-reservas.php">Mis Reservas</a></li>
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
<div class="container">
<div class="row justify-content-center mt-5">
        <div class="col-md-6">
  <div class="card shadow-lg">
    <fieldset disabled>
      <div class="card-body">
        <h2 class="mt-5 mb-4 text-center fw-bold">Mi Perfil</h2>
        <form action="signup.php" method="POST">
          <div class="form-group">
            <label for="nombre" class="col-sm-8 col-form-label">Nombre</label>
            <input name="nombre" type="text" class="form-control" placeholder="Nombre" required value="<?=$nombre?>">
          </div>
          <div class="form-group">
            <label for="apellido" class="col-sm-8 col-form-label">Apellido</label>
            <input name="apellido" type="text" class="form-control" placeholder="Apellido" required value="<?=$apellido?>">
          </div>
          <div class="form-group">
            <label for="username" class="col-sm-8 col-form-label">Usuario</label>
            <input name="username" type="text" class="form-control" placeholder="Nombre de Usuario" required value="<?=$username?>">
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-8 col-form-label">Correo Electronico</label>
            <input name="email" type="email" class="form-control" placeholder="Email" required value="<?=$email?>">
          </div>
          <div class="input-group mb-3">
            <label for="password" class="col-sm-12 col-form-label">Contraseña</label>
            <input name="password" class="form-control" type="password" id="password" placeholder="Contraseña" required value="<?=$password?>">
            <span class="input-group-text">
              <i class="fa fa-eye" id="togglePassword" style="cursor: pointer"></i>
            </span>
          </div>
          <div class="row mb">  
            <div class="col-md-6">
              <label for="fechanac" class="col-sm-8 col-form-label">Fecha de nacimiento</label>
              <input name="fechanac" class="form-control" type="date" required value="<?=$fechanac?>">
            </div>
          </div>
      </fieldset>
      <div class="d-grid gap-2 col-6 mx-auto">
        <a type="button" href="mi-perfil-editar.php?id=<?=$_SESSION['id']?>" class="btn btn-dark">Editar</a>
      </div>
      <br>
    </form>
  </div>
        </div>
</div>
</div>

<script>
  const passwordField = document.getElementById('password');
  const togglePasswordButton = document.getElementById('togglePassword');

  togglePasswordButton.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>