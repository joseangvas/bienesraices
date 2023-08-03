<?php
  require '../../includes/app.php';
  use App\Vendedor;

  //* Autenticar el Usuario
  estaAutenticado();

  //* Validar que sea un ID Válido
  $id = $_GET['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if(!$id) {
    header('Location: /admin');
  }

  //* Obtener el Arreglo del Vendedor
  $vendedor = Vendedor::find($id);

  //* Arreglo con Mensaje de Errores
  $errores = Vendedor::getErrores();

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //* Asignar los Valores
    $args = $_POST['vendedor'];

    //* Sincronizar Objeto en Memoria con lo que el Usuario Escribió
    $vendedor->sincronizar($args);

    //* Validación de los Datos
    $errores = $vendedor->validar();

    if(empty($errores)) {
      $vendedor->guardar();
    }
  }

  incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Actualizar Vendedor</h1>

  <a href="/admin/index.php" class="boton boton-verde">Volver</a>

  <?php foreach($errores as $error): ?>
    <div class="alerta error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST">

    <?php include '../../includes/templates/formulario_vendedores.php' ?> 

    <input type="submit" value="Guardar Cambios" class="boton boton-verde">
  </form>
</main>

<?php
  incluirTemplate('footer');
?>