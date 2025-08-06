<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Despacho</title>
</head>
<body>
    <h1 class="mensaje"><?= isset($msj) ? htmlspecialchars($msj) : '' ?></h1>
    <form action="despacho_enviarForm" method="POST">
        <label for="id_manual">Número de documento:</label>
                <input type="text" id="id_manual" name="id_manual" placeholder="00004578" required>

        <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $datos_beneficiario['solicitante']['nombre'] ?? '' ?>" required>

        <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?= $datos_beneficiario['solicitante']['apellido'] ?? '' ?>" required>

        <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?= $datos_beneficiario['info']['telefono'] ?? '' ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">

        <label for="ci">Cedula de Identidad:</label>
                <input type="text" id="ci" name="ci" placeholder="Ejem: V-12345678" value="<?= htmlspecialchars($datos_beneficiario['solicitante']['ci'] ?? '') ?>" required>

        <label for="direc_habita">Dirección:</label>
                <input type="text" id="direc_habita" name="direc_habita" value="<?= $datos_beneficiario['comunidad']['direc_habita'] ?? '' ?>" required>
                
        <label for="apellido">Asunto:</label>
                <input type="text" id="asunto" name="asunto" required placeholder="Asunto">

        <input type="submit" value="Enviar">
    </form>
</body>
</html>