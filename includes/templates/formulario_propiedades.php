            <fieldset>
            <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo de la propiedad" value="<?php echo isset($propiedad->titulo) ? sA($propiedad->titulo) : ''; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio de la propiedad" value="<?php echo isset ($propiedad->precio) ? sA($propiedad->precio):''; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">
                <?php if(isset($propiedad->imagen)):?>
                    <img src="imagenes/<?php echo isset($propiedad->imagen) ? $propiedad->imagen:'' ?>" class="imagen-small" />
                <?php endif; ?>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="propiedad[descripcion]"><?php echo isset($propiedad->descripcion) ? sA($propiedad->descripcion): ''; ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Información Propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo isset($propiedad->imagen) ? sA($propiedad->habitaciones) : ''; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="propiedad[wc]" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo isset($propiedad->imagen) ? sA($propiedad->wc): ''; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ejemplo 3" min="1" max="9" value="<?php echo isset($propiedad->imagen) ? sA($propiedad->estacionamiento) : ''; ?>">
            </fieldset>
