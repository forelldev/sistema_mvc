<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/notis.css?v=<?= time(); ?>">
</head>
<body class="body-main">
  <!-- Header -->
<header class="header-main d-flex justify-content-between align-items-center px-4 py-3">
  <div class="d-flex flex-column">
    <h5 class="mb-0 fw-semibold">Sistema de Solicitud de Ayudas</h5>
    <span class="rol-label small">Rol: <?= $_SESSION['rol'] ?></span>
  </div>

  <div class="d-flex align-items-center gap-3">
    <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4) { ?>
      <a href="<?= BASE_URL ?>/nueva_solicitud" class="btn btn-sm btn-black-borde">
        <i class="fas fa-plus"></i> Nueva Solicitud
      </a>
    <?php } elseif ($_SESSION['id_rol'] == 2) { ?>
      <a href="<?= BASE_URL ?>/despacho_busqueda" class="btn btn-sm btn-black-borde">
        <i class="fas fa-plus"></i> Nueva Solicitud
      </a>
    <?php } ?>
  <div class="position-relative me-3">
  <button id="btn-notificaciones" class="btn btn-sm btn-outline-light position-relative rounded-circle shadow-sm" style="width: 40px; height: 40px;">
    <i class="fas fa-bell fs-5 text-white"></i>
    <span id="badge-noti" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">
      0
    </span>
  </button>

  <div id="barra-notificaciones" class="dropdown-menu dropdown-menu-end p-3 shadow-lg mt-2" style="min-width: 320px; max-height: 400px; overflow-y: auto;">
    <!-- Contenido dinámico por JS -->
  </div>
</div>

  </div>
</header>


  <!-- Contenedor horizontal: nav + main -->
<div class="d-flex" style="height: calc(100vh - 72px);">

    <!-- Sidebar -->
<nav class="border-end p-3" style="width: 240px;">
  <div class="accordion-menu d-flex flex-column gap-3">

    <!-- Solicitudes -->
    <div class="accordion-item">
      <button class="accordion-toggle">
        <i class="fas fa-folder-open me-2"></i> Solicitudes
      </button>
      <div class="accordion-content">
        <a class="dropdown-item" href="<?= BASE_URL ?>/solicitudes_list">
          <i class="fas fa-folder-open me-2"></i> Solicitudes de Ayuda
        </a>
        <?php if ($_SESSION['id_rol'] == 4 || $_SESSION['id_rol'] == 1) { ?>
          <a class="dropdown-item" href="<?= BASE_URL ?>/solicitudes_desarrollo">
            <i class="fas fa-folder-open me-2"></i> Desarrollo Social
          </a>
        <?php } ?>
        <?php if ($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4 || $_SESSION['id_rol'] == 3) { ?>
          <a class="dropdown-item" href="<?= BASE_URL ?>/despacho_list">
            <i class="fas fa-folder-open me-2"></i> Despacho
          </a>
        <?php } ?>
      </div>
    </div>

    <!-- Menú administrativo -->
    <?php if ($_SESSION['id_rol'] == 4) { ?>
      <div class="accordion-item">
        <button class="accordion-toggle">
          <i class="fas fa-bars me-2"></i> Menú
        </button>
        <div class="accordion-content">
          <a class="dropdown-item" href="<?= BASE_URL ?>/beneficiarios_lista">
            <i class="fas fa-users me-2"></i> Beneficiarios
          </a>
          <a class="dropdown-item" href="<?= BASE_URL ?>/registro">
            <i class="fas fa-user-plus me-2"></i> Registrar Usuario
          </a>
          <a class="dropdown-item" href="<?= BASE_URL ?>/reportes_acciones">
            <i class="fas fa-file-alt me-2"></i> Reportes de Acciones
          </a>
          <a class="dropdown-item" href="<?= BASE_URL ?>/reportes">
            <i class="fas fa-chart-bar me-2"></i> Reportes
          </a>
          <a class="dropdown-item" href="<?= BASE_URL ?>/limites">
            <i class="fas fa-user-shield me-2"></i> Límite por rol
          </a>
        </div>
      </div>

      <!-- Estadísticas -->
      <div class="accordion-item">
        <button class="accordion-toggle">
          <i class="fas fa-chart-bar me-2"></i> Estadísticas
        </button>
        <div class="accordion-content">
          <a class="dropdown-item" href="<?= BASE_URL ?>/estadisticas">
            <i class="fas fa-chart-bar me-2"></i> Generales
          </a>
          <a class="dropdown-item" href="<?= BASE_URL ?>/estadisticas_solicitudes_desarrollo">
            <i class="fas fa-chart-bar me-2"></i> Desarrollo
          </a>
          <a class="dropdown-item" href="<?= BASE_URL ?>/estadisticas_solicitudes_despacho">
            <i class="fas fa-chart-bar me-2"></i> Despacho
          </a>
        </div>
      </div>
    <?php } ?>

    <!-- Usuario -->
    <div class="accordion-item mt-auto">
      <button class="accordion-toggle">
        <i class="fas fa-user me-2"></i> Usuario
      </button>
      <div class="accordion-content">
        <a class="dropdown-item" href="<?= BASE_URL ?>/config_user">
          <i class="fas fa-cog me-2"></i> Configuración
        </a>
        <?php if($_SESSION['id_rol'] == 4){?>
          <a class="dropdown-item" href="<?= BASE_URL ?>/respaldar">
              <i class="fas fa-database me-2"></i> Respaldar datos
          </a>
        <?php } ?>
        <a class="dropdown-item" href="<?= BASE_URL ?>/logout">
          <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
        </a>
      </div>
    </div>

  </div>
