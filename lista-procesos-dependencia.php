<!DOCTYPE html>
<html>
<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
$idp = $_GET["idp"];
try {
    $resultado = 0;
    $stmn = $objetoPDO->prepare("SELECT pc.id_proceso,pc.nombre, pc.ruta_diagrama, pc.ruta_ficha, pc.dependencia_perteneciente, d.nombre AS depenNombre 
    FROM procesos_dependencias pc
    INNER JOIN dependencias d
    ON pc.dependencia_perteneciente = d.id_dependencia
    WHERE pc.dependencia_perteneciente = :dependencia;");
    $stmn->bindParam(":dependencia", $idp);
    if ($stmn->execute()) {
        $resultado = $stmn->fetchAll(PDO::FETCH_ASSOC);
    } else {
        throw new Exception("Ocurrió un error al recuperar los procesos");
    }
} catch (EXception $e) {
    echo $e->getMessage();
}
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
                <input type="hidden" name="id_depen" id="id_depen" value="<?php echo $idp; ?>">
                <h1>
                    Listado de Procesos por Dependencia
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="organigrama.php"><i class="fa fa-home"></i> Organigrama General</a></li>
                    <li><a href="organigrama-dependencia.php?id=<?php echo $idp; ?>"><i></i> <?php echo $resultado[0]["depenNombre"]; ?></a></li>
                    <li class="active">Procesos</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Dirección de Administación Urbana</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="registros" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre del Proceso</th>
                                                <th>Ficha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- CODIGO EN PHP PARA OBTENER TODO EL CONTENIDO DE LA TABLA admins-->
                                            <?php
                                            foreach ($resultado as $row) { ?>
                                                <tr>
                                                    <td><?php echo $row["nombre"]; ?></td>
                                                    <td>
                                                        <?php
                                                            if ($row['ruta_ficha'] != "") { ?>
                                                            <a href="<?php echo 'admin_area/' . $row['ruta_ficha']; ?>" class="badge badge-success" target="_blank">Ver Ficha Técnica</a>
                                                        <?php } else { ?>
                                                            <a href="#" class="badge badge-success">No hay Ficha</a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="ver-proceso-dependencia.php?id=<?php echo $row['id_proceso'] . '&ida=' . $ida . '&idp=' . $idp; ?>" class="badge badge-success">Ver Diagrama</a>
                                                    </td>
                                                </tr>
                                            <?php  }
                                            ?>
                                            <!-- FIN CODIGO PHP -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre del Proceso</th>
                                                <th>Ficha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a href="organigrama-dependencia.php?id=<?php echo $idp; ?>" class="btn btn-primary active" role="button" aria-pressed="true">Regresar</a>
                            </div>
                            <!-- /.box-footer-->
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
        $(document).ready(function() {
            $('.sidebar-menu').tree()
        })
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
            })
        })
    </script>
</body>

</html>