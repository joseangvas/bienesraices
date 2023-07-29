<?php
  require 'includes/app.php';
  incluirTemplate('header');
?>

    <main class="contenedor seccion">
      <h1>Conoce sobre Nosotros</h1>

      <div class="contenido-nosotros">
        <div class="imagen">
          <picture class="">
            <source srcset="build/img/nosotros.webp" type="image/webp">
            <source srcset="build/img/nosotros.jpg" type="image/jpeg">
            <img src="build/img/nosotros.jpg" alt="Imagen de Nosotros">
          </picture>
        </div>
 
        <div class="texto-nosotros">
          <blockquote>
            25 Años de Experiencia
          </blockquote>

          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit commodi pariatur quo tenetur minima officia deleniti tempore perspiciatis qui id doloremque, laboriosam sequi maxime, fugiat ipsum a soluta quaerat? Amet.
            Et, id quo! Ad obcaecati amet architecto voluptatibus odit tempora. Explicabo amet voluptatem quis? Aliquam, autem, doloremque aspernatur maiores odit recusandae ipsa est ipsam perferendis esse voluptatibus facilis, cum eveniet.
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti delectus eum aliquam fugiat a velit sint ipsam inventore dignissimos reprehenderit veniam voluptatibus vel, consectetur dicta repudiandae perspiciatis ipsum illo quasi!
            Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
      </div>

    </main>

    <section>
      <h1>Más sobre nosotros</h1>

      <div class="iconos-nosotros">
        <div class="icono">
          <img src="build/img/icono1.svg" alt="Icono de Seguridad" loading="lazy">
          <h3>Seguridad</h3>
          <p>ratione fugiat quidem veniam maxime aperiam eaque vero repudiandae saepe eum iure esse?
          Ratione suscipit aspernatur temporibus at adipisci, nesciunt voluptatem.</p>
        </div>

        <div class="icono">
          <img src="build/img/icono2.svg" alt="Icono de Precio" loading="lazy">
          <h3>Precio</h3>
          <p>Iste est nostrum vitae sint iusto, dolorum aut, culpa ratione fugiat quidem veniam maxime aperiam eaque vero repudiandae saepe eum iure esse? Ratione suscipit aspernatur.</p>
        </div>

        <div class="icono">
          <img src="build/img/icono3.svg" alt="Icono de Tiempo" loading="lazy">
          <h3>A Tiempo</h3>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste est nostrum vitae sint iusto, dolorum aut, culpa ratione fugiat quidem veniam maxime aperiam eaque vero repudiandae.</p>
        </div>
      </div>
    </section>

<?php
   incluirTemplate('footer');
?>
