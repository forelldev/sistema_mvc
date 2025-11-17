<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Solicitud - Despacho</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/formularios.css?v=<?= time(); ?>">
</head>
<body class="bg-dark text-white">
  <!-- Header -->
  <header class="bg-secondary border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
    <h5 class="mb-0 fw-semibold">Formulario de despacho</h5>
    <a href="<?= BASE_URL ?>/despacho_list" class="btn btn-sm btn-outline-dark text-white">
      <i class="fa fa-arrow-left me-1"></i> Volver atrás
    </a>
  </header>

  <!-- Formulario -->
  <main class="container py-5">
    <form action="despacho_enviarForm" method="POST" class="border rounded p-4 bg-secondary bg-opacity-10" autocomplete="off">
      <h2 class="text-center"><i class="fa fa-truck me-2"></i> Solicitud de Despacho</h2>

      <!-- Datos personales -->
      <section>
        <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3"><i class="fa fa-user me-2"></i> Datos del Beneficiario</h6>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre del beneficiario"
              value="<?= $_POST['nombre'] ?? $datos_beneficiario['solicitante']['nombre'] ?? null ?>" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido del beneficiario"
              value="<?= $_POST['apellido'] ?? $datos_beneficiario['solicitante']['apellido'] ?? null ?>" required>
          </div>
        </div>

        <input type="hidden" name="id_solicitante"
          value="<?= $_POST['id_solicitante'] ?? $datos_beneficiario['solicitante']['id_solicitante'] ?? null ?>">

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Teléfono del beneficiario"
              value="<?= $_POST['telefono'] ?? $datos_beneficiario['info']['telefono'] ?? null ?>" required
              oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="12">
          </div>
          <div class="col-md-4 mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo del beneficiario"
              value="<?= $_POST['correo'] ?? $datos_beneficiario['solicitante']['correo'] ?? null ?>" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="ci" class="form-label">Cédula de Identidad</label>
            <input type="text" id="ci" name="ci" class="form-control" placeholder="Ej. 12345678"
              value="<?= htmlspecialchars($_POST['ci'] ?? $datos_beneficiario['solicitante']['ci'] ?? $ci ?? '') ?>"
              required oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10" readonly>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
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
          <div class="col-md-6 mb-3">
            <label for="direc_habita" class="form-label">Dirección</label>
            <input type="text" id="direc_habita" name="direc_habita" class="form-control" placeholder="Dirección del beneficiario"
              value="<?= $_POST['direc_habita'] ?? $datos_beneficiario['comunidad']['direc_habita'] ?? null ?>" required>
          </div>
        </div>
      </section>

      <!-- Datos de la solicitud -->
      <section>
        <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3"><i class="fa fa-file-alt me-2"></i> Datos de la Solicitud</h6>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="id_manual" class="form-label">Número de documento</label>
            <input type="text" id="id_manual" name="id_manual" class="form-control" placeholder="00004578"
              value="<?= $_POST['id_manual'] ?? null ?>" required
              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
          </div>
          <div class="col-md-6 mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select name="categoria" id="categoria" class="form-select" required>
              <?php
              $categoria_actual = $_POST['categoria'] ?? null;
              // Solo las categorías que realmente usas
              $categorias = ['Ayudas Técnicas', 'Medicamentos', 'Enseres', 'Económica'];
              echo '<option value="">Seleccione</option>';
              foreach ($categorias as $cat) {
                $selected = ($cat === $categoria_actual) ? 'selected' : '';
                echo "<option value=\"$cat\" $selected>$cat</option>";
              }
              ?>
            </select>
          </div>
          </div>
        </div>

        <!-- Ayudas Técnicas (estandarizado con select fijo) -->
          <div class="mb-3" id="tipoAyudaContainer" style="display:none;">
            <label for="tipo_ayuda" class="form-label">Tipo de ayuda</label>
            <select name="tipo_ayuda" id="tipo_ayuda" class="form-select">
              <option value="">Seleccione</option>
              <option value="Silla de Ruedas">Silla de Ruedas</option>
              <option value="Silla de Ruedas(Niño)">Silla de Ruedas (Niño)</option>
              <option value="Andadera">Andadera</option>
              <option value="Andadera (Niño)">Andadera (Niño)</option>
              <option value="Bastón 1 Punta">Bastón 1 Punta</option>
              <option value="Bastón 3 Puntas">Bastón 3 Puntas</option>
              <option value="Bastón 4 Puntas">Bastón 4 Puntas</option>
              <option value="Muletas">Muletas</option>
              <option value="Muletas (Niño)">Muletas (Niño)</option>
              <option value="Collarín">Collarín</option>
              <option value="Colchón Anti-escaras">Colchón Anti-escaras</option>
            </select>
            <input type="hidden" id="tipo_ayuda_precargado" value="<?= htmlspecialchars($_POST['tipo_ayuda'] ?? '') ?>">
          </div>
        <!-- Contenedor dinámico para input text -->
        <div class="mb-3" id="campoExtra" style="display:none;"></div>

        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripción</label>
          <input type="text" id="descripcion" name="descripcion" class="form-control" required
            placeholder="Descripción específica de la ayuda (Ejemplo: 3 Sacos de cemento para la Alcaldía de Peña)"
            value="<?= $_POST['descripcion'] ?? null ?>">
        </div>
      </section>

      <!-- Botón de envío -->
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-outline-light px-4 rounded-pill">
          <i class="fa fa-paper-plane me-2"></i> Enviar
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
<script src="<?= BASE_URL ?>/public/js/formulario_despacho.js"></script>
</html>