<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/reportes.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body bg-dark text-white">
  <header class="bg-dark text-white py-3 px-4 border-bottom border-secondary">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h1 class="h6 mb-0">Reportes</h1>
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light btn-sm">
        <i class="fa fa-home"></i> Inicio
      </a>
    </div>
  </header>

  <main class="container py-4">
    <section class="mb-4">
      <h2 class="h5 text-white"><i class="fa fa-calendar-alt me-2"></i>Filtro por fechas</h2>
      <form class="row g-3 align-items-end" action="fecha_reportes" method="POST">
        <div class="col-md-4">
          <label for="desde" class="form-label text-white"><i class="fa fa-calendar"></i> Desde</label>
          <input type="date" id="desde" name="fecha_inicio" class="form-control bg-dark text-white border-secondary"
            value="<?= isset($fecha_inicio) ? $fecha_inicio : '' ?>" required>
        </div>
        <div class="col-md-4">
          <label for="hasta" class="form-label text-white"><i class="fa fa-calendar"></i> Hasta</label>
          <input type="date" id="hasta" name="fecha_final" class="form-control bg-dark text-white border-secondary"
            value="<?= isset($fecha_final) ? $fecha_final : '' ?>" required>
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary w-100">
            <i class="fa fa-search me-1"></i> Buscar
          </button>
        </div>
      </form>
    </section>

    <div class="mb-3">
      <button class="btn btn-success" id="btnPDF" onclick="generarPDF()">
        <i class="fa fa-file-pdf me-1"></i> Exportar PDF
      </button>
    </div>

    <section class="mb-4">
      <div class="table-responsive">
        <table class="table table-dark table-bordered table-hover align-middle text-center" id="exportarPDF">
          <thead class="bg-primary text-white">
            <tr>
              <th>Número</th>
              <th>Cédula de Identidad</th>
              <th>Fecha de Entrada</th>
              <th>Hora de Entrada</th>
              <th>Fecha de Salida</th>
              <th>Hora de Salida</th>
              <th>Nombre</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($datos)): ?>
              <?php foreach ($datos as $fila): ?>
                <tr>
                  <td><?= htmlspecialchars($fila['id']) ?></td>
                  <td><?= htmlspecialchars($fila['ci']) ?></td>
                  <td><?= date('d-m-Y', strtotime($fila['fecha_entrada'])) ?></td>
                  <td><?= date('g:i A', strtotime($fila['fecha_entrada'])) ?></td>
                  <td><?= ($fila['fecha_salida'] === '0000-00-00 00:00:00' || empty($fila['fecha_salida'])) ? 'En Línea' : date('d-m-Y', strtotime($fila['fecha_salida'])) ?></td>
                  <td><?= ($fila['fecha_salida'] === '0000-00-00 00:00:00' || empty($fila['fecha_salida'])) ? 'En Línea' : date('g:i A', strtotime($fila['fecha_salida'])) ?></td>
                  <td><?= htmlspecialchars($fila['nombre']) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center text-white">No hay información disponible.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>

    <nav class="d-flex justify-content-center">
      <ul class="pagination pagination-dark">
       <nav class="d-flex justify-content-center">
  <ul class="pagination pagination-dark">

    <!-- Botón anterior -->
    <?php if ($paginaActual > 1): ?>
      <li class="page-item">
        <a class="page-link bg-dark text-white border-secondary"
           href="?pagina=<?= $paginaActual - 1 ?><?= isset($rename) ? "&fecha_inicio=" . urlencode($fecha_inicio) . "&fecha_final=" . urlencode($fecha_final) : "" ?>">
           &laquo;
        </a>
      </li>
    <?php endif; ?>

    <!-- Números de página -->
    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
      <li class="page-item <?= $i == $paginaActual ? 'active' : '' ?>">
        <a class="page-link <?= $i == $paginaActual ? 'bg-primary border-primary text-white' : 'bg-dark text-white border-secondary' ?>"
           href="?pagina=<?= $i ?><?= isset($rename) ? "&fecha_inicio=" . urlencode($fecha_inicio) . "&fecha_final=" . urlencode($fecha_final) : "" ?>">
           <?= $i ?>
        </a>
      </li>
    <?php endfor; ?>

    <!-- Botón siguiente -->
    <?php if ($paginaActual < $totalPaginas): ?>
      <li class="page-item">
        <a class="page-link bg-dark text-white border-secondary"
           href="?pagina=<?= $paginaActual + 1 ?><?= isset($rename) ? "&fecha_inicio=" . urlencode($fecha_inicio) . "&fecha_final=" . urlencode($fecha_final) : "" ?>">
           &raquo;
        </a>
      </li>
    <?php endif; ?>

  </ul>
</nav>


      </ul>
    </nav>
  </main>
</body>

<script src="<?= BASE_URL ?>/libs/jspdf.umd.min.js"></script>
<script src="<?= BASE_URL ?>/libs/jspdf.plugin.autotable.min.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/exportarPDF.js"></script>
</html>