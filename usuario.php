<?php
  //* Importar la Conexión
  // require 'includes/config/database.php';
  $db = conectarDB();

  //* Crear un E-mail y Password
  $email = "developer.javp@gmail.com";
  $password = "jav073688$";
  $passwordHash = password_hash($password, PASSWORD_BCRYPT);

  //* Query para Crear el Usuario
  $query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";

  // var_dump($passwordHash);
  // echo $query;
  // exit;

  //* Agregar el Usuario a la Base de Datos
  $resultado = mysqli_query($db, $query);

  //* Cerrar Conexión a la BD
  mysqli_close($db);
?>
