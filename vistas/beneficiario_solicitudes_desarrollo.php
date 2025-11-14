<?php
$acciones = [
    'En espera del documento físico para ser procesado 0/3' => 'Aprobar para su procedimiento',
    'En Proceso 1/3' => 'Enviar a despacho',
    'En Proceso 2/3' => 'Enviar a Administración',
    'En Proceso 3/3 (Sin entregar)' => 'Finalizar Solicitud (Se Entregó la ayuda)',
    'Solicitud Finalizada (Ayuda Entregada)' => 'Reiniciar en caso de algún error',
    'En Revisión 1/2' => 'Enviar a Administración',
    'En Proceso 2/2 (Sin entregar)' => 'Finalizar Solicitud (Se entregó la ayuda)',
    'En espera del documento físico para ser procesado 0/2' => 'Aprobar para su procedimiento',
    'En Proceso 1/2' => 'Aprobar Ayuda',
    'Aprobado 2/2' => 'Finalizar Solicitud (Se entregó la ayuda)'
];
function procesarSolicitud($fila, $acciones) {
    $estado_completo = $fila['estado'] ?? 'Sin estado';
    $estado_base = explode('.', $estado_completo)[0];
    $accion = $acciones[$estado_base] ?? 'Acción desconocida';

    $clases = [
        'En espera del documento físico para ser procesado 0/3' => 'pendiente',
        'En Proceso 1/3' => 'activo1',
        'En Proceso 2/3' => 'activo2',
        'En Proceso 3/3 (Sin entregar)' => 'activo3',
        'Solicitud Finalizada (Ayuda Entregada)' => 'finalizada',
        'Documento inválido' => 'invalido',
        'En Revisión 1/2' => 'activo1',
        'En Proceso 2/2 (Sin entregar)' => 'activo2',
        'Aprobado 2/2' => 'activo2',
        'En espera del documento físico para ser procesado 0/2' => 'pendiente',
        'En Proceso 1/2' => 'activo1'
    ];
    $estado_class = $clases[$estado_base] ?? '';

    // ✅ Usa el campo 'id' que viene del modelo con UNION
    $id = $fila['id'] ?? null;

    return compact('estado_completo', 'estado_base', 'estado_class', 'accion', 'id');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes - Desarrollo Social</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/beneficiario_list.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body">
  <header class="header bg-dark text-white py-3 px-4">
    <div class="titulo-header">
      Lista de solicitudes del beneficiario: 
      <?= htmlspecialchars(($datos[0]['nombre'] ?? '') . ' ' . ($datos[0]['apellido'] ?? '')) ?>
    </div>
    <div class="d-flex flex-wrap gap-2 mt-3">
      <a href="<?= BASE_URL ?>/solicitudes_beneficiario?ci=<?= $ci ?? $datos[0]['ci'] ?? null ?>" class="btn btn-volver btn-sm">
        <i class="fa fa-list"></i> Ver Solicitudes Generales
      </a>
      <a href="<?= BASE_URL ?>/beneficiario_despacho?ci=<?= $ci ?? $datos[0]['ci'] ?? null ?>" class="btn btn-volver btn-sm">
        <i class="fa fa-truck-fast"></i> Ver Solicitudes de Despacho
      </a>
      <a href="<?= BASE_URL ?>/main" class="btn btn-volver btn-sm">
        <i class="fa fa-home"></i> Inicio
      </a>
      <a href="<?= BASE_URL ?>/beneficiarios_lista" class="btn btn-volver btn-sm">
        <i class="fa fa-users"></i> Ver lista de beneficiarios
      </a>
    </div>
  </header>

  <main class="container py-4">
    <section class="row g-4 solicitudes-lista">
      <?php if (!empty($datos)): ?>
        <?php
          $mostrados = [];
          foreach ($datos as $fila):
            $info = procesarSolicitud($fila, $acciones);
            if (in_array($info['id'], $mostrados)) continue;
            $mostrados[] = $info['id'];
        ?>
          <div class="col-12 col-md-6 col-xl-5">
            <div class="card h-100 border-0 shadow-sm bg-panel-dark text-white solicitud-card">
              <div class="card-header d-flex flex-nowrap align-items-center solicitud-header <?= $info['estado_class'] ?>">
                <span class="flex-grow-1 solicitud-estado"><strong><?= htmlspecialchars($info['estado_completo']) ?></strong></span>
                <small class="ms-auto text-end"><strong>Fecha:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha'] ?? ''))) ?></small>
              </div>

              <div class="card-body solicitud-info">
                <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion'] ?? '') ?></p>
                <p><strong>Tipo de ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda'] ?? '') ?></p>
                <p><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></p>
                <p><strong>Número de documento:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></p>
                <p><strong>Cédula del Beneficiario:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></p>
                <p><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')) ?></p>
                <p><strong>Creador:</strong> <?= htmlspecialchars($fila['promotor'] ?? '') ?></p>
                <p><strong>Observaciones:</strong> <?= htmlspecialchars($fila['observaciones'] ?? '') ?></p>
              </div>

              <div class="card-footer d-flex flex-wrap gap-2 solicitud-actions">
                <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4): ?>
                  <a href="<?= BASE_URL.'/editarDesarrollo?id_doc='.urlencode($info['id']) ?>" class="btn btn-solicitud btn-sm aprobar-btn">
                    <i class="fa fa-edit"></i> Editar
                  </a>
                <?php endif; ?>
                <?php if ($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4): ?>
                  <a href="<?= BASE_URL.'/inhabilitarDesarrollo?id_doc='.urlencode($info['id']) ?>" class="btn btn-solicitud btn-sm rechazar-btn">
                    <i class="fa fa-ban"></i> Inhabilitar
                  </a>
                <?php endif; ?>
                <a href="<?= BASE_URL.'/procesarDesarrollo?id_doc='.urlencode($info['id']).'&estado='.urlencode($info['estado_base']) ?>" class="btn btn-solicitud btn-sm aprobar-btn">
                  <i class="fa fa-check"></i> <?= htmlspecialchars($info['accion']) ?>
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="card border-0 shadow-sm bg-panel-dark text-white solicitud-card">
            <div class="card-body text-center solicitud-info">
              <span class="text-muted">No hay información disponible.</span>
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