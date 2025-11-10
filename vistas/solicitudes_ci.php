<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se han encontrado otras solicitudes</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/busqueda.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body bg-dark text-white">

  <!-- Header -->
  <header class="bg-secondary border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
    <h5 class="mb-0 fw-semibold">Antecedentes de Solicitudes</h5>
    <a href="<?= BASE_URL ?>/busqueda" class="btn btn-sm btn-outline-light">
      <i class="fa fa-arrow-left me-1"></i> Volver atrás
    </a>
  </header>

  <!-- Contenido -->
  <main class="container py-5">
    <section class="solicitudes-lista">
      <?php if (!empty($datos)): ?>
        <div class="row justify-content-center g-4">
          <?php foreach ($datos as $fila): ?>
            <div class="col-md-8">
              <div class="card solicitud-card text-white shadow-sm border-0 rounded-4">
                <div class="card-header bg-gradient border-bottom text-center py-3">
                  <?php
                    $estado = htmlspecialchars($fila['estado'] ?? '');
                    $badgeClass = 'bg-secondary';
                    if ($estado == 'En espera del documento físico para ser procesado 0/3') $badgeClass = 'bg-warning text-dark';
                    else if ($estado == 'En Proceso 1/3') $badgeClass = 'bg-info text-dark';
                    else if ($estado == 'En Proceso 2/3') $badgeClass = 'bg-primary';
                    else if ($estado == 'En Proceso 3/3 (Sin entregar)') $badgeClass = 'bg-primary';
                    else if ($estado == 'Solicitud Finalizada (Ayuda Entregada)') $badgeClass = 'bg-success';
                    else if ($estado == 'Documento inválido') $badgeClass = 'bg-danger';
                  ?>
                  <div class="mb-2">
                    <span class="badge estado-badge <?= $badgeClass ?>">
                      <?= $estado ?>
                    </span>
                  </div>
                  <small class="text-white-50 d-block">
                    📅 <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?>
                  </small>
                </div>


                <div class="card-body">
                  <ul class="list-unstyled mb-0">
                    <li><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></li>
                    <li><strong>Tipo de ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda']) ?></li>
                    <li><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></li>
                    <li><strong>Número de documento:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></li>
                    <li><strong>CI:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></li>
                    <li><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')) ?></li>
                    <li><strong>Observaciones:</strong> <?= htmlspecialchars($fila['observaciones'] ?? '') ?></li>
                  </ul>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card solicitud-card text-white text-center shadow-sm border-0 rounded-4">
              <div class="card-header bg-dark border-bottom">
                <span class="badge rounded-pill bg-secondary px-3 py-2 mb-2">Sin información</span>
              </div>
              <div class="card-body">
                No hay información disponible.
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </section>

    <!-- Botones -->
    <div class="text-center mt-5">
      <a href="<?= BASE_URL ?>/" class="btn btn-outline-light px-4 rounded-pill me-2">
        Volver sin registrar
      </a>
      <form action="solicitudes_ci" method="POST" class="d-inline-block">
        <input type="hidden" name="ci" value="<?= $ci ?>">
        <button type="submit" class="btn btn-success px-4 rounded-pill">
          Registrar Solicitud
        </button>
      </form>
    </div>
  </main>
</body>

<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
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