<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salón de Belleza LIZMAR - Administración</title>
    <script src="https://kit.fontawesome.com/6a521e9758.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body class="dashboard">

    <?php include_once __DIR__ . '/templates/adminHeader.php'; ?>
    <div class="dashboard__grid">
        <?php include_once __DIR__ . '/templates/adminSidebar.php'; ?>

        <main class="dashboard__contenido">
            <?php echo $contenido; ?>
        </main>
    </div>

    <?php echo $script ?? ''; ?>
</body>

</html>