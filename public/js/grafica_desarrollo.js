// public/js/grafica_desarrollo.js
document.addEventListener('DOMContentLoaded', function () {
  const canvas = document.getElementById('graficaSolicitudes');
  if (!canvas) return; // defensa: no rompe si no existe el canvas
  const ctx = canvas.getContext('2d');

  const labels = [
    'En Espera del Documento',
    'En Proceso 1/2',
    'En Proceso 2/2 (Sin Entregar)',
    'Solicitudes finalizadas'
  ];

  // Defensa: si no vienen los arrays, usa vacíos
  const valData = Array.isArray(window.valData) ? window.valData : [0,0,0,0];
  const invData = Array.isArray(window.invData) ? window.invData : [0,0,0,0];

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels,
      datasets: [
        {
          label: 'Válido',
          data: valData,
          backgroundColor: 'rgba(25, 135, 84, 0.7)',   // Bootstrap success
          borderColor: 'rgba(25, 135, 84, 1)',
          borderWidth: 1,
          borderRadius: 6,
          barPercentage: 0.6,
          categoryPercentage: 0.7
        },
        {
          label: 'Inválido',
          data: invData,
          backgroundColor: 'rgba(220, 53, 69, 0.7)',   // Bootstrap danger
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
        padding: { top: 20, bottom: 10, left: 15, right: 15 }
      },
      plugins: {
        legend: {
          labels: {
            color: '#ffffff',
            font: { size: 14, weight: 'bold' }
          }
        },
        tooltip: {
          backgroundColor: '#333333',
          titleColor: '#ffffff',
          bodyColor: '#eeeeee',
          borderColor: '#555555',
          borderWidth: 1,
          callbacks: {
            // Muestra Total = válido + inválido en el tooltip
            afterBody: function (items) {
              if (!items || !items.length) return;
              const i = items[0].dataIndex;
              const total = (valData[i] || 0) + (invData[i] || 0);
              return 'Total: ' + total;
            }
          }
        }
      },
      scales: {
        x: {
          stacked: true,
          ticks: { color: '#ffffff', font: { size: 12 } },
          grid: { color: '#444444' }
        },
        y: {
          stacked: true,
          beginAtZero: true,
          ticks: { color: '#ffffff', stepSize: 1, font: { size: 12 } },
          grid: { color: '#444444' }
        }
      }
    }
  });
});
