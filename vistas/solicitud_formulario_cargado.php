<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Ayuda (General)</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/fontawesome/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/formularios.css?v=<?= time(); ?>">
</head>
<body class="bg-dark text-white">
<main class="container py-4">
  <!-- Encabezado -->
  <header class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="mb-0 fw-semibold">Formulario de solicitud de ayuda</h5>
    <div class="btn-group" role="group">
    <div class="d-flex gap-2">
    <a href="<?= BASE_URL ?>/solicitudes_list?msj=Has cancelado la creación de solicitud!" 
        class="btn btn-sm btn-outline-light">
        <i class="fa fa-arrow-left me-1"></i> Ver lista de Solicitudes
    </a>
    <a href="<?= BASE_URL ?>/busqueda?msj=Has cancelado la creación de solicitud!" 
        class="btn btn-sm btn-outline-light">
        <i class="fa fa-search me-1"></i> Buscar Beneficiario
    </a>
    </div>


  </header>
        <form action="<?=BASE_URL?>/enviarFormulario" method="POST" class="border rounded p-4 bg-secondary bg-opacity-10" autocomplete="off">
            <h2 class="text-center"><i class="fa fa-hands-helping"></i> Solicitud de Ayuda</h2>
            <!-- Sección: Datos Personales -->
            <section class="mb-4">
                <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3">
                    <i class="fa fa-user me-2"></i> Datos Personales
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control form-control-sm bg-dark text-white"
                        value="<?= $datos_beneficiario['solicitante']['nombre'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-6">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" id="apellido" name="apellido" class="form-control form-control-sm bg-dark text-white"
                        value="<?= $datos_beneficiario['solicitante']['apellido'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-6">
                    <label for="ci" class="form-label">Cédula</label>
                    <input type="text" id="ci" name="ci" class="form-control form-control-sm bg-dark text-white"
                        placeholder="Ejem: V-12345678"
                        value="<?= htmlspecialchars($datos['solicitante']['ci'] ?? $ci ?? '') ?>" required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div class="col-md-6">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" id="correo" name="correo" class="form-control form-control-sm bg-dark text-white"
                        value="<?= $datos_beneficiario['solicitante']['correo'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-6">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                        class="form-control form-control-sm bg-dark text-white"
                        value="<?= $datos_beneficiario['info']['fecha_nacimiento'] ?? '' ?>" required>
                    <input type="hidden" id="edad" name="edad" value="<?= $datos_beneficiario['info']['edad'] ?? '' ?>">
                    </div>
                    <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" class="form-control form-control-sm bg-dark text-white"
                        value="<?= $datos_beneficiario['info']['telefono'] ?? '' ?>" required
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div class="col-md-6">
                    <label for="lugar_nacimiento" class="form-label">Lugar de Nacimiento</label>
                    <input type="text" id="lugar_nacimiento" name="lugar_nacimiento"
                        class="form-control form-control-sm bg-dark text-white"
                        value="<?= $datos_beneficiario['info']['lugar_nacimiento'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-6">
                    <label for="estado_civil" class="form-label">Estado Civil</label>
                    <select name="estado_civil" id="estado_civil" class="form-select form-select-sm bg-dark text-white" required>
                        <option value="">Seleccione</option>
                        <option value="Soltero/a" <?= ($datos_beneficiario['info']['estado_civil'] ?? '') == 'Soltero/a' ? 'selected' : '' ?>>Soltero/a</option>
                        <option value="Casado/a" <?= ($datos_beneficiario['info']['estado_civil'] ?? '') == 'Casado/a' ? 'selected' : '' ?>>Casado/a</option>
                        <option value="Viudo/a" <?= ($datos_beneficiario['info']['estado_civil'] ?? '') == 'Viudo/a' ? 'selected' : '' ?>>Viudo/a</option>
                        <option value="Divorciado/a" <?= ($datos_beneficiario['info']['estado_civil'] ?? '') == 'Divorciado/a' ? 'selected' : '' ?>>Divorciado/a</option>
                    </select>
                    </div>
                </div>
            </section>

            <!-- Sección: Identificación Patria -->
            <section class="mb-4">
            <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3">
                <i class="fa fa-id-card me-2"></i> Identificación Patria
            </h6>
            <div class="row g-3">
                <div class="col-md-6">
                <label for="codigo_patria" class="form-label">Código de Patria</label>
                <input type="text" id="codigo_patria" name="codigo_patria"
                    class="form-control form-control-sm bg-dark text-white"
                    value="<?= $datos_beneficiario['extra']['codigo_patria'] ?? '' ?>" required
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    placeholder="Código de Patria del Beneficiario">
                </div>

                <div class="col-md-6">
                <label for="serial_patria" class="form-label">Serial de Patria</label>
                <input type="text" id="serial_patria" name="serial_patria"
                    class="form-control form-control-sm bg-dark text-white"
                    value="<?= $datos_beneficiario['extra']['serial_patria'] ?? '' ?>" required
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    placeholder="Serial de Patria del Beneficiario">
                </div>
            </div>
            </section>

            <!-- Sección: Asistencia Médica -->
            <section class="mb-4">
            <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3">
                <i class="fa fa-medkit me-2"></i> Datos de Asistencia Médica
            </h6>
            <div class="row g-3">
                <div class="col-md-6">
                <label for="tienePatologia" class="form-label">¿Tiene familiares con patología?</label>
                <select id="tienePatologia" name="tienePatologia"
                    class="form-select form-select-sm bg-dark text-white"
                    onchange="mostrarNumeroFamiliares()" required>
                    <option value="">Seleccione</option>
                    <option value="si" <?= (isset($datos_beneficiario['cantidad']) && $datos_beneficiario['cantidad'] != 0) ? 'selected' : '' ?>>Sí</option>
                    <option value="no" <?= (isset($datos_beneficiario['cantidad']) && $datos_beneficiario['cantidad'] == 0) ? 'selected' : '' ?>>No</option>
                </select>
                </div>

                <?php $cantidad = isset($datos_beneficiario['cantidad']) ? $datos_beneficiario['cantidad'] : 0; ?>
                <div class="col-md-6" id="numeroFamiliaresContainer" style="<?= $cantidad > 0 ? '' : 'display:none;' ?>">
                <label for="numeroFamiliares" class="form-label">¿Cuántos familiares?</label>
                <select id="numeroFamiliares"
                    class="form-select form-select-sm bg-dark text-white"
                    onchange="generarCamposFamiliares()" required>
                    <option value="">Seleccione</option>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" <?= $cantidad == $i ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
                </div>
            </div>

            <!-- Contenedor dinámico para los campos de familiares -->
            <div id="camposFamiliares" class="mt-3"></div>
            </section>



            <!-- Sección: Comunidad y Dirección -->
            <section class="mb-4">
            <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3">
                <i class="fa fa-map-marker-alt me-2"></i> Comunidad y Dirección
            </h6>
            <div class="row g-3">
                <div class="col-md-6">
                <label for="comunidad" class="form-label">Comunidad</label>
                <select name="comunidad" id="comunidad" class="form-select form-select-sm bg-dark text-white">
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
                <input type="text" id="direc_habita" name="direc_habita"
                    class="form-control form-control-sm bg-dark text-white"
                    value="<?= $datos_beneficiario['comunidad']['direc_habita'] ?? '' ?>" required>
                </div>

                <div class="col-md-6">
                <label for="estruc_base" class="form-label">Estructura Base</label>
                <select class="form-select form-select-sm bg-dark text-white" id="estruc_base" name="estruc_base" required>
                    <option value="">Seleccione</option>
                    <option value="Jefe de Comunidad" <?= ($datos_beneficiario['comunidad']['estruc_base'] ?? '') == 'Jefe de Comunidad' ? 'selected' : '' ?>>Jefe de Comunidad</option>
                    <option value="Jefe de UBCH" <?= ($datos_beneficiario['comunidad']['estruc_base'] ?? '') == 'Jefe de UBCH' ? 'selected' : '' ?>>Jefe de UBCH</option>
                    <option value="Jefe de Calle" <?= ($datos_beneficiario['comunidad']['estruc_base'] ?? '') == 'Jefe de Calle' ? 'selected' : '' ?>>Jefe de Calle</option>
                    <option value="Ninguno" <?= ($datos_beneficiario['comunidad']['estruc_base'] ?? '') == 'Ninguno' ? 'selected' : '' ?>>Ninguno</option>
                </select>


            </div>
            </section>
            <!-- Sección: Datos Físicos Ambientales -->
            <section class="mb-4">
            <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3">
                <i class="fa fa-home me-2"></i> Datos Físicos Ambientales
            </h6>
            <div class="row g-3">
                <div class="col-md-6">
                <label for="propiedad" class="form-label">Tipo de Propiedad</label>
                <select name="propiedad" id="propiedad" class="form-select form-select-sm bg-dark text-white" required>
                    <option value="">Seleccione</option>
                    <option value="Casa" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Casa' ? 'selected' : '' ?>>Casa</option>
                    <option value="Apartamento" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Apartamento' ? 'selected' : '' ?>>Apartamento</option>
                    <option value="Rancho" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Rancho' ? 'selected' : '' ?>>Rancho</option>
                    <option value="Otro" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Otro' ? 'selected' : '' ?>>Otro</option>
                </select>
                </div>

                <div class="col-md-6">
                <label for="propiedad_est" class="form-label">Estado de Propiedad</label>
                <select name="propiedad_est" id="propiedad_est" class="form-select form-select-sm bg-dark text-white" required>
                    <option value="">Seleccione</option>
                    <option value="Propia" <?= ($datos_beneficiario['propiedad']['propiedad_est'] ?? '') == 'Propia' ? 'selected' : '' ?>>Propia</option>
                    <option value="Prestada" <?= ($datos_beneficiario['propiedad']['propiedad_est'] ?? '') == 'Prestada' ? 'selected' : '' ?>>Prestada</option>
                    <option value="Alquiler" <?= ($datos_beneficiario['propiedad']['propiedad_est'] ?? '') == 'Alquiler' ? 'selected' : '' ?>>Alquiler</option>
                </select>
                </div>

                <div class="col-12">
                <label for="observaciones_propiedad" class="form-label">Observaciones</label>
                <input type="text" id="observaciones_propiedad" name="observaciones_propiedad"
                    class="form-control form-control-sm bg-dark text-white"
                    value="<?= $datos_beneficiario['propiedad']['observaciones_propiedad'] ?? '' ?>"
                    placeholder="Detalles adicionales relevantes (Opcional)">
                </div>
            </div>
            </section>

                    <!-- Sección: Datos Socioeconómicos -->
            <section class="mb-4">
            <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3">
                <i class="fa fa-money-bill me-2"></i> Datos Socioeconómicos
            </h6>
            <div class="row g-3">
                <div class="col-md-6">
                <label for="nivel_ingreso" class="form-label">Nivel de Ingresos</label>
                <input type="text" id="nivel_ingreso" name="nivel_ingreso"
                    class="form-control form-control-sm bg-dark text-white"
                    placeholder="Ejemplo: 500 Bs" required
                    value="<?= $datos_beneficiario['ingresos']['nivel_ingreso'] ?? '' ?>"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <div class="col-md-6">
                <label for="pension" class="form-label">¿Recibe Bonos?</label>
                <select name="pension" id="pension" class="form-select form-select-sm bg-dark text-white" required>
                    <option value="">Seleccione</option>
                    <option value="Si" <?= ($datos_beneficiario['ingresos']['pension'] ?? '') == 'Si' ? 'selected' : '' ?>>Sí</option>
                    <option value="No" <?= ($datos_beneficiario['ingresos']['pension'] ?? '') == 'No' ? 'selected' : '' ?>>No</option>
                </select>
                </div>

                <div class="col-md-6">
                <label for="bono" class="form-label">¿Recibe Pensiones?</label>
                <select name="bono" id="bono" class="form-select form-select-sm bg-dark text-white" required>
                    <option value="">Seleccione</option>
                    <option value="Si" <?= ($datos_beneficiario['ingresos']['bono'] ?? '') == 'Si' ? 'selected' : '' ?>>Sí</option>
                    <option value="No" <?= ($datos_beneficiario['ingresos']['bono'] ?? '') == 'No' ? 'selected' : '' ?>>No</option>
                </select>
                </div>
            </div>
            </section>


            <!-- Sección: Datos Laborales -->
