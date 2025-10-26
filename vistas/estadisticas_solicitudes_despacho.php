<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de solicitudes</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/estadisticas.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="solicitud-body">
    <header class="header">
        <div class="titulo-header">Estadísticas de solicitudes</div>
        <div class="header-right">
            <a href="<?= BASE_URL ?>/main"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
        </div>
    </header>
    <main class="container my-5">
  <div class="card shadow-sm rounded-4">
    <div class="card-body">
      <h2 class="mb-4"><i class="fa fa-chart-bar me-2"></i>Resumen de solicitudes generales</h2>

      <div class="row g-3">
        <div class="col-md-6 col-lg-4">
          <div class="border rounded p-3 bg-light">
            <h5 class="mb-2 text-warning"><i class="fa fa-clock me-2"></i>En Revisión</h5>
            <p class="fs-5 fw-semibold"><?= $datos['En Revisión 1/2'] ?></p>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="border rounded p-3 bg-light">
            <h5 class="mb-2 text-info"><i class="fa fa-spinner me-2"></i>En proceso</h5>
            <p class="fs-5 fw-semibold"><?= $datos['En Proceso 2/2 (Sin entregar)'] ?></p>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="border rounded p-3 bg-light">
            <h5 class="mb-2 text-success"><i class="fa fa-check-circle me-2"></i>Solicitudes finalizadas</h5>
            <p class="fs-5 fw-semibold"><?= $datos['Solicitud Finalizada (Ayuda Entregada)'] ?></p>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <canvas id="graficaSolicitudes" class="w-100" style="max-height: 400px;"></canvas>
      </div>
    </div>
  </div>
</main>

</body>
<script src="<?= BASE_URL ?>/libs/Chart.min.js"></script>
<script>
  window.solicitudesData = [
    <?= $datos['En Revisión 1/2'] ?>,
    <?= $datos['En Proceso 1/2'] ?>,
    <?= $datos['En Proceso 2/2 (Sin entregar)'] ?>,
    <?= $datos['Solicitud Finalizada (Ayuda Entregada)'] ?>
  ];
</script>
<script src="<?= BASE_URL ?>/public/js/grafica_despacho.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>