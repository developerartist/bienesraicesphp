<?php 
    require '../../includes/app.php';
    use App\Vendedor;
    // estaAutenticado();
    incluirTemplates('header');
    $vendedores = Vendedor::all();
    $errores = Vendedor::getErrores();
    
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $vendedores = new Vendedor($_POST["vendedor"]);
        
        $errores = $vendedores->validar();

        if(empty($errores)){
            $vendedores->guardar();
        }
    }
?>
    <main class="contenedor seccion">
        <h1>Crear Vendedor</h1>
        <a href="/admin/index.php" class="boton boton-verde">Administrador</a>
        <?php foreach($errores as $error):?>
            <div class = "alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach;?>
        <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
            <?php require('../../includes/templates/formulario_vendedores.php');?>
            <input type="submit" class="boton boton-verde" value="Registrar Vendedor"/>
        </form>
    </main>
<?php 
    incluirTemplates('footer');
?>