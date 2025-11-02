<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de acciones</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/reportes.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="solicitud-body">
    <header class="header">
    <div class="titulo-header">Registro de acciones</div>
    <div class="header-right">
      <a href="<?= BASE_URL ?>/main"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
    </div>
  </header>
  <main class="auditoria-main">
        <div class="auditoria-header">
        <h1><i class="fa fa-clipboard-list"></i> Auditoría de Actividades</h1>
        <p>Consulta las acciones realizadas por los usuarios y administradores del sistema.</p>
    </div>

    <div class="auditoria-filtros-bar">
        <form action="filtro_acciones" method="POST">
        <!-- <input type="text" id="filtro-nombre" class="auditoria-filtro" placeholder="Buscar por nombre..." required> POR AHORA INNECESARIO IGUAL QUE EN REPORTES-->
            <select id="filtro-rol" class="auditoria-filtro" name="oficina" required>
                <option value="">Seleccione</option>
                <option value="todas" <?= ($oficina ?? '') === 'todas' ? 'selected' : '' ?>>Todas las oficinas</option>
                <option value="Desarrollo Social" <?= ($oficina ?? '') === 'Desarrollo Social' ? 'selected' : '' ?>>Desarrollo Social</option>
                <option value="Despacho" <?= ($oficina ?? '') === 'Despacho' ? 'selected' : '' ?>>Despacho</option>
            </select>

            <input type="date" id="filtro-fecha" class="auditoria-filtro" required name="fecha" value="<?php echo isset($fecha) ? $fecha : ''; ?>">
        <button type="submit" class="filtrar-btn"><i class="fa fa-search"></i> Filtrar</button>
        </form>
    </div>
    <button class="filtrar-btn" id="btnPDF" onclick="generarPDF()"><i class="fa fa-file-excel" ></i> Exportar PDF</button>
  <section class="auditoria-tabla-card">
    <div class="tabla-responsive">
    <table class="table table-bordered table-hover align-middle text-center"  id="exportarPDF">
        <thead class="table-primary">
            <tr>
                <th>Número</th>
                <th>CI</th>
                <th>Nombre</th>
                <th>Fecha de la acción</th>
                <th>Hora de la acción</th>
                <th>Acción</th>
                <th>Número de documento</th>
            </tr>
        </thead>
        <tbody>
          <?php if (!empty($datos)): ?>
                <?php foreach ($datos as $fila): ?>
                        <?php
                            $id = htmlspecialchars($fila['id']);
                            $ci = htmlspecialchars($fila['ci']);
                            $nombre = htmlspecialchars($fila['nombre']);
                            $fecha = date('d-m-Y', strtotime($fila['fecha']));
                            $hora = date('g:i A', strtotime($fila['fecha']));
                            $accion = htmlspecialchars($fila['accion']);
                            $id_manual = htmlspecialchars($fila['id_manual']);
                            $origen = $fila['origen'] ?? 'solicitud';

                            $direccion = match ($origen) {
                                'despacho' => 'despacho',
                                'desarrollo' => 'desarrollo',
                                default => 'solicitud'
                            };

                            $queryParams = http_build_query([
                                'filtro_busqueda' => $id_manual,
                                'direccion' => $direccion
                            ]);

                            $url = BASE_URL . "/filtrar_busqueda?" . $queryParams;
                        ?>
                        <tr>
                            <td class="col-id"><?= $id ?></td>
                            <td class="col-ci"><?= $ci ?></td>
                            <td class="col-nombre"><?= $nombre ?></td>
                            <td class="auditoria-fecha"><?= $fecha ?></td>
                            <td class="auditoria-fecha"><?= $hora ?></td>
                            <td class="text-start"><?= $accion ?></td>
                            <td><?= $id_manual ?></td>
                            <td><a href="<?= htmlspecialchars($url) ?>">Ver Solicitud</a></td>
                        </tr>
                    <?php endforeach; ?>

            <?php else: ?>
                <tr>
                <td colspan="7">No hay información disponible.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
    <div class="paginacion">
        <?php if ($paginaActual > 1): ?>
            <a href="?pagina=<?= $paginaActual - 1 ?>" class="paginacion-btn">&laquo;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <a href="?pagina=<?= $i ?>" class="paginacion-btn <?= $i == $paginaActual ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($paginaActual < $totalPaginas): ?>
            <a href="?pagina=<?= $paginaActual + 1 ?>" class="paginacion-btn">&raquo;</a>
        <?php endif; ?>
    </div>
</section>
</main>
</body>
<script src="<?= BASE_URL ?>/libs/jspdf.umd.min.js"></script>
<script src="<?= BASE_URL ?>/libs/jspdf.plugin.autotable.min.js"></script>
<script src="<?= BASE_URL ?>/public/js/exportarPDF.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>