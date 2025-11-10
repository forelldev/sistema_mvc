const tipoAyudaSelect = document.getElementById('tipo_ayuda');
const subcategoriaContainer = document.getElementById('subcategoria_container');
const subcategoriaSelect = document.getElementById('subcategoria');
const campoExamen = document.getElementById('campo_examen');

const renderSubcategoria = (valor) => {
  campoExamen.innerHTML = '';
  campoExamen.style.display = 'none';

  if (valor === 'Ecosonograma' || valor === 'Eco-Doppler') {
  campoExamen.innerHTML = `
    <div class="mb-3">
      <label class="form-label">Examen seleccionado:</label>
      <div class="alert alert-info py-2 px-3 rounded-3 mb-0">
        ${valor}
        <input type="hidden" name="examen[]" value="${valor}">
      </div>
    </div>
  `;
  campoExamen.style.display = 'block';
} else if (valor === 'Exámenes de Laboratorio') {
  const opciones = ['Hematología Completa', 'Glicemia', 'Orina', 'Heces'];

  let html = `
    <div class="mb-3">
      <label class="form-label">Seleccione uno o más exámenes:</label>
  `;

  opciones.forEach(opcion => {
    const checked = examenSeleccionado.includes(opcion) ? 'checked' : '';
    html += `
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="examen[]" value="${opcion}" id="examen_${opcion}" ${checked}>
        <label class="form-check-label" for="examen_${opcion}">${opcion}</label>
      </div>
    `;
  });

  html += `</div>`;
  campoExamen.innerHTML = html;
  campoExamen.style.display = 'block';
}

};


tipoAyudaSelect.addEventListener('change', (e) => {
  const valor = e.target.value;

  // Ocultar todo por defecto
  subcategoriaContainer.style.display = 'none';
  campoExamen.innerHTML = '';
  campoExamen.style.display = 'none';

  if (valor === 'Laboratorio') {
    subcategoriaContainer.style.display = 'block';
  }
});

subcategoriaSelect.addEventListener('change', (e) => {
  renderSubcategoria(e.target.value);
});

window.addEventListener('DOMContentLoaded', () => {
  if (tipoAyudaSelect.value === 'Laboratorio') {
    subcategoriaContainer.style.display = 'block';
    if (subcategoriaSelect.value) {
      renderSubcategoria(subcategoriaSelect.value);
    }
  }
});

