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
      <h2 class="text-white">Configuración de Usuario</h2>
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light">
        <i class="fa fa-home me-1"></i> Volver a Inicio
      </a>
    </header>

    <!-- Formulario -->
    <form action="<?= BASE_URL ?>/configurar_usuario" method="POST" autocomplete="off" class="card bg-secondary bg-opacity-10 border-light text-white p-4 shadow-sm">
      <div class="mb-3">
        <label for="nombre" class="form-label text-white">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control bg-dark text-white border-light" required value="<?= $datos['nombre'] ?>">
      </div>

      <div class="mb-3">
        <label for="apellido" class="form-label text-white">Apellido:</label>
        <input type="text" name="apellido" id="apellido" class="form-control bg-dark text-white border-light" required value="<?= $datos['apellido'] ?>">
      </div>

      <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>

    <!-- Enlace avanzado -->
    <div class="text-end mt-3">
        <a href="<?= BASE_URL ?>/config_avanzada" class="btn btn-outline-light">
            <i class="fa fa-cog me-1"></i> Configuración avanzada
        </a>
    </div>

  </div>
</body>

<script> const BASE_PATH = "<?=BASE_PATH?>"; </script>
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