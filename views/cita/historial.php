<h1 class="nombre-pagina">Historial de Citas</h1>

<a href="/cita" class="historial">
    <p>¿Deseas crear una nueva cita?</p>
</a>

<div class="barra">
    <p class="barra__saludo">Hola! <?php echo strtolower($nombre) ?? ''; ?></p>
    <a class="logout-icon" href="/logout">
        <i class="fa-solid fa-right-from-bracket fa-2x"></i>
        Cerrar Sesión
    </a>
</div>

<?php foreach ($citas as $cita): ?>
    <div class="card-historial">
        <div class="card-historial__fecha">
            <span>Fecha: </span> <?php echo $cita->fecha; ?>
        </div>
        <div class="card-historial__servicio">
            <span>Servicio: </span> <?php echo strtolower($cita->servicio); ?>
        </div>
        <div class="card-historial__precio">
            <span>Precio: </span> <?php echo $cita->precio; ?>
        </div>
        <div class="card-historial__estado">
            <span>Estado de la cita: </span> <?php echo ucfirst($cita->estado); ?>
        </div>
        <?php if ($cita->fecha > date('Y-m-d', strtotime('-2 day')) && ($cita->estado != 'cancelada')): ?>
            <div class="card-historial__acciones">
                <form class="table__formulario" method="POST" action="/cita/cancelar">
                    <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                    <button type="submit" class="boton--cancelar">
                        Cancelar
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php $script = '<script src="build/js/appCuenta.js"></script>' ?>