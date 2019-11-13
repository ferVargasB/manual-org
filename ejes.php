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
     <!--  <h4 class="breadcrumb">Ruta</h4> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><h2 class="box-title"><a href="MOGU/Programa_de_Gobierno_Municipal_2018_2021.pdf" target="_blank">Valores</a></h2></h3> 
        </div>
        <div class="box-body p-introduccion " style="font-size:22px;">
          <ol>
            <li>
              Respeto: al ciudadano y al patrimonio histórico, arquitectónico, cultural y natural de Guanajuato Capital. </span>
            </li>
            <li>
              Eficacia y eficiencia: en las acciones emprendidas, con el fin de otorgar los resultados esperados, y aprovechar de la mejor manera posible los recursos disponibles para la consecución de las metas establecidas. 
            </li>
            <li>
              Compromiso: para ejecutar este Programa de Gobierno y atender las necesidades de los guanajuatenses. 
            </li>
            <li>
              Colaboración: con las empresas, instituciones y sociedad en general, para sumar fuerzas y conseguir objetivos en beneficio de Guanajuato Capital
            </li>
            <li>
              Honestidad: integridad y transparencia a favor de las buenas prácticas y la rendición de cuentas.
            </li>
          </ol>
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
