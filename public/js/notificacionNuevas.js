document.addEventListener('DOMContentLoaded', () => {
  const btn = document.getElementById('btn-notificaciones');
  const barra = document.getElementById('barra-notificaciones');
  const lista = document.getElementById('lista-notificaciones');

  let notificacionesCargadas = []; // Aquí se guardan las notificaciones precargadas

  // 🔄 Precargar notificaciones al iniciar
  fetch('controlador/notificacionesControlador.php')
    .then(response => response.json())
    .then(data => {
      notificacionesCargadas = data;
    })
    .catch(error => {
      console.error('Error al precargar notificaciones:', error);
      notificacionesCargadas = null; // Para mostrar error luego
    });

  // 🛎 Mostrar notificaciones al hacer clic
  btn.addEventListener('click', () => {
    barra.classList.toggle('visible');
    barra.classList.toggle('oculto');

    if (barra.classList.contains('visible')) {
      lista.innerHTML = ''; // Limpiar lista previa

      if (notificacionesCargadas === null) {
        const errorItem = document.createElement('li');
        errorItem.classList.add('notificacion-item');
        errorItem.innerHTML = '<em>Error al cargar notificaciones.</em>';
        lista.appendChild(errorItem);
        return;
      }

      if (notificacionesCargadas.length === 0) {
        const vacio = document.createElement('li');
        vacio.classList.add('notificacion-item');
        vacio.innerHTML = '<em>No hay nuevas solicitudes.</em>';
        lista.appendChild(vacio);
        return;
      }

      notificacionesCargadas.forEach(solicitud => {
        const item = document.createElement('li');
        item.classList.add('notificacion-item');
        item.innerHTML = `
          <strong>${solicitud.fecha}</strong><br>
          <span>${solicitud.descripcion}</span>
        `;
        lista.appendChild(item);
      });
    }
  });
});
