<?php
session_start();

?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CalendarioEventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/moment.min.js"></script>
    <!-- Full Calendar -->
    <link rel="stylesheet" href="../css/fullcalendar.min.css">
    <script src="../js/fullcalendar.min.js"></script>
    <script src="../js/es.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
            <li><a class="dropdown-item" href="../usuario/mi-perfil.php">Mi Perfil</a></li>
            <li><a class="dropdown-item" href="../usuario/mis-reservas.php">Mis Reservas</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="../sesion/logout.php">Cerrar Sesion</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="calendario.php">Calendario</a>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-7"> <div id="CalendarioEventos"></div></div>
            <div class="col"></div>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        $('#CalendarioEventos').fullCalendar({
          header:{
            left:'today,prev,next,Miboton',
            center:'title',
            right:'month, basicweek, basicDay, agendaWeek, agendaDay'
          },
          customButtons:{
            Miboton:{
              text:"Botón 1",
              click:function(){
                alert("Acción del botón ");
              }
            }
          },
          dayClick:function(date,jsEvent,view){
            $("#txtFecha").val(date.format());
            $("#ModalEventos").modal('show');
          },
        events:'http://localhost/evento/eventoscalendario.php',
          
        eventClick:function(calEvent,jsEvent,view){
          $('#tituloEvento').html(calEvent.title);
          $('#descripcionEvento').html(calEvent.descripcion);

          $("#exampleModal").modal('show');

        }



        });
    });

    </script>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloEvento"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="descripcionEvento"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success">Agregar</button>
          <button type="button" class="btn btn-success">Modificar</button>
          <button type="button" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
          
        </div>
      </div>
    </div>
  </div>

 <!-- Modal(Agregar, modificar, eliminar) -->
 <div class="modal fade" id="ModalEventos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloEvento"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div id="descripcionEvento"></div>
    
        Fecha: <input type="text" id="txtFecha" name="txtFecha" /><br/>
        Título: <input type="text" id="txtTitulo"><br/>
        Hora:<input type="text" id="txtHora" value="10:30"/><br/>  
        Descripción:<textarea id="txtDescripcion" rows="3"></textarea><br/>
        Color: <input type="color" value="#ff0000" id="txtColor"><br/>

      </div>
        <div class="modal-footer">

          <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
          <button type="button" class="btn btn-success">Modificar</button>
          <button type="button" class="btn btn-danger">Borrar</button>
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
          
        </div>
      </div>
    </div>
  </div>

<script>
$('#btnAgregar').click(function(){
var NuevoEvento= {
  title:$("#txtTitulo").val(),
  start:$("#txtFecha").val()+" "+$("#txtHora").val(),
  color:$("#txtColor").val(),
  descripcion:$("#txtDescripcion").val(),
  textColor:"FFFFFF"
};
$('#CalendarioEventos').fullCalendar('renderEvent',NuevoEvento );
$("#ModalEventos").modal('toggle');
});

</script>

</body>
</html>