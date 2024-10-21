<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<?php
include "../../conexion/conexion.php";
include "../../conexion/config.php";
$mes ="";
$ano ="";
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el mes y el año seleccionados por el usuario
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];

    // Consulta SQL para recuperar eventos en el mes y año seleccionados
    $sql = "SELECT nombre, fecha, hora, ubicacion
            FROM eventos
            WHERE YEAR(fecha) = :ano
            AND MONTH(fecha) = :mes";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ano', $ano);
    $stmt->bindParam(':mes', $mes);
    $stmt->execute();

    $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generar un informe HTML


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Generar Informe de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
        body {
            background-color: #f8f9fa;
        }

        .informe-container {
            margin-top: 50px;
        }

        .informe-header {
            background-color: black;
            color: white;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        .informe-table {
            margin-top: 20px;
        }
    </style>
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
    <a class="navbar-brand p-3 py-md-1" href="../usuarios/gestor-usuarios.php">Gestionar Usuarios</a>
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
<div class="container mt-5">
<div class="informe-container">
        <div class="informe-header text-center">
        <h1>Eventos en <?php echo "{$mes}/{$ano}"; ?></h1>

        </div>
        <div class="informe-table">
            <?php
    if (count($eventos) > 0) {
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Evento</th>';
        echo '<th>Fecha</th>';
        echo '<th>Hora</th>';
        echo '<th>Ubicación</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($eventos as $evento) {
            echo '<tr>';
            echo '<td>' . $evento['nombre'] . '</td>';
            echo '<td>' . $evento['fecha'] . '</td>';
            echo '<td>' . $evento['hora'] . '</td>';
            echo '<td>' . $evento['ubicacion'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<p class='text-center'>No hay eventos programados para este mes.</p>";
    }
    }
            ?>
        </div>
    </div>

    <h2 class="mb-4">Seleccione el mes y el año para generar el informe de eventos</h2>
    <form method="post" class="mb-4">
        <div class="row mb-3">
            <div class="col">
                <label for="mes" class="form-label">Mes:</label>
                <select name="mes" class="form-select" required>
                    <?php
                    // Genera opciones para seleccionar el mes
                    for ($i = 1; $i <= 12; $i++) {
                        $mesTexto = date("F", mktime(0, 0, 0, $i, 1));
                        echo "<option value='$i'>$mesTexto</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <label for="ano" class="form-label">Año:</label>
                <?php
                // Obtener el año actual
                $anoActual = date("Y");
                ?>
                <input type="number" name="ano" class="form-control" value="<?= $anoActual; ?>" required>
            </div>
        </div>
        <button type="submit" class="btn btn-dark">Generar Informe</button>
    </form>
</div>
    <?php
    // Código PHP para generar el informe...
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>