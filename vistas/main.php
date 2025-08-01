<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
</head>
<body>
    <div>
        <p>Rol: <?= $_SESSION['rol'] ?></p>
    </div>
    <p>Has iniciado sesión correctamente.</p>
    <a href="<?=BASE_URL?>/solicitudes_list">Solicitudes de Ayuda</a>
    <a href="<?=BASE_URL?>/registro">Registrar Persona</a>
    <a href="<?=BASE_URL?>/logout">Cerrar Sesión</a>
</body>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>