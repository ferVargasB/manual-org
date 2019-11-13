<!DOCTYPE html>
<html>
<head>
  <?php
    include_once 'funciones/sesiones.php';
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
  ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php
    include_once 'templates/barra.php';
    include_once 'templates/asidebar.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Administrador
        <small>llenar el formulario para crear un administrador</small>
      </h1>
      <h4 class="breadcrumb">Ruta</h4>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Crear Administrador</h3>
        </div>
        <div class="box-body">
          <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelos/modelo-admin.php">
            <div class="box-body">
              <div class="form-group">
                <label for="usuario">Nombre o Usuario:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el nombre o usuario" required>
              </div>
              <div class="form-group">
                <label for="correo">Correo Eléctronico:</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Escriba el correo eléctronico" required>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <label for="puesto">Puesto:</label>
                <select name="puesto" id="puesto" required>
                  <option value="director">Director</option>
                  <option value="jefe">Jefe</option>
                  <option value="recepcionista">Recepcionista</option>
                  <option value="contador">Contador</option>
                </select>
              </div>
              <div class="form-group">
                <label for="rol">Rol:</label>
                <select name="rol" id="rol" required>
                  <option value="funcionario">Funcionario</option>
                  <option value="webmaster">Webmaster (Admin)</option>
                </select>
              </div>
            </div>
            <div class="box-footer">
              <input type="hidden" name="registro" value="nuevo">
              <button type="submit" class="btn btn-primary" onsubmit="this.reset()">Añadir</button>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php
    include_once 'templates/footer.php';
  ?>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script src="js/admin-ajax.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
