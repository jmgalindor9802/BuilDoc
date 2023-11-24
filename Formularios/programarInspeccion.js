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


// Definir variables en el alcance global para la periodicidad
const fechaInicialInput = document.getElementById("fechaInicial");
const fechaFinalInput = document.getElementById("fechaFinal");
const fechaInspeccionInput = document.getElementById("FechaInspeccion");

document.addEventListener("DOMContentLoaded", function () {
  const periodicidadSelect = document.getElementById("periodicidad");
  const fechaInicialDiv = document.getElementById("contenedor_fechaInicial");
  const fechaFinalDiv = document.getElementById("contenedor_fechaFinal");
  const fechaInspeccionDiv = document.getElementById("contenedor_FechaInspeccion");

  periodicidadSelect.addEventListener("change", function () {
    const selectedOption = periodicidadSelect.value;

    // Ocultar todos los campos
    fechaInicialDiv.style.display = "none";
    fechaFinalDiv.style.display = "none";
    fechaInspeccionDiv.style.display = "none";

    // Desactivar la propiedad required en todos los campos de fecha y hora
    fechaInicialInput.required = false;
    fechaFinalInput.required = false;
    fechaInspeccionInput.required = false;

    // Mostrar solo el campo correspondiente a "Ninguna"
    if (selectedOption === "NINGUNA") {
      fechaInspeccionDiv.style.display = "block";
      fechaInspeccionInput.required = true;
    } else if (selectedOption !== "") {
      // Mostrar los campos de fecha y hora de inicio y final para otras opciones
      fechaInicialDiv.style.display = "block";
      fechaFinalDiv.style.display = "block";
      fechaInicialInput.required = true;
      fechaFinalInput.required = true;
    }
  });
});
/*
//Agregra usuario a una inspeccion
document.addEventListener('DOMContentLoaded', function () {
  const usuarioInspeccionDisponible = document.getElementById('usuario_inspeccion_disponible');
  const usuarioInspeccionSeleccionado = document.getElementById('usuario_inspeccion_seleccionado');
  const errorMensaje = document.getElementById('error-mensaje');
  const inspectoresSeleccionados = document.getElementById('inspectores-seleccionados');
  const inspectoresSeleccionadosSet = new Set();

  function actualizarError() {
    if (inspectoresSeleccionadosSet.size === 0) {
      errorMensaje.style.display = 'block';
    } else {
      errorMensaje.style.display = 'none';
    }
  }

  // Función para actualizar las listas de inspectores
  function actualizarListas() {
    console.log('Actualizando listas...');
    // Obtener los valores de los elementos DOM
    const usuarioInspeccionDisponible = document.getElementById('usuario_inspeccion_disponible');
    const inspectoresSeleccionadosSet = new Set();

    // Iterar sobre las opciones del elemento DOM
    Array.from(usuarioInspeccionDisponible.options).forEach(option => {
      // Establecer el atributo disabled
      option.disabled = inspectoresSeleccionadosSet.has(option.value);
    });

    // Actualizar lista de seleccionados
    while (inspectoresSeleccionados.firstChild) {
      inspectoresSeleccionados.removeChild(inspectoresSeleccionados.firstChild);
    }
    inspectoresSeleccionadosSet.forEach(value => {
      const listItem = document.createElement('li');
      listItem.className = 'list-group-item';
      listItem.textContent = value;

      const removeButton = document.createElement('button');
      removeButton.className = 'btn btn-sm btn-danger float-end';
      removeButton.textContent = 'x';
      removeButton.addEventListener('click', function () {
        inspectoresSeleccionadosSet.delete(value);
        actualizarListas();
        actualizarError();
      });

      listItem.appendChild(removeButton);
      inspectoresSeleccionados.appendChild(listItem);
    });
    console.log('Listas actualizadas exitosamente.');
  }

  // Evento para agregar inspectores disponibles a la lista de seleccionados
  usuarioInspeccionDisponible.addEventListener('change', function () {
    console.log('Inspectores disponibles cambiados');
    const selectedOptions = Array.from(usuarioInspeccionDisponible.selectedOptions);
    selectedOptions.forEach(option => {
      const value = option.value;
      if (!inspectoresSeleccionadosSet.has(value)) {
        inspectoresSeleccionadosSet.add(value);
      }
    });
    actualizarListas();
    actualizarError();
  });

  // Evento para quitar inspectores de la lista de seleccionados
  usuarioInspeccionSeleccionado.addEventListener('change', function () {
    console.log('Inspectores seleccionados cambiados');
    // Verificar si usuarioInspeccionSeleccionado es null
    if (!usuarioInspeccionSeleccionado) {
      console.log('No se obtuvieron los datos. usuarioInspeccionSeleccionado es null.');
      return;
  }
    const selectedOptions = Array.from(usuarioInspeccionSeleccionado.selectedOptions);
    selectedOptions.forEach(option => {
      const value = option.value;
      inspectoresSeleccionadosSet.delete(value);
    });
    actualizarListas();
    actualizarError();
  });

  // Evento para validar que al menos un inspector esté seleccionado antes de enviar el formulario
  document.querySelector('form').addEventListener('submit', function (event) {
    if (inspectoresSeleccionadosSet.size === 0) {
      event.preventDefault();
      errorMensaje.style.display = 'block';
    }
  });
});
*/
// Obtener el elemento select
const select = document.getElementById("usuario_inspeccion_disponible");

