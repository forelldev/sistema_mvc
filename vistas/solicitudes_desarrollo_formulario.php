<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Solicitud</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/estilo_anteriores.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="bg-light">
  <header class="header">
    <div class="titulo-header">Crear Solicitud - Desarrollo Social</div>
    <a href="<?= BASE_URL ?>/buscar_desarrollo"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
  </header>

  <!-- Formulario -->
  <div class="container my-5 px-4">
    <form action="<?= BASE_URL ?>/enviar_formulario_desarrollo" method="POST" id="form_solicitud" class="bg-white p-4 rounded-4 shadow-sm">
      <h4 class="mb-4 text-primary"><i class="fa fa-hands-helping me-2"></i>Solicitud de Ayuda Desarrollo Social</h4>

      <div class="mb-4">
        <h5 class="text-dark"><i class="fa fa-user me-2"></i>Datos de la Solicitud</h5>
      </div>

      <!-- Categoría -->
      <div class="mb-3">
        <label for="tipo_ayuda" class="form-label">Tipo de ayuda:</label>
        <select id="tipo_ayuda" name="categoria" class="form-select" required>
          <option value="">Seleccione...</option>
          <option value="Medicamentos" <?= ($_POST['categoria'] ?? '') === 'Medicamentos' ? 'selected' : '' ?>>Medicamentos</option>
          <option value="Laboratorio" <?= ($_POST['categoria'] ?? '') === 'Laboratorio' ? 'selected' : '' ?>>Laboratorio</option>
        </select>
      </div>

      <!-- Subcategoría -->
      <div id="subcategoria_container" class="mb-3" style="display: none;">
        <label for="subcategoria" class="form-label">Tipo de examen:</label>
        <select id="subcategoria" name="subcategoria" class="form-select">
          <option value="">Seleccione...</option>
          <option value="Ecosonograma" <?= ($_POST['subcategoria'] ?? '') === 'Ecosonograma' ? 'selected' : '' ?>>Ecosonograma</option>
          <option value="Eco-Doppler" <?= ($_POST['subcategoria'] ?? '') === 'Eco-Doppler' ? 'selected' : '' ?>>Eco-Doppler</option>
          <option value="Exámenes de Laboratorio" <?= ($_POST['subcategoria'] ?? '') === 'Exámenes de Laboratorio' ? 'selected' : '' ?>>Exámenes de Laboratorio</option>
        </select>
      </div>

      <!-- Campos de texto -->
      <div class="mb-3">
        <label for="id_manual" class="form-label">Número de documento:</label>
        <input type="text" name="id_manual" id="id_manual" class="form-control" placeholder="Ingrese el número de documento"
          value="<?= htmlspecialchars($_POST['id_manual'] ?? '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <input type="text" name="descripcion" class="form-control" placeholder="Descripción específica de la ayuda" required
          value="<?= htmlspecialchars($_POST['descripcion'] ?? '') ?>">
      </div>

      <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="text" name="correo" class="form-control" placeholder="Ingrese su correo" required
          value="<?= htmlspecialchars($_POST['correo'] ?? $datos_beneficiario['solicitante']['correo'] ?? '') ?>">
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" name="nombre" class="form-control" placeholder="Nombre del Paciente" required
            value="<?= htmlspecialchars($_POST['nombre'] ?? $datos_beneficiario['solicitante']['nombre'] ?? '') ?>">
        </div>
        <div class="col-md-6 mb-3">
          <label for="apellido" class="form-label">Apellido:</label>
          <input type="text" name="apellido" class="form-control" placeholder="Apellido del Paciente" required
            value="<?= htmlspecialchars($_POST['apellido'] ?? $datos_beneficiario['solicitante']['apellido'] ?? '') ?>">
        </div>
      </div>

      <div class="mb-3">
        <label for="cedula" class="form-label">Cédula:</label>
        <input type="text" name="ci" class="form-control" placeholder="Cédula" required maxlength="10"
          value="<?= htmlspecialchars($_POST['ci'] ?? $datos_beneficiario['solicitante']['ci'] ?? '') ?>"
          oninput="this.value = this.value.replace(/[^0-9]/g, '')">
      </div>


      <input type="hidden" name="tipo_ayuda" value="Otros">

      <!-- Botón de envío -->
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-success px-4 rounded-pill">
          Registrar Solicitud
        </button>
      </div>
    </form>
  </div>
<script src="<?= BASE_URL?>/public/reenvio_form.js"></script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
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
<script src="<?= BASE_URL ?>/public/js/solicitud_urgencia.js"></script>
</body>
</html>