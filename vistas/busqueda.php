<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de ayuda</title>
</head>
<body>
    <form action="<?=BASE_URL?>/solicitud_registro" method="POST">
        <input type="text" name="ci" placeholder="Ingrese su CI">
        <input type="submit" value="Buscar">
    </form>
    <a href="<?=BASE_URL?>/main">Volver</a>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>