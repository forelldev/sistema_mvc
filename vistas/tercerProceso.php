<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancias</title>
</head>
<body>
    <h1 class="mensaje"><?= isset($msj) ? htmlspecialchars($msj) : '' ?></h1>
    <!-- En caso de que exista la busqueda a través de get osea que ingresó a una pues se le pone boton de exportar en word o pdf, en caso de que no pues no existe este botón -->
     <table>
        <?php if (!empty($datos)): ?>
        <tr>
            <th>Constancia tipo</th>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Ver Documento</th>
        </tr>
            <?php foreach ($datos as $fila): ?>
        <tr>
            <td><?= htmlspecialchars($fila['tipo']) ?></td>
            <td><?= htmlspecialchars($fila['ci']) ?></td>
            <td><?= htmlspecialchars($fila['nombre']) ?></td>
            <td><?= htmlspecialchars($fila['apellido']) ?></td>
            <td>
                <button class="generar-word"
                        data-tipo="<?= htmlspecialchars($fila['tipo']) ?>"
                        data-ci="<?= htmlspecialchars($fila['ci']) ?>"
                        data-nombre="<?= htmlspecialchars($fila['nombre']) ?>"
                        data-apellido="<?= htmlspecialchars($fila['apellido']) ?>">
                    Generarlo en Word
                </button>
            </td>

        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="solicitud-card">
                <div class="solicitud-header">
                    <span class="solicitud-estado">Sin información</span>
                </div>
                <div class="solicitud-info">
                    No hay información disponible.
                </div>
            </div>
        <?php endif; ?>
     </table>
     <a href="<?= BASE_URL ?>/main">Volver</a>
     <a href="<?= BASE_URL ?>/registro_constancia">Registrar Constancia</a>
</body>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
<script src="<?= BASE_URL ?>/libs/html-docx.js"></script>
<script src="<?= BASE_URL ?>/libs/html-docx.js"></script>
<script>
document.querySelectorAll('.generar-word').forEach(btn => {
  btn.addEventListener('click', () => {
    const tipo = btn.dataset.tipo;
    const ci = btn.dataset.ci;
    const nombre = btn.dataset.nombre;
    const apellido = btn.dataset.apellido;

    const html = `
      <!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Constancia</title>
          <style>
            body { font-family: Arial, sans-serif; }
            h2 { color: #2E86C1; }
            p { font-size: 14px; }
          </style>
        </head>
        <body>
          <h2>Constancia de Identificación</h2>
          <p><strong>Tipo:</strong> ${tipo}</p>
          <p><strong>Cédula:</strong> ${ci}</p>
          <p><strong>Nombre:</strong> ${nombre}</p>
          <p><strong>Apellido:</strong> ${apellido}</p>
        </body>
      </html>
    `;

    const blob = htmlDocx.asBlob(html);
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = `constancia_${ci}.docx`;
    link.click();
  });
});
</script>

</html>