<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del beneficiario</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/beneficiario.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body">
  <main class="container my-5">
    <section class="card shadow-sm rounded-4 benef-card-lista">
      <div class="card-body">
        <h2 class="mb-4 text-white">
          <i class="fa fa-user me-2"></i> Información del Beneficiario
        </h2>

        <?php if ($_SESSION['id_rol'] == 2): ?>
          <a href="<?= BASE_URL ?>/main" class="btn btn-sm benef-btn-volver mb-3">
            <i class="fa fa-arrow-left me-1"></i> Volver
          </a>
        <?php else: ?>
          <a href="<?= BASE_URL ?>/beneficiarios_lista" class="btn btn-sm benef-btn-volver mb-3">
            <i class="fa fa-arrow-left me-1"></i> Volver
          </a>
        <?php endif; ?>

        <?php if (isset($beneficiario)): ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-dark table-striped align-middle text-center benef-tabla">
              <thead class="benef-thead">
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Cédula</th>
                  <th>Teléfono</th>
                  <th>Comunidad</th>
                  <th>Edad</th>
                  <th>Fecha de Nacimiento</th>
                  <th>Estado Civil</th>
                  <th>Trabajo</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?= htmlspecialchars($beneficiario['nombre'] ?? '') ?></td>
                  <td><?= htmlspecialchars($beneficiario['apellido'] ?? '') ?></td>
                  <td><?= htmlspecialchars($beneficiario['ci'] ?? '') ?></td>
                  <td><?= htmlspecialchars($beneficiario['telefono'] ?? 'No tiene o aún no se ha registrado') ?></td>
                  <td><?= htmlspecialchars($beneficiario['comunidad'] ?? 'Sin registrar') ?></td>
                  <td>
                    <?php
                    if (!empty($beneficiario['fecha_nacimiento'])) {
                      $fechaNacimiento = new DateTime($beneficiario['fecha_nacimiento']);
                      $hoy = new DateTime();
                      $edad = $fechaNacimiento->diff($hoy)->y;
                      echo htmlspecialchars($edad);
                    } else {
                      echo 'Sin registrar';
                    }
                    ?>
                  </td>
                  <td>
                    <?= isset($beneficiario['fecha_nacimiento']) && trim($beneficiario['fecha_nacimiento']) !== ''
                      ? htmlspecialchars(date('d-m-Y', strtotime($beneficiario['fecha_nacimiento'])))
                      : 'Sin registrar' ?>
                  </td>
                  <td><?= htmlspecialchars($beneficiario['estado_civil'] ?? 'Sin registrar') ?></td>
                  <td><?= htmlspecialchars($beneficiario['trabajo'] ?? 'Sin registrar') ?></td>
                  <td>
                    <a href="<?= BASE_URL ?>/solicitudes_beneficiario?ci=<?= $beneficiario['ci'] ?>" class="benef-btn-ver">
                      Ver todas las solicitudes del beneficiario
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        <?php elseif (isset($error)): ?>
          <p class="text-danger text-center"><?= htmlspecialchars($error) ?></p>
        <?php else: ?>
          <p class="text-center text-white">No se han recibido datos para mostrar.</p>
        <?php endif; ?>
      </div>
    </section>
  </main>
</body>

    <script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
    <script>
        const BASE_PATH = "<?php echo BASE_PATH; ?>";
    </script>
    <script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>