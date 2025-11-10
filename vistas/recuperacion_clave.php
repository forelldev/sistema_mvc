<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/placeholder.css?v=<?php echo time(); ?>">
</head>
<body class="bg-dark text-light d-flex align-items-center justify-content-center min-vh-100">
  <div class="card bg-secondary text-light shadow-lg p-4" style="max-width: 400px; width: 100%;">
    
    <div class="mb-3 text-start">
      <a href="<?=BASE_URL?>/" class="text-white btn btn-dark text-decoration-none small">
        <i class="fa fa-arrow-left me-1"></i> Volver
      </a>
    </div>

    <form action="<?=BASE_URL?>/recuperar_clave" method="POST" autocomplete="off">
      <div class="mb-3">
        <label for="correo" class="form-label">Ingresa tu correo:</label>
        <input
            type="text"
            name="correo"
            id="correo"
            class="form-control text-light bg-dark border-light"
            placeholder="Ingresa tu correo electrónico"
            required
            >

      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-dark fw-bold">
          Recuperar
        </button>
      </div>
    </form>
  </div>
</body>

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