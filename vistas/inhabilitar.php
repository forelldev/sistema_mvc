<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inhabilitar</title>
</head>
<body>
<?php if($_SESSION['id_rol'] !== 2){?>
    <form action="inhabilitar_solicitud" method="POST">
        <input type="hidden" name="id_doc" value=<?= $id_doc ?? 'No hay ID' ?>>
        <input type="text" name="razon" placeholder="Razón por la cual será inhabilitada esta solicitud">
        <input type="submit" value="Aceptar">
    </form>
<?php }else{?>
    <form action="inhabilitar_solicitudDespacho" method="POST">
        <input type="hidden" name="id_doc" value=<?= $id_doc ?? 'No hay ID' ?>>
        <input type="text" name="razon" placeholder="Razón por la cual será inhabilitada esta solicitud">
        <input type="submit" value="Aceptar">
    </form>
<?php } ?>
</body>
</html>