<?php 
    require 'includes/funciones.php';
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la Decoración de tu Hogar</h1>
        <p class="informacion-meta">Escrito el <span> 20/10/2021 </span>por <span>Admin</span></p>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp" />
            <source srcset="build/img/destacada.jpg" type="image/jpg" />
            <img src="build/img/destacada.jpg" alt="Imagen Destacada" loading="lazy">
        </picture>

        <div class="resumen-propiedad">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem tempore, enim repellat quo pariatur, veritatis neque quisquam qui earum fugit nihil beatae. Magnam error officiis cupiditate eaque. Iste, soluta aut.</p>
        </div>
    </main>
<?php 
    incluirTemplates('footer');
?>