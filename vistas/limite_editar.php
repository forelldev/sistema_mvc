<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Límite</title>
</head>
<body>
    <a href="<?= BASE_URL ?>/limites">Volver</a>
    <h1 class="mensaje"><?= isset($msj) ? htmlspecialchars($msj) : '' ?></h1>
    <form action="consulta_limite" method="POST">
        <label for="nombre_rol">Nombre del rol:</label>
        <input type="text" id="nombre_rol" name="nombre_rol" placeholder="Nombre del rol" required value="<?= htmlspecialchars($datos['nombre_rol'] ?? '') ?>" readonly>

        <label for="limite">Límite:</label>
        <input type="text" id="limite" name="limite" value="<?= htmlspecialchars($datos['limite'] ?? '') ?>" placeholder="Límite de rol deseado" required>

        <input type="hidden" name="id_rol" value="<?= htmlspecialchars($datos['id_rol'] ?? '') ?>">
        <input type="submit" value="Cambiar">
    </form>
    <?php if (!empty($excedentes)): ?>
        <h2>Usuarios excedentes para el rol</h2>
        <p>Debes eliminar <?= count($excedentes) ?> usuario(s) para cumplir con el nuevo límite.</p>

        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acción</th>
            </tr>
            <?php foreach ($excedentes as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['ci']) ?></td>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td>
                    <form method="POST" action="eliminar_usuario">
                        <input type="hidden" name="ci" value="<?= $usuario['ci'] ?>">
                        <input type="submit" value="Eliminar">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
<?php endif; ?>

</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>