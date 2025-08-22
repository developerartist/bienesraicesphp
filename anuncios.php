<?php 
    require 'includes/app.php';
    incluirTemplates('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h2>Casas Y Departamentos en Venta</h2>
        <div class="contenedor-anuncios">
            <?php 
                $limite = 10;
                include '../bienesraicesphp/includes/templates/anuncios.php';
                #include '../bienesraices_inicio/includes/templates/anuncios.php';
            ?>
        </div><!--contenedor-anuncio-->
    </main>
<?php 
    incluirTemplates('footer');
?>