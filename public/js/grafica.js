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
      datasets: [
        {
          label: 'Válido',
          data: window.valData, // <-- nuevo arreglo con válidos
          backgroundColor: 'rgba(25, 135, 84, 0.7)', // verde Bootstrap
          borderColor: 'rgba(25, 135, 84, 1)',
          borderWidth: 1,
          borderRadius: 6,
          barPercentage: 0.6,
          categoryPercentage: 0.7
        },
        {
          label: 'Inválido',
          data: window.invData, // <-- nuevo arreglo con inválidos
          backgroundColor: 'rgba(220, 53, 69, 0.7)', // rojo Bootstrap
          borderColor: 'rgba(220, 53, 69, 1)',
          borderWidth: 1,
          borderRadius: 6,
          barPercentage: 0.6,
          categoryPercentage: 0.7
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: {
          top: 20,
          bottom: 10,
          left: 15,
          right: 15
        }
      },
      plugins: {
        legend: {
          labels: {
            color: '#ffffff',
            font: {
              size: 14,
              weight: 'bold'
            }
          }
        },
        tooltip: {
          backgroundColor: '#333333',
          titleColor: '#ffffff',
          bodyColor: '#eeeeee',
          borderColor: '#555555',
          borderWidth: 1,
          callbacks: {
            afterBody: function (items) {
              const i = items[0].dataIndex;
              const total = window.valData[i] + window.invData[i];
              return 'Total: ' + total;
            }
          }
        }
      },
      scales: {
        x: {
          stacked: true,
          ticks: {
            color: '#ffffff',
            font: {
              size: 12
            }
          },
          grid: {
            color: '#444444'
          }
        },
        y: {
          stacked: true,
          beginAtZero: true,
          ticks: {
            color: '#ffffff',
            stepSize: 1,
            font: {
              size: 12
            }
          },
          grid: {
            color: '#444444'
          }
        }
      }
    }
  });
});
