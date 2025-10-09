<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Solicitud</title>
</head>
<body>
    <select id="categoria">
        <option value="">Seleccione...</option>
        <option value="">Ecosonograma</option>
        <option value="">Eco-Doppler</option>
        <option value="">Medicamentos</option>
        <option value="">Laboratorio San Vicente (Hematología Completa)</option>
        <option value="">Laboratorio San Vicente (Glicemia)</option>
        <option value="">Laboratorio San Vicente (Orina)</option>
        <option value="">Laboratorio San Vicente (Heces)</option>
    </select>

    <form action="<?= BASE_URL ?>/registrar_solicitud_urgencia" method="POST" class="form-inhabilitado">
        <input type="text" name="nombre" placeholder="Nombre del Paciente" required>
        <input type="text" name="ci" placeholder="Cédula" required>
        <input type="hidden" name="beneficio">
        <input type="hidden" name="categoria" value="Laboratorio">
        <input type="hidden" name="tipo_ayuda" value="Otros">
        <input type="submit" value="Registrar Solicitud">
    </form>

    <form action="<?= BASE_URL ?>/registrar_solicitud_urgencia" method="POST" class="form-inhabilitado">
        <input type="text" name="nombre" placeholder="Nombre del Paciente" required>
        <input type="text" name="ci" placeholder="Cédula" required>
        <input type="hidden" name="beneficio">
        <input type="hidden" name="categoria" value="Laboratorio">
        <input type="hidden" name="tipo_ayuda" value="Otros">
        <input type="submit" value="Registrar Solicitud">
    </form>

    <form action="<?= BASE_URL ?>/registrar_solicitud_urgencia" method="POST" class="form-inhabilitado">
        <input type="text" name="nombre" placeholder="Nombre del Paciente" required>
        <input type="text" name="ci" placeholder="Cédula" required>
        <label for="">Seleccione en caso de ser más de un examen: </label>
        <input type="checkbox" name="beneficio[]" id="" value="Hematología Completa">
        <input type="checkbox" name="beneficio[]" id="" value="Glicemia">
        <input type="checkbox" name="beneficio[]" id="" value="Orina">
        <input type="checkbox" name="beneficio[]" id="" value="Heces">
        <input type="hidden" name="categoria" value="Laboratorio">
        <input type="hidden" name="tipo_ayuda" value="Otros">
        <input type="submit" value="Registrar Solicitud">
    </form>
</body>

</html>