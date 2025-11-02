<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud General</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="solicitud-body">
    <header class="header">
        <div class="titulo-header">Solicitud Notificada</div>
        <div class="header-right">
            <a href="<?= BASE_URL ?>/main"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
        </div>
    </header>
     <main class="solicitudes-main">
<section class="solicitudes-lista">
    <?php if (!empty($datos)): ?>
            <?php foreach ($datos as $fila): ?>
                <div class="solicitud-card">
                    <div class="solicitud-header">
                        <span class="solicitud-estado
                            <?php
                                $estado = htmlspecialchars($fila['estado'] ?? '');
                                if ($estado == 'En espera del documento físico para ser procesado 0/3') echo 'pendiente';
                                else if ($estado == 'En Proceso 1/3') echo 'activo1';
                                else if ($estado == 'En Proceso 2/3') echo 'activo2';
                                else if ($estado == 'En Proceso 3/3 (Sin entregar)') echo 'activo3';
                                else if ($estado == 'Solicitud Finalizada (Ayuda Entregada)') echo 'finalizada';
                                else if ($estado == 'Documento inválido') echo 'invalido';
                            ?>">
                            <?= $estado ?>
                        </span>
                        <div><strong>Fecha:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?></div>
                    </div>
                    <div class="solicitud-info">
                        <div><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></div>
                        <div><strong>Tipo de ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda']) ?></div>
                        <div><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></div>
                        <div><strong>ID Manual:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></div>
                        <div><strong>CI:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></div>
                        <div><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? ''))?></div>
                        <div><strong>Observaciones:</strong> <?= htmlspecialchars($fila['observaciones'] ?? '') ?></div>
                    </div>
                    <div class="solicitud-actions">
                        <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= $fila['ci']?>" class="aprobar-btn">Ver Información del beneficiario</a>
                        <?php
                            $estado_actual = $fila['estado'] ?? '';
                            $id_rol = $_SESSION['id_rol'] ?? null;

                            // ✅ Condiciones
                            $puedeEditar = ($id_rol == 4) || ($id_rol == 1 && $estado_actual === 'En espera del documento físico para ser procesado 0/3');
                            $puedeInhabilitar = ($id_rol == 4) || ($id_rol == 2 && $estado_actual === 'En Proceso 2/3');
                            $puedeProcesar = (
                                $id_rol == 4 ||
                                ($id_rol == 1 && in_array($estado_actual, ['En espera del documento físico para ser procesado 0/3', 'En Proceso 1/3'])) ||
                                ($id_rol == 2 && $estado_actual === 'En Proceso 2/3') ||
                                ($id_rol == 3 && $estado_actual === 'En Proceso 3/3 (Sin entregar)')
                            );
                            ?>

                            <?php if ($puedeEditar): ?>
                                <a href="<?= BASE_URL.'/editar?id_doc='.urlencode($fila['id_doc']) ?>" class="aprobar-btn">Editar</a>
                            <?php endif; ?>

                            <?php if ($puedeInhabilitar): ?>
                                <a href="<?= BASE_URL.'/inhabilitar?id_doc='.urlencode($fila['id_doc']) ?>" class="rechazar-btn">Inhabilitar</a>
                            <?php endif; ?>

                            <?php if ($puedeProcesar): ?>
                                <a href="<?= BASE_URL.'/procesar?id_doc='.urlencode($fila['id_doc']).'&estado='.urlencode($estado_actual) ?>" class="aprobar-btn">
                                    <?= isset($acciones[$estado_actual]) ? htmlspecialchars($acciones[$estado_actual]) : 'Acción desconocida'; ?>
                                </a>
                            <?php endif; ?>

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