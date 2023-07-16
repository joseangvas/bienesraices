<?php

  // Base de Datos
  require '../../includes/config/database.php';
  $db = conectarDB();

  // Consultar para obtener los Vendedores
  $consulta = "SELECT * FROM vendedores";
  $resultado = mysqli_query($db, $consulta);

  // Arreglo con Mensaje de Errores
  $errores = [];

  $titulo = '';
  $precio = '';
  $descripcion = '';
  $habitaciones = '';
  $wc = '';
  $estacionamiento = '';
  $vendedorId = '';

  // Ejecutar el Código después de que el Usuario envía el Formulario
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedorId = $_POST['vendedor'];
    $creado = date('Y/m/d');

    // Validar entrada de Datos
    if(!$titulo) {
      $errores[] = "Debes Ingresar un Título";
    }
    
    if(!$precio) {
      $errores[] = "Debes Ingresar un Precio";
    }

    if( strlen($descripcion) < 50 ) {
      $errores[] = "Debes Ingresar Descripcion y Debe tener más de 50 Caracteres";
    }

    if(!$habitaciones) {
      $errores[] = "Debes Ingresar Número de Habitaciones";
    }

    if(!$wc) {
      $errores[] = "Debes Ingresar Número de Baños";
    }

    if(!$estacionamiento) {
      $errores[] = "Debes Ingresar Número de Estacionamientos";
    }

    if(!$vendedorId) {
      $errores[] = "Debes Seleccionar un Vendedor";
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    // Revisar que el Array de Errores esté Vacío
    if(empty($errores)) {
        // Insertar en la Base de Datos
      $query = " INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_Id ) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId' ) ";

      // echo $query;

      $resultado = mysqli_query($db, $query);

      if($resultado) {
        // Redireccionar al Usuario
        header('Location: /admin');
      };
    }
  };
  
  require '../../includes/funciones.php';
  incluirTemplate('header');
?>

    <main class="contenedor seccion">
      <h1>Crear</h1>

      <a href="/admin/index.php" class="boton boton-verde">Volver</a>

      <?php foreach($errores as $error): ?>
        <div class="alerta error">
          <?php echo $error; ?>
        </div>
      <?php endforeach; ?>

      <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
        <fieldset>
          <legend>Información General</legend>

          <label for="titulo">Titulo:</label>
          <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

          <label for="precio">Precio:</label>
          <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

          <label for="imagen">Imagen:</label>
          <input type="file" id="imagen">

          <label for="descripcion">Descripción:</label>
          <textarea type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>"></textarea>
        </fieldset>

        <fieldset>
          <legend>Información de la Propiedad</legend>

          <label for="habitaciones">Habitaciones:</label>
          <input type="number" id="habitaciones" name="habitaciones" placeholder="N° Habitaciones" min="1" max="9" value="<?php echo $habitaciones; ?>">

          <label for="wc">Baños:</label>
          <input type="number" id="wc" name="wc" placeholder="N° Baños" min="1" max="9" value="<?php echo $wc; ?>">

          <label for="estacionamiento">Estacionamientos:</label>
          <input type="number" id="estacionamiento" name="estacionamiento" placeholder="N° Estacionamientos" min="1" max="9" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
          <legend>Vendedor</legend>

          <select name="vendedor">
            <option>-- Seleccione Vendedor --</option>
            <?php while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
              <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?> </option>
            <?php endwhile; ?>
          </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
      </form>

    </main>

<?php
  incluirTemplate('footer');
?>
