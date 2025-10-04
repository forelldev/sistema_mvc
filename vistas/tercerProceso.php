<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tercer Proceso</title>
</head>
<body>
    <h1 class="mensaje"><?= isset($msj) ? htmlspecialchars($msj) : '' ?></h1>
    <!-- En caso de que exista la busqueda a través de get osea que ingresó a una pues se le pone boton de exportar en word o pdf, en caso de que no pues no existe este botón -->
     <table>
        <?php if (!empty($datos)): ?>
        <tr>
            <th>Constancia tipo</th>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Ver Documento</th>
        </tr>
            <?php foreach ($datos as $fila): ?>
        <tr>
            <td><?= htmlspecialchars($fila['tipo']) ?></td>
            <td><?= htmlspecialchars($fila['ci']) ?></td>
            <td><?= htmlspecialchars($fila['nombre']) ?></td>
            <td><?= htmlspecialchars($fila['apellido']) ?></td>
            <td><a href="<?= BASE_URL ?>/generar_word?id=<?= $fila['id']; ?>">Generarlo en Word</a></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="solicitud-card">
                <div class="solicitud-header">
                    <span class="solicitud-estado">Sin información</span>
                </div>
                <div class="solicitud-info">
                    No hay información disponible.
                </div>
            </div>
        <?php endif; ?>
     </table>
     <a href="<?= BASE_URL ?>/main">Volver</a>
     <a href="<?= BASE_URL ?>/registro_constancia">Registrar Constancia</a>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>