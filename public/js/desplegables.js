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

