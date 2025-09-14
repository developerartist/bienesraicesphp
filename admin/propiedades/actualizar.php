<?php 
    use App\Propiedad;
    require '../../includes/app.php';
    estaAutenticado();

    $id = $_GET["p"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header('Location : /admin');
    }
    $propiedad = Propiedad::find($id);

    $query[1] = "SELECT * FROM vendedores;";
    $vendedor_query = mysqli_query($db, $query[1]);
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $errores = $propiedad->validar();
        
        if($errores){
            /*SUBIDA DE ARCHIVOS*/
            //Crear carpeta

            $carpeta_imagenes = '../../imagenes';
            if(!is_dir($carpeta_imagenes)){
                mkdir($carpeta_imagenes);
            }
            $nombre_imagen = '';
            if( $imagen['name'] ){
                unlink($carpeta_imagenes . '/' .$propiedad->imagen.'.jpg');
                //Generar nombre unico
                $nombre_imagen =  md5(uniqid(rand(), true));
                //Subir imagen  
                move_uploaded_file($imagen["tmp_name"], $carpeta_imagenes . "/". $nombre_imagen .".jpg");
            }else{
                $nombre_imagen = $propiedad->imagen;
            }
            
            
            $query = "UPDATE `bienesraices_crud`.`propiedades` SET `titulo` = '$titulo',`precio` = '$precio', `imagen` = '$nombre_imagen', `descripcion` = '$descripcion', `habitaciones` = $habitaciones,`wc` = $baños,
            `estacionamiento` = $estacionamiento,`creado` = CURRENT_TIMESTAMP(), `vendedores_id` = $vendedor WHERE `id` = $id;";
            $resultado = mysqli_query($db, $query);
            if($resultado){
                header('Location: /admin?resultado=2');
            }
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