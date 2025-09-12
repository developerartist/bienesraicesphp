<?php 
    require '../../includes/app.php';
    use App\Propiedad;
    use Intervention\Image\ImageManager;
    use Intervention\Image\Drivers\Gd\Driver;

    //estaAutenticado();
    
    $db = conectarDB();
    //consulta para obtener los vendedores
    $query[1] = "SELECT * FROM vendedores";
    $resultado1 = mysqli_query($db, $query[1]);
    $errores = Propiedad::getErrores();
    
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        
        $propiedad = new Propiedad($_POST);
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
            //Generar nombre unico
            //Subir imagen  
			$imageIntervention->toJpeg(75)->save(CARPETA_IMAGENES.$nombre_imagen);
            $resultado = $propiedad->guardarPropiedad();
            debuggear($resultado);
            if($resultado){
				header('Location : /admin?resultado=1');
			}
        }
        
    }
    incluirTemplates('header');
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

            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo  $precio;?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
                
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Información Propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo $baños; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
				<?php while($vendedor_assoc = mysqli_fetch_assoc($resultado1)):?>
                <select name="vendedorId" value="<?php echo $vendedor_assoc["id"] ?>">
                    <option >Selecciona una opción</option>
                        <option <?php echo $vendedor === $vendedor_assoc["id"]? 'selected':''; ?> value="<?php echo $vendedor_assoc["id"] ?>"><?php echo $vendedor_assoc["nombre"]. " ". $vendedor_assoc["apellido_paterno"]?></option>
                    <?php endwhile;?>
                </select>
            </fieldset>
            <input type="submit" class="boton boton-verde" value="Crear Propiedad"/>
        </form>
    </main>
<?php 
    incluirTemplates('footer');
?>