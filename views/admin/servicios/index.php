<h1 class="nombre-pagina">Servicios Registrados</h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/servicios/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Servicio
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if (!empty($servicios)): ?>
        <table class="table" id="myTable">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Precio</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($servicios as $servicio): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $servicio->nombre; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $servicio->precio; ?>
                        </td>
                        <td class="table__td--acciones">
                            <a href="/admin/servicios/editar?id=<?php echo $servicio->id; ?>" class="table__accion table__accion--editar">
                                <i class="fa-solid fa-pen"></i>
                                Editar
                            </a>
                            <form class="table__formulario" method="POST" action="/admin/servicios/eliminar">
                                <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                                <button type="submit" class="table__accion table__accion--eliminar">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Eliminar
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
