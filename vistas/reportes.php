<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Cédula de Identidad</th>
                <th>Fecha de Entrada</th>
                <th>Fecha de Salida</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($datos)):  ?>
                <?php foreach ($datos as $fila): ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['id']) ?></td>
                        <td><?= htmlspecialchars($fila['ci']) ?></td>
                        <td><?= htmlspecialchars($fila['fecha_entrada']) ?></td>
                        <td><?= htmlspecialchars($fila['fecha_salida']) ?></td>
                        <td><?= htmlspecialchars($fila['nombre']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                <td colspan="7">No hay información disponible.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>