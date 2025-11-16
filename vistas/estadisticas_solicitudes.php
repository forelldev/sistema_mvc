<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de solicitudes</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
</head>
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

              <!-- En Espera -->
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-clock me-2"></i> En Espera del Documento</span>
                <div class="d-flex gap-2">
                  <span class="badge bg-success">Válido: <?= $datos['En espera del documento físico para ser procesado 0/3']['val'] ?></span>
                  <span class="badge bg-danger">Inválido: <?= $datos['En espera del documento físico para ser procesado 0/3']['inv'] ?></span>
                  <span class="badge bg-warning text-dark">Total: <?= $datos['En espera del documento físico para ser procesado 0/3']['total'] ?></span>
                </div>
              </li>

              <!-- Proceso 1/3 -->
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-spinner me-2"></i> En Proceso 1/3</span>
                <div class="d-flex gap-2">
                  <span class="badge bg-success">Válido: <?= $datos['En Proceso 1/3']['val'] ?></span>
                  <span class="badge bg-danger">Inválido: <?= $datos['En Proceso 1/3']['inv'] ?></span>
                  <span class="badge bg-info text-dark">Total: <?= $datos['En Proceso 1/3']['total'] ?></span>
                </div>
              </li>

              <!-- Proceso 2/3 -->
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-spinner me-2"></i> En Proceso 2/3</span>
                <div class="d-flex gap-2">
                  <span class="badge bg-success">Válido: <?= $datos['En Proceso 2/3']['val'] ?></span>
                  <span class="badge bg-danger">Inválido: <?= $datos['En Proceso 2/3']['inv'] ?></span>
                  <span class="badge bg-info text-dark">Total: <?= $datos['En Proceso 2/3']['total'] ?></span>
                </div>
              </li>

              <!-- Proceso 3/3 -->
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-spinner me-2"></i> En Proceso 3/3</span>
                <div class="d-flex gap-2">
                  <span class="badge bg-success">Válido: <?= $datos['En Proceso 3/3 (Sin Entregar)']['val'] ?></span>
                  <span class="badge bg-danger">Inválido: <?= $datos['En Proceso 3/3 (Sin Entregar)']['inv'] ?></span>
                  <span class="badge bg-info text-dark">Total: <?= $datos['En Proceso 3/3 (Sin Entregar)']['total'] ?></span>
                </div>
              </li>

              <!-- Finalizadas -->
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-check-circle me-2"></i> Solicitudes finalizadas</span>
                <div class="d-flex gap-2">
                  <span class="badge bg-success">Válido: <?= $datos['Solicitud Finalizada (Ayuda Entregada)']['val'] ?></span>
                  <span class="badge bg-danger">Inválido: <?= $datos['Solicitud Finalizada (Ayuda Entregada)']['inv'] ?></span>
                  <span class="badge bg-success">Total: <?= $datos['Solicitud Finalizada (Ayuda Entregada)']['total'] ?></span>
                </div>
              </li>

              <!-- Total general -->
              <li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
                <span><i class="fa fa-list-check me-2"></i> Total general</span>
                <div class="d-flex gap-2">
                  <span class="badge bg-success">Válido: <?= $datos['TOTAL']['val'] ?></span>
                  <span class="badge bg-danger">Inválido: <?= $datos['TOTAL']['inv'] ?></span>
                  <span class="badge bg-primary">Total: <?= $datos['TOTAL']['total'] ?></span>
                </div>
              </li>

            </ul>
          </div>

          <!-- Gráfico -->
          <div class="col-md-6">
            <div class="grafico-solicitudes-container position-relative rounded overflow-hidden border border-secondary text-white" style="min-height: 320px;">
              <canvas id="graficaSolicitudes" class="w-100 h-100 d-block"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

<script src="<?= BASE_URL ?>/libs/Chart.min.js"></script>
<script>
  // Definir datasets desde PHP
  window.valData = [
    <?= $datos['En espera del documento físico para ser procesado 0/3']['val'] ?>,
    <?= $datos['En Proceso 1/3']['val'] ?>,
    <?= $datos['En Proceso 2/3']['val'] ?>,
    <?= $datos['En Proceso 3/3 (Sin Entregar)']['val'] ?>,
    <?= $datos['Solicitud Finalizada (Ayuda Entregada)']['val'] ?>
  ];

  window.invData = [
    <?= $datos['En espera del documento físico para ser procesado 0/3']['inv'] ?>,
    <?= $datos['En Proceso 1/3']['inv'] ?>,
    <?= $datos['En Proceso 2/3']['inv'] ?>,
    <?= $datos['En Proceso 3/3 (Sin Entregar)']['inv'] ?>,
    <?= $datos['Solicitud Finalizada (Ayuda Entregada)']['inv'] ?>
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
</body>
</html>