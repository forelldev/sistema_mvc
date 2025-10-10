<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Solicitud</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/reportes.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body>
    <select id="categoria_valor">
        <option value="">Seleccione...</option>
        <option value="Ecosonograma">Ecosonograma</option>
        <option value="Eco-Doppler">Eco-Doppler</option>
        <option value="Medicamentos">Medicamentos</option>
        <option value="Laboratorio San Vicente (Hematología Completa)">Laboratorio San Vicente (Hematología Completa)</option>
        <option value="Laboratorio San Vicente (Glicemia)">Laboratorio San Vicente (Glicemia)</option>
        <option value="Laboratorio San Vicente (Orina)">Laboratorio San Vicente (Orina)</option>
        <option value="Laboratorio San Vicente (Heces)">Laboratorio San Vicente (Heces)</option>
    </select>


    <form action="<?= BASE_URL ?>/registrar_solicitud_urgencia" method="POST" class="form-inhabilitado" id="form_laboratorio">
        <input type="text" name="nombre" placeholder="Nombre del Paciente" value="<?= $datos_beneficiario['solicitante']['nombre'] ?? '' ?>"  required>
        <input type="text" name="apellido" placeholder="Nombre del Paciente" value="<?= $datos_beneficiario['solicitante']['apellido'] ?? '' ?>"  required>
        <input type="text" name="ci" placeholder="Cédula" required value="<?= $datos_beneficiario['solicitante']['ci'] ?? '' ?>" >
        <input type="hidden" name="beneficio">
        <input type="hidden" name="categoria" value="Laboratorio">
        <input type="hidden" name="tipo_ayuda" value="Otros">
        <input type="submit" value="Registrar Solicitud">
    </form>

    <form action="<?= BASE_URL ?>/registrar_solicitud_urgencia" method="POST" class="form-inhabilitado" id="form_medicamentos">
        <input type="text" name="nombre" placeholder="Nombre del Paciente" required value="<?= $datos_beneficiario['solicitante']['nombre'] ?? '' ?>">
        <input type="text" name="apellido" placeholder="Nombre del Paciente" value="<?= $datos_beneficiario['solicitante']['apellido'] ?? '' ?>"  required>
        <input type="text" name="ci" placeholder="Cédula" required value="<?= $datos_beneficiario['solicitante']['ci'] ?? '' ?>">
        <input type="hidden" name="beneficio">
        <input type="hidden" name="categoria" value="Medicamentos">
        <input type="hidden" name="tipo_ayuda" value="Otros">
        <input type="submit" value="Registrar Solicitud">
    </form>

    <form action="<?= BASE_URL ?>/registrar_solicitud_urgencia" method="POST" class="form-inhabilitado" id="form_laboratorio_group">
        <input type="text" name="nombre" placeholder="Nombre del Paciente" required value="<?= $datos_beneficiario['solicitante']['nombre'] ?? '' ?>">
        <input type="text" name="apellido" placeholder="Nombre del Paciente" value="<?= $datos_beneficiario['solicitante']['apellido'] ?? '' ?>"  required>
        <input type="text" name="ci" placeholder="Cédula" required value="<?= $datos_beneficiario['solicitante']['ci'] ?? '' ?>">
        <label for="">Seleccione en caso de ser más de un examen: </label>
        <label for="hematologia">
        <input type="checkbox" name="beneficio[]" id="hematologia" value="Hematología Completa">
        Hematología Completa
        </label><br>
        <label for="glicemia">
            <input type="checkbox" name="beneficio[]" id="glicemia" value="Glicemia">
            Glicemia
        </label><br>
        <label for="orina">
            <input type="checkbox" name="beneficio[]" id="orina" value="Orina">
            Orina
        </label><br>
        <label for="heces">
            <input type="checkbox" name="beneficio[]" id="heces" value="Heces">
            Heces
        </label><br>
        <input type="hidden" name="categoria" value="Laboratorio2">
        <input type="hidden" name="tipo_ayuda" value="Otros">
        <input type="submit" value="Registrar Solicitud">
    </form>
</body>
<script src="<?= BASE_URL ?>/public/js/solicitud_urgencia.js"></script>
</html>