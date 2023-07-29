<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../IMAGENES/');

//* Incluir Plantilla en otro Archivo
function incluirTemplate( string $nombre, bool $inicio = false ) {
  include TEMPLATES_URL . "/$nombre.php";
}

//* Verificar Autenticación del Usuario
function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']) {
      header('Location: /');
    }
}

//* Ejecutar var_dump()
function debuguear($variable) {
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  
  exit;
}

