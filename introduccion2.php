<!DOCTYPE html>
<html>
<head>
  <?php
    include_once 'funciones/sesiones.php';
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
    $id = $_GET['id'];
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
        Introducción
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
          <p class="text-justify p-introduccion animated fadeIn">
          El presente manual de organización, tiene como propósito dar  a conocer las responsabilidades de cada una de las áreas que la conforman. Este documento es de información y consulta, en todas las áreas que conforman el manual es un medio para familiarizarse con la estructura orgánica y con los diferentes niveles jerárquicos que conforman esta Organización. Su consulta permite identificar con claridad las funciones y responsabilidades de cada una de las áreas que la integran y evitar la duplicidad de funciones; conocer las líneas de comunicación y de mando; y proporcionar los elementos para alcanzar la excelencia en el desarrollo de sus funciones.
          </p>
          <p class="text-justify p-introduccion animated fadeIn">
          </p>
          <p class="text-justify p-introduccion animated fadeIn">
            El manual de organización constituye un instrumento de apoyo al proceso organizacional, proporcionar información sobre la estructura orgánica, atribuciones, objetivos y funciones que realizan cada uno de los departamentos que la integran. Dentro de las atribuciones se tiene encomendada la programación y organización de actividades.
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
