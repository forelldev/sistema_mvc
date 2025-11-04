<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de usuario</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Configuración de Usuario Avanzada</h2>
            <a href="<?=BASE_URL?>/main" class="btn btn-outline-secondary">← Volver</a>
        </header>

        <form autocomplete="off" class="card p-4 shadow-sm" id="form-avanzado">
            <div class="mb-3">
                <label for="ci" class="form-label">Cambiar Cédula:</label>
                <input type="text" name="ci" id="ci" class="form-control" required value="<?=$datos['ci'] ?? ''?>">
            </div>

            <div class="mb-3">
                <label for="nueva_clave" class="form-label">Nueva Clave (En caso de no querer cambiarla repetir clave):</label>
                <input type="password" name="nueva_clave" id="nueva_clave" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" name="correo" id="correo" class="form-control" required value="<?=$datos['correo'] ?? ''?>">
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>

        <div id="form-verificacion-container" class="mt-4"></div>

        <div class="text-end mt-3">
            <a href="<?=BASE_URL?>/config_user" class="btn btn-link">Volver a configuración de usuario</a>
        </div>
    </div>
</body>

<script>
    const BASE_URL = "<?=BASE_URL?>";
</script>
<script src="<?=BASE_URL?>/public/js/edit_codigo.js"></script>
</html>