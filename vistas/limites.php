<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Límite de cuentas por roles</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/beneficiario_list.css?v=<?= time(); ?>">
</head>
<body class="bg-dark text-white">
  <div class="container py-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="mb-0">Límites de cuentas por roles</h4>
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light">
        <i class="fa fa-arrow-left"></i> Volver atrás
      </a>
    </div>

    <!-- Tabla de auditoría -->
    <div class="card bg-secondary bg-opacity-10 border-0 shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-dark table-bordered table-hover align-middle mb-0">
            <thead class="thead-light-gray">
              <tr>
                <th scope="col">Rol</th>
                <th scope="col">Número de cuentas</th>
                <th scope="col">Límite de cuentas</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($datos)): ?>
                <?php foreach ($datos as $fila): ?>
                  <tr>
                    <td><?= htmlspecialchars($fila['nombre_rol']) ?></td>
                    <td><?= htmlspecialchars($fila['num_cuentas']) ?></td>
                    <td><?= htmlspecialchars($fila['limite']) ?></td>
                    <td>
                      <a href="<?= BASE_URL ?>/limite_editar?id_rol=<?= htmlspecialchars($fila['id_rol']) ?>" class="btn btn-sm btn-outline-secondary text-white">
                        Cambiar Límite
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="4" class="text-center">No hay información disponible.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
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
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>