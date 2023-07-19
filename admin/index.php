<?php
  // Muestra Mensaje Condicional 
  $resultado = $_GET['resultado'] ?? null;

  // Incluye un Template
  require '../includes/funciones.php';
  incluirTemplate('header');
?>

    <main class="contenedor seccion">
      <h1>Administrador de Bienes Raíces</h1>

      <?php if( intval($resultado) === 1 ): ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
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
        
        <tbody>
          <tr>
            <td>1</td>
            <td>Casa en La Playa</td>
            <td><img src="/imagenes/bf82d8695c304405a8cfff9ca453d572.jpg" class="imagen-tabla"></td>
            <td>$2500000</td>
            <td>
              <a href="#" class="boton-rojo-block">Eliminar</a>
              <a href="#" class="boton-amarillo-block">Actualizar</a>
            </td>
          </tr>
        </tbody>
      </table>
 
 
 
 
 
 
 
 
 
 
    </main>

<?php
  incluirTemplate('footer');
?>