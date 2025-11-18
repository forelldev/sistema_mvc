<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de acciones</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/reportes.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body">
  <header class="bg-dark text-white py-3 px-4 border-bottom border-secondary">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h1 class="h6 mb-0">Registro de acciones</h1>
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light btn-sm">
        <i class="fa fa-arrow-left me-1"></i> Volver atrás
      </a>
    </div>
  </header>

  <main class="container py-4">
    <section class="mb-4">
      <h2 class="h5 text-white"><i class="fa fa-clipboard-list me-2"></i>Auditoría de Actividades</h2>
      <p class="text-secondary">Consulta las acciones realizadas por los usuarios y administradores del sistema.</p>
    </section>

    <form action="filtro_acciones" method="POST" class="row g-3 align-items-end mb-4">
      <div class="col-md-4">
        <label for="filtro-rol" class="form-label text-white">Oficina</label>
        <select id="filtro-rol" name="oficina" class="form-select bg-dark text-white border-secondary" required>
          <option value="">Seleccione</option>
          <option value="todas" <?= ($oficina ?? '') === 'todas' ? 'selected' : '' ?>>Todas las oficinas</option>
          <option value="General" <?= ($oficina ?? '') === 'General' ? 'selected' : '' ?>>Generales</option>
          <option value="Desarrollo Social" <?= ($oficina ?? '') === 'Desarrollo Social' ? 'selected' : '' ?>>Desarrollo Social</option>
          <option value="Despacho" <?= ($oficina ?? '') === 'Despacho' ? 'selected' : '' ?>>Despacho</option>
        </select>
      </div>

      <div class="col-md-4">
        <label for="filtro-fecha" class="form-label text-white">Fecha</label>
        <input type="date" id="filtro-fecha" name="fecha" class="form-control bg-dark text-white border-secondary" required value="<?= isset($fecha) ? $fecha : '' ?>">
      </div>

      <div class="col-md-4">
        <button type="submit" class="btn btn-primary w-100">
          <i class="fa fa-search me-1"></i> Filtrar
        </button>
      </div>
    </form>

    <div class="mb-3">
      <button class="btn btn-success" id="btnPDF" onclick="generarPDF()">
        <i class="fa fa-file-pdf me-1"></i> Exportar PDF
      </button>
    </div>

    <div class="table-responsive mb-4">
      <table class="table table-dark table-bordered table-hover align-middle text-center" id="exportarPDF">
        <thead class="bg-primary text-white">
          <tr>
            <th>Número</th>
            <th>CI</th>
            <th>Nombre</th>
            <th>Fecha de la acción</th>
            <th>Hora de la acción</th>
            <th class="text-start">Acción</th>
            <th>N° Documento</th>
            <th>Enlace</th>
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

                $idReferencia = match ($origen) {
                  'despacho' => $fila['id_despacho'] ?? null,
                  'desarrollo' => $fila['id_des'] ?? null,
                  default => $fila['id_doc'] ?? null
                };

                $queryParams = http_build_query([
                  'id' => $idReferencia,
                  'direccion' => $direccion
                ]);

                $url = BASE_URL . "/ver_solicitud_accion?" . $queryParams
              ?>
              <tr>
                <td><?= $id ?></td>
                <td><?= $ci ?></td>
                <td><?= $nombre ?></td>
                <td><?= $fecha ?></td>
                <td><?= $hora ?></td>
                <td class="text-start"><?= $accion ?></td>
                <td><?= $id_manual ?></td>
                <td>
                  <a href="<?= htmlspecialchars($url) ?>" class="btn btn-outline-info btn-sm">
                    <i class="fa fa-eye me-1"></i> Ver Solicitud
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" class="text-center text-white">No hay información disponible.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <nav class="d-flex justify-content-center">
      <ul class="pagination pagination-dark">
        

        <nav class="d-flex justify-content-center">
  <ul class="pagination pagination-dark">

    <!-- Botón anterior -->
    <?php if ($paginaActual > 1): ?>
      <li class="page-item">
        <a class="page-link bg-dark text-white border-secondary"
           href="?pagina=<?= $paginaActual - 1 ?><?= isset($rename) ? "&fecha=" . urlencode($fecha) . "&oficina=" . urlencode($oficina) : "" ?>">
           &laquo;
        </a>
      </li>
    <?php endif; ?>

    <!-- Números de página -->
    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
      <li class="page-item <?= $i == $paginaActual ? 'active' : '' ?>">
        <a class="page-link <?= $i == $paginaActual ? 'bg-primary border-primary text-white' : 'bg-dark text-white border-secondary' ?>"
           href="?pagina=<?= $i ?><?= isset($rename) ? "&fecha=" . urlencode($fecha) . "&oficina=" . urlencode($oficina) : "" ?>">
           <?= $i ?>
        </a>
      </li>
    <?php endfor; ?>

    <!-- Botón siguiente -->
    <?php if ($paginaActual < $totalPaginas): ?>
      <li class="page-item">
        <a class="page-link bg-dark text-white border-secondary"
           href="?pagina=<?= $paginaActual + 1 ?><?= isset($rename) ? "&fecha=" . urlencode($fecha) . "&oficina=" . urlencode($oficina) : "" ?>">
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
<script src="<?= BASE_URL ?>/public/js/exportarPDF.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<?php
$mensaje = $msj ?? ($_GET['msj'] ?? null);
if ($mensaje):
?>
    <script>
        mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 3000);
    </script>
<?php endif; ?>
</html>