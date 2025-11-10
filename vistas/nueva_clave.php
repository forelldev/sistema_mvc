<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/placeholder.css?v=<?php echo time(); ?>">
</head>
<body class="bg-dark text-light d-flex align-items-center justify-content-center min-vh-100">
  <div class="card bg-secondary text-light shadow-lg p-4" style="max-width: 400px; width: 100%;">
    
    <div class="mb-3 text-start">
      <a href="<?=BASE_URL?>/" class="btn btn-dark text-white btn-sm">
        <i class="fa fa-arrow-left me-1"></i> Volver
      </a>
    </div>

    <form id="formClave" action="<?=BASE_URL?>/actualizar_clave" method="POST" autocomplete="off">
      <div class="mb-3">
        <label for="clave_nueva" class="form-label">Nueva contraseña</label>
        <div class="input-group">
          <input
            type="password"
            name="clave_nueva"
            id="clave_nueva"
            class="form-control bg-dark text-light border-light"
            placeholder="Nueva contraseña"
            required
          >
          <button type="button" class="btn btn-outline-light bg-dark border-light" onclick="togglePassword('clave_nueva')">
            <i class="fa fa-eye"></i>
          </button>
        </div>
      </div>

      <div class="mb-3">
        <label for="confirmar_clave" class="form-label">Confirmar contraseña</label>
        <div class="input-group">
          <input
            type="password"
            name="confirmar_clave"
            id="confirmar_clave"
            class="form-control bg-dark text-light border-light"
            placeholder="Confirmar contraseña"
            required
          >
          <button type="button" class="btn btn-outline-light bg-dark border-light" onclick="togglePassword('confirmar_clave')">
            <i class="fa fa-eye"></i>
          </button>
        </div>
      </div>

      <div class="d-grid mb-2">
        <button type="submit" class="btn btn-dark fw-bold">
          Cambiar Contraseña
        </button>
      </div>

      <p id="error" class="text-danger small"></p>
    </form>
  </div>
</body>


 <script>
        function togglePassword(id) {
            const campo = document.getElementById(id);
            campo.type = campo.type === "password" ? "text" : "password";
        }
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
</html>