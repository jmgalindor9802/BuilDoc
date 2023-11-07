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

const dropdown = document.getElementById("proyectoSeleccionado");
const tablaProyectos = document.getElementById("tablaProyectos");

dropdown.addEventListener("click", function (e) {
  e.preventDefault();
});

const dropdownItems = document.querySelectorAll(".dropdown-item");
dropdownItems.forEach(function (item) {
  item.addEventListener("click", function (e) {
    e.preventDefault();
    const selectedMunicipio = item.getAttribute("data-municipio");

    // Ocultar todas las filas de la tabla
    const filas = tablaProyectos.querySelectorAll(".proyecto");
    filas.forEach(function (fila) {
      fila.style.display = "none";
    });

    // Mostrar las filas correspondientes al municipio seleccionado
    if (selectedMunicipio === "todos") {
      filas.forEach(function (fila) {
        fila.style.display = "table-row";
      });
    } else {
      const filasMunicipio = tablaProyectos.querySelectorAll(`[data-municipio="${selectedMunicipio}"]`);
      filasMunicipio.forEach(function (fila) {
        fila.style.display = "table-row";
      });
    }

    // Actualizar el texto del botón del menú desplegable
    dropdown.textContent = item.textContent;
  });
});