</nav>


    <main class="main-bg">
      <div class="container py-5">
        <?php if(!isset($_SESSION['bienvenida'])){ ?>
          <div class="card bg-white bg-opacity-75 shadow-sm">
            <div class="card-body">
              <h5 class="card-title text-dark">Bienvenido <?=($nombre ?? '...')?>!</h5>
              <p class="card-text text-dark">Tú última entrada fue el <?=($dia_ordenado ?? '...' )?>.</p>
            </div>
          </div>
        <?php $_SESSION['bienvenida'] = 1; } ?>
        <br>
        <div class="card bg-white bg-opacity-75 shadow-sm">
          <div class="card-body">
            <h5 class="card-title text-dark">Alcaldía del Municipio Peña.</h5>
            <?php  date_default_timezone_set('America/Caracas'); ?>
            <p class="card-text text-dark">Fecha: <?= date('d-m-Y')?>.</p>
          </div>
        </div>
          <br>
            <div id="novedades" class="card bg-white bg-opacity-75 shadow-sm" style="display:none;">
              <div class="card-body">
                <h5 class="card-title text-dark">Hay actividades nuevas!</h5>
                <p class="card-text text-dark">Puedes verlas en notificaciones.</p>
              </div>
            </div>
      </div>
    </main>


<!-- Chat flotante -->
<div id="ia-container">
<div id="chat-toggle" class="position-fixed bottom-0 end-0 m-4 z-3">
  <button class="btn btn-peach shadow" onclick="toggleChat()">
    <i class="fa fa-comments me-1"></i> Habla con la IA
  </button>
</div>

<div id="chat-box" class="chat-box d-none position-fixed bottom-0 end-0 m-4 shadow rounded-3 overflow-hidden" style="width: 320px; height: 420px; background-color: white; border-left: 4px solid #f5a97f;">
  <!-- Encabezado -->
  <div class="bg-dark text-white px-3 py-2 d-flex justify-content-between align-items-center">
    <span class="fw-semibold">Chat con IA</span>
    <button class="btn btn-sm btn-light" onclick="toggleChat()"><i class="fa fa-times"></i></button>
  </div>

  <!-- Mensajes -->
  <div id="chat-messages" class="flex-grow-1 px-3 py-2 overflow-auto" style="height: 280px; background-color: #f8f9fa;">
    <!-- Mensajes se insertarán aquí -->
  </div>

  <!-- Input -->
  <form class="border-top px-3 py-2 bg-white" onsubmit="enviarMensaje(event)" autocomplete="off">
    <div class="input-group">
      <input type="text" id="chat-input" class="form-control" placeholder="Envía un mensaje para comenzar..." required>
      <button class="btn btn-dark" type="submit"><i class="fa fa-paper-plane"></i></button>
    </div>
  </form>
</div>
</div>


</body>
<script src="<?= BASE_URL ?>/public/js/prueba_conexion.js"></script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
    const BASE_URL = "<?php echo BASE_URL; ?>";
</script>
<script src="<?=BASE_URL?>/public/js/chat.js"></script>
<script src="<?=BASE_URL?>/public/js/chat_grafico.js"></script>
<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<?php
$mensaje = $msj ?? ($_GET['msj'] ?? null);
if ($mensaje):
?>
    <script>
        mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 3000);
    </script>
<?php endif; ?>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/noti_main.js"></script>
<script src="<?= BASE_URL ?>/public/js/desplegables.js"></script>
<script src="<?= BASE_URL ?>/public/js/notificacion_main.js"></script>
</html>