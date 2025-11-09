<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de solicitudes</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
</head>
<body class="bg-dark text-white">
  <div class="container py-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="mb-0 text-white">Estadísticas de solicitudes</h4>
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light">
        <i class="fa fa-arrow-left"></i> Volver atrás
      </a>
    </div>

    <!-- Tarjeta de estadísticas -->
    <div class="card bg-secondary bg-opacity-10 border-0 shadow-sm">
      <div class="card-body">
        <h5 class="text-white mb-4"><i class="fa fa-chart-bar me-2"></i> Resumen de solicitudes generales</h5>

        <div class="row g-4">
          <!-- Resumen de estados -->
          <div class="col-md-6">
            <ul class="list-group list-group-flush">
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-clock me-2"></i> En Espera del Documento</span>
                <span class="badge bg-warning text-dark"><?= $datos['En espera del documento físico para ser procesado 0/3'] ?></span>
              </li>
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-spinner me-2"></i> En proceso 1/3</span>
                <span class="badge bg-info text-dark"><?= $datos['En Proceso 1/3'] ?></span>
              </li>
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-spinner me-2"></i> En proceso 2/3</span>
                <span class="badge bg-info text-dark"><?= $datos['En Proceso 2/3'] ?></span>
              </li>
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-spinner me-2"></i> En proceso 3/3</span>
                <span class="badge bg-info text-dark"><?= $datos['En Proceso 3/3 (Sin Entregar)'] ?></span>
              </li>
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-check-circle me-2"></i> Solicitudes finalizadas</span>
                <span class="badge bg-success"><?= $datos['Solicitud Finalizada (Ayuda Entregada)'] ?></span>
              </li>
            </ul>
          </div>

          <!-- Gráfico -->
          <div class="col-md-6">
            <div class="grafico-solicitudes-container position-relative rounded overflow-hidden border border-secondary text-white">
                <canvas id="graficaSolicitudes" class="w-100 h-100 d-block"></canvas>
            </div>
            </div>

        </div>
      </div>
    </div>
  </div>
</body>


<script src="<?= BASE_URL ?>/libs/Chart.min.js"></script>
<script>
  window.solicitudesData = [
    <?= $datos['En espera del documento físico para ser procesado 0/3'] ?>,
    <?= $datos['En Proceso 1/3'] ?>,
    <?= $datos['En Proceso 2/3'] ?>,
    <?= $datos['En Proceso 3/3 (Sin Entregar)'] ?>,
    <?= $datos['Solicitud Finalizada (Ayuda Entregada)'] ?>
  ];
</script>
<script src="<?= BASE_URL ?>/public/js/grafica.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<?php
$mensaje = $msj ?? ($_GET['msj'] ?? null);
if ($mensaje):
?>
    <script>
        mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 3000);
    </script>
<?php endif; ?>
</html>