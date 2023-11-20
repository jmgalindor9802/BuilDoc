<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Incidente</title>
    <link rel="stylesheet" href="estiloIncidente.css">
    <link rel="shortcut icon" href="recursos\HeadLogo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>

    <script>

        $(function () {
            // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
            $("#adicional").on('click', function () {
                $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
            });

            $(document).on("click", ".eliminar", function () {
                var parent = $(this).parents().get(0);
                // Eliminamos la fila
                $(parent).remove();
                // Eliminamos todos los elementos del input
                $(parent).find("input").empty();
            });
        });
    </script>


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

        .btn-danger {
            padding: 0px !important;
            margin: 0px !important;
            width: 25px;
            height: 25px;
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
                    <li class="breadcrumb-item"><a href="#">Incidente</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reportar incidente</li>
                </ol>
            </nav>
            <h4 class="mb-3 custom-form">Reportar incidente</h4>
            <div class="col-12 custom-form vh-80">
                <br>

                <form action="Incidente.php" method="POST" class="needs-validation " style="max-height: 70vh"
                    novalidate>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label id="NombreProyecto" for="firstName" class="form-label">Incidente</label>
                            <input name="Nombre_incidente" type="text" class="form-control" id="firstName"
                                placeholder="Nombre Proyecto" value="" required required maxlength="280">
                            <div class="invalid-feedback">
                                Se requiere un nombre válido.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="proyecto" class="form-label">Proyecto</label>
                            <select name="Proyecto_incidente" class="form-select" id="proyecto" required height="100px"
                                width="100%">
                                <option value="">Seleccionar...</option>
                                <?php
                                    include_once 'conexion.php';

                                    $sql = "SELECT pk_id_proyecto, proNombre FROM ga_proyecto ORDER BY proNombre";
                                $result = mysqli_query($conectar, $sql);

                                // Rellenar opciones del select con los resultados de la consulta
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["pk_id_proyecto"] . "'>" . $row["proNombre"] . "</option>";
                                    }}
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Se requiere un proyecto válido.
                            </div>
                        </div>
                        <br>
                        <!-- Sub lista de involucrados -->
                        <div class="mb-12">
                            <h5>Agregar Involucrados:</h5>
                            <table class="table bg-info" id="tabla">
                                <tr class="fila-fija">
                                    <td><input name="Nombre_involucrado[]" placeholder="Nombre" /></td>
                                    <td><input name="Apellido_involucrado[]" placeholder="Apellido" /></td>
                                    <td><input name="Identificación_involucrado[]"
                                            placeholder="Numero de Identificacion" id="idInvolucrado" /></td>
                                    <!-- Agrega el div para mostrar el mensaje de error -->
                                    <div class="invalid-feedback" id="idInvolucradoError">
                                        El campo de identificación debe contener solo números.
                                    </div>
                                    <td><input name="Justificacion_involucrado[]" placeholder="Justificacion" /></td>
                                    <td class="eliminar"><button type="button" class="btn btn-danger"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg></button></td>
                                </tr>
                            </table>
                            <div class="btn-der">
                                <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Más +
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5>Involucrados Registrados:</h5>
                            <ul class="list-group" id="listaInvolucrados">
                                <!-- Aquí se agregarán los involucrados registrados -->
                            </ul>
                        </div>
                        <!-- Fin de la sub lista de involucrados -->
                        <div class="mb-3">
                            <label for="Descripcion" class="form-label">Descripción</label>
                            <textarea name="Descripcion_incidente" class="form-control" id="Descripcion" rows="5"
                                placeholder="Descripción sobre cómo sucedió el incidente" required
                                maxlength="5000"></textarea>
                            <div class="invalid-feedback">
                                Se requiere una descripcion válido.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Sugerencia" class="form-label">Sugerencia</label>
                            <textarea name="Sugerencia_incidente" class="form-control" id="Sugerencia" rows="5"
                                placeholder="Añada una sugerencia para que el incidente no vuelva a suceder"
                                maxlength="5000"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="Gravedad" class="form-label">Nivel de Gravedad</label>
                            <button type="button" class="btn btn-sm btn-secondary" id="ayudaGravedad"
                                data-bs-toggle="popover" data-bs-placement="top" title="Ayuda sobre la Gravedad"
                                data-bs-content="Haga clic aquí para obtener más información">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                </svg>
                            </button>
                            <select name="Gravedad_incidente" class="form-select" id="Gravedad" required>
                                <option value="">Seleccione...</option>
                                <option value="ALTO">ALTO</option>
                                <option value="MEDIO">MEDIO</option>
                                <option value="BAJO">BAJO</option>
                            </select>
                            <div class="invalid-feedback">
                                Se requiere seleccionar un nivel de gravedad válido.
                            </div>
                        </div>
                        <br>
                        <div class="col-md-6">
                            <label for="Evidencia" class="form-label">Evidencia</label>
                            <input name="Evidencia_incidente" class="form-control" type="file" id="Evidencia" multiple>
                            <div class="invalid-feedback">
                                Se requiere adjuntar una evidencia válida.
                            </div>
                        </div>
                        <button class="btn btn-lg float-end custom-btn" id="guardarIncidenteButton"
                            style="font-size: 15px;">Guardar incidente</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar envío</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas enviar el formulario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmarModalButton">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de éxito -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    La fase se ha creado exitosamente.
                </div>
            </div>

        </div>
        <script src="ReportarIncidente.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>

</html>