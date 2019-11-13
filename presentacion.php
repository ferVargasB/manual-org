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
      Presentación
        <small></small>
      </h1>
      <!-- <h4 class="breadcrumb">Ruta</h4> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h2 class="box-title"></h2>
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="img-fluid">
                <img src="assets/img/foto_presidente_municipal.jpeg" class="img-thumbnail" alt="">
              </div>
            </div>
          </div>
          <br>
          <p class="text-justify p-introduccion animated fadeIn">
          Estimado servidor público de la administración pública municipal de Guanajuato: 
            Estamos poniendo a tu disposición este Manual de Organización Sistematizado como una herramienta 
            de apoyo que te facilite cumplir de forma más eficiente y eficaz con tus funciones y atribuciones.
          </p>
          <p class="text-justify p-introduccion animated fadeIn">
            Este Manual de Organización Sistematizado te permite acceder de una forma remota y dinámica al organigrama de tu dependencia, a tus atribuciones, funciones y el  sustento jurídico que te faculta para realizarlas, 
            así como el perfil de puesto. También te permite consultar en línea los procesos y trámites sustantivos de cada dependencia.Otra característica, 
            la cual no tiene el clásico Manual de Organización, es que soporta la actualización en línea, cuando así se requiera, evitando caer en la obsolescencia.
          </p>
          <p class="text-justify p-introduccion animated fadeIn">
          El Manual de Organización Sistematizado contribuye a ubicar a la actual administración pública de Guanajuato capital a la vanguardia a nivel nacional en el tema de Gobernanza 4.0, expresado en el Programa de Gobierno 2018-2021 en el Eje Estratégico 5, Guanajuato capital con gobernanza, al colaborar en la implementación de la Línea Estratégica 5.1 Participación Ciudadana y Gobernanza, a través del Objetivo V.1 “Llevar a cabo una reestructuración de la administración pública municipal disminuyendo las dependencias en atención a las exigencias y necesidades de la población”; y de la Línea Estratégica 5.4 Atención Digna y Cercana, a través del Objetivo V.9 “Brindar asesoría de trámites y solicitudes de manera eficiente y eficaz a la ciudadanía a través de las TIC´s”.
          </p>
          <p class="text-center p-introduccion animated fadeIn">
            <br>
              Atentamente 
              <br>
              Alejandro Navarro Saldaña
              <br>
              Presidente Municipal
          </p> 
        </div>
        <div class="box-body">
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
