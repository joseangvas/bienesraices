<?php

  use App\Propiedad;
  use App\Vendedor;
  use Intervention\Image\ImageManagerStatic as Image;

  require '../../includes/app.php';

  estaAutenticado();

  //* Obtener id de la Propiedad a Consultar y Validar si es Entero
  $id = $_GET['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  //* Validar el id en la URL para que sea un Número Entero
  if(!$id) {
    header('Location: /admin/index.php');
  }

  //* Consulta para Obtener los Datos de la Propiedad
  $propiedad = Propiedad::find($id);
  
  //* Consulta para Obtener Todos los Vendedores
  $vendedores = Vendedor::all();

  //* Arreglo con Mensaje de Errores
  $errores = Propiedad::getErrores();

  //* Ejecutar el Código después de que el Usuario envía el Formulario
  if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //* Asignar los Atributos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    //* Validar los Datos
    $errores = $propiedad->validar();

    //*  SUBIDA DE ARCHIVOS  *//

    //* Generar un Nombre Unico de Imagen
    $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

    //* Setear la Imagen
    //* Realizar un Resize a la Imagen con Intervetion
    if($_FILES['propiedad']['tmp_name']['imagen']) {
      $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
      $propiedad->setImagen($nombreImagen);
    }

    //* Revisar que el Array de Errores esté Vacío
    if(empty($errores)) {
      if($_FILES['propiedad']['tmp_name']['imagen']) {
        //* Guardar la Imagen en el Servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);
      }

      //* Insertar en la Base de Datos
      $propiedad->guardar();
    };
  };
  
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

    <?php include '../../includes/templates/formulario_propiedades.php' ?> 

    <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
  </form>

</main>

<?php
  mysqli_close($db);
  incluirTemplate('footer');
?>
