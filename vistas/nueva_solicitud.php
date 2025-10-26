<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
</head>
<body>
     <header class="header">
        <div class="titulo-header">Sistema de Solicitud de Ayudas</div> 
        <div class="header-right">
            <div class="rol">Rol: <?= $_SESSION['rol'] ?></div>
        </div>
    </header>
    <div class="container my-5">
  <div class="card border-0 shadow-lg rounded-4" style="background: #e9f3ff;">
    <div class="card-body">
      <h4 class="mb-4 text-primary">
        <i class="fa fa-arrow-left me-2"></i>Acciones disponibles
      </h4>

      <div class="d-flex flex-wrap gap-3">
        <a href="<?= BASE_URL ?>/main" class="btn btn-secondary">
          <i class="fa fa-home me-1"></i> Volver al inicio
        </a>

        <?php if ($_SESSION['id_rol'] == 1): ?>
          <a href="<?= BASE_URL ?>/direccion_solicitud?direccion=desarrollo" class="btn btn-primary">
            <i class="fa fa-plus-circle me-1"></i> Solicitud Desarrollo Social
          </a>
          <a href="<?= BASE_URL ?>/direccion_solicitud?direccion=solicitud" class="btn btn-primary">
            <i class="fa fa-plus-circle me-1"></i> Solicitud General
          </a>
        <?php endif; ?>

        <?php if ($_SESSION['id_rol'] == 4): ?>
          <a href="<?= BASE_URL ?>/direccion_solicitud?direccion=desarrollo" class="btn btn-primary">
            <i class="fa fa-plus-circle me-1"></i> Solicitud Desarrollo Social
          </a>
          <a href="<?= BASE_URL ?>/direccion_solicitud?direccion=despacho" class="btn btn-primary">
            <i class="fa fa-plus-circle me-1"></i> Solicitud Despacho
          </a>
          <a href="<?= BASE_URL ?>/direccion_solicitud?direccion=solicitud" class="btn btn-primary">
            <i class="fa fa-plus-circle me-1"></i> Solicitud General
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>


</body>
</html>