<?php
  // Obtener id de la Propiedad a Consultar y Validar si es Entero
  $id = $_GET['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  // Validar el id en la URL para que sea un Número Entero
  if(!$id) {
    header('Location: /admin/index.php');
  }

  // Base de Datos
  require '../../includes/config/database.php';
  $db = conectarDB();

  // Consulta para Obtener los Datos de la Propiedad
  $consulta = "SELECT * FROM propiedades where id = $id";
  $resultado = mysqli_query($db, $consulta);
  $propiedad = mysqli_fetch_assoc($resultado);

  // Consultar para obtener los Vendedores
  $consulta = "SELECT * FROM vendedores";
  $resultado = mysqli_query($db, $consulta);

  // Arreglo con Mensaje de Errores
  $errores = [];

  $titulo = $propiedad['titulo'];
  $precio = $propiedad['precio'];
  $descripcion = $propiedad['descripcion'];
  $habitaciones = $propiedad['habitaciones'];
  $wc = $propiedad['wc'];
  $estacionamiento = $propiedad['estacionamiento'];
  $vendedorId = $propiedad['vendedorId'];
  $imagenPropiedad = $propiedad['imagen'];

  // Ejecutar el Código después de que el Usuario envía el Formulario
  if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

    // exit;

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    // Asignar Files hacia una Variable
    $imagen = $_FILES['imagen'];

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

    // Validar Archivo de imagen por Tamaño (1 MB. Máximo)
    $medida = 1000 * 1000;

    if( $imagen['size'] > $medida ) {
      $errores[] = 'La Imagen es muy Pesada';
    }

    // Revisar que el Array de Errores esté Vacío
    if(empty($errores)) {
      // Crear una Carpeta
      $carpetaImagenes = '../../imagenes/';
      
      if(!is_dir($carpetaImagenes)) {
        mkdir($carpetaImagenes);
      }
      
      //* Validar si Existe una nueva Imagen para Borrar la Anterior *//
      if($imagen['name']) {
        // Eliminar la Imagen Previa //
        unlink($carpetaImagenes . $propiedad['imagen']);

        // Generar un Nombre Unico de Imagen //
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";
        
        // Subir la Imagen //
        move_uploaded_file( $imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
        $imagenPropiedad = $nombreImagen;
      } else {
        $nombreImagen = $propiedad['imagen'];
      }
      
      //*  SUBIDA DE ARCHIVOS  *//
        // Insertar en la Base de Datos
      $query = " UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, vendedores_id = $vendedorId WHERE id = $id ";

      // Probar el Código de Actualización
      // echo $query;
      // exit;

      $resultado = mysqli_query($db, $query);

      if($resultado) {
        // Redireccionar al Usuario
        header('Location: /admin/index.php?resultado=2');
      };
    };
  };
  
  require '../../includes/funciones.php';
  incluirTemplate('header');
?>

    <main class="contenedor seccion">
      <h1>Actualizar Propiedad</h1>

      <a href="/admin/index.php" class="boton boton-verde">Volver</a>

      <?php foreach($errores as $error): ?>
        <div class="alerta error">
          <?php echo $error; ?>
        </div>
      <?php endforeach; ?>

      <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
          <legend>Información General</legend>

          <label for="titulo">Titulo:</label>
          <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

          <label for="precio">Precio:</label>
          <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

          <label for="imagen">Imagen:</label>
          <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

          <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="Imagen de la Propiedad" class="imagen-small">

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

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
      </form>

    </main>

<?php
  incluirTemplate('footer');
?>
