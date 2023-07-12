<?php

  // Base de Datos
  require '../../includes/config/database.php';
  $db = conectarDB();

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
  }
  
  require '../../includes/funciones.php';
  incluirTemplate('header');
?>

    <main class="contenedor seccion">
      <h1>Crear</h1>

      <a href="/admin/index.php" class="boton boton-verde">Volver</a>

      <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
        <fieldset>
          <legend>Información General</legend>

          <label for="titulo">Titulo:</label>
          <input type="text" id="titulo" placeholder="Titulo Propiedad">

          <label for="precio">Precio:</label>
          <input type="number" id="precio" placeholder="Precio Propiedad">

          <label for="imagen">Imagen:</label>
          <input type="file" id="imagen">

          <label for="descripcion">Descripción:</label>
          <textarea type="text" id="descripcion"></textarea>
        </fieldset>

        <fieldset>
          <legend>Información de la Propiedad</legend>

          <label for="habitaciones">Habitaciones:</label>
          <input type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9">

          <label for="wc">Baños:</label>
          <input type="number" id="wc" placeholder="Ej: 3" min="1" max="9">

          <label for="estacionamiento">Estacionamientos:</label>
          <input type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9">
        </fieldset>

        <fieldset>
          <legend>Vendedor</legend>

          <select>
            <option value="1">Juan</option>
            <option value="2">Karen</option>
          </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
      </form>

    </main>

<?php
  incluirTemplate('footer');
?>