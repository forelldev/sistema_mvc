<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/estilo_anteriores.css?v=<?php echo time(); ?>">
    <title>Se han encontrado otras solicitudes</title>
</head>
<header class="header">
        <div class="titulo-header">Antecedentes de Solicitudes</div>
            <a href="<?= BASE_URL ?>/despacho_busqueda"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
        </div>
</header>

<!-- Fondo general suave -->
<body style="background-color: #f1f3f5;">
  <div class="container my-5 px-4" >
    <section class="solicitudes-lista">

      <?php if (!empty($datos)): ?>
        <div class="row justify-content-center g-0 ">
          <?php foreach ($datos as $fila): ?>
            <div class="col-12 mb-4 d-flex justify-content-center">
              <div class="card border-0 shadow rounded-4 fs-5" style="width: 100% !important; max-width: 36rem !important;">
                <!-- Encabezado de tarjeta -->
                <div class="card-header bg-white text-center border-bottom">
                  <?php
                    $estado = htmlspecialchars($fila['estado'] ?? '');
                    $badgeClass = 'bg-secondary';
                    if ($estado == 'En espera del documento físico para ser procesado 0/2') $badgeClass = 'bg-warning text-dark';
                    else if ($estado == 'En Proceso 1/2') $badgeClass = 'bg-info text-dark';
                    else if ($estado == 'En Proceso 2/2 (Sin entregar)') $badgeClass = 'bg-primary';
                    else if ($estado == 'Solicitud Finalizada (Ayuda Entregada)') $badgeClass = 'bg-success';
                    else if ($estado == 'Documento inválido') $badgeClass = 'bg-danger';
                  ?>
                  <span class="badge rounded-pill <?= $badgeClass ?> px-3 py-2 mb-2 d-inline-block">
                     <?= $estado ?>
                  </span>
                  <div>
                    <small class="text-muted">
                      📅 <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?>
                    </small>
                  </div>
                </div>

                <!-- Cuerpo de tarjeta -->
                <div class="card-body">
                  <ul class="list-unstyled mb-0">
                    <li><strong>📝 Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></li>
                    <li><strong>📂 Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></li>
                    <li><strong>🆔 Número de documento:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></li>
                    <li><strong>🧾 CI:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></li>
                    <li><strong>👤 Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')) ?></li>
                  </ul>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="alert alert-secondary text-center mt-4" role="alert">
          ℹ️ <strong>No hay solicitudes registradas.</strong>
        </div>
      <?php endif; ?>
    </section>

    <!-- Botones de acción -->
    <div class="text-center mt-5">
    <a href="<?=BASE_URL?>/despacho_busqueda" class="btn btn-outline-dark px-4 rounded-pill">
        ⬅️ Volver sin registrar
    </a>
      <form action="registrar_despacho" method="POST" class="d-inline-block me-2">
        <input type="hidden" name="ci" value="<?= $ci ?>">
        <button type="submit" class="btn btn-success px-4 rounded-pill">
          ➕ Registrar Solicitud
        </button>
      </form>
    </div>
  </div>
</body>
<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
    <?php if (isset($msj)): ?> mostrarMensaje("<?= htmlspecialchars($msj) ?>", "info", 6500);
    <?php endif; ?>
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>