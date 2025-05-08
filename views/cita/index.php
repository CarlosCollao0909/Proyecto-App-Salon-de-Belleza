<?php $imagenQR = '' ?>
<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<div class="barra">
    <p>Hola! <?php echo $nombre ?? ''; ?></p>
    <a class="logout-icon" href="/logout">
        <i class="fa-solid fa-right-from-bracket fa-2x"></i>
    </a>
</div>

<div id="app">
    <nav class="tabs">
        <button type="button" data-paso="1" class="activo">Servicios</button>
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Forma de Pago</button>
        <button type="button" data-paso="4">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Información de la Cita</h2>
        <p class="text-center">Coloca la información de tu cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu Nombre" name="nombre" value="<?php echo $nombre; ?>" disabled>
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" onkeydown="return false">
            </div>
            <div class="campo">
                <label for="horarios">Horarios Disponibles</label>
                <select id="horarios" name="horarios">
                    <option value=""> -- Selecciona un Horario -- </option>
                </select>
            </div>
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
        </form>
    </div>

    <div id="paso-3" class="seccion">
        <h2>Forma de Pago</h2>
        <p class="text-center">Elige tu forma de pago</p>
        <div class="pagos">
            <div class="pagos__metodo">
                <?php foreach ($formasPago as $formaPago): ?>
                    <div class="pagos__metodo-radio">
                        <label for="<?php echo $formaPago->tipo ?>">Pago <?php echo $formaPago->tipo; ?> </label>
                        <input type="radio" name="pago" value="<?php echo $formaPago->id; ?>" id="<?php echo $formaPago->tipo ?>">
                        <input type="hidden" name="formaPago" value="<?php echo $formaPago->id; ?>">
                        <?php 
                            if ($formaPago->id === '2') {
                                $imagenQR = $formaPago->imagenQR;
                            }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="informacion__pago" id="informacion__pago" data-qr-url="<?php echo $imagenQR; ?>"></div>
    </div>

    <div id="paso-4" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

<?php
$script = "
        <script src='build/js/app.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='https://kit.fontawesome.com/6a521e9758.js' crossorigin='anonymous'></script>
    ";
?>