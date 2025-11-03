<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solicitud</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
</head>
<body class="solicitud-body">
    <header class="header">
        <div class="titulo-header">Editar solicitud de despacho</div>
        <div class="header-right">
            <a href="<?=BASE_URL?>/main"><button class="nav-btn"><i class="fa fa-home"></i> Inicio</button></a>
            <a href="<?=BASE_URL?>/despacho_list"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
        </div>
    </header>
    <main>
        <form action="editar_solicitudDespacho" method="POST" class="registro-card form-user" autocomplete="off">
          <h3>Datos de la Solicitud</h3>
  <div class="fila-formulario">
    <div class="campo-formulario">
        <label for="id_manual">Número de documento:</label>
        <input type="text" id="id_manual" name="id_manual" placeholder="00004578"
            value="<?= htmlspecialchars($datos['id_manual'] ?? '') ?>" required
            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
    </div>
    <div class="campo-formulario">
        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria" required>
            <?php
            $categoria_actual = $datos['categoria'] ?? '';
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
    <div class="campo-formulario">
        <label for="tipo_ayuda">Tipo de ayuda:</label>
        <select name="tipo_ayuda" id="tipo_ayuda" required></select>
        <input type="hidden" id="tipo_ayuda_precargado" value="<?= htmlspecialchars($datos['tipo_ayuda'] ?? '') ?>">
    </div>
</div>
<input type="hidden" name="id_despacho" value="<?= $datos['id_despacho'] ?? ''?>">

<div class="fila-formulario">
    <div class="campo-formulario">
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required
            placeholder="Descripción específica de la ayuda (Ejemplo: 3 Sacos de cemento para la Alcaldía de Peña)"
            value="<?= htmlspecialchars($datos['descripcion'] ?? '') ?>">
    </div>
</div>

<button type="submit" class="boton-enviar-ayuda"><i class="fa fa-paper-plane"></i> Guardar Cambios</button>

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
<script src="<?= BASE_URL ?>/public/js/formulario_despacho.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>