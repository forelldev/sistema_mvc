<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Límite de cuentas por roles</title>
</head>
<body>
    <a href="<?= BASE_URL ?>/main">Volver</a>
    <table>
        <thead>
            <tr>
                <th>Rol</th>
                <th>Número de cuentas con este rol</th>
                <th>Límite de cuentas</th>
            </tr>
        </thead>
        <tbody> 
        <?php if (!empty($datos)):  ?>
            <?php foreach ($datos as $fila): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['nombre_rol']) ?></td>
                    <td><?= htmlspecialchars($fila['num_cuentas']) ?></td>
                    <td><?= htmlspecialchars($fila['limite']) ?></td>
                    <td><a href="<?= BASE_URL ?>/limite_editar?id_rol=<?= htmlspecialchars($fila['id_rol'])?>">Cambiar Límite</a></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No hay información disponible.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>