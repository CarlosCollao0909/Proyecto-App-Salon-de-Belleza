<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo currentPage('/dashboard') ? 'dashboard__enlace--activo' : ''; ?>">
            <i class="fa-solid fa-house fa-1x"></i>
            <spam class="dashboard__menu-texto">
                Inicio
            </spam>
        </a>
        <a href="/admin/citas" class="dashboard__enlace  <?php echo currentPage('/citas') ? 'dashboard__enlace--activo' : ''; ?>">
            <i class="fa-solid fa-calendar fa-1x"></i>
            <spam class="dashboard__menu-texto">
                Citas
            </spam>
        </a>
        <a href="/admin/servicios" class="dashboard__enlace  <?php echo currentPage('/servicios') ? 'dashboard__enlace--activo' : ''; ?>">
            <i class="fa-solid fa-spray-can-sparkles fa-1x"></i>
            <spam class="dashboard__menu-texto">
                Servicios
            </spam>
        </a>
        <a href="/admin/horarios" class="dashboard__enlace  <?php echo currentPage('/horarios') ? 'dashboard__enlace--activo' : ''; ?>">
            <i class="fa-solid fa-clock fa-1x"></i>
            <spam class="dashboard__menu-texto">
                Horarios
            </spam>
        </a>
        <a href="/admin/clientes" class="dashboard__enlace  <?php echo currentPage('/clientes') ? 'dashboard__enlace--activo' : ''; ?>">
            <i class="fa-solid fa-users fa-1x"></i>
            <spam class="dashboard__menu-texto">
                Clientes
            </spam>
        </a>
        <a href="/admin/formas_pagos" class="dashboard__enlace  <?php echo currentPage('/formas_pagos') ? 'dashboard__enlace--activo' : ''; ?>">
            <i class="fa-solid fa-qrcode fa-1x"></i>
            <spam class="dashboard__menu-texto">
                pagos
            </spam>
        </a>
    </nav>
</aside>