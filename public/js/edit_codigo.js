let codigoEsperado = null;
let intentosRestantes = 3;

document.getElementById('form-avanzado').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;

    submitBtn.disabled = true;
    submitBtn.textContent = "Espera...";

    try {
        const res = await fetch(`${BASE_URL}/avanzada_codigo`, { method: "POST" });
        const data = await res.json();

        if (data.success && data.codigo) {
            codigoEsperado = data.codigo;

            const container = document.getElementById('form-verificacion-container');
            if (!document.getElementById('form-verificacion')) {
                container.innerHTML = `
                    <form id="form-verificacion" class="card p-4 shadow-sm mt-4" autocomplete="off">
                        <div class="mb-3">
                            <label for="codigo" class="form-label">Se ha enviado un código a tu correo electrónico. Ingresa ese código:</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Verificar código</button>
                        <div id="intento-msg" class="form-text text-danger mt-2"></div>
                    </form>
                `;

                document.getElementById('form-verificacion').addEventListener('submit', async function (ev) {
                    ev.preventDefault();

                    const input = document.getElementById('codigo').value.trim();
                    const msg = document.getElementById('intento-msg');

                    if (input === codigoEsperado.toString()) {
                        const finalData = new FormData(document.getElementById('form-avanzado'));

                        try {
                            const finalRes = await fetch(`${BASE_URL}/verificar_avanzada`, {
                                method: "POST",
                                body: finalData
                            });

                            const rawText = await finalRes.text();
                            const finalJson = JSON.parse(rawText);

                            if (finalJson.success) {
                                window.location.href = `${BASE_URL}/main?msj=Datos avanzados actualizados con éxito!`;
                            } else {
                                alert("❌ " + finalJson.msj);
                            }
                        } catch {
                            alert("Error al enviar los datos finales.");
                        }
                    } else {
                        intentosRestantes--;
                        if (intentosRestantes > 0) {
                            msg.textContent = `❌ Código incorrecto. Te quedan ${intentosRestantes} intento(s).`;
                        } else {
                            alert("❌ Tu número de intentos ha llegado al límite.");
                            window.location.href = `${BASE_URL}/main`;
                        }
                    }
                });
            }
        } else {
            alert(data.msj || "Error al generar el código.");
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    } catch {
        alert("No se pudo conectar con el servidor.");
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
    }
});
