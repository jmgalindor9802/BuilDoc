// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  "use strict";
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.from(forms).forEach((form) => {
    form.addEventListener(
      "submit",
      (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
 

  document.addEventListener('DOMContentLoaded', function () {
    // Función para calcular el tiempo restante
    function calcularTiempoRestante(fechaLimite) {
      const ahora = new Date();
      const fechaLimiteDate = new Date(fechaLimite);
      const diferencia = fechaLimiteDate - ahora;
  
      if (diferencia <= 0) {
        return "Vencida";
      }
  
      const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
      const horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  
      return `${dias}d ${horas}h`;
    }
  
    function formatearFechaHora(fechaHora) {
      const opciones = {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      };
      const fechaHoraDate = new Date(fechaHora);
      return fechaHoraDate.toLocaleString('es-CO', opciones);
    }
  
    const filas = document.querySelectorAll('#tablaTareas tbody tr');
  
    const tareasConTiempoRestante = [];
  
    filas.forEach(function (fila) {
      const fechaLimite = fila.querySelector('td:nth-child(4)').textContent.trim();
      const tiempoRestante = calcularTiempoRestante(fechaLimite);
      fila.querySelector('td:nth-child(6)').textContent = tiempoRestante;
  
      const tiempoRestanteNum = parseInt(tiempoRestante.split(' ')[0]);
  
      if (tiempoRestanteNum <= 2) {
        fila.classList.add('tiempo-restante-rojo');
      } else if (tiempoRestanteNum <= 5) {
        fila.classList.add('tiempo-restante-amarillo');
      } else {
        fila.classList.add('tiempo-restante-verde');
      }
  
      const fechaHoraOriginal = fila.querySelector('td:nth-child(4)').textContent.trim();
      const fechaHoraFormateada = formatearFechaHora(fechaHoraOriginal);
      fila.querySelector('td:nth-child(4)').textContent = fechaHoraFormateada;
  
      tareasConTiempoRestante.push({ fila, tiempoRestante });
    });
  
    tareasConTiempoRestante.sort(function (a, b) {
      if (a.tiempoRestante === "Vencida") return 1;
      if (b.tiempoRestante === "Vencida") return -1;
      const tiempoA = a.tiempoRestante.split('d');
      const tiempoB = b.tiempoRestante.split('d');
      const diasA = parseInt(tiempoA[0], 10);
      const diasB = parseInt(tiempoB[0], 10);
      const horasA = parseInt(tiempoA[1], 10);
      const horasB = parseInt(tiempoB[1], 10);
  
      if (diasA === diasB) {
        return horasA - horasB;
      }
  
      return diasA - diasB;
    });
  
    const tbody = document.querySelector('#tablaTareas tbody');
    tareasConTiempoRestante.forEach(function (tarea) {
      tbody.appendChild(tarea.fila);
    });
  });
});

// Tareas_dashboard.js

function seleccionarProyecto(elemento) {

  // Obtener el ID del proyecto seleccionado
  const projectId = elemento.dataset.id;

  // Enviar una solicitud AJAX al servidor
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/Tareas_dashboard.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send(JSON.stringify({
    projectId: projectId
  }));

  // Actualizar la tabla
  const tablaTareas = document.getElementById("tablaTareas");
  tablaTareas.innerHTML = "";

  // Obtener las tareas para el proyecto seleccionado
  const tareas = JSON.parse(xhr.responseText);

  // Iterar sobre las tareas
  tareas.forEach((tarea) => {

    // Agregar una fila a la tabla
    const fila = document.createElement("tr");
    tablaTareas.appendChild(fila);

    // Agregar las columnas a la fila
    fila.appendChild(document.createTextNode(tarea.proyecto));
    fila.appendChild(document.createTextNode(tarea.fase));
    fila.appendChild(document.createTextNode(tarea.tarea));
    fila.appendChild(document.createTextNode(tarea.fechaHoraLimite));
    fila.appendChild(document.createTextNode(tarea.responsable));
    fila.appendChild(document.createTextNode(tarea.tiempoRestante));
  });
}

function actualizarTabla(data) {
  // Aquí puedes usar el objeto 'data' recibido para actualizar la tabla
  console.log(data); // Puedes usar este console.log para depurar y ver los datos recibidos

  // Ejemplo de cómo podrías actualizar la tabla
  var tbody = document.getElementById('tablaTareas').getElementsByTagName('tbody')[0];
  tbody.innerHTML = ''; // Limpia el contenido actual del tbody

  // Itera sobre los datos y agrega las filas a la tabla
  for (var i = 0; i < data.length; i++) {
    var row = "<tr>";
    row += "<td>" + data[i].Proyecto + "</td>";
    row += "<td>" + data[i].Fase + "</td>";
    row += "<td>" + data[i].Tarea + "</td>";
    row += "<td>" + data[i].Fecha_Limite + "</td>";
    row += "<td>" + data[i].Responsable + "</td>";
    row += "<td>" + data[i].Tiempo_Restante + "</td>";
    row += "</tr>";

    tbody.innerHTML += row;
  }
}
