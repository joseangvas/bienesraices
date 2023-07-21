<?php
  require 'includes/funciones.php';
  incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
      <h1>Iniciar Sesión</h1>

      <form action="" class="formulario">
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
  incluirTemplate('footer');
?>
