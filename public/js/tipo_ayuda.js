document.addEventListener('DOMContentLoaded', function () {
  const categoriaSelect = document.getElementById('categoria');
  const tipoAyudaSelect = document.getElementById('tipo_ayuda');
  const tipoAyudaDiv = tipoAyudaSelect.closest('.campo-formulario');
  const campoExtra = document.getElementById('campo-extra');

  function toggleCampos() {
    const categoria = categoriaSelect.value;

    // Reset
    tipoAyudaDiv.style.display = 'none';
    tipoAyudaSelect.removeAttribute('required');
    tipoAyudaSelect.value = '';
    campoExtra.style.display = 'none';
    campoExtra.innerHTML = '';

    if (categoria === 'Ayudas Técnicas') {
      // Mostrar select de tipo de ayuda
      tipoAyudaDiv.style.display = 'block';
      tipoAyudaSelect.setAttribute('required', 'required');

      // Precargar en el select si coincide
      if (precargaDatos === 'Ayudas Técnicas' && precarga) {
        [...tipoAyudaSelect.options].forEach(opt => {
          if (opt.value === precarga) opt.selected = true;
        });
      }

    } else if (categoria) {
      // Mostrar input dinámico según categoría
      let label = '';
      let placeholder = '';
      let value = '';

      switch (categoria) {
        case 'Medicamentos':
          label = 'Especifique el medicamento:';
          placeholder = 'Nombre del medicamento';
          value = (precargaDatos === 'Medicamentos') ? precarga : "";
          break;
        case 'Laboratorio':
          label = 'Especifique el examen:';
          placeholder = 'Nombre del examen';
          value = (precargaDatos === 'Laboratorio') ? precarga : "";
          break;
        case 'Enseres':
          label = 'Especifique el enser:';
          placeholder = 'Nombre del enser';
          value = (precargaDatos === 'Enseres') ? precarga : "";
          break;
        case 'Económica':
          label = 'Especifique apróximadamente el monto:';
          placeholder = 'Detalle del apoyo';
          value = (precargaDatos === 'Económica') ? precarga : "";
          break;
      }

      campoExtra.innerHTML = `
        <label for="detalle_categoria" class="form-label">${label}</label>
        <input type="text" id="detalle_categoria" name="tipo_ayuda" 
               class="form-control" placeholder="${placeholder}" required value="${value}">
      `;
      campoExtra.style.display = 'block';
    }
  }

  // Ejecutar al cargar
  toggleCampos();

  // Ejecutar al cambiar
  categoriaSelect.addEventListener('change', toggleCampos);
});
