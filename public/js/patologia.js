      //CAMPOS DE PATOLOGIA
    // Lógica de JavaScript para los campos de patología
    const tiposPatologiaGuardados = "<?= htmlspecialchars($datos_beneficiario['tip_patologias'] ?? '') ?>".split('|');
    const nombresPatologiaGuardados = "<?= htmlspecialchars($datos_beneficiario['nom_patologias'] ?? '') ?>".split('|');
    
    // Función para mostrar el campo de número de familiares
    function mostrarNumeroFamiliares() {
        const select = document.getElementById('tienePatologia');
        const numeroContainer = document.getElementById('numeroFamiliaresContainer');
        const camposContainer = document.getElementById('camposFamiliares');

        if (select.value === 'si') {
            numeroContainer.style.display = 'block';
        } else {
            numeroContainer.style.display = 'none';
            camposContainer.innerHTML = ''; // Limpiar campos si elige "No"
        }
    }

    // Función que genera y precarga los campos de patologías
    function generarCamposFamiliares(precargar = false) {
        const cantidad = precargar ? tiposPatologiaGuardados.length : parseInt(document.getElementById('numeroFamiliares').value);
        const container = document.getElementById('camposFamiliares');
        container.innerHTML = '';

        const tipos = ["Hereditarias", "Congénitas", "Atención primaria", "Discapacidad", "Visual", "Auditiva", "Motora", "Intelectual", "Otras"];

        for (let i = 0; i < cantidad; i++) {
            const div = document.createElement('div');
            div.style.marginBottom = '15px';
            
            // Valor a precargar si existe
            const tipoPatologia = precargar ? tiposPatologiaGuardados[i] : '';
            const nombrePatologia = precargar ? nombresPatologiaGuardados[i] : '';

            let selectHTML = `<label for="tipoPatologia${i}">Familiar ${i + 1} - Tipo de patología:</label>
                              <select id="tipoPatologia${i}" name="tip_patologia[${i}]" required>
                                <option value="">Seleccione</option>`;
            tipos.forEach(tipo => {
                const selected = tipo === tipoPatologia ? 'selected' : '';
                selectHTML += `<option value="${tipo}" ${selected}>${tipo}</option>`;
            });
            selectHTML += `</select><br>`;

            selectHTML += `<label for="nombrePatologia${i}">Nombre de la patología:</label>
                           <input type="text" id="nombrePatologia${i}" name="nom_patologia[${i}]" placeholder="Ej. Hipertensión" value="${nombrePatologia}" required>`;

            div.innerHTML = selectHTML;
            container.appendChild(div);
        }
    }

    // Ejecutar la precarga al cargar la página si hay datos
    document.addEventListener('DOMContentLoaded', () => {
        if ("<?= $data_exists ?>" === "1" && tiposPatologiaGuardados[0] !== "") {
            const tienePatologiaSelect = document.getElementById('tienePatologia');
            tienePatologiaSelect.value = 'si';
            mostrarNumeroFamiliares();
            
            const numeroFamiliaresSelect = document.getElementById('numeroFamiliares');
            numeroFamiliaresSelect.value = tiposPatologiaGuardados.length;
            generarCamposFamiliares(true); // Pasar 'true' para precargar
        }
    });
