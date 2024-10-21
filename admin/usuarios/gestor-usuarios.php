<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<?php
include "../../conexion/conexion.php";
include "../../conexion/config.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
<button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
  <i class="bi bi-list"></i>
  <a class="navbar-brand" href="../../inicio-admin.php">
      <img src="../../logo_size.jpg" alt="Logo" width="100px" height="50px" ></a>
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
    <a class="navbar-brand p-3 py-md-1" href="../gestor-eventos.php">Gestionar Eventos</a>
    <br><br>
  </p>
  <p>
    <a class="navbar-brand p-3 py-md-1" href="gestor-usuarios.php">Gestionar Usuarios</a>
    <br><br>
  </p>
    <p>
    <a class="navbar-brand p-3 py-md-1" href="../reservas/gestor-reservas.php">Gestionar Reservas</a>
    <br><br>
    </p>
    <p>
    <a class="navbar-brand p-3 py-md-1" href="../informes/informe.php">Generar Informes</a>
    <br><br>
    </p>
    <p>
    <a class="navbar-brand text-danger p-3 py-md-1" type="button" href="../../sesion/logout.php">Cerrar sesión</a>
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
  <h2 class="text-center fs-1 fw-bold">Lista de Usuarios</h2>
  <div class="container-fluid">
    <table class="table">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellido</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Fecha de Nacimiento</th>
                    <th class="text-center">Rol</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT id, nombre, apellido, username, email, fechanac, id_rol FROM usuarios");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $usuarios = $stmt->fetchAll();
                ?>
              <?php foreach($usuarios as $usuario):?>
                  <tr>
                      <td><?=$usuario["nombre"]?></td>
                      <td><?=$usuario["apellido"]?></td>
                      <td class="text-center"><?=$usuario["username"]?></td>
                      <td class="text-center"><?=$usuario["email"]?></td>
                      <td class="text-center"><?=$usuario["fechanac"]?></td>
                      <td class="text-center">
                          <?php
                          if ($usuario["id_rol"] == 1) {
                              echo "Administrador";
                          } elseif ($usuario["id_rol"] == 2) {
                              echo "Usuario";
                          } else {
                              echo "Rol Desconocido";
                          }
                          ?>
                      </td>
                      <td>
                          <div class="text-center">
                              <a class="btn btn-dark" href="editar-usuarios.php?id=<?=$usuario['id']?>"><i class="bi bi-pencil"></i></a>
                              <a class="btn btn-dark" href="eliminar-usuarios.php?id=<?=$usuario['id']?>" onclick="return eliminar();"><i class="bi bi-trash"></i></a>
                          </div>
                      </td>
                  </tr>
              <?php endforeach;?>

            </tbody>
        </table>
        </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>