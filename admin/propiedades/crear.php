<?php 
    require '../../includes/app.php';
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManager;
    use Intervention\Image\Drivers\Gd\Driver;
    // estaAutenticado();
    incluirTemplates('header');
    $propiedad = Propiedad::all();
    $vendedores = Vendedor::all();
    $errores = Propiedad::getErrores();
    
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        
        $propiedad = new Propiedad($_POST['propiedad']);
        //Generar nombre unico
		$nombre_imagen = md5(uniqid(rand(), true)).'.jpg';	
        // debuggear($_FILES['propiedad']['tmp_name']['imagen']);
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $manager = new ImageManager(Driver::class);
            $imageIntervention = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
			$propiedad->setImage($nombre_imagen);
		}
		$errores = $propiedad->validar();
		
        if(empty($errores)){
			/*SUBIDA DE ARCHIVOS*/
            //Crear carpeta
            if(!is_dir(CARPETA_IMAGENES)){
				mkdir(CARPETA_IMAGENES);
            }
            //Subir imagen  
			$imageIntervention->toJpeg(75)->save(CARPETA_IMAGENES.$nombre_imagen);
            $propiedad->guardar();
        }
    }
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin/index.php" class="boton boton-verde">Administrador</a>
        <?php foreach($errores as $error):?>
            <div class = "alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach;?>
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php require('../../includes/templates/formulario_propiedades.php');?>
            <input type="submit" class="boton boton-verde" value="Crear Propiedad"/>
        </form>
    </main>
<?php 
    incluirTemplates('footer');
?>