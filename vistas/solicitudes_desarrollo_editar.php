<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solicitud</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css_bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
</head>
<body class="solicitud-body">
    <header class="header">
        <div class="titulo-header">Editar solicitud</div>
        <div class="header-right">
            <a href="<?=BASE_URL?>/main"><button class="nav-btn"><i class="fa fa-home"></i> Inicio</button></a>
            <a href="<?=BASE_URL?>/solicitudes_desarrollo"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
        </div>
    </header>
    <main>
       <form action="editar_desarrollo" method="POST" class="registro-card form-user">
            <!-- Datos de la solicitud -->
            <div class="mb-4 mt-5">
                <h5 class="text-dark"><i class="fa fa-file-alt me-2"></i>Datos de la Solicitud</h5>
            </div>

            <!-- Categoría -->
            <div class="mb-3">
                <label for="tipo_ayuda" class="form-label">Tipo de ayuda:</label>
                <select id="tipo_ayuda" name="categoria" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <option value="Medicamentos" <?= ($datos['categoria'] ?? '') === 'Medicamentos' ? 'selected' : '' ?>>Medicamentos</option>
                    <option value="Laboratorio" <?= ($datos['categoria'] ?? '') === 'Laboratorio' ? 'selected' : '' ?>>Laboratorio</option>
                </select>
            </div>
            <input type="hidden" name="id_des" value="<?=$datos['id_des'] ?? '' ?>">
            <!-- Subcategoría -->
            <div id="subcategoria_container" class="mb-3" style="display: none;">
                <label for="subcategoria" class="form-label">Tipo de examen:</label>
                <?php
                    $examen = strtolower($datos['examenes'] ?? '');
                    $seleccion = '';

                    if (strpos($examen, 'doppler') !== false) {
                        $seleccion = 'Eco-Doppler';
                    } elseif (strpos($examen, 'sono') !== false || strpos($examen, 'ecosonograma') !== false) {
                        $seleccion = 'Ecosonograma';
                    } else {
                        $seleccion = 'Exámenes de Laboratorio';
                    }
                    ?>
                    <select id="subcategoria" name="subcategoria" class="form-select">
                        <option value="">Seleccione...</option>
                        <option value="Ecosonograma" <?= $seleccion === 'Ecosonograma' ? 'selected' : '' ?>>Ecosonograma</option>
                        <option value="Eco-Doppler" <?= $seleccion === 'Eco-Doppler' ? 'selected' : '' ?>>Eco-Doppler</option>
                        <option value="Exámenes de Laboratorio" <?= $seleccion === 'Exámenes de Laboratorio' ? 'selected' : '' ?>>Exámenes de Laboratorio</option>
                    </select>
            </div>

            <!-- Campo dinámico para exámenes -->
            <div id="campo_examen" class="mb-3" style="display: none;"></div>

            <!-- Número de documento -->
            <div class="mb-3">
                <label for="id_manual" class="form-label">Número de documento:</label>
                <input type="text" name="id_manual" id="id_manual" class="form-control" placeholder="Ingrese el número de documento"
                value="<?= htmlspecialchars($datos['id_manual'] ?? '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" name="descripcion" class="form-control" placeholder="Descripción específica de la ayuda" required
                value="<?= htmlspecialchars($datos['descripcion'] ?? '') ?>">
            </div>

            <input type="hidden" name="tipo_ayuda" value="Otros">

            <!-- Botón de envío -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-4 rounded-pill">
                    Guardar Cambios
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
<script>
  const examenSeleccionado = <?= json_encode($datos['examenes'] ?? []) ?>;
</script>
<script src="<?= BASE_URL?>/public/js/laboratorio_desarrollo.js"></script>
</html>