<?php 
    require '../../includes/app.php';
    use App\Vendedor;
    // estaAutenticado();
    incluirTemplates('header');
    $vendedores = Vendedor::all();
    $errores = Vendedor::getErrores();
    
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        
    }
?>
    <main class="contenedor seccion">
        <h1>Actualizar Vendedor</h1>
        <a href="/admin/index.php" class="boton boton-verde">Administrador</a>
        <?php foreach($errores as $error):?>
            <div class = "alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach;?>
        <form class="formulario" method="POST" action="/admin/vendedores/actualizar.php">
            <?php require('../../includes/templates/formulario_vendedores.php');?>
            <input type="submit" class="boton boton-verde" value="Guardar Cambios"/>
        </form>
    </main>
<?php 
    incluirTemplates('footer');
?>