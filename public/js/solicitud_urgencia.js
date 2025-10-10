document.addEventListener('DOMContentLoaded', () => {
    const form_inhabilitado = document.querySelectorAll(".form-inhabilitado");
    const categoria_valor = document.getElementById("categoria_valor");

    // Ocultar todos los formularios al inicio
    form_inhabilitado.forEach(form => {
        form.style.display = 'none';
    });

    // Escuchar cambios en el select
    categoria_valor.addEventListener('change', () => {
        const valor = categoria_valor.value.trim();

        // Ocultar todos los formularios antes de mostrar el correcto
        form_inhabilitado.forEach(form => {
            form.style.display = 'none';
        });

        // Mostrar el formulario correspondiente
        if (valor === "Ecosonograma" || valor === "Eco-Doppler") {
            document.getElementById("form_laboratorio").style.display = 'block';
        } else if (valor === "Medicamentos") {
            document.getElementById("form_medicamentos").style.display = 'block';
        } else if (valor !== "") {
            document.getElementById("form_laboratorio_group").style.display = 'block';
        }
    });
});
