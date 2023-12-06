<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Actualizar cliente</title>
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
          <li class="breadcrumb-item"><a href="#">Clientes</a></li>
          <li class="breadcrumb-item active" aria-current="page">Actualizar cliente</li>
        </ol>
      </nav>
      <h4 class="mb-3 custom-form">Actualizar cliente</h4>
      <div class="col-12 custom-form vh-80">
      <form id="formRegistroCliente" class="needs-validation" method="post" action="actualizar_cliente.php" novalidate>
      <?php
            
            include ('../conexion.php');
            
            $sql = "SELECT * FROM ga_cliente WHERE pk_id_cliente=".$_GET['pk_id_cliente'];
            $resultado = $conectar->query($sql);
            $row = $resultado->fetch_assoc();
            
          ?>
      <input type="hidden" class="form-control" name="IdCliente" value="<?php echo $row['pk_id_cliente'] ?>">    
      <div class="row g-3">
            <div class="col-sm-6">
              <label id="ClienteNIT" for="document" class="form-label">NIT</label>
              <input name="ClienteNIT" type="number" class="form-control" 
              value="<?php echo $row['pk_id_cliente']; ?>"  disabled readonly>
            </div>
            <div class="invalid-feedback">
                Se requiere un NIT válido.
            </div>
            <div class="col-sm-6">
            <label id="ClienteNombre" for="name" class="form-label">Nombre</label>
              <input name="ActClienteNombre" type="text" class="form-control" 
              value="<?php echo $row['cliNombre']; ?>" required>
            </div>
            <div class="invalid-feedback">
                Se requiere un nombre válido.
            </div>
            <div class="col-md-6">
              <label id="ClienteCorreo" for="email" class="form-label">Correo</label>
              <input name="ActClienteCorreo" type="email" class="form-control"
                value="<?php echo $row['cliCorreo']; ?>" required>
            </div>
            <div class="invalid-feedback">
                Se requiere un correo válido.
            </div>
            <div class="col-sm-6">
            <label id="ClienteTelefono" for="phone" class="form-label">Telefono</label>
            <input name="ActClienteTelefono" type="number" class="form-control"
                value="<?php echo $row['cliTelefono']; ?>" required>
            </div>
            <div class="invalid-feedback">
                Se requiere un telefono válido.
            </div>
            </div>
            <div class="py-4">
            <button class="btn btn-lg float-start custom-btn" style="font-size: 15px;"
              type="submit">Actualizar
                cliente</button>
              <a class="btn btn-lg float-end custom-btn" style="font-size: 15px;"
              href="Cliente_dashboard.php">Cancelar</a>
            </div>
            </div>
            </form>
            </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="actualizar_cliente_form.js"></script>           


</body>
</html>