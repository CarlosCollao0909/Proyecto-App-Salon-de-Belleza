<h1 class="nombre-pagina">Formas de Pago</h1>

<div class="dashboard__contenedor">
    <?php if (!empty($formaPagos)): ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Tipo</th>
                    <th scope="col" class="table__th">Codigo QR</th>
                    <th scope="col" class="table__th">Acciones</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($formaPagos as $formaPago): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $formaPago->tipo; ?>
                        </td>
                        <?php if($formaPago->imagenQR != 'No corresponde'): ?>
                            <td class="table__td">
                                QR Asignado
                            </td>
                            <td class="table__td--acciones">
                                <button class="table__accion table__accion--ver">
                                    <i class="fa-solid fa-qrcode"></i>
                                    Ver QR
                                </button>
                                <a href="/admin/pagos/editar?id=<?php echo $formaPago->id; ?>" class="table__accion table__accion--editar">
                                    <i class="fa-solid fa-file-pen"></i>
                                    Actualizar QR
                                </a>
                            </td>
                            <?php else: ?>
                                <td class="table__td">
                                    <?php echo $formaPago->imagenQR; ?>
                                </td>
                                <td class="table__td--acciones">
                                    
                                </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p class="text-center">No hay formas de pago registradas</p>
    <?php endif; ?>
</div>