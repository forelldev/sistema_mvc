<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solicitud</title>
</head>
<body>
    <a href="<?=BASE_URL?>/main">Volver</a>
    <h1 class="mensaje"><?= isset($msj) ? htmlspecialchars($msj) : '' ?></h1>
    <form action="editar_solicitudDespacho" method="POST">
        <label for="id_manual">Número de documento:</label>
            <input type="text" id="id_manual" name="id_manual" placeholder="00004578" required value="<?= htmlspecialchars($datos['id_manual'] ?? '') ?>">
        <label for="asunto">Asunto:</label>
            <input type="text" id="asunto" name="asunto" value="<?= htmlspecialchars($datos['asunto'] ?? '') ?>" placeholder="Ejem: Ayuda para silla de ruedas" required>
            <input type="hidden" name="id_doc" value=<?= htmlspecialchars($datos['id_doc'] ?? '') ?>>
            <input type="submit" value="Enviar">
    </form>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>