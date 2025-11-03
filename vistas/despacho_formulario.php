<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Despacho</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
</head>
<body class="solicitud-body">
    <header class="header">
        <div class="titulo-header">Formulario de despacho</div>
        <div class="header-right">
            <a href="<?=BASE_URL?>/despacho_list"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
        </div>
    </header>
    <main>
       <form action="despacho_enviarForm" method="POST" class="formulario-ayuda" autocomplete="off">
    <h2><i class="fa fa-truck"></i> Solicitud de Despacho</h2>

    <!-- 🧍 Datos personales -->
    <h3>Datos del Beneficiario</h3>
    <div class="fila-formulario">
        <div class="campo-formulario">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre del beneficiario"
                value="<?= $_POST['nombre'] ?? $datos_beneficiario['solicitante']['nombre'] ?? null ?>" required>
        </div>
        <div class="campo-formulario">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" placeholder="Apellido del beneficiario"
                value="<?= $_POST['apellido'] ?? $datos_beneficiario['solicitante']['apellido'] ?? null ?>" required>
        </div>
    </div>

    <input type="hidden" name="id_solicitante"
        value="<?= $_POST['id_solicitante'] ?? $datos_beneficiario['solicitante']['id_solicitante'] ?? null ?>">

    <div class="fila-formulario">
        <div class="campo-formulario">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" placeholder="Télefono del beneficiario"
                value="<?= $_POST['telefono'] ?? $datos_beneficiario['info']['telefono'] ?? null ?>" required
                oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="12">
        </div>
        <div class="campo-formulario">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" placeholder="Correo del beneficiario"
                value="<?= $_POST['correo'] ?? $datos_beneficiario['solicitante']['correo'] ?? null ?>" required>
        </div>
        <div class="campo-formulario">
            <label for="ci">Cédula de Identidad:</label>
            <input type="text" id="ci" name="ci" placeholder="Ejem: V-12345678"
                value="<?= htmlspecialchars($_POST['ci'] ?? $datos_beneficiario['solicitante']['ci'] ?? $ci ?? '') ?>"
                required oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10" readonly>
        </div>
    </div>

    <div class="fila-formulario">
        <div class="campo-formulario">
            <label for="comunidad">Comunidad:</label>
            <select name="comunidad" id="comunidad" required>
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
        <div class="campo-formulario">
            <label for="direc_habita">Dirección:</label>
            <input type="text" id="direc_habita" name="direc_habita" placeholder="Dirección del beneficiario"
                value="<?= $_POST['direc_habita'] ?? $datos_beneficiario['comunidad']['direc_habita'] ?? null ?>"
                required>
        </div>
    </div>

    <!-- 📦 Datos de la solicitud -->
    <h3>Datos de la Solicitud</h3>
    <div class="fila-formulario">
        <div class="campo-formulario">
            <label for="id_manual">Número de documento:</label>
            <input type="text" id="id_manual" name="id_manual" placeholder="00004578"
                value="<?= $_POST['id_manual'] ?? null ?>" required
                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
        <div class="campo-formulario">
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria" required>
                <?php
                $categoria_actual = $_POST['categoria'] ?? null;
                $categorias = ['Salud', 'Ayuda Económica', 'Materiales de Construcción', 'Varios'];
                echo '<option value="">Seleccione</option>';
                foreach ($categorias as $cat) {
                    $selected = ($cat === $categoria_actual) ? 'selected' : '';
                    echo "<option value=\"$cat\" $selected>$cat</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="fila-formulario" id="tipoAyudaContainer">
        <div class="campo-formulario" id="tipoAyudaContainer">
            <label for="tipo_ayuda">Tipo de ayuda:</label>
            <select name="tipo_ayuda" id="tipo_ayuda" required></select>
            <input type="hidden" id="tipo_ayuda_precargado" value="<?= htmlspecialchars($_POST['tipo_ayuda'] ?? '') ?>">
        </div>

    </div>

    <div class="fila-formulario">
        <div class="campo-formulario">
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" required
                placeholder="Descripción específica de la ayuda (Ejemplo: 3 Sacos de cemento para la Alcaldía de Peña)"
                value="<?= $_POST['descripcion'] ?? null ?>">
        </div>
    </div>

    <button type="submit" class="boton-enviar-ayuda"><i class="fa fa-paper-plane"></i> Enviar</button>
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