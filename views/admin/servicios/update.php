<h1 class="nombre-pagina">Editar Servicio</h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/servicios">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php include_once __DIR__ . '/../../templates/adminAlertas.php' ?>

    <form method="POST" class="formulario-admin">

        <?php include_once 'formulario.php' ?>

        <input type="submit" value="Guardar Cambios" class="formulario-admin__submit">
    </form>
</div>