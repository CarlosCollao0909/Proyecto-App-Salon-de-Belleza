<fieldset class="formulario-admin__fieldset">
    <legend class="formulario-admin__legend">Información del Servicio</legend>

    <div class="formulario-admin__campo">
        <label for="nombre" class="formulario-admin__label">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre del Servicio" class="formulario-admin__input" value="<?php echo s($servicio->nombre) ?? ''; ?>">
    </div>

    <div class="formulario-admin__campo">
        <label for="nombre" class="formulario-admin__label">Precio</label>
        <input type="text" id="precio" name="precio" placeholder="Precio del Servicio" class="formulario-admin__input" value="<?php echo s($servicio->precio) ?? ''; ?>">
    </div>
</fieldset>