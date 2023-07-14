<?php

  // Base de Datos
  require '../../includes/config/database.php';
  $db = conectarDB();

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedorId = $_POST['vendedor'];

    // Insertar en la Base de Datos
    $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_Id ) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorId' ) ";

    // echo $query;

    $resultado = mysqli_query($db, $query);

    if($resultado) {
      echo "Propiedad Insertada Correctamente";
    } else {
      echo "No se pudieron enviar Datos al Servidor";
    };
  };
  
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
          <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad">

          <label for="precio">Precio:</label>
          <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">

          <label for="imagen">Imagen:</label>
          <input type="file" id="imagen">

          <label for="descripcion">Descripción:</label>
          <textarea type="text" id="descripcion" name="descripcion"></textarea>
        </fieldset>

        <fieldset>
          <legend>Información de la Propiedad</legend>

          <label for="habitaciones">Habitaciones:</label>
          <input type="number" id="habitaciones" name="habitaciones" placeholder="N° Habitaciones" min="1" max="9">

          <label for="wc">Baños:</label>
          <input type="number" id="wc" name="wc" placeholder="N° Baños" min="1" max="9">

          <label for="estacionamiento">Estacionamientos:</label>
          <input type="number" id="estacionamiento" name="estacionamiento" placeholder="N° Estacionamientos" min="1" max="9">
        </fieldset>

        <fieldset>
          <legend>Vendedor</legend>

          <select name="vendedor">
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
