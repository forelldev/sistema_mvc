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
    <title>Solicitudes - Desarrollo Social</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/solicitud.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body">
  <header class="py-3 px-4 d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Lista De Solicitudes - Desarrollo Social</h5>
    <div class="d-flex flex-wrap gap-2 align-items-center">
      <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4): ?>
        <a href="<?= BASE_URL ?>/buscar_desarrollo" class="btn btn-filtro btn-sm">
          <i class="fa fa-plus"></i> Crear Solicitud
        </a>
        <a href="<?= BASE_URL ?>/desarrollo_invalidos" class="btn btn-filtro btn-sm">
          <i class="fa fa-eye-slash"></i> Ver Solicitudes Inválidas
        </a>
      <?php endif; ?>
      <a href="<?= BASE_URL ?>/main" class="btn btn-filtro btn-sm">
        <i class="fa fa-arrow-left"></i> Volver atrás
      </a>

      <!-- Notificaciones -->
      <div class="position-relative">
        <button id="btn-notificaciones" class="btn btn-sm btn-danger position-relative">
          <i class="fas fa-bell"></i> Urgentes
          <span id="badge-noti" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark d-none"></span>
        </button>

        <div id="barra-notificaciones" class="position-absolute bg-white shadow-sm border rounded p-3 mt-2 d-none"
             style="right: 0; top: 100%; max-width: 320px; max-height: 300px; overflow-y: auto; z-index: 1050;">
          <ul id="lista-notificaciones" class="list-unstyled mb-0">
            <li class="text-muted small">Cargando notificaciones...</li>
          </ul>
        </div>
      </div>
    </div>
  </header>


    <main class="container-fluid py-4">
  <!-- 🔎 Panel de filtros -->
  <section class="filtro-panel container-fluid mb-4">
    <div class="row g-3 justify-content-center">

      <!-- 🔍 Búsqueda rápida por texto -->
      <div class="col-md-4">
        <div class="card filtro-busqueda-card bg-dark text-white shadow-sm border-0 p-3 h-100">
          <form action="filtro_buscar" method="POST" autocomplete="off">
            <label for="filtro_busqueda" class="form-label fw-semibold">🔍 Búsqueda rápida</label>
            <p class="small text-white-50 mb-2">
              Escribe palabras clave como nombre, cédula o tipo de ayuda para encontrar solicitudes específicas.
            </p>
            <div class="input-group input-group-sm">
              <input type="text" name="filtro_busqueda" id="filtro_busqueda"
                     class="form-control" placeholder="Ej. Juan Pérez, 12345678, Medicinas"
                     value="<?= $filtro_busqueda ?? '' ?>" required>
              <button type="submit" name="btn_filtro" class="btn btn-outline-light">Buscar</button>
            </div>
            <input type="hidden" name="direccion" value="desarrollo">
          </form>
        </div>
      </div>

      <!-- 📅 Filtro por fecha y estado -->
      <div class="col-md-5">
        <div class="card filtro-fecha-card bg-dark text-white shadow-sm border-0 p-3 h-100">
          <form class="row g-2 align-items-end" action="filtrar_fechaDesarrollo" method="POST">
            <div class="col-12">
              <label class="form-label fw-semibold">📅 Filtrar por fecha y estado</label>
              <p class="small text-white-50 mb-2">
                Selecciona un rango de fechas y el estado de la solicitud para filtrar resultados más precisos.
              </p>
            </div>
            <div class="col-md-4">
              <label class="form-label">Desde</label>
              <input type="date" name="fecha_inicio" class="form-control form-control-sm"
                     value="<?= $fecha_inicio ?? '' ?>" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Hasta</label>
              <input type="date" name="fecha_final" class="form-control form-control-sm"
                     value="<?= $fecha_final ?? '' ?>" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Estado</label>
              <select name="estado" class="form-select form-select-sm" required>
                <option value="">Seleccione</option>
                <option value="En espera del documento físico para ser procesado 0/2" <?= ($estado ?? '') == 'En espera del documento físico para ser procesado 0/2' ? 'selected' : '' ?>>En espera del documento físico para ser procesado 0/2</option>
                <option value="En Proceso 1/2" <?= ($estado ?? '') == 'En Proceso 1/2' ? 'selected' : '' ?>>En Proceso 1/2</option>
                <option value="En Proceso 2/2 (Sin entregar)" <?= ($estado ?? '') == 'En Proceso 2/2 (Sin entregar)' ? 'selected' : '' ?>>En Proceso 2/2 (Sin entregar)</option>
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
          <p class="small text-white-50 mb-3">
            Selecciona una categoría para ver solicitudes agrupadas por tipo de ayuda o prioridad.
          </p>
          <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a href="<?= BASE_URL ?>/filtrar_desarrollo?filtro=recientes" class="btn btn-filtro btn-sm"><i class="fa fa-clock"></i> Más recientes</a>
            <a href="<?= BASE_URL ?>/filtrar_desarrollo?filtro=antiguos" class="btn btn-filtro btn-sm"><i class="fa fa-clock"></i> Más antiguos</a>
            <a href="<?= BASE_URL ?>/filtrar_desarrollo?filtro=urgentes" class="btn btn-filtro btn-sm"><i class="fa fa-exclamation-circle"></i> Más urgentes</a>
            <a href="<?= BASE_URL ?>/filtrar_desarrollo?filtro=medicinas" class="btn btn-filtro btn-sm"><i class="fa fa-medkit"></i> Medicinas</a>
            <a href="<?= BASE_URL ?>/filtrar_desarrollo?filtro=ayuda_tecnica" class="btn btn-filtro btn-sm"><i class="fa fa-wheelchair"></i> Ayudas técnicas</a>
            <a href="<?= BASE_URL ?>/filtrar_desarrollo?filtro=laboratorio" class="btn btn-filtro btn-sm"><i class="fa fa-flask"></i> Laboratorio</a>
            <a href="<?= BASE_URL ?>/filtrar_desarrollo?filtro=enseres" class="btn btn-filtro btn-sm"><i class="fa fa-couch"></i> Enseres</a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- 📋 Lista de solicitudes -->
  <section class="solicitudes-lista">
    <?php if (!empty($datos)): ?>
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

        <div class="d-flex justify-content-center mb-4">
            <div class="card w-100" style="max-width: 720px;">
                <div class="card-header d-flex justify-content-between align-items-center">
                <span class="badge <?= $clase_estado ?>">
                    <?= $estado ?>
                </span>
                <span class="fecha-solicitud">
                    <strong>Fecha:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?>
                </span>
                </div>
                <div class="card-body">
                <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion'] ?? '') ?></p>
                <p><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></p>
                <?php if ($fila['categoria'] === 'Laboratorio'): ?>
                    <p><strong>Exámenes:</strong> <?= htmlspecialchars($fila['examenes'] ?? '') ?></p>
                <?php endif; ?>
                <p><strong>ID Manual:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></p>
                <p><strong>CI:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></p>
                <p><strong>Remitente:</strong> <?= htmlspecialchars(($fila['remitente_nombre'] ?? '') . ' ' . ($fila['remitente_apellido'] ?? '')) ?></p>
                <p><strong>Promotor Social:</strong> <?= htmlspecialchars($fila['creador'] ?? '') ?></p>
                </div>
                <div class="card-footer d-flex flex-wrap gap-2">
                <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= $fila['ci'] ?>" class="btn btn-filtro btn-sm">Ver Información</a>
                <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4): ?>
                    <a href="<?= BASE_URL.'/editarDesarrollo?id_des='.$fila['id_des'] ?>" class="btn btn-filtro btn-sm">Editar</a>
                  <?php if ($estado !== 'Solicitud Finalizada (Ayuda Entregada)'): ?>
                    <a href="<?= BASE_URL.'/inhabilitarDesarrollo?id_des='.$fila['id_des'] ?>" class="btn btn-filtro btn-sm">Invalidar Solicitud</a>
                <?php endif; ?>
                <?php endif; ?>
                <a href="<?= BASE_URL.'/procesarDesarrollo?id_des='.$fila['id_des'].'&estado='.$fila['estado'] ?>" class="btn btn-filtro btn-sm">
                    <?= isset($acciones[$fila['estado']]) ? $acciones[$fila['estado']] : 'Acción desconocida'; ?>
                </a>
                </div>
            </div>
            </div>

      <?php endforeach; ?>
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

<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<?php
$mensaje = $_GET['msj'] ?? $msj ?? null;
?>
<script>
    <?php if ($mensaje): ?>
    mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 6000);
    <?php endif; ?>
</script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
    const BASE_URL = "<?php echo BASE_URL ?>";
    const caso = 'desarrollo';
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/notificacion_urgente.js"></script>
<script src="<?= BASE_URL ?>/public/js/noti_urg.js"></script>
</html>