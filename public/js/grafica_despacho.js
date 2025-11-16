document.addEventListener('DOMContentLoaded', function () {
  const ctx = document.getElementById('graficaSolicitudes').getContext('2d');

  const grafica = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        'En Revisión',
        'En Proceso',
        'En Proceso (Sin Entregar)',
        'Finalizadas'
      ],
      datasets: [
        {
          label: 'Válido',
          data: window.valData,
          backgroundColor: 'rgba(25, 135, 84, 0.7)',
          borderColor: 'rgba(25, 135, 84, 1)',
          borderWidth: 1,
          borderRadius: 6
        },
        {
          label: 'Inválido',
          data: window.invData,
          backgroundColor: 'rgba(220, 53, 69, 0.7)',
          borderColor: 'rgba(220, 53, 69, 1)',
          borderWidth: 1,
          borderRadius: 6
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          stacked: true,
          ticks: { color: '#fff' },
          grid: { color: '#444' }
        },
        y: {
          stacked: true,
          beginAtZero: true,
          ticks: { stepSize: 1, color: '#fff' },
          grid: { color: '#444' }
        }
      },
      plugins: {
        legend: { labels: { color: '#fff' } },
        tooltip: {
          callbacks: {
            afterBody: function (items) {
              const i = items[0].dataIndex;
              const total = window.valData[i] + window.invData[i];
              return 'Total: ' + total;
            }
          }
        }
      }
    }
  });
});
