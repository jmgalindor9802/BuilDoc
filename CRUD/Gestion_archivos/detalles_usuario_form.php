<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detalles usuario</title>
  <link rel="shortcut icon" href="../recursos/HeadLogo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


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
<header>
<?php include('../Header.php'); ?>
  </header>
<body style="height: 100vh; display: flex; flex-direction: column; overflow: hidden;">
  <!-- Encabezado de la pagina -->

  <div class="row flex-grow-1">
    <div class="col-lg-2">
      <!-- Menu lateral izquierdo que permite el despasamiento de la pagina -->
      <?php include('../Menu.php'); ?>
    </div>
    <div class="col-10 border-left custom-form">
      <nav aria-label="breadcrumb" class="d-flex align-items-center custom-nav ">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detalles Usuario</li>
        </ol>
      </nav>
      <h4 class="mb-3 custom-form">Detalles usuario</h4>
      <div class="col-12 custom-form vh-80">
          <?php
            
            include ('../conexion.php');
            
            $sql = "SELECT * FROM usuario WHERE pk_id_usuario=".$_GET['pk_id_usuario'];
            $resultado = $conectar->query($sql);
            $row = $resultado->fetch_assoc();
            
          ?>
          <input type="hidden" class="form-control" name="IdUser" value="<?php echo $row['pk_id_usuario'] ?>">
          <div class="row g-3">
            <div class="col-sm-12">
              <label id="Cedula" for="document" class="form-label">Número de documento</label>
              <input name="Cedula" type="number" class="form-control" id="document" 
              value="<?php echo $row['pk_id_usuario']?>" disabled readonly>
            </div>
            <div class="col-sm-6">
              <label id="NombreUsu" for="firstName" class="form-label">Nombre</label>
              <input name="NombreUsu" type="text" class="form-control" id="firstName"
              value="<?php echo $row['usuNombre']?>" disabled readonly>
            </div>
            <div class="col-md-6">
              <label id="ApellidoUsu" for="lastName" class="form-label">Apellido</label>
              <input name="ApellidoUsu" type="text" class="form-control" id="lastName"
                value="<?php echo $row['usuApellido']?>" disabled readonly>
            </div>
            <div class="col-sm-6">
              <label id="EPSusu" for="eps" class="form-label">EPS</label>
              <input name="EPS" type="text" class="form-control" id="eps" 
              value="<?php echo $row['usuNombre_eps']?>" disabled readonly>
            </div>
            <div class="col-md-6">
              <label id="ARLusu" for="arl" class="form-label">ARL</label>
              <input name="ARL" type="text" class="form-control" id="arl"
              value="<?php echo $row['usuNombre_arl']?>" disabled readonly>
            </div>
            <div class="col-6">
              <label for="Nacimiento" class="form-label">Fecha de nacimiento</label>
              <div class="input-group has-validation">
                <input name="FechaNacimientoUsu" type="date" class="form-control" id="Nacimiento"
                value="<?php echo $row['usuFecha_nacimiento']?>" disabled readonly>
              </div>
            </div>
            <div class="col-md-6">
            <label id="MunicipioUsu" for="municipio" class="form-label">Municipio</label>
              <input name="Municipio" type="text" class="form-control" id="arl"
              value="<?php echo $row['usuMunicipio']?>" disabled readonly>
            </div>
            <div class="col-sm-6">
              <label for="direccion" class="form-label">Dirección de residencia</label>
              <div class="input-group has-validation">
                <input name="DireccionUsu" type="text" class="form-control" id="direccion"
                value="<?php echo $row['usuDireccion_residencia']?>" disabled readonly>
              </div>
            </div>
            <div class="col-md-6">
              <label for="Correo" class="form-label">Correo electrónico</label>
              <div class="input-group has-validation">
                <input name="CorreoUsu" type="email" class="form-control" id="Correo"
                value="<?php echo $row['usuCorreo']?>" disabled readonly>
              </div>
            </div>
            <div class="col-md-6">
              <label for="teléfono" class="form-label">Número de teléfono</label>
              <div class="input-group has-validation">
                <input name="TelefonoUsu" type="number" class="form-control" id="teléfono"
                value="<?php echo $row['usuTelefono']?>" disabled readonly>
              </div>
            </div>
            <div class="col-md-6">
              <label for="Profesión" class="form-label">Profesión</label>
              <div class="input-group has-validation">
                <input name="ProfesionUsu" type="text" class="form-control" id="Profesión"
                value="<?php echo $row['usuProfesion']?>" disabled readonly>
              </div>
            </div>
            <div class="py-4">
              <a class="btn btn-lg float-end custom-btn" style="font-size: 15px;"
              href="Usuario_dashboard.php">Volver</a>
            </div>
            </div>
            </div>
            
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>