document.addEventListener('DOMContentLoaded', function () {
  const panel = document.getElementById('barra-notificaciones');
  const lista = document.getElementById('lista-notificaciones');
  const badge = document.getElementById('badge-noti');
  const btn = document.getElementById('btn-notificaciones');

  const caso = 'generales'; // puedes cambiar esto dinámicamente si lo necesitas

  function cargarNotificaciones() {
    fetch(BASE_URL + '/ajax_urgencia?caso=' + caso)
      .then(res => res.json())
      .then(data => {
        lista.innerHTML = '';
        console.log('Respuesta AJAX:', data); // 👈 útil para depurar

        if (data.exito && Array.isArray(data.datos) && data.datos.length > 0) {
          badge.textContent = data.datos.length;
          badge.classList.remove('d-none');

          data.datos.forEach(noti => {
            const li = document.createElement('li');
            li.className = 'mb-3 small';

            let url = '';
            switch (caso) {
              case 'generales':
                url = BASE_URL + '/solicitud_urgencia?id_doc=' + noti.id_doc;
                break;
              case 'desarrollo':
                url = BASE_URL + '/mostrar_noti_urgencia?id_des=' + noti.id_desarrollo;
                break;
              case 'despacho':
                url = BASE_URL + '/noti_urgente_despacho?id_despacho=' + noti.id_despacho;
                break;
            }

            li.innerHTML = `
              <strong class="text-danger">Solicitud General:</strong><br>
              <a href="${url}" class="text-decoration-none text-dark">
                ${noti.descripcion ?? 'Sin mensaje'}<br>
                <span class="text-muted">${noti.estado ?? 'Sin estado'}</span>
                <div class="text-muted small">${new Date(noti.fecha).toLocaleString('es-VE', {
                  day: '2-digit',
                  month: '2-digit',
                  year: 'numeric',
                  hour: '2-digit',
                  minute: '2-digit',
                  hour12: false
                })}</div>
              </a>
            `;
            lista.appendChild(li);
          });
          if (data.msj_correo) {
                setTimeout(() => {
                  mostrarMensaje(data.msj_correo, "warning", 6000);
                }, 500);
              }
        } else {
          badge.classList.add('d-none');
          lista.innerHTML = '<li class="text-muted small">No hay notificaciones disponibles.</li>';
        }
      })
      .catch(err => {
        console.error('Error al cargar notificaciones:', err);
        lista.innerHTML = '<li class="text-muted small">Error al cargar notificaciones.</li>';
        panel.classList.remove('d-none');
      });
  }

  // Cargar al iniciar
  cargarNotificaciones();

});
