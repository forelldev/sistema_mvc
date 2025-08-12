<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Solicitudes</title>
</head>
<body>
    <?php if($_SESSION['id_rol'] == 1 || $_SESSION['id_rol'] == 4){?>
        <a href="<?=BASE_URL?>/busqueda">Rellenar Formulario</a>
    <?php } ?>
    <a href="<?=BASE_URL?>/main">Volver</a>
    <?php if($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4){?>
        <a href="<?=BASE_URL?>/inhabilitados_lista">Ver Solicitudes Inhabilitadas</a>
    <?php } ?>
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
                    <?php if($_SESSION['id_rol'] == 2 || $_SESSION['id_rol'] == 4){?>
                        <td><a href="<?= BASE_URL.'/inhabilitar?id_doc='.$fila['id_doc'] ?>">Inhabilitar</a></td>
                    <?php } ?>
                    <td><a href="<?= BASE_URL.'/procesar?id_doc='.$fila['id_doc'].'&estado='.$fila['estado'] ?>"><?= $accion = isset($acciones[$fila['estado']]) ? $acciones[$fila['estado']] : 'Acción desconocida'; ?></a></td>
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