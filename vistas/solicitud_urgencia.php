<?php 
 $acciones = [
            'En espera del documento físico para ser procesado 0/3' => 'Aprobar para su procedimiento',
            'En Proceso 1/3' => 'Enviar a despacho',
            'En Proceso 2/3' => 'Enviar a Administración',
            'En Proceso 3/3 (Sin entregar)' => 'Finalizar Solicitud (Se Entregó la ayuda)',
            'Solicitud Finalizada (Ayuda Entregada)' => 'Reiniciar en caso de algún error'
    ];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($rename) ? 'Ver Solicitud en Acción' : 'Solicitud General Urgente' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/solicitud.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body">
  <header class="py-3 px-4 d-flex justify-content-between align-items-center">
    <h5 class="mb-0"><?= isset($rename) ? 'Solicitud en Acción' : 'Solicitud Urgente' ?></h5>
    <a href="<?= BASE_URL ?>/solicitudes_list" class="btn btn-filtro btn-sm">
      <i class="fa fa-arrow-left"></i> Volver atrás
    </a>
  </header>

  <main class="container-fluid py-4">
    <section class="solicitudes-lista row g-4">
      <?php if (!empty($datos)): ?>
       <?php foreach ($datos as $fila): ?>
          <div class="d-flex justify-content-center">
            <div class="solicitudes-lista col-12 col-md-8 col-lg-6">
              <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <?php
                    $estado = htmlspecialchars($fila['estado'] ?? '');
                    $estadoClass = match ($estado) {
                      'En espera del documento físico para ser procesado 0/3' => 'bg-warning text-dark',
                      'En Proceso 1/3' => 'bg-info text-dark',
                      'En Proceso 2/3' => 'bg-primary',
                      'En Proceso 3/3 (Sin entregar)' => 'bg-success',
                      'Solicitud Finalizada (Ayuda Entregada)' => 'text-success',
                      'Documento inválido' => 'bg-danger',
                      default => 'text-muted'
                    };
                  ?>
                  <span class="badge <?= $estadoClass ?>"><?= $estado ?></span>
                  <span class="fecha-solicitud"><strong>Fecha:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?></span>
                </div>

                <div class="card-body">
                  <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></p>
                  <p><strong>Tipo de ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda']) ?></p>
                  <p><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></p>
                  <p><strong>ID Manual:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></p>
                  <p><strong>CI:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></p>
                  <p><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')) ?></p>
                  <p><strong>Observaciones:</strong> <?= htmlspecialchars($fila['observaciones'] ?? '') ?></p>
                </div>

                <div class="card-footer d-flex flex-wrap gap-2">
                  <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?=$fila['ci']?>" class="btn btn-filtro btn-sm">Ver Información del beneficiario</a>

                  <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4): ?>
                    <a href="<?= BASE_URL.'/editar?id_doc='.$fila['id_doc'] ?>" class="btn btn-filtro btn-sm">Editar</a>
                  <?php endif; ?>

                  <?php if ($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4): ?>
                    <a href="<?= BASE_URL.'/inhabilitar?id_doc='.$fila['id_doc'] ?>" class="btn btn-filtro btn-sm">Inhabilitar</a>
                  <?php endif; ?>

                  <a href="<?= BASE_URL.'/procesar?id_doc='.$fila['id_doc'].'&estado='.$fila['estado'] ?>" class="btn btn-filtro btn-sm">
                    <?= isset($acciones[$fila['estado']]) ? $acciones[$fila['estado']] : 'Acción desconocida'; ?>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="card">
            <div class="card-body text-center">
              <span class="text-white">No hay información disponible.</span>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </section>
  </main>
</body>

<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<?php
$mensaje = $msj ?? ($_GET['msj'] ?? null);
if ($mensaje):
?>
    <script>
        mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 3000);
    </script>
<?php endif; ?>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>