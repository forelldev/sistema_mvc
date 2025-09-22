<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="body-main">
    <header class="header">
        <div class="titulo-header">Sistema de Solicitud de Ayudas</div> 
        <div class="header-right">
            <div class="rol">Rol: <?= $_SESSION['rol'] ?></div>
            <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4) { ?>
            <a href="<?= BASE_URL ?>/busqueda" class="nueva-solicitud-btn"><i class="fas fa-plus"></i> Nueva Solicitud</a>
            <?php } ?>
          <button class="notificaciones-btn" id="btn-notificaciones">
                <i class="fas fa-bell"></i> Notificaciones
                <?php
                    $total = 0;
                    foreach ($datos as $grupo) {
                        // Si es un mensaje plano, no es un array de notificaciones
                        if (isset($grupo['mensaje'])) {
                            continue;
                        }
                        $total += count($grupo);
                    }
                    ?>

                    <?php if ($total > 0): ?>
                        <span class="badge"><?= $total ?></span>
                    <?php endif; ?>
                    </button>

                    <div id="barra-notificaciones" class="barra-notificaciones oculto">
                        <ul id="lista-notificaciones" class="notificaciones-lista">
                            <?php if ($total > 0): ?>
                                <?php foreach ($datos as $tipo => $notificaciones): ?>
                                    <?php foreach ($notificaciones as $noti): ?>
                                        <li class="notificacion-item">
                                            <strong><?= ucfirst($tipo) ?>:</strong>
                                            <a href="<?= BASE_URL ?>/noti?id_doc=<?= $noti['id_doc']?>"><?= htmlspecialchars($noti['descripcion'] ?? 'Sin mensaje') ?><br>
                                            <?= htmlspecialchars($noti['estado'] ?? 'Sin mensaje') ?>
                                            <span class="fecha"><?= date('d/m/Y H:i', strtotime($noti['fecha'])) ?></span></a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                                <a href="<?= $_SESSION['id_rol'] == 2 ? 'marcar_vistasDespacho' : 'marcar_vistas' ?>">Marcar todas como vistas</a>
                            <?php else: ?>
                                <li class="notificacion-item">
                                    <strong>Info:</strong> No hay notificaciones disponibles
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>



            

        </div>
    </header>
    <nav class="navbar" aria-label="Menú principal">
        <?php if ($_SESSION['id_rol'] == 4) { ?>
        <div class="dropdown">
            <button class="nav-btn dropdown-toggle" aria-label="Menú" id="menuDropdownBtn">
            <i class="fas fa-bars"></i> Menú
        </button>
        <div class="dropdown-menu" id="menuDropdown">
            
                <a href="<?= BASE_URL ?>/registro">Registrar Persona</a>
                <a href="<?= BASE_URL ?>/reportes_acciones">Reportes de Acciones</a>
                <a href="<?= BASE_URL ?>/reportes">Reportes</a>
                <a href="<?= BASE_URL ?>/limites">Límite por rol</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="nav-btn dropdown-toggle" aria-label="Menú" id="menuDropdownBtn">
            <i class="fas fa-chart-bar"></i> Estadísticas
        </button>
        <div class="dropdown-menu" id="menuDropdown">
            <a href="<?= BASE_URL ?>">Estadísticas de Solicitudes</a>
            <a href="<?= BASE_URL ?>">Estadísticas de Usuarios</a>
        </div>
    </div>
    <?php } ?>
    <div class="dropdown">
        <button class="nav-btn dropdown-toggle" aria-label="Menú" id="menuDropdownBtn">
            <i class="fas fa-folder-open"></i> Solicitudes
        </button>
        <div class="dropdown-menu" id="menuDropdown">
            <a href="<?= BASE_URL ?>/solicitudes_list">Solicitudes de Ayuda</a>
            <?php if ($_SESSION['id_rol'] == 2) { ?>
                <a href="<?= BASE_URL ?>/despacho_list">Solicitudes Despacho</a>
            <?php } ?>
        </div>
    </div>
    <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4) { ?>
    <div class="dropdown">
        <button class="nav-btn dropdown-toggle" aria-label="Menú" id="menuDropdownBtn">
            <i class="fas fa-signal"></i> !!!!!
        </button>
        <div class="dropdown-menu" id="menuDropdown">
    
        <a href="<?= BASE_URL ?>/3er proceso no existe">Falta 3er proceso</a>
    <?php } ?>
        </div>
    </div>
    <div class="dropdown">
        <button class="nav-btn dropdown-toggle" aria-label="Usuario" id="usuarioDropdownBtn">
            <i class="fas fa-user"></i> Usuario
        </button>
        <div class="dropdown-menu" id="usuarioDropdown">
            <a href="<?= BASE_URL ?>/logout">Cerrar Sesión</a>
        </div>
    </div>
    
    </nav>
    
    <main>
        <section class="main-content">
            <div class="card desc-section">
                <h1>Descripción del Programa</h1>
                <p>
                    Este sistema permite gestionar solicitudes de ayuda de manera eficiente, proporcionando herramientas para la administración de usuarios, generación de reportes y estadísticas. Además, facilita la visualización de solicitudes pendientes y su estado, permitiendo a los administradores priorizar y atender las solicitudes de manera oportuna.<br><br>
                    Con una interfaz intuitiva, los usuarios pueden navegar fácilmente por las diferentes secciones del sistema, como la gestión de usuarios, la configuración de perfiles y la consulta de datos relevantes para la toma de decisiones estratégicas.
                </p>
            </div>
            <div class="card img-section">
                <img src="<?= BASE_URL ?>/assets/iss.avif" alt="Ilustración sistema">
            </div>
        </section>
        <section class="novedades">
            <h2>¿Qué hay de nuevo?</h2>
            <ul>
                <li>Se agregó la funcionalidad para marcar solicitudes como vistas.</li>
                <li>Mejoras en la generación de reportes y estadísticas.</li>
                <li>Optimización de la interfaz para dispositivos móviles.</li>
            </ul>
        </section>
    </main>
</body>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/dropdown.js"></script>
<script src="<?= BASE_URL ?>/public/js/notificacionAdministrador.js"></script>

</html>