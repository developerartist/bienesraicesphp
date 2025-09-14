            <fieldset>
            <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo sA($propiedad->titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo  sA($propiedad->precio);?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
                <?php if($propiedad->imagen):?>
                    <img src="imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small" />
                <?php endif; ?>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo sA($propiedad->descripcion); ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Información Propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo sA($propiedad->habitaciones); ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo sA($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo sA($propiedad->estacionamiento); ?>">
            </fieldset>

            <!-- <fieldset>
                <legend>Vendedor</legend> <?php #while($vendedor_assoc = mysqli_fetch_assoc($resultado1)):?>
                <select name="vendedorId" value="<?php #echo $vendedor_assoc["id"] ?>">
                    <option >Selecciona una opción</option>
                        <option <?php #echo $vendedor === $vendedor_assoc["id"]? 'selected':''; ?> value="<?php #echo $vendedor_assoc["id"] ?>"><?php #echo $vendedor_assoc["nombre"]. " ". $vendedor_assoc["apellido_paterno"]?></option>
                    <?php #endwhile;?>
                </select>
            </fieldset> -->
