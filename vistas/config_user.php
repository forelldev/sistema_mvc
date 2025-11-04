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
            <h2 class="text-primary">Configuración de Usuario</h2>
            <a href="<?=BASE_URL?>/main" class="btn btn-outline-secondary">← Volver</a>
        </header>

        <form action="<?=BASE_URL?>/configurar_usuario" autocomplete="off" method="POST" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required value="<?=$datos['nombre']?>">
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" name="apellido" id="apellido" class="form-control" required value="<?=$datos['apellido']?>">
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
     <div class="text-end mt-3">
            <a href="<?=BASE_URL?>/config_avanzada" class="btn btn-link">Configuración avanzada</a>
    </div>
</body>

</html>