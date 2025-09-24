document.addEventListener('DOMContentLoaded', function () {
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
        data: window.solicitudesData,
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
});
