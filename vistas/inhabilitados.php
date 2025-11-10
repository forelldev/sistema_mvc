<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Solicitudes inhabilitadas</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/solicitud.css?v=<?= time(); ?>">
</head>
<body class="bg-dark">
  <header class="py-3 px-4 d-flex justify-content-between align-items-center" style="background-color: #2c2f33;">
    <h5 class="mb-0 text-white">Solicitudes inhabilitadas</h5>
    <div>
      <a href="<?=BASE_URL?>/main" class="btn btn-outline-light me-2"><i class="fa fa-home"></i> Inicio</a>
      <a href="<?=BASE_URL?>/solicitudes_list" class="btn btn-outline-light"><i class="fa fa-eye"></i> Ver Solicitudes Habilitadas</a>
    </div>
  </header>

  <main class="container my-4">
    <section class="solicitudes-lista">
      <?php if (!empty($datos)): ?>
        <div class="row g-4">
          <?php foreach ($datos as $fila): ?>
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                  <span class="badge bg-secondary"><?= htmlspecialchars($fila['estado'] ?? '') ?></span>
                  <span class="fecha-solicitud"><?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha']))) ?></span>
                </div>
                <div class="card-body">
                  <p><strong>Descripción:</strong> <?= htmlspecialchars($fila['descripcion']) ?></p>
                  <p><strong>Tipo de Ayuda:</strong> <?= htmlspecialchars($fila['tipo_ayuda']) ?></p>
                  <p><strong>Categoría:</strong> <?= htmlspecialchars($fila['categoria'] ?? '') ?></p>
                  <p><strong>Número de documento:</strong> <?= htmlspecialchars($fila['id_manual'] ?? '') ?></p>
                  <p><strong>Cédula del Beneficiario:</strong> <?= htmlspecialchars($fila['ci'] ?? '') ?></p>
                  <p><strong>Remitente:</strong> <?= htmlspecialchars(($fila['nombre'] ?? '') . ' ' . ($fila['apellido'] ?? '')) ?></p>
                  <p><strong>Observaciones:</strong> <?= htmlspecialchars($fila['observaciones'] ?? '') ?></p>
                </div>
                <div class="card-footer d-flex flex-wrap gap-2">
                  <a href="<?= BASE_URL.'/informacion_beneficiario?ci='.$fila['ci']?>" class="btn btn-filtro">Ver Información del beneficiario</a>
                  <a href="<?= BASE_URL.'/editar?id_doc='.$fila['id_doc'] ?>" class="btn btn-filtro">Editar</a>
                  <a href="<?= BASE_URL.'/habilitar?id_doc='.$fila['id_doc']?>" class="btn btn-filtro">Habilitar</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="card shadow">
          <div class="card-header bg-dark text-white">
            <span class="badge bg-secondary">Sin información</span>
          </div>
          <div class="card-body">
            <p>No hay información disponible.</p>
          </div>
        </div>
      <?php endif; ?>
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
