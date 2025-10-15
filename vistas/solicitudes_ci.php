<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se han encontrado otras solicitudes</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="titulo-header">Antecedentes de Solicitudes</div>
        <div class="header-right">
         <?php if($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4){?>
            <a href="<?=BASE_URL?>/busqueda"><button class="principal-btn"><i class="fa fa-plus"></i> Rellenar Formulario</button></a>
        <?php } ?>
        <?php if($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4){?>
            <a href="<?=BASE_URL?>/inhabilitados_lista"><button class="nav-btn"><i class="fa fa-eye-slash"></i> Ver Solicitudes Inhabilitadas</button></a>
        <?php } ?>
      <a href="<?= BASE_URL ?>/main"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
      
         <button class="notificaciones-btn" id="btn-notificaciones">
                <i class="fas fa-bell"></i> Notificaciones de Urgencia
                <?php
                        $medicamentos = Solicitud::notiMedicamentos();
                        $notificacion = $medicamentos['exito'] ? $medicamentos['datos'] : [];
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
                                            <a href="<?= BASE_URL ?>/noti?id_doc=<?= $noti['id_doc']?>"><?= htmlspecialchars($noti['descripcion'] ?? 'Sin mensaje') ?><br>
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
    <section class="solicitudes-lista">
        <h1 class="mensaje"><?= isset($msj) ? htmlspecialchars($msj) : '' ?></h1>
    <?php if (!empty($datos)): ?>
                <?php foreach ($datos as $fila): ?>
                    <div class="solicitud-card">
                        <div class="solicitud-header">
                            <span class="solicitud-estado"
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
                            <div><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')) ?></div>
                            <div><strong>Observaciones:</strong> <?= htmlspecialchars($fila['observaciones'] ?? '') ?></div>
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
    <form action="solicitudes_ci" method="POST">
        <input type="submit" value="Registrar Solicitud">
        <input type="hidden" name="ci" value="<?= $ci ?>">
    </form>
    <a href="<?=BASE_URL?>/">Volver (No registrar)</a>
</body>
<script src="<?= BASE_URL ?>/public/js/notificacionAdministrador.js"></script>
</html>