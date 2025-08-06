<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de ayuda</title>
</head>
<body>
    <?php if($_SESSION['id_rol'] !== 2){?>
        <form action="<?=BASE_URL?>/buscar_cedula" method="POST">
            <input type="text" name="ci" placeholder="Ingrese su CI">
            <input type="submit" value="Buscar">
        </form>
    <?php  } else {?>
        <form action="<?=BASE_URL?>/buscar_cidespacho" method="POST">
            <input type="text" name="ci" placeholder="Ingrese su CI">
            <input type="submit" value="Buscar">
        </form>
    <?php  } ?>
    <a href="<?=BASE_URL?>/main">Volver</a>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>