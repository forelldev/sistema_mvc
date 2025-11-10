<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitude Inválidas - Desarrollo Social</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/solicitud.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body">
  <header class="header d-flex justify-content-between align-items-center px-4 py-3">
    <h5 class="mb-0 text-white">Solicitudes Inválidas - Desarrollo Social</h5>
    <div class="header-right d-flex gap-2">
      <a href="<?= BASE_URL ?>/main"><button class="btn btn-outline-light me-2"><i class="fa fa-home"></i> Inicio</button></a>
      <a href="<?= BASE_URL ?>/solicitudes_desarrollo"><button class="btn btn-outline-light me-2"><i class="fa fa-eye"></i> Ver Solicitudes Habilitadas</button></a>
    </div>
  </header>

  <main class="container py-4">
    <section class="solicitudes-lista">
      <?php if (!empty($datos)): ?>
        <div class="row g-4 justify-content-center">
          <?php foreach ($datos as $fila): ?>
            <?php
              $estado = htmlspecialchars($fila['estado'] ?? '');
              $clase_estado = match ($estado) {
                'En espera del documento físico para ser procesado 0/2' => 'bg-warning text-dark',
                'En Proceso 1/2' => 'bg-info text-dark',
                'En Proceso 2/2 (Sin entregar)' => 'bg-primary',
                'Solicitud Finalizada (Ayuda Entregada)' => 'bg-success',
                'Documento inválido' => 'bg-danger',
                default => 'bg-secondary'
              };
            ?>
            <div class="col-12 col-md-10 col-lg-8">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <span class="badge <?= $clase_estado ?>"><?= $estado ?></span>
                  <span class="fecha-solicitud"><strong>Fecha:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?></span>
                </div>
                <div class="card-body">
                  <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></p>
                  <p><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></p>
                  <?php if ($fila['categoria'] === 'Laboratorio'): ?>
                    <p><strong>Exámenes:</strong> <?= htmlspecialchars($fila['examenes']) ?></p>
                  <?php endif; ?>
                  <p><strong>ID Manual:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></p>
                  <p><strong>Cédula del Beneficiario:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></p>
                  <p><strong>Remitente:</strong> <?= htmlspecialchars(($fila['remitente_nombre'] ?? '') . ' ' . ($fila['remitente_apellido'] ?? '')) ?></p>
                  <p><strong>Promotor Social:</strong> <?= htmlspecialchars($fila['creador'] ?? '') ?></p>
                </div>
                <div class="card-footer d-flex flex-wrap gap-2">
                  <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= $fila['ci'] ?>" class="btn btn-filtro btn-sm">Ver Información del beneficiario</a>
                  <a href="<?= BASE_URL . '/editarDesarrollo?id_des=' . $fila['id_des'] ?>" class="btn btn-filtro btn-sm">Editar</a>
                  <a href="<?= BASE_URL . '/habilitarDesarrollo?id_des=' . $fila['id_des'] ?>" class="btn btn-filtro btn-sm">Habilitar</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="d-flex justify-content-center">
          <div class="card text-center" style="max-width: 480px;">
            <div class="card-header">
              <span class="badge bg-secondary">Sin información</span>
            </div>
            <div class="card-body">
              <p class="text-white mb-0">No hay información disponible.</p>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </section>
  </main>
</body>

<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<?php
$mensaje = $msj ?? ($_GET['msj'] ?? null);
if ($mensaje):
?>
    <script>
        mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 3000);
    </script>
<?php endif; ?>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>