<?php 
    require __DIR__.'/includes/app.php';
    incluirTemplates('header', $inicio = true);
?>

    <main class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h4>Seguridad</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit earum quibusdam repudiandae ipsam consequuntur, culpa porro facere assumenda libero velit enim dolore? Illum molestias 
                    illo distinctio? Officia libero molestiae totam.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h4>Precio</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit earum quibusdam repudiandae ipsam consequuntur, culpa porro facere assumenda libero velit enim dolore? Illum molestias 
                    illo distinctio? Officia libero molestiae totam.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h4>Tiempo</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit earum quibusdam repudiandae ipsam consequuntur, culpa porro facere assumenda libero velit enim dolore? Illum molestias 
                    illo distinctio? Officia libero molestiae totam.</p>
            </div>
        </div>
    </main>
    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>
        <div class="contenedor-anuncios">
            <!--php $limite = 3; 
                include 'includes/templates/anuncios.php'; -->
            
        </div>
        <div class="ver-todas alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas</a>
        </div>
    </section>
    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario y un asesor se pondra en contacto contigo</p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    </section>
    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada">
                <div class="imagen">
                    <picture>
                        <source  srcset="build/img/blog1.webp" type="image/webp"/>
                        <source  srcset="build/img/blog1.jpg" type="image/jpg"/>
                        <img loading="lazy" alt="" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2025</span> por <span>Admin</span></p>
                        <p>Consejos para construir la terraza de tu casa con los mejores materiales ahorrando dinero</p>
                    </a>
                </div>
            </article>
            <article class="entrada">
                <div class="imagen">
                    <picture>
                        <source  srcset="build/img/blog2.webp" type="image/webp"/>
                        <source  srcset="build/img/blog2.jpg" type="image/jpg"/>
                        <img loading="lazy" alt="" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guia para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2025</span> por <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                    </a>
                </div>
            </article>
        </section>
        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comporto a la altura de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas las expectativas    
                </blockquote>
                <p> -- Juan de la Torre</p>
            </div>
        </section>
    </div>
<?php 
    incluirTemplates('footer');
?>