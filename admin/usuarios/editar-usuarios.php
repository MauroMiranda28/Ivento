<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
include "../../conexion/conexion.php";
include "../../conexion/config.php";
$id = htmlspecialchars($_GET['id']);
try{
    $stmt = $conn->prepare(
        "SELECT * FROM usuarios WHERE id = :id"
    );
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
if($_SERVER["REQUEST_METHOD"] == "POST"){
    extract($_POST);
    try {
        $stmt = $conn->prepare(
            "UPDATE usuarios SET 
            apellido = :apellido,
            nombre = :nombre,
            username = :username,
            email = :email,
            fechanac = :fechanac,
            password = :password,
            id_rol = :id_rol
            WHERE id = :id"
        );
        $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':fechanac', $fechanac, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: gestor-usuarios.php");
    } catch(PDOException $e) {
        echo "No pudieron actualizarse los datos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edicion de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
    <h2 class="mt-5 mb-4 text-center">Edicion de Usuario</h1>
    <form action="" method="POST">
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
      <div class="col-md-4">
      <label for="rol" class="col-sm-4 col-form-label">Rol</label>
        <select name="id_rol" class="form-select" aria-label="Default select example">
            <option selected>Elige un Rol</option>
            <option value="1">Administrador</option>
            <option value="2">Usuario</option>
        </select>
      </div>
      </div>
      <br>
      <div class="d-grid gap-2 col-6 mx-auto">
      <button type="submit" class="btn btn-dark" name="edit">Guardar</button>
      </div>
    </form>
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