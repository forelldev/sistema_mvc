<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del beneficiario</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/estadisticas.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="solicitud-body">
    <div class="info-beneficiario-card">
        <h2><i class="fa fa-user"></i> Información del Beneficiario</h2>
        <a href="<?= BASE_URL ?>/beneficiarios_lista" class="volver-btn"><i class="fa fa-arrow-left"></i> Volver</a>
        <?php if (isset($beneficiario)): ?>
            <table class="info-beneficiario-table">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cédula</th>
                </tr>
                <tr>
                    <td><?= htmlspecialchars($beneficiario['nombre']) ?></td>
                    <td><?= htmlspecialchars($beneficiario['apellido']) ?></td>
                    <td><?= htmlspecialchars($beneficiario['ci']) ?></td>
                </tr>
            </table>
        <?php elseif (isset($error)): ?>
            <p style="color: red; text-align:center;"><?= htmlspecialchars($error) ?></p>
        <?php else: ?>
            <p style="text-align:center;">No se han recibido datos para mostrar.</p>
        <?php endif; ?>
    </div>
    <script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
    <script>
        const BASE_PATH = "<?php echo BASE_PATH; ?>";
    </script>
    <script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
    <script src="<?= BASE_URL ?>/public/js/dropdown.js"></script>
</body>
</html>