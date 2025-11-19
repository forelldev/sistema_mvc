const tipoAyudaSelect = document.getElementById('tipo_ayuda');
const subcategoriaContainer = document.getElementById('subcategoria_container');
const medicamentosContainer = document.getElementById('medicamentos_container');
const subcategoriaSelect = document.getElementById('subcategoria');
const campoExamen = document.getElementById('campo_examen');
const medicamentoInput = document.getElementById('medicamento');
const campoMedicamento = document.getElementById('campo_medicamento');

// Render de subcategoría (exámenes)
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


// Render de medicamentos
const renderMedicamento = (valor) => {
  campoMedicamento.innerHTML = '';
  campoMedicamento.style.display = 'none';

  if (valor) {
    campoMedicamento.innerHTML = `
      <div class="mb-3">
        <label class="form-label">Medicamento especificado:</label>
        <div class="alert alert-info py-2 px-3 rounded-3 mb-0">
          ${valor}
          <input type="hidden" name="examen[]" value="${valor}">
        </div>
      </div>
    `;
    campoMedicamento.style.display = 'block';
  }
};

// Eventos
tipoAyudaSelect.addEventListener('change', (e) => {
  const valor = e.target.value;

  // Ocultar todo por defecto
  subcategoriaContainer.style.display = 'none';
  campoExamen.innerHTML = '';
  campoExamen.style.display = 'none';
  medicamentosContainer.style.display = 'none';
  campoMedicamento.innerHTML = '';
  campoMedicamento.style.display = 'none';

  if (valor === 'Laboratorio') {
    subcategoriaContainer.style.display = 'block';
  } else if (valor === 'Medicamentos') {
    medicamentosContainer.style.display = 'block';
  }
});

subcategoriaSelect.addEventListener('change', (e) => {
  renderSubcategoria(e.target.value);
});

medicamentoInput.addEventListener('input', (e) => {
  renderMedicamento(e.target.value.trim());
});

// Estado inicial al cargar
window.addEventListener('DOMContentLoaded', () => {
  if (tipoAyudaSelect.value === 'Laboratorio') {
    subcategoriaContainer.style.display = 'block';
    if (subcategoriaSelect.value) {
      renderSubcategoria(subcategoriaSelect.value);
    }
  } else if (tipoAyudaSelect.value === 'Medicamentos') {
    medicamentosContainer.style.display = 'block';
    if (medicamentoInput.value.trim()) {
      renderMedicamento(medicamentoInput.value.trim());
    }
  }
});