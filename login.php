<!DOCTYPE html>
<html>
<head>
  <?php
    session_start();
    $cerrar_sesion = $_GET["cerrar_sesion"];
    if ($cerrar_sesion)
    {
      session_destroy();
    }
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
    //include_once 'funciones/sesiones.php';
  ?>
<body class="hold-transition login-page">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1 class="effect-underline">Manual de Organización de la Administración Pública de Guanajuato</h1>
      
    </div>
  </div>
  <div class="login-box">
  <div class="login-logo">
    <!-- <a href="#"><b>GA</b>Asociados</a> -->
    <img src="assets/img/logo_gto-1.png" alt="" class="imagedropshadow">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesión</p>

    <form name="login-admin-form" id="login-admin" method="post" action="login-admin.php">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="usuario" placeholder="Usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <input type="hidden" name="login-admin" value="1">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/icheck.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script src="js/admin-ajax.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body> 
</html>
