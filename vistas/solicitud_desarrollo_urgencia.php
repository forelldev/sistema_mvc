<?php 
$acciones = [
                            'En espera del documento físico para ser procesado 0/2' => 'Aprobar para su procedimiento',
                            'En Proceso 1/2' => 'Aprobar Ayuda',
                            'En Proceso 2/2 (Sin entregar)' => 'Finalizar Solicitud (Se entregó la ayuda)',
                            'Solicitud Finalizada (Ayuda Entregada)' => 'Reiniciar en caso de algún error'
        ];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($rename) ? 'Ver Solicitud - Desarrollo Social' : 'Solicitud Urgente - Desarrollo Social' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/solicitud.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/forzar_colores.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body bg-dark text-white">
  <!-- Header -->
  <header class="py-3 px-4 d-flex justify-content-between align-items-center bg-secondary">
    <h5 class="mb-0"><?= isset($rename) ? 'Solicitud - Desarrollo Social' : 'Solicitud Urgente - Desarrollo Social' ?></h5>
    <a href="<?= BASE_URL ?>/solicitudes_desarrollo" class="btn btn-filtro btn-sm">
      <i class="fa fa-arrow-left"></i> Volver atrás
    </a>
  </header>

  <!-- Contenido principal -->
  <main class="container-fluid py-4">
    <section class="solicitudes-lista row g-4">
      <?php if (!empty($datos)): ?>
        <?php foreach ($datos as $fila): ?>
            <?php
                    $estado = htmlspecialchars($fila['estado'] ?? '');
                    $estadoClass = match ($estado) {
                        'En espera del documento físico para ser procesado 0/2' => 'bg-warning text-dark',
                        'En Proceso 1/2' => 'bg-info text-dark',
                        'En Proceso 2/2 (Sin entregar)' => 'bg-primary',
                        'Solicitud Finalizada (Ayuda Entregada)' => 'text-success',
                        'Documento inválido' => 'bg-danger',
                        default => 'text-muted'
                        };
                  ?>
          <div class="d-flex justify-content-center">
            <div class="solicitudes-lista col-12 col-md-8 col-lg-6">
              <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <span class="badge <?= $estadoClass ?>"><?= $estado ?></span>
                  <span class="fecha-solicitud"><strong>Fecha:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?></span>
                </div>

                <div class="card-body">
                  <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></p>
                  <p><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></p>
                  <?php if ($fila['categoria'] === 'Laboratorio'): ?>
                    <p><strong>Exámenes:</strong> <?= htmlspecialchars($fila['examenes'] ?? '') ?></p>
                  <?php endif; ?>
                  <p><strong>ID Manual:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></p>
                  <p><strong>CI:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></p>
                  <p><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')) ?></p>
                </div>

                <div class="card-footer d-flex flex-wrap gap-2">
                  <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= $fila['ci'] ?>" class="btn btn-filtro btn-sm">Ver Información del beneficiario</a>

                  <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4): ?>
                    <a href="<?= BASE_URL . '/editarDesarrollo?id_des=' . $fila['id_des'] ?>" class="btn btn-filtro btn-sm">Editar</a>
                    <a href="<?= BASE_URL . '/inhabilitarDesarrollo?id_des=' . $fila['id_des'] ?>" class="btn btn-filtro btn-sm">Invalidar Solicitud</a>
                  <?php endif; ?>

                  <a href="<?= BASE_URL . '/procesarDesarrollo?id_des=' . $fila['id_des'] . '&estado=' . $fila['estado'] ?>" class="btn btn-filtro btn-sm">
                    <?= isset($acciones[$fila['estado']]) ? $acciones[$fila['estado']] : 'Acción desconocida'; ?>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="card text-center">
            <div class="card-body">
              <span class="text-white">No hay información disponible.</span>
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