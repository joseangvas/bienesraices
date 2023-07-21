<?php
  // Importar la Conexión
  require '../includes/config/database.php';
  $db = conectarDB();

  // Escribir el Query
  $query = "SELECT * FROM propiedades";

  // Consultar la Base de Datos
  $resultadoConsulta = mysqli_query($db, $query);
  
  // Muestra Mensaje Condicional 
  $resulta = $_GET['resultado'] ?? null;

  //* Realizar Borrado de Registro en la Tabla *//
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id) {
      //* Eliminar el Archivo de Imagen *//
      $query = "SELECT imagen FROM propiedades WHERE id = $id";

      // echo $query;
      // exit;

      $resultado = mysqli_query($db, $query);
      $propiedad = mysqli_fetch_assoc($resultado);

      // echo "<pre>";
      // var_dump($propiedad['imagen']);
      // echo "</pre>";
      // exit;

      unlink('../imagenes/' . $propiedad['imagen']);

      //* Eliminar la Propiedad *//
      $query = "DELETE FROM propiedades WHERE id = $id";
      $resultado = mysqli_query($db, $query);

      if($resultado) {
        header('Location: /admin?resultado=3');
      }
    }
  }

  // Incluye un Template
  require '../includes/funciones.php';
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
          <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
            <tr>
              <td><?php echo $propiedad['id']; ?></td>
              <td><?php echo $propiedad['titulo']; ?></td>
              <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
              <td><?php echo "$ " . $propiedad['precio']; ?></td>
              <td>
                <form method="POST" class="w-100">
                  <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                  <input type="submit" class="boton-rojo-block" value="Eliminar">
                </form>
                <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

    </main>

<?php
  // Cerrar la Conexión
  mysqli_close($db);

  incluirTemplate('footer');
?>