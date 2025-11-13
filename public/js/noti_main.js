document.addEventListener('DOMContentLoaded', function () {
  const notiBtn = document.getElementById('btn-notificaciones');
  const notiPanel = document.getElementById('barra-notificaciones');
if (notiBtn && notiPanel) {
  notiBtn.addEventListener('click', function (e) {
    e.stopPropagation();
    notiPanel.classList.toggle('show');
  });

  document.addEventListener('click', function (e) {
    if (!notiPanel.contains(e.target) && !notiBtn.contains(e.target)) {
      notiPanel.classList.remove('show');
    }
  });

  // Opcional: cerrar con Escape
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      notiPanel.classList.remove('show');
    }
  });
}})