<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de usuario</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    

</head>
<body class="bg-dark text-white">
  <div class="container mt-5">
    <!-- Encabezado -->
    <header class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-white">Configuración de Usuario Avanzada</h2>
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light">
        <i class="fa fa-home me-1"></i> Volver a Inicio
      </a>
    </header>

    <!-- Formulario avanzado -->
    <form autocomplete="off" class="card bg-secondary bg-opacity-10 border-light text-white p-4 shadow-sm" id="form-avanzado">
      <div class="mb-3">
        <label for="ci" class="form-label text-white">Cambiar Cédula:</label>
        <input type="text" name="ci" id="ci" class="form-control bg-dark text-white border-light" required value="<?= $datos['ci'] ?? '' ?>">
      </div>

      <div class="mb-3">
        <label for="nueva_clave" class="form-label text-white">Nueva Clave (En caso de no querer cambiarla repetir clave):</label>
        <input type="password" name="nueva_clave" id="nueva_clave" class="form-control bg-dark text-white border-light" required>
      </div>

      <div class="mb-3">
        <label for="correo" class="form-label text-white">Correo electrónico:</label>
        <input type="email" name="correo" id="correo" class="form-control bg-dark text-white border-light" required value="<?= $datos['correo'] ?? '' ?>">
      </div>

      <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>

    <!-- Contenedor de verificación -->
    <div id="form-verificacion-container" class="mt-4"></div>

    <!-- Enlace de regreso -->
    <div class="text-end mt-3">
      <a href="<?= BASE_URL ?>/config_user" class="btn btn-outline-light">
        <i class="fa fa-arrow-left me-1"></i> Volver a configuración de usuario
      </a>
    </div>
  </div>
</body>


<script>
    const BASE_URL = "<?=BASE_URL?>";
    const BASE_PATH = "<?=BASE_PATH?>";
</script>
<script src="<?=BASE_URL?>/public/js/edit_codigo.js"></script>
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