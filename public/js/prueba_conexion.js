async function verificarConexion() {
  const iaContainer = document.getElementById('ia-container');

  try {
    const res = await fetch('https://www.gstatic.com/generate_204', { method: 'GET', mode: 'no-cors' });
    // Si llega aquí, hay conexión
    iaContainer.style.display = 'block';
  } catch (error) {
    // Si falla el fetch, no hay conexión
    iaContainer.style.display = 'none';
  }
}
// Ejecutar al cargar
window.addEventListener('load', verificarConexion);
// Reintentar cuando cambie el estado de red
window.addEventListener('online', verificarConexion);
window.addEventListener('offline', verificarConexion);