<section class="mb-4">
  <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3">
    <i class="fa fa-briefcase me-2"></i> Datos Laborales
  </h6>
  <div class="row g-3">
    <div class="col-md-6">
      <label for="trabajo1" class="form-label">¿Trabaja?</label>
      <select name="trabajo1" id="trabajo1" class="form-select form-select-sm bg-dark text-white" required onchange="mostrarCampoTrabajo()">
        <option value="">Seleccione</option>
        <option value="Si" <?= (isset($datos_beneficiario['trabajo']['trabajo']) && strtolower($datos_beneficiario['trabajo']['trabajo']) !== 'no tiene') ? 'selected' : '' ?>>Sí</option>
        <option value="No" <?= (isset($datos_beneficiario['trabajo']['trabajo']) && strtolower($datos_beneficiario['trabajo']['trabajo']) === 'no tiene') ? 'selected' : '' ?>>No</option>
      </select>
    </div>
  </div>

        <!-- Campos condicionales si trabaja -->
        <div id="campoTrabajo" class="row g-3 mt-3" style="display: none;">
            <div class="col-md-6">
            <label for="trabajo" class="form-label">Trabajo</label>
            <input type="text" id="trabajo" name="trabajo" class="form-control form-control-sm bg-dark text-white"
                value="<?= $datos_beneficiario['trabajo']['trabajo'] ?? '' ?>" placeholder="Trabajo del Beneficiario">
            </div>
            <div class="col-md-6">
            <label for="direccion_trabajo" class="form-label">Dirección de Trabajo</label>
            <input type="text" id="direccion_trabajo" name="direccion_trabajo" class="form-control form-control-sm bg-dark text-white"
                value="<?= $datos_beneficiario['trabajo']['direccion_trabajo'] ?? '' ?>" placeholder="Dirección de Trabajo">
            </div>
            <div class="col-md-6">
            <label for="trabaja_public" class="form-label">¿Trabaja en el sector público?</label>
            <select name="trabaja_public" id="trabaja_public" class="form-select form-select-sm bg-dark text-white" onchange="mostrarInstitucion()">
                <option value="">Seleccione</option>
                <option value="Si" <?= ($datos_beneficiario['trabajo']['trabaja_public'] ?? '') == 'Si' ? 'selected' : '' ?>>Sí</option>
                <option value="No" <?= ($datos_beneficiario['trabajo']['trabaja_public'] ?? '') == 'No' ? 'selected' : '' ?>>No</option>
            </select>
            </div>
            <div class="col-md-6" id="campoInstitucion" style="display: none;">
            <label for="nombre_insti" class="form-label">Nombre de la Institución</label>
            <input type="text" id="nombre_insti" name="nombre_insti" class="form-control form-control-sm bg-dark text-white"
                value="<?= $datos_beneficiario['trabajo']['nombre_insti'] ?? '' ?>" placeholder="Nombre de la Institución">
            </div>
        </div>
        </section>

                    <!-- Sección: Nivel de Instrucción y Profesión -->
        <section class="mb-4">
        <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3">
            <i class="fa fa-graduation-cap me-2"></i> Formación Académica
        </h6>
        <div class="row g-3">
            <div class="col-md-6">
            <label for="nivel_instruc" class="form-label">Nivel de Instrucción</label>
            <select name="nivel_instruc" id="nivel_instruc" class="form-select form-select-sm bg-dark text-white" required>
                <option value="">Seleccione</option>
                <option value="Primaria" <?= ($datos_beneficiario['conocimiento']['nivel_instruc'] ?? '') == 'Primaria' ? 'selected' : '' ?>>Primaria</option>
                <option value="Secundaria" <?= ($datos_beneficiario['conocimiento']['nivel_instruc'] ?? '') == 'Secundaria' ? 'selected' : '' ?>>Secundaria</option>
                <option value="Universidad" <?= ($datos_beneficiario['conocimiento']['nivel_instruc'] ?? '') == 'Universidad' ? 'selected' : '' ?>>Universidad</option>
            </select>
            </div>

            <div class="col-md-6">
            <label for="profesion" class="form-label">Profesión</label>
            <input type="text" id="profesion" name="profesion" class="form-control form-control-sm bg-dark text-white"
                value="<?= $datos_beneficiario['conocimiento']['profesion'] ?? '' ?>" required
                placeholder="Profesión del Beneficiario">
            </div>
        </div>
        </section>


        <!-- Sección: Datos de la Solicitud -->
