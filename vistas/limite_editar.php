<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Límite</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/formularios.css?v=<?php echo time(); ?>">
</head>
<body class="bg-dark text-white">
  <div class="container py-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="mb-0">Editar Límite</h4>
      <div>
        <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light me-2">
          <i class="fa fa-home"></i> Inicio
        </a>
        <a href="<?= BASE_URL ?>/limites" class="btn btn-outline-light">
          <i class="fa fa-arrow-left"></i> Volver atrás
        </a>
      </div>
    </div>

    <!-- Formulario -->
    <div class="card bg-secondary bg-opacity-10 border-0 shadow-sm mb-4">
      <div class="card-body">
        <form action="consulta_limite" method="POST" autocomplete="off">
          <h5 class="mb-3 text-white"><i class="fa fa-pencil-alt"></i> Edita el límite</h5>
          <div class="mb-3 text-white">
            <label for="nombre_rol" class="form-label">Nombre del rol</label>
            <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" placeholder="Nombre del rol" required value="<?= htmlspecialchars($datos['nombre_rol'] ?? '') ?>" readonly>
          </div>
          <div class="mb-3 text-white">
            <label for="limite" class="form-label">Límite</label>
            <input type="text" class="form-control" id="limite" name="limite" placeholder="Límite de rol deseado" required value="<?= htmlspecialchars($datos['limite'] ?? '') ?>">
            <input type="hidden" name="id_rol" value="<?= htmlspecialchars($datos['id_rol'] ?? '') ?>">
          </div>
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-check"></i> Cambiar
          </button>
        </form>
      </div>
    </div>

    <!-- Usuarios excedentes -->
    <?php if (!empty($excedentes)): ?>
      <div class="mb-3">
        <h5><i class="fa fa-users"></i> Usuarios excedentes para el rol</h5>
        <p>Debes eliminar <?= count($excedentes) ?> usuario(s) para cumplir con el nuevo límite.</p>
      </div>

      <div class="card bg-secondary bg-opacity-10 border-0 shadow-sm">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-dark table-bordered align-middle mb-0">
              <thead class="thead-light-gray">
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($excedentes as $usuario): ?>
                  <tr>
                    <td><?= htmlspecialchars($usuario['ci']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                    <td>
                      <form method="POST" action="<?= BASE_URL ?>/eliminar_usuario" class="d-inline">
                        <input type="hidden" name="ci" value="<?= $usuario['ci'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                          Eliminar
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php endif; ?>
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
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>