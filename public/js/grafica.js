
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
          '#f2ef26ff', // En espera
          '#3ab7faff', // Proceso
          '#3ab7faff',
          '#3ab7faff',
          '#4caf50'    // Finalizadas
        ],
        borderRadius: 6,
        barPercentage: 0.6,
        categoryPercentage: 0.7
      }]
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
          borderWidth: 1
        }
      },
      scales: {
        x: {
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
