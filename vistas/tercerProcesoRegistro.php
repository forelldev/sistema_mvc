<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>
<body>
    <h1 class="mensaje"><?= isset($msj) ? htmlspecialchars($msj) : '' ?></h1>
    <form action="<?= BASE_URL ?>/registrar_constancia" method="POST">
        <input type="text" name="id_manual" placeholder="Número de documento">
        <select name="tipo" id="tipo">
            <option value="Fé de vida">Fé de vida</option>
            <option value="Constancia de Soltería">Constancia de Soltería</option>
            <option value="Asiento Permanente">Asiento Permanente</option>
            <option value="Permisos de Mudanza">Permisos de Mudanza</option>
        </select>
        <input type="text" name="ci" placeholder="ci">
        <input type="text" name="nombre" placeholder="nombre">
        <input type="text" name="apellido" placeholder="apellido">
        <input type="submit" value="Registrar Constancia">
    </form>
    <a href="<?= BASE_URL ?>/constancias">Volver</a>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>