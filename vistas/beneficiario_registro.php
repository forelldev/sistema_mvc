<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Beneficiario (Persona)</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/formularios.css?v=<?= time(); ?>">
</head>
<body class="bg-dark text-white">
  <main class="container py-4">
    <!-- Encabezado -->
    <header class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="mb-0">Registro de Beneficiario</h4>
      <a href="<?= BASE_URL ?>/beneficiarios_lista" class="btn btn-outline-light">
        <i class="fa fa-arrow-left"></i> Volver atrás
      </a>
    </header>

    <!-- Formulario -->
    <form method="POST" action="<?= BASE_URL ?>/registrar_beneficiario" autocomplete="off" class="border rounded p-4 bg-secondary bg-opacity-10">
      <h5 class="mb-3"><i class="fa fa-user"></i> Datos Personales</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="col-md-6">
          <label for="apellido" class="form-label">Apellido</label>
          <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="col-md-6">
          <label for="correo" class="form-label">Correo</label>
          <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="col-md-6">
          <label for="ci" class="form-label">Cédula</label>
          <input type="text" class="form-control" id="ci" name="ci" required>
        </div>
        <div class="col-md-6">
          <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
          <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
          <input type="hidden" id="edad" name="edad">
        </div>
        <div class="col-md-6">
          <label for="telefono" class="form-label">Teléfono</label>
          <input type="text" class="form-control" id="telefono" name="telefono" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
        <div class="col-md-6">
          <label for="lugar_nacimiento" class="form-label">Lugar de Nacimiento</label>
          <input type="text" class="form-control" id="lugar_nacimiento" name="lugar_nacimiento" required>
        </div>
        <div class="col-md-6">
          <label for="estado_civil" class="form-label">Estado Civil</label>
          <select class="form-select" id="estado_civil" name="estado_civil" required>
            <option value="">Seleccione</option>
            <option value="Soltero/a">Soltero/a</option>
            <option value="Casado/a">Casado/a</option>
            <option value="Viudo/a">Viudo/a</option>
          </select>
        </div>
      </div>
              <hr class="my-4">
      <h5 class="mb-3"><i class="fa fa-id-card"></i> Información Complementaria</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label for="codigo_patria" class="form-label">Código de Patria</label>
          <input type="text" class="form-control" id="codigo_patria" name="codigo_patria" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
        <div class="col-md-6">
          <label for="serial_patria" class="form-label">Serial de Patria</label>
          <input type="text" class="form-control" id="serial_patria" name="serial_patria" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
        <div class="col-md-6">
          <label for="nivel_instruc" class="form-label">Nivel de Instrucción</label>
          <select class="form-select" id="nivel_instruc" name="nivel_instruc" required>
            <option value="">Seleccione</option>
            <option value="Primaria">Primaria</option>
            <option value="Secundaria">Secundaria</option>
            <option value="Universidad">Universidad</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="profesion" class="form-label">Profesión</label>
          <input type="text" class="form-control" id="profesion" name="profesion" required>
        </div>
        <div class="col-md-6">
          <label for="trabajo1" class="form-label">¿Trabaja?</label>
          <select class="form-select" id="trabajo1" name="trabajo1" onchange="mostrarCampoTrabajo()" required>
            <option value="">Seleccione</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
          </select>
        </div>
      </div>

      <!-- Campos condicionales de trabajo -->
      <div class="row g-3 mt-3" id="campoTrabajo" style="display:none;">
        <div class="col-md-6">
          <label for="trabajo" class="form-label">Trabajo</label>
          <input type="text" class="form-control" id="trabajo" name="trabajo">
        </div>
        <div class="col-md-6">
          <label for="direccion_trabajo" class="form-label">Dirección de Trabajo</label>
          <input type="text" class="form-control" id="direccion_trabajo" name="direccion_trabajo">
        </div>
        <div class="col-md-6">
          <label for="trabaja_public" class="form-label">¿Trabaja en el sector público?</label>
          <select class="form-select" id="trabaja_public" name="trabaja_public" onchange="mostrarInstitucion()">
            <option value="">Seleccione</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
          </select>
        </div>
        <div class="col-md-6" id="campoInstitucion" style="display:none;">
          <label for="nombre_insti" class="form-label">Nombre de la Institución</label>
          <input type="text" class="form-control" id="nombre_insti" name="nombre_insti">
        </div>
      </div>
      <hr class="my-4">
      <h5 class="mb-3"><i class="fa fa-map-marker-alt"></i> Ubicación y Comunidad</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label for="comunidad" class="form-label">Comunidad</label>
          <select name="comunidad" id="comunidad" class="form-select bg-dark text-white" required>
            <option value="">Seleccione su comunidad...</option>
            <?php
              $res = Solicitud::traer_comunidades();
              if ($res['exito']) {
                foreach ($res['datos'] as $comunidad) {
                  $nombre = $comunidad['comunidad'] ?? '';
                  $selected = (($datos_beneficiario['comunidad']['comunidad'] ?? '') === $nombre) ? 'selected' : '';
                  echo '<option ' . $selected . '>' . htmlspecialchars($nombre) . '</option>';
                }
              } else {
                echo '<option value="">Ocurrió un error al cargar las comunidades</option>';
              }
            ?>
          </select>
        </div>
        <div class="col-md-6">
          <label for="direc_habita" class="form-label">Dirección de Habitación</label>
          <input type="text" class="form-control" id="direc_habita" name="direc_habita" required>
        </div>
        <div class="col-md-6">
          <label for="estruc_base" class="form-label">Estructura Base</label>
            <select class="form-select form-select-sm bg-dark text-white" id="estruc_base" name="estruc_base" required>
                    <option value="">Seleccione</option>
                    <option value="Jefe de Comunidad" >Jefe de Comunidad</option>
                    <option value="Jefe de UBCH" >Jefe de UBCH</option>
                    <option value="Jefe de Calle" >Jefe de Calle</option>
                    <option value="Ninguno">Ninguno</option>
                </select>
        </div>
      </div>

      <hr class="my-4">
      <h5 class="mb-3"><i class="fa fa-home"></i> Datos Físicos Ambientales</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label for="propiedad" class="form-label">Propiedad</label>
          <select class="form-select" id="propiedad" name="propiedad" required>
            <option value="">Seleccione</option>
            <option value="Casa">Casa</option>
            <option value="Apartamento">Apartamento</option>
            <option value="Rancho">Rancho</option>
            <option value="Otro">Otro</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="propiedad_est" class="form-label">Estado de Propiedad</label>
          <select class="form-select" id="propiedad_est" name="propiedad_est" required>
            <option value="">Seleccione</option>
            <option value="Propia">Propia</option>
            <option value="Prestada">Prestada</option>
            <option value="Alquiler">Alquiler</option>
          </select>
        </div>
        <div class="col-12">
          <label for="observaciones" class="form-label">Observaciones</label>
          <input type="text" class="form-control" id="observaciones" name="observaciones_propiedad" placeholder="Detalles adicionales relevantes (Opcional)">
        </div>
      </div>
      <hr class="my-4">
      <h5 class="mb-3"><i class="fa fa-money-bill"></i> Datos Socio-Económicos</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label for="nivel_ingreso" class="form-label">Nivel de Ingresos</label>
          <input type="text" class="form-control" id="nivel_ingreso" name="nivel_ingreso" placeholder="Ejem: 500 Bs" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
        <div class="col-md-6">
          <label for="pension" class="form-label">¿Recibe Bonos?</label>
          <select class="form-select" id="pension" name="pension" required>
            <option value="">Seleccione</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="bono" class="form-label">¿Recibe Pensiones?</label>
          <select class="form-select" id="bono" name="bono" required>
            <option value="">Seleccione</option>
            <option value="Si">Sí</option>
            <option value="No">No</option>
          </select>
        </div>
      </div>

      <hr class="my-4">
      <h5 class="mb-3"><i class="fa fa-medkit"></i> Datos de Asistencia Médica</h5>
      <div class="row g-3">
        <div class="col-md-6">
          <label for="tienePatologia" class="form-label">¿Tiene familiares con patología?</label>
          <select class="form-select" id="tienePatologia" name="tienePatologia" onchange="mostrarNumeroFamiliares()" required>
            <option value="">Seleccione</option>
            <option value="si">Sí</option>
            <option value="no">No</option>
          </select>
        </div>
        <div class="col-md-6" id="numeroFamiliaresContainer" style="display:none;">
          <label for="numeroFamiliares" class="form-label">¿Cuántos familiares?</label>
          <select class="form-select" id="numeroFamiliares" onchange="generarCamposFamiliares()" required>
            <option value="">Seleccione</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
          </select>
        </div>
      </div>

      <!-- Campos dinámicos generados -->
      <div id="camposFamiliares" class="mt-3"></div>

      <!-- Botón de envío -->
      <div class="text-end mt-4">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-paper-plane"></i> Enviar
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
<script src="<?= BASE_URL ?>/public/js/trabajo.js"></script>
<script src="<?= BASE_URL ?>/public/js/edad.js"></script>
<script>
const data_exists = "<?= isset($data['data_exists']) && $data['data_exists'] ? '1' : '0' ?>";
const tiposPatologiaGuardados = "<?= $data['tiposJS'] ?? '' ?>".split('|');
const nombresPatologiaGuardados = "<?= $data['nombresJS'] ?? '' ?>".split('|');
</script>
<script src="<?= BASE_URL ?>/public/js/patologia.js"></script>
</html>