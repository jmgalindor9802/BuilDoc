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
    });
    
  })()

var ayudaGravedad = document.getElementById('ayudaGravedad');
var contenidoAyuda = {
    I: "Nivel I: Gravedad máxima. El incidente provocó lesiones graves o la muerte.\n" +
       "Nivel II: Gravedad alta. El incidente provocó lesiones leves o daños materiales importantes.\n" +
       "\n Nivel III: Gravedad media. El incidente provocó daños materiales menores." +
       "\n Nivel IV: Gravedad baja. El incidente no provocó daños materiales ni lesiones."
};

ayudaGravedad.addEventListener('mouseover', function() {
    ayudaGravedad.setAttribute('data-bs-content', contenidoAyuda['I']);
    
    var popover = new bootstrap.Popover(ayudaGravedad);
});