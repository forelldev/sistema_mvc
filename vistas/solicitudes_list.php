<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Solicitudes</title>
</head>
<body>
    <a href="<?=BASE_URL?>/busqueda">Rellenar Formulario</a>
    <a href="<?=BASE_URL?>/main">Volver</a>
<table>
    <thead>
        <tr>
            <th>Tipo de Ayuda</th>
            <th>Categoría</th>
            <th>Número</th>
            <th>Fecha de Creación</th>
            <th>Cédula del Beneficiario</th>
            <th>Remitente</th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($datos)): ?>
            <?php foreach ($datos as $fila): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['tipo_ayuda']) ?></td>
                    <td><?= htmlspecialchars($fila['categoria'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['numero'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['fecha'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['ci'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['remitente'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fila['observaciones'] ?? '') ?></td>
                    <td><a href="<?= BASE_URL ?>">Ver</a></td>
                    <td><a href="<?= BASE_URL ?>">Editar</a></td>
                    <td><a href="<?= BASE_URL ?>">Inhabilitar</a></td>
                    <td><a href="<?=BASE_URL.'/procesar?id_doc='.$fila['id_doc'].'&estado='.$fila['estado'] ?>">Enviar a <?= 'porahora'?></a></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No hay información disponible.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>