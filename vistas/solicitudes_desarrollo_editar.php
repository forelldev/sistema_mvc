<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solicitud - Desarrollo Social</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/edicion.css?v=<?= time(); ?>">
</head>
<body class="bg-dark text-white">
  <!-- Header -->
  <header class="bg-dark py-3 px-4 d-flex justify-content-between align-items-center">
    <h1 class="h5 mb-0">Editar solicitud</h1>
    <div class="d-flex gap-2">
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light btn-sm">
        <i class="fa fa-home"></i> Inicio
      </a>
      <a href="<?= BASE_URL ?>/solicitudes_desarrollo?msj=Has cancelado la edición de solicitud!" class="btn btn-volver btn-sm">
        <i class="fa fa-arrow-left"></i> Volver atrás
      </a>
    </div>
  </header>

  <!-- Formulario -->
  <main class="container py-4">
    <form action="editar_desarrollo" method="POST" class="bg-panel-dark text-white p-4 rounded shadow" autocomplete="off">
      <h2 class="h6 mb-4"><i class="fa fa-file-alt me-2"></i> Editar Solicitud</h2>

      <input type="hidden" name="id_des" value="<?= $datos['id_des'] ?? '' ?>">
      <input type="hidden" name="tipo_ayuda" value="Otros">

      <div class="row g-3">
        <!-- Categoría -->
        <div class="col-md-6">
          <label for="tipo_ayuda" class="form-label">Tipo de ayuda:</label>
          <select id="tipo_ayuda" name="categoria" class="form-select" required>
            <option value="">Seleccione...</option>
            <option value="Medicamentos" <?= ($datos['categoria'] ?? '') === 'Medicamentos' ? 'selected' : '' ?>>Medicamentos</option>
            <option value="Laboratorio" <?= ($datos['categoria'] ?? '') === 'Laboratorio' ? 'selected' : '' ?>>Laboratorio</option>
          </select>
        </div>

        <!-- Subcategoría -->
        <div class="col-md-6" id="subcategoria_container" style="display: none;">
          <label for="subcategoria" class="form-label">Tipo de examen:</label>
          <?php
            $examen = strtolower($datos['examenes'] ?? '');
            $seleccion = '';
            if (strpos($examen, 'doppler') !== false) {
              $seleccion = 'Eco-Doppler';
            } elseif (strpos($examen, 'sono') !== false || strpos($examen, 'ecosonograma') !== false) {
              $seleccion = 'Ecosonograma';
            } elseif (!empty($examen)) {
              $seleccion = 'Exámenes de Laboratorio';
            }
          ?>
          <select id="subcategoria" name="subcategoria" class="form-select">
            <option value="">Seleccione...</option>
            <option value="Ecosonograma" <?= $seleccion === 'Ecosonograma' ? 'selected' : '' ?>>Ecosonograma</option>
            <option value="Eco-Doppler" <?= $seleccion === 'Eco-Doppler' ? 'selected' : '' ?>>Eco-Doppler</option>
            <option value="Exámenes de Laboratorio" <?= $seleccion === 'Exámenes de Laboratorio' ? 'selected' : '' ?>>Exámenes de Laboratorio</option>
          </select>
        </div>

        <!-- Campo dinámico de exámenes -->
        <div class="col-12" id="campo_examen" style="display: none;"></div>

        <!-- Medicamentos (usa el mismo campo examen[]) -->
        <div id="medicamentos_container" class="mb-3" style="display:none;">
          <label for="medicamento" class="form-label">Especifique el medicamento:</label>
          <input type="text" id="medicamento" class="form-control"
                placeholder="Medicamento"
                value="<?= htmlspecialchars($datos['examenes'] ?? ($_POST['examenes'][0] ?? '')) ?>">
        </div>

        <!-- Render dinámico de medicamentos -->
        <div id="campo_medicamento" class="mb-3" style="display:none;">
          <?php if (!empty($datos['examenes'])): ?>
            <div class="mb-3">
              <label class="form-label">Medicamento especificado:</label>
              <div class="alert alert-info py-2 px-3 rounded-3 mb-0">
                <?= htmlspecialchars($datos['examenes']) ?>
                <input type="hidden" name="examen[]" value="<?= htmlspecialchars($datos['examenes']) ?>">
              </div>
            </div>
          <?php endif; ?>
        </div>


        <!-- Número de documento -->
        <div class="col-md-6">
          <label for="id_manual" class="form-label">Número de documento:</label>
          <input type="text" name="id_manual" id="id_manual" class="form-control" placeholder="Ingrese el número de documento"
            value="<?= htmlspecialchars($datos['id_manual'] ?? '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>

        <!-- Descripción -->
        <div class="col-md-6">
          <label for="descripcion" class="form-label">Descripción:</label>
          <input type="text" name="descripcion" class="form-control" placeholder="Descripción específica de la ayuda" required
            value="<?= htmlspecialchars($datos['descripcion'] ?? '') ?>">
        </div>
      </div>

      <!-- Botón de envío -->
      <div class="mt-4 text-center">
        <button type="submit" class="btn btn-primary px-4 rounded-pill">
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
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script>
  const examenSeleccionado = <?= json_encode($datos['examenes'] ?? []) ?>;
</script>
<script src="<?= BASE_URL?>/public/js/laboratorio_desarrollo.js"></script>
</html>