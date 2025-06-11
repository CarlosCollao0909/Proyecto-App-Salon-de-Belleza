<h1 class="nombre-pagina">Historial de Citas</h1>

<a href="/cita" class="historial"><p>¿Deseas crear una nueva cita?</p></a>

<div class="barra">
    <p>Hola! <?php echo $nombre ?? ''; ?></p>
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
            <span>Servicio: </span> <?php echo $cita->servicio; ?>
        </div>
        <div class="card-historial__precio">
            <span>Precio: </span> <?php echo $cita->precio; ?>
        </div>
        <div class="card-historial__estado">
            <span>Estado de la cita: </span> <?php echo $cita->estado; ?>
        </div>
        <?php if ($cita->fecha > date('Y-m-d', strtotime('-2 day'))): ?>
            <div class="card-historial__acciones">
                <?php echo (date($cita->fecha) < date('Y-m-d', strtotime('-2 day'))); ?>
                <a href="/cita/cancelar?id=<?php echo $cita->id; ?>" class="dashboard__boton">Cancelar Cita</a>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>