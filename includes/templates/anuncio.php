<?php 
    require 'includes/templates/config/database.php';
    $db = conectarDB();

    if($_SERVER["REQUEST_METHOD"] === 'GET'){
        $id = $_GET['propiedad'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $query = "SELECT * FROM propiedades WHERE id = $id;";
        $resultado = mysqli_query($db, $query);
        $resultado = mysqli_fetch_assoc($resultado);

    }
?>
<picture>
    <img src="/imagenes/<?php echo $resultado["imagen"]?>.jpg" alt="Imagen Destacada" loading="lazy">
</picture>

<div class="resumen-propiedad">
    <p class="precio">$ <?php echo $resultado["precio"]?></p>

    <ul class="iconos-caracteristicas">
        <li>
            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
            <p><?php echo $resultado["wc"]?></p>
        </li>
        <li>
            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
            <p><?php echo $resultado["estacionamiento"]?></p>
        </li>
        <li>
            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
            <p><?php echo $resultado["habitaciones"]?></p>
        </li>
    </ul>

    <p><?php echo $resultado["descripcion"]?></p>
</div>