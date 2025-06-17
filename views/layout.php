<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salón de Belleza LIZMAR</title>
    <script src="https://kit.fontawesome.com/6a521e9758.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body class="body-cliente">

    <div class="contenedor-app">
        <div class="imagen"></div>
        <div class="app">
            <?php echo $contenido; ?>
        </div>
    </div>

    <?php echo $script ?? ''; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>