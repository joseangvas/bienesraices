<?php
  //* IMPORTAR LA CONEXION
  include __DIR__ . '/../config/database.php';
  $db = conectarDB();

  //* CONSULTAR TABLAS
  $query = "SELECT * FROM propiedades LIMIT $limite";

  //* OBTENER RESULTADOS
  $resultado = mysqli_query($db, $query);



?>



<div class="contenedor-anuncios">
  <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
  <div class="anuncio">
    <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen Anuncio">

    <div class="contenido-anuncio">
      <h3><?php echo $propiedad['titulo']; ?></h3>
      <p><?php echo $propiedad['descripcion']; ?></p>
      <p class="precio">$ <?php echo $propiedad['precio']; ?></p>

      <ul class="iconos-caracteristicas">
        <li>
          <img class="icono" src="build/img/icono_wc.svg" alt="Icono WC">
          <p><?php echo $propiedad['wc']; ?></p>
        </li>
        <li>
          <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamientos">
          <p><?php echo $propiedad['estacionamiento']; ?></p>
        </li>
        <li>
          <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
          <p><?php echo $propiedad['habitaciones']; ?></p>
        </li>
      </ul>

      <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
        Ver Propiedad
      </a>
    </div> <!-- .contenido-anuncio -->
  </div> <!-- anuncio -->
  <?php endwhile; ?>
</div> <!-- contenedor-anuncios -->

<?php
  //* CERRAR LA CONEXION
  mysqli_close($db);
?>
