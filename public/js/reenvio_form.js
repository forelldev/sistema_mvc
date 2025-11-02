document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('form_solicitud');
  const submitBtn = form.querySelector('button[type="submit"]');
  let envioConfirmado = false;

  form.addEventListener('submit', (e) => {
    if (envioConfirmado) {
      e.preventDefault(); // bloquea reenvíos
      return;
    }

    // Si el formulario no es válido, permite que el navegador lo maneje
    if (!form.checkValidity()) {
      return;
    }

    // Marca como enviado y bloquea el botón
    envioConfirmado = true;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i> Enviando...';
  });
});

