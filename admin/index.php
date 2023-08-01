<?php
  require '../includes/app.php';

  //* Autenticar el Usuario
  estaAutenticado();

  //* Importar las Clases
  use App\Propiedad;
  use App\Vendedor;

  //* Implementar un Método para Obtener todas las Propiedades
  //* Usando Active Record
  $propiedades = Propiedad::all();
  $vendedores = Vendedor::all();

  //* Muestra Mensaje Condicional 
  $resultado = $_GET['resultado'] ?? null;

  //* Realizar Borrado de Registro en la Tabla *//
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //* Validar ID
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id) {
      $tipo = $_POST['tipo'];

      if(validarTipoContenido($tipo)) {
        // Comparar lo que Vamos a Eliminar
        if($tipo === 'vendedor') {
          $vendedor = Vendedor::find($id);
          $vendedor->eliminar();
        } else if ($tipo === 'propiedad') {
          $propiedad = Propiedad::find($id);
          $propiedad->eliminar();
        }
      }
    }
  }

  //* Incluye un Template
  incluirTemplate('header');
?>

<main class="contenedor seccion">
  <h1>Administrador de Bienes Raíces</h1>

  <?php
    $mensaje = mostrarNotificacion( intval($resultado) ); 

    if($mensaje)  { ?>
      <p class="alerta exito"><?php s($mensaje) ?> </p>
  <?php } ?>

  <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
  <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>

  <h2>Propiedades</h2>
  <table class="propiedades">
    <thead>
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Imagen</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    
    <tbody>  <!-- Mostrar los Resultados -->
      <?php foreach($propiedades as $propiedad) : ?>
        <tr>
          <td><?php echo $propiedad->id; ?></td>
          <td><?php echo $propiedad->titulo; ?></td>
          <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt="Imagen de Propiedad"></td>
          <td><?php echo "$ " . $propiedad->precio; ?></td>
          <td>
            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
              <input type="hidden" name="tipo" value="propiedad">
              <input type="submit" class="boton-rojo-block" value="Eliminar">
            </form>
            <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
  <h2>Vendedores</h2>
  <table class="propiedades">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre y Apellido</th>
        <th>Teléfono</th>
        <th>Acciones</th>
      </tr>
    </thead>
    
    <tbody>  <!-- Mostrar los Resultados -->
      <?php foreach($vendedores as $vendedor) : ?>
        <tr>
          <td><?php echo $vendedor->id; ?></td>
          <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
          <td><?php echo $vendedor->telefono; ?></td>
          <td>
            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
              <input type="hidden" name="tipo" value="vendedor">
              <input type="submit" class="boton-rojo-block" value="Eliminar">
            </form>
            <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

<?php
  incluirTemplate('footer');
?>