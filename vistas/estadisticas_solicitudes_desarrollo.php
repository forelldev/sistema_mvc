<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de solicitudes - Desarrollo Social</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
</head>
<body class="bg-dark text-white">
  <header class="bg-dark text-white py-3 px-4 border-bottom border-secondary">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h1 class="h6 mb-0">Estadísticas de solicitudes - Desarrollo Social</h1>
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light btn-sm">
        <i class="fa fa-arrow-left me-1"></i> Volver atrás
      </a>
    </div>
  </header>

  <main class="container py-4">
    <div class="card bg-secondary bg-opacity-10 border-0 shadow-sm">
      <div class="card-body">
        <h5 class="text-white mb-4"><i class="fa fa-chart-bar me-2"></i> Resumen de solicitudes generales</h5>

        <div class="row g-4">
          <!-- En Revisión -->
          <div class="col-md-6 col-lg-4">
            <div class="bg-dark text-light border border-secondary rounded p-3 h-100">
              <h6 class="mb-2 text-warning"><i class="fa fa-clock me-2"></i> En Revisión</h6>
              <p class="fs-5 fw-semibold"><?= $datos['En espera del documento físico para ser procesado 0/2'] ?></p>
            </div>
          </div>

          <!-- En Proceso 1/2 -->
          <div class="col-md-6 col-lg-4">
            <div class="bg-dark text-light border border-secondary rounded p-3 h-100">
              <h6 class="mb-2 text-info"><i class="fa fa-spinner me-2"></i> En Proceso 1/2</h6>
              <p class="fs-5 fw-semibold"><?= $datos['En Proceso 1/2'] ?></p>
            </div>
          </div>

          <!-- En Proceso 2/2 -->
          <div class="col-md-6 col-lg-4">
            <div class="bg-dark text-light border border-secondary rounded p-3 h-100">
              <h6 class="mb-2 text-info"><i class="fa fa-spinner me-2"></i> En Proceso 2/2 (Sin Entregar)</h6>
              <p class="fs-5 fw-semibold"><?= $datos['En Proceso 2/2 (Sin entregar)'] ?></p>
            </div>
          </div>

          <!-- Finalizadas -->
          <div class="col-md-6 col-lg-4">
            <div class="bg-dark text-light border border-secondary rounded p-3 h-100">
              <h6 class="mb-2 text-success"><i class="fa fa-check-circle me-2"></i> Solicitudes finalizadas</h6>
              <p class="fs-5 fw-semibold"><?= $datos['Solicitud Finalizada (Ayuda Entregada)'] ?></p>
            </div>
          </div>
        </div>

        <!-- Gráfico -->
        <div class="mt-5">
          <div class="grafico-solicitudes-container position-relative rounded overflow-hidden border border-secondary text-white">
            <canvas id="graficaSolicitudes" class="w-100 h-100 d-block" style="max-height: 400px;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

<script src="<?= BASE_URL ?>/libs/Chart.min.js"></script>
<script>
  window.solicitudesData = [
    <?= $datos['En espera del documento físico para ser procesado 0/2'] ?>,
    <?= $datos['En Proceso 1/2'] ?>,
    <?= $datos['En Proceso 2/2 (Sin entregar)'] ?>,
    <?= $datos['Solicitud Finalizada (Ayuda Entregada)'] ?>
  ];
</script>
<script src="<?= BASE_URL ?>/public/js/grafica_desarrollo.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>