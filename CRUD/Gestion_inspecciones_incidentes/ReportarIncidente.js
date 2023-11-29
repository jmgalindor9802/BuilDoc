(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
          }

          form.classList.add('was-validated');
      }, false);
  });

  document.addEventListener("DOMContentLoaded", function () {
      var form = document.querySelector('.needs-validation');
      var guardarFaseButton = document.getElementById('guardarIncidenteButton');
      var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
      var successModal = new bootstrap.Modal(document.getElementById('successModal'));

      console.log("Variables obtenidas:", form, guardarFaseButton, confirmModal, successModal);

      guardarFaseButton.addEventListener('click', function () {
          // Verifica si el formulario es válido antes de abrir el modal
          if (form.checkValidity()) {
              console.log("Formulario válido. Abriendo el modal de confirmación.");
              confirmModal.show();
          } else {
              console.log("Formulario inválido. Agregando clases para mostrar mensajes de validación.");
              form.classList.add('was-validated');
          }
      });

      // Agrega un evento de clic al botón de "Confirmar" dentro del modal
      var confirmarModalButton = document.getElementById('confirmarModalButton');
      confirmarModalButton.addEventListener('click', function () {
          // Verifica si el formulario es válido antes de enviarlo
          if (form.checkValidity()) {
              console.log("Formulario válido. Enviando el formulario...");
              form.submit(); // Envía el formulario
              confirmModal.hide(); // Cierra el modal después de enviar
              console.log("Formulario enviado con éxito. Redirigiendo al dashboard...");
              // Muestra el modal de éxito después de 2 segundos
              alert("Fase creada con éxito"); // Prueba de alerta
              window.location.href = "Incidentes_dashboard.php"; // Redirige al dashboard
          } else {
              console.log("Formulario inválido. Agregando clases para mostrar mensajes de validación.");
              form.classList.add('was-validated'); // Muestra los mensajes de validación
          }
      });
  });

  var ayudaGravedad = document.getElementById('ayudaGravedad');
  var contenidoAyuda = {
      I: "Nivel I: Gravedad máxima. El incidente provocó lesiones graves o la muerte.\n" +
          "Nivel II: Gravedad alta. El incidente provocó lesiones leves o daños materiales importantes.\n" +
          "\n Nivel III: Gravedad media. El incidente provocó daños materiales menores." +
          "\n Nivel IV: Gravedad baja. El incidente no provocó daños materiales ni lesiones."
  };

  ayudaGravedad.addEventListener('mouseover', function () {
      ayudaGravedad.setAttribute('data-bs-content', contenidoAyuda['I']);

      var popover = new bootstrap.Popover(ayudaGravedad);
  });

})();