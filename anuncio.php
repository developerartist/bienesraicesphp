<?php 
    require 'includes/funciones.php';
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <?php 
            include '../bienesraices_inicio/includes/templates/anuncio.php';
        ?>
        
    </main>
<?php 
    incluirTemplates('footer');
    mysqli_close($db);
?>