const tipoAyudaSelect = document.getElementById('tipo_ayuda');
const subcategoriaContainer = document.getElementById('subcategoria_container');
const subcategoriaSelect = document.getElementById('subcategoria');
const campoExamen = document.getElementById('campo_examen');

const renderSubcategoria = (valor) => {
  campoExamen.innerHTML = '';
  campoExamen.style.display = 'none';

  if (valor === 'Ecosonograma' || valor === 'Eco-Doppler') {
    campoExamen.innerHTML = `<input type="hidden" name="examen[]" value="${valor}">`;
    campoExamen.style.display = 'block';
  } else if (valor === 'Exámenes de Laboratorio') {
    campoExamen.innerHTML = `
      <label>Seleccione uno o más exámenes:</label><br>
      <label><input type="checkbox" name="examen[]" value="Hematología Completa"> Hematología Completa</label><br>
      <label><input type="checkbox" name="examen[]" value="Glicemia"> Glicemia</label><br>
      <label><input type="checkbox" name="examen[]" value="Orina"> Orina</label><br>
      <label><input type="checkbox" name="examen[]" value="Heces"> Heces</label><br>
    `;
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

