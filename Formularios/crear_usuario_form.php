<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuario</title>
  <link rel="shortcut icon" href="recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">



  <style>
    .border-left {
      border-left: 1px solid #d7d7d7;
      height: 100%;
    }

    .custom-btn {
      background-color: #0074e4;
      color: #ffffff;
    }

    .vh-80 {
      max-height: 80vh;
      overflow-y: auto;
    }

    .custom-form {
      padding-left: 8%;
      padding-right: 8%;
    }

    .custom-nav {
      padding-left: 4%;
      padding-right: 4%;
    }
  </style>
</head>

<body style="height: 100vh; display: flex; flex-direction: column; overflow: hidden;">
  <!-- Encabezado de la pagina -->
  <header>
    <!-- Revisar que  max-height:78px funcione sin problemas en diferentes pantallas-->
    <iframe src="Header.html" class="w-100" height="78" style="max-height:78px;" title="Encabezado"></iframe>
  </header>

  <div class="row flex-grow-1">
    <div class="col-lg-2">
      <!-- Menu lateral izquierdo que permite el despasamiento de la pagina -->
      <iframe src="Menu.html" class="w-100 " height="100%" style="max-height: 100%;" title="Menú principal"></iframe>
    </div>
    <div class="col-10 border-left custom-form">
      <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
          <li class="breadcrumb-item active" aria-current="page">Crear Usuario</li>
        </ol>
      </nav>
      <h4 class="mb-3 custom-form">Nuevo usuario</h4>
      <div class="col-12 custom-form vh-80">
        <br>

        <form method="post" class="needs-validation" id="formRegistroUser" style="max-height: 70vh" 
        onsubmit="return agregarNuevoUsuario()" novalidate> <?php //Se agrega funcion onsubmit para el ajax?>

          <div class="row g-3">
            <div class="col-sm-12">
              <label id="NumeroDocumento" for="document" class="form-label">Número de documento</label>
              <input name="CC" type="number" class="form-control" id="document" placeholder="Documento usuario" value=""
                required>
              <div class="invalid-feedback">
                Se requiere un numero válido.
              </div>
            </div>
            <div class="col-sm-6">
              <label id="NombreUsu" for="firstName" class="form-label">Nombre</label>
              <input name="NombreUsu" type="text" class="form-control" id="firstName" placeholder="Nombre usuario"
                value="" required>
              <div class="invalid-feedback">
                Se requiere un nombre válido.
              </div>
            </div>
            <div class="col-md-6">
              <label id="ApellidoUsu" for="lastName" class="form-label">Apellido</label>
              <input name="ApellidoUsu" type="text" class="form-control" id="lastName" placeholder="Apellido usuario"
                value="" required>
              <div class="invalid-feedback">
                Se requiere un apellido válido.
              </div>
            </div>
            <div class="col-sm-6">
              <label id="EPSusu" for="eps" class="form-label">EPS</label>
              <input name="EPSusu" type="text" class="form-control" id="eps" placeholder="Nombre EPS" value="" required>
              <div class="invalid-feedback">
                Se requiere una EPS válida.
              </div>
            </div>
            <div class="col-md-6">
              <label id="ARLusu" for="arl" class="form-label">ARL</label>
              <input name="ARL" type="text" class="form-control" id="arl" placeholder="Nombre ARL" value="" required>
              <div class="invalid-feedback">
                Se requiere una ARL válida.
              </div>
            </div>
            <div class="col-6">
              <label for="Nacimiento" class="form-label">Fecha de nacimiento</label>
              <div class="input-group has-validation">
                <input name="FechaNacimientoUsu" type="date" class="form-control" id="Nacimiento"
                  placeholder="Fecha de nacimiento" required>
                <div class="invalid-feedback">
                  Se requiere una fecha válida.
                </div>
              </div>
            </div>
            <script>
              const inputFechaNacimiento = document.getElementById('Nacimiento');

              inputFechaNacimiento.addEventListener('input', function () {
                const fechaNacimiento = new Date(this.value);
                const fechaActual = new Date();

                if (isNaN(fechaNacimiento.getTime())) {
                  // La fecha ingresada no es válida
                  this.setCustomValidity('Se requiere una fecha válida.');
                  this.parentElement.classList.add('was-validated');
                } else if (fechaNacimiento > fechaActual) {
                  // La fecha ingresada es en el futuro
                  this.setCustomValidity('La fecha de nacimiento no puede ser en el futuro.');
                  this.parentElement.classList.add('was-validated');
                } else {
                  // La fecha ingresada es válida
                  this.setCustomValidity('');
                  this.parentElement.classList.remove('was-validated');
                }
              });
            </script>
            <div class="col-sm-6">
              <label for="direccion" class="form-label">Dirección de residencia</label>
              <div class="input-group has-validation">
                <input name="DireccionUsu" type="text" class="form-control" id="direccion"
                  placeholder="Dirección residencia" required>
                <div class="invalid-feedback">
                  Se requiere una direccion válido.
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="municipio" class="form-label">Municipio de residencia</label>
              <div class="input-group has-validation">
                <input name="MunicipioUsu" type="text" class="form-control" id="municipio"
                  placeholder="Municipio residencia" required>
                <div class="invalid-feedback">
                  Se requiere una municipio válido.
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="Correo" class="form-label">Correo electrónico</label>
              <div class="input-group has-validation">
                <input name="CorreoUsu" type="email" class="form-control" id="Correo" placeholder="Correo electrónico"
                  required>
                <div class="invalid-feedback">
                  Se requiere un correo válido.
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="teléfono" class="form-label">Número de teléfono</label>
              <div class="input-group has-validation">
                <input name="TelefonoUsu" type="number" class="form-control" id="teléfono"
                  placeholder="Número teléfonico" required>
                <div class="invalid-feedback">
                  Se requiere un teléfono válido.
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="Profesión" class="form-label">Profesión</label>
              <div class="input-group has-validation">
                <input name="ProfesionUsu" type="text" class="form-control" id="Profesión"
                  placeholder="Nombre profesión" required>
                <div class="invalid-feedback">
                  Se requiere una profesión válida.
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="Contraseña" class="form-label">Contraseña</label>
              <div class="input-group has-validation">
                <input name="ContraseniaUsu" type="password" class="form-control" id="Contraseña"
                  placeholder="Contraseña usuario" required>
                <div class="invalid-feedback">
                  Se requiere una contraseña válida.
                </div>
              </div>
            </div>
            <div class="py-4">
              <button class="btn btn-lg float-end custom-btn" type="submit" style="font-size: 15px;"
              >Guardar
                usuario</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script src="crear_usuario_form.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
     /* function confirmarGuardadoUsuario(event) {
        event.preventDefault(); // Evitar que el formulario se envíe automáticamente

        if (confirm("¿Estás seguro de guardar este usuario?")) {
        agregarNuevoUsuario(); // Llamar a la función para agregar el usuario
        }
    } */

    function agregarNuevoUsuario() {
        $.ajax({
            method: "POST",
            data: $('#formRegistroUser').serialize(),
            url: "class_usuario.php",
            success: function(respuesta) {
                respuesta = respuesta.trim();

                if (respuesta == 1) {
                    $('#formRegistroUser')[0].reset();
                    swal(":D", "Usuario agregado correctamente", "success");
                } /*else if (respuesta == 2) {
                    swal("Error", "Este usuario ya existe, por favor añade otro.", "error");
                }*/ else {
                    swal("Error", "Hubo un problema al agregar el usuario", "error");
                }
            },
            error: function() {
                swal("Error", "Hubo un problema al comunicarse con el servidor", "error");
            }
        });

        return false;
    }
</script>


</body>
</html>