<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del beneficiario</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <h2>Información del Beneficiario</h2>
    <a href="<?= BASE_URL ?>/">Volver</a>
    <?php if (isset($beneficiario)): ?>
        <table border="1" cellpadding="8" cellspacing="0">
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
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php else: ?>
        <p>No se han recibido datos para mostrar.</p>
    <?php endif; ?>
</body>

<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/dropdown.js"></script>
</html>