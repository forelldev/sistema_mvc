<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de acciones</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>CI</th>
                <th>Nombre</th>
                <th>Fecha de acción</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($datos)):  ?>
                <?php foreach ($datos as $fila): ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['ci']) ?></td>
                        <td><?= htmlspecialchars($fila['nombre']) ?></td>
                        <td><?= htmlspecialchars($fila['fecha']) ?></td>
                        <td><?= htmlspecialchars($fila['accion']) ?></td>
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
</html>