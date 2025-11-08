<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesión</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/login.css?v=<?= time(); ?>">
</head>
<body class="login-body d-flex align-items-center justify-content-center min-vh-100">
  <div class="card login-card shadow-lg">
    <div class="text-center mb-3">
      <img src="<?= BASE_URL ?>/img/logo.png" alt="Logo" class="img-fluid mb-2" style="max-height: 90px;">
      <h5 class="fw-semibold">Bienvenido</h5>
    </div>

    <form action="<?=BASE_URL?>/login" method="POST" autocomplete="off">
      <div class="mb-3">
        <label for="ci" class="form-label text-gray-dark">Cédula</label>
        <div class="input-group">
          <span class="input-group-text bg-light text-secondary"><i class="fa fa-id-card"></i></span>
          <input type="text" name="ci" id="ci" class="form-control" required placeholder="Ingresa tu CI" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
      </div>

      <div class="mb-3">
        <label for="clave" class="form-label text-gray-dark">Contraseña</label>
        <div class="input-group">
          <span class="input-group-text bg-light text-secondary"><i class="fa fa-lock"></i></span>
          <input type="password" name="clave" id="clave" class="form-control" required placeholder="Ingresa tu contraseña">
          <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">
            <i class="fa fa-eye" id="eye-icon"></i>
          </button>
        </div>
      </div>

      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-dark text-white fw-bold">Iniciar Sesión</button>
      </div>

      <div class="text-center">
        <a href="recuperacion_clave" class="text-decoration-underline small text-blue-dark">¿Olvidaste tu contraseña?</a>
      </div>
    </form>
  </div>
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
<script src="<?= BASE_URL ?>/public/js/contra.js"></script>
<style>

  .responsive-card {
    max-width: 360px;
  }

  @media (min-width: 768px) {
    .responsive-card {
      margin-top: -80px;
      max-width: 420px;
    }
  }

  @media (min-width: 992px) {
    .responsive-card {
      margin-top: -100px;
      max-width: 480px;
    }
  }
  
</style>
</html>