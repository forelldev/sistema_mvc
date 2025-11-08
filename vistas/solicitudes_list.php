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
    <title>Lista de Solicitudes</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/solicitud.css?v=<?= time(); ?>">
</head>
<body >
   <!-- HEADER -->
 <header class="border-bottom shadow-sm px-4 py-3">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
    
    <!-- Título principal -->
    <h5 class="fw-semibold mb-0 text-white">
      📋 Lista de solicitudes
    </h5>

    <!-- Acciones y notificaciones -->
    <div class="d-flex flex-wrap gap-2 align-items-center">

      <!-- Acciones por rol -->
      <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4): ?>
        <a href="<?= BASE_URL ?>/busqueda" class="btn btn-sm btn-primary">
          <i class="fa fa-plus"></i> Crear Solicitud
        </a>
      <?php endif; ?>

      <?php if ($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4): ?>
        <a href="<?= BASE_URL ?>/inhabilitados_lista" class="btn btn-sm btn-secondary">
          <i class="fa fa-eye-slash"></i> Ver Solicitudes Inválidas
        </a>
      <?php endif; ?>

      <!-- Navegación -->
      <?php
        $volver_url = isset($_GET['direccion']) ? BASE_URL . '/reportes_acciones' : BASE_URL . '/main';
      ?>
      <a href="<?= $volver_url ?>" class="btn btn-sm btn-outline-secondary text-white">
        <i class="fa fa-arrow-left"></i> Volver atrás
      </a>

      <!-- Notificaciones urgentes -->
      <?php
        $notificaciones = Solicitud::notificacion_urgencia();
        $notificacion = $notificaciones['exito'] ? $notificaciones['datos'] : [];
        $notificacionAgrupada = [];
        foreach ($notificacion as $item) {
          $tipo = 'General';
          $notificacionAgrupada[$tipo][] = $item;
        }
        $total = 0;
        foreach ($notificacionAgrupada as $grupo) {
          if (isset($grupo['mensaje'])) continue;
          $total += count($grupo);
        }
      ?>
      <div class="position-relative">
        <button id="btn-notificaciones" class="btn btn-sm btn-danger position-relative">
          <i class="fas fa-bell"></i> Urgentes
          <?php if ($total > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
              <?= $total ?>
            </span>
          <?php endif; ?>
        </button>

        <!-- Panel de notificaciones -->
        <div id="barra-notificaciones" class="position-absolute bg-white shadow-sm border rounded p-3 mt-2 d-none"
             style="right: 0; top: 100%; max-width: 320px; max-height: 300px; overflow-y: auto; z-index: 1050;">
          <ul class="list-unstyled mb-0">
            <?php if ($total > 0): ?>
              <?php foreach ($notificacionAgrupada as $tipo => $notificaciones): ?>
                <?php foreach ($notificaciones as $noti): ?>
                  <li class="mb-3 small">
                    <strong class="text-danger"><?= ucfirst($tipo) ?>:</strong><br>
                    <a href="<?= BASE_URL ?>/solicitud_urgencia?id_doc=<?= $noti['id_doc'] ?>"
                       class="text-decoration-none text-dark">
                      <?= htmlspecialchars($noti['descripcion'] ?? 'Sin mensaje') ?><br>
                      <span class="text-muted"><?= htmlspecialchars($noti['estado'] ?? 'Sin estado') ?></span>
                      <div class="text-muted small"><?= date('d/m/Y H:i', strtotime($noti['fecha'])) ?></div>
                    </a>
                  </li>
                <?php endforeach; ?>
              <?php endforeach; ?>
            <?php else: ?>
              <li class="text-muted small">No hay notificaciones disponibles.</li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>


     <!-- MAIN -->
  <main class="container-fluid py-4">
    <!-- BUSCADOR -->
   <section class="filtro-panel container-fluid mb-4">
  <div class="row g-3 justify-content-center">

    <!-- 🔍 Búsqueda rápida por texto -->
    <div class="col-md-4">
      <div class="card filtro-busqueda-card bg-dark text-white shadow-sm border-0 p-3 h-100">
        <form action="filtro_buscar" method="POST" autocomplete="off">
          <label for="filtro_busqueda" class="form-label fw-semibold">🔍 Búsqueda rápida</label>
          <p class="small text-white-50 mb-2">Escribe palabras clave como nombre, cédula o tipo de ayuda para encontrar solicitudes específicas.</p>
          <div class="input-group input-group-sm">
            <input type="text" name="filtro_busqueda" id="filtro_busqueda" class="form-control" placeholder="Ej. Juan Pérez, 12345678, Medicinas" value="<?= $filtro_busqueda ?? '' ?>" required>
            <button type="submit" name="btn_filtro" class="btn btn-outline-light">Buscar</button>
          </div>
          <input type="hidden" name="direccion" value="solicitud">
        </form>
      </div>
    </div>

    <!-- 📅 Filtro por fecha y estado -->
    <div class="col-md-5">
      <div class="card filtro-fecha-card bg-dark text-white shadow-sm border-0 p-3 h-100">
        <form class="row g-2 align-items-end" action="filtrar_fecha" method="POST">
          <div class="col-12">
            <label class="form-label fw-semibold">📅 Filtrar por fecha y estado</label>
            <p class="small text-white-50 mb-2">Selecciona un rango de fechas y el estado de la solicitud para filtrar resultados más precisos.</p>
          </div>
          <div class="col-md-4">
            <label class="form-label">Desde</label>
            <input type="date" name="fecha_inicio" class="form-control form-control-sm" value="<?= $fecha_inicio ?? '' ?>" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Hasta</label>
            <input type="date" name="fecha_final" class="form-control form-control-sm" value="<?= $fecha_final ?? '' ?>" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select form-select-sm" required>
              <option value="">Seleccione</option>
              <option value="En espera del documento físico para ser procesado 0/3" <?= ($estado ?? '') == 'En espera del documento físico para ser procesado 0/3' ? 'selected' : '' ?>>En espera del documento físico para ser procesado 0/3</option>
              <option value="En Proceso 1/3" <?= ($estado ?? '') == 'En Proceso 1/3' ? 'selected' : '' ?>>En Proceso 1/3</option>
              <option value="En Proceso 2/3" <?= ($estado ?? '') == 'En Proceso 2/3' ? 'selected' : '' ?>>En Proceso 2/3</option>
              <option value="En Proceso 3/3" <?= ($estado ?? '') == 'En Proceso 3/3' ? 'selected' : '' ?>>En Proceso 3/3</option>
              <option value="Solicitud Finalizada (Ayuda Entregada)" <?= ($estado ?? '') == 'Solicitud Finalizada (Ayuda Entregada)' ? 'selected' : '' ?>>Solicitud Finalizada (Ayuda Entregada)</option>
            </select>
          </div>
          <div class="col-12 text-end">
            <button type="submit" name="btn_filtro" class="btn btn-sm btn-outline-light px-4">
              <i class="fa fa-filter me-1"></i> Filtrar
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- 🧭 Filtros por categoría -->
    <div class="col-md-10">
      <div class="card bg-dark text-white shadow-sm border-0 p-3">
        <label class="form-label fw-semibold">🧭 Filtro por categoría</label>
        <p class="small text-white-50 mb-3">Selecciona una categoría para ver solicitudes agrupadas por tipo de ayuda o prioridad.</p>
        <div class="d-flex flex-wrap gap-2 justify-content-center">
          <a href="<?= BASE_URL ?>/filtrar?filtro=recientes" class="btn btn-filtro btn-sm"><i class="fa fa-clock"></i> Más recientes</a>
          <a href="<?= BASE_URL ?>/filtrar?filtro=antiguos" class="btn btn-filtro btn-sm"><i class="fa fa-clock"></i> Más antiguos</a>
          <a href="<?= BASE_URL ?>/filtrar?filtro=otros" class="btn btn-filtro btn-sm"><i class="fa fa-clock"></i> Otros</a>
          <a href="<?= BASE_URL ?>/filtrar?filtro=economica" class="btn btn-filtro btn-sm"><i class="fa fa-dollar-sign"></i> Económicas</a>
          <a href="<?= BASE_URL ?>/filtrar?filtro=urgentes" class="btn btn-filtro btn-sm"><i class="fa fa-exclamation-circle"></i> Más urgentes</a>
          <a href="<?= BASE_URL ?>/filtrar?filtro=medicinas" class="btn btn-filtro btn-sm"><i class="fa fa-medkit"></i> Medicinas</a>
          <a href="<?= BASE_URL ?>/filtrar?filtro=ayuda_tecnica" class="btn btn-filtro btn-sm"><i class="fa fa-wheelchair"></i> Ayudas técnicas</a>
          <a href="<?= BASE_URL ?>/filtrar?filtro=laboratorio" class="btn btn-filtro btn-sm"><i class="fa fa-flask"></i> Laboratorio</a>
          <a href="<?= BASE_URL ?>/filtrar?filtro=enseres" class="btn btn-filtro btn-sm"><i class="fa fa-couch"></i> Enseres</a>
        </div>
      </div>
    </div>

  </div>
</section>




    <!-- LISTA DE SOLICITUDES -->
   <section class="solicitudes-lista">
  <div class="row g-4">
    <?php if (!empty($datos)): ?>
      <?php foreach ($datos as $fila): ?>
        <?php
          $estado = htmlspecialchars($fila['estado'] ?? '');
          $clase_estado = match ($estado) {
            'En espera del documento físico para ser procesado 0/3' => 'bg-warning text-dark',
            'En Proceso 1/3' => 'bg-info text-dark',
            'En Proceso 2/3', 'En Proceso 3/3 (Sin entregar)' => 'bg-primary',
            'Solicitud Finalizada (Ayuda Entregada)' => 'bg-success',
            'Documento inválido' => 'bg-danger',
            default => 'bg-secondary'
          };
        ?>
        <div class="col-12 col-md-6 col-xl-4">
          <div class="card h-100 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
              <span class="badge <?= $clase_estado ?>"><?= $estado ?></span>
              <small class="fecha-solicitud"><strong>Fecha:</strong> <?= date('d-m-Y', strtotime($fila['fecha'])) ?></small>
            </div>

            <div class="card-body">
              <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></p>
              <p><strong>Tipo de ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda']) ?></p>
              <p><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></p>
              <p><strong>Documento:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></p>
              <p><strong>Cédula:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></p>
              <p><strong>Beneficiario:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')) ?></p>
              <p><strong>Promotor:</strong> <?= htmlspecialchars($fila['promotor'] ?? '') ?></p>
              <p><strong>Observaciones:</strong> <?= htmlspecialchars($fila['observaciones'] ?? '') ?></p>
            </div>

            <div class="card-footer d-flex flex-wrap gap-2">
              <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= $fila['ci'] ?>" class="btn btn-sm btn-outline-primary">Ver Información del Beneficiario</a>

              <?php if (
                ($_SESSION['id_rol'] == 1 && $estado === 'En espera del documento físico para ser procesado 0/3') ||
                ($_SESSION['id_rol'] == 4 && $estado === 'En espera del documento físico para ser procesado 0/3')
              ): ?>
                <a href="<?= BASE_URL . '/editar?id_doc=' . $fila['id_doc'] ?>" class="btn btn-sm btn-outline-warning">Editar</a>
              <?php endif; ?>

              <?php if ($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4): ?>
                <a href="<?= BASE_URL . '/inhabilitar?id_doc=' . $fila['id_doc'] ?>" class="btn btn-sm btn-outline-danger">Invalidar Solicitud</a>
              <?php endif; ?>

              <a href="<?= BASE_URL . '/procesar?id_doc=' . $fila['id_doc'] . '&estado=' . $estado ?>" class="btn btn-sm btn-outline-success">
                <?= isset($acciones[$estado]) ? $acciones[$estado] : 'Acción desconocida'; ?>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-light">
            <span class="badge bg-secondary">Sin información</span>
          </div>
          <div class="card-body">
            <p class="text-muted">No hay información disponible.</p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>


  </main>
</body>


<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<?php
$mensaje = $_GET['msj'] ?? $msj ?? null;
if ($mensaje):
?>
<script>
    mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 6000);
</script>
<?php endif; ?>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/desplegables.js"></script>
</html>