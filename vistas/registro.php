<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registro de usuario</h2>
    <h1 class="mensaje"><?= isset($mensaje) ? htmlspecialchars($mensaje) : '' ?></h1>
    <form action="<?=BASE_URL?>/registro" method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="text" name="ci" placeholder="Cedula de Identidad" required><br>
        <input type="password" name="clave" placeholder="Contraseña" required><br>
        <select name="id_rol">
            <option value="1">Promotor Social</option>
            <option value="2">Despacho</option>
            <option value="3">Administración</option>
            <option value="4">Administrador Principal</option>
        </select>
        <button type="submit">Registrar Persona</button>
        <a href="<?=BASE_URL?>/main">Volver</a>
    </form>
</body>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>