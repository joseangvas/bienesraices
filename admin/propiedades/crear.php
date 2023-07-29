<?php
  require '../../includes/app.php';

  use App\Propiedad;
  use Intervention\Image\ImageManagerStatic as Image;

  //* Autenticar el Usuario
  estaAutenticado();

  //* Conectar a Bases de Datos
  $db = conectarDB();

  //* Consultar para obtener los Vendedores
  $consulta = "SELECT * FROM vendedores";
  $resultado = mysqli_query($db, $consulta);

  //* Arreglo con Mensaje de Errores
  $errores = Propiedad::getErrores();

  $titulo = '';
  $precio = '';
  $descripcion = '';
  $habitaciones = '';
  $wc = '';
  $estacionamiento = '';
  $vendedorId = '';

  //* Ejecutar el Código después de que el Usuario envía el Formulario
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //* Crear una Nueva Instancia
    $propiedad = new Propiedad($_POST);

    //* Generar un Nombre Unico de Imagen
    $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

    //* Setear la Imagen
    //* Realizar un Resize a la Imagen con Intervetion
    if($_FILES['imagen']['tmp_name']) {
      $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
      $propiedad->setImagen($nombreImagen);
    }

    //* Validar los Datos
    $errores = $propiedad->validar();

    //* Comprobar si el Array de Errores esté Vacío
    if(empty($errores)) {
      //**  SUBIDA DE ARCHIVOS  **//
      //* Crear una Carpeta de Imagenes si no Existe
      if(!is_dir(CARPETA_IMAGENES)) {
        mkdir(CARPETA_IMAGENES);
      }
      
      //* Guardar la Imagen en el Servidor
      $image->save(CARPETA_IMAGENES . $nombreImagen);
      
      //* guardar en la Base de Datos
      $resultado = $propiedad->guardar();

      //* Mensaje de Exito al Guardar
      if($resultado) {
        //* Redireccionar al Usuario
        header('Location: /admin/?resultado=1');
      };
    };
  };
  
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

      <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
          <legend>Información General</legend>

          <label for="titulo">Titulo:</label>
          <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

          <label for="precio">Precio:</label>
          <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

          <label for="imagen">Imagen:</label>
          <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

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

          <select name="vendedorId">
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
  mysqli_close($db);
  incluirTemplate('footer');
?>
