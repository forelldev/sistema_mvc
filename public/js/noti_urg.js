document.addEventListener('DOMContentLoaded', function () {
  const notiBtn = document.getElementById('btn-notificaciones');
  const notiPanel = document.getElementById('barra-notificaciones');

  if (notiBtn && notiPanel) {
    notiBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      const isHidden = notiPanel.classList.contains('d-none');
      notiPanel.classList.toggle('d-none', !isHidden);
    });
  }

  document.addEventListener('click', function (e) {
    if (notiPanel && !notiPanel.contains(e.target) && !notiBtn.contains(e.target)) {
      notiPanel.classList.add('d-none');
    }
  });
});