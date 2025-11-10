<?php 
$acciones = [
                    'En Revisión 1/2' => 'Enviar a Administración',
                    'En Proceso 2/2 (Sin entregar)' => 'Finalizar Solicitud (Se entregó la ayuda)',
                    'Solicitud Finalizada (Ayuda Entregada)' => 'Reiniciar en caso de algún error'
                ];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Despacho</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/solicitud.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/forzar_colores.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body">
  <!-- Header -->
  <header class="py-3 px-4 d-flex justify-content-between align-items-center bg-secondary">
    <h5 class="mb-0">Solicitud Urgente (Despacho)</h5>
    <a href="<?= BASE_URL ?>/despacho_list" class="btn btn-filtro btn-sm">
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
              'En Revisión 1/2' => 'bg-warning text-dark',
              'En Proceso 2/2 (Sin entregar)' => 'bg-primary',
              'Solicitud Finalizada (Ayuda Entregada)' => 'text-success',
              'Documento inválido' => 'bg-danger',
              default => 'text-muted'
            };
          ?>
          <div class="d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
              <div class="card h-100 text-white bg-dark border-light">
                <div class="card-header d-flex justify-content-between align-items-center bg-secondary">
                  <span class="badge <?= $estadoClass ?>"><?= $estado ?></span>
                  <span><strong>Fecha:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?></span>
                </div>

                <div class="card-body">
                  <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></p>
                  <p><strong>Tipo de ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda']) ?></p>
                  <p><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></p>
                  <p><strong>ID Manual:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></p>
                  <p><strong>CI:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></p>
                  <p><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')) ?></p>
                </div>

                <div class="card-footer d-flex flex-wrap gap-2 bg-dark border-top">
                  <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= $fila['ci'] ?>" class="btn btn-filtro btn-sm">Ver Información del beneficiario</a>

                  <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4): ?>
                    <a href="<?= BASE_URL . '/editarDespacho?id_despacho=' . $fila['id_despacho'] ?>" class="btn btn-filtro btn-sm">Editar</a>
                  <?php endif; ?>

                  <?php if ($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4): ?>
                    <a href="<?= BASE_URL . '/inhabilitarDespacho?id_despacho=' . $fila['id_despacho'] ?>" class="btn btn-filtro btn-sm">Inhabilitar</a>
                  <?php endif; ?>

                  <a href="<?= BASE_URL . '/procesarDespacho?id_despacho=' . $fila['id_despacho'] . '&estado=' . $fila['estado'] ?>" class="btn btn-filtro btn-sm">
                    <?= isset($acciones[$fila['estado']]) ? $acciones[$fila['estado']] : 'Acción desconocida'; ?>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="card text-center bg-dark text-white border-light">
            <div class="card-body">
              <span>No hay información disponible.</span>
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