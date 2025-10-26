document.addEventListener('DOMContentLoaded', function () {
  const ctx = document.getElementById('graficaSolicitudes').getContext('2d');
  const grafica = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        'En Espera del Documento',
        'En Proceso 1/2',
        'En Proceso 2/2 Sin Entregar',
        'Solicitudes finalizadas'
      ],
      datasets: [{
        label: 'Cantidad de Solicitudes',
        data: window.solicitudesData,
        backgroundColor: [
          '#3b4cca', // En espera (igual al contador)
          '#ffd600', // Proceso (igual al contador)
          '#ffd600', // Proceso (igual al contador)
          '#4caf50'  // Finalizadas (igual al contador)
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
