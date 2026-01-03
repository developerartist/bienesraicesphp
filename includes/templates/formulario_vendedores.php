<fieldset>
<legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del Vendedor" value="<?php echo isset($vendedor->nombre) ? sA($vendedor->nombre) : ''; ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido de Vendedor" value="<?php echo isset ($vendedor->apellido) ? sA($vendedor->apellido):''; ?>">
</fieldset>

<fieldset>
<legend>Información Extra</legend>

    <label for="correo_electronico">E-Mail:</label>
    <input type="e-mail" id="correo_electronico" name="vendedor[correo_electronico]" placeholder="Correo del Vendedor" value="<?php echo isset($vendedor->correo_electronico) ? sA($vendedor->correo_electronico) : ''; ?>">

    <label for="telefono">Telefono:</label>
    <input type="number" id="telefono" name="vendedor[telefono]" placeholder="Telefono de Vendedor" value="<?php echo isset ($vendedor->telefono) ? sA($vendedor->telefono):''; ?>">
</fieldset>