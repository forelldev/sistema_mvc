<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solicitud</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/edicion.css?v=<?= time(); ?>">
</head>
<body class="solicitud-body">
  <header class="bg-dark text-white py-3 px-4 d-flex justify-content-between align-items-center">
    <h1 class="h5 mb-0">Editar solicitud</h1>
    <div class="d-flex gap-2">
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light btn-sm">
        <i class="fa fa-home"></i> Inicio
      </a>
      <a href="<?= BASE_URL ?>/solicitudes_list?msj=Has cancelado la edición de solicitud!" class="btn btn-volver btn-sm">
        <i class="fa fa-arrow-left"></i> Volver atrás
      </a>
    </div>
  </header>

  <main class="container py-4">
    <form action="editar_solicitud" method="POST" class="bg-panel-dark text-white p-4 rounded shadow">
      <h2 class="h6 mb-4"><i class="fa fa-hand-holding-heart"></i> Editar Solicitud</h2>

      <div class="row g-3">
        <div class="col-md-6">
          <label for="id_manual" class="form-label">Número de documento:</label>
          <input type="text" class="form-control" id="id_manual" name="id_manual"
                 placeholder="00004578" required value="<?= $datos['id_manual'] ?? '' ?>"
                 oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>

        <div class="col-md-6">
          <label for="descripcion" class="form-label">Descripción:</label>
          <input type="text" class="form-control" id="descripcion" name="descripcion"
                 placeholder="Ejem: Ayuda para silla de ruedas" required value="<?= $datos['descripcion'] ?? '' ?>">
        </div>

        <div class="col-md-6">
          <label for="ci" class="form-label">Cédula de Identidad:</label>
          <input type="text" class="form-control" id="ci" name="ci"
                 placeholder="Ejem: V-12345678" required readonly
                 value="<?= htmlspecialchars($datos['ci'] ?? '') ?>"
                 oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>

        <input type="hidden" name="id_doc" value="<?= $datos['id_doc'] ?? '' ?>">

        <div class="col-md-6 ">
          <label for="categoria" class="form-label">Categoría:</label>
          <select class="form-select" name="categoria" id="categoria" required>
            <option value="">Seleccione</option>
            <?php foreach (['Ayudas Técnicas','Medicamentos','Laboratorio','Enseres','Economica','Otros'] as $cat): ?>
              <option value="<?= $cat ?>" <?= ($datos['categoria'] ?? '') == $cat ? 'selected' : '' ?>><?= $cat ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-6 campo-formulario">
          <label for="tipo_ayuda" class="form-label">Tipo de Ayuda:</label>
          <select class="form-select" name="tipo_ayuda" id="tipo_ayuda" required>
            <option value="">Seleccione</option>
            <?php foreach (['Silla de Ruedas','Silla de Ruedas(Niño)','Andadera','Andadera (Niño)','Bastón 1 Punta','Bastón 3 Puntas','Bastón 4 Puntas','Muletas','Muletas (Niño)','Collarín','Colchón Anti-escaras','Otros'] as $tipo): ?>
              <option value="<?= $tipo ?>" <?= ($datos['tipo_ayuda'] ?? '') == $tipo ? 'selected' : '' ?>><?= $tipo ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-12">
          <label for="observaciones" class="form-label">Observaciones:</label>
          <input type="text" class="form-control" id="observaciones_ayuda"
                 name="observaciones" placeholder="Detalles relevantes (Opcional)"
                 value="<?= $datos['observaciones'] ?? '' ?>">
        </div>
      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-paper-plane"></i> Guardar Cambios
        </button>
      </div>
    </form>
  </main>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<?php
$mensaje = $msj ?? ($_GET['msj'] ?? null);
if ($mensaje):
?>
    <script>
        mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 3000);
    </script>
<?php endif; ?>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/tipo_ayuda.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>