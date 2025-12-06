<?php 
    use App\Propiedad;
    use Intervention\Image\ImageManager;
    use Intervention\Image\Drivers\Gd\Driver;
    require '../../includes/app.php';
    estaAutenticado();

    $id = $_GET["p"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header('Location : /admin');
    }

    $propiedad = Propiedad::find($id);
    $errores = $propiedad->getErrores();

    $query[1] = "SELECT * FROM vendedores;";
    $vendedor_query = mysqli_query($db, $query[1]);
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $args = [];
        $args = $_POST["propiedad"] ?? null;

        $propiedad->sincronizar($args);
        $errores = $propiedad->validar();
        
        $nombre_imagen = md5(uniqid(rand(), true)).'.jpg';	
        if($_FILES["propiedad"]["tmp_name"]["imagen"]){
            
            $manager = new ImageManager(new Driver());
            $imageIntervention = $manager->read($_FILES["propiedad"]["tmp_name"]["imagen"])->cover(800, 600);
			$propiedad->setImage($nombre_imagen);
		}

        if(empty($errores)){
            $imageIntervention->save(CARPETA_IMAGENES . $nombre_imagen);
            $propiedad->guardar();
        }
        
    }
    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Editar</h1>
        <a href="/admin/index.php" class="boton boton-verde">Administrador</a>
        <?php foreach($errores as $error):?>
            <div class = "alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach;?>
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php require('../../includes/templates/formulario_propiedades.php');?>
            <input type="submit" class="boton boton-verde" value="Actualizar Propiedad"/>
        </form>
    </main>
<?php 
    incluirTemplates('footer');
?>