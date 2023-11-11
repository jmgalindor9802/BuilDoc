(() => {
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      event.preventDefault();
      event.stopPropagation();
      form.classList.add('was-validated');
    }, false);
  });

  // Agrega un evento de clic al botón "Guardar fase" que abre el modal
  const guardarFaseButton = document.getElementById('guardarFaseButton');
  const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));

  guardarFaseButton.addEventListener('click', function (event) {
    // Previene la acción predeterminada del botón
    event.preventDefault();

    // Verifica si el formulario es válido antes de abrir el modal
    if (forms[0].checkValidity()) {
      // Muestra el modal solo si el formulario es válido
      confirmModal.show();
    } else {
      forms[0].classList.add('was-validated');
      confirmModal.hide(); // Si no es válido, cierra el modal (si está abierto)
    }
  });

  // Agrega un evento de clic al botón de "Confirmar" dentro del modal
  const confirmarModalButton = document.getElementById('confirmarModalButton');
  confirmarModalButton.addEventListener('click', function () {
    // Verifica si el formulario es válido antes de enviarlo
    if (forms[0].checkValidity()) {
      // Envía el formulario
      forms[0].submit();
      confirmModal.hide(); // Cierra el modal después de enviar
    } else {
      forms[0].classList.add('was-validated'); // Muestra los mensajes de validación
    }
  });

  // Código existente
  document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector('.needs-validation');
    var guardarFaseButton = document.getElementById('guardarFaseButton');
    var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));

    guardarFaseButton.addEventListener('click', function () {
      // Abre el modal cuando se hace clic en "Guardar fase"
      confirmModal.show();
    });

    // Agrega un evento de clic al botón de "Confirmar" dentro del modal
    var confirmarModalButton = document.getElementById('confirmarModalButton');
    confirmarModalButton.addEventListener('click', function () {
      // Verifica si el formulario es válido antes de enviarlo
      if (form.checkValidity()) {
        form.submit(); // Envía el formulario
        confirmModal.hide(); // Cierra el modal después de enviar
      } else {
        form.classList.add('was-validated'); // Muestra los mensajes de validación
      }
    });
  });

})();
