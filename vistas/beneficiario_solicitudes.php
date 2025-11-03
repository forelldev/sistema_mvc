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
    'En Proceso 1/2' => 'Aprobar Ayuda'
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
    <title>Lista de Solicitudes</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="solicitud-body">
    <header class="header">
        <div class="titulo-header">Lista de solicitudes generales del beneficiario: <?= htmlspecialchars(($datos[0]['nombre'] ?? '') . ' ' . ($datos[0]['apellido'] ?? '')) ?></div>
            <a href="<?= BASE_URL ?>/beneficiario_desarrollo?ci=<?=$ci ?? $datos[0]['ci'] ?? null?>"><button class="nav-btn"><i class="fa fa-arrow-left"></i>Ver Solicitudes de desarrollo</button></a>
            <a href="<?= BASE_URL ?>/beneficiario_despacho?ci=<?=$ci ?? $datos[0]['ci'] ?? null ?>"><button class="nav-btn"><i class="fa fa-arrow-left"></i>Ver Solicitudes de despacho</button></a>
            <a href="<?= BASE_URL ?>/main"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
        </div>
  </header>
   <main>
    <section class="solicitudes-lista">
        <?php if (!empty($datos)): ?>
            <?php
                $mostrados = [];
                foreach ($datos as $fila):
                    $info = procesarSolicitud($fila, $acciones);
                    if (in_array($info['id'], $mostrados)) continue;
                    $mostrados[] = $info['id'];
            ?>
                <div class="solicitud-card">
                    <div class="solicitud-header">
                        <span class="solicitud-estado <?= $info['estado_class'] ?>">
                            <?= htmlspecialchars($info['estado_completo']) ?>
                        </span>
                        <div><strong>Fecha:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha'] ?? ''))) ?></div>
                    </div>
                    <div class="solicitud-info">
                        <div><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion'] ?? '') ?></div>
                        <div><strong>Tipo de ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda'] ?? '') ?></div>
                        <div><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></div>
                        <div><strong>Número de documento:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></div>
                        <div><strong>Cédula del Beneficiario:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></div>
                        <div><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')) ?></div>
                        <div><strong>Creador:</strong> <?= htmlspecialchars($fila['promotor'] ?? '') ?></div>
                        <div><strong>Observaciones:</strong> <?= htmlspecialchars($fila['observaciones'] ?? '') ?></div>
                    </div>
                    <div class="solicitud-actions">
                        <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= urlencode($fila['ci']) ?>" class="aprobar-btn">Ver Información del beneficiario</a>
                        <?php if ($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4): ?>
                            <a href="<?= BASE_URL.'/editar?id_doc='.urlencode($info['id']) ?>" class="aprobar-btn">Editar</a>
                        <?php endif; ?>
                        <?php if ($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4): ?>
                            <a href="<?= BASE_URL.'/inhabilitar?id_doc='.urlencode($info['id']) ?>" class="rechazar-btn">Inhabilitar</a>
                        <?php endif; ?>
                        <a href="<?= BASE_URL.'/procesar?id_doc='.urlencode($info['id']).'&estado='.urlencode($info['estado_base']) ?>" class="aprobar-btn">
                            <?= htmlspecialchars($info['accion']) ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="solicitud-card">
                <div class="solicitud-header">
                    <span class="solicitud-estado">Sin información</span>
                </div>
                <div class="solicitud-info">
                    No hay información disponible.
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