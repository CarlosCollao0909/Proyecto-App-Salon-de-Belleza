<h1 class="nombre-pagina">Formas de Pago</h1>

<div class="dashboard__contenedor">
    <?php if (!empty($formaPagos)): ?>
        <table class="table" id="myTable">
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
                                <a href="#modal-<?php echo $formaPago->id; ?>" class="table__accion table__accion--ver">
                                    <i class="fa-solid fa-qrcode"></i>
                                    Ver QR
                                </a>
                                <a href="/admin/formas_pagos/actualizar_qr?id=<?php echo $formaPago->id; ?>" class="table__accion table__accion--editar">
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

<!-- Ventana Modal -->
<?php foreach($formaPagos as $formaPago): ?>
    <?php if($formaPago->imagenQR != 'No corresponde'): ?>
        <div id="modal-<?php echo $formaPago->id; ?>" class="modal">
            <div class="modal__contenido">
                <a href="#" class="modal__cerrar">&times;</a>
                <h2 class="modal__titulo">Código QR Asignado</h2>
                <img loading="lazy" class="modal__imagen" src="/images/QR/<?php echo $formaPago->imagenQR; ?>" alt="Código QR">
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>