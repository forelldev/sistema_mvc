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
    <title>Solicitudes Internas de Despacho</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="solicitud-body">
    <header class="header">
        <div class="titulo-header">Solicitudes internas de despacho</div>
        <div class="header-right">
            <?php if($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4){?>
                <a href="<?=BASE_URL?>/despacho_busqueda"><button class="nav-btn principal-btn"><i class="fa fa-plus"></i> Rellenar Formulario</button></a>
                <a href="<?=BASE_URL?>/inhabilitados_despacho"><button class="nav-btn"><i class="fa fa-eye-slash"></i> Ver Solicitudes Inhabilitadas (Despacho)</button></a>
            <?php } ?>
            <a href="<?=BASE_URL?>/main"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
        </div>
        <button class="notificaciones-btn" id="btn-notificaciones">
                <i class="fas fa-bell"></i> Notificaciones de Urgencia
                <?php
                        $notificaciones = Despacho::notificacion_urgencia();
                        $notificacion = $notificaciones['exito'] ? $notificaciones['datos'] : [];
                        $notificacionAgrupada = [];
                        foreach ($notificacion as $item) {
                            $tipo = $item['categoria'] ?? 'general';
                            $notificacionAgrupada[$tipo][] = $item;
                        }
                    $total = 0;
                    foreach ($notificacionAgrupada as $grupo) {
                        // Si es un mensaje plano, no es un array de notificaciones
                        if (isset($grupo['mensaje'])) {
                            continue;
                        }
                        $total += count($grupo);
                    }
                    ?>

                    <?php if ($total > 0): ?>
                        <span class="badge"><?= $total ?></span>
                    <?php endif; ?>
                    </button>

                    <div id="barra-notificaciones" class="barra-notificaciones oculto">
                        <ul id="lista-notificaciones" class="notificaciones-lista">
                            <?php if ($total > 0): ?>
                                <?php foreach ($notificacionAgrupada as $tipo => $notificaciones): ?>
                                    <?php foreach ($notificaciones as $noti): ?>
                                        <li class="notificacion-item">
                                            <strong><?= ucfirst($tipo) ?>:</strong>
                                            <a href="<?= htmlspecialchars(BASE_URL.'/mostrar_noti_urgencia?id_despacho='.urlencode($noti['id_despacho'])) ?>"><?= htmlspecialchars($noti['descripcion'] ?? 'Sin mensaje') ?><br>
                                            <?= htmlspecialchars($noti['estado'] ?? 'Sin mensaje') ?>
                                            <span class="fecha"><?= date('d/m/Y H:i', strtotime($noti['fecha'])) ?></span></a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="notificacion-item">
                                    <strong>Info:</strong> No hay notificaciones disponibles
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
    </div>
    </header>
    <main>
        <section class="filtros-card">
            <form class="filtros-form" action="filtro_buscar" method="POST" autocomplete="off">
                <label for="filtro_busqueda">Realiza tu búsqueda:</label>
                <input type="text" name="filtro_busqueda" id="filtro_busqueda" placeholder="Busqueda" value="<?= $filtro ?? '' ?>" required>
                <input type="hidden" name="direccion" value="despacho">
                <button type="submit" name="btn_filtro" value="Filtrar" class="filtrar-btn">
                    <i class="fa fa-filter"></i> <span>Filtrar</span>
                </button>
            </form>
        </section>
        <section class="solicitudes-lista">
            <?php if (!empty($datos)):  ?>
                <?php foreach ($datos as $fila): ?>
                    <div class="solicitud-card">
                        <div class="solicitud-header">
                            <span class="solicitud-estado 
                                <?php
                                    $estado = htmlspecialchars($fila['estado'] ?? '');
                                    if ($estado == 'En espera del documento físico para ser procesado 0/3') echo 'pendiente';
                                    else if ($estado == 'En Revisión 1/2') echo 'activo1';
                                    else if ($estado == 'En Proceso 2/2 (Sin entregar)') echo 'activo2';
                                    else if ($estado == 'En Proceso 3/3 (Sin entregar)') echo 'activo3';
                                    else if ($estado == 'Solicitud Finalizada (Ayuda Entregada)') echo 'finalizada';
                                    else if ($estado == 'Documento inválido') echo 'invalido';
                                ?>">
                                <?= $estado ?>
                            </span>
                            <div><strong>Fecha de creación:</strong> <?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha'])))?></div>
                        </div>
                        <div class="solicitud-info">
                            <div><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></div>
                            <div><strong>ID Manual:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></div>
                            <div><strong>Cédula de Identidad:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></div>
                            <div><strong>Prioridad:</strong> <?= htmlspecialchars($fila['prioridad'] ?? '') ?></div>
                            <div><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></div>
                            <div><strong>Tipo de Ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda'] ?? '') ?></div>
                            <div><strong>Creador:</strong> <?= htmlspecialchars($fila['creador'] ?? '') ?></div>
                            <div><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? ''))?></div>
                        </div>
                        <div class="solicitud-actions">
                            <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= $fila['ci']?>" class="aprobar-btn">Ver Información del beneficiario</a>
                            <?php if (($estado == 'En Revisión 1/2' && $_SESSION['id_rol'] == 2) || $_SESSION['id_rol'] == 4) {
                                $accion = isset($acciones[$fila['estado']]) ? $acciones[$fila['estado']] : 'Acción desconocida';
                                    // Roles 2 y 4 pueden editar e inhabilitar
                                    ?>
                                    <a href="<?= BASE_URL.'/editarDespacho?id_despacho='.$fila['id_despacho'] ?>" class="aprobar-btn">Editar</a>
                                    <a href="<?= BASE_URL.'/inhabilitarDespacho?id_despacho='.$fila['id_despacho'] ?>" class="rechazar-btn">Inhabilitar</a>
                                    <a href="<?= BASE_URL.'/procesarDespacho?id_despacho='.$fila['id_despacho'].'&estado='.$fila['estado'] ?>" class="aprobar-btn"><?= $accion ?></a>
                                    <?php
                                } elseif ($estado == 'En Proceso 2/2 (Sin entregar)' && $rol == 3) {
                                    // Rol 3 solo puede procesar
                                    ?>
                                    <a href="<?= BASE_URL.'/procesarDespacho?id_despacho='.$$fila['id_despacho'].'&estado='.$fila['estado'] ?>" class="aprobar-btn"><?= $accion ?></a>
                                    <?php
                                }?>
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
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/notificacionAdministrador.js"></script>
</html>