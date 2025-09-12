<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de acciones</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
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
        <input type="text" id="filtro-nombre" class="auditoria-filtro" placeholder="Buscar por nombre...">
            <select id="filtro-rol" class="auditoria-filtro" name="filtro">
                <option value="">Todos los roles</option>
                <option value="1">Promotor Social</option>
                <option value="2">Despacho</option>
                <option value="3">Administración</option>
                <option value="4">Admin</option>
            </select>
            <input type="date" id="filtro-fecha" class="auditoria-filtro">
        <button class="filtrar-btn"><i class="fa fa-search"></i> Filtrar</button>
        <button class="filtrar-btn"><i class="fa fa-file-excel"></i> Exportar Excel</button>
  </div>
  <section class="auditoria-tabla-card">
    <div class="tabla-responsive">
    <table class="auditoria-tabla" id="tabla-auditoria">
        <thead>
            <tr>
                <th>CI</th>
                <th>Nombre</th>
                <th>Fecha de acción</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($datos)):  ?>
                <?php foreach ($datos as $fila): ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['ci']) ?></td>
                        <td><?= htmlspecialchars($fila['nombre']) ?></td>
                        <td class="auditoria-fecha"><?= htmlspecialchars($fila['fecha']) ?></td>
                        <td><?= htmlspecialchars($fila['accion']) ?></td>
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
    <!-- Paginación Pls darle funcion -->
    <div class="paginacion">
      <button>&laquo;</button>
      <button class="active">1</button>
      <button>2</button>
      <button>3</button>
      <button>&raquo;</button>
    </div>
</section>
</main>
</body>
</html>