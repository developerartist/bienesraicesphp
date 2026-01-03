<?php
    require '../includes/app.php';
    // estaAutenticado();
    use App\Propiedad;
    use App\Vendedor;

    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    #Incluye un template
    incluirTemplates('header');
    #Muestra mensaje condicional
    $resultadoheader = $_GET["resultado"] ?? null;
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $tipo = $_POST["tipo"];
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(validarEntidad($tipo)){
            if($tipo === 'Propiedad'){
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();
            }else if($tipo === "Vendedor"){
                $vendedor  = Vendedor::find($id);
                $vendedor->eliminar();
            }
        }
    }
?>
    <main class="contenedor seccion">
        <h1>Administrador</h1>
        <?php if( intval($resultadoheader) === 1): ?>
            <p class="alerta exito">Creado Exitosamente</p>
        <?php elseif( intval( $resultadoheader ) === 2):?>
            <p class="alerta exito">Actualizado Correctamente</p>
        <?php elseif( intval( $resultadoheader ) === 3):?>
            <p class="alerta exito">Eliminado Correctamente</p>
        <?php endif;?>
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Crear</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Crear Vendedor</a>
        <h2>Propiedades</h2>
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
                    <td><img src="/imagenes/<?php echo $propiedad->imagen?>" alt="Imagen de propiedad" class="imagen_tabla"></td>
                    <td><p>$ <?php echo $propiedad->precio?></p></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="Propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/actualizar.php?p=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>TELEFONO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vendedores as $vendedor):?>
                <tr>
                    <td><p><?php echo $vendedor->id?></p></td>
                    <td><p><?php echo $vendedor->nombre ." ". $vendedor->apellido?></p></td>
                    <td><p><?php echo $vendedor->telefono?></p></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="Vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/vendedores/actualizar.php?p=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </main>
<?php 
    incluirTemplates('footer');
?>