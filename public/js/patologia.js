// Lista de tipos de patología
const tipos = ["Hereditarias", "Congénitas", "Atención primaria", "Discapacidad", "Visual", "Auditiva", "Motora", "Intelectual", "Otras"];

// 🧠 Memoria temporal para conservar datos ingresados
let datosTemporales = [];

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
        datosTemporales = []; // 🧹 Limpiar memoria si se desactiva
    } else if (numeroFamiliares.value !== '') {
        generarCamposFamiliares(precargar);
    }
}

function generarCamposFamiliares(precargar = false) {
    const numeroFamiliares = document.getElementById('numeroFamiliares');
    const container = document.getElementById('camposFamiliares');
    const cantidad = precargar ? tiposPatologiaGuardados.length : parseInt(numeroFamiliares.value);
    if (isNaN(cantidad) || cantidad <= 0) return;

    // 🧠 Guardar valores actuales antes de borrar
    const nuevosTemporales = [];
    for (let i = 0; i < container.children.length; i++) {
        const tipo = document.getElementById(`tipoPatologia${i}`)?.value || '';
        const nombre = document.getElementById(`nombrePatologia${i}`)?.value || '';
        nuevosTemporales.push({ tipo, nombre });
    }

    // 🧠 Actualizar memoria global
    for (let i = 0; i < nuevosTemporales.length; i++) {
        datosTemporales[i] = nuevosTemporales[i];
    }

    container.innerHTML = '';

    for (let i = 0; i < cantidad; i++) {
        const tipoPatologia = precargar
            ? tiposPatologiaGuardados[i] || ''
            : datosTemporales[i]?.tipo || '';
        const nombrePatologia = precargar
            ? nombresPatologiaGuardados[i] || ''
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
                <input type="text" id="nombrePatologia${i}" name="nom_patologia[${i}]" placeholder="Ej. Hipertensión" value="${nombrePatologia}" required>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', campoHTML);
    }
}

function validarEstadoInicialPatologia() {
    const tienePatologia = document.getElementById('tienePatologia').value;
    const numeroContainer = document.getElementById('numeroFamiliaresContainer');
    const numeroFamiliares = document.getElementById('numeroFamiliares');
    const camposContainer = document.getElementById('camposFamiliares');

    const mostrar = tienePatologia === 'si';
    toggleElemento(numeroContainer, mostrar);
    setRequerido(numeroFamiliares, mostrar);

    if (!mostrar) {
        numeroFamiliares.value = '';
        camposContainer.innerHTML = '';
        datosTemporales = [];
    }
}
document.addEventListener('DOMContentLoaded', () => {
    validarEstadoInicialPatologia();
    if (data_exists === "1" &&
        Array.isArray(tiposPatologiaGuardados) &&
        tiposPatologiaGuardados.length > 0 &&
        tiposPatologiaGuardados[0] !== "") {

        const tienePatologiaSelect = document.getElementById('tienePatologia');
        const numeroFamiliaresSelect = document.getElementById('numeroFamiliares');
        const numeroContainer = document.getElementById('numeroFamiliaresContainer');

        tienePatologiaSelect.value = 'si';
        numeroFamiliaresSelect.value = tiposPatologiaGuardados.length;
        numeroFamiliaresSelect.disabled = false;

        toggleElemento(numeroContainer, true);
        setRequerido(numeroFamiliaresSelect, true);

        // 🧠 Inicializar memoria con datos precargados
        datosTemporales = tiposPatologiaGuardados.map((tipo, i) => ({
            tipo,
            nombre: nombresPatologiaGuardados[i] || ''
        }));

        generarCamposFamiliares(true);
    }
});

