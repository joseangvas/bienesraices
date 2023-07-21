<?php
  require 'includes/funciones.php';
  incluirTemplate('header');

  //* Obtener id de la Propiedad a Consultar y Validar si es Entero
  $id = $_GET['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  //* Validar el id en la URL para que sea un Número Entero
  if(!$id) {
    header('Location: index.php');
  }
    
  //* IMPORTAR LA CONEXION
  include 'includes/config/database.php';
  $db = conectarDB();

  //* CONSULTAR TABLAS
  $query = "SELECT * FROM propiedades WHERE id = $id";

  //* OBTENER RESULTADOS
  $resultado = mysqli_query($db, $query);

  if(!$resultado->num_rows) {
    header('Location: /');
  }

  $propiedad = mysqli_fetch_assoc($resultado);

?>

    <main class="contenedor seccion contenido-centrado">
      <h1>Casa en Venta frente al Bosque</h1>

      <img src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la Propiedad" loading="lazy">

      <div class="resumen-propiedad">
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

        <p><?php echo $propiedad['descripcion']; ?></p>
      </div>
    </main>

<?php
  // Cerrar Conexión a DB
  mysqli_close($db);

  incluirTemplate('footer');
?>
