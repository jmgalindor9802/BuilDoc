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
      console.log('DOMContentLoaded event fired.');

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
        return false; 
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
      console.log('Tareas recibidas:', tasks);
      var tasksContainer = document.getElementById('tasksContainer');
      console.log('Tareas del contenedor',tasksContainer); // Agrega esta línea
      console.log('tasksContainer antes de limpiar:', tasksContainer);
      tasksContainer.innerHTML = '';
      if (tasksContainer) {
        if (tasks.length > 0) {
          tasks.forEach(function (task) {
            console.log('Agregando tarea:', task);
            console.log('Objeto de tarea completo:', task);
    
            var checkboxDiv = document.createElement('div');
            checkboxDiv.classList.add('form-check');
    
            var checkboxInput = document.createElement('input');
            checkboxInput.classList.add('form-check-input');
            checkboxInput.type = 'checkbox';
            checkboxInput.name = 'tarea_tarea_dependiente[]';  // Establece el nombre según tu necesidad
            checkboxInput.value = task["ID de Tarea"];  // Puedes usar ID u otra propiedad única aquí
    
            var checkboxLabel = document.createElement('label');
            checkboxLabel.classList.add('form-check-label');
            checkboxLabel.htmlFor = 'checkbox' + task["ID de Tarea"];  // Asegúrate de que el ID sea único
            checkboxLabel.textContent = task["Nombre de Tarea"];
    
            checkboxDiv.appendChild(checkboxInput);
            checkboxDiv.appendChild(checkboxLabel);
    
            tasksContainer.appendChild(checkboxDiv);
          });
          // Forzar redibujado después de agregar las tareas
          tasksContainer.offsetHeight;
        } else {
          tasksContainer.textContent = 'No hay tareas disponibles';
        }
      } else {
        console.error('Element with ID "tasksContainer" not found.');
      }
    }
  })();
