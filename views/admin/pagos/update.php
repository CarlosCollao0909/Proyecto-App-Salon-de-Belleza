<h1 class="nombre-pagina-admin">Actualizar Codigo QR</h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/pagos">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../../templates/adminAlertas.php' ?>

    <form method="POST" class="formulario-admin">
        <fieldset class="formulario-admin__fieldset">
            <legend class="formulario-admin__legend">Información de la Forma de Pago</legend>

            <div class="formulario-admin__campo">
                <label for="tipo" class="formulario-admin__label">Tipo</label>
                <input type="text" id="tipo" name="tipo" class="formulario-admin__input" value="<?php echo s($formaPago->tipo) ?? ''; ?>" readonly>
            </div>

            <div class="formulario-admin__campo">
                <label for="imagenQR" class="formulario-admin__label">Imagen Codigo QR</label>
                <input type="file" id="imagenQR" name="imagenQR" class="formulario-admin__input--file">
                <img src="/images/QR/<?php echo $formaPago->imagenQR; ?>" alt="Codigo QR" class="formulario-admin__imagen">
            </div>
        </fieldset>
        <input type="submit" value="Guardar Cambios" class="formulario-admin__submit">
    </form>
</div>