// Obtener el elemento ul que contendrá las opciones seleccionadas
const ul = document.getElementById("inspectores-seleccionados");

// Crear un arreglo para almacenar las opciones seleccionadas
const seleccionados = [];

// Cuando se selecciona una opción
select.addEventListener("change", function() {

  // Obtener las opciones seleccionadas
  const opcionesSeleccionadas = select.querySelectorAll("option:checked");

  // Limpiar el arreglo de seleccionados
  seleccionados.splice(0, seleccionados.length);

  // Agregar las opciones seleccionadas al arreglo
  opcionesSeleccionadas.forEach(opcion => {
    seleccionados.push(opcion.value);
  });

  // Actualizar el ul con las opciones seleccionadas
  ul.innerHTML = "";
  seleccionados.forEach(id => {
    const li = document.createElement("li");
    li.textContent = select.options[id].textContent;
    ul.appendChild(li);
  });

  // Validar que se haya seleccionado al menos una opción
  if (seleccionados.length === 0) {
    document.getElementById("error-mensaje").classList.remove("d-none");
  } else {
    document.getElementById("error-mensaje").classList.add("d-none");
  }
});

// Validar fechas y horas
document.addEventListener('DOMContentLoaded', function () {
  // Obtener elementos de fecha y hora
  const fechaInspeccionInput = document.getElementById('FechaInspeccion');
  const fechaInicialInput = document.getElementById('fechaInicial');
  const fechaFinalInput = document.getElementById('fechaFinal');

  // Obtener elementos de mensaje de error
  const errorFechaInspeccionMensaje = document.getElementById('error-fechaInspeccion-mensaje');
  const errorFechaInicialMensaje = document.getElementById('error-fechaInicial-mensaje');
  const errorFechaFinalMensaje = document.getElementById('error-fechaFinal-mensaje');
  const errorFechaInspeccionAnteriorMensaje = document.getElementById('error-fechaInspeccion-anterior-mensaje');
  const errorFechaInicialAnteriorMensaje = document.getElementById('error-fechaInicial-anterior-mensaje');
  const errorFechaFinalAnteriorMensaje = document.getElementById('error-fechaFinal-anterior-mensaje');

  fechaInspeccionInput.addEventListener('change', function () {
    validarFecha(fechaInspeccionInput, errorFechaInspeccionMensaje, errorFechaInspeccionAnteriorMensaje);
  });

  fechaInicialInput.addEventListener('change', function () {
    validarFecha(fechaInicialInput, errorFechaInicialMensaje, errorFechaInicialAnteriorMensaje);
  });

  fechaFinalInput.addEventListener('change', function () {
    validarFecha(fechaFinalInput, errorFechaFinalMensaje, errorFechaFinalAnteriorMensaje);
  });

  document.querySelector('form').addEventListener('submit', function (event) {
    if (!validarFecha(fechaInspeccionInput, errorFechaInspeccionMensaje, errorFechaInspeccionAnteriorMensaje) ||
      !validarFecha(fechaInicialInput, errorFechaInicialMensaje, errorFechaInicialAnteriorMensaje) ||
      !validarFecha(fechaFinalInput, errorFechaFinalMensaje, errorFechaFinalAnteriorMensaje)) {
      event.preventDefault();
    }
  });

  function validarFecha(input, errorMensaje, errorAnteriorMensaje) {
    const fecha = new Date(input.value);
    const ahora = new Date();

    if (fecha <= ahora) {
      errorMensaje.style.display = 'none';
      errorAnteriorMensaje.style.display = 'block';
      return false;
    } else {
      errorMensaje.style.display = 'none';
      errorAnteriorMensaje.style.display = 'none';
      return true;
    }
  }
});



// funcion para el cuadro de ayuda
var ayudaGravedad = document.getElementById('ayudaGravedad');
var contenidoAyuda = {
  I: "Esta funcionalidad indicara cuantas veces se va a estar repitiendo la inspeccion"
};

ayudaGravedad.addEventListener('mouseover', function () {
  ayudaGravedad.setAttribute('data-bs-content', contenidoAyuda['I']);

  var popover = new bootstrap.Popover(ayudaGravedad);
});