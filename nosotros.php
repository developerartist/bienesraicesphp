<?php 
    require 'includes/app.php';
    
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1> Conoce Sobre Nosotros</h1>
        <div class="sobre-nosotros">
            <div class="imagen">
                <source  srcset="build/img/blog3.webp" type="image/webp"/>
                <source  srcset="build/img/blog3.jpg" type="image/jpg"/>
                <img loading="lazy" alt="" src="build/img/blog3.jpg" alt="imagen sobre nosotros">
            </div>
            <div>
                <h4>25 años de experiencia</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium consequuntur, itaque esse maiores nobis labore facilis fugit ea excepturi alias repellendus eveniet sint iste nulla 
                    doloremque suscipit delectus ducimus saepe!</p>
            </div>
        </div>
    </main>
    <section class="contenedor seccion contenido-centrado">
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
    </section>
<?php 
    incluirTemplates('footer');
?>