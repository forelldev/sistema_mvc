<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Despacho</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/urgencia.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body">
  <header class="header d-flex justify-content-between align-items-center px-4 py-3 border-bottom border-secondary" style="background-color: #2c2f33;">
    <h5 class="titulo-header mb-0 text-white">Solicitud Notificada</h5>
    <div class="header-right">
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light btn-sm">
        <i class="fa fa-arrow-left"></i> Volver atrás
      </a>
    </div>
  </header>

  <main class="solicitudes-main container py-4">
    <section class="solicitudes-lista row g-4">
      <?php if (!empty($datos)): ?>
        <?php foreach ($datos as $fila): ?>
          <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="solicitud-card card bg-dark border-secondary shadow-sm">
              <div class="solicitud-header card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <?php
                  $estado = htmlspecialchars($fila['estado'] ?? '');
                  $estadoClass = match ($estado) {
                    'En Revisión 1/2' => 'bg-warning text-dark',
                    'Aprobado 2/2' => 'bg-info text-dark',
                    'Solicitud Finalizada (Ayuda Entregada)' => 'bg-success',
                    'Documento inválido' => 'bg-danger',
                    default => 'bg-secondary'
                  };
                ?>
                <span class="solicitud-estado badge <?= $estadoClass ?>"><?= $estado ?></span>
                <div class="fecha-solicitud text-white"><strong>Fecha:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?></div>
              </div>

              <div class="solicitud-info card-body">
                <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></p>
                <p><strong>Tipo de ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda']) ?></p>
                <p><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></p>
                <p><strong>ID Manual:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></p>
                <p><strong>CI:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></p>
                <p><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? ''))?></p>
              </div>

              <div class="solicitud-actions card-footer d-flex flex-wrap gap-2 bg-dark border-top border-secondary">
                <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= $fila['ci']?>" class="btn btn-filtro btn-sm">Ver Información del beneficiario</a>

                <?php
                  $estado_actual = $fila['estado'] ?? '';
                  $id_rol = $_SESSION['id_rol'] ?? null;
                  $puedeEditar = ($id_rol == 4) || ($id_rol == 2 && strpos($estado_actual, 'En Revisión 1/2') === 0);
                  $puedeInhabilitar = ($id_rol == 4) || ($id_rol == 2 && $estado_actual === 'En Revisión 1/2');
                  $puedeProcesar = $puedeInhabilitar || ($id_rol == 3 && $estado_actual === 'En Proceso 2/2 (Sin entregar)');
                ?>

                <?php if ($puedeEditar): ?>
                  <a href="<?= BASE_URL.'/editarDespacho?id_despacho='.urlencode($fila['id_despacho']) ?>" class="btn btn-filtro btn-sm">Editar</a>
                <?php endif; ?>

                <?php if ($puedeInhabilitar): ?>
                  <a href="<?= BASE_URL.'/inhabilitarDespacho?id_despacho='.urlencode($fila['id_despacho']) ?>" class="btn btn-filtro btn-sm">Invalidar Solicitud</a>
                <?php endif; ?>

                <?php if ($puedeProcesar): ?>
                  <a href="<?= BASE_URL.'/procesarDespacho?id_despacho='.urlencode($fila['id_despacho']).'&estado='.urlencode($estado_actual) ?>" class="btn btn-filtro btn-sm">
                    <?= isset($acciones[$estado_actual]) ? htmlspecialchars($acciones[$estado_actual]) : 'Acción desconocida'; ?>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 col-md-6 mx-auto">
          <div class="solicitud-card card bg-dark border-secondary text-center p-4">
            <div class="solicitud-header card-header bg-dark text-white">
              <span class="solicitud-estado badge bg-secondary">Sin información</span>
            </div>
            <div class="solicitud-info card-body">
              <p class="text-muted">No hay información disponible.</p>
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