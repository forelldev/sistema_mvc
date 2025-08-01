<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de ayuda</title>
</head>
<body>
    <form action="<?=BASE_URL?>/busqueda" method="POST">
        <input type="text" name="ci" placeholder="Ingrese su CI">
        <input type="submit" value="Buscar">
    </form>
</body>
</html>