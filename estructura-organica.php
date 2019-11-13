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
      Estructura Organica
      <small></small>
    </h1>
    <!-- <h4 class="breadcrumb">Ruta</h4> -->
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Direcciones</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
          <ul id="menu">
            <li>
              <div><a href="organigrama.php">Presidente</a></div>
              <ul id="ul_padre">
                <!-- <li><div><a href="organigrama-dependencia.php?id=101">Secretaría Particular</a></div></li>
                <li><div><a href="organigrama-dependencia.php?id=102">Secretaría de Seguridad Ciudadana</a></div></li>
                <li><div><a href="organigrama-dependencia.php?id=103">Secretaría de Ayuntamiento</a></div></li>
                <li><div><a href="organigrama-dependencia.php?id=104">Tesoreria Municipal</a></div></li>
                <li><div><a href="organigrama-dependencia.php?id=105"></a>Contraloria Municipal</div></li>
                <li><div><a href="organigrama-dependencia.php?id=106"></a>Direccion General de Atencion a las Mujeres</div></li>
                <li>
                  <div><a href="organigrama-dependencia.php?id=100">Dirección General de Medio Ambiente y Ordenamiento Territorial</a></div>
                  <ul>
                    <li><div>Direccion de Administracion Urbana</div></li>
                    <li><div>Direccion de Imagen Urbana y Gestión del Centro Histórico</div></li>
                    <li><div>Dirección de Ecología y Medio Ambiente</div></li>
                    <li><div>Dirección de Vivienda</div></li>
                    <li><div>Dirección Técnica Administrativa</div></li>
                  </ul>
                </li>
                <li><div><a href="organigrama-dependencia.php?id=107">Direccion General de Obra Publica</a></div></li>
                <li><div><a href="organigrama-dependencia.php?id=108">Direccion General de Desarrollo Turistico y Economico</a></div></li>
                <li><div><a href="organigrama-dependencia.php?id=109">Direccion General de Desarrollo Social y Humano</a></div></li>
                <li><div><a href="organigrama-dependencia.php?id=110">Direccion General de Cultura y Educacion</a></div></li>
                <li><div><a href="organigrama-dependencia.php?id=111">Direccion General de Servicios Juridicos</a></div></li>
                <li><div><a href="organigrama-dependencia.php?id=112">Unidad de Innovacion y Politicas Publicas</a></div></li> -->
              </ul>
            </li>
          </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
<!-- DataTables -->
<!-- JQUERY UI -->
<script
  src="js/jquery-ui.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>

<!-- Script Ajax Propie -->
<script src="js/estructura-organica.js"></script>
<style>
  .ui-menu { width: 150px; }
</style>
</body>
</html>