<section class="mb-4">
  <h6 class="bg-secondary text-white py-2 px-3 rounded mb-3">
    <i class="fa fa-hand-holding-heart me-2"></i> Datos de la Solicitud
  </h6>
  <div class="row g-3">
    <div class="col-md-6">
      <label for="id_manual" class="form-label">Número de documento</label>
      <input type="text" id="id_manual" name="id_manual"
        class="form-control form-control-sm bg-dark text-white"
        placeholder="Ejemplo: 00004578" required
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
        value="<?= $_POST['id_manual'] ?? '' ?>">
    </div>

    <div class="col-md-6">
      <label for="descripcion" class="form-label">Descripción</label>
      <input type="text" id="descripcion" name="descripcion"
        class="form-control form-control-sm bg-dark text-white"
        placeholder="Ejemplo: Ayuda para silla de ruedas" required
        value="<?= $_POST['descripcion'] ?? '' ?>">
    </div>

    <div class="col-md-6">
      <label for="categoria" class="form-label">Categoría</label>
      <select name="categoria" id="categoria"
        class="form-select form-select-sm bg-dark text-white" required>
        <option value="">Seleccione</option>
        <option value="Ayudas Técnicas" <?= ($_POST['categoria'] ?? '') == 'Ayudas Técnicas' ? 'selected' : '' ?>>Ayudas Técnicas</option>
        <option value="Medicamentos" <?= ($_POST['categoria'] ?? '') == 'Medicamentos' ? 'selected' : '' ?>>Medicamentos</option>
        <option value="Laboratorio" <?= ($_POST['categoria'] ?? '') == 'Laboratorio' ? 'selected' : '' ?>>Laboratorio</option>
        <option value="Enseres" <?= ($_POST['categoria'] ?? '') == 'Enseres' ? 'selected' : '' ?>>Enseres</option>
        <option value="Económica" <?= ($_POST['categoria'] ?? '') == 'Económica' ? 'selected' : '' ?>>Económica</option>
      </select>
    </div>

    <div class="col-md-6 campo-formulario">
      <label for="tipo_ayuda" class="form-label">Tipo de Ayuda</label>
      <select name="tipo_ayuda" id="tipo_ayuda" class="form-select form-select-sm bg-dark text-white" required>>
        <option value="">Seleccione</option>
        <option value="Silla de Ruedas" <?= ($_POST['tipo_ayuda'] ?? '') == 'Silla de Ruedas' ? 'selected' : '' ?>>Silla de Ruedas</option>
        <option value="Silla de Ruedas(Niño)" <?= ($_POST['tipo_ayuda'] ?? '') == 'Silla de Ruedas(Niño)' ? 'selected' : '' ?>>Silla de Ruedas (Niño)</option>
        <option value="Andadera" <?= ($_POST['tipo_ayuda'] ?? '') == 'Andadera' ? 'selected' : '' ?>>Andadera</option>
        <option value="Andadera (Niño)" <?= ($_POST['tipo_ayuda'] ?? '') == 'Andadera (Niño)' ? 'selected' : '' ?>>Andadera (Niño)</option>
        <option value="Bastón 1 Punta" <?= ($_POST['tipo_ayuda'] ?? '') == 'Bastón 1 Punta' ? 'selected' : '' ?>>Bastón 1 Punta</option>
        <option value="Bastón 3 Puntas" <?= ($_POST['tipo_ayuda'] ?? '') == 'Bastón 3 Puntas' ? 'selected' : '' ?>>Bastón 3 Puntas</option>
        <option value="Bastón 4 Puntas" <?= ($_POST['tipo_ayuda'] ?? '') == 'Bastón 4 Puntas' ? 'selected' : '' ?>>Bastón 4 Puntas</option>
        <option value="Muletas" <?= ($_POST['tipo_ayuda'] ?? '') == 'Muletas' ? 'selected' : '' ?>>Muletas</option>
        <option value="Muletas (Niño)" <?= ($_POST['tipo_ayuda'] ?? '') == 'Muletas (Niño)' ? 'selected' : '' ?>>Muletas (Niño)</option>
        <option value="Collarín" <?= ($_POST['tipo_ayuda'] ?? '') == 'Collarín' ? 'selected' : '' ?>>Collarín</option>
        <option value="Colchón Anti-escaras" <?= ($_POST['tipo_ayuda'] ?? '') == 'Colchón Anti-escaras' ? 'selected' : '' ?>>Colchón Anti-escaras</option>
      </select>
    </div>

    
    <div class="col-12">
      <label for="observaciones_ayuda" class="form-label">Observaciones</label>
      <input type="text" id="observaciones_ayuda" name="observaciones"
        class="form-control form-control-sm bg-dark text-white"
        value="<?= $_POST['observaciones'] ?? '' ?>"
        placeholder="Detalles relevantes (Opcional)">
    </div>
  </div>
</section>

      <!-- Botón de envío -->
      <div class="text-end mt-4">
        <button type="submit" class="btn btn-outline-light px-4">
          <i class="fa fa-paper-plane me-2"></i> Enviar Solicitud
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
<script src="<?= BASE_URL ?>/public/js/edad.js"></script>
<script src="<?= BASE_URL ?>/public/js/trabajo.js"></script>
<script>
// Datos precargados desde PHP
const data_exists = "<?= isset($data['data_exists']) && $data['data_exists'] ? '1' : '0' ?>";
const tiposPatologiaGuardados = "<?= $data['tiposJS'] ?? '' ?>".split('|');
const nombresPatologiaGuardados = "<?= $data['nombresJS'] ?? '' ?>".split('|');
</script>
<script src="<?= BASE_URL ?>/public/js/patologia.js"></script>
<script src="<?= BASE_URL ?>/public/js/tipo_ayuda.js"></script>
</html>