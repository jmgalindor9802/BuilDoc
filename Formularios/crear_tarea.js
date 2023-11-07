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


//Validar fecha
document.addEventListener('DOMContentLoaded', function() {
const fechaLimiteInput = document.getElementById('fechaInicial');
const errorFechaMensaje = document.getElementById('error-fecha-mensaje');

fechaLimiteInput.addEventListener('change', function() {
  const fechaLimite = new Date(fechaLimiteInput.value);
  const ahora = new Date();

  if (fechaLimite <= ahora) {
    errorFechaMensaje.style.display = 'block';
  } else {
    errorFechaMensaje.style.display = 'none';
  }
});

document.querySelector('form').addEventListener('submit', function(event) {
  const fechaLimite = new Date(fechaLimiteInput.value);
  const ahora = new Date();

  if (fechaLimite <= ahora) {
    event.preventDefault();
    errorFechaMensaje.style.display = 'block';
  }
});
});

document.addEventListener('DOMContentLoaded', function() {
  const tareaTareaDisponible = document.getElementById('tarea_tarea_disponible');
  const tareaTareaSeleccionado = document.getElementById('tareas_seleccionadas');
  const usuarioTareaDisponible = document.getElementById('usuario_tarea_disponible');
  const usuarioTareaSeleccionado = document.getElementById('usuarios-seleccionados');
  const errorMensajeTarea = document.getElementById('error-mensaje-tarea');
  const errorMensajeUsuario = document.getElementById('error-mensaje-usuario');
  const tareasSeleccionadasSet = new Set();
  const usuariosSeleccionadosSet = new Set();

  function actualizarErrorTarea() {
      if (tareasSeleccionadasSet.size === 0) {
          errorMensajeTarea.style.display = 'block';
      } else {
          errorMensajeTarea.style.display = 'none';
      }
  }

  function actualizarErrorUsuario() {
      if (usuariosSeleccionadosSet.size === 0) {
          errorMensajeUsuario.style.display = 'block';
      } else {
          errorMensajeUsuario.style.display = 'none';
      }
  }

  function actualizarListas() {
      // Actualizar lista de disponibles (tareas)
      Array.from(tareaTareaDisponible.options).forEach(option => {
          option.disabled = tareasSeleccionadasSet.has(option.value);
      });

      // Actualizar lista de seleccionados (tareas)
      while (tareaTareaSeleccionado.firstChild) {
          tareaTareaSeleccionado.removeChild(tareaTareaSeleccionado.firstChild);
      }
      tareasSeleccionadasSet.forEach(value => {
          const listItem = document.createElement('li');
          listItem.className = 'list-group-item';
          listItem.textContent = value;

          const removeButton = document.createElement('button');
          removeButton.className = 'btn btn-sm btn-danger float-end';
          removeButton.textContent = 'x';
          removeButton.addEventListener('click', function() {
              tareasSeleccionadasSet.delete(value);
              actualizarListas();
              actualizarErrorTarea();
          });

          listItem.appendChild(removeButton);
          tareaTareaSeleccionado.appendChild(listItem);
      });

      // Actualizar lista de disponibles (usuarios)
      Array.from(usuarioTareaDisponible.options).forEach(option => {
          option.disabled = usuariosSeleccionadosSet.has(option.value);
      });

      // Actualizar lista de seleccionados (usuarios)
      while (usuarioTareaSeleccionado.firstChild) {
          usuarioTareaSeleccionado.removeChild(usuarioTareaSeleccionado.firstChild);
      }
      usuariosSeleccionadosSet.forEach(value => {
          const listItem = document.createElement('li');
          listItem.className = 'list-group-item';
          listItem.textContent = value;

          const removeButton = document.createElement('button');
          removeButton.className = 'btn btn-sm btn-danger float-end';
          removeButton.textContent = 'x';
          removeButton.addEventListener('click', function() {
              usuariosSeleccionadosSet.delete(value);
              actualizarListas();
              actualizarErrorUsuario();
          });

          listItem.appendChild(removeButton);
          usuarioTareaSeleccionado.appendChild(listItem);
      });
  }

  tareaTareaDisponible.addEventListener('change', function() {
      const selectedOptions = Array.from(tareaTareaDisponible.selectedOptions);
      selectedOptions.forEach(option => {
          const value = option.value;
          if (!tareasSeleccionadasSet.has(value)) {
              tareasSeleccionadasSet.add(value);
          }
      });
      actualizarListas();
      actualizarErrorTarea();
  });

  usuarioTareaDisponible.addEventListener('change', function() {
      const selectedOptions = Array.from(usuarioTareaDisponible.selectedOptions);
      selectedOptions.forEach(option => {
          const value = option.value;
          if (!usuariosSeleccionadosSet.has(value)) {
              usuariosSeleccionadosSet.add(value);
          }
      });
      actualizarListas();
      actualizarErrorUsuario();
  });

  tareaTareaSeleccionado.addEventListener('change', function() {
      const selectedOptions = Array.from(tareaTareaSeleccionado.selectedOptions);
      selectedOptions.forEach(option => {
          const value = option.value;
          tareasSeleccionadasSet.delete(value);
      });
      actualizarListas();
      actualizarErrorTarea();
  });

  usuarioTareaSeleccionado.addEventListener('change', function() {
      const selectedOptions = Array.from(usuarioTareaSeleccionado.selectedOptions);
      selectedOptions.forEach(option => {
          const value = option.value;
          usuariosSeleccionadosSet.delete(value);
      });
      actualizarListas();
      actualizarErrorUsuario();
  });

  document.querySelector('form').addEventListener('submit', function(event) {
    
      if (usuariosSeleccionadosSet.size === 0) {
          event.preventDefault();
          errorMensajeUsuario.style.display = 'block';
      }
  });
});