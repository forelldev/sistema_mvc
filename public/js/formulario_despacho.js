document.addEventListener("DOMContentLoaded", function () {
  const categoriaSelect = document.getElementById("categoria");
  const tipoAyudaSelect = document.getElementById("tipo_ayuda");
  const tipoAyudaContainer = document.getElementById("tipoAyudaContainer");
  const tipoAyudaPrecargado = document.getElementById("tipo_ayuda_precargado")?.value || "";

  const opcionesPorCategoria = {
    "Salud": ["Medicamentos", "Ayudas Técnicas", "Operaciones", "Exámenes", "Estudios", "Consultas"],
    "Ayuda Económica": ["Económica"],
    "Materiales de Construcción": ["Sacos de cemento", "Bloques", "Tuberías", "Tubos", "Cables"],
    "Varios": ["Tanques de Agua"]
  };

  const renderTipoAyuda = (categoria) => {
    const opciones = opcionesPorCategoria[categoria] || [];

    tipoAyudaSelect.innerHTML = "";
    const defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.textContent = "Seleccione";
    tipoAyudaSelect.appendChild(defaultOption);

    opciones.forEach(opcion => {
      const optionElement = document.createElement("option");
      optionElement.value = opcion;
      optionElement.textContent = opcion;
      if (opcion === tipoAyudaPrecargado) {
        optionElement.selected = true;
      }
      tipoAyudaSelect.appendChild(optionElement);
    });
  };

  categoriaSelect.addEventListener("change", function () {
    const categoria = categoriaSelect.value;

    if (categoria === "") {
      tipoAyudaContainer.style.display = "none";
      tipoAyudaSelect.innerHTML = "";
      return;
    }

    tipoAyudaContainer.style.display = "block";
    renderTipoAyuda(categoria);
  });

  tipoAyudaSelect.addEventListener("change", function () {
    if (tipoAyudaSelect.value === "Tuberías") {
      alert("Especificar en descripción si son tuberías blancas o negras");
    }
  });

  // ✅ Precarga al cargar el DOM
  if (categoriaSelect.value && opcionesPorCategoria[categoriaSelect.value]) {
    tipoAyudaContainer.style.display = "block";
    renderTipoAyuda(categoriaSelect.value);
  } else {
    tipoAyudaContainer.style.display = "none";
    tipoAyudaSelect.innerHTML = "";
  }
});
