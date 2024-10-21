<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
include '../conexion/config.php';
include '../conexion/conexion.php';

$message = '';

$fechanac = "";
$nombre = "";
$apellido = "";
$password = "";
$username = "";
$email = "";
$id_rol = "2";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $fechanac = $_POST['fechanac'];
    $password = $_POST['password'];

    // Utiliza consultas preparadas para evitar la inyección SQL
    try {
        $stmt = $conn->prepare("INSERT INTO usuarios (apellido, nombre, username, email, password, fechanac, id_rol) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $apellido);
        $stmt->bindParam(2, $nombre);
        $stmt->bindParam(3, $username);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $password); 
        $stmt->bindParam(6, $fechanac);
        $stmt->bindParam(7, $id_rol);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['apellido'] = $usuario['apellido'];
        header("Location: login.php");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Registrarte</title>
    <style>
    body {
        background-image: url('pexels-david-bartus-963278.jpg'); /* Cambia 'ruta/a/tu/imagen.jpg' a la URL de tu imagen */
        background-size: cover; /* Esto hace que la imagen de fondo cubra todo el área del cuerpo */
    }
</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
    <div class="card shadow-lg">
      <div class="card-body">
    <h2 class="mt-5 mb-4 text-center">Registrarte</h1>
    <form action="signup.php" method="POST">
      <div class="form-group">
      <input name="nombre" type="text" class="form-control" placeholder="Nombre"required value="<?=$nombre?>" >
      <br>
      </div>
      <div class="form-group">
      <input name="apellido" type="text" class="form-control" placeholder="Apellido"required value="<?=$apellido?>">
      <br>
      </div>
      <div class="form-group">
      <input name="username" type="text" class="form-control" placeholder="Nombre de Usuario"required value="<?=$username?>">
      <br>
      </div>
      <div class="form-group">
      <input name="email" type="email" class="form-control" placeholder="Email" required value="<?=$email?>">
      <br>
      </div>
      <div class="input-group mb-3">
        <input name="password" type="password" id="password" class="form-control" placeholder="Contraseña"required value="<?=$password?>">
        <span class="input-group-text"><i class="fa fa-eye" id="togglePassword" style="cursor: pointer"></i></span>
      </div>
      <br>
      <div class="row mb">  
      <div class="col-md-8">
         <label for="fechanac" class="col-sm-8 col-form-label">Fecha de nacimiento</label>
        <input name="fechanac" class="form-control" type="date" required value="<?=$fechanac?>">
      </div>
      </div>
      <br>
      <div class="d-grid gap-2 col-6 mx-auto">
      <button type="submit" class="btn btn-dark" name="signup">Guardar</button>
      </div>
    </form>
    <p class="mt-3 text-center">Si ya tienes una cuenta<a href="login.php"> Inicia Sesion aquí</a></p>
    </div>
  </div>
</div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
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