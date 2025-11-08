<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/compartido.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body bg-dark text-white">
  <header class="header bg-secondary text-white py-3 px-4 d-flex justify-content-between align-items-center">
    <div class="titulo-header h4 m-0">Sistema de Solicitud de Ayudas</div>
    <div class="header-right">
      <div class="rol small">Rol: <?= $_SESSION['rol'] ?></div>
    </div>
  </header>

  <div class="container my-5">
    <div class="card border-0 shadow-lg rounded-4 bg-light-blue text-dark">
      <div class="card-body">
        <h4 class="mb-4 text-primary">
          Crear solicitud:
        </h4>

        <div class="d-flex flex-wrap gap-3">
          <a href="<?= BASE_URL ?>/main" class="btn btn-black-borde">
            <i class="fa fa-home me-1"></i> Volver al inicio
          </a>

          <?php if ($_SESSION['id_rol'] == 1): ?>
            <a href="<?= BASE_URL ?>/direccion_solicitud?direccion=desarrollo" class="btn btn-blue">
              <i class="fa fa-plus-circle me-1"></i> Solicitud Desarrollo Social
            </a>
            <a href="<?= BASE_URL ?>/direccion_solicitud?direccion=solicitud" class="btn btn-blue">
              <i class="fa fa-plus-circle me-1"></i> Solicitud General
            </a>
          <?php endif; ?>

          <?php if ($_SESSION['id_rol'] == 4): ?>
            <a href="<?= BASE_URL ?>/direccion_solicitud?direccion=desarrollo" class="btn btn-blue">
              <i class="fa fa-plus-circle me-1"></i> Solicitud Desarrollo Social
            </a>
            <a href="<?= BASE_URL ?>/direccion_solicitud?direccion=despacho" class="btn btn-blue">
              <i class="fa fa-plus-circle me-1"></i> Solicitud Despacho
            </a>
            <a href="<?= BASE_URL ?>/direccion_solicitud?direccion=solicitud" class="btn btn-blue">
              <i class="fa fa-plus-circle me-1"></i> Solicitud General
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<?php
$mensaje = $msj ?? ($_GET['msj'] ?? null);
if ($mensaje):
?>
    <script>
        mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 3000);
    </script>
<?php endif; ?>
</html>