document.addEventListener("DOMContentLoaded", function () {
  const categoriaSelect = document.getElementById("categoria");
  const tipoAyudaSelect = document.getElementById("tipo_ayuda");
  const tipoAyudaContainer = document.getElementById("tipoAyudaContainer");
  const campoExtra = document.getElementById("campoExtra");


  function toggleCampos() {
    const categoria = categoriaSelect.value;

    // Reset
    tipoAyudaContainer.style.display = "none";
    tipoAyudaSelect.removeAttribute("required");
    tipoAyudaSelect.value = "";
    campoExtra.style.display = "none";
    campoExtra.innerHTML = "";

    if (categoria === "Ayudas Técnicas") {
      // Mostrar select estandarizado
      tipoAyudaContainer.style.display = "block";
      tipoAyudaSelect.setAttribute("required", "required");

      // Precargar en el select si coincide
      if (precarga) {
        [...tipoAyudaSelect.options].forEach(opt => {
          if (opt.value === precarga) opt.selected = true;
        });
      }

    } else if (categoria === "Medicamentos" || categoria === "Enseres" || categoria === "Económica") {
      let label = "";
      let placeholder = "";
      let value = "";

      switch (categoria) {
        case "Medicamentos":
          label = "Especifique el medicamento:";
          placeholder = "Nombre del medicamento";
          // Solo usar precarga si la categoría guardada era Medicamentos
          value = (categoria === precargaDatos) ? precarga : "";
          break;
        case "Enseres":
          label = "Especifique el enser:";
          placeholder = "Nombre del enser";
          value = (categoria === precargaDatos) ? precarga : "";
          break;
        case "Económica":
          label = "Especifique el apoyo económico:";
          placeholder = "Detalle del apoyo económico";
          value = (categoria === precargaDatos) ? precarga : "";
          break;
      }

      campoExtra.innerHTML = `
        <label for="detalle_categoria" class="form-label">${label}</label>
        <input type="text" id="detalle_categoria" name="tipo_ayuda"
               class="form-control" placeholder="${placeholder}" required value="${value}">
      `;
      campoExtra.style.display = "block";
    }
  }

  // Ejecutar al cargar
  toggleCampos();

  // Ejecutar al cambiar
  categoriaSelect.addEventListener("change", toggleCampos);
});
