<?php

require 'app.php';

//* Incluir Plantilla en otro Archivo
function incluirTemplate( string $nombre, bool $inicio = false ) {
  include TEMPLATES_URL . "/$nombre.php";
}

//* Verificar Autenticación del Usuario
function estaAutenticado() : bool {
    session_start();

    $auth = $_SESSION['login'];
  
    if($auth) {
      return true;
    }
    return false;
}

?>