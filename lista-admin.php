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
      Listado de Administradores
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
              <h3 class="box-title">Sección para manejar los administradores</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Correo</th>
                  <th>Pasword</th>
                  <th>Puesto</th>
                  <th>Rol</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <!-- CODIGO EN PHP PARA OBTENER TODO EL CONTENIDO DE LA TABLA admins-->
                  <?php

                  try {
                  $stmt = $objetoPDO->prepare("SELECT id_usuario,nombre,correo,password,puesto,rol FROM usuarios");
                  $stmt->execute();
                  $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  error_log($resultado);
                  foreach($resultado as $row)
                  {
                    ?>
                    <tr>
                      <td><?php echo $row["nombre"]; ?></td>
                      <td><?php echo $row["correo"]; ?></td>
                      <td><?php echo $row["password"]; ?></td>
                      <td><?php echo $row["puesto"]; ?></td>
                      <td><?php echo $row["rol"]; ?></td>
                      <td>
                        <a href="editar-admin.php?id=<?php echo $row['id_usuario']?>" class="badge badge-success">Editar Usuario</a>
                        <a href="" class="badge badge-success borrar_registro" data-id="<?php echo $row['id_usuario'];?>">Borrar Usuario</a>
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
                  <th>Usuario</th>
                  <th>Correo</th>
                  <th>Pasword</th>
                  <th>Puesto</th>
                  <th>Rol</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
              </div>
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
<script src="js/admin-ajax.js"></script>
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
