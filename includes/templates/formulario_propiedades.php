<fieldset>
  <legend>Información General</legend>

  <label for="titulo">Titulo:</label>
  <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

  <label for="precio">Precio:</label>
  <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

  <label for="imagen">Imagen:</label>
  <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">

  <?php if($propiedad->imagen) { ?>
    <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small" alt="Imagen de la Propiedad">
  <?php } ?>

  <label for="descripcion">Descripción:</label>
  <textarea type="text" id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
  <legend>Información de la Propiedad</legend>

  <label for="habitaciones">Habitaciones:</label>
  <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="N° Habitaciones" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

  <label for="wc">Baños:</label>
  <input type="number" id="wc" name="propiedad[wc]" placeholder="N° Baños" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

  <label for="estacionamiento">Estacionamientos:</label>
  <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="N° Estacionamientos" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
  <legend>Vendedor</legend>

  <select name="vendedorId">
    <option>-- Seleccione Vendedor --</option>
    <?php while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
      <option <?php echo $vendedorId === s($propiedad->vendedor) ? 'selected' : ''; ?> value="<?php echo s($propiedad->vendedor); ?>"> <?php echo s($propiedad->vendedor) . " " . s($propiedad->vendedor); ?> </option>
    <?php endwhile; ?>
  </select>
</fieldset>
