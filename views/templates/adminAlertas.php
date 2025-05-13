<?php 
    foreach($alertas as $key => $mensajes):
        foreach($mensajes as $mensaje):
?>
    <div class="alerta-admin alerta-admin__<?php echo $key; ?>">
        <?php echo $mensaje; ?>
    </div>
<?php 
        endforeach;
    endforeach;
?>