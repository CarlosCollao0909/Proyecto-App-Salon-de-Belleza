<h1 class="nombre-pagina-admin">Actualizar Codigo QR</h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/formas_pagos">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../../templates/adminAlertas.php' ?>

    <form method="POST" class="formulario-admin" enctype="multipart/form-data">
        <fieldset class="formulario-admin__fieldset">
            <legend class="formulario-admin__legend">Información de la Forma de Pago</legend>

            <div class="formulario-admin__campo">
                <label for="tipo" class="formulario-admin__label">Tipo</label>
                <input type="text" id="tipo" name="tipo" class="formulario-admin__input" value="<?php echo s($formaPago->tipo) ?? ''; ?>" disabled>
            </div>

            <div class="formulario-admin__campo">
                <label for="imagenQR" class="formulario-admin__label">Imagen Codigo QR</label>
                <input type="file" id="imagenQR" name="imagenQR" class="formulario-admin__input--file" accept="image/*">
                <div class="formulario-admin__campo-contenedor">
                    <p class="formulario-admin__texto-preview" id="preview">No se ha seleccionado ninguna imagen</p>
                    <img alt="Codigo QR" class="formulario-admin__imagen">
                </div>
            </div>
        </fieldset>
        <input type="submit" value="Guardar Cambios" class="formulario-admin__submit">
    </form>
</div>

<script>
    // Script para mostrar una vista previa de la imagen del código QR
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar elementos del DOM
        const inputImagenQR = document.querySelector('#imagenQR');
        const imagenPreview = document.querySelector('.formulario-admin__imagen');
        const preview = document.querySelector('#preview');

        // Evento para cuando se selecciona un archivo
        inputImagenQR.addEventListener('change', function() {
            const archivoSeleccionado = this.files[0];

            // Verificar si se seleccionó un archivo
            if (archivoSeleccionado) {
                // Crear un objeto FileReader
                const fileReader = new FileReader();

                // Configurar el evento para cuando termine de leer
                fileReader.addEventListener('load', function() {
                    // Establecer la fuente de la imagen como la URL de datos
                    imagenPreview.src = this.result;

                    // Mostrar la imagen (en caso de que estuviera oculta)
                    imagenPreview.style.display = 'block';
                    preview.style.display = 'none';
                });

                // Leer el archivo como URL de datos
                fileReader.readAsDataURL(archivoSeleccionado);
            } else {
                // Si no hay archivo seleccionado, ocultar la imagen
                imagenPreview.src = '';
                imagenPreview.style.display = 'none';
                preview.style.display = 'block';
            }
        });

        // Comprobación inicial: si la imagen ya tiene un src (por ejemplo, al editar)
        if (!imagenPreview.getAttribute('src') || imagenPreview.getAttribute('src') === '') {
            imagenPreview.style.display = 'none';
        }
    });
</script>