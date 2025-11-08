<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Beneficiarios Registrados</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="solicitud-body">
    <header class="header">
    <div class="titulo-header">Lista de beneficiarios</div>
    <div class="header-right">
      <a href="<?= BASE_URL ?>/registro_beneficiario"><button class="principal-btn"><i class="fa fa-plus"></i>Registrar Beneficiario</button></a>
      <a href="<?= BASE_URL ?>/main"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
    </div>
  </header>
    <section class="filtros-card"> 
        <div class="container my-4">
        <h2 class="mb-3">🔍 Búsqueda Rápida</h2>
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
            <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
        </div>
    </section>

<main class="container my-5">
  <section class="card shadow-sm rounded-4">
    <div class="card-body">
      <h3 class="mb-4">📋 Lista de Beneficiarios</h3>
      <div class="table-responsive">
        <?php if (!empty($datos)): ?>
          <table class="table table-bordered table-hover table-striped align-middle text-center">
            <thead class="table-primary">
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
                    <a href="<?= BASE_URL ?>/informacion_beneficiario?ci=<?= $fila['ci']; ?>" class="btn btn-outline-primary btn-sm">
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