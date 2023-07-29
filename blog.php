<?php
  require 'includes/app.php';
  incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
      <h1>Nuestro Blog</h1>

      <article class="entrada-blog">
        <div class="imagen">
          <picture>
            <source srcset="build/img/blog1.webp" type="image/webp">
            <source srcset="build/img/blog1.jpg" type="image/jpeg">
            <img src="build/img/blog1.jpg" alt="Texto entrada Blog" loading="lazy">
          </picture>
        </div>

        <div class="texto-entrada">
          <a href="entrada.html">
            <h4>Terraza en el Techo de tu Casa</h4>
            <p>Escrito el: <span>20/03/2021</span> Por: <span>Admin</span></p>
            <p>
              Consejos para construir una Terraza en el Techo de tu Casa con los mejores materiales y ahorrando dinero
            </p>
          </a>
        </div>

        <div class="imagen">
          <picture>
            <source srcset="build/img/blog2.webp" type="image/webp">
            <source srcset="build/img/blog2.jpg" type="image/jpeg">
            <img src="build/img/blog2.jpg" alt="Texto entrada Blog" loading="lazy">
          </picture>
        </div>

        <div class="texto-entrada">
          <a href="entrada.html">
            <h4>Guía para la Decoración de tu Hogar</h4>
            <p>Escrito el: <span>08/05/2021</span> Por: <span>Admin</span></p>
            <p>
              Maximiza el espacio en tu hogar con esta Guía. Aprende a combinar muebles y colores para darle vida a tu espacio
            </p>
          </a>
        </div>

        <div class="imagen">
          <picture>
            <source srcset="build/img/blog3.webp" type="image/webp">
            <source srcset="build/img/blog3.jpg" type="image/jpeg">
            <img src="build/img/blog3.jpg" alt="Texto entrada Blog" loading="lazy">
          </picture>
        </div>

        <div class="texto-entrada">
          <a href="entrada.html">
            <h4>Terraza en el Techo de tu Casa</h4>
            <p>Escrito el: <span>20/03/2021</span> Por: <span>Admin</span></p>
            <p>
              Consejos para construir una Terraza en el Techo de tu Casa con los mejores materiales y ahorrando dinero
            </p>
          </a>
        </div>

        <div class="imagen">
          <picture>
            <source srcset="build/img/blog4.webp" type="image/webp">
            <source srcset="build/img/blog4.jpg" type="image/jpeg">
            <img src="build/img/blog4.jpg" alt="Texto entrada Blog" loading="lazy">
          </picture>
        </div>

        <div class="texto-entrada">
          <a href="entrada.html">
            <h4>Guía para la Decoración de tu Hogar</h4>
            <p>Escrito el: <span>08/05/2021</span> Por: <span>Admin</span></p>
            <p>
              Maximiza el espacio en tu hogar con esta Guía. Aprende a combinar muebles y colores para darle vida a tu espacio
            </p>
          </a>
        </div>
      </article>

    </main>

<?php
  incluirTemplate('footer');
?>
