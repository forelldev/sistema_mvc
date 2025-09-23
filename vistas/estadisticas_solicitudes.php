<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de solicitudes</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>../font/css/all.css?v=<?php echo time(); ?>">
</head>
<body>
    <a href="<?= BASE_URL ?>/">Volver</a>
    <table border="1">
        <tr>
            <th>En Espera del Documento</th>
            <th>En proceso 1/3</th>
            <th>En proceso 2/3</th>
            <th>En proceso 3/3</th>
            <th>Solicitudes finalizadas</th>
        </tr>
        <tr>
            <td><?= $datos['En espera del documento físico para ser procesado 0/3'] ?></td>
            <td><?= $datos['En Proceso 1/3'] ?></td>
            <td><?= $datos['En Proceso 2/3'] ?></td>
            <td><?= $datos['En Proceso 3/3 (Sin Entregar)'] ?></td>
            <td><?= $datos['Solicitud Finalizada (Ayuda Entregada)'] ?></td>
        </tr>
    </table>

    <h1>Gráfica:</h1>
    <canvas id="graficaSolicitudes"></canvas>
</body>
<script src="libs/Chart.min.js"></script>
<script>
  const ctx = document.getElementById('graficaSolicitudes').getContext('2d');
  const grafica = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        'En Espera del Documento',
        'En proceso 1/3',
        'En proceso 2/3',
        'En proceso 3/3',
        'Solicitudes finalizadas'
      ],
      datasets: [{
        label: 'Cantidad de Solicitudes',
        data: [
          <?= $datos['En espera del documento físico para ser procesado 0/3'] ?>,
          <?= $datos['En Proceso 1/3'] ?>,
          <?= $datos['En Proceso 2/3'] ?>,
          <?= $datos['En Proceso 3/3 (Sin Entregar)'] ?>,
          <?= $datos['Solicitud Finalizada (Ayuda Entregada)'] ?>
        ],
        backgroundColor: [
          '#f39c12',
          '#3498db',
          '#9b59b6',
          '#e74c3c',
          '#2ecc71'
        ]
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      }
    }
  });
</script>
<script>
    const BASE_PATH = "<?php echo BASE_PATH; ?>";
</script>
<script src="<?= BASE_URL ?>/public/js/sesionReload.js"></script>
<script src="<?= BASE_URL ?>/public/js/validarSesion.js"></script>
</html>