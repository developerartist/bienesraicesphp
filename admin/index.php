<?php
    require '../includes/app.php';
    estaAutenticado();
    use App\Propiedad;
    $propiedades = Propiedad::all();

    #Incluye un template
    incluirTemplates('header');
    #Muestra mensaje condicional
    $resultadoheader = $_GET["resultado"] ?? null;
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $query = "SELECT imagen FROM propiedades WHERE id = $id;";
        $resultadoimagen = mysqli_query($db, $query);
        $resultadoimagen = mysqli_fetch_assoc($resultadoimagen);
        if($id){
            $query_delete = "DELETE FROM propiedades WHERE id = $id;";
            $resultado_query_delete = mysqli_query($db, $query_delete);
            if( $resultado_query_delete ){
                unlink('../imagenes/'.$resultadoimagen['imagen'].'.jpg');
                header('Location: /admin?resultado=3');

            }
        }
    }
?>
    <main class="contenedor seccion">
        <h1>Administrador</h1>
        <?php if( intval($resultadoheader) === 1): ?>
            <p class="alerta exito">Anuncio Creado</p>
        <?php elseif( intval( $resultadoheader ) === 2):?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif( intval( $resultadoheader ) === 3):?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif;?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Crear</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TITULO</th>
                    <th>IMAGEN</th>
                    <th>PRECIO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($propiedades as $propiedad):?>
                <tr>
                    <td><p><?php echo $propiedad->id?></p></td>
                    <td><p><?php echo $propiedad->titulo?></p></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen?>.jpg" alt="Imagen de propiedad" class="imagen_tabla"></td>
                    <td><p>$ <?php echo $propiedad->precio?></p></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/actualizar.php?p=<?php echo $propiedad->id?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </main>
<?php 
    incluirTemplates('footer');
    mysqli_close($db);  
?>