<h1 class="nombre-pagina">Clientes Registrados</h1>

<div class="dashboard__contenedor">
    <?php if (!empty($clientes)): ?>
        <table class="table" id="myTable">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Email</th>
                    <th scope="col" class="table__th">Telefono</th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($clientes as $cliente): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $cliente->nombre . ' ' . $cliente->apellido; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $cliente->email; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $cliente->telefono; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p class="text-center">No hay clientes registrados</p>
    <?php endif; ?>
</div>