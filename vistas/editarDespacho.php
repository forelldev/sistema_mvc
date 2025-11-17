<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solicitud - Despacho</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/edicion.css?v=<?= time(); ?>">
</head>
<body class="bg-dark text-white">
  <!-- Header -->
  <header class="bg-dark py-3 px-4 d-flex justify-content-between align-items-center">
    <h1 class="h5 mb-0">Editar solicitud de despacho</h1>
    <div class="d-flex gap-2">
      <a href="<?= BASE_URL ?>/main" class="btn btn-outline-light btn-sm">
        <i class="fa fa-home"></i> Inicio
      </a>
      <a href="<?= BASE_URL ?>/despacho_list" class="btn btn-volver btn-sm">
        <i class="fa fa-arrow-left"></i> Volver atrás
      </a>
    </div>
  </header>

  <!-- Formulario -->
  <main class="container py-4">
    <form action="editar_solicitudDespacho" method="POST" class="bg-panel-dark text-white p-4 rounded shadow" autocomplete="off">
      <h2 class="h6 mb-4"><i class="fa fa-hand-holding-heart"></i> Editar Solicitud</h2>

      <input type="hidden" name="id_despacho" value="<?= $datos['id_despacho'] ?? '' ?>">

      <div class="row g-3">
        <!-- Número de documento -->
        <div class="col-md-6">
          <label for="id_manual" class="form-label">Número de documento:</label>
          <input type="text" class="form-control" id="id_manual" name="id_manual"
                 placeholder="00004578" required value="<?= htmlspecialchars($datos['id_manual'] ?? '') ?>"
                 oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>

        <!-- Descripción -->
        <div class="col-md-6">
          <label for="descripcion" class="form-label">Descripción:</label>
          <input type="text" class="form-control" id="descripcion" name="descripcion"
                 placeholder="Ejemplo: 3 Sacos de cemento para la Alcaldía de Peña" required
                 value="<?= htmlspecialchars($datos['descripcion'] ?? '') ?>">
        </div>

        <!-- Categoría -->
        <div class="col-md-6 mb-3">
          <label for="categoria" class="form-label">Categoría</label>
          <select name="categoria" id="categoria" class="form-select" required>
            <?php
            // Precarga desde $_POST o desde $datos
            $categoria_actual = $_POST['categoria'] ?? ($datos['categoria'] ?? null);
            $categorias = ['Ayudas Técnicas', 'Medicamentos', 'Enseres', 'Económica'];
            echo '<option value="">Seleccione</option>';
            foreach ($categorias as $cat) {
              $selected = ($cat === $categoria_actual) ? 'selected' : '';
              echo "<option value=\"$cat\" $selected>$cat</option>";
            }
            ?>
          </select>
        </div>

        <!-- Ayudas Técnicas (estandarizado con select fijo) -->
        <div class="mb-3" id="tipoAyudaContainer" style="display:none;">
          <label for="tipo_ayuda" class="form-label">Tipo de ayuda</label>
          <select name="tipo_ayuda" id="tipo_ayuda" class="form-select">
            <option value="">Seleccione</option>
            <?php
            $tipo_ayuda_actual = $_POST['tipo_ayuda'] ?? ($datos['tipo_ayuda'] ?? '');
            $opciones = [
              "Silla de Ruedas", "Silla de Ruedas(Niño)", "Andadera", "Andadera (Niño)",
              "Bastón 1 Punta", "Bastón 3 Puntas", "Bastón 4 Puntas",
              "Muletas", "Muletas (Niño)", "Collarín", "Colchón Anti-escaras"
            ];
            foreach ($opciones as $op) {
              $selected = ($op === $tipo_ayuda_actual) ? 'selected' : '';
              echo "<option value=\"$op\" $selected>$op</option>";
            }
            ?>
          </select>
        </div>

        <!-- Contenedor dinámico para input text -->
        <div class="mb-3" id="campoExtra" style="display:none;">
        </div>


      <!-- Botón de envío -->
      <div class="mt-4 text-center">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-paper-plane"></i> Guardar Cambios
        </button>
      </div>
    </form>
  </main>
</body>

<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
    const precarga = "<?php echo $datos['tipo_ayuda']; ?>";
    const precargaDatos = "<?php echo $datos['categoria']; ?>";
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
<script src="<?= BASE_URL ?>/public/js/formulario_despacho.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>