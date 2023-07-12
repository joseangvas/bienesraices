<?php

function conectarDB() : mysqli {
  $db = mysqli_connect('localhost', 'root', '', 'bienesraices_crud');

  if(!$db) {
    echo "Error! No se pudo Conectar la BD";
    exit;
  }

  return $db;
}