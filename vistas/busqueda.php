<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de ayuda</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/solicitud.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/registro.css?v=<?php echo time(); ?>">
</head>
<body class="solicitud-body">
    <header class="header">
    <div class="titulo-header">Verificar si el beneficiario ya está registrado</div>
    <div class="header-right">
      <a href="<?= BASE_URL ?>/main"><button class="nav-btn"><i class="fa fa-home"></i> Inicio</button></a>
      <a href="<?= BASE_URL ?>/solicitudes_list"><button class="nav-btn"><i class="fa fa-arrow-left"></i> Volver atrás</button></a>
    </div>
  </header>
<main>
    <?php if($_SESSION['id_rol'] !== 2){?>
        <form action="<?=BASE_URL?>/formulario" method="POST" class="registro-card form-user" autocomplete="off">
            <h2><i class="fa fa-search"></i> Buscar por CI</h2>
            <div class="campo-user">
            <label for="ci">Cédula de Identidad</label>
            <input type="text" name="ci" placeholder="Ingrese su CI" class="input-ci" required>
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria">
                <option value="Medicamentos">Medicamentos</option>
                <option value="Laboratorio">Laboratorio(Ecos, Radiografías, etc...)</option>
                <option value="Ayudas Tecnicas">Ayudas Técnicas</option>
                <option value="Enseres">Enseres</option>
                <option value="Economico">Económico</option>
            </select>
            </div>
            <button type="submit" value="Buscar" class="boton-enviar-ayuda"><i class="fa fa-search"></i>Buscar</button>
        </form>
    <?php  } else {?>
        <form action="<?=BASE_URL?>/buscar_cidespacho" method="POST" class="registro-card form-user" autocomplete="off">
            <h2><i class="fa fa-search"></i> Buscar por CI</h2>
            <div class="campo-user">
            <label for="ci">Cédula de Identidad</label>
            <input type="text" name="ci" placeholder="Ingrese su CI" class="input-ci" required>
            </div>
            <button type="submit" value="Buscar" class="boton-enviar-ayuda"><i class="fa fa-search"></i>Buscar</button>
        </form>
    <?php  } ?>
</main>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>