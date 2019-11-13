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
        Marco Jurídico del Manual de Organización
        <small></small>
      </h1>
      <!-- <h4 class="breadcrumb">Ruta</h4> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Reglamento Orgánico de la Administración Pública Municipal de Guanajuato</h3> 
        </div>
        <div class="box-body text-justify">
        <p>
          <h4>Capítulo II</h4>
          <h4>De la Instalación del Ayuntamiento</h4>
          <h4>Objeto de la primera sesión ordinaria</h4>
          <strong>Articulo 41.</strong> Al termino de la sesion de instalacion, el ayuntamiento entrante
          procederá en sesión ordinaria, a lo siguiente:
          <br>
          III. Proceder al acto de la entrega recepcion de la situacion que guarda la administracion publica minicipal.
        </p>
        <br>
        <p>
          <h4>Contenido del expediente de entrega recepción</h4>
          <strong>Articulo 45. </strong> La integracion del expediente a que se refiere el articulo anterior será
          responsabilidad del Ayuntamiento saliente y deberá contener, por lo menos, la informacion relativa a:
          <br>
          VII. Los manuales de organizacion y de procedimientos, la plantilla y los expedientes del personal al servicio
          del Municipio, antigüedad, prestaciones, catálogo de puestos, condiciones generales de trabajo y demás información
          cotundente. Corresponde al Tesorero Municipal proporcionar esta información.
        </p>
        <br>
        <p>
          <h4>Título Noveno</h4>
          <h4>Capítulo Único</h5>
          <h4>De La Facultad Reglamentaria</h4>
            <strong>Artículo 236. </strong> Los ayuntamientos están facultados para elaborar, expedir,
            reformar y adicionar, de acuerdo con las leyes en materia muncipal que expida el congreso del Estado,
            los bandos de policia y buen gobierno, reglamentos, circulares y disposiciones administrativas de observancia general,
            que organicen la administracion publica municipal regulen las materias, procedimentos, funciones y servicios publicos
            de su competencia y aseguren la participacion ciudadana y vecinal.
        </p>
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
