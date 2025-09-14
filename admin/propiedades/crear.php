<?php 
    require '../../includes/app.php';
    use App\Propiedad;
    use Intervention\Image\ImageManager;
    use Intervention\Image\Drivers\Gd\Driver;
    // estaAutenticado();
    incluirTemplates('header');
    
    $db = conectarDB();
    //consulta para obtener los vendedores
    $query[1] = "SELECT * FROM vendedores";
    $resultado1 = mysqli_query($db, $query[1]);
    $errores = Propiedad::getErrores();
    
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        
        $propiedad = new Propiedad($_POST);
        //Generar nombre unico
		$nombre_imagen = md5(uniqid(rand(), true)).'.jpg';	
        if($_FILES['imagen']['tmp_name']){
            $manager = new ImageManager(Driver::class);
            $imageIntervention = $manager->read($_FILES['imagen']['tmp_name'])->cover(800, 600);
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
            $resultado = $propiedad->guardarPropiedad();
            if($resultado){
				header('Location : /admin?resultado=1');
			}
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