// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
  })()

  document.addEventListener("DOMContentLoaded", function () {
    const municipiosPorDepartamento = {
        "Amazonas": ["Leticia", "Tabatinga", "Puerto Nariño"],
        "Antioquia": ["Medellín", "Bello", "Envigado"],
    };

    const departamentoSelect = document.getElementById("departamento");
    const municipioSelect = document.getElementById("municipio");

    // Función para cargar municipios según el departamento seleccionado
    function actualizarMunicipios() {
        const selectedDepartamento = departamentoSelect.value;
        municipioSelect.innerHTML = ""; // Limpiar opciones

        // Si se selecciona un departamento válido, cargar los municipios correspondientes
        if (municipiosPorDepartamento.hasOwnProperty(selectedDepartamento)) {
            const municipios = municipiosPorDepartamento[selectedDepartamento];
            municipios.forEach(municipio => {
                const option = document.createElement("option");
                option.text = municipio;
                option.value = municipio;
                municipioSelect.appendChild(option);
            });
        } else {
            const option = document.createElement("option");
            option.text = "Selecciona un departamento válido";
            municipioSelect.appendChild(option);
        }
    }

    // Escuchar cambios en el select de departamento para actualizar los municipios
    departamentoSelect.addEventListener("change", actualizarMunicipios);
});
