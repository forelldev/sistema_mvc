<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felicidades!</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body bg-dark text-white">
  <header class="header bg-secondary text-white py-3 px-4 d-flex justify-content-between align-items-center">
    <div class="titulo-header h4 m-0">¡Registrado con éxito!</div>
    <div class="header-right">
      <a href="<?=BASE_URL?>/main">
        <button class="nav-btn btn btn-sm btn-outline-light">
          <i class="fa fa-home"></i> Inicio
        </button>
      </a>
    </div>
  </header>

  <main class="py-5 px-3">
    <div class="registro-card form-user text-center bg-secondary text-white rounded shadow-sm p-4">
        <h1>
        <i class="fa fa-check-circle text-info"></i>
        Solicitud (General) enviada con éxito!
        </h1>
        <h2 class="submensaje">Serás redirigido en breve.</h2>
    </div>
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