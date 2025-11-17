<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Solicitud - Desarrollo Social</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/formularios.css?v=<?= time(); ?>">
</head>
<body class="bg-dark text-white">
  <!-- Header -->
  <header class="bg-secondary border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
    <h5 class="mb-0 fw-semibold">Crear Solicitud - Desarrollo Social</h5>
    <a href="<?= BASE_URL ?>/buscar_desarrollo" class="btn btn-sm btn-outline-dark text-white">
      <i class="fa fa-arrow-left me-1"></i> Volver atrás
    </a>
  </header>

  <!-- Formulario -->
  <main class="container py-5">
    <form action="<?= BASE_URL ?>/enviar_formulario_desarrollo" method="POST" autocomplete="off" id="form_solicitud" class="border rounded p-4 bg-secondary bg-opacity-10">
      <h2 class="text-center"><i class="fa fa-hands-helping"></i> Solicitud de Ayuda</h2>

      <!-- Datos personales -->
      <section>
        <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3"><i class="fa fa-user me-2"></i> Datos Personales</h6>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo</label>
          <input type="email" name="correo" class="form-control" placeholder="Ingrese su correo" required
            value="<?= htmlspecialchars($_POST['correo'] ?? $datos_beneficiario['solicitante']['correo'] ?? '') ?>">
        </div>

        <div class="mb-3">
          <label for="telefono" class="form-label">Teléfono</label>
          <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Teléfono del beneficiario"
            value="<?= $_POST['telefono'] ?? $datos_beneficiario['info']['telefono'] ?? null ?>" required
            oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="12">
        </div>

        <div class="mb-3">
          <label for="comunidad" class="form-label">Comunidad</label>
          <select name="comunidad" id="comunidad" class="form-select" required>
            <option value="">Seleccione su comunidad...</option>
            <?php
              $res = Solicitud::traer_comunidades();
              $comunidad_actual = $_POST['comunidad'] ?? $datos_beneficiario['comunidad']['comunidad'] ?? null;
              if ($res['exito']) {
                foreach ($res['datos'] as $comunidad) {
                  $nombre = $comunidad['comunidad'] ?? '';
                  $selected = ($nombre === $comunidad_actual) ? 'selected' : '';
                  echo '<option ' . $selected . '>' . htmlspecialchars($nombre) . '</option>';
                }
              } else {
                echo '<option value="">Ocurrió un error al cargar las comunidades</option>';
              }
            ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección</label>
          <input type="text" id="direccion" name="direc_habita" class="form-control" placeholder="Dirección del beneficiario"
            value="<?= $_POST['direccion'] ?? $datos_beneficiario['comunidad']['direc_habita'] ?? null ?>" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre del Beneficiario" required
              value="<?= htmlspecialchars($_POST['nombre'] ?? $datos_beneficiario['solicitante']['nombre'] ?? '') ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" placeholder="Apellido del Beneficiario" required
              value="<?= htmlspecialchars($_POST['apellido'] ?? $datos_beneficiario['solicitante']['apellido'] ?? '') ?>">
          </div>
        </div>

        <div class="mb-3">
          <label for="cedula" class="form-label">Cédula</label>
          <input type="text" name="ci" class="form-control" placeholder="Cédula" required maxlength="10"
            value="<?= htmlspecialchars($_POST['ci'] ?? $datos_beneficiario['solicitante']['ci'] ?? '') ?>"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
      </section>

      <!-- Datos de la solicitud -->
      <section>
        <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3"><i class="fa fa-file-alt me-2"></i> Datos de la Solicitud</h6>

        <div class="mb-3">
          <label for="tipo_ayuda" class="form-label">Tipo de ayuda</label>
          <select id="tipo_ayuda" name="categoria" class="form-select" required>
            <option value="">Seleccione...</option>
            <option value="Medicamentos" <?= ($_POST['categoria'] ?? '') === 'Medicamentos' ? 'selected' : '' ?>>Medicamentos</option>
            <option value="Laboratorio" <?= ($_POST['categoria'] ?? '') === 'Laboratorio' ? 'selected' : '' ?>>Laboratorio</option>
          </select>
        </div>

        <div id="subcategoria_container" class="mb-3" style="display: none;">
          <label for="subcategoria" class="form-label">Tipo de examen</label>
          <select id="subcategoria" name="subcategoria" class="form-select">
            <option value="">Seleccione...</option>
            <option value="Ecosonograma" <?= ($_POST['subcategoria'] ?? '') === 'Ecosonograma' ? 'selected' : '' ?>>Ecosonograma</option>
            <option value="Eco-Doppler" <?= ($_POST['subcategoria'] ?? '') === 'Eco-Doppler' ? 'selected' : '' ?>>Eco-Doppler</option>
            <option value="Exámenes de Laboratorio" <?= ($_POST['subcategoria'] ?? '') === 'Exámenes de Laboratorio' ? 'selected' : '' ?>>Exámenes de Laboratorio</option>
          </select>
        </div>

        <div id="campo_examen" class="mb-3" style="display: none;"></div>


        <div id="medicamentos_container" class="mb-3" style="display:none;">
          <label for="medicamento" class="form-label">Especificar el medicamento:</label>
          <input type="text" id="medicamento" class="form-control"
                placeholder="Medicamento"
                value="<?= htmlspecialchars($_POST['medicamento'] ?? '') ?>">
        </div>

        <!-- Render dinámico de medicamentos -->
        <div id="campo_medicamento" class="mb-3" style="display:none;"></div>


        <div class="mb-3">
          <label for="id_manual" class="form-label">Número de documento</label>
          <input type="text" name="id_manual" id="id_manual" class="form-control" placeholder="Ingrese el número de documento"
            value="<?= htmlspecialchars($_POST['id_manual'] ?? '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>

        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <input type="text" name="descripcion" class="form-control" placeholder="Descripción específica de la ayuda" required
            value="<?= htmlspecialchars($_POST['descripcion'] ?? '') ?>">
        </div>

        <input type="hidden" name="tipo_ayuda" value="Otros">
      </section>

      <!-- Botón de envío -->
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-outline-light px-4 rounded-pill">
          <i class="fa fa-paper-plane me-2"></i> Registrar Solicitud
        </button>
      </div>
    </form>
  </main>
</body>

<script src="<?= BASE_URL?>/public/js/reenvio_form.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
    const examenSeleccionado = <?= json_encode($_POST['examen'] ?? []) ?>;
</script>
<script src="<?= BASE_URL ?>/public/js/msj.js"></script>
<?php
$mensaje = $_GET['msj'] ?? $msj ?? null;
if ($mensaje):
?>
<script>
    mostrarMensaje("<?= htmlspecialchars($mensaje) ?>", "info", 6000);
</script>
<?php endif; ?>
<script src="<?= BASE_URL?>/public/js/laboratorio_desarrollo.js"></script>

</html>