<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invalidar Solicitud - Desarrollo Social</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/edicion.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body bg-dark text-white">
  <!-- Header -->
  <header class="bg-secondary text-white py-3 px-4 d-flex justify-content-between align-items-center">
    <h1 class="h5 mb-0">Invalidar Solicitud - Desarrollo Social</h1>
    <div class="d-flex gap-2">
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light btn-sm">
        <i class="fa fa-home me-1"></i> Inicio
      </a>
      <a href="<?= BASE_URL ?>/solicitudes_list" class="btn btn-outline-light btn-sm">
        <i class="fa fa-arrow-left me-1"></i> Volver atrás
      </a>
    </div>
  </header>

  <!-- Formulario -->
  <main class="container py-4">
    <form action="inhabilitar_desarrollo" method="POST" class="bg-panel-dark text-white p-4 rounded shadow" autocomplete="off">
      <h2 class="h6 mb-4"><i class="fa fa-ban me-2"></i> Invalidar Solicitud</h2>

      <input type="hidden" name="id_des" value="<?= $id_des ?? 'No hay ID' ?>">

      <div class="mb-3">
        <label for="razon" class="form-label">Razón por la cual será inhabilitada esta solicitud</label>
        <input type="text" name="razon" id="razon" class="form-control"
               placeholder="Razón por la cual será inhabilitada esta solicitud" required>
      </div>

      <button type="submit" class="btn btn-primary">
        <i class="fa fa-check me-1"></i> Aceptar
      </button>
    </form>
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