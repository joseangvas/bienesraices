<?php
  require '../../includes/app.php';

  use App\Propiedad;
  use Intervention\Image\ImageManagerStatic as Image;

  //* Autenticar el Usuario
  estaAutenticado();

  //* Conectar a Bases de Datos
  $db = conectarDB();

  $propiedad = new Propiedad;

  //* Consultar para obtener los Vendedores
  $consulta = "SELECT * FROM vendedores";
  $resultado = mysqli_query($db, $consulta);

  //* Arreglo con Mensaje de Errores
  $errores = Propiedad::getErrores();

  //* Ejecutar el Código después de que el Usuario envía el Formulario
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //* Crear una Nueva Instancia
    $propiedad = new Propiedad($_POST['propiedad']);

    //* Generar un Nombre Unico de Imagen
    $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

    //* Setear la Imagen
    //* Realizar un Resize a la Imagen con Intervetion
    if($_FILES['propiedad']['tmp_name']['imagen']) {
      $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
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

        <?php include '../../includes/templates/formulario_propiedades.php' ?> 

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
      </form>

    </main>

<?php
  mysqli_close($db);
  incluirTemplate('footer');
?>
