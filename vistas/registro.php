<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/edicion.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body">
  <header class="bg-dark text-white py-3 px-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h1 class="h6 mb-0">Registro de usuario</h1>
      <a href="<?= BASE_URL ?>/main" class="btn btn-volver btn-sm">
        <i class="fa fa-arrow-left"></i> Volver atrás
      </a>
    </div>
  </header>

  <main class="container py-4">
    <form action="<?= BASE_URL ?>/registro" method="POST" class="bg-panel-dark text-white p-4 rounded shadow" autocomplete="off">
      <h2 class="h5 mb-4"><i class="fa fa-user-plus"></i> Registro de usuario</h2>

      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
      </div>

      <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="text" name="correo" id="correo" class="form-control" placeholder="Correo" required>
      </div>

      <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido" required>
      </div>

      <div class="mb-3">
        <label for="ci" class="form-label">Cédula de Identidad</label>
        <input type="text" name="ci" id="ci" class="form-control" placeholder="Cédula de Identidad" required
               oninput="this.value = this.value.replace(/[^0-9]/g, '')">
      </div>

      <div class="mb-3">
        <label for="clave" class="form-label">Contraseña</label>
        <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
      </div>

      <div class="mb-4">
        <label for="id_rol" class="form-label">Rol</label>
        <select name="id_rol" id="id_rol" class="form-select" required>
          <option value="">Seleccione</option>
          <option value="1">Promotor Social</option>
          <option value="2">Despacho</option>
          <option value="3">Administración</option>
          <option value="4">Administrador Principal</option>
        </select>
      </div>

      <button type="submit" class="btn-registro">
        <i class="fa fa-user-plus"></i> Registrar Persona
      </button>
    </form>
  </main>
</body>

    <!-- Copiar y pegar si vas a poner un mensaje de error etc atte david -->
    <script src="<?= BASE_URL ?>/public/js/msj.js"></script>
    <script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
    <?php if (isset($msj) && !empty($msj)) : ?>
        mostrarMensaje("<?= htmlspecialchars($msj) ?>", "info", 3500);
    <?php endif; ?>
    </script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>