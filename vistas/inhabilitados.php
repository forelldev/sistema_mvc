<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Solicitudes inhabilitadas</title>
</head>
<body>
    <a href="<?=BASE_URL?>/main">Volver</a>
    <a href="<?=BASE_URL?>/solicitudes_list">Ver Solicitudes Habilitadas</a>
    <table>
    <thead>
        <tr>
            <th>Descripción</th>
            <th>Tipo de Ayuda</th>
            <th>Categoría</th>
            <th>Número</th>
            <th>Fecha de la Solicitud</th>
            <th>Cédula del Beneficiario</th>
            <th>Remitente</th>
            <th>Observaciones</th>
            <th>Estado del documento</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($datos)):  ?>
            <?php foreach ($datos as $fila): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['descripcion']) ?></td>
                    <td><?= htmlspecialchars($fila['tipo_ayuda']) ?></td>
                    <td><?= htmlspecialchars($fila['categoria'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['id_manual'] ?? '') ?></td>
                    <td><?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha'])))?></td>
                    <td><?= htmlspecialchars($fila['ci'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['remitente'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['observaciones'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['estado'] ?? '') ?></td>
                    <td><a href="<?= BASE_URL ?>">Ver Información del beneficiario</a></td>
                    <td><a href="<?= BASE_URL.'/editar?id_doc='.$fila['id_doc']  ?>">Editar</a></td>
                    <td><a href="<?= BASE_URL.'/habilitar?id_doc='.$fila['id_doc'] ?>">Habilitar</a></td>
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