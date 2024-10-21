<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .jumbotron {
            background: url('https://cdn.wallpapersafari.com/23/64/reATgs.jpg') no-repeat center center;
            background-size: cover;
            color: #fff;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" href="inicio.php">
      <img src="logo_size.jpg" alt="Logo" width="100px" height="50px" ></a>
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
            <li><a class="dropdown-item" href="usuario/mi-perfil.php?id=<?=$_SESSION['id']?>">Mi Perfil</a></li>
            <li><a class="dropdown-item" href="usuario/mis-reservas.php">Mis Reservas</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="sesion/logout.php">Cerrar Sesion</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="eventos/calendario.php">Calendario</a>

        </li>
		<li class="nav-item">
          <a class="nav-link" href="eventos/eventos.php">Catálogo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="nosotros.php">Nosotros</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="jumbotron text-center">
        <h1 class="display-4">Bienvenido a Ivento</h1>
        <p class="lead">Donde tus Eventos Cobran Vida</p>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Variedad Sin Límites</h2>
                <p>Ya sea una boda íntima, una fiesta de cumpleaños espectacular o una conferencia corporativa de gran
                    escala, en Ivento tenemos una amplia gama de lugares y servicios para elegir. Desde elegantes salones
                    de banquetes hasta jardines mágicos y espacios modernos para reuniones, te ofrecemos opciones que se
                    adaptan a cualquier ocasión.</p>
            </div>
            <div class="col-md-6">
                <h2>Profesionales Apasionados</h2>
                <p>Nuestro equipo está compuesto por expertos apasionados por los eventos. Desde planificadores de
                    bodas hasta coordinadores de conferencias, cada miembro de nuestro equipo está dedicado a hacer
                    realidad tus sueños. Nos encargamos de todos los detalles para que puedas relajarte y disfrutar del
                    momento.</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <h2>Tecnología Intuitiva</h2>
                <p>Hemos desarrollado una plataforma fácil de usar que te permite explorar diferentes lugares, servicios
                    y opciones de catering con solo unos clics. Personaliza tu evento según tus necesidades y presupuesto,
                    y deja que nuestra tecnología se encargue del resto.</p>
            </div>
            <div class="col-md-6">
                <h2>Experiencias Memorables</h2>
                <p>En Ivento, creemos en la magia de los detalles. Desde la decoración exquisita hasta el menú
                    cuidadosamente elaborado, nos aseguramos de que cada aspecto de tu evento sea perfecto. Queremos que
                    tus invitados se vayan con recuerdos inolvidables y sonrisas en sus rostros.</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <h2>Compromiso con la Sostenibilidad</h2>
                <p>Nos preocupamos por nuestro planeta y nos esforzamos por hacer que cada evento sea sostenible.
                    Trabajamos con proveedores locales, utilizamos prácticas ecoamigables y reducimos nuestro impacto
                    ambiental en cada paso del camino.</p>
            </div>
        </div>
    </div>
    </div>
    <div class="container mt-5">
    <h1 class="text-center">¿Quiénes Somos?</h1>
    <p>Somos Ivento, un equipo apasionado de profesionales dedicados a hacer que tus eventos sean inolvidables. Con años de experiencia en la industria de eventos, nos enorgullecemos de ofrecer servicios excepcionales y lugares impresionantes para cualquier ocasión. En Ivento, no solo organizamos eventos; creamos experiencias que perduran en la memoria de nuestros clientes y sus invitados.</p>

    <h3>Nuestra Misión</h3>
    <p>Nuestra misión es convertir tus sueños en eventos reales. Trabajamos incansablemente para superar tus expectativas y crear momentos especiales que atesorarás para siempre.</p>

    <h3>¿Por Qué Elegirnos?</h3>
    <ul>
        <li>Experiencia y Profesionalismo: Contamos con un equipo experto que maneja cada detalle con cuidado y precisión.</li>
        <li>Variedad y Flexibilidad: Ofrecemos una amplia gama de lugares y servicios personalizables para adaptarse a tus necesidades.</li>
        <li>Compromiso con la Excelencia: Nos esforzamos por la excelencia en todo lo que hacemos, desde la planificación hasta la ejecución del evento.</li>
        <li>Servicio al Cliente: La satisfacción del cliente es nuestra prioridad. Estamos aquí para responder a tus preguntas y ayudarte en cada paso del proceso.</li>
    </ul>
</div>
    <div class="jumbotron">
    <div class="container mt-5">
    <h2>Contacto</h2>
    <p>Estamos aquí para ayudarte a planificar el evento perfecto. Ponte en contacto con nosotros para más información:</p>
    <div class="row">
        <div class="col-md-6">
            <h4>Información de Contacto</h4>
            <p><strong>Dirección:</strong> 123 Calle Principal, Santiago del Estero, Argentina</p>
            <p><strong>Teléfono:</strong> +54 9 385 567 8910</p>
            <p><strong>Correo Electrónico:</strong> consultas@ivento.com</p>
        </div>
        <div class="col-md-6">
            <h4>Horario de Atención</h4>
            <p><strong>Lunes a Sabados:</strong> 9:00 AM - 6:00 PM</p>
            <p><strong>Domingos:</strong> Cerrado</p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>