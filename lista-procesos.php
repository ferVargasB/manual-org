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
          Listado de todos los procesos
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
                <h3 class="box-title">Procesos de las áreas</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="registros" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre del Proceso</th>
                        <th>Diagrama</th>
                        <th>Ficha Técnica</th>
                        <th>Número de Actores</th>
                        <th>Área al que pertenece</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- CODIGO EN PHP PARA OBTENER TODO EL CONTENIDO DE LA TABLA procesos-->
                      <?php
                      try {
                        $stmt = $objetoPDO->prepare("SELECT p.id_proceso,p.nombre as nombre_proceso,p.ruta_diagrama,p.ruta_ficha,p.numero_actores,p.area_perteneciente,a.nombre FROM procesos as p
                      INNER JOIN areas as a on p.area_perteneciente = a.id_area");
                        $stmt->execute();
                        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado as $row) { ?>
                          <tr>
                            <td><?php echo $row["nombre_proceso"]; ?></td>
                            <td><a href="<?php echo 'admin_area/' . $row['ruta_diagrama']; ?>" target="_blank">Ver Diagrama</a></td>
                            <td>
                              <?php
                                  if (!empty($row['ruta_ficha'])) { ?>
                                <a href="<?php echo 'admin_area/' . $row['ruta_ficha']; ?>" target="_blank">Ver Ficha</a>
                              <?php } else {
                                    echo "No existe ficha";
                                  } ?>
                            </td>
                            <td><?php echo $row["numero_actores"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td>
                              <a href="editar-proceso.php?id=<?php echo $row['id_proceso'] ?>" class="badge badge-success">Editar Proceso</a>
                              <a href="ver-proceso.php?id=<?php echo $row['id_proceso'] ?>" class="badge badge-success">Ver Proceso</a>
                              <a href="" data-area="<?php echo $row['id_proceso']; ?>" class="badge badge-success borrar_registro">Borrar Proceso</a>
                            </td>
                          </tr>
                      <?php }
                      } catch (Exception $e) {
                        echo $e->getMessage();
                      }
                      ?>
                      <!-- FIN CODIGO PHP -->
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nombre del Proceso</th>
                        <th>Diagrama</th>
                        <th>Ficha Técnica</th>
                        <th>Número de Actores</th>
                        <th>Área al que pertenece</th>
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

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Procesos de las dependencias</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="registros_dependencias" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre del Proceso</th>
                        <th>Diagrama</th>
                        <th>Ficha Técnica</th>
                        <th>Número de Actores</th>
                        <th>Área al que pertenece</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- CODIGO EN PHP PARA OBTENER TODO EL CONTENIDO DE LA TABLA procesos-->
                      <?php
                      try {
                        $stmt = $objetoPDO->prepare("SELECT p.id_proceso,p.nombre as nombre_proceso,p.ruta_diagrama,p.ruta_ficha,p.numero_actores,p.dependencia_perteneciente,d.nombre FROM procesos_dependencias as p
                      INNER JOIN dependencias as d on p.dependencia_perteneciente = d.id_dependencia");
                        $stmt->execute();
                        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado as $row) { ?>
                          <tr>
                            <td><?php echo $row["nombre_proceso"]; ?></td>
                            <td><a href="<?php echo 'admin_area/' . $row['ruta_diagrama']; ?>" target="_blank">Ver Diagrama</a></td>
                            <td>
                              <?php
                                  if (!empty($row['ruta_ficha'])) { ?>
                                <a href="<?php echo 'admin_area/' . $row['ruta_ficha']; ?>" target="_blank">Ver Ficha</a>
                              <?php } else {
                                    echo "No existe ficha";
                                  } ?>
                            </td>
                            <td><?php echo $row["numero_actores"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td>
                              <a href="editar-proceso.php?id=<?php echo $row['id_proceso'] ?>" class="badge badge-success">Editar Proceso</a>
                              <input type="button" tipo="dependencia" class="badge badge-success borrar_registro" data-id="<?php echo $row['id_proceso']; ?>" value="Borrar Proceso">
                              <a href="ver-proceso.php?id=<?php echo $row['id_proceso'] ?>" class="badge badge-success">Ver Proceso</a>
                              <a href="" tipo="dependencia" data-dependencia="<?php echo $row['id_proceso']; ?>" class="badge badge-success borrar_registro">Borrar Proceso</a>
                            </td>
                          </tr>
                      <?php }
                      } catch (Exception $e) {
                        echo $e->getMessage();
                      }
                      ?>
                      <!-- FIN CODIGO PHP -->
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nombre del Proceso</th>
                        <th>Diagrama</th>
                        <th>Ficha Técnica</th>
                        <th>Número de Actores</th>
                        <th>Área al que pertenece</th>
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

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Procesos de las sub área</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="registros_subareas" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nombre del Proceso</th>
                        <th>Diagrama</th>
                        <th>Ficha Técnica</th>
                        <th>Número de Actores</th>
                        <th>Sub área al que pertenece</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- CODIGO EN PHP PARA OBTENER TODO EL CONTENIDO DE LA TABLA procesos_subareas-->
                      <?php
                      try {
                        $stmt = $objetoPDO->prepare("SELECT p.id_proceso,p.nombre as nombre_proceso,p.ruta_diagrama,p.ruta_ficha,p.numero_actores,p.subarea_perteneciente,a.nombre FROM procesos_subareas as p
                      INNER JOIN sub_areas as a on p.subarea_perteneciente = a.id_subarea");
                        $stmt->execute();
                        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado as $row) { ?>
                          <tr>
                            <td><?php echo $row["nombre_proceso"]; ?></td>
                            <td><a href="<?php echo 'admin_area/' . $row['ruta_diagrama']; ?>" target="_blank">Ver Diagrama</a></td>
                            <td>
                              <?php
                                  if (!empty($row['ruta_ficha'])) { ?>
                                <a href="<?php echo 'admin_area/' . $row['ruta_ficha']; ?>" target="_blank">Ver Ficha</a>
                              <?php } else {
                                    echo "No existe ficha";
                                  } ?>
                            </td>
                            <td><?php echo $row["numero_actores"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td>
                              <a href="editar-proceso-subarea.php?id=<?php echo $row['id_proceso'] ?>" class="badge badge-success">Editar Proceso</a>
                              <a href="ver-proceso-subarea.php?id=<?php echo $row['id_proceso'] ?>" class="badge badge-success">Ver Proceso</a>
                              <a href="" tipo="subarea" data-subarea="<?php echo $row['id_proceso']; ?>" class="badge badge-success borrar_registro">Borrar Proceso</a>
                            </td>
                          </tr>
                      <?php }
                      } catch (Exception $e) {
                        echo $e->getMessage();
                      }
                      ?>
                      <!-- FIN CODIGO PHP -->
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Nombre del Proceso</th>
                        <th>Diagrama</th>
                        <th>Ficha Técnica</th>
                        <th>Número de Actores</th>
                        <th>Sub Área al que pertenece</th>
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
  <script>
    $(document).ready(function() {
      $('.sidebar-menu').tree();
      $(".borrar_registro").on("click", (e) => {
        if( "area" in e.target.dataset){
          borrarArea(e.target.dataset.id);
        } else if ( "dependencia" in e.target.dataset ){
          console.log("es una dependencia");
        } else{
          console.log("es una asubarea");
        }
        e.preventDefault();
      });
    });

    async function borrarArea(id_proceso){
      try {
        let formData = new FormData();
        formData.append("id_proceso",id_proceso);
        const response = await fetch("servicios/ws_eliminar_proceso.php?numero_servicio=1", {
          method:"POST",
          body:formData
        });
        const resultado = await response.json();
        alert(resultado);
      } catch (error) {
        alert(error);
      }
    }
  </script>
  <script>
    $(function() {
      $('#registros').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'language': {
          paginate: {
            next: 'Siguiente',
            previous: 'Anterior',
            last: 'Ultimo',
            first: 'Primero'
          },
          info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
          emptyTable: 'No hay registros',
          infoEmpty: '0 registros',
          search: 'Buscar',
          sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
          sLengthMenu: "Mostrar _MENU_ registros"

        }
      });
    });
    $(function() {
      $('#registros_dependencias').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'language': {
          paginate: {
            next: 'Siguiente',
            previous: 'Anterior',
            last: 'Ultimo',
            first: 'Primero'
          },
          info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
          emptyTable: 'No hay registros',
          infoEmpty: '0 registros',
          search: 'Buscar',
          sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
          sLengthMenu: "Mostrar _MENU_ registros"

        }
      })
    });
    $(function() {
      $('#registros_subareas').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'language': {
          paginate: {
            next: 'Siguiente',
            previous: 'Anterior',
            last: 'Ultimo',
            first: 'Primero'
          },
          info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
          emptyTable: 'No hay registros',
          infoEmpty: '0 registros',
          search: 'Buscar',
          sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
          sLengthMenu: "Mostrar _MENU_ registros"

        }
      })
    })
  </script>
</body>

</html>