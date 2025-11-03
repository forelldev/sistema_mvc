// Lista de tipos de patología
const tipos = ["Hereditarias", "Congénitas", "Atención primaria", "Discapacidad", "Visual", "Auditiva", "Motora", "Intelectual", "Otras"];
// 🧠 Memoria temporal para conservar datos ingresados
let datosTemporales = [];

// 🔐 Escapar HTML para evitar errores
function escapeHTML(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function toggleElemento(elemento, mostrar) {
    elemento.style.display = mostrar ? 'block' : 'none';
}

function setRequerido(elemento, requerido) {
    if (requerido) {
        elemento.setAttribute('required', 'required');
    } else {
        elemento.removeAttribute('required');
    }
}

function mostrarNumeroFamiliares(precargar = false) {
    const select = document.getElementById('tienePatologia');
    const numeroContainer = document.getElementById('numeroFamiliaresContainer');
    const numeroFamiliares = document.getElementById('numeroFamiliares');
    const camposContainer = document.getElementById('camposFamiliares');

    const tienePatologia = select.value === 'si';
    toggleElemento(numeroContainer, tienePatologia);
    setRequerido(numeroFamiliares, tienePatologia);
    numeroFamiliares.disabled = false;

    if (!tienePatologia) {
        numeroFamiliares.value = '';
        camposContainer.innerHTML = '';
        datosTemporales = [];
    } else {
        const cantidad = precargar
            ? tiposPatologiaGuardados.length
            : parseInt(numeroFamiliares.value);

        if (!isNaN(cantidad) && cantidad > 0) {
            generarCamposFamiliares(cantidad, precargar);
        }
    }
}

function generarCamposFamiliares(cantidad, precargar = false) {
    const container = document.getElementById('camposFamiliares');
    container.innerHTML = '';

    for (let i = 0; i < cantidad; i++) {
        const tipoPatologia = precargar && tiposPatologiaGuardados[i]
            ? tiposPatologiaGuardados[i].trim()
            : datosTemporales[i]?.tipo || '';

        const nombrePatologia = precargar && nombresPatologiaGuardados[i]
            ? nombresPatologiaGuardados[i].trim()
            : datosTemporales[i]?.nombre || '';


        const opciones = tipos.map(tipo =>
            `<option value="${tipo}" ${tipo === tipoPatologia ? 'selected' : ''}>${tipo}</option>`
        ).join('');

        const campoHTML = `
            <div class="campo-formulario" style="margin-top:10px;">
                <label for="tipoPatologia${i}">Familiar ${i + 1} - Tipo de patología:</label>
                <select id="tipoPatologia${i}" name="tip_patologia[${i}]" required>
                    <option value="">Seleccione</option>
                    ${opciones}
                </select>
                <label for="nombrePatologia${i}">Nombre de la patología:</label>
                <input type="text" id="nombrePatologia${i}" name="nom_patologia[${i}]" placeholder="Ej. Hipertensión" value="${escapeHTML(nombrePatologia)}" required>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', campoHTML);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const tienePatologiaSelect = document.getElementById('tienePatologia');
    const numeroFamiliaresSelect = document.getElementById('numeroFamiliares');

    if (
        data_exists === "1" &&
        Array.isArray(tiposPatologiaGuardados) &&
        tiposPatologiaGuardados.length > 0 &&
        tiposPatologiaGuardados[0] !== ""
    ) {
        tienePatologiaSelect.value = 'si';
        numeroFamiliaresSelect.value = tiposPatologiaGuardados.length;
        numeroFamiliaresSelect.disabled = false;

        datosTemporales = tiposPatologiaGuardados.map((tipo, i) => ({
            tipo: tipo.trim(),
            nombre: nombresPatologiaGuardados[i]?.trim() || ''
        }));


        mostrarNumeroFamiliares(true);
    } else {
        mostrarNumeroFamiliares(false);
    }

    tienePatologiaSelect.addEventListener('change', () => mostrarNumeroFamiliares(false));
    numeroFamiliaresSelect.addEventListener('change', () => mostrarNumeroFamiliares(false));
});

