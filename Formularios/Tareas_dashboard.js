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
 
  document.addEventListener("DOMContentLoaded", function () {
    const tablaTareas = document.getElementById("tablaTareas");
    const dropdown = document.querySelector(".dropdown");

    dropdown.addEventListener("click", function (event) {
      if (event.target.classList.contains("dropdown-item")) {
        const selectedProject = event.target.textContent;
        filterTable(selectedProject);
      }
    });

    function filterTable(selectedProject) {
      const rows = tablaTareas.querySelectorAll("tbody tr");
      rows.forEach(function (row) {
        const proyecto = row.cells[0].textContent;
        if (
          selectedProject === "Todos los proyectos" ||
          proyecto === selectedProject
        ) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
    const proyectoSeleccionadoBtn = document.getElementById(
      "proyectoSeleccionado"
    );
    const dropdown = document.querySelector(".dropdown");

    dropdown.addEventListener("click", function (event) {
      if (event.target.classList.contains("dropdown-item")) {
        const selectedProject = event.target.textContent;
        proyectoSeleccionadoBtn.textContent = selectedProject;
      }
    });
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
})();
