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
      <h4 class="breadcrumb">Ruta</h4>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Misión</h3> 
        </div>
        <div class="box-body text-justify p-introduccion" >
          El Gobierno Municipal de Guanajuato Capital 2018-2021 pone en marcha un Programa de Gobierno alineado a las demandas de los guanajuatenses, de acuerdo a los estudios de opinión realizados, así como de los diagnósticos técnicos que exponen las necesidades del municipio. El Programa se desglosa en cinco ejes temáticos basados en los requerimientos de la ciudad, sus ciudadanos, y la propia administración, con un claro objetivo de marcar el rumbo a corto y mediano plazo, porque que muchos de los problemas de la ciudad deben resolverse a través de la correcta aplicación del plan estratégico a largo plazo. En este sentido, se emprenden las acciones que conduzcan al objetivo con las metas concretas y comprobables que permitan a Guanajuato ser un municipio más seguro, ordenado, próspero, con bienestar, y con un gobierno eficiente abierto e innovador, que se mantiene cerca de los ciudadanos.
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Visión</h3> 
        </div>
        <div class="box-body text-justify p-introduccion">
          La administración municipal terminará su gestión en octubre de 2021, y en esa fecha se centra la consecución de las metas que propone este Programa de Gobierno. Al final del año mencionado, Guanajuato Capital mantendrá su esplendor y el valor de su patrimonio, que le permite ser un referente turístico internacional cada vez más reconocido en todo el planeta. La tranquilidad en la ciudad es una prioridad de este gobierno. En Guanajuato habrá una mayor de prevención del delito, a través de la dignificación de espacios públicos, eventos y actividades que fomenten el sano esparcimiento, así como cuerpos policiales especializados y más equipados. Guanajuato será una ciudad mejor adaptada al continuo crecimiento del área urbana, con nuevas estrategias de sectorización que permitan dar un servicio más eficaz a todo el municipio, además de contar con sistemas de planificación y desarrollo urbano más fuertes y sólidos. Las familias guanajuatenses que más lo necesitan contarán con valiosos apoyos, y los ciudadanos tendrán más oportunidades, gracias a la atracción del turismo y nuevas inversiones, lo que incluye las obras e infraestructura que una ciudad en expansión necesita.
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Valores</h3> 
        </div>
        <div class="box-body p-introduccion">
          <ol>
            <li>
              <a href="#">
                    <span>Respeto: al ciudadano y al patrimonio histórico, arquitectónico, cultural y natural de Guanajuato Capital. </span>
                </a>
            </li>
            <li>
              <a href="#">
                    <span>Eficacia y eficiencia: en las acciones emprendidas, con el fin de otorgar los resultados esperados, y aprovechar de la mejor manera posible los recursos disponibles para la consecución de las metas establecidas. </span>
                </a>
            </li>
            <li>
              <a href="#">
                    <span>Compromiso: para ejecutar este Programa de Gobierno y atender las necesidades de los guanajuatenses. </span>
                </a>
            </li>
            <li>
              <a href="#">
                    <span>Colaboración: con las empresas, instituciones y sociedad en general, para sumar fuerzas y conseguir objetivos en beneficio de Guanajuato Capital</span>
                </a>
            </li>
            <li>
              <a href="#">
                    <span>Honestidad: integridad y transparencia a favor de las buenas prácticas y la rendición de cuentas.</span>
                </a>
            </li>
          </ol>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Ejes Estratégicos</h3> 
        </div>
        <div class="box-body text-justify p-introduccion">
          <ol>
            <li>
              <a href="http://">
                <span>Guanajuato Capital Segura.</span>
              </a>
            </li>
            <li>
              <a href="http://">
                <span>Guanajuato Capital Ordenada.</span>
              </a>
            </li>
            <li>
              <a href="http://">
                <span>Guanajuato Capital Próspera</span>
              </a>
            </li>
            <li>
              <a href="http://">
                <span>Guanajuato Capital del Bienestar.</span>
              </a>
            </li>
            <li>
              <a href="http://">
                <span>Guanajuato Capital con Gobernanza.</span>
              </a>
            </li>
          </ol>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Ejes Estrategicos</h3> 
        </div>
        <div class="box-body">
          <ol>
            <li>
              <a href="#">
                    <span>Ser el municipio.....</span>
                </a>
            </li>
          </ol>
        </div> -->
        <!-- /.box-body -->
    <!--   </div> -->
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
