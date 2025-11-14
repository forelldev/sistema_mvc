document.addEventListener('DOMContentLoaded', () => {
  fetch(BASE_URL+'/obtenerNotificacionesAjax')
    .then(response => response.json())
    .then(data => {
      if (data.exito && data.datos) {
        renderNotificaciones(data.datos);
      } else {
        document.getElementById('barra-notificaciones').innerHTML = '<p class="text-muted">No hay notificaciones nuevas.</p>';
      }
    })
    .catch(error => {
      console.error('Error al cargar notificaciones:', error);
    });
});

function renderNotificaciones(datos) {
  const ul = document.createElement('ul');
  ul.className = 'list-unstyled mb-2';
  const novedades = document.getElementById("novedades");
  let total = 0;

  for (const tipo in datos) {
    const grupo = datos[tipo];
    if (Array.isArray(grupo.datos)) {
      total += grupo.datos.length;

      grupo.datos.forEach(noti => {
        const li = document.createElement('li');
        li.className = 'mb-3 small';
        li.innerHTML = `<a href="${BASE_URL}/noti?id_doc=${encodeURIComponent(noti.id_doc)}&tabla=${encodeURIComponent(grupo.tabla)}&id_name=${encodeURIComponent(grupo.id_name)}" class="text-decoration-none text-white">
          <strong>${tipo.charAt(0).toUpperCase() + tipo.slice(1)}:</strong><br>
            ${noti.descripcion}<br>
            ${noti.estado ?? 'Sin mensaje'}
            <div class="text-muted small">${formatFecha(noti.fecha)}</div>
          </a>
        `;
        ul.appendChild(li);
      });
    }
  }

  if (total > 0) {
    const marcar = document.createElement('li');
    novedades.style.display = 'block'
    marcar.innerHTML = `<a href="${BASE_URL}/marcar_vistas" class="text-primary small">Marcar todas como vistas</a>`;
    ul.appendChild(marcar);
  }

  document.getElementById('barra-notificaciones').classList.remove('d-none');
  document.getElementById('barra-notificaciones').appendChild(ul);

  const badge = document.createElement('span');
  badge.className = 'position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger';
  badge.textContent = total;
  document.getElementById('btn-notificaciones').appendChild(badge);
}

function formatFecha(fechaStr) {
  const fecha = new Date(fechaStr);
  return fecha.toLocaleString('es-VE', {
    day: '2-digit', month: '2-digit', year: 'numeric',
    hour: '2-digit', minute: '2-digit'
  });
}
