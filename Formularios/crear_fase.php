<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fase</title>
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

        .custom-form-h4 {
            padding-left: 8%;
            padding-right: 8%;
            font-size: 15px;
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
            <iframe src="Menu.html" class="w-100 " height="100%" style="max-height: 100%;"
                title="Menú principal"></iframe>
        </div>
        <div class="col-10 border-left ">
            <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Tareas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Crear fase</li>
                </ol>
            </nav>
            <h4 class="mb-3 custom-form">Nueva fase</h4>
            <div class="col-12 custom-form vh-80">
                <br>
                <form action="fase.php" method="post" class="needs-validation " style="max-height: 70vh" novalidate>
                    <!-- INSERTAR NOMBRE FASE -->
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label id="Nombre_fase" for="Nombre_fase" class="form-label">Nombre de la
                                fase</label>
                            <input name="Nombre_fase" type="text" class="form-control" id="firstName"
                                placeholder="Nombre de la fase" required>
                            <div class="invalid-feedback">
                                Se requiere un nombre válido.
                            </div>
                        </div>
                        <!-- INSERTAR PROYECTO CON LISTA DESPLEGABLE -->
                        <div class="col-md-6">
                            <label for="country" class="form-label">Proyecto</label>
                            <select name="Proyecto_fase" class="form-select" id="country" required>
                                <option value="">Elegir...</option>
                                <?php
                                require('conexion.php');

                                // Verificar la conexión
                                if (!$conectar) {
                                    die("Conexión fallida: " . mysqli_connect_error());
                                }
                                
                                // Consulta para obtener nombres e IDs de proyectos de la base de datos
                                $sql = "SELECT pk_id_proyecto, proNombre FROM ga_proyecto ORDER BY proNombre";
                                $result = mysqli_query($conectar, $sql);

                                // Rellenar opciones del select con los resultados de la consulta
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["pk_id_proyecto"] . "'>" . $row["proNombre"] . "</option>";
                                    }
                                }
                                ?>
                            </select>

                            <div class="invalid-feedback">
                                Seleccione una fase.
                            </div>
                        </div>

                    </div>
                    <br>
                    <!-- DESCRIPCION DE LA FASE -->
                    <div class="row g-3">
                        <label id="Descripcion_fase" for="Descripcion_fase" class="form-label">Descripción</label>
                        <textarea name="Descripcion_fase" class="form-control" id="exampleFormControlTextarea1" rows="4"
                            placeholder="Descripción de la fase" required maxlength="450"></textarea>
                        <div class="invalid-feedback">
                            Se requiere una descripción válida.
                        </div>
                    </div>
                    <br>
                    <!-- Botón "Guardar fase" que abre el modal -->
                    <button class="btn btn-lg float-end custom-btn" id="guardarFaseButton"
                        style="font-size: 15px;">Guardar fase</button>
                    <script>

                        document.addEventListener("DOMContentLoaded", function () {
                            var form = document.querySelector('.needs-validation');
                            var guardarFaseButton = document.getElementById('guardarFaseButton');
                            var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));

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
                                } else {
                                    form.classList.add('was-validated'); // Muestra los mensajes de validación
                                }
                            });
                        });
                    </script>
                    <!-- Modal de confirmación -->
                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                        aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Confirmar envío</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas enviar el formulario?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary"
                                        id="confirmarModalButton">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="crear_fase.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>