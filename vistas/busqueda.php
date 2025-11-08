<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de ayuda</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/busqueda.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body bg-dark text-white">
  <!-- Header -->
  <header class="bg-secondary border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
    <h5 class="mb-0 fw-semibold">Verificar si el beneficiario ya está registrado</h5>
    <div class="d-flex gap-2">
      <a href="<?= BASE_URL ?>/main" class="btn btn-sm btn-outline-light">
        <i class="fa fa-home me-1"></i> Inicio
      </a>
      <?php $url = isset($direccion) && $direccion ? '/nueva_solicitud' : '/solicitudes_list'; ?>
      <a href="<?= BASE_URL . $url ?>" class="btn btn-sm btn-outline-light">
        <i class="fa fa-arrow-left me-1"></i> Volver atrás
      </a>
    </div>
  </header>

  <!-- Main -->
  <main class="container py-5">
    <div class="card form-card text-white shadow-sm border-0 mx-auto" style="max-width: 480px;">
  <div class="card-body">
    <form action="<?= BASE_URL ?>/formulario" method="POST" autocomplete="off">
      <h5 class="card-title mb-3"><i class="fa fa-search me-2"></i> Buscar por Cédula</h5>
      <p class="small text-white-50 mb-4">Ingresa la cédula del beneficiario para verificar si ya está registrado en el sistema.</p>

      <div class="mb-3">
        <label for="ci" class="form-label">Cédula de Identidad</label>
        <input type="text" name="ci" id="ci" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Ej. 12345678" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-sm btn-outline-light px-4">
          <i class="fa fa-search me-1"></i> Buscar
        </button>
      </div>
    </form>
  </div>
</div>
  </main>
</body>

<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>