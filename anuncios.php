<?php
  include './includes/templates/header.php';
?>

    <main class="contenedor seccion">
      <h1>Casas y Departamentos en Venta</h1>

      <?php
        $limite = 12;
        include 'includes/templates/anuncios.php';
      ?>

    </main>

<?php
  include './includes/templates/footer.php';
?>
