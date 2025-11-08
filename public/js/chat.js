async function enviarMensaje(event) {
  document.querySelector("#chat-input").placeholder = '';
  event.preventDefault();
  const input = document.querySelector('input.form-control');
  const mensaje = input.value.trim();
  if (!mensaje) return;

  document.getElementById('chat-messages').innerHTML += `
    <div class="text-end mb-2"><strong>Tú:</strong> ${mensaje}</div>
  `;
  input.value = '';

  try {
    const res = await fetch(`${BASE_URL}/api_chat`, {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({mensaje})
    });

    if (!res.ok) throw new Error(`HTTP ${res.status}`);

    const data = await res.json();

    document.getElementById('chat-messages').innerHTML += `
      <div class="text-start mb-2"><strong>IA:</strong> ${data.respuesta}</div>
    `;

  } catch (error) {
    console.error('Error al enviar mensaje:', error);
    document.getElementById('chat-messages').innerHTML += `
      <div class="text-start mb-2 text-danger"><strong>Error:</strong> No se pudo obtener respuesta.</div>
    `;
  }
}
