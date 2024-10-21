<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <html lang="es">
    <head>
      <meta charset="utf-8">
      <title>Incio de Sesion</title>
      <style>
    body {
        background-image: url('pexels-david-bartus-963278.jpg'); /* Cambia 'ruta/a/tu/imagen.jpg' a la URL de tu imagen */
        background-size: cover; /* Esto hace que la imagen de fondo cubra todo el área del cuerpo */
    }
</style>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
    <div class="container mt-4">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
        <h2 class="mb-4 text-center">Iniciar Sesion</h1>
        <?php
          
  include '../conexion/config.php';
  include '../conexion/conexion.php';
  
  session_start();
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (isset($_POST['recordarme'])) {
      $expiry = time() + 60 * 60 * 24 * 30; 
      setcookie('username', $username, $expiry, '/');
      setcookie('password', $password, $expiry, '/');
  }
    // Consulta para verificar si el usuario existe en la base de datos
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
   
    // Verificar si se encontraron resultados
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['apellido'] = $usuario['apellido'];

        // Verificación de rol
        if ($usuario['id_rol'] == '1') {
            $_SESSION['id_rol'] = '1';
            header("location: ../inicio-admin.php");
        } else {
            $_SESSION['id_rol'] = '2';
            header("location: ./../inicio.php");
        }
    } else {
        echo "<div class='alert alert-danger'>Nombre de usuario o contraseña incorrectos</div>";
    }
  }
?>
                   <form action="<?= $_SERVER["PHP_SELF"]; ?>" method="POST">
                        <div class="mb-3">
                            <input name="username" id="username" class="form-control" type="text" placeholder="Usuario" required>
                        </div>
                        <div class="mb-3 input-group">
                            <input name="password" id="password" class="form-control" type="password" placeholder="Contraseña" required>
                            <span class="input-group-text">
                                <i class="fa fa-eye" id="togglePassword" style="cursor: pointer"></i>
                            </span>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="recordarme" name="recordarme">
                            <label class="form-check-label text-start" for="recordarme">Recordarme</label>

                        </div>
                      <div class="d-grid gap-2 col-6 mx-auto">
                          <button type="submit" class="btn btn-dark" name="login">Iniciar Sesión</button>
                      </div>
                    </form>
                    <p class="mt-3 text-center">¿No tienes cuenta? <a href="signup.php">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
  </html>
  <script>
    var username = getCookie('username');
    var password = getCookie('password');
  const passwordField = document.getElementById('password');
  const togglePasswordButton = document.getElementById('togglePassword');

  togglePasswordButton.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
    
  });
window.onload = function() {
    var username = getCookie('username');
    var password = getCookie('password');
    if (username !== "" && password !== "") {
        document.getElementById('username').value = username;
        document.getElementById('password').value = password;
    }
};

// Función para obtener el valor de una cookie por su nombre
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}
</script>