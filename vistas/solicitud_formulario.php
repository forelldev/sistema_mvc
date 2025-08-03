<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Ayuda Formulario</title>
</head>
<body>
    <a href="<?=BASE_URL?>/main">Volver</a>
    <form action="<?=BASE_URL?>/solicitud_formulario" method="POST">
        <p>Datos Personales</p>

            <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $datos_beneficiario['solicitante']['nombre'] ?? '' ?>" required>

            <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?= $datos_beneficiario['solicitante']['apellido'] ?? '' ?>" required>

            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $datos_beneficiario['info']['fecha_nacimiento'] ?? '' ?>" required>
                <input type="hidden" id="edad" name="edad" value="<?= $datos_beneficiario['info']['edad'] ?? '' ?>">

            <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?= $datos_beneficiario['info']['telefono'] ?? '' ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">

            <label for="lugar_nacimiento">Lugar de Nacimiento:</label>
                <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" value="<?= $datos_beneficiario['info']['lugar_nacimiento'] ?? '' ?>" required>

            <label for="estado_civil">Estado Civil:</label>
                <select name="estado_civil" id="estado_civil" required>
                    <option value="Soltero/a" <?= ($datos_beneficiario['info']['estado_civil'] ?? '') == 'Soltero/a' ? 'selected' : '' ?>>Soltero/a</option>
                    <option value="Casado/a" <?= ($datos_beneficiario['info']['estado_civil'] ?? '') == 'Casado/a' ? 'selected' : '' ?>>Casado/a</option>
                    <option value="Viudo/a" <?= ($datos_beneficiario['info']['estado_civil'] ?? '') == 'Viudo/a' ? 'selected' : '' ?>>Viudo/a</option>
                </select>

            <label for="codigo_patria">Código de Patria:</label>
                <input type="text" id="codigo_patria" name="codigo_patria" value="<?= $datos_beneficiario['extra']['codigo_patria'] ?? '' ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">

            <label for="serial_patria">Serial de Patria:</label>
                <input type="text" id="serial_patria" name="serial_patria" value="<?= $datos_beneficiario['extra']['serial_patria'] ?? '' ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">

            <label for="nivel_instruc">Nivel de Instrucción:</label>
                <select name="nivel_instruc" id="nivel_instruc" required>
                    <option value="Primaria" <?= ($datos_beneficiario['conocimiento']['nivel_instruc'] ?? '') == 'Primaria' ? 'selected' : '' ?>>Primaria</option>
                    <option value="Secundaria" <?= ($datos_beneficiario['conocimiento']['nivel_instruc'] ?? '') == 'Secundaria' ? 'selected' : '' ?>>Secundaria</option>
                    <option value="Universidad" <?= ($datos_beneficiario['conocimiento']['nivel_instruc'] ?? '') == 'Universidad' ? 'selected' : '' ?>>Universidad</option>
                </select>

            <label for="profesion">Profesión:</label>
                <input type="text" id="profesion" name="profesion" value="<?= $datos_beneficiario['conocimiento']['profesion'] ?? '' ?>" required>

            <label for="trabajo1">¿Trabaja?</label>
                <select name="trabajo1" id="trabajo1" required onchange="mostrarCampoTrabajo()">
                    <option value="">Seleccione</option>
                    <option value="Si" <?= (isset($datos_beneficiario['trabajo']['trabajo']) && strtolower($datos_beneficiario['trabajo']['trabajo']) !== 'No tiene') ? 'selected' : '' ?>>Sí</option>
                    <option value="No" <?= (isset($datos_beneficiario['trabajo']['trabajo']) && strtolower($datos_beneficiario['trabajo']['trabajo']) === 'No tiene') ? 'selected' : '' ?>>No</option>
                </select>

            <div id="campoTrabajo" style="display:none; margin-top:10px;">
                <label for="trabajo">Trabajo:</label>
                    <input type="text" id="trabajo" name="trabajo" value="<?= $datos_beneficiario['trabajo']['trabajo'] ?? '' ?>">

                <label for="direccion_trabajo">Dirección de Trabajo:</label>
                    <input type="text" id="direccion_trabajo" name="direccion_trabajo" value="<?= $datos_beneficiario['trabajo']['direccion_trabajo'] ?? '' ?>">

                <label for="trabaja_public">¿Trabaja en el sector público?</label>
                    <select name="trabaja_public" id="trabaja_public" onchange="mostrarInstitucion()">
                        <option value="">Seleccione</option>
                        <option value="Si" <?= ($datos_beneficiario['trabajo']['trabaja_public'] ?? '') == 'Si' ? 'selected' : '' ?>>Sí</option>
                        <option value="No" <?= ($datos_beneficiario['trabajo']['trabaja_public'] ?? '') == 'No' ? 'selected' : '' ?>>No</option>
                    </select>

                <div id="campoInstitucion" style="display:none; margin-top:10px;">
                    <label for="nombre_insti">Nombre de la Institución:</label>
                    <input type="text" id="nombre_insti" name="nombre_insti" value="<?= $datos_beneficiario['trabajo']['nombre_insti'] ?? '' ?>">
                </div>
            </div>

            <label for="comunidad">Comunidad:</label>
                <select name="comunidad" id="comunidad" required>
                    <option value="plus">Agregar Comunidad</option>
                    <!-- Aquí puedes agregar más opciones dinámicamente -->
                </select>

            <label for="direc_habita">Dirección de Habitación:</label>
                <input type="text" id="direc_habita" name="direc_habita" value="<?= $datos_beneficiario['comunidad']['direc_habita'] ?? '' ?>" required>

            <label for="estruc_base">Estructura Base:</label>
                <input type="text" id="estruc_base" name="estruc_base" value="<?= $datos_beneficiario['comunidad']['estruc_base'] ?? '' ?>" required>

        <p>Datos Físicos Ambientales</p>

            <label for="propiedad">Propiedad</label>
                <select name="propiedad" id="propiedad" required>
                    <option value="Casa" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Casa' ? 'selected' : '' ?>>Casa</option>
                    <option value="Apartamento" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Apartamento' ? 'selected' : '' ?>>Apartamento</option>
                    <option value="Rancho" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Rancho' ? 'selected' : '' ?>>Rancho</option>
                    <option value="Otro" <?= ($datos_beneficiario['propiedad']['propiedad'] ?? '') == 'Otro' ? 'selected' : '' ?>>Otro</option>
                </select>

            <label for="propiedad_est">Estado de Propiedad</label>
                <select name="propiedad_est" id="propiedad_est" required>
                    <option value="Propia" <?= ($datos_beneficiario['propiedad']['propiedad_est'] ?? '') == 'Propia' ? 'selected' : '' ?>>Propia</option>
                    <option value="Prestada" <?= ($datos_beneficiario['propiedad']['propiedad_est'] ?? '') == 'Prestada' ? 'selected' : '' ?>>Prestada</option>
                    <option value="Alquiler" <?= ($datos_beneficiario['propiedad']['propiedad_est'] ?? '') == 'Alquiler' ? 'selected' : '' ?>>Alquiler</option>
                </select>

                <label for="observaciones">Observaciones:</label>
                    <input type="text" id="observaciones" name="observaciones_propiedad" placeholder="Detalles adicionales relevantes (Opcional)" value="<?= $datos_beneficiario['propiedad']['observaciones_propiedad'] ?? '' ?>">

        <p>Datos Socio-Económicos</p>

                <label for="nivel_ingreso">Nivel de Ingresos:</label>
                    <input type="text" id="nivel_ingreso" name="nivel_ingreso" placeholder="Ejem: 500 Bs" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= $datos_beneficiario['ingresos']['nivel_ingreso'] ?? '' ?>">

                <label for="pension">¿Recibe Bonos?</label>
                    <select name="pension" id="pension" required>
                        <option value="Si" <?= ($datos_beneficiario['ingresos']['pension'] ?? '') == 'Si' ? 'selected' : '' ?>>Si</option>
                        <option value="No" <?= ($datos_beneficiario['ingresos']['pension'] ?? '') == 'No' ? 'selected' : '' ?>>No</option>
                    </select>

                <label for="bono">¿Recibe Pensiones?</label>
                    <select name="bono" id="bono" required>
                        <option value="Si" <?= ($datos_beneficiario['ingresos']['bono'] ?? '') == 'Si' ? 'selected' : '' ?>>Si</option>
                        <option value="No" <?= ($datos_beneficiario['ingresos']['bono'] ?? '') == 'No' ? 'selected' : '' ?>>No</option>
                    </select>

        <p>Datos de Asistencia Médica</p>

            <label for="tienePatologia">¿Tiene familiares con patología?</label>
                <select id="tienePatologia" name="tienePatologia" onchange="mostrarNumeroFamiliares()" required>
                    <option value="">Seleccione</option>
                    <option value="si" <?= !empty($datos_beneficiario['patologia']) ? 'selected' : '' ?>>Sí</option>
                    <option value="no" <?= empty($datos_beneficiario['patologia']) ? 'selected' : '' ?>>No</option>
                </select>
            <?php $cantidad = count($datos_beneficiario['patologia'] ?? []); ?>
                <div id="numeroFamiliaresContainer" style="<?= $cantidad > 0 ? '' : 'display:none;' ?>; margin-top:10px;">
                    <label for="numeroFamiliares" name="numeroFamiliares">¿Cuántos familiares?</label>
                        <select id="numeroFamiliares" onchange="generarCamposFamiliares()" required>
                            <option value="">Seleccione</option>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <option value="<?= $i ?>" <?= $cantidad === $i ? 'selected' : '' ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                </div>

            <div id="camposFamiliares" style="margin-top:10px;"></div>

        <p>Datos de la Solicitud</p>

                <label for="id_manual">Número de documento:</label>
                    <input type="text" id="id_manual" name="id_manual" placeholder="00004578" required>
                
                <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" placeholder="Ejem: Ayuda para silla de ruedas" required>

                <label for="ci">Cedula de Identidad:</label>
                    <input type="text" id="ci" name="ci" placeholder="Ejem: V-12345678" value="<?= htmlspecialchars($datos_beneficiario['solicitante']['ci'] ?? '') ?>" required>

            <p>Tipo de Ayuda</p>
                <label for="tipo_ayuda">Tipo de Ayuda:</label>
                    <select name="tipo_ayuda" id="tipo_ayuda">
                        <option value="Silla de Ruedas">Silla de Ruedas</option>
                        <option value="Silla de Ruedas(Niño)">Silla de Ruedas(Niño)</option>
                        <option value="Andadera">Andadera</option>
                        <option value="Andadera (Niño)">Andadera (Niño)</option>
                        <option value="Bastón 1 Punta">Bastón 1 Punta</option>
                        <option value="Bastón 3 Puntas">Bastón 3 Puntas</option>
                        <option value="Bastón 4 Puntas">Bastón 4 Puntas</option>
                        <option value="Muletas">Muletas</option>
                        <option value="Muletas (Niño)">Muletas (Niño)</option>
                        <option value="Collarín">Collarín</option>
                        <option value="Colchón Anti-escaras">Colchón Anti-escaras</option>
                        <option value="Otros">Otros</option>
                    </select>

            <p>Categoría:</p>
                <label for="categoria">Categoría</label>
                    <select name="categoria" id="categoria">
                        <option value="Ayudas técnicas">Ayudas técnicas</option>
                        <option value="Medicamentos">Medicamentos</option>
                        <option value="Laboratorio">Laboratorio</option>
                        <option value="Enseres">Enseres</option>
                        <option value="Otros">Otros</option>
                    </select>

                <label for="remitente">Remitente:</label>
                    <input type="text" id="remitente" name="remitente" placeholder="Ejem: María González" required>

                <label for="observaciones">Observaciones:</label>
                    <input type="text" id="observaciones_ayuda" name="observaciones" placeholder="Detalles relevantes (Opcional)">
                
                <input type="submit" value="Enviar">
    </form>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/public/js/edad.js"></script>
<script src="<?= BASE_URL ?>/public/js/trabajo.js"></script>
<script>
    const tiposPatologiaGuardados = "<?= $tiposJS ?>".split('|');
    const nombresPatologiaGuardados = "<?= $nombresJS ?>".split('|');
    const data_exists = "<?= $data_exists ? '1' : '0' ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/patologia.js"></script>

</html>