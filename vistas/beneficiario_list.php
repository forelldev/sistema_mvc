<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Beneficiarios Registrados</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/beneficiario.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body bg-dark text-white">
  <header class="sol-header d-flex justify-content-between align-items-center px-4 py-3">
    <div class="sol-header-title h4 m-0">Lista de beneficiarios</div>
    <div class="sol-header-actions d-flex gap-2">
      <a href="<?= BASE_URL ?>/registro_beneficiario" class="btn sol-btn-principal">
        <i class="fa fa-plus me-1"></i> Registrar Beneficiario
      </a>
      <a href="<?= BASE_URL ?>/main" class="btn btn-volver btn-sm btn-outline-light">
        <i class="fa fa-home"></i> Inicio
      </a>
    </div>
  </header>
  <section class="benef-filtros py-5">
  <div class="container">
    <h2 class="mb-2 text-white">🔍 Búsqueda Rápida</h2>
    <p class="benef-filtros-desc mb-4">
      Esta sección te permite localizar rápidamente a los beneficiarios registrados en el sistema mediante su nombre, apellido o cédula.
    </p>
    <form action="<?= BASE_URL ?>/buscar_beneficiario" method="POST" autocomplete="off" class="row g-2">
      <div class="col-md-9">
        <input type="search"
               name="filtro_busqueda"
               class="form-control"
               placeholder="Buscar beneficiarios..."
               required
               value="<?= htmlspecialchars($_POST['filtro_busqueda'] ?? '') ?>">
      </div>
      <div class="col-md-3 d-grid">
        <button type="submit" class="btn sol-btn-buscar">Buscar</button>
      </div>
    </form>
  </div>
</section>


 <main class="container my-5">
  <section class="card shadow-sm rounded-4 benef-card-lista">
    <div class="card-body">
      <h3 class="mb-4 text-white">📋 Lista de Beneficiarios</h3>
      <div class="table-responsive">
        <?php if (!empty($datos)): ?>
          <table class="table table-bordered table-hover table-dark table-striped align-middle text-center benef-tabla">
            <thead class="benef-thead">
              <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Ver Información</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($datos as $fila): ?>
                <tr>
                  <td><?= htmlspecialchars($fila['nombre']) ?></td>
                  <td><?= htmlspecialchars($fila['apellido']) ?></td>
                  <td><?= htmlspecialchars($fila['ci']) ?></td>
                  <td>
                    <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= $fila['ci']; ?>" class="btn benef-btn-ver btn-sm">
                      Ver información
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="alert alert-warning text-center" role="alert">
            <strong>Sin información:</strong> No hay beneficiarios registrados en este momento.
          </div>
        <?php endif; ?>
      </div>
    </div>
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