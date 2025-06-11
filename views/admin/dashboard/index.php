<h1 class="nombre-pagina">Reportes</h1>

<div class="dashboard__contenedor">
    <div class="contenedor-cards">
        <div class="card card-primaria">
            <div class="card-icono">
                <i class="fa-solid fa-money-bill-trend-up fa-xl"></i>
            </div>
            <h3>Ingresos Obtenidos en el Mes</h3>
            <div class="card-numero">Bs. <?php echo $ingresosMes->ingresos_mes; ?></div>
        </div>
        <div class="card card-primaria">
            <div class="card-icono">
                <i class="fa-solid fa-users-line fa-xl"></i>
            </div>
            <h3>Clientes Registrados</h3>
            <div class="card-numero"><?php echo $clientesRegistrados->total_clientes; ?></div>
        </div>
        <div class="card card-primaria">
            <div class="card-icono">
                <i class="fa-solid fa-scissors fa-xl"></i>
            </div>
            <h3>Servicios Registrados</h3>
            <div class="card-numero"><?php echo $totalServicios->total_servicios; ?></div>
        </div>
        <div class="card card-primaria">
            <div class="card-icono">
                <i class="fa-solid fa-calendar fa-xl"></i>
            </div>
            <h3>Citas Futuras</h3>
            <div class="card-numero"><?php echo $citasFuturas->citas_futuras; ?></div>
        </div>
    </div>

    <div class="contenedor-graficas">
        <div class="contenedor-graficas__fila contenedor-graficas__fila1">
            <div class="grafica">
                <h3>Ganancias Mensuales</h3>
                <div class="grafica-contenido">
                    <canvas id="graficoMensual"></canvas>
                </div>
            </div>
            <div class="grafica">
                <h3>Ganancias Por Dia</h3>
                <div class="grafica-contenido">
                    <canvas id="graficoDiario"></canvas>
                </div>
            </div>
        </div>

        <div class="contenedor-graficas__fila contenedor-graficas__fila2">
            <div class="grafica">
                <h3>Servicios Mas Solicitados</h3>
                <div class="grafica-contenido">
                    <canvas id="graficoServicios"></canvas>
                </div>
            </div>
            <div class="grafica">
                <h3>Clientes Mas Frecuentes</h3>
                <div class="grafica-contenido">
                    <canvas id="graficoClientes"></canvas>
                </div>
            </div>
            <div class="grafica">
                <h3>Horarios con Mayor Demanda</h3>
                <div class="grafica-contenido">
                    <canvas id="graficoHorarios"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>