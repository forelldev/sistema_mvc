<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Solicitudes inhabilitadas</title>
</head>
<body>
    <a href="<?=BASE_URL?>/main">Volver</a>
    <a href="<?=BASE_URL?>/despacho_list">Ver Solicitudes Habilitadas</a>
    <table>
    <thead>
        <tr>
            <th>Asunto</th>
            <th>Número de documento</th>
            <th>Fecha de Creación</th>
            <th>Cédula de Identidad</th>
            <th>Estado</th>
            <th>Creador</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($datos)):  ?>
            <?php foreach ($datos as $fila): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['asunto']) ?></td>
                    <td><?= htmlspecialchars($fila['id_manual']) ?></td>
                    <td><?= htmlspecialchars(date('d-m-Y', strtotime($fila['fecha'])))?></td>
                    <td><?= htmlspecialchars($fila['ci'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['estado'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['creador'] ?? '') ?></td>
                    <td><a href="<?= BASE_URL ?>">Ver Información del beneficiario</a></td>
                    <td><a href="<?= BASE_URL.'/editarDespacho?id_doc='.$fila['id_doc']  ?>">Editar</a></td>
                    <td><a href="<?= BASE_URL.'/habilitarDespacho?id_doc='.$fila['id_doc'] ?>">Habilitar</a></td>
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