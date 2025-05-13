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
                <?php foreach($horarios as $horario): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $horario->horaInicio; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $horario->horaFin; ?>
                        </td>
                        <td class="table__td--acciones">
                            <form class="table__formulario" method="POST" action="/admin/servicios/eliminar">
                                <input type="hidden" name="id" value="<?php echo $horario->id; ?>">
                                <button type="submit" class="table__accion table__accion--eliminar">
                                    <i class="fa-solid fa-eye-slash"></i>
                                    Deshabilitar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p class="text-center">No hay servicios registrados</p>
    <?php endif; ?>
</div>