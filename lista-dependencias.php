<!DOCTYPE html>
<html>
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
      Listado de Dependencias
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
              <h3 class="box-title">Sección para manejar las dependencias</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Objetivo General</th>
                    <th>Perfil Puesto</th>
                    <th>Atribuciones</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    <!-- CODIGO EN PHP PARA OBTENER TODO EL CONTENIDO DE LA TABLA dependencias-->
                    <?php

                    try {
                    $stmt = $objetoPDO->prepare("SELECT id_dependencia,nombre,ruta_objetivo_general,ruta_perfil_puesto,ruta_atribuciones FROM dependencias ORDER BY nombre");
                    $stmt->execute();
                    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($resultado as $row)
                    {
                      ?>
                      <tr class="">
                        <td><?php echo $row["nombre"]; ?></td>
                        <td><a href="<?php echo './objetivos-pdf/generales/'.$row['ruta_objetivo_general'];?>" target="_blank">Ver Objetivo General</a></td>
                        <td><a href="<?php echo './perfiles-pdf/dependencias/'.$row['ruta_perfil_puesto'];?>" target="_blank">Ver Perfil de Puesto</a></td>
                        <td><a href="<?php echo './atribuciones-pdf/dependencias/'.$row['ruta_atribuciones'];?>" target="_blank">Ver Atribuciones</a></td>
                        <td>
                          <a href="organigrama-dependencia.php?id=<?php echo $row['id_dependencia']?>" class="badge badge-success">Ver Organigrama</a>
                          <a href="editar-dependencia.php?id=<?php echo $row['id_dependencia']?>" class="badge badge-success">Editar Dependencia</a>
                          <a href="" class="badge badge-success borrar_registro" data-id="<?php echo $row['id_dependencia'];?>">Borrar dependencia</a>
                        </td>
                      </tr>
                    <?php }
                    } catch (\Throwable $th) {
                      //throw $th;
                    }
                    
                    ?>
                    <!-- FIN CODIGO PHP -->
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Nombre</th>
                    <th>Objetivo General</th>
                    <th>Perfil Puesto</th>
                    <th>Atribuciones</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            <!-- /.box-body -->
          </div>
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
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Script Ajax Propie -->
<script src="js/dependencia-ajax.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })

</script>
<script>
  $(function () {
    $('#registros').DataTable(
      {
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'language' : {
        paginate : {
          next : 'Siguiente',
          previous : 'Anterior',
          last : 'Ultimo',
          first : 'Primero'
        },
        info : 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
        emptyTable: 'No hay registros',
        infoEmpty: '0 registros',
        search: 'Buscar',
        sInfoFiltered:   '(filtrado de un total de _MAX_ registros)',
        sLengthMenu:     "Mostrar _MENU_ registros"

      }
    })
  })
</script>
</body>
</html>
