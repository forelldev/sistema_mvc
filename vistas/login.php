<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesión</title>
</head>
<body>
    <form action="<?= BASE_URL?>/login" method="POST">
        <input type="text" name="ci" required placeholder="CI"><br>
        <input type="password" name="clave" required placeholder="Contraseña"><br>
        <input type="submit" value="Enviar"><br>
    </form>
    <?php if (isset($_GET['msj'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['msj']) ?></p>
    <?php endif; ?> 
</body>
<script src="<?= BASE_URL ?>/vistas/js/sesionReload.js"></script>
</html>