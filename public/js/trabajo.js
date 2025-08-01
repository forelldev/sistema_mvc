   //PARA TRABAJO CUADROS DE TRABAJOS

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
            document.getElementById(id).setAttribute('required', 'required');
        });
    } else {
        campo.style.display = 'none';
        campos.forEach(id => {
            const input = document.getElementById(id);
            input.removeAttribute('required');
            input.value = '';
        });

        // Ocultar también el campo de institución
        campoInstitucion.style.display = 'none';
        const institucionInput = document.getElementById('nombre_insti');
        institucionInput.removeAttribute('required');
        institucionInput.value = '';
    }
}

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