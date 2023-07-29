<?php
  require 'includes/app.php';

  //* Conectar a la Base de Datos
  // require "includes/config/database.php";
  $db = conectarDB();

  $errores = [];

  //* Autenticar el Usuario
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email) {
      $errores[] = "El E-mail es obligatorio o No es Válido";
    }

    if(!$password) {
      $errores[] = "El Password es obligatorio";
    }

    if(empty($errores)) {
      //* Revisar si el Usuario Existe
      $query = "SELECT * FROM usuarios WHERE email = '$email'";
      $resultado = mysqli_query($db, $query);

      
      if( $resultado->num_rows ) {
        //* Revisar si el Password es Correcto
        $usuario = mysqli_fetch_assoc($resultado);
        
        //* Verificar si el Password es Correcto o No
        $auth = password_verify($password, $usuario['password']);
        
        if($auth) {
          //* El Usuario Ha Sido Autenticado
          session_start();

          //* Llenar el Arreglo de la Sesión
          $_SESSION['usuario'] = $usuario['email'];
          $_SESSION['login'] = true;

          header('Location: /admin/index.php');

        } else {
          $errores[] = "El Password es Incorrecto";
        }

      } else {
        $errores[] = "El Usuario No Existe";
      }
     }
  }

  //* Incluir el Header
  incluirTemplate('header');
?>

  <main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php
      foreach($errores as $error): ?>
        <div class="alerta error">
          <?php echo $error; ?>
        </div>


    <?php endforeach; ?>

    <form method="POST" action="" class="formulario" novalidate>
      <fieldset>
          <legend>Usuario y Password</legend>

          <label for="email">E-mail:</label>
          <input type="email" id="email" name="email" placeholder="Tu E-mail">

          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Tu Password">
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
  </main>

<?php
  mysqli_close($db);
  incluirTemplate('footer');
?>
