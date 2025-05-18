<h1 class="nombre-pagina">Horarios de Atención</h1>

<div class="dashboard__contenedor">
    <?php if (!empty($horarios)): ?>
        <table class="table" id="myTable">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Hora de Inicio</th>
                    <th scope="col" class="table__th">Hora de Fin</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($horarios as $horario): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $horario->horaInicio; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $horario->horaFin; ?>
                        </td>
                        <td class="table__td--acciones">
                            <button type="button" class="table__accion btn-toggle-estado <?php echo $horario->estado ? 'table__accion--deshabilitar' : 'table__accion--habilitar'; ?>" data-id="<?php echo $horario->id; ?>" data-estado="<?php echo $horario->estado; ?>">
                                <i class="fa-solid <?php echo $horario->estado ? 'fa-eye-slash' : 'fa-eye' ?>"></i>
                                <?php echo $horario->estado ? 'Deshabilitar' : 'Habilitar'; ?>
                            </button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">No hay servicios registrados</p>
    <?php endif; ?>
</div>