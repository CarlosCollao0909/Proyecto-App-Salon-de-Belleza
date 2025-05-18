<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salón de Belleza LIZMAR - Administración</title>
    <script src="https://kit.fontawesome.com/6a521e9758.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body class="body-admin dashboard">

    <?php include_once __DIR__ . '/templates/adminHeader.php'; ?>
    <div class="dashboard__grid">
        <?php include_once __DIR__ . '/templates/adminSidebar.php'; ?>

        <main class="dashboard__contenido">
            <?php echo $contenido; ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/build/js/appAdmin.js"></script>
    <?php echo $script ?? ''; ?>
</body>

</html>