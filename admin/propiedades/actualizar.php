<?php 
    require '../../includes/funciones.php';
    require '../../includes/templates/config/database.php';
    $auth = estaAutenticado();
    if(!$auth){
        header('Location: /');
    }
    $db = conectarDB();

    $id = $_GET["p"];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header('Location : /admin');
    }
    
    $query[0] = "SELECT * FROM propiedades WHERE id = $id;";
    $propiedad_query = mysqli_query($db, $query[0]);
    $propiedad = mysqli_fetch_assoc($propiedad_query);

    $query[1] = "SELECT * FROM vendedores;";
    $vendedor_query = mysqli_query($db, $query[1]);
    
    $titulo = $propiedad["titulo"];
    $precio = $propiedad["precio"];
    $descripcion = $propiedad["descripcion"];
    $habitaciones = $propiedad["habitaciones"];
    $baños = $propiedad["wc"];
    $estacionamiento = $propiedad["estacionamiento"];
    $vendedor = $propiedad["vendedores_id"];
    $imagen = $propiedad["imagen"];
    $errores = [];

    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        
        $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
        $precio = mysqli_real_escape_string($db, $_POST["precio"]);
        $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
        $baños = mysqli_real_escape_string($db, $_POST["baños"]);
        $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
        $vendedor = mysqli_real_escape_string($db, $_POST["vendedor"]);
        $imagen = $_FILES['imagen'];
        $errores;
        if(!$titulo){
            $errores[] = "Debes añadir un titulo";
        }
        if(!$precio){
            $errores[] = "El precio es obligatorio";
        }
        if(strlen($descripcion) < 50 ){
            $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        if(!$habitaciones){
            $errores[] = "El numero de habitaciones es obligatorio";
        }
        if(!$baños){
            $errores[] = "El numero de baños es obligatorio";
        }
        if(!$estacionamiento){
            $errores[] = "El numero de estacionamiento es obligatorio";
        }
        if($vendedor == ''){
            $errores[] = "Elije un vendedor";
        }
        
        if(empty($errores)){
            /*SUBIDA DE ARCHIVOS*/
            //Crear carpeta

            $carpeta_imagenes = '../../imagenes';
            if(!is_dir($carpeta_imagenes)){
                mkdir($carpeta_imagenes);
            }
            $nombre_imagen = '';
            if( $imagen['name'] ){
                unlink($carpeta_imagenes . '/' .$propiedad['imagen'].'.jpg');
                //Generar nombre unico
                $nombre_imagen =  md5(uniqid(rand(), true));
                //Subir imagen  
                move_uploaded_file($imagen["tmp_name"], $carpeta_imagenes . "/". $nombre_imagen .".jpg");
            }else{
                $nombre_imagen = $propiedad["imagen"];
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

            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo  $precio;?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
                <img src="/imagenes/<?php echo $imagen?>.jpg" class="imagen_small" alt="">                
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Información Propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="baños">WC:</label>
                <input type="number" id="baños" name="baños" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo $baños; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor">
                    <option value="">Selecciona una opción</option>
                    <?php while($vendedor_assoc = mysqli_fetch_assoc($vendedor_query)):?>
                        <option <?php echo $vendedor === $vendedor_assoc["id"]? 'selected':''; ?> value="<?php echo $vendedor_assoc["id"] ?>"><?php echo $vendedor_assoc["nombre"]. " ". $vendedor_assoc["apellido"]?></option>
                    <?php endwhile;?>
                </select>
            </fieldset>
            <input type="submit" class="boton boton-verde" value="Actualizar Propiedad"/>
        </form>
    </main>
<?php 
    incluirTemplates('footer');
?>