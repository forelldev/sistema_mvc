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

document.querySelectorAll('.accordion-toggle').forEach(button => {
  button.addEventListener('click', () => {
    const item = button.parentElement;
    const content = item.querySelector('.accordion-content');
    const isOpen = item.classList.contains('active');

    document.querySelectorAll('.accordion-item').forEach(i => {
      i.classList.remove('active');
      i.querySelector('.accordion-content').style.height = '0';
    });

    if (!isOpen) {
      item.classList.add('active');
      content.style.height = content.scrollHeight + 'px';
    }
  });
});