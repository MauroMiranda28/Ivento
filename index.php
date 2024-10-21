<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login o Registro</title>
    <style>
    body {
        background-image: url('3.jpg'); /* Cambia 'ruta/a/tu/imagen.jpg' a la URL de tu imagen */
        background-size: cover; /* Esto hace que la imagen de fondo cubra todo el área del cuerpo */
    }
</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <img src="logo.jpg" class="img-fluid mb-4" alt="Logo">
                    <h5 class="mb-3">Bienvenido a nuestra página</h5>
                    <p class="mb-4">Para acceder, por favor realiza una de las siguientes acciones:</p>
                    <div class="d-grid gap-2 col-8 mx-auto">
                        <a class="btn btn-outline-dark btn-lg" href="sesion/login.php">Iniciar Sesión</a>
                        <a class="btn btn-dark btn-lg" href="sesion/signup.php">Registrarte</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>