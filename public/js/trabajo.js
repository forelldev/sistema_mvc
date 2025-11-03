
// Mostrar u ocultar campos relacionados al trabajo
function mostrarCampoTrabajo() {
    const trabaja = document.getElementById('trabajo1').value;
    const campo = document.getElementById('campoTrabajo');
    const campoInstitucion = document.getElementById('campoInstitucion');

    const campos = [
        'trabajo',
        'direccion_trabajo',
        'trabaja_public'
    ];

    if (trabaja === 'Si') {
        campo.style.display = 'block';
        campos.forEach(id => {
            const input = document.getElementById(id);
            if (input) input.setAttribute('required', 'required');
        });
    } else {
        campo.style.display = 'none';
        campos.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.removeAttribute('required');
                input.value = '';
            }
        });

        // Ocultar también el campo de institución
        campoInstitucion.style.display = 'none';
        const institucionInput = document.getElementById('nombre_insti');
        if (institucionInput) {
            institucionInput.removeAttribute('required');
            institucionInput.value = '';
        }
    }
}

// Mostrar u ocultar campo de institución si trabaja en sector público
function mostrarInstitucion() {
    const trabajaPublico = document.getElementById('trabaja_public').value;
    const campoInstitucion = document.getElementById('campoInstitucion');
    const institucionInput = document.getElementById('nombre_insti');

    if (trabajaPublico === 'Si') {
        campoInstitucion.style.display = 'block';
        institucionInput.setAttribute('required', 'required');
    } else {
        campoInstitucion.style.display = 'none';
        institucionInput.removeAttribute('required');
        institucionInput.value = '';
    }
}

// Inicializar comportamiento al cargar la página
window.addEventListener('DOMContentLoaded', () => {
    const trabajoSelect = document.getElementById('trabajo1');
    const trabajaPublico = document.getElementById('trabaja_public');

    // Activar campos si ya hay una selección previa
    if (trabajoSelect) {
        mostrarCampoTrabajo();
    }

    if (trabajaPublico && trabajaPublico.value === 'Si') {
        mostrarInstitucion();
    }

    // Listeners para cambios manuales
    trabajoSelect?.addEventListener('change', mostrarCampoTrabajo);
    trabajaPublico?.addEventListener('change', mostrarInstitucion);
});

