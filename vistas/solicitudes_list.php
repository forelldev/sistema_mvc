<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Solicitudes</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="solicitud-body">
    <header class="header">
        <div class="titulo-header">Lista de solicitudes</div>
        <div class="header-right">
         <?php if($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4){?>
            <a href="<?=BASE_URL?>/busqueda"><button class="nav-btn principal-btn"><i class="fa fa-plus"></i> Rellenar Formulario</button></a>
        <?php } ?>
        <?php if($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4){?>
            <a href="<?=BASE_URL?>/inhabilitados_lista"><button class="nav-btn"><i class="fa fa-eye-slash"></i> Ver Solicitudes Inhabilitadas</button></a>
        <?php } ?>
      <a href="<?= BASE_URL ?>/main"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
    </div>
  </header>

    <main>
    <section class="filtros-card">
        <form class="filtros-form" action="system_help.php" method="POST">
            <label>
                Desde
                <input type="date" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>">
            </label>
            <label>
                Hasta
                <input type="date" name="fecha_final" value="<?php echo $fecha_final; ?>">
            </label>
            <select name="estado">
                <option value="">Seleccione un estado</option>
                <option value="En espera del documento físico para ser procesado 0/3">En espera del documento físico para ser procesado 0/3</option>
                <option value="En Proceso 1/3">En Proceso 1/3</option>
                <option value="En Proceso 2/3">En Proceso 2/3</option>
                <option value="En Proceso 3/3">En Proceso 3/3</option>
                <option value="Solicitud Finalizada (Ayuda Entregada)">Solicitud Finalizada (Ayuda Entregada)</option>
            </select>
            <button type="submit" name="btn_filtro" value="Filtrar" class="filtrar-btn">
                <i class="fa fa-filter"></i> <span>Filtrar</span>
            </button>
        </form>
    </section>
    <nav class="filtros-categorias">
        <a href="<?= BASE_URL ?>/filtrar?filtro=recientes" class="filtro-btn" name="recientes"><i class="fa fa-clock"></i> Más recientes</a>
        <a href="<?= BASE_URL ?>/filtrar?filtro=antiguos" class="filtro-btn" name="antiguos"><i class="fa fa-clock"></i> Más antiguos</a>
        <a href="<?= BASE_URL ?>/filtrar?filtro=urgentes" class="filtro-btn" name="urgentes"><i class="fa fa-exclamation-circle"></i> Más urgentes</a>
        <a href="<?= BASE_URL ?>/filtrar?filtro=medicinas" class="filtro-btn" name="medicinas"><i class="fa fa-medkit"></i> Medicinas</a>
        <a href="<?= BASE_URL ?>/filtrar?filtro=ayuda_tecnica" class="filtro-btn" name="ayudas técnicas"><i class="fa fa-wheelchair"></i> Ayudas técnicas</a>
        <a href="<?= BASE_URL ?>/filtrar?filtro=laboratorio" class="filtro-btn" name="laboratorio"><i class="fa fa-flask"></i> Laboratorio</a>
        <a href="<?= BASE_URL ?>/filtrar?filtro=enseres" class="filtro-btn" name="enseres"><i class="fa fa-couch"></i> Enseres</a>
    </nav>
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
                        <div><strong>Remitente:</strong> <?= htmlspecialchars($fila['remitente'] ?? '') ?></div>
                        <div><strong>Observaciones:</strong> <?= htmlspecialchars($fila['observaciones'] ?? '') ?></div>
                    </div>
                    <div class="solicitud-actions">
                        <a href="<?= BASE_URL ?>/" class="aprobar-btn">Ver Información del beneficiario</a>
                        <a href="<?= BASE_URL.'/editar?id_doc='.$fila['id_doc'] ?>" class="aprobar-btn">Editar</a>
                        <?php if ($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4): ?>
                            <a href="<?= BASE_URL.'/inhabilitar?id_doc='.$fila['id_doc'] ?>" class="rechazar-btn">Inhabilitar</a>
                        <?php endif; ?>
                        <a href="<?= BASE_URL.'/procesar?id_doc='.$fila['id_doc'].'&estado='.$fila['estado'] ?>" class="aprobar-btn">
                            <?= isset($acciones[$fila['estado']]) ? $acciones[$fila['estado']] : 'Acción desconocida'; ?>
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
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>