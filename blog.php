<?php 
    require 'includes/app.php';
    
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Nuestro Blog</h1>
        <div class="blog">
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
                        <p>Escrito el: <span>20/10/2025</span> por <span>Admin</span></p>
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
                        <p>Escrito el: <span>20/10/2025</span> por <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
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
                        <p>Escrito el: <span>20/10/2025</span> por <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
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
                        <p>Escrito el: <span>20/10/2025</span> por <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                    </a>
                </div>
            </article>
        </div>
    </main>
<?php 
    incluirTemplates('footer');
?>