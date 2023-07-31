<?php
  require '../includes/app.php';

  //* Autenticar el Usuario
  estaAutenticado();

  use App\Propiedad;
  use App\Vendedor;

  //* Implementar un Método para Obtener todas las Propiedades
  //* Usando Active Record
  $propiedades = Propiedad::all();
  $vendedores = Vendedor::all();

  //* Muestra Mensaje Condicional 
  $resulta = $_GET['resultado'] ?? null;

  //* Realizar Borrado de Registro en la Tabla *//
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id) {

      $propiedad = Propiedad::find($id);

      $propiedad->eliminar();
    }
  }

  //* Incluye un Template
  incluirTemplate('header');
?>

    <main class="contenedor seccion">
      <h1>Administrador de Bienes Raíces</h1>

      <?php if( intval($resulta) === 1 ): ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
      <?php elseif( intval($resulta) === 2 ): ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
      <?php elseif( intval($resulta) === 3 ): ?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>
      <?php endif; ?>

      <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
 
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
                  <input type="submit" class="boton-rojo-block" value="Eliminar">
                </form>
                <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </main>

<?php
  //* Cerrar la Conexión
  mysqli_close($db);

  incluirTemplate('footer');
?>