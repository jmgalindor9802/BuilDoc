(() => {
  'use strict'

  const forms = document.querySelectorAll('.needs-validation');

  Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
          }

          form.classList.add('was-validated');
      }, false);
  });

  document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('faseSelect').addEventListener('change', function () {
          console.log('Cambio en la fase');
          obtenerYActualizarTareas();
      });

      document.getElementById('proyectoSelect').addEventListener('change', function () {
          console.log('Cambio en el proyecto');
          obtenerYActualizarTareas();
      });
          // Manejador del evento submit del formulario
      document.querySelector('form').addEventListener('submit', function (event) {
            // Evita que el formulario se envíe de la manera tradicional
          event.preventDefault();
          obtenerYActualizarTareas();
      });
  });

  function obtenerYActualizarTareas() {
      console.log('Obteniendo y actualizando tareas...');
      var idProyecto = document.getElementById('proyectoSelect').value;
      var idFase = document.getElementById('faseSelect').value;

        // Realiza la solicitud Ajax solo si ambos valores están seleccionados
        if (idProyecto && idFase) {
      realizarSolicitudAjax(idProyecto, idFase, function (tareas) {
          updateTaskContainer(tareas);
          console.log(tareas);
      });
  }
}
  function realizarSolicitudAjax(idProyecto, idFase, callback) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
              if (xhr.status === 200) {
                  var tareas = JSON.parse(xhr.responseText);
                  callback(tareas);
              } else {
                  console.error('Error en la solicitud Ajax. Estado:', xhr.status);
              }
          }
      };

      xhr.open('POST', 'ajax_obtener_tareas.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send('idProyecto=' + idProyecto + '&idFase=' + idFase);
  }

  function updateTaskContainer(tasks) {
      var tasksContainer = document.getElementById('tasksContainer');
      tasksContainer.innerHTML = '';

      if (tasks.length > 0) {
          tasks.forEach(function (task) {
              var taskDiv = document.createElement('div');
              taskDiv.textContent = task.tarNombre; // Assuming tarNombre is the task name property
              tasksContainer.appendChild(taskDiv);
          });
      } else {
          tasksContainer.textContent = 'No tasks available.';
      }
  }
})();
