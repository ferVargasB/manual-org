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
      Marco Estrategico
        <small></small>
      </h1>
      <!-- <h4 class="breadcrumb">Ruta</h4> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h2 class="box-title"><a href="MOGU/Programa_de_Gobierno_Municipal_2018_2021.pdf" target="_blank">Misión</a></h2> 
        </div>
        <div class="box-body text-justify p-introduccion" style="font-size:25px;">
          El Gobierno Municipal de Guanajuato Capital 2018-2021 pone en marcha un Programa de Gobierno alineado a las demandas de los guanajuatenses, de acuerdo a los estudios de opinión realizados, así como de los diagnósticos técnicos que exponen las necesidades del municipio. El Programa se desglosa en cinco ejes temáticos basados en los requerimientos de la ciudad, sus ciudadanos, y la propia administración, con un claro objetivo de marcar el rumbo a corto y mediano plazo, porque que muchos de los problemas de la ciudad deben resolverse a través de la correcta aplicación del plan estratégico a largo plazo. En este sentido, se emprenden las acciones que conduzcan al objetivo con las metas concretas y comprobables que permitan a Guanajuato ser un municipio más seguro, ordenado, próspero, con bienestar, y con un gobierno eficiente abierto e innovador, que se mantiene cerca de los ciudadanos.
        </div>
        <!-- /.box-body -->
      </div>
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
