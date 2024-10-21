<?php
  session_start();
  session_destroy();
  echo "CERRANDO SESION AMIGO";
  header('Location: ../index.php');
  exit();
  ?>