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
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
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
                            $tipo = $item['tipo_ayuda'] ?? 'despacho';
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
                                            <a href="<?= htmlspecialchars(BASE_URL.'/noti_urgente_despacho?id_despacho='.urlencode($noti['id_despacho'])) ?>"><?= htmlspecialchars($noti['descripcion'] ?? 'Sin mensaje') ?><br>
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
        <section class="card shadow-sm border-0 p-4 mb-4 mx-auto bg-white" style="max-width: 480px;">
            <form action="filtro_buscar" method="POST" autocomplete="off"
                    style="display: block !important; width: 100% !important; margin: 0 !important; padding: 0 !important; border: none !important; background: none !important;">
                <div class="mb-3" style="margin-bottom: 1rem !important;">
                <label for="filtro_busqueda"
                        class="form-label fw-semibold"
                        style="font-weight: 600 !important; display: block !important; margin-bottom: 0.5rem !important;">
                    Realiza tu búsqueda
                </label>
                <div style="display: flex !important; align-items: center !important; width: 100% !important;">
                    <input type="text"
                        name="filtro_busqueda"
                        id="filtro_busqueda"
                        placeholder="Escribe aquí..."
                        value="<?= $filtro_busqueda ?? '' ?>"
                        required
                        style="flex: 1 1 auto !important; padding: 0.375rem 0.75rem !important; border: 1px solid #ced4da !important; border-radius: 0.375rem 0 0 0.375rem !important; font-size: 1rem !important; line-height: 1.5 !important; background-color: #fff !important; box-sizing: border-box !important;">
                    <input type="submit"
                        name="btn_filtro"
                        value="🔍"
                        style="padding: 0.375rem 0.75rem !important; border: 1px solid #ced4da !important; border-left: none !important; border-radius: 0 0.375rem 0.375rem 0 !important; background-color: #fff !important; font-size: 1rem !important; line-height: 1.5 !important; cursor: pointer !important; box-sizing: border-box !important;">
                </div>
                </div>
                <input type="hidden" name="direccion" value="despacho">
            </form>
        </section>
          <section class="filtros-card">
                <form class="filtros-form" action="filtrar_fechaDespacho" method="POST">
                    <label>
                        Desde
                        <input type="date" name="fecha_inicio" value="<?php echo isset($fecha_inicio) ? $fecha_inicio : ''; ?>" required>
                    </label>
                    <label>
                        Hasta
                        <input type="date" name="fecha_final" value="<?php echo isset($fecha_final) ? $fecha_final : ''; ?>" required>
                    </label>
                    <label>
                        Seleccione un Estado:
                        <select name="estado" required>
                            <option value="">Seleccione</option>
                            <option value="En Revisión 1/2" <?= ($estado ?? '') == 'En Revisión 1/2' ? 'selected' : '' ?>>
                                En Revisión 1/2
                            </option>
                            <option value="En Proceso 2/2 (Sin entregar)" <?= ($estado ?? '') == 'En Proceso 2/2 (Sin entregar)' ? 'selected' : '' ?>>
                                En Proceso 2/2 (Sin entregar)
                            </option>
                            <option value="Solicitud Finalizada (Ayuda Entregada)" <?= ($estado ?? '') == 'Solicitud Finalizada (Ayuda Entregada)' ? 'selected' : '' ?>>
                                Solicitud Finalizada (Ayuda Entregada)
                            </option>
                        </select>

                    </label>
                    <button type="submit" name="btn_filtro" value="Filtrar" class="filtrar-btn">
                        <i class="fa fa-filter"></i> <span>Filtrar</span>
                    </button>
                </form>

            </section>
            <nav class="filtros-categorias">
                <a href="<?= BASE_URL ?>/filtrar_despacho?filtro=recientes" class="filtro-btn" name="recientes"><i class="fa fa-clock"></i> Más recientes</a>
                <a href="<?= BASE_URL ?>/filtrar_despacho?filtro=antiguos" class="filtro-btn" name="antiguos"><i class="fa fa-clock"></i> Más antiguos</a>
                <a href="<?= BASE_URL ?>/filtrar_despacho?filtro=salud" class="filtro-btn" name="salud"><i class="fa fa-exclamation-circle"></i> Salud</a>
                <a href="<?= BASE_URL ?>/filtrar_despacho?filtro=ayuda_economica" class="filtro-btn" name="ayuda_economica"><i class="fa fa-medkit"></i> Ayuda Económica</a>
                <a href="<?= BASE_URL ?>/filtrar_despacho?filtro=materiales_construccion" class="filtro-btn" name="materiales_construccion"><i class="fa fa-flask"></i> Materiales de Construcción</a>
                <a href="<?= BASE_URL ?>/filtrar_despacho?filtro=varios" class="filtro-btn" name="varios"><i class="fa fa-couch"></i> Varios</a>
            </nav>

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
<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<?php
$mensaje = $msj ?? ($_GET['msj'] ?? null);
if ($mensaje):
?>
    <script>
        mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 3000);
    </script>
<?php endif; ?>

<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/notificacionAdministrador.js"></script>
</html>