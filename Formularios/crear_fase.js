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
  document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector('.needs-validation');
    var guardarFaseButton = document.getElementById('guardarFaseButton');
    var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    var successModal = new bootstrap.Modal(document.getElementById('successModal'));

    guardarFaseButton.addEventListener('click', function () {
        // Verifica si el formulario es válido antes de abrir el modal
        if (form.checkValidity()) {
            confirmModal.show();
        } else {
            form.classList.add('was-validated');
        }
    });

    // Agrega un evento de clic al botón de "Confirmar" dentro del modal
    var confirmarModalButton = document.getElementById('confirmarModalButton');
    confirmarModalButton.addEventListener('click', function () {
        // Verifica si el formulario es válido antes de enviarlo
        if (form.checkValidity()) {
            form.submit(); // Envía el formulario
            confirmModal.hide(); // Cierra el modal después de enviar
             // Muestra el modal de éxito después de 2 segundos
             alert("Fase creada con éxito"); // Prueba de alerta
              window.location.href = "Tareas_dashboard.php";
        } else {
            form.classList.add('was-validated'); // Muestra los mensajes de validación
        }
    });
});
  
})();
